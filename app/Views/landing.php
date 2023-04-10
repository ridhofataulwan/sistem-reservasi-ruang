<!-- 
    * https://preview.keenthemes.com//index.html
 -->
<?= $this->extend('layout/auth'); ?>
<?= $this->section('content'); ?>

<div class="d-flex flex-column flex-root"
    style="background-image: url('/assets/media/patterns/pattern-1.jpg');background-size :cover;">
    <!-- Begin page -->
    <div class="page launcher sidebar-enabled d-flex flex-row flex-column-fluid me-lg-5" id="kt_page">
        <!-- Begin Content -->
        <div class=" d-flex flex-row-fluid">
            <!-- Begin container -->
            <div class="d-flex flex-column flex-row-fluid align-items-center"
                style="display: flexc;justify-content:center;align-items:center;">
                <!-- Begin Menu -->
                <div class="d-flex flex-column flex-column-fluid mb-5 mb-lg-10">
                    <!-- Begin brand -->
                    <div class="d-flex flex-center py-10 mb-10 mb-lg-0">
                        <!-- Begin sidebar toggle -->
                        <!-- <div class="btn btn-icon btn-active-color-primary w-30px h-30px d-lg-none me-4 ms-n15"
                            id="kt_sidebar_toggle"> -->
                        <!-- Begin svg icon -->
                        <!-- <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 24 24"
                                fill="none">
                                <path
                                    d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z">
                                </path>
                                <path opacity="0.3"
                                    d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                    fill="black">
                                </path>
                            </svg>
                        </span> -->
                        <!-- end svg icon -->
                        <!-- </div> -->
                        <!-- end sidebar toggle -->
                        <!-- Begin Logo -->
                        <a href=" /">
                            <img style="vertical-align: middle;box-sizing: border-box;"
                                src="/assets/media/logos/landing-logo.svg" alt="Logo" class="h-75px h-lg-80px">
                        </a>
                        <!-- end logo -->
                    </div>
                    <!-- end Brand -->
                    <!-- Begin Row -->

                    <div class="row g-7 w-xxl-850px">
                        <!--begin::Col-->
                        <div class="col-xxl-5">
                            <!--begin::Card-->
                            <div class="card border-0 shadow-none h-lg-100" style="background-color: #A838FF">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-column pb-0 pt-15">
                                    <!--begin::Wrapper-->
                                    <div class="px-5 mb-5">
                                        <!--begin::Heading-->
                                        <h3 class="text-white mb-2 fw-boldest text-center text-uppercase mb-10">
                                            Panduan Singkat</h3>
                                        <!--end::Heading-->
                                        <!--begin::List-->
                                        <div class="mb-3" style="width:fit-content; height:30%;overflow-y: visible;">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                <!-- <span class="menu-bullet fw-bolder">
                                                    <span class="bullet bullet-dot mx-2"
                                                        style="background: white;"></span>
                                                </span> -->
                                                <!--end::Svg Icon-->
                                                <!-- <span class="text-light">Hallo</span> -->
                                                <ul class="text-light ml-0">
                                                    <li class="py-2">Anda bisa akses Dashboard Simaru dengan sign in
                                                        terlebih dahulu
                                                    </li>
                                                    <li class="py-2">Login bisa akses melalui halaman <a href="/signin"
                                                            class="text-active fw-bold">sign in</a></li>
                                                    <li class="py-2">Jika belum memiliki akun silahkan mendaftar sesuai
                                                        OPD masing-masing melalui <a href="/signup"
                                                            class="text-active fw-bold">sign up</a></li>
                                                    <li class="py-2">Kalendar Reservasi bisa dilihat di halaman <a
                                                            href="/home/calendar" class="text-active fw-bold">kalendar
                                                            reservasi</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::List-->
                                        <!--begin::Link-->
                                        <!-- <a href="/home/dashboard"
                                            class="btn btn-hover-rise text-white bg-white bg-opacity-10 text-uppercase fs-7 fw-bolder">Go
                                            To Dashboard</a> -->
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Illustrations-->
                                    <div style="margin-top: -50px;">
                                        <img class="mw-100 h-225px mx-auto mb-lg-n18"
                                            src="/assets/media/illustrations/sigma-1/20.png">
                                    </div>
                                    <!--end::Illustrations-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-7">
                            <!--begin::Row-->
                            <div class="row g-lg-7">
                                <?php if (session()->get('nip') == null) : ?>
                                <!--begin::Col-->
                                <div class="col-sm-6">
                                    <!--begin::Card-->
                                    <a href="/signin" class="card border-0 shadow-none min-h-200px mb-7"
                                        style="background-color: #F9666E">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-column flex-center text-center">
                                            <!--begin::Illustrations-->
                                            <img class="mw-100 h-100px mb-7 mx-auto"
                                                src="/assets/media/illustrations/sigma-1/4.png">
                                            <!--end::Illustrations-->
                                            <!--begin::Heading-->
                                            <h4 class="text-white fw-bolder text-uppercase">Masuk</h4>
                                            <!--end::Heading-->
                                        </div>
                                        <!--end::Card body-->
                                    </a>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6">
                                    <!--begin::Card-->
                                    <a href="/signup" class="card border-0 shadow-none min-h-200px mb-7"
                                        style="background-color: #35D29A">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-column flex-center text-center">
                                            <!--begin::Illustrations-->
                                            <img class="mw-100 h-100px mb-7 mx-auto"
                                                src="/assets/media/illustrations/sigma-1/5.png">
                                            <!--end::Illustrations-->
                                            <!--begin::Heading-->
                                            <h4 class="text-white fw-bolder text-uppercase">Daftar Akun</h4>
                                            <!--end::Heading-->
                                        </div>
                                        <!--end::Card body-->
                                    </a>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <?php else : ?>
                            <!--begin::Col-->
                            <div class="col-sm-6">
                                <!--begin::Card-->
                                <a href="/dashboard" class="card border-0 shadow-none min-h-200px"
                                    style="background-color: #F9666E">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-column flex-center text-center">
                                        <!--begin::Illustrations-->
                                        <img class="mw-100 h-100px mb-7 mx-auto"
                                            src="/assets/media/illustrations/sigma-1/4.png">
                                        <!--end::Illustrations-->
                                        <!--begin::Heading-->
                                        <h4 class="text-white fw-bolder text-uppercase">Dashboard</h4>
                                        <!--end::Heading-->
                                    </div>
                                    <!--end::Card body-->
                                </a>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-sm-6">
                                <!--begin::Card-->
                                <a href="/reservasi/saya" class="card border-0 shadow-none min-h-200px mb-7"
                                    style="background-color: #35D29A">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-column flex-center text-center">
                                        <!--begin::Illustrations-->
                                        <img class="mw-100 h-100px mb-7 mx-auto"
                                            src="/assets/media/illustrations/sigma-1/8.png">
                                        <!--end::Illustrations-->
                                        <!--begin::Heading-->
                                        <h4 class="text-white fw-bolder text-uppercase">Reservasi Saya</h4>
                                        <!--end::Heading-->
                                    </div>
                                    <!--end::Card body-->
                                </a>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <?php endif; ?>
                        <!--begin::Card-->
                        <div class="card border-0 shadow-none min-h-200px" style="background-color: #D5D83D">
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-center flex-wrap">
                                <!--begin::Illustrations-->
                                <img class="mw-100 h-200px me-4 mb-5 mb-lg-0"
                                    src="/assets/media/illustrations/sigma-1/17.png">
                                <!--end::Illustrations-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-center align-items-md-start flex-grow-1">
                                    <!--begin::Heading-->
                                    <h3 class="text-gray-900 fw-boldest text-uppercase mt-3 mb-3">Kalendar Reservasi
                                    </h3>
                                    <!--end::Heading-->
                                    <!--begin::List-->
                                    <div class="text-gray-800 mb-5 text-center text-md-start">Explore our
                                        powerful
                                        <br>documentation
                                    </div>
                                    <!--end::List-->
                                    <!--begin::Link-->
                                    <a href="/home/calendar"
                                        class="btn btn-hover-rise text-gray-900 text-uppercase fs-7 fw-bolder"
                                        style="background-color: #EBEE51">Lihat Lebih Lengkap</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                </div>
                <!-- end row -->
            </div>
            <!-- end menu -->
        </div>
        <!-- Begin content -->

    </div>
    <!-- end page -->
</div>
<!-- end root -->
<!-- end main -->

<!-- begin js -->
<script>
var hostUrl = "/assets/";
</script>
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script type="text/javascript" id="">
! function(b, e, f, g, a, c, d) {
    b.fbq || (a = b.fbq = function() {
            a.callMethod ? a.callMethod.apply(a, arguments) : a.queue.push(arguments)
        }, b._fbq || (b._fbq = a), a.push = a, a.loaded = !0, a.version = "2.0", a.queue = [], c = e
        .createElement(f), c.async = !0, c.src = g, d = e.getElementsByTagName(f)[0], d.parentNode
        .insertBefore(
            c, d))
}(window, document, "script", "https://connect.facebook.net/en_US/fbevents.js");
fbq("init", "738802870177541");
fbq("track", "PageView");
</script>
<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=738802870177541&amp;ev=PageView&amp;noscript=1"></noscript>
<script type="text/javascript" id="">
try {
    (function() {
        var a = google_tag_manager["GTM-5FS8GGP"].macro(8);
        a = "undefined" == typeof a ? google_tag_manager["GTM-5FS8GGP"].macro(9) : a;
        var b = new Date;
        b.setTime(b.getTime() + 18E5);
        var c = "gtm-session-start";
        b = b.toGMTString();
        var d = "/",
            e = ".keenthemes.com";
        document.cookie = c + "\x3d" + a + "; Expires\x3d" + b + "; domain\x3d" + e + "; Path\x3d" + d
    })()
} catch (a) {};
</script>
<script type="text/javascript" id="">
(function() {
    var a = google_tag_manager["GTM-5FS8GGP"].macro(10) - 0 + 1,
        b = ".keenthemes.com";
    document.cookie = "damlPageCount\x3d" + a + ";domain\x3d" + b + ";path\x3d/;"
})();
</script>
<script src="/assets/js/scripts.bundle.js"></script>
<script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/type.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/budget.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/settings.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/team.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/targets.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/files.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/complete.js"></script>
<script src="/assets/js/custom/utilities/modals/create-project/main.js"></script>
<script src="/assets/js/custom/utilities/modals/create-account.js"></script>

<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
    style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1002"></defs>
    <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
    <path id="SvgjsPath1004" d="M0 0 "></path>
</svg>
<defs id="SvgjsDefs1002"></defs>
<polyline id="SvgjsPolyline1003" points="0,0"></polyline>
<path id="SvgjsPath1004" d="M0 0 "></path>
<input type="file" multiple="multiple" class="dz-hidden-input" tabindex="-1"
    style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
<input type="file" multiple="multiple" class="dz-hidden-input" tabindex="-1"
    style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
<?= $this->endSection('content'); ?>