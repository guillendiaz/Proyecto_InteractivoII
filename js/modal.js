function abrirModal(event){
    console.log(event);
    modal =  event.target.querySelector(".contenedor-post-fondo");
    modal.classList.toggle("contenedor-desactivado");
}

function cerrarModal(event){
    event.stopPropagation();
    event.target.classList.toggle("contenedor-desactivado");
}

function prevenirModal(event){
    event.stopPropagation();
}
