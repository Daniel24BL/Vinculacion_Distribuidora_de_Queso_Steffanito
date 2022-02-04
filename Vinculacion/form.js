/*----Validacion de datos vacios y de email-----*/
function validarcamvacion(emailField){
	var form = document.form;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (form.NOMBRE.value==0){
		alert("El campo Nombre esta vacio");
		form.NOMBRE.value="";
		form.NOMBRE.focus();
		return false;
		}
	if (form.EMAIL.value==0){
		alert("El campo E-Mail esta vacio");
		form.EMAIL.value="";
		form.EMAIL.focus();
		return false;
		}
     if (reg.test(emailField.value) == false) 
        {   
            return true;
        }

	if (form.NTEL.value==0){
		alert("El campo Numero Telefonico esta vacio");
		form.NETL.value="";
		form.NTEL.focus();
		return false;
		}
	if (form.MENSA.value==0){
		alert("El campo Mensaje esta vacio");
		form.MENSA.value="";
		form.MENSA.focus();
		return false;
		}
		alert("Mensaje Enviado");
}

/*----Validacion solo numeros-----*/
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
/*----Validacion solo letras-----*/
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
/*----Validacion de email-----*/
function validaremail(emailField){
	var form = document.form;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (form.emaill.value==0){
		alert("El campo E-Mail esta vacio");
		form.emaill.value="";
		form.emaill.focus();
		return false;
		}
		alert("Mensaje Enviado");
		if (reg.test(emailField.value) == true) 
        {
          return false;						
        }
}
