<!-- Begin::container -->
<!--begin::Careers - List-->
<div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10">
    <!--begin::Body-->
    <div class="card-body p-lg-17">
        <!--begin::Hero-->
        <div class="position-relative mb-17">
            <!--begin::Overlay-->
            <div class="overlay overlay-show">
                <!--begin::Image-->
                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                    style="background-image:url('/assets/media/logos/header.svg')"></div>
                <!--end::Image-->
                <!--begin::layer-->
                <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                <!--end::layer-->
            </div>
            <!--end::Overlay-->
            <!--begin::Heading-->
            <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                <!--begin::Title-->
                <h3 class="text-white fs-2qx fw-bolder mb-3 m">
                    <?= $opd['opd_nama']; ?>
                </h3>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="fs-5 fw-bold">
                    <?php if ($opd['opd_alamat'] != true) {
                        echo 'Alamat belum tersedia';
                    } ?>
                </div>
                <!--end::Text-->
            </div>
            <!--end::Heading-->
        </div>
        <!--end::-->
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row mb-17">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <!--begin::Job-->
                <div class="mb-10">
                    <!--begin::Description-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <h4 class="fs-1 text-gray-800 w-bolder mb-6"><?= $opd['opd_nama'] ?></h4>
                        <!--end::Title-->
                        <!-- begin::Identity -->

                        <!-- end::Identity -->
                        <!--end::Text-->
                    </div>
                    <!--end::Description-->

                </div>
                <!--end::Job-->
                <!--begin::Job-->
                <div class="mb-10 mb-lg-0">
                    <!--begin::Description-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">Bidang</h4>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <p class="fw-bold fs-4 text-gray-600 mb-2">Apabila terdapat bidang yang ingin dihapus, harap
                            hubungi Kominfo</p>
                        <!--end::Text-->
                    </div>
                    <!--end::Description-->
                    <!--begin::Accordion-->
                    <!--begin::Section-->
                    <?php foreach ($bidang as $b) : ?>
                    <div class="m-0 d-flex" style="justify-content: space-between ; align-items: center;">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 mb-0">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <span class="bullet me-3"></span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0"><?= $b['bidang_nama'] ?></h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 mb-0 mt-3">
                            <a class="mx-5 edit-bidang" id="<?= $b['bidang_kode'] ?>" style="cursor: pointer;">
                                <i class="fa fa-pen"></i>
                            </a>
                            <?php if (session()->get('group') == 'superadmin') : ?>
                            <a class="" href="/">
                                <i class="fa fa-trash" id="<?= $b['bidang_kode'] ?>"></i>
                            </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="separator"></div>
                    <?php endforeach ?>
                    <!--end::Section-->
                    <!--end::Accordion-->
                    <!--begin::Apply-->
                    <a href="#" class="btn btn-xl btn-primary mt-5" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_tambah_bidang">Tambah
                        Bidang</a>
                    <!--end::Apply-->
                </div>
                <!--end::Job-->
            </div>
            <!--end::Content-->
            <!--begin::Sidebar-->
            <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                <!--begin::Careers about-->
                <div class="card bg-light">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Top-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <h2 class="fs-1 text-gray-800 w-bolder mb-6">About Us</h2>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <!-- <p class="fw-bold fs-6 text-gray-600">First, a disclaimer – the entire process of
                                writing a blog post often takes more than a couple of hours, even if you can type
                                eighty words as per minute and your writing skills are sharp.</p> -->
                            <table class="px-5">
                                <tbody class="fw-bold fs-4 text-gray-600 mb-2">
                                    <tr>
                                        <td><i class="fa fa-phone"></i></td>
                                        <td>:</td>
                                        <td>
                                            <?php if ($opd['opd_telp'] != true) {
                                                echo 'Telepon belum tersedia';
                                            } else {
                                                echo $opd['opd_telp'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-envelope"></i></td>
                                        <td>:</td>
                                        <td>
                                            <?php if ($opd['opd_email'] != true) {
                                                echo 'Email belum tersedia';
                                            } else {
                                                echo $opd['opd_email'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-address-card"></i></td>
                                        <td>:</td>
                                        <td>
                                            <?php if ($opd['opd_alamat'] != true) {
                                                echo 'Alamat belum tersedia';
                                            } else {
                                                echo $opd['opd_alamat'];
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end::Text-->
                        </div>
                        <!--end::Top-->

                        <!--begin::Link-->
                        <a href="#" class="link-primary fs-6 fw-bold">Explore
                            More</a>
                        <!--end::Link-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Careers about-->
            </div>
            <!--end::Sidebar-->
        </div>
        <!--end::Layout-->
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
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
        <!--end::Body-->
    </div>
    <!--end::Careers - List-->
    <!-- end::container -->