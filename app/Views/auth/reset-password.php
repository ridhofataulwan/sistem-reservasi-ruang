<?= $this->extend('layout/auth'); ?>
<?= $this->section('content'); ?>
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - New password -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url(/assets/media/illustrations/sigma-1/14.png">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="<?= base_url() ?>" class="mb-12">
                <img alt="Logo" src="/assets/media/logos/simaru-1.svg" class="h-40px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- begin::Alert Message-->
                <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('alertClass') ?>">
                    <?= session()->getFlashdata('message'); ?>
                </div>
                <?php endif; ?>
                <!-- end::Alert Message-->
                <!--begin::Form-->
                <form action="reset-password/<?= $reset_hash ?>" method="POST" class="form w-100"
                    novalidate="novalidate" id="kt_new_password_form">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Masukan password baru</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Sudah mengatur ulang password anda ?
                            <a href="/signin" class="link-primary fw-bolder">Masuk di sini</a>
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6">Password</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-md form-control-solid" type="password"
                                    placeholder="" name="password" autocomplete="off" />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted">Gunakan 8 karakter atau lebih dengan campuran huruf, angka &amp;
                            simbol.
                        </div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
                        <input class="form-control form-control-md form-control-solid" type="password" placeholder=""
                            name="confirm-password" autocomplete="off" />
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-10">
                        <div class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1" />
                            <label class="form-check-label fw-bold text-gray-700 fs-6">Saya setuju &amp;
                                <a href="#" class="ms-1 link-primary">syarat dan ketentuan berlaku</a>.</label>
                        </div>
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Action-->
                    <div class="text-center">
                        <button type="button" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Harap tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->

    </div>
    <!--end::Authentication - New password-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>
var hostUrl = "/assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="/assets/js/custom/authentication/password-reset/new-password.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<?= $this->endSection('content'); ?>