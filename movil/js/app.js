
//document.getElementById("btn_agregar_referencia_pedido_nuevo").addEventListener("click",function(){
//	alert('realizo click ');
//});

// function btn_ingresar(){	
// 	  document.body.style.backgroundImage = "url('fondo.png')"; 
// 	  var usuario = document.getElementById("usuario").value;
// 	  var clave = document.getElementById("clave").value;
// 			const http=new XMLHttpRequest();
// 			const url = 'llamarControlador.php';
// 			http.onreadystatechange = function(){
// 				if(this.readyState == 4 && this.status ==200){
// 					console.log(this.responseText);
// 					document.getElementById("div_abajo").innerHTML = this.responseText;
// 				}
// 			};
// 			http.open("POST",url);
// 			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 			http.send("username="+usuario+"&clave="+clave+"&btnIngreso=Ingresar");
// } //fin de btn_ingresar

function pantallaOperaciones(){  //antes era btn_operaciones es el muestra la primera pantalla de operaciones 
		    const http=new XMLHttpRequest();
			const url = '../movil/operaciones/consultaOperaciones.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					document.getElementById("div_abajo").innerHTML = this.responseText;
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send("btnIngreso=Ingresar");
			/////////// segunda parte que muestra los resultados
				setTimeout(function(){   
					const http=new XMLHttpRequest();
					const url = '../movil/modelo/consultas.php';
					http.onreadystatechange = function(){
						if(this.readyState == 4 && this.status ==200){
							console.log(this.responseText);
							document.getElementById("div_resultados_operaciones").innerHTML = this.responseText;
						}
					};
					http.open("POST",url);
					http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					http.send("tipoConsulta=cargarOperacionesDetalle");
			}, 500);	

			
}//fin de pantallaOperaciones

function volver (){
		 const http=new XMLHttpRequest();
		 const url = '../movil/menu_principal3.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					document.getElementById("div_abajo").innerHTML = this.responseText;
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send();
	  
	  
}

// function salir(){ //antes era $("#btn_salir").click(function(){
// 		document.getElementById("div_abajo").innerHTML = '';
// 		document.body.style.backgroundImage = "url('principaloscurasencilla.png')"; 
// 	    const http=new XMLHttpRequest();
// 		const url = '../movil/logout.php';
// 			http.onreadystatechange = function(){
// 				if(this.readyState == 4 && this.status ==200){
// 					console.log(this.responseText);
// 					document.getElementById("div_abajo").innerHTML = this.responseText;
// 				}
// 			};
// 			http.open("POST",url);
// 			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 			http.send();
// }




function consultaroperacion(e){//antes era $(".consultaroperacion").click(function(){
	
	var idOperacion = e.target.value;
//	alert(idOperacion);
        
//          $.ajax({
//				url:"../movil/modelo/consultas.php",
//				type:"POST",
//				data:{"idOperacion":idOperacion,
//				"tipoConsulta":"porReferencia",
//				"desdeConsultaOperaciones":1
//				},
//				success: function(resp){
//					 /// alert(resp.response);  
//					 $("#div_resultados_operaciones").html(resp);
//				}
//			});

		    const http=new XMLHttpRequest();
			const url = '../movil/modelo/consultas.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					document.getElementById("div_resultados_operaciones").innerHTML = this.responseText;
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send("idOperacion="+idOperacion
				+"&tipoConsulta=porReferencia"
				+"&desdeConsultaOperaciones="+1);
			
}

function pop(){
	window.open("menu_principal.php","","width=100%,height=100")
}

function vermovimientos(e){ //antes era $(".vermovimientos").click(function(){
	var referencia = e.target.value ;
	        const http=new XMLHttpRequest();
			const url = '../movil/modelo/consultas.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
//					$("#cuerpomodal").html(resp);
				    document.getElementById("cuerpomodal").innerHTML = this.responseText;
//					var myWindow = window.open("", "MsgWindow", "width=200,height=100");
//					myWindow.document.write(this.responseText);
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send("referencia="+referencia
				+"&tipoConsulta=pormovimientos"
				+"&desdereferencias="+1);
}

  function referencias() { //anterior $("#btn_referencias").click(function(){ 

		//////////////////
		   const http=new XMLHttpRequest();
			const url = '../movil/referencias/consultaReferencias.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					document.getElementById("div_general").innerHTML = this.responseText;
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send("btnIngreso=Ingresar");
		
	_cargarOperacionesCliente();
	_cargarCiudadesCliente();
	_cargarSedesCliente();
		
   }  //fin de $("#btn_referencias").click(function()


function _cargarOperacionesCliente(){
	setTimeout(function(){ 
					    const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("idOperacion").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=cargarOperaciones");
					   
				}, 500);
}

function _cargarCiudadesCliente(){
	setTimeout(function(){ 
					    const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("idCiudad").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=cargarCiudades");
				}, 500);
}

function _cargarSedesCliente(){
	setTimeout(function(){ 
					    const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("idSede").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=cargarCentroCostosAgecias");
				}, 500);
}


  function btnBuscarReferencias() { //antes  $("#btn_buscar_referencias").click(function()
		  var idOperacion = document.getElementById("idOperacion").value;
		  var idCiudad = document.getElementById("idCiudad").value;
		  var idSede = document.getElementById("idSede").value;
		  var refPrincipal = document.getElementById("inp_ref_principal").value;
		//  var inp_descripcion = document.getElementById("inp_descripcion").value;
		  console.log("idOperacion" + idOperacion);
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("div_resultados_referencias").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(  "idOperacion="+idOperacion
								    +"&idCiudad="+idCiudad
								    +"&idSede="+idSede
									+"&tipoConsulta=porReferencia"
									//+"$inp_descripcion="+inp_descripcion
									+"&refPrincipal="+refPrincipal
								);
}


  function btn_pedidos_actual(){  //antes $("#btn_pedidos").click(function()
	  //este ajax es el que  carga el div con los filtros 
//	  alert('Va a proceder a crear un nuevo pedido')
//      $.ajax({
//        url:"../movil/pedidos/index.php",
//        type:"POST",
//        data:{"btnIngreso":"Ingresar"},
//        success: function(resp){
//             $("#div_general").html(resp);
//			 _cargarConceptosPedido();
//			 _cargarConceptosDocumento();
//			$("#btnGrabarOrdenTrabajoMovil").hiden();
//				
//			}
//      });
	  
						const http=new XMLHttpRequest();
						const url = '../movil/pedidos/index.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("div_general").innerHTML = this.responseText;
								 _cargarConceptosPedido();
								 _cargarConceptosDocumento();
								 document.getElementById("btnGrabarOrdenTrabajoMovil").style.display = "none";
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("btnIngreso=Ingresar");
}  //fin de $("#btn_referencias").click(function()


function _cargarConceptosPedido(){
	setTimeout(function(){ 
//						   $.ajax({
//							url:"../movil/modelo/consultas.php",
//							type:"POST",
//							data:{ "tipoConsulta":"cargarConceptosPedidos"},
//							success: function(resp){
//								$("#id_concepto_pedido").html(resp);
//							}
//							});
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("id_concepto_pedido").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=cargarConceptosPedidos");
				}, 500);
}

function _cargarConceptosDocumento(){
	setTimeout(function(){ 
					//alert("Hello"); 
					//$("#pruebaValor").val(12345);
//						   $.ajax({
//							url:"../movil/modelo/consultas.php",
//							type:"POST",
//							data:{ "tipoConsulta":"cargarDocumentosPedidos"},
//							success: function(resp){
//								console.log(resp);
//								// alert(resp);  
//								//$("#pruebaValor").val('1234');
//								$("#id_tipo_documento_pedido").html(resp);
//						   }
//					   });
					   
					   	const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("id_tipo_documento_pedido").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=cargarDocumentosPedidos");
				}, 500);
}

function btn_pedidos_operaciones(){  //$("#btn_pedidos_operaciones").click(function(){

	  var cod_agencia = document.getElementById("cod_agencia").value;
	  var sec_operacion = document.getElementById("sec_operacion").value;
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("cuerpomodal1").innerHTML = '';
								document.getElementById("cuerpomodal1").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=consulta_pedidos_operaciones"
								+ "&cod_agencia="+cod_agencia
								+ "&sec_operacion="+sec_operacion
								);
	
   }



function verimagen(e){ //anterior $(".verimagen").click(function()
						var referencia = e.target.value;
						const http=new XMLHttpRequest();
						const url = '../movil/imagenes/mostrar_imagenes2.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("cuerpomodalimagen").innerHTML = '';
								document.getElementById("cuerpomodalimagen").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("referencia="+referencia);

	
}



function btn_ver_pedidos_creados(){ //antes $("#btn_ver_pedidos_creados").click(function()
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("cuerpomodal44").innerHTML = '';
								document.getElementById("cuerpomodal44").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=verListadoPedidos");

				
		
  }
  
  
function asignar_valores_operacion(e){ //antes  $(".asignar_valores_operacion").click(function()
//	     alert(e.target.value);
			document.getElementById("div_segunda_parte_crecion_pedido").style.display="block";
			document.getElementById("div_tercera_parte_creacion_pedidos").style.display="block";
			document.getElementById("div_parte_final_crear_pedido").style.display="none";
			var numoperacion = e.target.value;
//			alert(numoperacion);
			limpiarTablasMovilTemporales();
//			let numoperacion = $(this).val() ;


//				$.ajax({
//					url:"../movil/modelo/consultas.php",
//					type:"POST",
//					data:{"numoperacion":numoperacion,
//						"tipoConsulta":"consulta_pedidos_operaciones_asignar"
//					},
//					success: function(resp){
//						var respuesta = JSON.parse(resp);
//						console.log(respuesta[0]);
//						$("#tipooperacion").text(respuesta[1]);
//						$("#centrodecosto").text(respuesta[0]);
//						$("#sede").text(respuesta[2]);
//						$("#inpnumoperacion").val(respuesta[3]);
//						$("#inpnumoperacion").val(respuesta[3]);
//						$("#cod_agencia").val(respuesta[4]);
//						$("#sec_operacion").val(respuesta[5]);
//						$("#inpnumordentrabajo").val(respuesta[6]);
//
//					}
//			   }); //fin del ajax 
			   ////////////////////
			   const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								var respuesta = JSON.parse(this.responseText);
//								alert(respuesta[0]+' '+ respuesta[2]);
//								document.getElementById("tipooperacion").text = respuesta[1];
								document.getElementById("centrodecosto").innerHTML  = respuesta[0];
								document.getElementById("sede").innerHTML  =  respuesta[2];
								document.getElementById("inpnumoperacion").value = respuesta[3];
								document.getElementById("cod_agencia").value = respuesta[4];
								document.getElementById("sec_operacion").value = respuesta[5];
								document.getElementById("inpnumordentrabajo").value = respuesta[6];
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("numoperacion="+numoperacion
						+"&tipoConsulta=consulta_pedidos_operaciones_asignar");
			   
			   
			   ///////////////////
			   
			   
			   
			   setTimeout(function(){ 
					grabarOrdenTrabajoMovil(numoperacion);
					document.getElementById("div_resumen_referencias").innerHTML ='';

				},1000);
}  //fin de asignar botones operacion 

///////////////////////
function grabarOrdenTrabajoMovil(numoperacion){
	var  cod_tipo = 2;
	var id_concepto_pedido = document.getElementById("id_concepto_pedido").value;
	var id_tipo_documento_pedido = document.getElementById("id_tipo_documento_pedido").value;
	var inpnumoperacion = numoperacion;
	var txtareaobservaciones = document.getElementById("txtareaobservaciones").value;
	
//	 $.ajax({
//			url:"../movil/modelo/consultas.php",
//			type:"POST",
//			data:{
//				"tipoConsulta":"grabarOrdenTrabajoMovil",
//				"cod_tipo":cod_tipo,
//				"id_concepto_pedido":id_concepto_pedido,
//				"id_tipo_documento_pedido":id_tipo_documento_pedido,
//				"inpnumoperacion":inpnumoperacion,
//				"txtareaobservaciones":txtareaobservaciones
//			},
//			success: function(resp){
//		    }
//	   }); //fin del ajax 
	   
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								//console.log(this.responseText);
								//document.getElementById("id_concepto_pedido").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(
										"tipoConsulta=grabarOrdenTrabajoMovil"
										+"&cod_tipo="+cod_tipo
										+"&id_concepto_pedido="+id_concepto_pedido
										+"&id_tipo_documento_pedido="+id_tipo_documento_pedido
										+"&inpnumoperacion="+inpnumoperacion,
										+"&txtareaobservaciones="+txtareaobservaciones
								);
	   
}

///////////////////////////



function limpiarTablasMovilTemporales(){
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send("tipoConsulta=limpiarTablasTemporales");
}


function btn_limpiar_campos_operacion(){//antes $("#btn_limpiar_campos_operacion").click(function()
//			$("#cod_agencia").val('');
//			$("#sec_operacion").val('');
//			$("#div_segunda_parte_crecion_pedido").hide();
//			$("#div_tercera_parte_creacion_pedidos").hide();
//			$("#div_parte_final_crear_pedido").hide();
//			$("#div_resumen_referencias").html('');
			
			 document.getElementById("cod_agencia").value='';
			 document.getElementById("sec_operacion").value='';
			 document.getElementById("div_segunda_parte_crecion_pedido").style.display="none";
			 document.getElementById("div_tercera_parte_creacion_pedidos").style.display="none";
			 document.getElementById("div_parte_final_crear_pedido").style.display="none";
			 document.getElementById("div_resumen_referencias").innerHTML = '';
			limpiarTablasMovilTemporales();
}

function btnbuscarcoincidencias() { //antes $( ".btnbuscarcoincidencias" ).click(function(e) 
		var idOperacion =  document.getElementById("inpnumoperacion").value;
		var refPrincipal =  document.getElementById("inp_ref_principal").value;
//	alert("buenas ");
//		var inp_descripcion =  document.getElementById("inp_descripcion").value;
		if(idOperacion==''){
				alert('No se ha escodigo una operacion ');
				}else
				{	 
					    const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("div_prueba_respuestas").style.display ="block";
								document.getElementById("div_prueba_respuestas").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(
									   "tipoConsulta=porReferencia"
										+"&idOperacion=" + idOperacion
										+ "&desdePedidos=1"
										+ "&refPrincipal="+refPrincipal
//										+"&inp_descripcion="+inp_descripcion
								);
				} //fin de si existe operacion	
}


   function btn_agregar_referencia_pedido_nuevo(id){//antes  $(".btn_agregar_referencia_pedido_nuevo").click(function()
	   var sec_referencia = id;
//	   alert('la referencia '+sec_referencia);
	   var inpnumoperacion = document.getElementById("inpnumoperacion").value;
	   var siguienteNumeroOrden = document.getElementById("inpnumordentrabajo").value;
	   
	   document.getElementById("cuerpomodal66").innerHTML = '';
	   document.getElementById("div_titulo_resumen_referencias").style.display ="block";
	   document.getElementById("div_resumen_referencias").style.display ="block";
					const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("cuerpomodal66").innerHTML = this.responseText;
								document.getElementById("div_prueba_respuestas").innerHTML = '';
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(
									"tipoConsulta=mostrarItemReferenciaMovil"
									+"&sec_referencia="+sec_referencia
									+"&inpnumoperacion="+siguienteNumeroOrden
								);
				
   }
   
    
 function btnAgregarItemPedido(id){ // $(".btnAgregarItemPedido").click(function()
	   
	   var cantidad = document.getElementById("inp_cantidad_referencia_nueva").value;
	   var sec_referencia = id;
//	   alert(sec_referencia);
	   var inpnumoperacion = document.getElementById("inpnumoperacion").value;
	   var siguienteNumeroOrden = document.getElementById("inpnumordentrabajo").value;
	   
	   if(cantidad ===''){
		   alert ('La cantidad del item no puede quedar en blanco  ');
	   }
	   else
	   {	   
			 document.getElementById("div_titulo_resumen_referencias").style.display ="block";
			 document.getElementById("div_resumen_referencias").style.display ="block";
			 document.getElementById("div_parte_final_crear_pedido").style.display ="block";
	   
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								//console.log(this.responseText);
								document.getElementById("div_resumen_referencias").innerHTML = this.responseText;
								document.getElementById("div_prueba_respuestas").innerHTML = '';
								document.getElementById("div_parte_final_crear_pedido").style.display ="block";
								document.getElementById("btnGrabarOrdenTrabajoMovil").style.display ="block";
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(
								"tipoConsulta=grabarItemReferenciaMovil"
								+"&sec_referencia="+sec_referencia
								+"&inpnumoperacion="+siguienteNumeroOrden
								+"&cantidad="+cantidad
								);
	   }// de si cantidad en blanco 		
   }
   
      function eliminarItemPedido(i){//   $(".eliminarItemPedido").click(function(){ 
//	   let id = $(this).val();
//	   let siguienteNumeroOrden = $("#inpnumordentrabajo").val();
	   var id = i;
	   var siguienteNumeroOrden = document.getElementById("inpnumordentrabajo").value;
//	      	 $.ajax({
//							url:"../movil/modelo/consultas.php",
//							type:"POST",
//							data:{ "tipoConsulta":"eliminarItemPedido",
//								"id":id,
//								"siguienteNumeroOrden":siguienteNumeroOrden
//							},
//							success: function(resp){
//								console.log(resp);
//								$("#div_resumen_referencias").html(resp);
//						   }
//				});
				/////
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
								console.log(this.responseText);
								document.getElementById("div_resumen_referencias").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(
									"tipoConsulta=eliminarItemPedido"
									+"&id="+id
									+"&siguienteNumeroOrden="+siguienteNumeroOrden
								);
				
   }
   
   
   
    function btnGrabarOrdenTrabajoMovil(){  //    $("#btnGrabarOrdenTrabajoMovil").click(function()
					//////
				var opcion = confirm("Esta seguro de Finalizar el pedido? ");
				if (opcion == true) 
				{
					document.getElementById("div_segunda_parte_crecion_pedido").style.display ="none";
					document.getElementById("div_tercera_parte_creacion_pedidos").style.display ="none";
					document.getElementById("div_parte_final_crear_pedido").style.display ="none";
					var siguienteNumeroOrden =  document.getElementById("inpnumordentrabajo").value;
								   const http=new XMLHttpRequest();
								   const url = '../movil/modelo/consultas.php';
								   http.onreadystatechange = function(){
									   if(this.readyState == 4 && this.status ==200){
									   }
								   };
								   http.open("POST",url);
								   http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								   http.send(
											   "tipoConsulta=grabarItemReferenciaMovilDefinitiva"
										   +"&siguienteNumeroOrden="+siguienteNumeroOrden
										   );
						   traerUltimoIdOrdenesProduccion();
				 }else{
//					 myModalLabel55
					  document.getElementById("myModalLabel55").innerHTML = 'NO SE HA GRABADO EL PEDIDO';
					  document.getElementById("cuerpomodal55").innerHTML = 'PUEDE CONTINUAR ADICIONANDO O ELIMINANDO ITEMS ';
				 }
				
						   ////////
   }
   
   
   function traerUltimoIdOrdenesProduccion(){
//	 $.ajax({
//							url:"../movil/modelo/consultas.php",
//							type:"POST",
//							data:{ "tipoConsulta":"traerUltimoIdOrdenesProducicion"
//							},
//							success: function(resp){
////								var respuesta = JSON.parse(resp);
////								console.log(respuesta);
//									$("#cuerpomodal55").html(resp);
////									$("#cuerpomodal55").html('PEDIDO '+respuesta +'  GRABADO');
//									
//						   }
//				});
				
						const http=new XMLHttpRequest();
						const url = '../movil/modelo/consultas.php';
						http.onreadystatechange = function(){
							if(this.readyState == 4 && this.status ==200){
//								console.log(this.responseText);
								document.getElementById("myModalLabel55").innerHTML = 'PEDIDO GRABADO ';
								document.getElementById("cuerpomodal55").innerHTML = this.responseText;
							}
						};
						http.open("POST",url);
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.send(
									"tipoConsulta=traerUltimoIdOrdenesProducicion"
								);
 }
 

 function btn_volverpnatallalogueo(){
		document.getElementById("div_abajo").innerHTML = '';
		document.body.style.backgroundImage = "url('principaloscurasencilla.png')"; 
	    const http=new XMLHttpRequest();
		const url = '../movil/logout.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					document.getElementById("div_abajo").innerHTML = this.responseText;
				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send();
}