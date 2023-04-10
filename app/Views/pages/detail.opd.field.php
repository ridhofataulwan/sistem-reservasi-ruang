<?= $this->extend('layout/dashboard'); ?>
<?= $this->section('content'); ?>

<!-- Main :: Root #Layout -->
<!-- Sidebar #includes -->
<!-- Aside Sidebar #includes -->

<!--begin::Wrapper-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap mt-n5 mt-lg-0 me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="text-dark fw-bolder my-0 fs-2">
                    <?=
                    /**
                     * title digunakan sebagai header tiap halaman
                     * 
                     * header dapat diubah melalui controller
                     */
                    $title;
                    ?>
                </h1>
                <!--end::Heading-->
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
            <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
                <!--begin::Aside mobile toggle-->
                <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Logo-->
                <a href="<?= base_url() ?>" class="d-flex align-items-center">
                    <img alt="Logo" src="/assets/media/logos/logo-demo7.svg" class="h-30px" />
                </a>
                <!--end::Logo-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <!--begin::Row-->
            <?php echo $this->include('/includes/dashboard/card/header.list.php'); ?>
            <!-- list.reservasi.php -->
            <?php echo $this->include('/includes/dashboard/card/detail/detail.opd.php'); ?>
            <!-- end hello.user.php -->
            <!--end::Row-->
            <!--end::Container-->
        </div>
    </div>
    <!--end::Content-->

    <!--    
            Footer      #layout
            End Root    #layout  
            Drawers     #layout
            end::Main
            Scrolltop   #layout
        -->

    <!-- Begin::Modals -->
    <?php
    // upgrade plan, invite friends, create app, users search, 
    echo $this->include('/includes/dashboard/modals/tambah.acara.php');
    echo $this->include('/includes/dashboard/modals/tambah.bidang.php');
    ?>
    <!--end::Modals-->
    <?= $this->endSection('content'); ?>