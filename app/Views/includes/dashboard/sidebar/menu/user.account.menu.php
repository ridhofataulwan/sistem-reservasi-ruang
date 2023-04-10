  <!--begin::User account menu-->

  <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
      aria-labelledby="dropdownMenu2" data-kt-menu="true">
      <!--begin::Menu item-->
      <div class="menu-item px-3">
          <div class="menu-content d-flex align-items-center px-3">
              <!--begin::Avatar-->
              <div class="symbol symbol-50px me-5">
                  <img alt="Logo" src="/assets/media/avatars/300-1.jpg" />
              </div>
              <!--end::Avatar-->
              <!--begin::Username-->
              <div class="d-flex flex-column">
                  <div class="fw-bolder d-flex align-items-center fs-5">
                      <?= session()->get('nama'); ?>
                      <!-- <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span> -->
                  </div>
                  <a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?= session()->get('email'); ?></a>
              </div>
              <!--end::Username-->
          </div>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu separator-->
      <div class="separator my-2"></div>
      <!--end::Menu separator-->
      <!--begin::Menu item-->
      <div class="menu-item px-5">
          <a href="/profile" class="menu-link px-5">Profil Saya</a>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu item-->
      <div class="menu-item px-5 my-1">
          <a href="/opd" class="menu-link px-5">OPD Saya</a>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu item-->
      <div class="menu-item px-5">
          <a href="/signout" class="menu-link px-5">Sign Out</a>
      </div>
      <!--end::Menu item-->


  </div>
  <!--end::User account menu-->