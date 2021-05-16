//const { delay } = require("lodash");

function ventana(){
    swal({
        title: "Un momento!",
        text: "Para ver informacion de las materia debes inicar sesion!",
        icon: "warning",
        button: "Ok!",
    });
}


/*const button = document.querySelector('#buttonMenu');
const menu = document.querySelector('#menuSplit');

button.addEventListener('click', () => { 
    menu.classList.toggle('hidden')
})

const buttonMore = document.querySelector('#buttonMore');
const menuMore = document.querySelector('#menuMore');

buttonMore.addEventListener('click', () => { 
    menuMore.classList.toggle('hidden')
})


const buttonMobile = document.querySelector('#buttonMobile');
const menuMobile = document.querySelector('#menuMobile');
const buttonCloseMobiel = document.querySelector('#buttonCloseMobile');

buttonMobile.addEventListener('click', () => { 
    menuMobile.classList.toggle('hidden')
})

buttonCloseMobiel.addEventListener('click', () => { 
    menuMobile.classList.toggle('hidden')
})*/


function soloNumeros(){
    if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;
}

function soloLetras(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    if(tecla == 32){
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
