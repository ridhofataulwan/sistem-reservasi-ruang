<!--begin::Container-->
<div class="pb-0 bgi-position-y-center bgi-no-repeat mb-10"
    style="background-size: auto calc(100% + 10rem); background-position-x: 100%;" id="kt_content_container">
    <!--begin::Form-->
    <form id="" class="form d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

            <!--begin::Engage widget 1-->
            <div class="card h-md-100">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column flex-center">
                    <!--begin::Heading-->
                    <div class="mb-2">
                        <!--begin::Title-->
                        <h1 class=" fw-bold text-gray-800 text-center lh-lg">Detail Acara
                            <br>
                            <span class="fw-boldest"><?= $acara['acara_nama']; ?></span>
                        </h1>
                        <!--end::Title-->
                        <!--begin::Illustration-->
                        <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 my-lg-12"
                            style="background-image:url('/assets/media/svg/illustrations/easy/1.svg')"></div>
                        <!--end::Illustration-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Links-->
                    <div class="text-center">
                        <!--begin::Link-->
                        <a href="/acara/update/<?= $acara['acara_id']; ?>" class="btn btn-sm btn-primary me-2"
                            href="">Sunting</a>
                        <!--end::Link-->
                        <!--begin::Link-->
                        <a class=" btn btn-sm btn-danger" href="/acara/delete/<?= $acara['acara_id']; ?>"
                            onclick="return confirm('Apakah anda yakin akan menghapus acara ini?');">Hapus</a>
                        <!--end::Link-->
                    </div>
                    <!--end::Links-->

                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 1-->

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
                    <select disabled class="form-select mb-2" data-control="select2" data-hide-search="true"
                        data-placeholder="Select an option" id="">
                        <option></option>
                        <option value="<?= $acara['status_acara_kode']; ?>" selected="selected">
                            <?= $acara['status_acara_nama']; ?></option>
                    </select>
                    <!--end::Select2-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set Status Acara.</div>
                    <!--end::Description-->
                    <!--begin::Datepicker-->
                    <div class="d-none mt-10">
                        <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select publishing
                            date and time</label>
                        <input class="form-control" id="kt_ecommerce_add_product_status_datepicker"
                            placeholder="Pick date &amp; time" />
                    </div>
                    <!--end::Datepicker-->
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
                                    <label class="form-label">Nama Acara</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" disabled style="background-color: #fff;" name="product_name"
                                        class="form-control mb-2" placeholder="Product name"
                                        value="<?= $acara['acara_nama']; ?>" />
                                    <!--end::Input-->

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Nama Penanggung Jawab</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" disabled style="background-color: #fff;" name="product_name"
                                        class="form-control mb-2" placeholder="Product name"
                                        value="<?= $acara['nama']; ?>" />
                                    <!--end::Input-->

                                </div>
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Jumlah Peserta</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" disabled style="background-color: #fff;" name="product_name"
                                        class="form-control mb-2" placeholder="Product name"
                                        value="<?= $acara['acara_jumlah_peserta']; ?>" />
                                    <!--end::Input-->
                                </div>

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Jenis Acara</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select disabled style="background-color: #fff; color:black;"
                                        class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
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
                                    <label class="form-label">Keterangan</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <div id="" name="" class="text-left min-h-200px mb-2">
                                        <textarea disabled style="text-align:left;background-color:#fff;" name="" id=""
                                            class="form-control form-control-left" cols="30"
                                            rows="10"><?= $acara['acara_keterangan']; ?></textarea>
                                    </div>
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">
                                    </div>
                                    <!--end::Description-->
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