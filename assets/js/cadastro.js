const buttonVisiblePasswordSenha = document.querySelector(
  ".visiblePasswordSenha"
);

const buttonEyeValue = buttonVisiblePasswordSenha.innerHTML;

function showPassword(classInput) {
  const closedEye = document.querySelector(".closed-eye").innerHTML;
  const senhaInput = document.getElementById(classInput);
  let confirmar_senha = document.getElementById("confirmar_senha");
  if (senhaInput.type === "password") {
    senhaInput.type = "text";
    buttonVisiblePasswordSenha.innerHTML = closedEye;
    if (document.body.contains(confirmar_senha)) {
      confirmar_senha.type = "text";
    }
  } else {
    senhaInput.type = "password";
    buttonVisiblePasswordSenha.innerHTML = buttonEyeValue;
    if (document.body.contains(confirmar_senha)) {
      confirmar_senha.type = "password";
    }
  }
}
