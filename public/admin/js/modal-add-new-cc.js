"use strict";
document.addEventListener("DOMContentLoaded", function(e) {
  {
    const n = document.querySelector(".credit-card-mask"),
      a = document.querySelector(".expiry-date-mask"),
      o = document.querySelector(".cvv-code-mask"),
      r = document.querySelector(".btn-reset");
    let t;
    document.getElementById("addNewCCModal").addEventListener("show.bs.modal", function(e) {
      n && (t = new Cleave(n, {
        creditCard: !0,
        onCreditCardTypeChanged: function(e) {
          $('.method').val(e)
          document.querySelector(".card-type").innerHTML = "" != e && "unknown" != e ? '<img src="' + assetsPath + "img/icons/payments/" + e + '-cc.png" class="cc-icon-image" height="28"/>' : ""
        }
      }))
    }), a && new Cleave(a, {
      date: !0,
      delimiter: "/",
      datePattern: ["m", "y"]
    }), o && new Cleave(o, {
      numeral: !0,
      numeralPositiveOnly: !0
    }), FormValidation.formValidation(document.getElementById("addNewCCForm"), {
      fields: {
        modalAddCard: {
          validators: {
            notEmpty: {
              message: "Please enter your credit card number"
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger,
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: "",
          rowSelector: ".col-12"
        }),
        submitButton: new FormValidation.plugins.SubmitButton,
        autoFocus: new FormValidation.plugins.AutoFocus
      },
      init: e => {
        e.on("plugins.message.placed", function(e) {
          e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
        })
      }
    }).on("plugins.message.displayed", function(e) {
      e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement.parentElement)
    }), r.addEventListener("click", function(e) {
      document.querySelector(".card-type").innerHTML = "", t.destroy()
    })
  }
});