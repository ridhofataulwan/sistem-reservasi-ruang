<?= $this->extend('layout/auth'); ?>
<?= $this->section('content'); ?>
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-up -->
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
            <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- begin::Alert Message-->
                <?php if (session()->getFlashdata('message')) : ?>
                    <div class="alert alert-<?= session()->getFlashdata('alertClass') ?>">
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>
                <!-- end::Alert Message-->
                <!--begin::Form-->
                <form action="auth/signupAttempt" method="POST" class="form w-100" novalidate="novalidate"
                    id="kt_sign_up_form">
                    <!--begin::Heading-->
                    <div class="mb-10 text-center">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Buat Akun</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Sudah memiliki akun?
                            <a href="/signin" class="link-primary fw-bolder">Masuk di sini</a>
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Action-->
                    <!-- comment <button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
                        <img alt="Logo" src="/assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Sign in
                        with Google</button> -->
                    <!--end::Action-->
                    <!--begin::Separator-->
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <!-- <span class="fw-bold text-gray-400 fs-7 mx-2"></span> -->
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <!--end::Separator-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">NIP</label>
                        <input class="form-control form-control-md form-control-solid" type="text" placeholder=""
                            name="nip" autocomplete="off" value="<?= old('nip') ?>" onkeyup="countChars(this)"
                            maxlength="16" />
                        <span id="hint"></span>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Email</label>
                        <input class="form-control form-control-md form-control-solid" type="email" placeholder=""
                            name="email" autocomplete="off" value="<?= old('email') ?>" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Nama</label>
                        <input class="form-control form-control-md form-control-solid" type="text" placeholder=""
                            name="nama" autocomplete="off" value="<?= old('nama') ?>" />
                    </div>
                    <!--end::Input group-->
                    <div class="row fv-row mb-7">
                        <!--begin::Col-->
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">OPD</label>
                            <select id="opd" class="form-select form-select-md form-select-solid" type="text"
                                data-control="select2" placeholder="" name="opd" autocomplete="off" />
                            <option disabled selected>Pilih OPD Anda</option>
                            <?php if (isset($opd)) {
                                foreach ($opd as $opd) : ?>
                            <option value=<?= $opd['opd_kode'] ?>><?= $opd['opd_nama'] ?></option>
                            <?php endforeach;
                            } ?>
                            </select>
                        </div>
                        <!--end::Col-->
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Bidang</label>
                            <select id="bidang" class="form-select form-select-md form-select-solid" type="text"
                                data-control="select2" placeholder="" name="bidang" autocomplete="off" />
                            <option disabled value='' selected>Pilih OPD terlebih dahulu!</option>
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Alamat</label>
                        <input class="form-control form-control-md form-control-solid" type="text" placeholder=""
                            name="alamat" autocomplete="off" value="<?= old('alamat') ?>" />
                    </div>
                    <!--end::Input group-->
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
                                    placeholder="" name="password" autocomplete="off"" />
                                <span class=" btn btn-sm btn-icon position-absolute translate-middle top-50 end-0
                                    me-n2" data-kt-password-meter-control="visibility">
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
                        <div class="text-muted">Gunakan 8 karakter atau lebih dengan kombinasi huruf, angka, &amp;
                            simbol.
                        </div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
                        <input class="form-control form-control-md form-control-solid" type="password" placeholder=""
                            name="pass_confirm" autocomplete="off" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class=" fv-row mb-10">
                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1" />
                            <span class="form-check-label fw-bold text-gray-700 fs-6">Saya sudah mengisi data diri
                                dengan benar.</span>
                        </label>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button id="kt_sign_up_submit" type="submit" class="btn btn-lg btn-primary">
                            Submit
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Sign-up-->
</div>
<!--end::Root-->
<!--end::Main-->
<!-- begin::Javascript Ajax Select Option -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#opd').change(function() {
        let opd_kode = $(this).val();
        console.log(opd_kode);
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/select-bidang",
            data: {
                opd_kode: opd_kode
            },
            success: function(response) {
                $('#bidang').html(response)
                console.log(response);
            }
        })
    })
})
</script>
<!-- end::Javascript Ajax Select Option -->
<!--begin::Javascript-->
<script>
var hostUrl = "/assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="/assets/js/custom/authentication/sign-up/general.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<?= $this->endSection('content'); ?>