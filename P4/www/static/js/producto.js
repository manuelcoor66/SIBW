var comments = document.getElementById("boton-comentarios");
var banned_words;

comments.addEventListener("click", function(){
    var comentarios = document.getElementById("subir-comentarios");

    if (comentarios.style.display == "") {
        comentarios.style.display = 'block'; 
    }
    else {
        comentarios.style.display = "";
    }
});

var post = document.getElementById("boton-subir");
post.addEventListener("click", function(){
    var commentBoxValue1= document.getElementById("boton-nombre").value;
    var commentBoxValue2 = document.getElementById("boton-correo").value;
    var commentBoxValue3= document.getElementById("boton-comentario").value;

    var todos = todos_rellenos(commentBoxValue1, commentBoxValue2, commentBoxValue3);
    var email_correcto = validarEmail(commentBoxValue2);
    if (todos == true) {
        if(email_correcto) {  
            var div = document.getElementById("comentarios");
            var div1 = document.createElement('div');
            div1.classList.add("comentario");
            var div2 = document.createElement('div');
            div2.classList.add("subrayar");
            var span1 = document.createElement('span');
            span1.classList.add("coment");
            var p1 = document.createElement('p');
            p1.classList.add("nombre");
            var span2 = document.createElement('span');
            span2.classList.add("fecha");
            var d = new Date();
            if (d.getMonth() < 10)
                var mes = "0" + (d.getMonth() + 1); 
            else
                mes = d.getMonth() + 1; 
            if (d.getMinutes() < 10)
                var minutos = "0" + d.getMinutes(); 
            else
                minutos = d.getMinutes(); 
            var fecha = " " + d.getDate() + '/' + mes + '/' + d.getFullYear() + ' ' + d.getHours() + ':' + minutos;
            var p2 = document.createElement('p');
            p2.classList.add("texto");
            var boton = document.getElementById("boton-cambiar");

            div2.append(boton);
            span1.textContent = "Comentario:";
            div2.append(span1);
            span2.textContent = fecha;
            p1.textContent = commentBoxValue1;
            p1.append(span2);
            p2.textContent = commentBoxValue3;
            div1.append(div2);
            div1.append(p1);
            div1.append(p2);
            div.prepend(div1);
        }
        else {  
            alert("La dirección de email es incorrecta");
            document.getElementById("boton-correo")
        }
    }
});

function palabras_censuradas(){
	var xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		    banned_words = JSON.parse(this.responseText);
		}
    };

    xhttp.open("GET", "http://localhost/palabrasCensuradas.php", true);
    xhttp.send();    
}

function censurar_palabras(){
    var palabra = document.getElementById("boton-comentario");
    var censuradas = banned_words;
    
    for (var cambio of censuradas) {
        palabra.value = palabra.value.replace(cambio, "*".repeat(cambio.length));
    }
}

function todos_rellenos(CB1, CB2, CB3){
    if (CB1 == "" || CB2 == "" || CB3 == "") {
        alert("Todos los campos deben de estar rellenos.");
        return(false);
    }
    else
        return(true);
}

function validarEmail(valor) {
    if ( /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(valor)){
        return(true);
    } else {
        return(false);
    }
}

palabras_censuradas();
