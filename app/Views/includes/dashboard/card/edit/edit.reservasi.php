<!--begin::Container-->
<div class="pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%;" id="kt_content_container">
    <!--begin::Form-->
    <form method="POST" action="/reservasi/update/" id="" class="form d-flex flex-column flex-lg-row">
        <!-- begin:input hidden -->
        <input type="hidden" name="reservasi_id" value="<?= $reservasi['reservasi_id'] ?>">
        <!-- end:input hidden -->
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Status-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Status</h2>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                    </div>
                    <!--begin::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="">
                        <option disabled value="<?= $reservasi['status_reservasi_kode'] ?>" selected="selected">
                            <?= $reservasi['status_reservasi_nama'] ?></option>
                        <option value="6">Dibatalkan</option>
                    </select>
                    <!--end::Select2-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set Status Acara.</div>
                    <!--end::Description-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Status-->



        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card body-->
                            <div class="card-body pt-3">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Penanggung Jawab</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" style="background-color: #fff;" name="product_name" class="form-control mb-2" disabled value="<?= $reservasi['nama']; ?>" />
                                    <!--end::Input-->
                                </div>

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Ruang</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="" name="ruang_kode">
                                        <option value="<?= $reservasi['ruang_kode'] ?>" selected>
                                            <?= $reservasi['ruang_nama'] ?>
                                        </option>
                                        <?php foreach ($ruang as $r) : ?>
                                            <option value="<?= $r['ruang_kode'] ?>"> <?= $r['ruang_nama'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--end::Select2-->

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Acara</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="" name="acara_id">
                                        <?php foreach ($acara as $a) : ?>
                                            <option value="<?= $a['acara_id'] ?>"> <?= $a['acara_nama'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--end::Select2-->

                                </div>
                                <!--end::Input group-->

                                <!-- datetime -->
                                <div class="row mb-10 fv-row">
                                    <div class="col">
                                        <label class="form-label">Reservasi Mulai</label>
                                        <div class="col-md-6"><input name="reservasi_mulai" type="time" class="form-control" value="<?= $reservasi['reservasi_mulai']; ?>"></div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Reservasi Berakhir</label>
                                        <div class="col-md-6"><input name="reservasi_berakhir" type="time" class="form-control" value="<?= $reservasi['reservasi_berakhir']; ?>"></div>
                                    </div>
                                </div>

                                <div class="row mb-10 fv-row">
                                    <label class="form-label">Tanggal Reservasi</label>
                                    <input type="date" name="reservasi_tanggal" value="<?= $reservasi['reservasi_tanggal'] ?>" class="form-control                                    ">
                                </div>

                                <!-- end datetime -->
                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label">Keterangan</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <div class="text-left min-h-200px mb-2">
                                        <textarea style="text-align:left;background-color:#fff;" name="reservasi_deskripsi" id="" class="form-control form-control-left" cols="30" rows="10"><?= $reservasi['reservasi_deskripsi']; ?></textarea>
                                    </div>
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7 mb-10">
                                    </div>
                                    <!--end::Description-->
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Simpan Perubahan</span>
                                    </button>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->


                    </div>
                </div>
                <!--end::Tab pane-->
            </div>

        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
</div>
<!--end::Container-->