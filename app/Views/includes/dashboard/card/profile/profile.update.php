<!--begin::Basic info-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Sunting Profil</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form method="POST" action="/profile/update" class="form">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label for="nip" class="col-lg-4 col-form-label required fw-bold fs-6">NIP</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <div class="col-lg- fv-row">
                            <input id="nip" type="text" name="nip" require
                                class="form-control form-control-md form-control-solid mb-3 mb-lg-0" placeholder="NIP"
                                value="<?= session()->get('nip') ?>" />
                        </div>

                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label for="namaLengkap" class="col-lg-4 col-form-label required fw-bold fs-6">Nama Lengkap</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Col-->
                        <div class="col-lg- fv-row">
                            <input id="namaLengkap" type="text" name="nama" require
                                class="form-control form-control-md form-control-solid mb-3 mb-lg-0"
                                placeholder="Nama Lengkap" value="<?= $_SESSION['nama']; ?>" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="email" class="form-control form-control-md form-control-solid"
                            placeholder="Email" value="<?= $_SESSION['email']; ?>" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Bidang</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <!--begin::Input-->
                        <select id="kt_select_bidang" name="bidang_kode" aria-label="Pilih Bidang"
                            data-control="select2" data-placeholder="Select a language..."
                            class="form-select form-select-solid form-select-md">
                            <?php foreach ($bidang as $bidang) : ?>
                            <option value="<?= $bidang['bidang_kode'] ?>"><?= $bidang['bidang_nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">Nomor Telepon</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                            title="Phone number must be active"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="tel" name="telp" class="form-control form-control-md form-control-solid"
                            placeholder="Phone number" value="<?= $_SESSION['telp']; ?>" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!-- begin::label -->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Alamat</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <!--begin::Col-->
                        <textarea type="text" name="alamat" class="form-control form-control-md form-control-solid"
                            placeholder="Alamat" value=""><?= $_SESSION['alamat']; ?></textarea>
                    </div>
                    <!--end::Input group-->
                </div>
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="/profile" type="reset" class="btn btn-light btn-active-light-primary me-2">Batal</a>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                    Simpan Perubahan
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->
<!-- <script src="/assets/js/custom/index.js"></script> -->