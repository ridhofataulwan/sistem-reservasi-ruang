<!--begin::Modal - Tambah acara-->
<div class="modal fade" id="kt_modal_tambah_opd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <h1 class="mb-3">Tambah OPD</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5">If you need more info, please check out
                        <a href="#" class="link-primary fw-bolder">FAQ Page</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Separator-->
                <!-- <div class="separator d-flex flex-center mb-8">
                    <span class="text-uppercase bg-body fs-7 fw-bold text-muted px-3">OR</span>
                </div> -->
                <!--end::Separator-->
                <form method="POST" action="/opd/insert/">
                    <!-- form input -->
                    <div class="mb-10">
                        <!-- Begin::Kode OPD -->
                        <input class="form-control form-control-solid mb-8" type="text" placeholder="Kode OPD" name="opd_kode" required>
                        <!-- End::Kode OPD -->
                        <!-- Begin::Nama OPD -->
                        <input class="form-control form-control-solid mb-8" type="text" placeholder="Nama OPD" name="opd_nama" required>
                        <!-- End::Nama OPD -->
                        <!-- Begin::Email OPD -->
                        <input class="form-control form-control-solid mb-8" type="email" placeholder="Email OPD" name="opd_email" required>
                        <!-- End::Email OPD -->
                        <!-- Begin::Telp OPD -->
                        <input class="form-control form-control-solid mb-8" type="text" placeholder="Telp OPD" name="opd_telp" required>
                        <!-- End::Telp OPD -->
                        <!-- Begin::Telp OPD -->
                        <input class="form-control form-control-solid mb-8" type="text" placeholder="Alamat OPD" name="opd_alamat" required>
                        <!-- End::Telp OPD -->
                    </div>
                    <!--begin::Notice-->
                    <div class="d-flex flex-stack">
                        <!--begin::Label-->
                        <div class="me-5 fw-bold">
                            <label class="fs-6">Adding Users by Team Members</label>
                            <div class="fs-7 text-muted">If you need more info, please check budget planning</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <button type="submit" class="btn btn-primary">Save
                                Changes</button>
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