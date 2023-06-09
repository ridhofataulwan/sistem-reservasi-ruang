"use strict";
var KTSignupGeneral = (function() {
    var a, t, e, i;
    return {
        init: function() {
            (a = document.querySelector("#kt_sign_up_form")),
            (t = document.querySelector("#kt_sign_up_submit")),
            (i = KTPasswordMeter.getInstance(
                a.querySelector('[data-kt-password-meter="true"]')
            )),
            (e = FormValidation.formValidation(a, {
                fields: {
                    nama: { validators: { notEmpty: { message: "Nama harus diisi" } } },
                    nip: { validators: { notEmpty: { message: "NIP harus diisi" } } },
                    alamat: {
                        validators: { notEmpty: { message: "Alamat harus diisi" } },
                    },
                    email: {
                        validators: {
                            notEmpty: { message: "Email harus diisi" },
                            emailAddress: { message: "Email tidak valid" },
                        },
                    },
                    opd: {
                        validators: {
                            notEmpty: { message: "OPD harus diisi" },
                        },
                    },
                    bidang: {
                        validators: {
                            notEmpty: { message: "Bidang harus diisi, jika bidang belum tersedia silakan hubungi Admin Kominfo" },
                        },
                    },
                    password: {
                        validators: {
                            notEmpty: { message: "Password harus diisi" },
                            callback: {
                                message: "Silahkan masukan password yang valid",
                                callback: function(a) {
                                    if (a.value.length > 0) return 100 === i.getScore();
                                },
                            },
                        },
                    },
                    pass_confirm: {
                        validators: {
                            notEmpty: { message: "Konfirmasi password harus diisi" },
                            identical: {
                                compare: function() {
                                    return a.querySelector('[name="password"]').value;
                                },
                                message: "Password dan konfirmasi password tidak sama",
                            },
                        },
                    },
                    toc: {
                        validators: {
                            notEmpty: {
                                message: "Anda harus mencentang ini",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: { password: !1 },
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: "",
                    }),
                },
            })),
            t.addEventListener("click", function(s) {
                    s.preventDefault(),
                        e.revalidateField("password"),
                        e.validate().then(function(e) {
                            "Valid" == e
                                ?
                                (t.setAttribute("data-kt-indicator", "on"),
                                    (t.disabled = !0),
                                    setTimeout(function() {
                                        t.removeAttribute("data-kt-indicator"),
                                            (t.disabled = !1),
                                            Swal.fire({
                                                text: "Data yang Anda masukan sedang diproses!",
                                                icon: "info",
                                                buttonsStyling: !1,
                                                confirmButtonText: "Oke!",
                                                customClass: { confirmButton: "btn btn-primary" },
                                                timer: 1000,
                                                closeOnClickOutside: false,
                                            })
                                            .then(function(t) {
                                                t.isConfirmed && (a.reset(), i.reset());
                                            })
                                            .then(function() {
                                                let form = document.getElementById("kt_sign_up_form");
                                                form.submit();
                                            });
                                    }, 500)) :
                                Swal.fire({
                                    text: "Maaf, sepertinya terjadi kesalahan. Silahkan coba lagi.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Oke!",
                                    customClass: { confirmButton: "btn btn-primary" },
                                });
                        });
                }),
                a
                .querySelector('input[name="password"]')
                .addEventListener("input", function() {
                    this.value.length > 0 &&
                        e.updateFieldStatus("password", "NotValidated");
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function() {
    KTSignupGeneral.init();
});

function countChars(obj) {
    var maxLength = 16;
    var strLength = obj.value.length;

    if (obj.value == '') {
        document.getElementById("hint").innerHTML = "";
    } else if (!(/\D/.test(obj.value)) && strLength < maxLength) {
        document.getElementById("hint").innerHTML = '<span class="text-danger">' + strLength + '/' + maxLength + ' [NIP]</span>';
    } else if (!(/\D/.test(obj.value)) && strLength == maxLength) {
        document.getElementById("hint").innerHTML = '';
    }
}
$(function() {
    $('input[name="nip"]').bind('keypress', function(e) {
        var keyCode = (e.which) ? e.which : event.keyCode
        return !(keyCode > 31 && (keyCode < 48 || keyCode > 57));
    });
});