<!--begin::Container-->
<div class="pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%;" id="kt_content_container">
    <!--begin::Form-->
    <form action="/acara/update/<?= $acara['acara_id']; ?>" method="POST" class="form d-flex flex-column flex-lg-row">
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
                    <!-- <div class="card-toolbar">
                        <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status">aa
                        </div>
                    </div> -->
                    <!--begin::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select name="status_acara_kode" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="">
                        <option></option>
                        <option value="1" selected="selected">Belum Selesai</option>
                        <option value="2">Selesai</option>
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
                                    <label class="required form-label">Nama Acara</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" style="background-color: #fff;" name="acara_nama" class="form-control mb-2" placeholder="Product name" value="<?= $acara['acara_nama']; ?>" />
                                    <!--end::Input-->

                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Jumlah Peserta</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" style="background-color: #fff;" name="acara_jumlah_peserta" class="form-control mb-2" placeholder="Product name" value="<?= $acara['acara_jumlah_peserta']; ?>" />
                                    <!--end::Input-->
                                </div>

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Jenis Acara</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select style="background-color: #fff; color:black;" name="jenis_acara_kode" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
                                        <option class value="<?= $acara['jenis_acara_kode'] ?>" selected>
                                            <?= $acara['jenis_acara_nama'] ?></option>
                                        <?php foreach ($jenis_acara as $ja) : ?>
                                            <option value="<?= $ja['jenis_acara_kode']; ?>">
                                                <?= $ja['jenis_acara_nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--end::Select2-->

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="required form-label">Keterangan</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <div id="" name="" class="text-left min-h-200px mb-2">
                                        <textarea style="text-align:left;" name="acara_keterangan" id="" class="form-control form-control-left" cols="30" rows="10"><?= $acara['acara_keterangan']; ?></textarea>
                                    </div>
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Save Changes</span>
                                </button>
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