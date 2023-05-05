function pantallaPrincipalCaja()
{
    document.getElementById("imagenInicial").style.display = 'none';
    document.getElementById("divBotonesPrincipales").style.display = 'block';    
    const http=new XMLHttpRequest();
    const url = '../caja/caja.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("div_principal").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=menuPrincipalCaja');
}

function entradaCaja(tipo)
{
    document.getElementById("imagenInicial").style.display = 'none';
    document.getElementById("divBotonesPrincipales").style.display = 'block';    
    const http=new XMLHttpRequest();
    const url = '../caja/caja.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
        document.getElementById("cuerpoModalCaja").innerHTML  = '';
        document.getElementById("cuerpoModalCaja").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pregunteEntradaCaja'
            + "&tipo="+tipo 
                );
}
function grabarRecibo()
{
    // alert('grabar recibo '); 
    var valida = validacionesRecibo();
    if(valida)
    {
        var txtAquien = document.getElementById("txtAquien").value;
        // var txtValor = document.getElementById("txtValor").value;
        var txtConcepto = document.getElementById("txtConcepto").value;
        var txtObservacion = document.getElementById("txtObservacion").value;
        var tipo = document.getElementById("tipo").value;
        var idTecnico = document.getElementById("idTecnico").value;
        var txtEfectivo = document.getElementById("txtEfectivo").value;
        var txtDebito = document.getElementById("txtDebito").value;
        var txtCredito = document.getElementById("txtCredito").value;
        var txtBancolombia = document.getElementById("txtBancolombia").value;
        var txtBolt = document.getElementById("txtBolt").value;
        
        var idOrden = document.getElementById("idOrden").value;
        var idVenta = document.getElementById("idVenta").value;

        if(txtEfectivo==''){ txtEfectivo='0'}
        if(txtDebito==''){ txtDebito='0'}
        if(txtCredito==''){ txtCredito='0'}
        if(txtBancolombia==''){ txtBancolombia='0'}
        if(txtBolt==''){ txtBolt='0'}

        var suma  = parseInt(txtEfectivo) + parseInt(txtDebito) + parseInt(txtCredito)  + parseInt(txtBancolombia)  + parseInt(txtBolt) ;

        const http=new XMLHttpRequest();
        const url = '../caja/caja.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("cuerpoModalCaja").innerHTML  = '';
                document.getElementById("cuerpoModalCaja").innerHTML  = this.responseText;
                document.getElementById("cuerpoModalCajaVentas").innerHTML  = '';
                document.getElementById("cuerpoModalCajaVentas").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarRecibo'
                + "&txtAquien="+txtAquien 
                + "&txtValor="+suma 
                + "&txtConcepto="+txtConcepto 
                + "&txtObservacion="+txtObservacion 
                + "&tipo="+tipo 
                + "&idTecnico="+idTecnico 
                + "&txtEfectivo="+txtEfectivo 
                + "&txtDebito="+txtDebito 
                + "&txtCredito="+txtCredito 
                + "&txtBancolombia="+txtBancolombia 
                + "&txtBolt="+txtBolt 
                + "&idOrden="+idOrden 
                + "&idVenta="+idVenta 
        );

        //si hay valor en idOrden se debe cerrar el modal on la info de la orden 
    }   
}

function validacionesRecibo()
{
 
       if(document.getElementById("txtEfectivo").value=='' 
            &&  document.getElementById("txtDebito").value=='' 
            &&  document.getElementById("txtCredito").value==''
            &&  document.getElementById("txtBancolombia").value==''
            &&  document.getElementById("txtBolt").value==''
            )
        {
            alert('Por favor digite valor en  efectivo o debito o credito Bancolombia o Bolt');
            document.getElementById("txtEfectivo").focus();
            return false;
        }
       if(document.getElementById("txtValor").value=='')
        {
            alert('Por favor digite Valor ');
            document.getElementById("txtValor").focus();
            return false;
        }

        if(document.getElementById("txtAquien").value=='')
        {
            alert('Por favor digite nombre');
            document.getElementById("txtAquien").focus();
            return false;
        }
        if(document.getElementById("txtConcepto").value=='0' || document.getElementById("txtConcepto").value=='' )
        {
            alert('Por favor escoja un concepto');
            document.getElementById("txtConcepto").focus();
            return false;
        }
        // if(document.getElementById("txtObservacion").value=='')
        // {
        //     alert('Por digite observacion');
        //     document.getElementById("txtObservacion").focus();
        //     return false;
        // }
      
        return true;
}

function mostrarMovimientosDia(tipoInforme)
{
    // var txtAquien = document.getElementById("txtAquien").value;
  
    const http=new XMLHttpRequest();
    const url = '../caja/caja.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalCajaMovimientos").innerHTML  = '';
        document.getElementById("cuerpoModalCajaMovimientos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=informeCaja'
            + "&tipoInforme="+tipoInforme 
    );
}

function sumarTotalRecibo()
{
    var txtEfectivo = document.getElementById("txtEfectivo").value;
    var txtDebito = document.getElementById("txtDebito").value;
    var txtCredito = document.getElementById("txtCredito").value;
    var txtBancolombia = document.getElementById("txtBancolombia").value;
    var txtBolt = document.getElementById("txtBolt").value;


    var txtValor  = document.getElementById("txtValor").value;
    if(txtEfectivo==''){ txtEfectivo='0'}
    if(txtDebito==''){ txtDebito='0'}
    if(txtCredito==''){ txtCredito='0'}
    if(txtBancolombia==''){ txtBancolombia='0'}
    if(txtBolt==''){ txtBolt='0'}

    var suma  = parseInt(txtEfectivo) + parseInt(txtDebito) + parseInt(txtCredito) + parseInt(txtBancolombia) + parseInt(txtBolt)  ;
    document.getElementById("txtValor").innerHTML=suma;


}

function muestresalarioDiario()
{
    const http=new XMLHttpRequest();
    const url = '../caja/caja.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalCajaMovimientos").innerHTML  = '';
        document.getElementById("cuerpoModalCajaMovimientos").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=informeSalario'
            // + "&tipoInforme="+tipoInforme 
    );
}