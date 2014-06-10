// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

/*Crea el objeto AJA. Funcion generica para cualquier utilidad de este
*/
	function nuevoAjax(){
	
		var xmlhttp = false;
		try{
			//Creacion del objeto AJAX para navegadores no IE
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");	
		}catch(e){
		
				try{
					//Creacion del objeto AJAX para IE
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}catch(E){
					if(!xmlhttp && typeof XMLHttpRequest != 'undefined')
						xmlhttp = new XMLHttpRequest();
				
				}
		}
		
		return xmlhttp;
	}
	
	function enviaLogin(){
		$( document ).ready(function() {
			usuario = document.getElementById('user').value;
			pass = document.getElementById('pass').value;
			$.ajax({
				type:'POST',
				url:'http://localhost/proyeccionescolar/index.php?usuario=login&accion=login',
				data: "{'user :' "+usuario+", 'pass' :"+pass+"}",
				success: function(html){
					console.log('hola');
				}
			});

		});
			
	}
