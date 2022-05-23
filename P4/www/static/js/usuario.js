var post = document.getElementById("boton-iniciar");
post.addEventListener("click", function(){
    var commentBoxValue1= document.getElementById("boton-usuario").value;
    var commentBoxValue2 = document.getElementById("boton-contraseña").value;

    var todos = todos_rellenos_iniciar(commentBoxValue1, commentBoxValue2);
    
});

var post = document.getElementById("boton-registrar");
post.addEventListener("click", function(){
    var commentBoxValue1= document.getElementById("boton-nombre").value;
    var commentBoxValue2 = document.getElementById("boton-apellidos").value;
    var commentBoxValue3= document.getElementById("boton-correo").value;
    var commentBoxValue4 = document.getElementById("boton-usuario").value;
    var commentBoxValue5= document.getElementById("boton-contraseña").value;

    var todos = todos_rellenos_registrar(commentBoxValue1, commentBoxValue2, commentBoxValue3, commentBoxValue4, commentBoxValue5);
    var email_correcto = validarEmail(commentBoxValue2);
    
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

function todos_rellenos_registrar(CB1, CB2, CB3, CB4, CB5){
    if (CB1 == "" || CB2 == "" || CB3 == "" || CB4 == "" || CB5 == "") {
        alert("Todos los campos deben de estar rellenos.");
        return(false);
    }
    else
        return(true);
}

function todos_rellenos_iniciar(CB1, CB2){
    if (CB1 == "" || CB2 == "") {
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