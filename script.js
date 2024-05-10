let invalidText = document.getElementById("invalid");
const setInvalid = (text) => {
  invalidText.innerText = text;
  setTimeout(() => {
    invalidText.innerText = "";
  }, 3000);
}
let loginBtn = document.getElementById("login");
loginBtn.addEventListener("click", async () => {
  let password = document.querySelector(".password").value;

  const response = await fetch("login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({ password: password }).toString()
  });
  if (!response.ok) {
    setInvalid("Something unexpected happened, couldn't process request...");
  }
  let text = await response.text();
  if (text == "success") {
    window.location.href = "./home.php";
  } else {
    setInvalid("Invalid password!");
  }
});
