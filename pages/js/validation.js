//Khai báo function cùng các phương thức
function validateForm(options) {
  let formElement = document.querySelector(options.form);
  let ruleSelector = {};
  let isError;

  if (formElement) {
    let rules = options.rules;
    rules.forEach((rule) => {
      //Lấy các rule
      if (Array.isArray(ruleSelector[rule.selector])) {
        ruleSelector[rule.selector].push(rule.action);
      } else {
        ruleSelector[rule.selector] = [rule.action];
      }

      let inputElement = formElement.querySelector(rule.selector);
      let messageElement =
        inputElement.parentElement.querySelector("span.message");
      let message;
      inputElement.onblur = () => {
        for (i = 0; i < ruleSelector[rule.selector].length; i++) {
          let actionSelector = ruleSelector[rule.selector][i];
          message = actionSelector(inputElement.value);
          isError = true;
          if (message) {
            break;
          }
        }
        messageElement.textContent = message;
      };

      inputElement.onfocus = () => {
        messageElement.textContent = "";
      };
    });

    //submit
    formElement.onsubmit = (e) => {
      console.log(isError);
      rules.forEach((rule) => {
        let inputElement = formElement.querySelector(rule.selector);
        let messageElement =
          inputElement.parentElement.querySelector("span.message");
        let message;
        for (i = 0; i < ruleSelector[rule.selector].length; i++) {
          let actionSelector = ruleSelector[rule.selector][i];
          message = actionSelector(inputElement.value);
          isError = true;
          if (message) {
            isError = true;
            break;
          }
          isError = false;
        }
        messageElement.textContent = message;

        if (isError) {
          e.preventDefault();
        }
      });
    };
  }
}

function isRequired(selector) {
  return {
    selector: selector,
    action: function (value) {
      return value ? undefined : "This field is required!";
    },
  };
}

function isEmail(selector) {
  let emailRegex =
    /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()\.,;\s@\"]+\.{0,1})+([^<>()\.,;:\s@\"]{2,}|[\d\.]+))$/;
  return {
    selector: selector,
    action: function (value) {
      return emailRegex.test(value) ? undefined : "Invalid Email!";
    },
  };
}

function isPhone(selector) {
  let phoneRegex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
  return {
    selector: selector,
    action: function (value) {
      return phoneRegex.test(value) ? undefined : "Invalid Phone number!";
    },
  };
}

function isStrongPw(selector) {
  let strongPw =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  return {
    selector: selector,
    action: function (value) {
      return strongPw.test(value) ? undefined : "Weak password!";
    },
  };
}

function confirmPassword(selector, passwordValue) {
  return {
    selector: selector,
    action: function (value) {
      return value === passwordValue()
        ? undefined
        : "Your password is not match!";
    },
  };
}

function minLength(selector, minLength) {
  return {
    selector: selector,
    action: function (value) {
      return value.length >= minLength
        ? undefined
        : `This field must have at least ${minLength} characters!`;
    },
  };
}
