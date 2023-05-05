
function verifiqueCredeciales()
{
    var user = document.getElementById("txtUsuario").value;
    var clave = document.getElementById("txtClave").value;
    const http=new XMLHttpRequest();
    const url = '../movil/index.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
           document.getElementById("div_principal").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verificarCredenciales'
    + "&user="+user
    + "&clave="+clave
    );

    verificarCredencialesJsonAsignarSessionStorage(user,clave);
}

function verificarCredencialesJsonAsignarSessionStorage(user,clave)
{
    //  alert(user+ '--'+ clave);
    
    const http=new XMLHttpRequest();
    const url = '../movil/index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            var  resp = JSON.parse(this.responseText); 
            if(resp.valida == 1)
            {    
                // alert('respuesta: '+ resp.valida + 'usuario '+ resp.datos.login+ ' '+resp.datos.id_usuario+ ' '+resp.datos.nivel);
                sessionStorage.id_usuario = resp.datos.id_usuario;
                sessionStorage.usuario = resp.datos.login;
                sessionStorage.nivel = resp.datos.nivel;
                menuPrincipal();
            }
            else{
                alert('Usuario o Clave incorrectos '); 
            }
        }
    };
    
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=verificarCredencialesRespJson"
    + "&user="+user
    + "&clave="+clave
    );
}
function menuPrincipal(){

    document.getElementById("imagenInicial").style.display = 'block';

    document.getElementById("divBotonesPrincipales").style.display = 'none';

    const http=new XMLHttpRequest();

    const url = '../movil/index.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            var id_usuario = sessionStorage.id_usuario;
            var usuario = sessionStorage.usuario;
            var nivel =  sessionStorage.nivel;
            // alert(nivel);
            document.getElementById("id_usuario").value = id_usuario;
             document.getElementById("usuario").value = usuario;
            document.getElementById("nivel").value = nivel;
            //  console.log(this.responseText);

             //var respuesta = JSON.parse(this.responseText);

            // console.log(respuesta.marca);

				// alert(respuesta[0]+' '+ respuesta[1]);

         //		document.getElementById("tipooperacion").text = respuesta[1];

           document.getElementById("div_principal").innerHTML  = this.responseText;

           

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send('opcion=menuPrincipal'
    + "&nivel="+ sessionStorage.nivel
    );

}



function pantallaClientes(){



    // alert('buenas');

    // document.body.style.backgroundColor  = "black"; 

    // document.body.style.color  = "white"; 

    

    document.getElementById("imagenInicial").style.display = 'none';

    document.getElementById("divBotonesPrincipales").style.display = 'block';



    const http=new XMLHttpRequest();

    const url = '../clientes/clientesResponsivo.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

           document.getElementById("div_principal").innerHTML  = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send();

}



function salirSistema(){

    const http=new XMLHttpRequest();

    const url = '../movil/index.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

           document.getElementById("divTotal").innerHTML  = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send('opcion=salirSistema'

    );

}



function pantallaMotos(){

    // document.body.style.backgroundColor  = "black"; 

    // document.body.style.color  = "white"; 

    

    document.getElementById("imagenInicial").style.display = 'none';

    document.getElementById("divBotonesPrincipales").style.display = 'block';



    const http=new XMLHttpRequest();

    const url = '../vehiculos/vehiculos.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

           document.getElementById("div_principal").innerHTML  = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send();

}



function pantallaOrdenes(){

    // document.body.style.backgroundColor  = "black"; 

    // document.body.style.color  = "white"; 

    

    document.getElementById("imagenInicial").style.display = 'none';

    document.getElementById("divBotonesPrincipales").style.display = 'block';



    const http=new XMLHttpRequest();

    const url = '../orden/ordenes.php';

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){

           document.getElementById("div_principal").innerHTML  = this.responseText;

        }

    };

    http.open("POST",url);

    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.send('opcion=ordenes'

    );
}


    function pantallaAyudasFinancieras()
    {
        document.getElementById("imagenInicial").style.display = 'none';
        document.getElementById("divBotonesPrincipales").style.display = 'block';    
        const http=new XMLHttpRequest();
        const url = '../ayudas_financieras/ayudasFinancieras.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
            document.getElementById("div_principal").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=menuAyudasFinancieras');
    }
    
    function pantallaTecnicos()
    {
        document.getElementById("imagenInicial").style.display = 'none';
        document.getElementById("divBotonesPrincipales").style.display = 'block';    
        const http=new XMLHttpRequest();
        const url = '../tecnicos/tecnicosmovil.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_principal").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=pantallaPrincipalTecnicos');
    }
    
    function pantallaVentas()
    {
        document.getElementById("imagenInicial").style.display = 'none';
        document.getElementById("divBotonesPrincipales").style.display = 'block';    
        const http=new XMLHttpRequest();
        const url = '../ventas/ventas.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_principal").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=pantallaPrincipalVentas');
    }



function preguntarNuevaClave(idUsuario)
{
    //  alert('cambio de clave '+ sessionStorage.id_usuario);
    var claveSessionStorage =  sessionStorage.id_usuario;
    const http=new XMLHttpRequest();
    const url = '../movil/index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalCambioClave").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=preguntarNuevaClave'
    + "&idUsuario="+idUsuario
    + "&idUsuarioSessionStorage="+claveSessionStorage
    );
    
}
function actualizarClave()
{
    var idUsuario = document.getElementById("input_id_usuario").value;
    var claveAnterior = document.getElementById("txtClaveAnterior").value;
    var claveNueva = document.getElementById("txtNuevaClave").value;
    const http=new XMLHttpRequest();
    const url = '../movil/index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalCambioClave").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarClave'
    + "&idUsuario="+idUsuario
    + "&claveAnterior="+claveAnterior
    + "&claveNueva="+claveNueva
    );
    
    
}
function mostrarMensaje()
{
    alert('mensaje de prueba ');
}