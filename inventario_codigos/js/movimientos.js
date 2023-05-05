// function verMovimientosCodigos()
// {
//     // alert('buenas desde js');
//         const http=new XMLHttpRequest();
//     const url = '../inventario_codigos/movimientosInventario.php';
//     http.onreadystatechange = function(){
//         if(this.readyState == 4 && this.status ==200){
//             document.getElementById("cuerpoModalMovimientos").innerHTML = this.responseText;
//         }
//     };

//     http.open("POST",url);
//     http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     http.send();

// }

function verMovimientosPrueba(idCode)
{
    const http=new XMLHttpRequest();
    const url = '../inventario_codigos/movimientosInventarioPrueba.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("cuerpoModalMovimientos").innerHTML = this.responseText;
        }
    };

    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=mostrarMovimientos"
               + "&idCode="+idCode
             );
}

