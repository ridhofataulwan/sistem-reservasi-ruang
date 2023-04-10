<!--begin::Col-->
<div class="col-xl-12 mb-xl-10">
    <!--begin::Tables Widget 5-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Daftar Users</span>
                <span class="text-muted mt-1 fw-bold fs-7">Terdapat <?= count($listusers) ?> Users</span>
            </h3>
            <div class="bottom-end d-flex align-items-center">
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" name="search" id="search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Cari">
                </div>
            </div>
            <!-- <div class="card-toolbar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4 me-1 active" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">Month</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
                    </li>
                </ul>
            </div> -->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 datatable">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="border-0">
                            <th class="p-0 w-50px"></th>
                            <th class="p-0 min-w-150px"></th>
                            <th class="p-0 min-w-140px"></th>
                            <th class="p-0 min-w-110px"></th>
                            <?php if (session()->get('groups') == 'superadmin') { ?>
                                <th class="p-0 min-w-50px"></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php foreach ($listusers as $users) : ?>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="/assets/media/logos/header.svg" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="/profile/<?= $users['nip'] ?>" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                        <?= $users['nama']; ?>
                                    </a>
                                    <span class="text-muted fw-bold d-block"><?= $users['bidang_nama'] ?> | <?= $users['opd_nama'] ?></span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    <?= $users['email']; ?>
                                </td>
                                <td class="text-end">
                                    <?php
                                    if ($users['active'] == 1) :
                                    ?>
                                        <span class="badge badge-light-success">Activated</span>
                                    <?php else : ?>
                                        <span class="badge badge-light-warning">Deactivated</span>
                                    <?php endif; ?>
                                </td>
                                <?php if (session()->get('group') == 'superadmin') { ?>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu shadow-sm shadow-sm">
                                                <?php if ($users['group_id'] != 2) { ?>
                                                    <li> <a href="#" class="dropdown-item set-to-admin" id="<?= $users['nip']; ?>">
                                                            <i class="bi bi-check-circle-fill text-primary"></i>
                                                            <span class="menu-title text-primary">Set To Admin</span>
                                                        </a></li>
                                                <?php } else if ($users['group_id'] == 2) { ?>
                                                    <li> <a href="#" class="dropdown-item set-to-user" id="<?= $users['nip']; ?>">
                                                            <i class="bi bi-check-circle-fill text-primary"></i>
                                                            <span class="menu-title text-primary">Set To User</span>
                                                        </a></li>
                                                <?php } ?>
                                                <li><a href="/profile/delete/<?= $users['nip'] ?>" class="dropdown-item" onclick="return confirm('Apakah Anda yakin akan menghapus user ini?')">
                                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                                        <span class="menu-title text-danger">Delete</span>
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Tables Widget 5-->
</div>
<!--end::Col-->