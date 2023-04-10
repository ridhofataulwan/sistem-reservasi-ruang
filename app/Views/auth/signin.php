<?= $this->extend('layout/auth'); ?>
<?= $this->section('content'); ?>

<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/assets/media/illustrations/sigma-1/14.png)">
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
                <form action="/signin" method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                    <!--begin::Heading-->
                    <div class="text-center mb-5">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Masuk ke Simaru</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Belum punya akun?
                            <a href="/signup" class="link-primary fw-bolder">Buat akun</a>
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Email / NIP</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-md form-control-solid" type="text" name="auth" autocomplete="off" onkeyup="countChars(this)" value="<?= old('auth') ?>"></input>
                        <label id="hint"></label>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                            <a href="/forgot-password" class="link-primary fs-6 fw-bolder">Lupa Password?</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-md form-control-solid" type="password" name="password" autocomplete="off" />
                        <!--end::Input-->
                    </div>
                    <div class="d-flex flex-column justify-content-center mb-5">
                        <div class="g-recaptcha pt-4 d-flex justify-content-center" data-callback="recaptchaCallback" data-sitekey="<?= env('site_key') ?>"></div>
                        <div id="captcha" class="text-danger text-center">Harap isi Captcha!</div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <!-- comment <div class="text-center"> -->
                    <!--begin::Submit button-->
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-secondary w-100 mb-3" disabled>
                        <span class="indicator-label">Masuk</span>
                        <span class="indicator-progress">Harap tunggu...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Submit button-->
                    <!--begin::Separator-->
                    <!-- comment <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div> -->
                    <!--end::Separator-->
                    <!--begin::Google link-->
                    <!-- comment <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            <img alt="Logo" src="/assets/media/svg/brand-logos/google-icon.svg"
                                class="h-20px me-3" />Continue with Google</a> -->
                    <!--end::Google link-->
                    <!--begin::Google link-->
                    <!-- comment <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            <img alt="Logo" src="/assets/media/svg/brand-logos/facebook-4.svg"
                                class="h-20px me-3" />Continue with Facebook</a> -->
                    <!--end::Google link-->
                    <!--begin::Google link-->
                    <!-- comment <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
                            <img alt="Logo" src="/assets/media/svg/brand-logos/apple-black.svg"
                                class="h-20px me-3" />Continue with Apple</a> -->
                    <!--end::Google link-->
                    <!--comment </div> -->
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->

    </div>
</div>
<!-- end Root  -->
<script>
    var hostUrl = "/assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="/assets/js/custom/authentication/sign-in/general.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<?= $this->endSection('content'); ?>