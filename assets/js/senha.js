
input = document.getElementsByClassName("pass")
// Obtenha todos os elementos com a classe desejada
elements = document.getElementsByClassName("mos")

// Converta a coleção HTML em um array para usar forEach
elementsArray = Array.from(elements)

// Itere sobre os elementos usando forEach
elementsArray.forEach(function(element, index) {
  // Adicione um evento de clique a cada elemento
  element.onclick = function() {
    // Mostre a posição do elemento ao clicar nele
    if(input[index].getAttribute("type")=="text"){
      input[index].removeAttribute("type")
      input[index].setAttribute("type","password")
    }else{
      input[index].removeAttribute("type")
      input[index].setAttribute("type","text")
    }

    if(this.getAttribute("class")=="bi bi-eye-fill mos"){
      this.removeAttribute("class")
      this.setAttribute("class", "bi bi-eye-slash mos")
    }else{
      this.removeAttribute("class")
      this.setAttribute("class", "bi bi-eye-fill mos")
    }
  }
})