<!--begin::Col-->
<div class="col-xl-12 mb-xl-10">
    <!--begin::Tables Widget 5-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Reservasi Ruangan</span>
                <span class="text-muted mt-1 fw-bold fs-7">
                    Terdapat <?= count($reservasi); ?> Reservasi
                </span>
            </h3>
            <div class="bottom-end d-flex align-items-center">
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" name="search" id="search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Cari">
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 datatable">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder">
                            <th class="w-20px"></th>
                            <th class="min-w-150px">Reservasi</th>
                            <th class="min-w-100px text-center">Tanggal</th>
                            <th class="min-w-100px text-center">Rentang Waktu</th>
                            <th class="min-w-130px text-center">Status</th>
                            <?php
                            if (session()->get('group') == 'superadmin' || session()->get('group') == 'admin') : ?>
                                <th class="min-w-120px text-end">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php foreach ($reservasi as $reservasi) : ?>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <a href="/reservasi/<?= $reservasi['reservasi_id']; ?>">
                                            <span class="symbol-label">
                                                <img src="/assets/media/logos/header.svg" class="h-50 align-self-center" alt="" />
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <a href="/reservasi/<?= $reservasi['reservasi_id']; ?>" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                        <?= $reservasi['acara_nama']; ?>
                                    </a>
                                    <span class="text-muted fw-bold d-block"><?= $reservasi['ruang_nama']; ?>,
                                        <?= $reservasi['gedung_nama']; ?>
                                    </span>
                                    <span class="text-muted fw-bold d-block">
                                        <?= $reservasi['opd_tempat']; ?>
                                    </span>
                                </td>
                                <td class="text-center text-muted fw-bold">
                                    <?php $date = date_create($reservasi['reservasi_tanggal']);
                                    // dd($date);
                                    echo date_format($date, 'd F Y'); ?>
                                </td>

                                <td class="text-center text-muted fw-bold">
                                    <?= $reservasi['reservasi_mulai'] . " - " .  $reservasi['reservasi_berakhir'] ?>
                                </td>

                                <td class="text-center">
                                    <?php
                                    if ($reservasi['status_reservasi_nama'] == 'Diajukan') : ?>
                                        <span class="badge badge-light-success"><?= $reservasi['status_reservasi_nama'] ?>
                                        </span>
                                    <?php elseif ($reservasi['status_reservasi_nama'] == 'Ditolak') : ?>
                                        <span class="badge badge-light-danger"><?= $reservasi['status_reservasi_nama'] ?>
                                        </span>
                                    <?php elseif ($reservasi['status_reservasi_nama'] == 'Diterima') : ?>
                                        <span class="badge badge-light-primary"><?= $reservasi['status_reservasi_nama'] ?>
                                        </span>
                                    <?php elseif ($reservasi['status_reservasi_nama'] == 'Berjalan') : ?>
                                        <span class="badge badge-light-info"><?= $reservasi['status_reservasi_nama'] ?>
                                        </span>
                                    <?php elseif ($reservasi['status_reservasi_nama'] == 'Selesai') : ?>
                                        <span class="badge badge-light-dark text-muted"><?= $reservasi['status_reservasi_nama'] ?>
                                        </span>
                                    <?php elseif ($reservasi['status_reservasi_nama'] == 'Dibatalkan') : ?>
                                        <span class="badge badge-light-warning"><?= $reservasi['status_reservasi_nama'] ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 my-1 detail-reservasi' id="<?= $reservasi['reservasi_id'] ?>">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                        <span class='svg-icon svg-icon-3'>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path opacity='0.8' d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" fill='black' />
                                                <path opacity='0.8' d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" fill='black' />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 my-1 edit-reservasi' id="<?= $reservasi['reservasi_id'] ?>">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class='svg-icon svg-icon-3'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                                <path opacity='0.3' d='M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z' fill='black' />
                                                <path d='M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z' fill='black' />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 my-1 batal-reservasi' id="<?= $reservasi['reservasi_id'] ?>">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class='svg-icon svg-icon-3'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                                <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black' />
                                                <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black' />
                                                <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black' />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Tables Widget 5-->
</div>
<!--end::Col-->
<!-- Modal -->
<div class="modal fade" id="ajaxModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y pt-0 pb-15" id="ajaxModalContent">
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>