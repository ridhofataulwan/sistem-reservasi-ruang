<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="/assets/media/avatars/300-1.jpg" alt="image" />
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <?= $this->include('includes/dashboard/card/profile/header.profile.php'); ?>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details View-->
        <?= $this->include('includes/dashboard/card/profile/profile.details.php'); ?>

        <!--end::details View-->

    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
<!-- commit -->