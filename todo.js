const oeil = document.querySelector(".feather-eye");
const pasoeil = document.querySelector(".feather-eye-off");
const password = document.querySelector("#password");

oeil.addEventListener("mouseover", () => {
  oeil.style.display = "none";
  pasoeil.style.display = "block";
  password.type = "text";
});
pasoeil.addEventListener("mouseout", () => {
  pasoeil.style.display = "none";
  oeil.style.display = "block";

  password.type = "password";
});

const oeil2 = document.querySelector("#oeil2");
const pasoeil2 = document.querySelector("#pasoeil2");
const password2 = document.querySelector("#password2");

oeil2.addEventListener("mouseover", () => {
  oeil2.style.display = "none";
  pasoeil2.style.display = "block";
  password2.type = "text";
});
pasoeil2.addEventListener("mouseout", () => {
  pasoeil2.style.display = "none";
  oeil2.style.display = "block";

  password2.type = "password";
});

let btn = document.querySelector("#valider")



//attention test en cours
