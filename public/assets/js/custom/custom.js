const BASE_URL = 'http://localhost:8080/'

/**
 * -------------------------------------------------------------------
 * function disableSpellCheck()
 * -------------------------------------------------------------------
 * Deskripsi
 */
$(document).ready(function disableSpellCheck() {
    $('input').attr('spellcheck', 'false')
})

/**
 * -------------------------------------------------------------------
 * function datatable()
 * -------------------------------------------------------------------
 * Deskripsi
 */
$(document).ready(function datatable() {
    $(".datatable").dataTable();

    if ($('.datatable tr').length <= 2) {
        $('.datatable').css('min-height', '150px');
    }
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".datatable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
});

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
$(document).ready(function showDatetime() {
    $(".load-3").remove()
    if ($('#time').attr('id') == 'time' && $('#date').attr('id') == 'date') {
        var setTime = document.getElementById('time');
        var setDate = document.getElementById('date');

        var now = new Date();
        var h = now.getHours();
        var m = now.getMinutes();
        var s = now.getSeconds();
        var dname = now.getDay();
        var dnum = now.getDate();
        var mo = now.getMonth();
        var yr = now.getFullYear();

        Number.prototype.pad = function(digits) {
            for (var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
        }
        var week = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var Months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        var time = h.pad(2) + ':' + m.pad(2) + ':' + s.pad(2) + ' WIB';
        var date = week[dname] + ', ' + dnum.pad(2) + ' ' + Months[mo] + ' ' + yr.pad(4);

        setTime.innerHTML = time;
        setDate.innerHTML = date;
        setTimeout(showDatetime, 0);
    }
})

/**
 * -------------------------------------------------------------------
 * selectOpdDaftarRuang()
 * -------------------------------------------------------------------
 * Dijalankan ketika form input select gedung pada halaman Daftar Ruang
 * 
 * return Select Option Ruang pada halaman Daftar Ruang
 */
$(document).ready(function selectOpdDaftarRuang() {
    $('#opd').change(function() {
        let opd_kode = $(this).val();
        $('#list-ruang').html("<tr class='text-center'><td colspan='5'><div class='spinner-border text-primary' role='status' style='width: 5rem; height: 5rem;'><span class='visually-hidden'>Loading... </span></div></td></tr>");
        // Menampilkan Section OPD apa yang dipilih
        $.ajax({
                type: "POST",
                url: BASE_URL + "showOpd",
                data: {
                    opd_kode: opd_kode
                },
                success: function(response) {
                    $('#opd-section').html(response)
                        // Menampilkan Ruang Ketika memilih OPD
                    let opd_kode = $('#opd').val();
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "list-ruang-opd",
                        data: {
                            opd_kode: opd_kode
                        },
                        error: function() {
                            $('#list-ruang').html('<tr><td colspan="5" class="text-center"><span class="text-center text-active-danger">Ruang belum tersedia di OPD ini, harap hubungi Admin OPD</span></td></tr>');
                            $('#span-ruang').html('Terdapat 0 Ruang');
                        },
                        success: function(response) {
                            let obj = JSON.parse(response)
                            $('#list-ruang').html(obj.tr)
                            $('#span-ruang').html('Terdapat ' + obj.count + ' Ruang');
                        }
                    })
                }
            })
            // Menampilkan Option Select Gedung
        $.ajax({
            type: "POST",
            url: BASE_URL + "select-gedung",
            data: {
                opd_kode: opd_kode
            },
            success: function(response) {
                $('#gedung').html(response)
            }
        })
    })
})

/**
 * -------------------------------------------------------------------
 * selectGedungDaftarRuang()
 * -------------------------------------------------------------------
 * Dijalankan ketika form input select gedung pada halaman Daftar Ruang
 * 
 * return List Ruang pada halaman Daftar Ruang
 */
$(document).ready(function selectGedungDaftarRuang() {
    $('#gedung').change(function() {
        let gedung_kode = $(this).val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "list-ruang",
            data: {
                gedung_kode: gedung_kode
            },
            error: function() {
                $('#list-ruang').html('<tr><td colspan="5" class="text-center"><span class="text-center text-active-danger">Ruang belum tersedia di Gedung ini, harap hubungi Admin OPD</span></td></tr>');
                $('#span-ruang').html('Terdapat 0 Ruang');
            },
            success: function(response) {
                let obj = JSON.parse(response)
                $('#list-ruang').html(obj.tr);
                $('#span-ruang').html('Terdapat ' + obj.count + ' Ruang');
            }
        })
    })
})


/**
 * -------------------------------------------------------------------
 * selectOpdDaftarGedung()
 * -------------------------------------------------------------------
 * Dijalankan ketika form input select gedung pada halaman Daftar Gedung
 * 
 * return List Gedung pada halaman Daftar Gedung
 */
$(document).ready(function selectOpdDaftarGedung() {
    $('#opd').change(function() {
        let opd_kode = $(this).val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "list-gedung",
            data: {
                opd_kode: opd_kode
            },
            error: function() {
                $('#list-gedung').html('<tr><td colspan="5" class="text-center"><span class="text-center text-active-danger">Gedung belum tersedia di OPD ini, harap hubungi Admin OPD</span></td></tr>');
                $('#span-gedung').html('Terdapat 0 Gedung');
            },
            success: function(response) {
                let obj = JSON.parse(response)
                $('#list-gedung').html(obj.tr);
                $('#span-gedung').html('Terdapat ' + obj.count + ' Gedung');
            }
        })
    })
})


/**
 * -------------------------------------------------------------------
 * selectGedung()
 * -------------------------------------------------------------------
 * Dijalankan ketika form input select gedung pada halaman Daftar Ruang
 * 
 * return List Ruang pada halaman Daftar Ruang
 */
$(document).ready(function modalDetailRuang() {
        $(document).on('click', '.detail-ruang', function() {
            let ruang_kode = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "detail-ruang",
                data: {
                    ruang_kode: ruang_kode
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                }
            })
        })
    })
    // end::Javascript for Open Modal Detail Ruang

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript for Open Modal Edit Ruang    
$(document).ready(function modalEditRuang() {
        $(document).on('click', '.edit-ruang', function() {
            let ruang_kode = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "edit-ruang",
                data: {
                    ruang_kode: ruang_kode
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                    $('#select-gedung').html(obj.option);
                }
            })
        })
    })
    // end::Javascript for Open Modal Edit Ruang

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript for Open Modal Edit Gedung    
$(document).ready(function modalEditGedung() {
        $(document).on('click', '.edit-gedung', function() {
            let gedung_kode = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "edit-gedung",
                data: {
                    gedung_kode: gedung_kode
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                    $('#select-opd').html(obj.option);
                }
            })
        })
    })
    // end::Javascript for Open Modal Edit Gedung

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
$(document).ready(function setStatusAcara() {
    $(document).on('click', '.status-acara', function() {
        let acara_id = $(this).attr('id');
        let status_acara_kode = $(this).val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "set-status-acara",
            data: {
                acara_id: acara_id,
                status_acara_kode: status_acara_kode
            },
            success: function(response) {
                let obj = JSON.parse(response)
                $('#status-acara-' + acara_id).html(obj.switch_button)

            }
        })
    })
})

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript Ajax Select Option    
$(document).ready(function selectOpdReservasi() {
        $('#reservasi_opd').change(function() {
            let opd_kode = $(this).val();
            // Menampilkan Option Select Gedung
            $.ajax({
                type: "POST",
                url: BASE_URL + "select-gedung",
                data: {
                    opd_kode: opd_kode
                },
                success: function(response) {
                    $('#reservasi_gedung').html(response)

                    // Start Select Gedung
                    $('#reservasi_gedung').change(function() {
                        let gedung_kode = $(this).val();
                        // Menampilkan Option Select Gedung
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "select-ruang",
                            data: {
                                gedung_kode: gedung_kode
                            },
                            success: function(response) {
                                $('#reservasi_ruang').html(response)
                            }
                        })
                    })
                }
            })
        })
    })
    // end::Javascript Ajax Select Option

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript for Open Modal Edit OPD    
$(document).ready(function modalEditOpd() {
        $(document).on('click', '.edit-opd', function() {
            let opd_kode = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "edit-opd",
                data: {
                    opd_kode: opd_kode
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                }
            })
        })
    })
    // end::Javascript for Open Modal Edit OPD

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 */
// Start::Javascript for Open Modal Edit Reservasi    
$(document).ready(function modalEditReservasi() {
        $(document).on('click', '.edit-reservasi', function() {
            let reservasi_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "edit-reservasi",
                data: {
                    reservasi_id: reservasi_id
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                    $("#reservasi_acara").html(obj.optionAcara)
                    $("#reservasi_gedung").html(obj.optionGedung)
                    $("#reservasi_ruang").html(obj.optionRuang)
                    $("#reservasi_opd_edit").html(obj.optionOpd)
                }
            })
        })
    })
    // end::Javascript for Open Modal Edit Reservasi

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 */
// Start::Javascript for Select Opd Modal Edit Reservasi    
$(document).ready(function selectOpdModalEditReservasi() {
        $(document).on('change', '#reservasi_opd_edit', function() {
            let opd_kode = $('#reservasi_opd_edit').val();
            // Menampilkan Option Select Gedung
            $.ajax({
                type: "POST",
                url: BASE_URL + "select-gedung",
                data: {
                    opd_kode: opd_kode
                },
                success: function(response) {
                    $('#reservasi_gedung').html(response)
                    $('#reservasi_ruang').html('<option value="" selected disabled>Pilih Gedung</option>')
                }
            })
        })
    })
    // end::Javascript for Select Opd Modal Edit Reservasi

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 */
// Start::Javascript for Select Gedung Modal Edit Reservasi    
$(document).ready(function selectGedungModalEditReservasi() {
        $(document).on('change', '#reservasi_gedung', function() {
            let gedung_kode = $(this).val();
            // Menampilkan Option Select Gedung
            $.ajax({
                type: "POST",
                url: BASE_URL + "select-ruang",
                data: {
                    gedung_kode: gedung_kode
                },
                success: function(response) {
                    $('#reservasi_ruang').html(response)
                }
            })
        })
    })
    // end::Javascript for Select Gedung Modal Edit Reservasi


/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript for Open Modal Detail Reservasi    
$(document).ready(function modalDetailReservasi() {
        $(document).on('click', '.detail-reservasi', function() {
            let reservasi_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "detail-reservasi",
                data: {
                    reservasi_id: reservasi_id
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                }
            })
        })
    })
    // end::Javascript for Open Modal Detail Reservasi

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript for Respon Sweet Alert Approve Reservasi  
$(document).ready(function approveReservasi() {
        $(document).on('click', '.approve', function() {
            let reservasi_id = $(this).attr('id');
            let tr = document.getElementsByTagName('tr')
            tr.forEach(element => {
                element.setAttribute('class', 'reservasi')
            })
            $.ajax({
                type: "POST",
                url: BASE_URL + "approve-reservasi",
                data: {
                    reservasi_id: reservasi_id
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    obj.id.forEach(element => {
                        document.getElementById(element).setAttribute('class', obj.class)
                    });
                    Swal.fire({
                        text: obj.message,
                        icon: obj.icon,
                        buttonsStyling: false,
                        confirmButtonText: obj.icon == 'error' ? "Tetap validasi!" : "Oke",
                        showCancelButton: obj.icon == 'error' ? true : false,
                        cancelButtonText: "Cek terlebih dahulu",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-danger"
                        },
                        timer: obj.icon == 'error' ? false : 2000
                    }).then((result) => {
                        if (obj.icon == 'error' && result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + "approve-def-reservasi",
                                data: {
                                    reservasi_id: reservasi_id
                                },
                                success: function(response) {
                                    let obj = JSON.parse(response)
                                    document.getElementById(reservasi_id).setAttribute('class', obj.class)
                                    Swal.fire({
                                        text: obj.message,
                                        icon: obj.icon,
                                        buttonsStyling: false,
                                        confirmButtonText: "Oke",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                        timer: 2000
                                    }).then((result) => {
                                        if (result.isConfirmed || result.isDismissed) {
                                            location.reload();
                                        }
                                    })
                                }
                            })
                        } else if (obj.icon == 'success' && result.isConfirmed || result.isDismissed) {
                            location.reload();
                        }
                    })
                }
            })
        })
    })
    // end::Javascript for Respon Sweet Alert Approve Reservasi  

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// Start::Javascript for Respon Sweet Alert Decline Reservasi    
$(document).ready(function declineReservasi() {
        $(document).on('click', '.decline', function() {
            let reservasi_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "decline-reservasi",
                data: {
                    reservasi_id: reservasi_id
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    obj.id.forEach(element => {
                        document.getElementById(element).setAttribute('class', obj.class)
                    });
                    Swal.fire({
                        text: obj.message,
                        icon: obj.icon,
                        buttonsStyling: false,
                        confirmButtonText: "Oke!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        timer: 2000
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            location.reload();
                        }
                    })
                }
            })
        })
    })
    // end::Javascript for Respon Sweet Alert Decline Reservasi
    /**
     * -------------------------------------------------------------------
     * function()
     * -------------------------------------------------------------------
     * Deskripsi
     */
    // Start::Javascript for Respon Sweet Alert Decline Reservasi    
$(document).ready(function cancelReservasi() {
        $(document).on('click', '.batal-reservasi', function() {
            let reservasi_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "reservasi/batal",
                data: {
                    reservasi_id: reservasi_id
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    Swal.fire({
                        text: obj.message,
                        icon: obj.icon,
                        buttonsStyling: false,
                        confirmButtonText: "Oke!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        timer: 2000
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            location.reload();
                        }
                    })
                }
            })
        })
    })
    // end::Javascript for Respon Sweet Alert Decline Reservasi

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// start::Javascript for Respon Sweet Alert Set To Admin
$(document).ready(function setToAdmin() {
        $(document).on('click', '.set-to-admin', function() {
            let nip = $(this).attr('id');
            Swal.fire({
                text: 'Apakah anda yakin ingin mengubah role User ini menjadi Admin?',
                icon: 'question',
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger",
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "profile/set-to-admin",
                        data: {
                            nip: nip
                        },
                        success: function(result) {
                            let obj = JSON.parse(result);
                            if (obj.status == 'success') {
                                Swal.fire({
                                    text: 'User berhasil diubah menjadi Admin',
                                    icon: 'success',
                                    buttonsStyling: false,
                                    confirmButtonText: "Oke",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                    timer: 2000
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    text: 'User gagal diubah menjadi Admin',
                                    icon: 'error',
                                    buttonsStyling: false,
                                    confirmButtonText: "Kembali",
                                    customClass: {
                                        confirmButton: "btn btn-danger",
                                    }
                                })
                            }
                        },
                        error: function() {
                            Swal.fire({
                                text: 'User gagal diubah menjadi Admin',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: "Kembali",
                                customClass: {
                                    confirmButton: "btn btn-danger",
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    })
                }
            })
        })
    })
    // end::Javascript for Respon Sweet Alert Set To Admin

/**
 * -------------------------------------------------------------------
 * function()
 * -------------------------------------------------------------------
 * Deskripsi
 */
// start::Javascript for Respon Sweet Alert Set To User
$(document).ready(function setToUser() {
        $(document).on('click', '.set-to-user', function() {
            let nip = $(this).attr('id');
            Swal.fire({
                text: 'Apakah anda yakin ingin mengubah role Admin ini menjadi User?',
                icon: 'question',
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger",
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "profile/set-to-user",
                        data: {
                            nip: nip
                        },
                        success: function() {
                            Swal.fire({
                                text: 'Admin berhasil diubah menjadi User',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: "Oke",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                                timer: 2000
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    location.reload();
                                }
                            })
                        },
                        error: function() {
                            Swal.fire({
                                text: 'Admin gagal diubah menjadi User',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: "Kembali",
                                customClass: {
                                    confirmButton: "btn btn-danger",
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    })
                }
            })
        })
    })
    // end::Javascript for Respon Sweet Alert Set To User

// Start::Javascript for Open Modal Edit Bidang    
$(document).ready(function openModalEditBidang() {
        $(document).on('click', '.edit-bidang', function() {
            let bidang_kode = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "edit-bidang",
                data: {
                    bidang_kode: bidang_kode,
                },
                success: function(response) {
                    let obj = JSON.parse(response)
                    $('#ajaxModalContent').html(obj.modal);
                    $("#ajaxModal").modal('show');
                }
            })
        })
    })
    // end::Javascript for Open Modal Edit Bidang