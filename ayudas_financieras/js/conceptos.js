function pantallaConceptos()
{
    document.getElementById("imagenInicial").style.display = 'none';
    document.getElementById("divBotonesPrincipales").style.display = 'block';    
    const http=new XMLHttpRequest();
    const url = '../ayudas_financieras/conceptos.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("div_principal").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=menuPrincipalConceptos');
}

function formuNuevoConcepto()
{ 
    const http=new XMLHttpRequest();
    const url = '../ayudas_financieras/conceptos.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("cuerpoModalNuevoConcepto").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevoConcepto');
}
function grabarConcepto()
{   
    var validacion = validacionesGrabarConcepto();
    if(validacion)
    {
        var concepto = document.getElementById("txtConcepto").value;
        const http=new XMLHttpRequest();
        const url = '../ayudas_financieras/conceptos.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalNuevoConcepto").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarConcepto'
                    + "&concepto="+concepto
        );
    }
}
function validacionesGrabarConcepto()
{
    if(document.getElementById("txtConcepto").value=='')
        {
            alert('Por favor digite un concepto');
            document.getElementById("txtConcepto").focus();
            return false;
        }
        return true;
}