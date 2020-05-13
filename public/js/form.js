var currentTab = 0;
showTab(currentTab);

function showTab(n) {

  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("back-button").style.display = "none";
  } else {
    document.getElementById("back-button").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("next-button").innerHTML = "Register";
  } else {
    document.getElementById("next-button").innerHTML = "Next";
  }

  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length) {
    document.getElementById("reg-form").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  var x, y, z, i, pass, valid = true;
  if(currentTab == 4) return true
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");

  z = x[currentTab].getElementsByTagName("select")
  if(z.length>0 && z[0].value == ""){
    z.className += " invalid"
    valid = false
  }


  if(currentTab == 0){
    for (i = 0; i < y.length; i++){
        if(y[i].type == "email"){
            if (y[i].value == "") {
                y[i].className += " invalid"
                y[i].placeholder = "Required"
                valid = false;
              }else if (!validateEmail(y[i].value)){
                y[i].className += " invalid";
                y[i].value = "";
                y[i].placeholder = y[i].name+" format is invalid"
                valid = false;
            }
        }else{
            if (y[i].value == "") {
                y[i].className += " invalid"
                y[i].placeholder = "Required"
                valid = false;
            }else if(y[i].id == "password"){
                pass=y[i].value
                if(y[i].value.length < 8){
                    y[i].className += " invalid"
                y[i].value = "";
                y[i].placeholder = "Password must be at least 8 charecter"
                    valid = false;
                }
            }else if(y[i].id == "password-confirm" && y[i].value!=pass){
                y[i].className += " invalid"
                y[i].value = "";
                y[i].placeholder = "Password didn't match"
                valid = false;
            }
        }
    }
  }else if(currentTab == 3){
      valid = false
    for (i = 0; i < y.length; i++){
        if(y[i].checked == true) {
            valid = true
            break
        }
    }
  }else{
      for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
          y[i].className += " invalid";
          y[i].placeholder = "Required"
          valid = false;
        }
      }
  }

  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid;
}

function validateEmail(email){
    atpos = email.indexOf("@")
    dotpos = email.lastIndexOf(".")
    if(atpos<1 || (dotpos-atpos)<2){
        return false
    }
    return (true)
}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}
