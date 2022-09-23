$(function() {
	'use strict';
	
  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});




/*-------------NUEVA PUBLICACION POP UP------------*/

/*   Primer Intento
function myFunction() {
  var popup = document.getElementById("ventanaPublicar");
  .toggleClass("show");
}
*/

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("publicacionBTN");

// Get the <input> element that closes the modal
var input = document.getElementsByClassName("cerrar")[0];

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("xCerrar")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
input.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
/*-------------FIN NUEVA PUBLICACION POP UP------------*/




/*------POPUP CERRAR SESION-------*/
    function botonSalir() {
      var x = document.getElementById("ventanaSalir");
      if (x.style.display === "none") {
        x.style.display = "flex";
      } else {
        x.style.display = "none";
      }
    }

/*------POPUP CERRAR SESION-------*/




/*-----------POPUP POST----------*/
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
/*-----------POPUP POST----------*/




/*-----CAROUSEL VARIOS ITEMS-----*/

let items = document.querySelectorAll('.carousel .carousel-item')

        items.forEach((el) => {
            const minPerSlide = 4
            let next = el.nextElementSibling
            for (var i=1; i<minPerSlide; i++) {
                if (!next) {
            // wrap carousel by using first child
            next = items[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
})
/*-----CAROUSEL VARIOS ITEMS-----*/

/*----------Modal-------------*/
(function($) {

  "use strict";

  $('[data-toggle="tooltip"]').tooltip()

  // $('#exampleModalCenter').modal('show')

  var fullHeight = function() {

    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function(){
      $('.js-fullheight').css('height', $(window).height());
    });

  };
  fullHeight();

})(jQuery);