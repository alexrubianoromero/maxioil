function pantallaNuevaVenta()
{
    // alert('ventas ');
    const http=new XMLHttpRequest();
    const url = '../ventas/ventas.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalNuevaVenta").innerHTML  = this.responseText;
            localStorage.removeItem('arregloItemsVenta');
            //eliminarlo y volver a crear el arreglo que contiene los items 
            //limpiar el valor del la variable de localStorage
            
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pantallaNuevaVenta');
}


function pregunteItemsNewVentas(){
    //    alert('digfame el item ');
       //muestre ventana apara introducir nuevo item 
       var idTemp =  document.getElementById("idTemp").value;
       const http=new XMLHttpRequest();
       const url = '../ventas/ventas.php';
       http.onreadystatechange = function(){
           if(this.readyState == 4 && this.status ==200){
               document.getElementById("cuerpoModalAgregarItemsNew").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=pregunteNuevoItemNewVentas"
        + "&idTemp="+idTemp
        );
    }
    
    
    function filtroBuscarCodigoIngresoOrdenNewVentas()
    {
        const http=new XMLHttpRequest();
        const url = '../ventas/ventas.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalFiltrosCodigosNew2").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=formuFiltrosInventarioVentas"
        // formuFiltrosInventarioOrden
        // + "&nombre="+nombre
        );
    }


    function busqueCodigosConFiltroVentas()
    {
        var referencia = document.getElementById("txtReferencia").value;
        var descripcion = document.getElementById("txtBuscarDescrip").value;
        // console.log(referencia);
        // divResultadosInventarios
        const http=new XMLHttpRequest();
        const url = '../ventas/ventas.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("divMuestreCodigosaBuscarVentas").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=busqueCodigosConFiltroVentas"
        + "&referencia="+referencia
        + "&descripcion="+descripcion
        );
    }
    
    function colocarInfoCodigoEnItemVentas(idCod)
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
                document.getElementById("idCodigopan").value = resp.id_codigo;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=traerInfoCodeJson"
        + "&idCod="+idCod
        );
    }
    
    
    function agregarItemTemporalVenta(idOrden)
    {
        $valida =  validacionCamposItemVentas();
        if($valida)
        { 
            // alert('agregart item');
            //falta hacer el desarrollo
            var idTemp =  document.getElementById("idTemp").value;
            var codigo = document.getElementById("codNuevoItem").value;
            var descripcion = document.getElementById("descripan").value;
            var valorUnit = document.getElementById("valorUnitpan").value;
            var cantidad = document.getElementById("cantipan").value;
            var total = document.getElementById("totalItem").value;
            var idCodigo = document.getElementById("idCodigopan").value;
            var nivelStorage = sessionStorage.nivel;
            
            const http=new XMLHttpRequest();
            const url = '../ventas/ventas.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    // document.getElementById("divPregunteNuevoItem").innerHTML = '';
                    document.getElementById("div_muestre_info_codigo").innerHTML = this.responseText;
                    //deberia agregarlo al localStorage
                    //cerrar ventanas 
                    //para que deje ver la edicion de orden con sus datos
                }
            };
            
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=grabarItemsTemporalVenta"
            + "&idTemp="+idTemp
            + "&codigo="+codigo
            + "&descripcion="+descripcion
            + "&valorUnit="+valorUnit
            + "&cantidad="+cantidad
            + "&total="+total
            + "&idCodigo="+idCodigo
            + "&nivelStorage="+nivelStorage
            
            );
        }        
    }

    function validacionCamposItemVentas()
    {
        if( document.getElementById("codNuevoItem").value == '')
        {
            document.getElementById("codNuevoItem").focus();
            alert('Por favor digitar Codigo..');
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
    
    function verificarSiExisteCodigoVentas()
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
                    document.getElementById("idCodigopan").value = resp.data.id_codigo;
                }
                else{
                    document.getElementById("descripan").value = '';
                    document.getElementById("valorUnitpan").value = '';
                    document.getElementById("existencias").innerHTML = '';
                    document.getElementById("inputexistencias").value = '';
                    document.getElementById("valorUnitpan").value = '';
                    document.getElementById("referenciapan").value = '';
                    document.getElementById("idCodigopan").value = '';
                    
                }
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=verificarSiexisteCodigo"
        + "&codigo="+codigo
        );
        
    }
    
    
    function grabarVenta()
    {
        // alert('grabar');
        var idTemp =  document.getElementById("idTemp").value;
        const http=new XMLHttpRequest();
        const url = '../ventas/ventas.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                var  resp = JSON.parse(this.responseText); 
                var idVenta = resp.idVenta;
                mostrarFormuReciboVentas(idVenta);
                // document.getElementById("div_resultado_ventas").innerHTML  = this.responseText;
                // alert()
                // localStorage.removeItem('arregloItemsVenta');
                //eliminarlo y volver a crear el arreglo que contiene los items 
                //limpiar el valor del la variable de localStorage
                
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarVenta'
                + "&idTemp="+idTemp
        );
    }

    function mostrarFormuReciboVentas(idVenta)
    {
    // var idEstadoOrden = document.getElementById("idEstadoOrden").value;
    // if(idEstadoOrden==2)
    // {
        // alert('idVenta '+idVenta);
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
                + "&idVenta="+idVenta
                + "&tipo=1"
                );
            
          }, "500");
    // }
}

    
    // function grabarNuevoItemNewVenta(idOrden)
    // {
        //     $valida =  validacionCamposItem();
        //     if($valida)
        //     { 
            //         // alert('agregart item');
            //         //falta hacer el desarrollo
            //         var codigo = document.getElementById("codNuevoItem").value;
            //         var descripcion = document.getElementById("descripan").value;
            //         var valorUnit = document.getElementById("valorUnitpan").value;
            //         var cantidad = document.getElementById("cantipan").value;
                //         var total = document.getElementById("totalItem").value;
                //         var nivelStorage = sessionStorage.nivel;
                
                //         const http=new XMLHttpRequest();
                //         const url = '../orden/ordenes.php';
                //         http.onreadystatechange = function(){
                    //             if(this.readyState == 4 && this.status ==200){
                        //                 document.getElementById("divPregunteNuevoItem").innerHTML = '';
                        //                 document.getElementById("div_items_orden").innerHTML = this.responseText;
                        //                 //cerrar ventanas 
                        //                 //para que deje ver la edicion de orden con sus datos
                        //             }
                        //         };
                        
                        //         http.open("POST",url);
                        //         http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        //         http.send("opcion=grabarNuevoItemOrden"
                        //         + "&idOrden="+idOrden
                        //         + "&codigo="+codigo
                        //         + "&descripcion="+descripcion
                        //         + "&valorUnit="+valorUnit
                        //         + "&cantidad="+cantidad
                        //         + "&total="+total
                        //         + "&nivelStorage="+nivelStorage
                        
                        //         );
                        //     }        
                        // }
