// Registration Form
function checkPassword() {
  const password1 = document.getElementById("password1").value;
  const password2 = document.getElementById("password2").value;

  if (password1 !== password2) {
    alert("Passwords do not match. Please re-enter.");
    return false;
  }
  return true;
}

const registrationForm = document.getElementById("registration-form");
// Connect the checkPassword() function to the form's onsubmit event
registrationForm.addEventListener("submit", (e) => {
  if (!checkPassword()) {
    e.preventDefault(); // Prevent the form from submitting if passwords don't match
  }
});
