function mostrarClientes(){
    const http=new XMLHttpRequest();
    const url = '../clientes/clientesResponsivo.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
              console.log(this.responseText);
           document.getElementById("divResultadosClientes").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=verClientes"
    );
}





function btnNuevoPropietario(){

    // alert('nuevo propietario ');

    const http=new XMLHttpRequest();

    const url = '../clientes/clientesResponsivo.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

            console.log(this.responseText);

            // document.getElementById("headerNuevoCliente").style.backgroundColor="gray"

            // document.getElementById("footerNuevoCliente").style.backgroundColor="gray"

            // document.getElementById("cuerpoModalClientes").style.backgroundColor="gray"

            document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send("opcion=nuevoPropietario"

        );

}



function nuevoPropietarioDesdeVehiculo(){

    // alert('nuevo propietario ');

    const http=new XMLHttpRequest();

    const url = '../clientes/clientesResponsivo.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

            console.log(this.responseText);

            // document.getElementById("headerNuevoCliente").style.backgroundColor="gray"

            // document.getElementById("footerNuevoCliente").style.backgroundColor="gray"

            // document.getElementById("cuerpoModalClientes").style.backgroundColor="gray"

            document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send("opcion=nuevoPropietarioDesdeVehiculo"

        );

}





function grabarPrpietario()

{

     valida = validacionesPropietario();

     if(valida != 0)

     {

         var identi =  document.getElementById("identi").value;

         var nombre =  document.getElementById("nombre").value;

         var telefono =  document.getElementById("telefono").value;

         var direccion =  document.getElementById("direccion").value;

         var observaciones =  document.getElementById("observaciones").value;

         var email =  document.getElementById("email").value;

         const http=new XMLHttpRequest();

         const url = '../clientes/clientesResponsivo.php';

         http.onreadystatechange = function(){

             if(this.readyState == 4 && this.status ==200){

                 console.log(this.responseText);

                 document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;

             }

         };



         http.open("POST",url);

         http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

         http.send("opcion=grabarPropietario"

                     + "&identi="+identi

                     + "&nombre="+nombre

                     + "&telefono="+telefono

                     + "&direccion="+direccion

                     + "&observaciones="+observaciones

                     + "&email="+email

             );



             //aqui debe llamar otra funcion qque busque el ultimo cliente grabado y

             //lo deje seleccionado en el selec de propietario de la captura de datos de la moto

            //  setTimeout(function(){ 

            //  cargarSelectClienteId();

            //  },500);

            //  setTimeout(function(){ 

            //      document.getElementById("marca").focus();

            //  },500);

     }     

}   

     



function grabarPropietarioDesdeVehiculos()

{

     valida = validacionesPropietario();

     if(valida != 0)

     {

         var identi =  document.getElementById("identi").value;

         var nombre =  document.getElementById("nombre").value;

         var telefono =  document.getElementById("telefono").value;

         var direccion =  document.getElementById("direccion").value;

         var observaciones =  document.getElementById("observaciones").value;

         var email =  document.getElementById("email").value;

         const http=new XMLHttpRequest();

         const url = '../clientes/clientesResponsivo.php';

         http.onreadystatechange = function(){

             if(this.readyState == 4 && this.status ==200){

                 console.log(this.responseText);

                 document.getElementById("cuerpoModalClientes").innerHTML = this.responseText;

             }

         };



         http.open("POST",url);

         http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

         http.send("opcion=grabarPropietario"

                     + "&identi="+identi

                     + "&nombre="+nombre

                     + "&telefono="+telefono

                     + "&direccion="+direccion

                     + "&observaciones="+observaciones

                     + "&email="+email

             );



             //aqui debe llamar otra funcion qque busque el ultimo cliente grabado y

             //lo deje seleccionado en el selec de propietario de la captura de datos de la moto

             setTimeout(function(){ 

             cargarSelectClienteId();

             },500);

             setTimeout(function(){ 

                 document.getElementById("marca").focus();

             },500);

     }     

 }



 function cargarSelectClienteId(){

    const http=new XMLHttpRequest();

    const url = '../clientes/clientesResponsivo.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

            console.log(this.responseText);

            document.getElementById("selectPropietario").innerHTML = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send("opcion=cargarUltimoPropietario");   

}







function validacionesPropietario(){

    if(document.getElementById("identi").value == '')

    {

       alert("Digite Identidad") ;  

       document.getElementById("identi").focus();

       return 0;

    }

    if(document.getElementById("nombre").value == 0)

    {

       alert("Digite nombre ") ;  

       document.getElementById("nombre").focus();

       return false

    }

    if(document.getElementById("telefono").value == 0)

    {

       alert("Digite telefono ") ;  

       document.getElementById("telefono").focus();

       return false

    }

    if(document.getElementById("direccion").value == 0)

    {

       alert("Digite direccion ") ;  

       document.getElementById("direccion").focus();

       return false

    }

    if(document.getElementById("email").value == 0)

    {

       alert("Digite email  ") ;  

       document.getElementById("email").focus();

       return false

    }

    if(document.getElementById("observaciones").value == 0)

    {

       alert("Digite observaciones ") ;  

       document.getElementById("observaciones").focus();

       return false

    }

    return 1;

}

     

 









 function validarIdentidad(identi){

    // alert(identi);

    document.getElementById("infoVerificaciones").innerHTML = '';
    const http=new XMLHttpRequest();
    const url = '../clientes/clientesResponsivo.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("infoVerificaciones").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=validarIdenti"
            + "&identi="+identi
        );
}

function pantallaBusdqueda(idCliente)
{
    // alert(idCliente)

    const http=new XMLHttpRequest();
    const url = '../clientes/clientesResponsivo.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("cuerpoModalClientesInfo").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=buscarClientePorId"
            + "&idCliente="+idCliente
        );
}

function muestreHistorialVehiculo(placa)
{
    // alert(placa); 
    // var placa = document.getElementById("txtplaca").value;
    // alert('desde js'+placa);
    const http=new XMLHttpRequest();
    const url = '../vehiculos/vehiculos.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("cuerpoModalClientesHisto").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=mostrarHistorialVehiculo"
            + "&placa="+placa
            );
        }
        
        
function buscarClientePorNombre()
{
    var nombre =  document.getElementById("txtBuscarNombre").value;
    const http=new XMLHttpRequest();
    const url = '../clientes/clientesResponsivo.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("divResultadosClientes").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(
        "opcion=buscarClientePorNombre"
        + "&nombre="+nombre
        );
    }
    
    function busquedaAvanzada()
    {
        // alert('avanzada');
        const http=new XMLHttpRequest();
        const url = '../clientes/clientesResponsivo.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("cuerpoModalClientesFiltro").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send(
            "opcion=formuFiltroBusqueda"
            );
            
        }
        
        function buscarClienteFiltros()
        {
            var identi =  document.getElementById("txtBuscarIdenti").value;
            var telefono =  document.getElementById("txtBuscarTelefono").value;
            const http=new XMLHttpRequest();
            const url = '../clientes/clientesResponsivo.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    console.log(this.responseText);
                    document.getElementById("divResultadosClientes").innerHTML  = this.responseText;
                }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send(
                "opcion=buscarPorFiltros"
                + "&identi="+identi
                + "&telefono="+telefono
                );
            }
