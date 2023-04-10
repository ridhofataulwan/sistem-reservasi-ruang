<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <title>
        <?= $title; ?>
    </title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!-- script time -->
    <!-- Begin:: Font from Google API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- End:: Font from Google API -->
    <!-- start::custom.css -->
    <link rel="stylesheet" href="/assets/css/custom.css">
    <!-- end::custom.css -->
</head>
<!--end::Head-->
<!--begin::Body-->
<style>
    ::-webkit-scrollbar {
        width: 0px;
    }

    .container-fluid {
        margin-top: 5.375rem
    }
</style>

<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">

    <?php
    echo $this->include('/includes/dashboard/header.php');
    echo $this->include('/includes/dashboard/sidebar/sidebar.php');
    echo $this->include('/includes/dashboard/sidebar/aside.sidebar.php');
    echo $this->renderSection('content'); //Dashboard :: [Superadmin, admin, opd]
    echo $this->include('/includes/dashboard/footer/footer.php');
    echo $this->renderSection('drawers'); //Dashboard :: [Superadmin, admin, opd]
    echo $this->include('/includes/dashboard/scrolltop.php');
    ?>

    <!--begin::Javascript-->
    <script>
        var hostUrl = "/assets/";
    </script>

    <!--begin::Global Javascript Bundle(used by all pages)-->

    <?php if (!strpos($_SERVER['REQUEST_URI'], 'dashboard')) : ?>
        <script src="/assets/plugins/global/plugins.bundle.js"></script>
        <script src="/assets/js/scripts.bundle.js"></script>
    <?php endif; ?>

    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <!-- <script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script> -->
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>

    <script src="/assets/js/custom/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Calendar JS -->
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <!-- <script src="/assets/js/custom/apps/calendar/calendar.js"></script> -->
    <script src="/assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>
    <script src="/assets/js/custom/apps/file-manager/list.js"></script>
    <script src="/assets/js/widgets.bundle.js"></script>
    <script src="/assets/js/custom/widgets.js"></script>


    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->

</body>

<!-- start::custom.js -->
<script src="/assets/js/custom/custom.js"></script>
<!-- end::custom.js -->

</html>