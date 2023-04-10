<!--begin::Modal - Tambah acara-->
<div class="modal fade" id="kt_modal_tambah_reservasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="black" />
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
                    <h1 class="mb-3">Tambah Reservasi</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5">Jika acara tidak ditemukan, bisa dibuat di
                        <a href="/daftar-acara" class="link-primary fw-bolder">sini</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Separator-->
                <!-- <div class="separator d-flex flex-center mb-8">
                    <span class="text-uppercase bg-body fs-7 fw-bold text-muted px-3">OR</span>
                </div> -->
                <!--end::Separator-->
                <form method="POST" action="/reservasi/insert">
                    <!-- form input -->
                    <div class="mb-10">
                        <div class="mb-8">
                            <select id="reservasi_opd" class="form-select form-select-md form-select-solid" type="text"
                                data-control="select2" data-placeholder="Pilih OPD!" name="opd" autocomplete="off"
                                data-hide-search="true" required>
                                <option value='' selected>Pilih OPD!</option>
                                <?php if (isset($opd)) {
                                    foreach ($opd as $opd) : ?>
                                <option value=<?= $opd['opd_kode'] ?>><?= $opd['opd_nama'] ?></option>
                                <?php endforeach;
                                } ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col mb-8">
                                <select id="reservasi_gedung" class="form-select form-select-md form-select-solid"
                                    type="text" data-control="select2" data-placeholder="Pilih Gedung!" name="gedung"
                                    autocomplete="off" data-hide-search="true" required>
                                    <option value='' selected>Pilih OPD terlebih dahulu!</option>
                                </select>
                            </div>
                            <div class="col mb-8">
                                <select id="reservasi_ruang" class="form-select form-select-md form-select-solid"
                                    type="text" data-control="select2" data-placeholder="Pilih Ruang!" name="ruang_kode"
                                    autocomplete="off" data-hide-search="true" required>
                                    <option value='' selected>Pilih Gedung terlebih dahulu!</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Ruang-->
                        <!--begin::Acara-->
                        <div class="mb-8">
                            <select name="acara_id" class="form-select form-select-md form-select-solid" type="text"
                                data-control="select2" data-hide-search="true" required>
                                <option class value="" selected disabled>Acara</option>
                                <?php foreach ($acara as $a) : ?>
                                <option value="<?= $a['acara_id'] ?>"> <?= $a['acara_nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!--end::Acara -->
                        <!-- Begin Waktu -->
                        <div class="row mb-3">

                            <div class="col-md-6 px-2">
                                <!-- Begin waktu mulai -->
                                <span class="text-muted fs-7 my-3">
                                    Waktu Mulai
                                </span>
                                <input class="form-control form-control-solid" type="time" placeholder="waktu mulai"
                                    name="reservasi_mulai" required>
                            </div>
                            <div class="col-md-6 px-2">
                                <!-- Begin waktu mulai -->
                                <span class="text-muted fs-7 my-3">
                                    Waktu Berakhir
                                </span>
                                <input class="form-control form-control-solid" type="time" placeholder="waktu berakhir"
                                    name="reservasi_berakhir" required>
                            </div>
                        </div>
                        <!-- End Waktu -->
                        <!-- Begin Tanggal -->
                        <span class="text-muted fs-7 mb-8">
                            Tanggal Reservasi
                        </span>
                        <input class="form-control form-control-solid" type="date" placeholder="Tanggal"
                            name="reservasi_tanggal" required>
                        <!-- End Tanggal -->
                        <!--begin::Keterangan-->
                        <textarea class="form-control form-control-solid mt-3 mb-8" rows="3" placeholder="Keterangan"
                            name="reservasi_deskripsi" required></textarea>
                        <!--end::Keterangan-->
                    </div>
                    <!--begin::Notice-->
                    <div class="d-flex flex-stack">
                        <!--begin::Label-->
                        <div class="me-5 fw-bold">
                            <label class="fs-6">Cek terlebih dahulu</label>
                            <div class="fs-7 text-muted">Pastikan data reservasi yang dimasukkan sesuai dengan rencana
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