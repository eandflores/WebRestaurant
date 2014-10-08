(function($){

	$.fn.rut = function(options){

		var defaults = {parent:".control-group"};

		var selected = $.extend(defaults, options);

		function rut(str){
			aux = limipia_string(str);
			largo = aux.length;
			dv = aux.charAt(largo-1);
			nuevo = dv + "-";
			contador = 0;
			for(var i = largo-2; i >= 0; i--, contador++){
				tmp = aux.charAt(i);
				if(contador == 3){
					nuevo += ".";
					contador = 0;
				}
				nuevo += tmp;
			}
			return invertir_string(nuevo);
		}

		function limipia_string(str){
			while(str.indexOf(".")!= -1)
				str = str.replace(".","");
			while(str.indexOf("-")!= -1)
				str = str.replace("-","");
			return str;
		}

		function invertir_string(str){
			tmp = "";
			for (var i = str.length - 1; i >= 0; i--) {
				tmp += str.charAt(i);
			}
			return tmp;
		}

		function valida(rut){
			aux = limipia_string(rut);
			aux = invertir_string(aux);
			largo = aux.length;
			dv = aux.charAt(0);
			if(dv == 'k' || dv =='K')
				dv = 10;
			tmp = "";
			suma = 0;
			factor = 2;
			for (var i = 1; i <= aux.length-1; i++, factor ++) {
				if(factor == 8){
					factor = 2;
				}
				help = parseInt(aux.charAt(i));
				suma += help * factor;
			}
			modulo = suma % 11;
			dv_final = 11 - modulo;
			if( dv_final == 11)
				dv_final = 0;
			if( dv_final == dv)
				return true;
			else
				return false;
		}


		return this.each(function(){
			$(this).keyup(function(){
				this.value = rut(this.value);
			})

			$(this).focusout(function(){
				if(valida(this.value)){
					$(this).closest(selected.parent).removeClass("error").addClass("success");
				}else{
					$(this).closest(selected.parent).removeClass("success").addClass("error");
				}
			})
		})



	}



})(jQuery)