


/// funcion para permitir solo letras 

function letrass(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key);
	letras = " ABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúabcdefghijklmnñopqrstuvwxyz";
	especiales = "8-37-39-46";
	tecla_especial = false;
	for(var i in especiales){
		 if(key == especiales[i]){
			 tecla_especial = true;
			 break;
		 }
	 }
	 if(letras.indexOf(tecla)==-1 && !tecla_especial){
		 return false;
	 }
 }


 /// funcion para permitir solo numeros
 function numeros(evt){
	var validar= (evt.which) ? evt.which : evt.keyCode;
    if(validar==8) {
      return true;
    } else if(validar>=48 && validar<=57) {
      return true;
    } else{
      return false;
    }
	}