fetch('https://api.quotable.io/random')
    .then(response => response.json())
    .then(data => {
        const randomQuote = document.getElementById('quote');
        randomQuote.innerHTML = `${data.content} ${data.author}`;
    })
    .catch(error => console.error('Error fetching quote:', error));


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

//books/cards filtering

document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.checkbox-wrapper input[type="checkbox"]');
    const cards = document.querySelectorAll('.cards-container .card');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedCategories = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.name.toLowerCase());

            cards.forEach(card => {
                const cardCategory = card.classList[1].toLowerCase();
                if (checkedCategories.length === 0 || checkedCategories.includes(cardCategory)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

//random quote API

fetch('https://api.quotable.io/random')
    .then(response => response.json())
    .then(data => {
        const randomQuote = document.getElementById('quote');
        //   const  randomQuote = document.querySelectorAll('.randomQuote');
        randomQuote.innerHTML = `${data.content} ${data.author}`;
    })
    .catch(error => console.error('Error fetching quote:', error));
