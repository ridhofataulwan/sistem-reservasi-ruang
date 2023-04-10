<?= $this->extend('layout/auth'); ?>
<?= $this->section('content'); ?>
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Password reset -->
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
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- begin::Alert Message-->
                <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('alertClass') ?>">
                    <?= session()->getFlashdata('message'); ?>
                </div>
                <?php endif; ?>
                <!-- end::Alert Message-->
                <!--begin::Form-->
                <form action="/forgot-password" method="POST" class="form w-100" novalidate="novalidate"
                    id="kt_password_reset_form">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Lupa Password ?</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Masukan email Anda untuk mengubah password!</div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
                        <input class="form-control form-control-solid" type="email" placeholder="" name="email"
                            autocomplete="off" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="button" class="btn btn-lg btn-primary fw-bolder me-4"
                            id="kt_password_reset_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Harap tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <a href="/signin" class="btn btn-lg btn-light-primary fw-bolder">Batal</a>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Password reset-->
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
<script src="/assets/js/custom/authentication/password-reset/password-reset.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<?= $this->endSection('content'); ?>