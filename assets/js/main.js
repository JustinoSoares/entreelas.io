window.addEventListener("load", () => {
  const headerContainer = document.querySelector(".header-container");
  const ButtonTop = document.querySelector(".buttonTop");

  if (!headerContainer) {
    return;
  }

  const ChangeBgColor = () => {
    if (window.scrollY === 0) {
      headerContainer.classList.remove("customizedBgHeader");
      headerContainer.classList.remove("shadow-md");
      ButtonTop.classList.remove("flex");
      ButtonTop.classList.add("hidden");
    } else {
      headerContainer.classList.add("customizedBgHeader");
      headerContainer.classList.add("shadow-md");
      ButtonTop.classList.remove("hidden");
      ButtonTop.classList.add("flex");
    }
  };

  ChangeBgColor();

  document.addEventListener("scroll", ChangeBgColor);
});
function openOffCanvas() {
  let offCanvas = document.querySelector(".offcanvas");
  let cardOffCanvas = document.querySelector(".cardOffCanvas");
  document.body.style.overflow = "hidden";
  offCanvas.classList.remove("hidden");
  offCanvas.classList.add("animationBack");
  offCanvas.classList.add("flex");
  cardOffCanvas.classList.add("animationOffCanvas");
}

const allLinksOffCanvas = document.querySelectorAll("#navbarOffCanvas li a");

allLinksOffCanvas.forEach((link) => {
  link.addEventListener("click", closeOffCanvas);
});

document
  .getElementById("closeOffCanvas")
  .addEventListener("click", closeOffCanvas);
function closeOffCanvas() {
  let offCanvas = document.querySelector(".offcanvas");
  document.body.style.overflow = "auto";
  offCanvas.classList.remove("animationBack");
  offCanvas.classList.add("hidden");
}

document
  .getElementById("scrollToTopBtn")
  .addEventListener("click", scrollToTop);

function scrollToTop() {
  const scrollToTopBtn =
    document.documentElement.scrollTop > 0
      ? document.getElementById("scrollToTopBtn")
      : null;

  if (scrollToTopBtn) {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  }
}

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    document.querySelector(this.getAttribute("href")).scrollIntoView({
      behavior: "smooth",
    });
  });
});

const ButtonGuide = document.querySelectorAll(".guia");

ButtonGuide.forEach((buttonOpenGuide) => {
  buttonOpenGuide.addEventListener("click", () => {
    let backCard = document.querySelector(".backCard");
    let cardGuide = document.querySelector(".cardGuide");
    document.body.style.overflow = "hidden";
    backCard.classList.remove("hidden");
    backCard.classList.add("animationBack");
    backCard.classList.add("flex");
    cardGuide.classList.add("animationCard");
  });
});

document.getElementById("fecharGuideCard").addEventListener("click", () => {
  let backCard = document.querySelector(".backCard");
  document.body.style.overflow = "auto";
  backCard.classList.remove("animationBack");
  backCard.classList.remove("flex");
  backCard.classList.add("hidden");
});
const allButtonsCard = document.querySelectorAll(".sugerir");
allButtonsCard.forEach((buttonOpenGuide) => {
  buttonOpenGuide.addEventListener("click", () => {
    let backCard = document.querySelector(".backCard");
    let cardGuide = document.querySelector(".cardGuide");
    document.body.style.overflow = "hidden";
    backCard.classList.remove("hidden");
    backCard.classList.add("animationBack");
    backCard.classList.add("flex");
    cardGuide.classList.add("animationCard");
  });
});
