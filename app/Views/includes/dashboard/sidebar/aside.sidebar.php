<!--begin::Footer-->
<div class="aside-footer d-flex flex-column align-items-center flex-column-auto" id="kt_aside_footer">
    <!--begin::User-->
    <div class="d-flex align-items-center mb-10" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <!-- <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            Validasi
        </button> -->
        <!-- <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="click" data-kt-menu-overflow="true"
            data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
            data-bs-dismiss="click" title="Profile Pengguna">
            <img src="/assets/media/avatars/300-1.jpg" alt="image" />
        </div> -->
        <div class="btn-group">
            <button type="button" class="btn btn-sm dropdown-toogle cursor-pointer symbol symbol-40px"
                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" title="Profile Pengguna">
                <img src="/assets/media/avatars/300-1.jpg" alt="image" />
            </button>
            <?= $this->include('/includes/dashboard/sidebar/menu/user.account.menu.php'); ?>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::User-->
</div>
<!--end::Footer-->
</div>
<!--end::Primary-->

<!--begin::Secondary-->
<div class="aside-secondary d-flex flex-row-fluid">
    <!--begin::Workspace-->
    <div class="aside-workspace my-5 p-5" id="kt_aside_wordspace">
        <div class="d-flex h-100 flex-column">
            <!--begin::Wrapper-->
            <div class="flex-column-fluid hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="true"
                data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_aside_wordspace"
                data-kt-scroll-dependencies="#kt_aside_secondary_footer" data-kt-scroll-offset="0px">
                <!--begin::Tab content-->
                <div class="tab-content">
                    <?php
                    include('aside.sidebar.dashboard.php');
                    ?>
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Footer-->
            <div class="flex-column-auto pt-10 px-5" id="kt_aside_secondary_footer">
                <a href="/signout"
                    class="btn btn-bg-light btn-color-gray-600 btn-flex btn-active-color-primary flex-center w-100">
                    <span class="btn-label">Sign Out</span>
                </a>
            </div>
            <!--end::Footer-->
        </div>
    </div>
    <!--end::Workspace-->
</div>
<!--end::Secondary-->
<!--begin::Aside Toggle-->
<button
    class="btn btn-sm btn-icon bg-body btn-color-gray-700 btn-active-primary position-absolute translate-middle start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex"
    data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
    data-kt-toggle-name="aside-minimize" style="margin-bottom: 1.35rem">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
    <span class="svg-icon svg-icon-2 rotate-180">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
            <path
                d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                fill="black" />
        </svg>
    </span>
    <!--end::Svg Icon-->
</button>
<!--end::Aside Toggle-->
</div>
<!--end::Aside-->