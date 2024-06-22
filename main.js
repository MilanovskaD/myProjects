//opening window/modals for signup and login forms

 let signupModal = document.getElementById("signupModal");
 let loginModal = document.getElementById("loginModal");

 let signupBtn = document.getElementById("signupBtn");
 let loginBtn = document.getElementById("loginBtn");

 let closeSignup = document.getElementById("closeSignup");
 let closeLogin = document.getElementById("closeLogin");



  signupBtn.onclick = () => {
    signupModal.style.display = "block";
  }
  loginBtn.onclick = () => {
    loginModal.style.display = "block";
  }


  closeSignup.onclick = () =>{
    signupModal.style.display = "none";
  }
  closeLogin.onclick = () => {
    loginModal.style.display = "none";
  }

  //if validations don't pass or login fails the modal opens again to display the errors
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById("signupError")) {
        document.getElementById("signupModal").style.display = "block";
    }
});

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById("loginError")) {
        document.getElementById("loginModal").style.display = "block";
    }
});

//toggle password visibility

function showPassword() {
    let pswShow = document.querySelectorAll('.showPassword');
    pswShow.forEach(input => {
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    });
}