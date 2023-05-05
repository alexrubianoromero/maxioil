function editarTecnico(idcliente)
{

    const http=new XMLHttpRequest();
    const url = '../tecnicos/tecnicosmovil.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("cuerpoModalTecnicos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=editarTecnico'
    + "&idcliente="+idcliente
    );
}

function formuNuevoTecnico()
{
    const http=new XMLHttpRequest();
    const url = '../tecnicos/tecnicosmovil.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("cuerpoModalTecnicosForm").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevoTecnico'
    );
}

function grabarTecnico()
{
    $valida = validacionesNuevoTecnico();
    if($valida)
    {
        var cedula = document.getElementById("txtCedula").value;
        var nombre = document.getElementById("txtNombre").value;
        var telefono = document.getElementById("txtTelefono").value;
        var porcentaje = document.getElementById("txtPorcentaje").value;
        var idLabor = document.getElementById("idLabor").value;
    
        const http=new XMLHttpRequest();
        const url = '../tecnicos/tecnicosmovil.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalTecnicosForm").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarTecnico'
        + "&cedula="+cedula
        + "&nombre="+nombre
        + "&telefono="+telefono
        + "&porcentaje="+porcentaje
        + "&idLabor="+idLabor
        );
    
        // pantallaTecnicos123();
        // pantallaTecnicos();
    }
}


function validacionesNuevoTecnico()
{
        if(document.getElementById("txtCedula").value=='')
        {
            alert('Por favor digite Cedula ');
            document.getElementById("txtCedula").focus();
            return false;
        }
        if(document.getElementById("txtNombre").value=='')
        {
            alert('Por favor digite nombre');
            document.getElementById("txtNombre").focus();
            return false;
        }
        if(document.getElementById("txtTelefono").value=='')
        {
            alert('Por favor digite telefono ');
            document.getElementById("txtTelefono").focus();
            return false;
        }
        if(document.getElementById("idLabor").value=='0')
        {
            alert('Por favor escoja labor');
            document.getElementById("idLabor").focus();
            return false;
        }
        if(document.getElementById("txtPorcentaje").value=='')
        {
            alert('Por favor digite porcentaje ');
            document.getElementById("txtPorcentaje").focus();
            return false;
        }
        return true;
}

function pantallaTecnicos123()
{ 
    const http=new XMLHttpRequest();
    const url = '../tecnicos/tecnicosmovil.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divPrincipalTecnicos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pantallaPrincipalTecnicos');
}

function pantallaTecnicos12()
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

function actualizarInfoTecnico()
{
    
    var idcliente = document.getElementById("idcliente").value;
    var cedula = document.getElementById("txtCedula").value;
    var nombre = document.getElementById("txtNombre").value;
    var telefono = document.getElementById("txtTelefono").value;
    var porcentaje = document.getElementById("txtPorcentaje").value;
    var idLabor = document.getElementById("idLabor").value;
    const http=new XMLHttpRequest();
    const url = '../tecnicos/tecnicosmovil.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("cuerpoModalTecnicos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarTecnico'
    + "&idcliente="+idcliente
    + "&cedula="+cedula
    + "&nombre="+nombre
    + "&telefono="+telefono
    + "&porcentaje="+porcentaje
    + "&idLabor="+idLabor
    );

}

function eliminarTecnico(idCliente)
{
    const http=new XMLHttpRequest();
    const url = '../tecnicos/tecnicosmovil.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("cuerpoModalTecnicos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=eliminarTecnico'
    + "&idcliente="+idCliente
    );
}
