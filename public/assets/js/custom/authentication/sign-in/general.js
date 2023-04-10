"use strict";
var KTSigninGeneral = (function() {
    var t, e, i;
    return {
        init: function() {
            (t = document.querySelector("#kt_sign_in_form")),
            (e = document.querySelector("#kt_sign_in_submit")),
            (i = FormValidation.formValidation(t, {
                fields: {
                    auth: {
                        validators: {
                            notEmpty: {
                                message: "Email / NIP tidak boleh kosong",
                            },
                        },
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Password tidak boleh kosong",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                    }),
                },
            })),
            e.addEventListener("click", function(n) {
                n.preventDefault(),
                    i.validate().then(function(i) {
                        "Valid" == i
                            ?
                            (e.setAttribute("data-kt-indicator", "on"),
                                (e.disabled = !0),
                                setTimeout(function() {
                                    e.removeAttribute("data-kt-indicator"),
                                        (e.disabled = !1),
                                        Swal.fire({
                                            text: "Data Anda sedang dikonfirmasi!",
                                            icon: "info",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Oke!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                            timer: 1000,
                                            closeOnClickOutside: false,
                                        })
                                        .then(function(e) {
                                            e.isConfirmed &&
                                                ((t.querySelector('[name="auth"]').value = ""),
                                                    (t.querySelector('[name="password"]').value = ""));
                                        })
                                        .then(function() {
                                            let form = document.getElementById("kt_sign_in_form");
                                            form.submit();
                                        });
                                }, 500)) :
                            Swal.fire({
                                text: "Maaf, sepertinya terjadi kesalahan, silahkan coba lagi.",
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
    KTSigninGeneral.init();
});

function recaptchaCallback() {
    $('#captcha').html('Captcha sudah diisi').attr('class', 'text-primary text-center');
    $('#kt_sign_in_submit').removeAttr('disabled').attr('class', 'btn btn-lg btn-primary w-100 mb-3');
    if ($('.form-control').val()) {
        $('#kt_sign_in_submit').click()
    }
};

function countChars(obj) {
    var maxLength = 16;
    var strLength = obj.value.length;
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (obj.value == '') {
        document.getElementById("hint").innerHTML = "";
    } else if (!(/\D/.test(obj.value)) && strLength < maxLength) {
        document.getElementById("hint").innerHTML = '<span class="text-danger">' + strLength + '/' + maxLength + ' [NIP]</span>';
    } else if (!(/\D/.test(obj.value)) && strLength == maxLength) {
        document.getElementById("hint").innerHTML = '<span class="text-primary">' + strLength + '/' + maxLength + ' [NIP]</span>';
        if (strLength > maxLength) {
            document.getElementById("hint").innerHTML = '<span class="text-danger">' + strLength + '/' + maxLength + ' [NIP]</span>';
        }
    } else if (obj.value.match(validRegex)) {
        document.getElementById("hint").innerHTML = '<span class="text-primary">[Email]</span>';
    } else {
        document.getElementById("hint").innerHTML = '<span class="text-danger">[Email]</span>';
    }
}