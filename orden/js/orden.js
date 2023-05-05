

function valide(){
    placa = document.querySelector('#placa');
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            //  console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
// //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("div_mostrar_ordenes").innerHTML  = this.responseText;
           
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('placa='+ placa.value
    +'&opcion='+'verificarPlaca'
    );
}

function pregunteDatosOrden(){
   
    const http=new XMLHttpRequest();
    const url = '../orden/ordenPlaca.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
           document.getElementById("resultadosValidacion").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('placa='+ placa.value);

}



function grabarordenMovil()
{
    var valida = validacionesOrden();
    if(valida != 0)
    {
        // $('#myModalDdatosOrden').modal('hide');  
        placa = document.querySelector('#placaPeritaje').value;
        tipo_medida = document.querySelector('#tipo_medida').value;  
        kilometraje = document.querySelector('#kilometraje').value;  
        mecanico = document.querySelector('#mecanico').value;  
        descripcion = document.querySelector('#descripcion').value;  
        // var placa = '1234';
        
        const http=new XMLHttpRequest();
        const url = '../orden/ordenes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                //  console.log(this.responseText);
                //var respuesta = JSON.parse(this.responseText);
                // console.log(respuesta.marca);
                    // alert(respuesta[0]+' '+ respuesta[1]);
            //		document.getElementById("tipooperacion").text = respuesta[1];
            document.getElementById("cuerpoModalDatosOrden").innerHTML  = this.responseText;
            
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('placa='+ placa
        +'&tipo_medida='+tipo_medida
        +'&kilometraje='+kilometraje
        +'&mecanico='+mecanico
        +'&descripcion='+descripcion
        // // +'&placaformu='+placaformu
        // +'&desdemovil='+'1'
        +'&opcion='+'grabarOrden'
        );

        //aqui se podria decir que llame el programa que envia el correo 
        //o en el controlador para la accion grabarOrden 
        //que muestre la opcion para ir colocando items apenas grabe la orden 

    }

}

function validacionesOrden(){
   
    // if(document.getElementById("placa").value == '')
    // {
    //    alert("Digite placa") ;  
    //    document.getElementById("placa").focus();
    //    return 0;
    // }
    // if(document.getElementById("fecha").value == '')
    // {
    //    alert("Digite fecha") ;  
    //    document.getElementById("fecha").focus();
    //    return 0;
    // }
    // if(document.getElementById("marca").value == '')
    // {
    //    alert("Digite marca") ;  
    //    document.getElementById("marca").focus();
    //    return 0;
    // }
    // if(document.getElementById("email").value == '')
    // {
    //    alert("Digite email") ;  
    //    document.getElementById("email").focus();
    //    return 0;
    // }
    // if(document.getElementById("tipo_medida").value == '')
    // {
    //    alert("Digite tipo_medida") ;  
    //    document.getElementById("tipo_medida").focus();
    //    return 0;
    // }

    if(document.getElementById("kilometraje").value == '')
    {
       alert("Digite kilometraje") ;  
       document.getElementById("kilometraje").focus();
       return 0;
    }
    if(document.getElementById("mecanico").value < 0)
    {
       alert("Digite mecanico") ;  
       document.getElementById("mecanico").focus();
       return 0;
    }
    if(document.getElementById("descripcion").value == '')
    {
       alert("Digite descripcion") ;  
       document.getElementById("descripcion").focus();
       return 0;
    }
  return 1;
}

function muestreDetalleOrden(id){
    var id = id;
    var nivelStorage = sessionStorage.nivel;
    // alert(nivelSessionStorage)
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
              console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
            //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("cuerpoModal").innerHTML  = this.responseText;
           
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('consultarOrden=1'
        +'&id='+id
        +'&nivelStorage='+nivelStorage
        );

}



function crearVehiculo(){
    placa = document.querySelector('#placa').value;
    const http=new XMLHttpRequest();
    const url = '../vehiculos/crearVehiculo.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            //  console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
         //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("resultadosValidacion").innerHTML  = this.responseText;
           
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('placa='+ placa.value
    +'&fecha='+fecha 
    +'&orden_numero_ante='+orden_numero_ante 
    );

}

function  convertMayusculas(){
    var placa =  document.getElementById("placaPeritaje");
    var mayusculas =  placa.value.toUpperCase();
    document.getElementById("placaPeritaje").value = mayusculas;
}

function iraCraerOrden(){
    const http=new XMLHttpRequest();
    // const url = '../orden/crear_orden_nuevo_responsivo.php';
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            //  console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
         //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("div_mostrar_ordenes").innerHTML  = this.responseText;
           document.getElementById("divBotonFormuCreacionOrden").style.display = 'none';
           
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=crearOrden');
}

function pintarOrdenes(){
    const http=new XMLHttpRequest();
    // const url = '../orden/crear_orden_nuevo_responsivo.php';
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            //  console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
         //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("div_general_modulo_ordenes").innerHTML  = this.responseText;
           
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=ordenes');
}
function pintarOrdenesNew(){
    const http=new XMLHttpRequest();
    // const url = '../orden/crear_orden_nuevo_responsivo.php';
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            //  console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
         //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("div_mostrar_ordenes").innerHTML  = this.responseText;
           
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pintarOrdenesNew');
}

function buscarPlacaPeritajeDesdeOrden(){
    var validaPLaca = validaPlaca(); 
    if(validaPlaca)
    {
        var placa = document.getElementById("placaPeritaje").value;
        const http=new XMLHttpRequest();
        const url = '../vehiculos/vehiculos.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("divResultadobusqueda").innerHTML = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=buscarPlacaDesdeOrden"+ "&placa="+placa);

        verificarPlacaRespuestaJson();
    }
}

function validaPlaca()
{
    
    if(document.getElementById("placaPeritaje").value=='')
    {
        alert('por favor digite una placa');
        document.getElementById("placaPeritaje").focus();
        return 0;
    }
    return 1;
}
function verificarPlacaRespuestaJson(){
    var placa = document.getElementById("placaPeritaje").value;
    const http=new XMLHttpRequest();
	const url = '../vehiculos/vehiculos.php';
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
            respu = JSON.parse(this.responseText);
			console.log('filas'+respu);

            if(parseInt(respu) > 0){
                //  crearBoton();
                console.log('existePlaca');
                document.getElementById("divBotonFormuCreacionOrden").style.display = 'block';
            }
            else{
                 document.getElementById("divBotonFormuCreacionOrden").style.display = 'none';
                 var  divCreacionOrden = document.querySelector('#fomularioCracionOrden');
                 divCreacionOrden.innerHTML='';
             }
			// console.log(this.responseText);
			// document.getElementById("divResultadobusqueda").innerHTML = this.responseText;
		}
	};
	http.open("POST",url);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("opcion=verificarPlacaRespuestaJson"+ "&placa="+placa);
}


// function crearBoton(){
//     var  divCreacionOrden = document.querySelector('#fomularioCracionOrden');
//     var btnCreacion = document.createElement('button');
//     btnCreacion.setAttribute('id','btn_mostrar_formulario_creacion_orden');
//     btnCreacion.setAttribute('onclick','mostrarFormularioCreacionOrden();');
//     btnCreacion.setAttribute('class','btn btn-primary btn-lg');
//     btnCreacion.setAttribute('data-toggle','modal');
//     btnCreacion.setAttribute('data-target','#myModalDdatosOrden');
//     btnCreacion.textContent = 'Formulario Creacion de Orden';
//     divCreacionOrden.appendChild(btnCreacion);
// }

function mostrarFormularioCreacionOrden()
{
    var placa = document.getElementById("placaPeritaje").value;
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            //  console.log(this.responseText);
             //var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta.marca);
				// alert(respuesta[0]+' '+ respuesta[1]);
// //		document.getElementById("tipooperacion").text = respuesta[1];
           document.getElementById("cuerpoModalDatosOrden").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('placa='+ placa
                +'&opcion=mostrarFormularioOrden');
}


function grabarVehiculoDesdeOrden()
{
     
     valida = validacionesCarro();
    //  var placa =  document.getElementById("placaPeritaje").value;
    //  alert(placa); 
     if(valida != 0)
     { 
         // alert('pora aqui va ');
         var placa =  document.getElementById("placaPeritaje").value;
         var propietario =  document.getElementById("selectPropietario").value;
         var marca =  document.getElementById("marca").value;
         var linea =  document.getElementById("linea").value;
         var modelo =  document.getElementById("modelo").value;
         var color =  document.getElementById("color").value;
         var vencisoat =  document.getElementById("vencisoat").value;
         var revision =  document.getElementById("revision").value;
         var chasis =  document.getElementById("chasis").value;
         var motor =  document.getElementById("motor").value;

         const http=new XMLHttpRequest();
         const url = '../vehiculos/vehiculos.php';
         http.onreadystatechange = function(){
             if(this.readyState == 4 && this.status ==200){
                 console.log(this.responseText);
                  document.getElementById("divResultadobusqueda").innerHTML = this.responseText;
             }
         };

         http.open("POST",url);
         http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         http.send("opcion=grabarVehiculo1"
                 + "&placa="+placa
                 + "&propietario="+propietario
                 + "&marca="+marca
                 + "&linea="+linea
                 + "&modelo="+modelo
                 + "&vencisoat="+vencisoat
                 + "&revision="+revision
                 + "&chasis="+chasis
                 + "&motor="+motor
                 + "&color="+color
             );
             ///aqui deberia venir el resto del codigo para crear orden 
             //esta es la gran diferencia con relacion al otro guardar vehiculo
             buscarPlacaPeritajeDesdeOrden();
             //activar la ventana de creacion de orden 
             $('#myModalDdatosOrden').modal('show');
             mostrarFormularioCreacionOrden();


             
     }
     //debe ir a validar placa o algo asi 
     
    }


    function pregunteItems(){
    //    alert('digfame el item ');
       //muestre ventana apara introducir nuevo item 
       divPregunteNuevoItem
       var idOrden =  document.getElementById("idOrden").value;
       const http=new XMLHttpRequest();
       const url = '../orden/ordenes.php';
       http.onreadystatechange = function(){
           if(this.readyState == 4 && this.status ==200){
               document.getElementById("divPregunteNuevoItem").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=pregunteNuevoItemOrden"
        + "&idOrden="+idOrden
        );
    }

    function pregunteItemsNew(){
    //    alert('digfame el item ');
       //muestre ventana apara introducir nuevo item 
       var idOrden =  document.getElementById("idOrden").value;
       const http=new XMLHttpRequest();
       const url = '../orden/ordenes.php';
       http.onreadystatechange = function(){
           if(this.readyState == 4 && this.status ==200){
               document.getElementById("cuerpoModalAgregarItems").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=pregunteNuevoItemOrdenNew"
        + "&idOrden="+idOrden
        );
    }




    function mostrarItemsOrden(id){
        //    alert('digfame el item ');
        //muestre ventana apara introducir nuevo item 
        divPregunteNuevoItem
        var idOrden =  document.getElementById("idOrden").value;
        const http=new XMLHttpRequest();
        const url = '../orden/ordenes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_items_orden").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=mostrarItemsOrden"
               + "&idOrden="+idOrden
           );
        }
        
        function cerrarventanaItems()
        {
            document.getElementById("divPregunteNuevoItem").innerHTML = '';
        }
        function grabarNuevoItem(idOrden)
        {
            $valida =  validacionCamposItem();
            if($valida)
            { 
                // alert('agregart item');
                //falta hacer el desarrollo
                var codigo = document.getElementById("codNuevoItem").value;
                var descripcion = document.getElementById("descripan").value;
                var valorUnit = document.getElementById("valorUnitpan").value;
                var cantidad = document.getElementById("cantipan").value;
                var total = document.getElementById("totalItem").value;
                
                const http=new XMLHttpRequest();
                const url = '../orden/ordenes.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                        document.getElementById("divPregunteNuevoItem").innerHTML = '';
                        document.getElementById("div_items_orden").innerHTML = this.responseText;
                    }
                };
                
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("opcion=grabarNuevoItemOrden"
                + "&idOrden="+idOrden
                + "&codigo="+codigo
                + "&descripcion="+descripcion
                + "&valorUnit="+valorUnit
                + "&cantidad="+cantidad
                + "&total="+total
                );
            }        
        }
        function grabarNuevoItemNew(idOrden)
        {
            $valida =  validacionCamposItem();
            if($valida)
            { 
                // alert('agregart item');
                //falta hacer el desarrollo
                var codigo = document.getElementById("codNuevoItem").value;
                var descripcion = document.getElementById("descripan").value;
                var valorUnit = document.getElementById("valorUnitpan").value;
                var cantidad = document.getElementById("cantipan").value;
                var total = document.getElementById("totalItem").value;
                var nivelStorage = sessionStorage.nivel;
                
                const http=new XMLHttpRequest();
                const url = '../orden/ordenes.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                        document.getElementById("divPregunteNuevoItem").innerHTML = '';
                        document.getElementById("div_items_orden").innerHTML = this.responseText;
                        //cerrar ventanas 
                        //para que deje ver la edicion de orden con sus datos
                    }
                };
                
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("opcion=grabarNuevoItemOrden"
                + "&idOrden="+idOrden
                + "&codigo="+codigo
                + "&descripcion="+descripcion
                + "&valorUnit="+valorUnit
                + "&cantidad="+cantidad
                + "&total="+total
                + "&nivelStorage="+nivelStorage

                );
            }        
        }
        
        function validacionCamposItem()
        {
            if( document.getElementById("codNuevoItem").value == '')
            {
                document.getElementById("codNuevoItem").focus();
                alert('Por favor digitar Codigo');
                return 0;
            }
                if( document.getElementById("descripan").value == '')
                {
                    document.getElementById("descripan").focus();
                    alert('Por favor digitar Descripcion');
                    return 0;
                }
                if( document.getElementById("valorUnitpan").value == '')
                {
                    document.getElementById("valorUnitpan").focus();
                    alert('Por favor digitar Valor Unitario');
                    return 0;
                }
                if( document.getElementById("cantipan").value == '')
                {
                    document.getElementById("cantipan").focus();
                    alert('Por favor digitar la cantidad');
                    return 0;
                }
                if( document.getElementById("totalItem").value == '')
                {
                    document.getElementById("totalItem").focus();
                    alert('Por favor digitar total');
                    return 0;
                }
                //aqui se deberia incluir una validacion para revisar si el inventario no es inferior a lo que se esta vendiendo 

                return 1;
                
            }
            
    function validarCantVentaVsExistencias()
            {
                var cantidadVenta = document.getElementById("cantipan").value;
                
            }
            function cerrarVentanaNuevoItem()
            {
                document.getElementById("divPregunteNuevoItem").innerHTML = '';
            }
            
            function verificarSiExisteCodigo()
            {
                var codigo = document.getElementById("codNuevoItem").value;
                const http=new XMLHttpRequest();
                const url = '../orden/ordenes.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                        var  resp = JSON.parse(this.responseText); 
                        // alert('respuesta'+ resp.data.descripcion);
                        if(resp.filas == 1)
                        {    
                            document.getElementById("descripan").value = resp.data.descripcion;
                            document.getElementById("valorUnitpan").value = resp.data.valorventa;
                            document.getElementById("existencias").innerHTML = resp.data.cantidad;
                            document.getElementById("inputexistencias").value = resp.data.cantidad;
                            document.getElementById("valorUnitpan").value = resp.data.valorventa;
                            document.getElementById("referenciapan").value = resp.data.referencia;
                        }
                        else{
                            document.getElementById("descripan").value = '';
                            document.getElementById("valorUnitpan").value = '';
                            document.getElementById("existencias").innerHTML = '';
                            document.getElementById("inputexistencias").value = '';
                            document.getElementById("valorUnitpan").value = '';
                            document.getElementById("referenciapan").value = '';

                        }
                    }
                };
                
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("opcion=verificarSiexisteCodigo"
                + "&codigo="+codigo
                );
        
            }
            
            function generarTotalItem()
            {
                var valorUnitario =  document.getElementById("valorUnitpan").value;
                var cantidad =  document.getElementById("cantipan").value;
                var total = parseInt(valorUnitario) *  parseInt(cantidad);
                document.getElementById("totalItem").value = total;
            }
            
            function eliminarItemOrden(idItem)
            {
                // alert (idItem);
                const http=new XMLHttpRequest();
                const url = '../orden/ordenes.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                        // var  resp = JSON.parse(this.responseText); 
                        // alert('respuesta'+ resp.data.descripcion);
                        document.getElementById("divPregunteNuevoItem").innerHTML = '';
                        document.getElementById("div_items_orden").innerHTML = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("opcion=eliminarItem"
                + "&idItem="+idItem
                );
            }
            
function formuFiltrosBusqueda(){

    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            // var  resp = JSON.parse(this.responseText); 
            // alert('respuesta'+ resp.data.descripcion);
            document.getElementById("cuerpoModalFiltrosOrdenes").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=formuFiltrosOrdenes"
    );
    
}

function busqueCodigosConFiltroOrdenes()
{
    var placa = document.getElementById("txtPlacaBuscar").value;
    // var nombre = document.getElementById("txtBuscarNombre").value;
    var idEstado = document.getElementById("idEstadoOrden").value;
    
    // console.log(referencia);
    // divResultadosInventarios
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("div_mostrar_ordenes").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=busqueOrdenesConFiltro"
    + "&placa="+placa
    // + "&nombre="+nombre
    + "&idEstado="+idEstado
    );
}

function actualizarInfoOrden(id)
{
    // alert('buenas'+id);
    var idEstadoOrden =  document.getElementById("idEstadoOrden").value;
    var idMecanico =  document.getElementById("idMecanicoAsignado").value;
    var observacionestecnico = document.getElementById("txtobservacionestecnico").value;
    // alert (idMecanico);
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModal").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=actualizarOrden"
    + "&id="+id
    + "&idEstadoOrden="+idEstadoOrden
    + "&observacionestecnico="+observacionestecnico
    + "&idMecanico="+idMecanico
    );
    pintarOrdenesNew();
}

function filtroBuscarCodigoIngresoOrden()
{
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalFiltrosCodigos").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=formuFiltrosInventarioOrden"
    // + "&nombre="+nombre
    );
}
function filtroBuscarCodigoIngresoOrdenNew()
{
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalFiltrosCodigosNew").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=formuFiltrosInventarioOrden"
    // + "&nombre="+nombre
    );
}



function busqueCodigosConFiltroOrden()
{
    var referencia = document.getElementById("txtReferencia").value;
    var descripcion = document.getElementById("txtBuscarDescrip").value;
    // console.log(referencia);
    // divResultadosInventarios
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divMuestreCodigosaBuscar").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=busqueCodigosConFiltroOrden"
    + "&referencia="+referencia
    + "&descripcion="+descripcion
    );
}

function colocarInfoCodigoEnItem(idCod)
{
    const http=new XMLHttpRequest();
    const url = '../inventario_codigos/codigosInventario.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            var resp = JSON.parse(this.responseText);
            console.log(resp.descripcion); 
            // alert(resp.descripcion); 
            // document.getElementById("divMuestreCodigosaBuscar").innerHTML = this.responseText;
            document.getElementById("codNuevoItem").value = resp.codigo_producto;
            document.getElementById("descripan").value = resp.descripcion;
            document.getElementById("valorUnitpan").value = resp.valorventa;
            document.getElementById("referenciapan").value = resp.referencia;
            document.getElementById("referenciapan").value = resp.referencia;
            document.getElementById("inputexistencias").value = resp.cantidad;
            document.getElementById("existencias").innerHTML = resp.cantidad;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=traerInfoCodeJson"
    + "&idCod="+idCod
    );
}

function mostrarFormuRecibo(idOrden)
{
    var idEstadoOrden = document.getElementById("idEstadoOrden").value;
    if(idEstadoOrden==2)
    {
        $('#myModalCaja').modal('show'); 
        
        setTimeout(() => {
                const http=new XMLHttpRequest();
                const url = '../caja/caja.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                        // var resp = JSON.parse(this.responseText);
                        // console.log(resp.descripcion); 
                        // alert(resp.descripcion); 
                        document.getElementById("cuerpoModalCaja").innerHTML = this.responseText;
                        // document.getElementById("codNuevoItem").value = resp.codigo_producto;
                        // document.getElementById("descripan").value = resp.descripcion;
                        // document.getElementById("valorUnitpan").value = resp.valor_unit;
                    }
                };
                
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("opcion=pregunteEntradaCaja"
                + "&idOrden="+idOrden
                + "&tipo=1"
                );
            
          }, "500");
    }
}

function muestrePdfOrden(idOrden)
{
    // alert(idOrden); 
    const http=new XMLHttpRequest();
    const url = '../orden/pdf/ordenPdf2.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            // var resp = JSON.parse(this.responseText);
            // console.log(resp.descripcion); 
            // alert(resp.descripcion); 
            // document.getElementById("divMuestreCodigosaBuscar").innerHTML = this.responseText;
            // document.getElementById("codNuevoItem").value = resp.codigo_producto;
            // document.getElementById("descripan").value = resp.descripcion;
            // document.getElementById("valorUnitpan").value = resp.valorventa;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("idOrden=idOrden"
    // + "&idOrden="+idOrden
    );
}

function preguntarSeguroReversarFacturada(idOrden)
{
    // alert(idOrden);
//    var confirmacion = confirm('Esta seguro de reversar ');
//    alert(confirmacion);
//    if(confirmacion='true')
//    {
        const http=new XMLHttpRequest();
        const url = '../orden/ordenes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                // var resp = JSON.parse(this.responseText);
                // console.log(resp.descripcion); 
                // alert(resp.descripcion); 
                // document.getElementById("cuerpoModalReversionFacturada").innerHTML = this.responseText;
                document.getElementById("cuerpoModalReversionFacturada").innerHTML = '';
                // document.getElementById("divAviso").innerHTML = 'Facturacion Reversada';

                // document.getElementById("codNuevoItem").value = resp.codigo_producto;
                // document.getElementById("descripan").value = resp.descripcion;
                // document.getElementById("valorUnitpan").value = resp.valorventa;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=reversarFacturada"
        + "&idOrden="+idOrden
        );
        cerraMymodalYpintarOrdenes();
    // }
}
function cerraMymodalYpintarOrdenes()
{
    // $('#myModalReversionFacturada').modal('hide');  
    $('#myModal2').modal('hide');  
    pintarOrdenes();
}

function mostrarImagenesOrden(idOrden)
{
    const http=new XMLHttpRequest();
    const url = '../orden/ordenes.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            var resp = JSON.parse(this.responseText);
            // console.log(resp.descripcion); 
            // alert(resp.descripcion); 
            document.getElementById("cuerpoModalImagenes").innerHTML = this.responseText;
            // document.getElementById("codNuevoItem").value = resp.codigo_producto;
            // document.getElementById("descripan").value = resp.descripcion;
            // document.getElementById("valorUnitpan").value = resp.valorventa;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=mostrarImagenesOrden"
    + "&idOrden="+idOrden
    );
}