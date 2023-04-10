"use strict";
var KTPasswordResetGeneral = (function() {
    var t, e, i;
    return {
        init: function() {
            (t = document.querySelector("#kt_password_reset_form")),
            (e = document.querySelector("#kt_password_reset_submit")),
            (i = FormValidation.formValidation(t, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email harus diisi",
                            },
                            emailAddress: {
                                message: "Email yang anda masukan tidak valid",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: "",
                    }),
                },
            })),
            e.addEventListener("click", function(o) {
                o.preventDefault(),
                    i.validate().then(function(i) {
                        "Valid" == i
                            ?
                            (e.setAttribute("data-kt-indicator", "on"),
                                (e.disabled = !0),
                                setTimeout(
                                    function() {
                                        let form = document.getElementById("kt_password_reset_form");
                                        form.submit();
                                    }, 1500)) :
                            Swal.fire({
                                text: "Terjadi kesalahan, silakan cek kembali email yang Anda masukan.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Oke!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                    });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function() {
    KTPasswordResetGeneral.init();
});