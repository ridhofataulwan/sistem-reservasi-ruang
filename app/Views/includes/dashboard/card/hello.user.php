<!--begin::Col-->
<div class="col-xl-4 mb-xl-10">
    <!--begin::Engage widget 3-->
    <div class="card bg-primary h-md-100">
        <!--begin::Body-->
        <div class="card-body d-flex flex-column pt-13 pb-14" style="justify-content: space-between;">
            <!--begin::Heading-->
            <div class="m-0">
                <!--begin::Title-->
                <h1 class="fw-bold text-white text-center lh-lg mb-9">Halo <?= session()->get('nama'); ?>
                    <br />
                    <span class="fw-boldest">Selamat Datang!</span>
                </h1>
                <!--end::Title-->
                <!--begin::Illustration-->
                <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" style="background-image:url('/assets/media/svg/illustrations/easy/3.svg')">
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Heading-->

            <!-- begin::Session Table for Example and Test-->
            <table class="table table-center table-sm text-gray-800 fw-bolder ">
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= session()->get('email'); ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= session()->get('nama'); ?></td>
                </tr>
                <tr>
                    <td>OPD - Bidang</td>
                    <td>:</td>
                    <td><?= session()->get('bidang_kode'); ?>
                        <?php if (session()->get('bidang_kode') == false) { ?>
                            <a class="text-white" style="font-weight: bold;">Pilih OPD - Bidang</a>
                        <?php  } ?>
                    </td>
                </tr>

            </table>
            <!-- end::Session Table for Example and Test-->
            <a class="btn btn-sm bg-white btn-color-dark text-gray-800 fw-bolder " href="/signout">Sign
                Out</a>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Engage widget 3-->
</div>
<!--end::Col-->