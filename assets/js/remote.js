let btnSend = document.querySelector('#btnSend');
btnSend.onclick() = () =>{
    let messageText = document.querySelector('#mensagem').value;
    if(messageText == ' '){
        alert('Por favor, digite uma');
    }
}