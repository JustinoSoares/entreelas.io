const mensagemChat = document.getElementById("mensagem-chat");
//pegar a conversa em que o user está
conversa_id = document.getElementById("conversa_idJs").innerText;
console.log("conversa id " + conversa_id);

//endereço do websoket
const ws = new WebSocket("ws://localhost:8081");

//Realizar a conexão com o websoket
ws.onopen = (e) => {
    console.log("Servidor do websoket rodando na porta 8081");
}

//mensagem que irá se enviar de forma temporária
let data = new Date();
let horaTemp = data.getHours();
let minutoTemp = data.getMinutes();
if (horaTemp < 10) {
    horaTemp = "0" + horaTemp;
}
if (minutoTemp < 10) {
    minutoTemp = "0" + minutoTemp;
}
//Receber mensagens do Websoket
ws.onmessage = (mensagemRecebida) => {
    //ler as mensagens envidas pelo websoket 
    let resultado = JSON.parse(mensagemRecebida.data);
    if (resultado.conversa_id == conversa_id) {
        //Enviar a mensagem para o HTML inserir no final da Lista
        mensagemChat.insertAdjacentHTML("beforeend", `<div  title="${resultado.nome}" class="flex ms-5  gap-1  justify-start">
       <p class="text-sm w-7 h-7 mt-1 leading-7 text-white bg-slate-500 text-center rounded-full ">${resultado.nome[0]}</p>
        <p class="flex flex-col max-w-[70%] bg-slate-200  text-justify  text-black justify-center p-2 my-1  rounded-md">
        ${resultado.mensagem}
        <small class="flex justify-end text-slate-700">${horaTemp}:${minutoTemp}</small> 
        <p>
       </div>`)
        chatBotton()
    }
}
function enviar() {j
    // let mensagem = document.getElementById("mensagem");
    let nomeUser = document.getElementById("nome").textContent;
    let userId = document.getElementById("user_id").value;
    let conversaId = document.getElementById("conversa_id").value;
    if (userId === "") {
        alert("Usuário inexistente");
        window.location.href = "index.php";
        return;
    }

    //pegar os dados que estao dentro de input e transforma em json
    // tornarLinksClicaveis(mensagem);
    let dados = {
        mensagem: mensagem.value,
        user_id: userId, //Pegamos o user_id que está a ser inserido na nossa api e passado com um array
        conversa_id: conversaId,
        nome: nomeUser //Esse nome será mostrado para quem está a receber a mensagem
    }
    //Para o user poder ver a sua propria mensagem
    mensagemChat.insertAdjacentHTML("beforeend",
        `<div class="flex justify-end  me-5 mt-1">
        <p class="flex flex-col max-w-[70%] bg-pink-600 text-white text-justify  justify-center relative p-2 rounded-md ">
        ${mensagem.value}
            <small class="flex justify-end">${horaTemp}:${minutoTemp}</small>
        </p>
    </div>`
    )

    //enviar a mensagem para o websoket
    ws.send(JSON.stringify(dados));
    //limpar o campo
    mensagem.value = "";
    //chamar a função do para manter o scrool na última mensagem
    chatBotton()
}
//Função para colocar as últimas mensagem em baixo e  dar um scroll até em baixo
function chatBotton() {
    let chatBox = document.getElementById("chatBox");
    chatBox.scrollTop = chatBox.scrollHeight;
}

//Listar mensagens no banco de dados

//carregar as mesagens do banco de dados
//criar varialvel que indica a quantidade de mensagens que já foram carregadas 
let offset = 0;
//Mover o scroll para o final
let roleFinal = true;



//Variável de controlo para evitar carregamentos simultáneos 
$carregandoRegistros = false;
//queremos verificar se o user está a 10px do topo
function verificarScroll() {
    let chatBox = document.getElementById("chatBox");
    if (chatBox.scrollTop <= 20) {
        console.log("scroll:" + chatBox.scrollTop);
        console.log("O usuário está próximo");
        carregarMsg();
    }
}
//pegar o chatBox para verificar se tem rolagem

//quando acontecer o evento de scroll verificar se o chatBox está distante do top a 10px
chatBox.addEventListener('scroll', verificarScroll());
//desativar temporariamento o scroll antes de fazer a chamada
chatBox.onscroll = null;
let del_cancelar = document.getElementById("del_cancelar");

//cancelar a deletação
del_cancelar.onclick = () => {
    del_dialog_mensagem.close();
}
async function carregarMsg() {
    if ($carregandoRegistros) {
        //Se já estiver carregando registro retorna para haver carregamentos simultáneos
        return;
    }
    //indicar que está carregando os registros 
    $carregandoRegistros = true;

    try {
        let dados = await fetch(`../controllers/listar_registros.php?conversa_id=${conversa_id}&offset=${offset}`);//a var offset vai indicar a quantidadede de registros que já foram carregados
        if (!dados.ok) {
            throw new Error(dados.error);
        }
        let resposta = await dados.json();
        console.log(resposta);

        //quando o arquivo do php mandar status true
        if (resposta["status"]) {
            //     //somar a quantidade de registros recuperada 
            offset += resposta["qtd_mensagens"];
            //     //listar as mensagens
            resposta["dados"].map(item => {
                let userAuth = document.getElementById("user_id").value;
                if (userAuth === item.user_id) {
                    //pegar a data 
                    let data = new Date(item.created_at);
                    let hora = data.getHours();
                    let minuto = data.getMinutes();
                    if (hora < 10) {
                        hora = "0" + hora;
                    }
                    if (minuto < 10) {
                        minuto = "0" + minuto;
                    }
                    mensagemChat.insertAdjacentHTML("afterbegin",
                        `<div class="flex justify-end me-5 mt-1 items-center gap-1">
                         <div class="bg-red-700 opacity-0 cursor-pointer w-5 h-5 rounded-full del"></div>

                          <p class="flex flex-col max-w-[70%] bg-pink-600 text-white text-justify  justify-center relative p-2 rounded-md ">
                          ${item.conteudo}
                       <small class="flex justify-end">${hora}:${minuto}</small>
                          </p>
                     </div>`)
                    //pegar o elemento que irá deletar
                    del = document.querySelectorAll(".del");
                    let del_dialog_mensagem = document.getElementById("del_dialog_mensagem");
                    let del_mensagem_id = document.getElementById("del_mensagem_id");

                    del.forEach(element => {
                        //o usuário passou o mouse ou é para deletar
                        element.onmousemove = () => {
                            element.classList.remove("opacity-0");
                        }
                        //Quando ele retira o mouse
                        element.onmouseout = () => {
                            element.classList.add("opacity-0");
                        }
                        //quando ele clica no mouse 
                        element.onclick = () => {
                            del_dialog_mensagem.showModal();
                            del_mensagem_id.innerText = item.id;
                        }

                    });
                } else {
                    //pegar a data 
                    let data = new Date(item.created_at);
                    let hora = data.getHours();
                    let minuto = data.getMinutes();
                    if (hora < 10) {
                        hora = "0" + hora;
                    }
                    if (minuto < 10) {
                        minuto = "0" + minuto;
                    }
                    //mesagem do user que recebe
                    mensagemChat.insertAdjacentHTML("afterbegin", `<div  title="${item.primeiroNome+" "+item.apelido}" class="flex ms-5  gap-2  justify-start">
                    <div class="rounded-full bg-slate-500 w-7 text-white leading-7  h-7 text-[13px] text-center">${item.primeiroNome[0]}</div>
              <p class="flex flex-col max-w-[70%] bg-slate-200  text-justify  text-black justify-center p-2 my-1  rounded-md">
              ${item.conteudo}
              <small class="flex justify-end text-slate-700">${hora}:${minuto}</small>
              <p>
          </div>`)
                    // chatBotton()
                }
            });

            //actualizar a variável de registros para indicar que já não está carregando resistros
            $carregandoRegistros = false;     //voltar a activar o scroll da página
            chatBox.onscroll = verificarScroll;
            if (roleFinal) {
                //         roleFinal = false;
                //chamar a função do para manter o scrool na última mensagem
                chatBotton();
            }
        } else {
            //quando o arquivo do php mandar status false
            mensagemChat.insertAdjacentHTML("afterbegin",
                `<p class="text-yellow-700  text-[20px]">${resposta["msg"]} </p>`
            );

        }
    } catch (error) {
        console.error('Erro:', error);
    }
    //obs: Quando colocamos um await devemos colocar um async 
    //chamar arquivo php em js para recuperar usuários do banco de dados
    // let dados = await fetch(`../../controllers/listar_registros.php?offset=${offset}`);//a var offset vai indicar a quantidadede de registros que já foram carregados

    //Verificar se ainda temos mensagens



}

//carregar as mesagens inicialmente
carregarMsg();






