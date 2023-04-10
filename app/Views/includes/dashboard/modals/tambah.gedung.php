<!--begin::Modal - Tambah acara-->
<div class="modal fade" id="kt_modal_tambah_gedung" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Tambah Gedung</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5">Perlu menambah gedung terlebih dahulu sebelum melakukan
                        <a href="#" class="link-primary fw-bolder">Reservasi</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Separator-->
                <!-- <div class="separator d-flex flex-center mb-8">
                    <span class="text-uppercase bg-body fs-7 fw-bold text-muted px-3">OR</span>
                </div> -->
                <!--end::Separator-->
                <form method="POST" action="/gedung/insert">
                    <!-- form input -->
                    <div class="mb-10">
                        <!-- Begin::Kode Gedung -->
                        <input class="form-control form-control-solid mb-8" type="text" placeholder="Kode Gedung" name="gedung_kode">
                        <!-- End::Kode Gedung -->
                        <!-- Begin::Nama Gedung -->
                        <input class="form-control form-control-solid mb-8" type="text" placeholder="Nama Gedung" name="gedung_nama">
                        <!-- End::Nama Gedung -->
                        <!--begin::OPD-->
                        <div class="mb-8">
                            <select name="opd_kode" class="form-select form-select-solid form-select-md" data-control="select2" data-hide-search="true">
                                <option class value="" selected disabled>OPD Gedung</option>
                                <?php
                                if (session()->get('group') == 'superadmin') {
                                    foreach ($opd as $opd) : ?>
                                        <option value="<?= $opd['opd_kode']; ?>">
                                            <?= $opd['opd_nama']; ?>
                                        </option>
                                    <?php endforeach;
                                } else { ?>
                                    <option value="<?= $opdAdmin['opd_kode']; ?>">
                                        <?= $opdAdmin['opd_nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <!--end::OPD-->
                    </div>
                    <!--begin::Notice-->
                    <div class="d-flex flex-stack">
                        <!--begin::Label-->
                        <div class="me-5 fw-bold">
                            <label class="fs-6">Cek terlebih dahulu</label>
                            <div class="fs-7 text-muted">Pastikan data yang dimasukkan sesuai dengan gedung yang ada
                            </div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </label>
                </form>
                <!--end::Switch-->
            </div>
            <!--end::Notice-->
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->
</div>
<!--end::Modal - Invite Friend-->