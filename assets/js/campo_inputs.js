campos = document.getElementsByClassName("campo_input")
elementsArray = Array.from(campos)

 elementsArray.forEach(function(element, index) {
    element.onkeydown = function(evento){
        if(evento.key=="Enter" && index<campos.length-1)
        campos[index+1].focus()
   }
 })


