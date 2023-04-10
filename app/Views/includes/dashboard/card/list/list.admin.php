<!--begin::Col-->
<div class="col-xl-12 mb-xl-10">
    <!--begin::Tables Widget 5-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Daftar Admin</span>
                <span class="text-muted mt-1 fw-bold fs-7">Terdapat <?= count($admins) ?> Admin</span>
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
                        <tr class="fw-bolder">
                            <th class="m-2 w-50px"></th>
                            <th class="min-w-150px">Nama</th>
                            <th class="min-w-140px text-center">Email</th>
                            <th class="min-w-110px text-center">Status</th>
                            <th class="min-w-50px text-center">Aksi</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php foreach ($admins as $admin) : ?>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="/assets/media/logos/header.svg" class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td width="50%">
                                    <a href="/profile/<?= $admin['nip'] ?>" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                        <?= $admin['nama']; ?>
                                    </a><br>
                                    <span class="text-muted fw-bold"><?= $admin['bidang_nama'] ?> | </span><span class="text-muted fw-bold"><?= $admin['opd_nama'] ?></span>
                                </td>
                                <td class="text-center text-muted fw-bold">
                                    <?= $admin['email']; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($admin['active'] == 1) :
                                    ?>
                                        <span class="badge badge-light-success">Activated</span>
                                    <?php else : ?>
                                        <span class="badge badge-light-warning">Deactivated</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type=" button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu shadow-sm">
                                            <li> <a href="#" class="dropdown-item set-to-user" id="<?= $admin['nip']; ?>">
                                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                                    <span class="menu-title text-primary">Set To User</span>
                                                </a></li>
                                            <li><a href="/profile/delete/<?= $admin['nip'] ?>" class="dropdown-item" onclick="return confirm('Apakah Anda yakin akan menghapus user ini?')">
                                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                                    <span class="menu-title text-danger">Delete</span>
                                                </a></li>
                                        </ul>
                                    </div>
                                </td>
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