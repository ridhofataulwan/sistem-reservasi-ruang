<!--begin::Modal - Tambah acara-->
<?php foreach ($listacara as $acara) : ?>
    <div class="modal fade" id="kt_modal_update_acara_<?= $acara['acara_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <h1 class="mb-3">Perbarui Acara</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-bold fs-5">Silakan perbarui acara Anda sebelum melakukan
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
                    <form method="POST" action="/acara/update/<?= $acara['acara_id'] ?>">
                        <!-- form input -->
                        <div class="mb-10">
                            <!-- input status acara -->
                            <input type="hidden" name="status_acara_kode" value="1">
                            <!-- Begin Nama Acara -->
                            <input class="form-control form-control-solid mb-8" type="text" placeholder="Nama Acara" name="acara_nama" value="<?= $acara['acara_nama'] ?>" required>
                            <!-- End Nama Acara -->
                            <!--begin::Jenis Acara-->
                            <div class="mb-8">
                                <select name="jenis_acara_kode" class="form-select form-select-solid form-select-md" data-control="select2" data-hide-search="true" required>
                                    <option class value="<?= $acara['jenis_acara_kode'] ?>" selected><?= $acara['jenis_acara_nama'] ?></option>
                                    <?php foreach ($jenis_acara as $ja) : ?>
                                        <option value="<?= $ja['jenis_acara_kode']; ?>">
                                            <?= $ja['jenis_acara_nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!--end::Jenis Acara-->
                            <!-- Begin Jumlah peserta -->
                            <input class="form-control form-control-solid mb-8" type="text" placeholder="Jumlah Peserta" name="acara_jumlah_peserta" value="<?= $acara['acara_jumlah_peserta'] ?>" required>
                            <!--begin::Keterangan-->
                            <textarea class="form-control form-control-solid mb-8" rows="3" placeholder="Keterangan" name="acara_keterangan" required><?= $acara['acara_keterangan'] ?></textarea>
                            <!--end::Keterangan-->
                        </div>
                        <!--begin::Notice-->
                        <div class="d-flex flex-stack">
                            <!--begin::Label-->
                            <div class="me-5 fw-bold">
                                <label class="fs-6">Cek terlebih dahulu</label>
                                <div class="fs-7 text-muted">Pastikan data yang dimasukkan sesuai dengan acara yang akan dilaksanakan</div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
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
<?php endforeach ?>
<!--end::Modal - Invite Friend-->