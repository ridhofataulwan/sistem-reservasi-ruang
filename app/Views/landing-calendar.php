<?php header("Refresh:300") ?>
<!-- 
    * https://preview.keenthemes.com//index.html
 -->
<?= $this->extend('layout/auth'); ?>
<?= $this->section('content'); ?>

<div class="d-flex flex-column flex-root" style="background-image: url('/assets/media/patterns/pattern-1.jpg');background-size :cover;">
    <!-- Begin page -->
    <div class="page launcher sidebar-enabled flex flex-row flex-column-fluid me-lg-5" id="kt_page">
        <!-- Begin Content -->
        <div class="d-flex justify-content-center pt-10">
            <a class="mb-5 pt-10" href="/">
                <img style="vertical-align: middle;box-sizing: border-box;" src="/assets/media/logos/landing-logo.svg" alt="Logo" class="h-75px h-lg-80px mb-10 mb-lg-10">
            </a>
        </div>
        <div class="container mb-10 mb-lg-10 mt-0">
            <?php echo $this->include('/includes/dashboard/card/calendar.php'); ?>
        </div>

        <!-- end page -->
    </div>
    <!-- end root -->
    <!-- end main -->


    <?= $this->endSection('content'); ?>