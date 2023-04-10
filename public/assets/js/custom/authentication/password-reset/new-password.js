"use strict";
var KTPasswordResetNewPassword = (function () {
  var e,
    t,
    r,
    o,
    s = function () {
      return 100 === o.getScore();
    };
  return {
    init: function () {
      (e = document.querySelector("#kt_new_password_form")),
        (t = document.querySelector("#kt_new_password_submit")),
        (o = KTPasswordMeter.getInstance(
          e.querySelector('[data-kt-password-meter="true"]')
        )),
        (r = FormValidation.formValidation(e, {
          fields: {
            password: {
              validators: {
                notEmpty: {
                  message: "Password harus di isi",
                },
                callback: {
                  message: "Silakan mengisi password",
                  callback: function (e) {
                    if (e.value.length > 0) return s();
                  },
                },
              },
            },
            "confirm-password": {
              validators: {
                notEmpty: {
                  message: "Konfirmasi password harus diisi",
                },
                identical: {
                  compare: function () {
                    return e.querySelector('[name="password"]').value;
                  },
                  message: "Konfirmasi password tidak sama",
                },
              },
            },
            toc: {
              validators: {
                notEmpty: {
                  message: "Saya telah mengisi formulir dengan benar",
                },
              },
            },
          },
          plugins: {
            trigger: new FormValidation.plugins.Trigger({
              event: {
                password: !1,
              },
            }),
            bootstrap: new FormValidation.plugins.Bootstrap5({
              rowSelector: ".fv-row",
              eleInvalidClass: "",
              eleValidClass: "",
            }),
          },
        })),
        t.addEventListener("click", function (s) {
          s.preventDefault(),
            r.revalidateField("password"),
            r.validate().then(function (r) {
              "Valid" == r
                ? (t.setAttribute("data-kt-indicator", "on"),
                  (t.disabled = !0),
                  setTimeout(function () {
                    t.removeAttribute("data-kt-indicator"),
                      (t.disabled = !1),
                      Swal.fire({
                        text: "Password Anda telah berhasil diubah!",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Oke!",
                        customClass: { confirmButton: "btn btn-primary" },
                        timer: 1000,
                        closeOnClickOutside: false,
                      })
                        .then(function (t) {
                          t.isConfirmed &&
                            ((e.querySelector('[name="password"]').value = ""),
                            (e.querySelector(
                              '[name="confirm-password"]'
                            ).value = ""),
                            o.reset());
                        })
                        .then(function () {
                          let form = document.getElementById(
                            "kt_new_password_form"
                          );
                          form.submit();
                        });
                  }, 1500))
                : Swal.fire({
                    text: "Maaf, sepertinya terjadi kesalahan, silahkan coba lagi.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Oke!",
                    customClass: {
                      confirmButton: "btn btn-primary",
                    },
                  });
            });
        }),
        e
          .querySelector('input[name="password"]')
          .addEventListener("input", function () {
            this.value.length > 0 &&
              r.updateFieldStatus("password", "NotValidated");
          });
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  KTPasswordResetNewPassword.init();
});
