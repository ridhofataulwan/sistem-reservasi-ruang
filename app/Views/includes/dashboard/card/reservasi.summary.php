<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

?>
<!--begin::Col-->
<div class="col-xl-8 mb-5 mb-xl-10">
    <!--begin::List widget 16-->
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-gray-800">Reservasi</span>
                <span class="text-gray-400 mt-1 fw-bold fs-6">
                    <span class="badge badge-light-success"><?= count($reservasiDiajukan) ?> - Reservasi Diajukan
                    </span>
                    <span class="badge badge-light-primary"><?= count($reservasiDiterima) ?> - Reservasi Diterima
                    </span>
                    <span class="badge badge-light-warning"><?= count($reservasiBerjalan) ?> - Reservasi Berjalan
                    </span>
                </span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-4 px-0">
            <!--begin::Nav-->
            <ul class="nav nav-pills nav-pills-custom item position-relative mx-9 mb-9">
                <!--begin::Item-->
                <li class="nav-item col-4 mx-0 p-0">
                    <!--begin::Link-->
                    <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#reservasi_summary_diajukan">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Diajukan</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-success rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item col-4 mx-0 px-0">
                    <!--begin::Link-->
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#reservasi_summary_diterima">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Diterima</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item col-4 mx-0 px-0">
                    <!--begin::Link-->
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#reservasi_summary_berjalan">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Berjalan</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-warning rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Bullet-->
                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                <!--end::Bullet-->
            </ul>
            <!--end::Nav-->
            <!--begin::Tab Content-->
            <div class="tab-content px-9 hover-scroll-overlay-y pe-7 me-3 mb-2" style="height: 454px">
                <!--begin::Tap pane-->
                <div class="tab-pane fade show active" id="reservasi_summary_diajukan">
                    <?php foreach ($reservasiDiajukan as $r) : ?>
                    <?php $originalDate = $r['reservasi_tanggal'];
                        $r['reservasi_tanggal'] = tanggal_indo(date($originalDate), true); ?>
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Timeline-->
                        <div class="timeline ms-n1">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-4">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                fill="black" />
                                            <path
                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Label-->
                                    <span class="fs-8 fw-boldest text-success"><?= $r['nama'] ?></span>
                                    <!--begin::Label-->
                                    <!--begin::Title-->
                                    <a href="#"
                                        class="fs-6 text-gray-800 fw-bolder d-block text-hover-primary"><?= $r['acara_nama'] ?></a>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fw-bold text-gray-400 d-block"><?= $r['ruang_nama'] ?>.
                                        <?= $r['gedung_nama'] ?>
                                    </span>
                                    <span class="fw-bold badge badge-light-success"><?= $r['reservasi_tanggal'] ?>
                                    </span>
                                    <span class="fw-bold badge badge-light-success">
                                        <?= $r['reservasi_mulai'] ?> - <?= $r['reservasi_berakhir'] ?>
                                    </span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mt-5 mb-4"></div>
                    <!--end::Separator-->
                    <?php endforeach; ?>
                </div>
                <!--end::Tap pane-->
                <!--begin::Tap pane-->
                <div class="tab-pane fade" id="reservasi_summary_diterima">
                    <?php foreach ($reservasiDiterima as $r) : ?>
                    <?php $originalDate = $r['reservasi_tanggal'];
                        $r['reservasi_tanggal'] = tanggal_indo(date($originalDate), true); ?>
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Timeline-->
                        <div class="timeline ms-n1">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-4">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                fill="black" />
                                            <path
                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Label-->
                                    <span class="fs-8 fw-boldest text-success"><?= $r['nama'] ?></span>
                                    <!--begin::Label-->
                                    <!--begin::Title-->
                                    <a href="#"
                                        class="fs-6 text-gray-800 fw-bolder d-block text-hover-primary"><?= $r['acara_nama'] ?></a>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fw-bold text-gray-400 d-block"><?= $r['ruang_nama'] ?>.
                                        <?= $r['gedung_nama'] ?>
                                    </span>
                                    <span class="fw-bold badge badge-light-primary"><?= $r['reservasi_tanggal'] ?>
                                    </span>
                                    <span class="fw-bold badge badge-light-primary">
                                        <?= $r['reservasi_mulai'] ?> - <?= $r['reservasi_berakhir'] ?>
                                    </span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mt-5 mb-4"></div>
                    <!--end::Separator-->
                    <?php endforeach; ?>
                    <!--end::Tap pane-->
                </div>
                <!--begin::Tap pane-->
                <div class="tab-pane fade" id="reservasi_summary_berjalan">
                    <?php foreach ($reservasiBerjalan as $r) : ?>
                    <?php $originalDate = $r['reservasi_tanggal'];
                        $r['reservasi_tanggal'] = date("l, d F o", strtotime($originalDate)); ?>
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Timeline-->
                        <div class="timeline ms-n1">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-4">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                fill="black" />
                                            <path
                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Label-->
                                    <span class="fs-8 fw-boldest text-success"><?= $r['nama'] ?></span>
                                    <!--begin::Label-->
                                    <!--begin::Title-->
                                    <a href="#"
                                        class="fs-6 text-gray-800 fw-bolder d-block text-hover-primary"><?= $r['acara_nama'] ?></a>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fw-bold text-gray-400 d-block"><?= $r['ruang_nama'] ?>.
                                        <?= $r['gedung_nama'] ?>
                                    </span>
                                    <span class="fw-bold badge badge-light-warning"><?= $r['reservasi_tanggal'] ?>
                                    </span>
                                    <span class="fw-bold badge badge-light-warning">
                                        <?= $r['reservasi_mulai'] ?> - <?= $r['reservasi_berakhir'] ?>
                                    </span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mt-5 mb-4"></div>
                    <!--end::Separator-->
                    <?php endforeach; ?>
                </div>
                <!--end::Tap pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::List widget 16-->
</div>
<!--end::Col-->