<?php

// echo 'llego aca ';
//  die (); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">  
    <link rel="stylesheet" href="../css/estilosresponsivos.css">  
    <script src="https://kit.fontawesome.com/6f07c5d6ff.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
     /* @media (max-width: 600px) {
        .ingresoInformacion {
            font-size: 28px;
            width: 35%;
            background-color: transparent;
            color:black;
            border-color: black; 
            margin:10px;
        }
        .botonResponsivo1{
            font-size: 20px;
            margin: 10px;
        }
        .resultadosValidacion{
            border:1px solid black;
            font-size: 20px;
            margin:10px;
        }
        #motivoOrden{
            
        }
    } */
    </style>
</head>
<body>
    <div id= "principal_responsivo" class="container" align = "center">
        
        <input type="text" class = "ingresoInformacion" id="placa" VALUE = "QJT42F" placeholder="PLACA"> 
        <button class="btn btn-primary botonResponsivo1" id = "consultarOrden" onclick="valide();">
        <i class="fas fa-search"></i>
        </button>

        <div id="resultadosValidacion" class="resultadosValidacion" align = "left">
        </div>
    </div>
</body>
</html>
<script src = "../js/jquery-2.1.1.js"> </script>    
<script src="../js/bootstrap.min.js"></script>
<script src="../orden/js/orden.js"></script>
