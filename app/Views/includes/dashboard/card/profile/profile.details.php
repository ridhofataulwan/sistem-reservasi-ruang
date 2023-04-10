<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Detail Profil</h3>
        </div>
        <!--end::Card title-->
        <!--begin::Action-->
        <?php if ($_SESSION['nip'] == $user['nip']) : ?>
        <button class="btn btn-primary align-self-center" id="kt_button_editprofile">Edit
            Profil</button>
        <?php endif; ?>
        <!--end::Action-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card p-9">
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">NIP</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-gray-800">
                    <?= $user['nip']; ?>
                </span>
            </div>
            <!--end::Col-->
        </div>
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Nama Lengkap</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-gray-800">
                    <?= $user['nama']; ?>
                </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">*Departemen</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-gray-800">
                    <?= $user['opd_nama']; ?>
                </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Bidang</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-gray-800">
                    <?= $user['bidang_nama']; ?>
                </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Email
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                    title="Email teraktivasi"></i></label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                <span class="fw-bolder fs-6 text-gray-800 me-2">
                    <?= $user['email']; ?>
                </span>
                <span class="badge badge-success">Verified</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Telp</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary">
                    <?= $user['telp']; ?>
                </a>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Alamat
                <!-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" -->
                <!-- title="Country of origination"></i> -->
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-gray-800">
                    <?= $user['alamat']; ?>
                </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--end::Input group-->
        <!--begin::Notice-->
        <!-- <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6"> -->
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <!-- <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                </svg>
            </span> -->
        <!--end::Svg Icon-->
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <!-- <div class="d-flex flex-stack flex-grow-1"> -->
        <!--begin::Content-->
        <!-- <div class="fw-bold">
                    <h4 class="text-gray-900 fw-bolder">We need your attention!</h4>
                    <div class="fs-6 text-gray-700">Your payment was declined. To start using tools, please
                        <a class="fw-bolder" href="../../demo7/dist/account/billing.html">Add Payment
                            Method</a>.
                    </div>
                </div> -->
        <!--end::Content-->
        <!-- </div> -->
        <!--end::Wrapper-->
        <!-- </div> -->
        <!--end::Notice-->
    </div>
    <!--end::Card body-->
</div>
<script>
var profileDetails = document.getElementById('kt_profile_details_view');
document.getElementById('kt_button_editprofile').onclick = function() {
    // alert();
    profileDetails.innerHTML = `<?= $this->include('/includes/dashboard/card/profile/profile.update.php') ?>`;
}
</script>