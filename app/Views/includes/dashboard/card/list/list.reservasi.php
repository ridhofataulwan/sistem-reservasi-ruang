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
                            <?php if (session()->get('group') == 'superadmin') : ?> <th class="text-end p-0 w-70px fw-bolder text-muted"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php foreach ($reservasi as $reservasi) : ?>
                            <tr id="<?= $reservasi['reservasi_id']; ?>" class="reservasi">
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

                                <?php if (session()->get('group') == 'superadmin') : ?>
                                    <td class="text-end">

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Validasi
                                            </button>
                                            <ul class="dropdown-menu shadow-sm">
                                                <li>
                                                    <a href="#" class="dropdown-item detail-reservasi" id="<?= $reservasi['reservasi_id']; ?>">
                                                        <i class="bi bi-eye-fill text-success"></i>
                                                        <span class="menu-title text-success">Detail</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item approve" id="<?= $reservasi['reservasi_id']; ?>">
                                                        <i class="bi bi-check-circle-fill text-primary"></i>
                                                        <span class="menu-title text-primary">Terima</span>
                                                    </a>
                                                </li>
                                                <li><a href="#" class="dropdown-item decline" id="<?= $reservasi['reservasi_id'] ?>">
                                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                                        <span class="menu-title text-danger">Tolak</span>
                                                    </a></li>
                                            </ul>
                                        </div>


                                    </td>
                                <?php endif; ?>
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