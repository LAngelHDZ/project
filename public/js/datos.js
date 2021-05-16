const mensajeSave = document.querySelector('#mensajeSave')
const buttonSave = document.querySelector('#save')

buttonSave.addEventListener('click', () => {
    setTimeout(() => {
       mensajeSave.classList.toggle('hidden'); 
    }, 4000);

} );
