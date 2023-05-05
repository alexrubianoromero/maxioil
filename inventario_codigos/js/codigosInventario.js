function verifiqueCodigo()
{
    // alert('Proceso de verificacion de codigo  ');
    //se debe verificar si existe este codigo 
    //en caso de que exista se debe traer 
    var codigo = document.getElementById("inputCodigo").value;
        
        const http=new XMLHttpRequest();
        const url = '../orden/ordenes.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                var  resp = JSON.parse(this.responseText); 
                if(resp.filas == 1)
                {    
                    // alert (resp.data.producto_minimo);
                    document.getElementById("inputDescripcion").value = resp.data.descripcion;
                    document.getElementById("inputCantidad").value = resp.data.cantidad;
                    document.getElementById("inputPrecioCompra").value = resp.data.precio_compra;
                    document.getElementById("inputReferencia").value = resp.data.referencia;
                    document.getElementById("inputPrecioVenta").value = resp.data.valorventa;
                    document.getElementById("inputCantMinima").value = resp.data.producto_minimo;

                    document.getElementById("btnProducto").style.display = 'none';
                    document.getElementById("divRespuCodigo2").innerHTML  = 'Este Codigo ya existe, no se puede crear nuevamente';
                }else{
                    document.getElementById("inputDescripcion").value = '';
                    document.getElementById("inputCantidad").value = '';
                    document.getElementById("inputPrecioCompra").value = '';
                    document.getElementById("inputPrecioVenta").value = '';
                    document.getElementById("inputReferencia").value = '';
                    document.getElementById("inputPrecioVenta").value = resp.data.valorventa;
                    document.getElementById("inputCantMinima").value = resp.data.producto_minimo;

                    document.getElementById("btnProducto").style.display = 'block';
                    document.getElementById("divRespuCodigo2").innerHTML  = '';

                }

            }
        };

        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=verificarSiexisteCodigo"
        + "&codigo="+codigo
        );
        

    }

    function mostrarAviso()
    {
        alert ('click en descripan');
    }

    function pantallaInventario()
    {
        document.getElementById("imagenInicial").style.display = 'none';

        document.getElementById("divBotonesPrincipales").style.display = 'block';

        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_principal").innerHTML = this.responseText;
            }
        };

        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=vistaPrincipalInventarios");
    }

    function mostrarInfoCodigo(idCodigo){
        // alert('info codigo');
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
            }
        };

        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=mostrarCodigo"
            +"&idCodigo="+idCodigo  
        );
    }

    function pregunteNuevoCodigo(){
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalProducto").innerHTML = this.responseText;
            }
        };

        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=pregunteNuevoCodigo");
    }
    function grabarProducto()
    {
        var valida = validacionesNuevoCodigo();
        if(valida)
        {
            var codigo = document.getElementById("inputCodigo").value;
            var descripcion = document.getElementById("inputDescripcion").value;
            var cantidad = document.getElementById("inputCantidad").value;
            var precioCompra = document.getElementById("inputPrecioCompra").value;
            var precioVenta = document.getElementById("inputPrecioVenta").value;
            var tipoCod = document.getElementById("tipo").value;
            var referencia = document.getElementById("inputReferencia").value;
            var cantidadMinima = document.getElementById("inputCantMinima").value;
            var alerta = document.getElementById("alerta").value;


            const http=new XMLHttpRequest();
            const url = '../inventario_codigos/codigosInventario.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById("cuerpoModalProducto").innerHTML = this.responseText;
                }
            };

            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=grabarCodigo"
            + "&codigo="+codigo
            + "&descripcion="+descripcion
            + "&cantidad="+cantidad
            + "&precioCompra="+precioCompra
            + "&precioVenta="+precioVenta
            + "&tipoCod="+tipoCod
            + "&referencia="+referencia
            + "&cantidadMinima="+cantidadMinima
            + "&alerta="+alerta
            );

            // pantallaInventario();
        }
    }
    function actualizarProducto()
    {
        var valida = validacionesNuevoCodigo();
        if(valida)
        {
            var idCodigo = document.getElementById("inputIdCodigo").value;
            var codigo = document.getElementById("inputCodigo").value;
            var descripcion = document.getElementById("inputDescripcion").value;
            var cantidad = document.getElementById("inputCantidad").value;
            var precioCompra = document.getElementById("inputPrecioCompra").value;
            var precioVenta = document.getElementById("inputPrecioVenta").value;
            var tipoCod = document.getElementById("tipo").value;
            var referencia = document.getElementById("inputReferencia").value;
            var cantidadMinima = document.getElementById("inputCantMinima").value;
            var alerta = document.getElementById("alerta").value;


            const http=new XMLHttpRequest();
            const url = '../inventario_codigos/codigosInventario.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
                }
            };

            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=actualizarCodigo"
            + "&idCodigo="+idCodigo
            + "&codigo="+codigo
            + "&descripcion="+descripcion
            + "&cantidad="+cantidad
            + "&precioCompra="+precioCompra
            + "&precioVenta="+precioVenta
            + "&tipoCod="+tipoCod
            + "&referencia="+referencia
            + "&cantidadMinima="+cantidadMinima
            + "&alerta="+alerta
            );

            // pantallaInventario();
        }
    }

    
    function validacionesNuevoCodigo()
    {
            if(document.getElementById("inputCodigo").value=='')
            {
                alert('Por favor digite un codigo ');
                document.getElementById("inputCodigo").focus();
                return false;
            }
            if(document.getElementById("inputReferencia").value=='')
            {
                alert('Por favor digite una referencia');
                document.getElementById("inputReferencia").focus();
                return false;
            }
            if(document.getElementById("inputDescripcion").value=='')
            {
                alert('Por favor digite una descripcion ');
                document.getElementById("inputDescripcion").focus();
                return false;
            }
            if(document.getElementById("inputCantidad").value=='')
            {
                alert('Por favor digite cantidad ');
                document.getElementById("inputCantidad").focus();
                return false;
            }
            if(document.getElementById("inputPrecioCompra").value=='')
            {
                alert('Por favor digite costo ');
                document.getElementById("inputPrecioCompra").focus();
                return false;
            }
            if(document.getElementById("inputPrecioVenta").value=='')
            {
                alert('Por favor digite precio venta');
                document.getElementById("inputPrecioVenta").focus();
                return false;
            }
            if(document.getElementById("tipo").value=='')
            {
                alert('Por favor escoja un tipo ');
                document.getElementById("tipo").focus();
                return false;
            }
            if(document.getElementById("inputCantMinima").value=='')
            {
                alert('Por favor indique cantidad minima ');
                document.getElementById("inputCantMinima").focus();
                return false;
            }
            if(document.getElementById("alerta").value=='')
            {
                alert('Por favor indique valor en alerta ');
                document.getElementById("alerta").focus();
                return false;
            }

            return true;
    }

    function aumentarInventario(id){
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalAumentarProducto").innerHTML = this.responseText;
                document.getElementById("cantidad").focus();
            }
        };

        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=aumentarDisminuirInventario"
        + "&id="+id
        + "&tipoMov=1"
        );
        colocarFoco();
    }

    function colocarFoco()
    {
        document.getElementById("cantidad").focus();
    }


    function disminuirInventario(id){
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalAumentarProducto").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=aumentarDisminuirInventario"
        + "&id="+id
        + "&tipoMov=2"
        );
    }

    function grabarEntradaSalidaInventario(id)
    {
        var valida = validacionesGrabarMovInventario();
        if(valida)
        {
            var factura = document.getElementById("factura").value;
            var cantidad = document.getElementById("cantidad").value;
            var tipo  = document.getElementById("tipo").value;
            var observaciones  = document.getElementById("observaciones").value;
            const http=new XMLHttpRequest();
            const url = '../inventario_codigos/codigosInventario.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    document.getElementById("cuerpoModalAumentarProducto").innerHTML = this.responseText;
                }
            };
            
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=grabarEntradaSalidaInventario"
            + "&id="+id
            + "&factura="+factura
            + "&cantidad="+cantidad
            + "&tipo="+tipo
            + "&observaciones="+observaciones
            );
        }  
    }
    
    function validacionesGrabarMovInventario()
    {
        // if(document.getElementById("factura").value=='')
        // {
        //     alert('Por favor digite un documento o factura de compra o de venta segun el caso  ');
        //     document.getElementById("factura").focus();
        //     return false;
        // }
        if(document.getElementById("cantidad").value=='')
        {
            alert('Por favor digite cantidad ');
            document.getElementById("cantidad").focus();
            return false;
        }
        // if(document.getElementById("observaciones").value=='')
        // {
        //     alert('Por favor digite observaciones ');
        //     document.getElementById("observaciones").focus();
        //     return false;
        // }

        return true;
    } 

    function pregunteFiltrosCodigo()
    {
        // alert('filtro codigos');
        // divResultadosInventarios
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalFiltroCodigos").innerHTML = this.responseText;
            }
        };

        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send(
            "opcion=formuFiltrosInventario"
            // + "&id="+id
            // + "&factura="+factura
            // + "&cantidad="+cantidad
            // + "&tipo="+tipo
            );
            
            
        }
        
        function busqueCodigosConFiltro()
        {
            var referencia = document.getElementById("txtReferencia").value;
            var descripcion = document.getElementById("txtBuscarDescrip").value;
        // console.log(referencia);
        // divResultadosInventarios
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("divResultadosInventarios").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=busqueCodigosConFiltro"
        + "&referencia="+referencia
        + "&descripcion="+descripcion
        );
    }
    
    function verAlertasDeInventario()
    {
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalAlertas").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=verAlertasInventario"
        
        );
    }
    
    function editarCodigo(idCodigo)
    {
        const http=new XMLHttpRequest();
        const url = '../inventario_codigos/codigosInventario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=editarCodigo"
        + "&idCodigo="+idCodigo
        
        );
    }
    
function eliminarCodigo(idCodigo)
{
    // alert(idCodigo);
    const http=new XMLHttpRequest();
    const url = '../inventario_codigos/codigosInventario.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalProducto").innerHTML = this.responseText;
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=eliminarCodigo"
    + "&idCodigo="+idCodigo
    
    );

}

