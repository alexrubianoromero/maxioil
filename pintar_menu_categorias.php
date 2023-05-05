<?php
session_start();
if($_SESSION['id_empresa']>1) //osea si hay una empresa
{ 
include('valotablapc.php');

/*
echo '<pre>valores en pintar menu_categorias ';
print_r($_SESSION);
echo '</pre>';
exit();
*/

if($_SESSION['nombre_perfil']=='admin')
    {
        $sql_categorias=
            "
            select DISTINCT(c.nombre),c.id_categoria from $tabla1  c
            inner join $tabla2  s on (s.id_categoria = c.id_categoria)
            where 
             c.id_empresa = '".$_SESSION['id_empresa']."'
            order by c.orden
            ";
           //echo '<br>'.$sql_categorias.'<br>';
    }

else
        {
        $sql_categorias=
            "
            select DISTINCT(c.nombre),c.id_categoria from $tabla1  c
            inner join $tabla2  s on (s.id_categoria = c.id_categoria)
            inner join $tabla31 m on (m.id_menu = s.id_subcategoria)
            where m.id_perfil = ".$_SESSION['id_perfil']."
            and c.id_empresa = '".$_SESSION['id_empresa']."'
            order by c.orden
            ";
            
        }

    //echo '<br>'.$sql_categorias;    

        /*
$sql_categorias = "select * from $tabla1 as c 
where c.id_categoria in (select id_categoria from subcategorias where activo = '1' ) 
and c.id_empresa = '".$_SESSION['id_empresa']."'
order by id_categoria
"; 
*/
//echo '<br>'.$sql_categorias;
//exit();
$consulta_categorias = mysql_query($sql_categorias,$conexion);


echo '<ul>';
while($cate = mysql_fetch_array($consulta_categorias))
		{  
			$id_categoria = $cate['id_categoria'];	
        	echo   '<li class="submenu">';
          	echo 	'<a href="#">'.$cate['nombre'].'<span class="entypo-down-open"></span> </a>';
            
            /////iniciamos el submenu
            
                     echo '<ul>';
            		if($_SESSION['nombre_perfil']=='admin')
                    {
                         $sqL_subcategorias = "select * from $tabla2 s
                    where s.id_categoria = '".$cate['id_categoria']."'  
                    and s.activo = '1' 
                    
                    order by orden";
                    //echo '<br>'.$sql_subcategorias.'<br>';
                    //exit();
                    }
                    else
                    {
                    $sqL_subcategorias = "select * from $tabla2 s
                    inner join $tabla31 mp on (mp.id_menu=s.id_subcategoria)
                    where s.id_categoria = '".$cate['id_categoria']."'  
                    and s.activo = '1' 
                    and mp.id_perfil = '".$_SESSION['id_perfil']."' 
                    order by orden";
                    }


            		//echo '<br>'.$sqL_subcategorias;
                    //exit();
            		$consulta_subcategorias = mysql_query($sqL_subcategorias,$conexion);
            		if(mysql_num_rows($consulta_subcategorias) == 0) {}
            			else
            			{
            				while($subcate = mysql_fetch_array($consulta_subcategorias))
            				{
            					
            					 echo '<li ><a href="'.$subcate[4].'?program='.$subcate[4].' "    
                                 target ="cuadro_principal" >'.$subcate[2].'</a></li>';
            					 
            				}// fin del ciclo de while($subcate = mysql_fetch_array($consulta_subcategorias)) 
            			}// fin de else de (mysql_num_rows($consulta_subcategorias) == 0)
                   echo '</ul>'; 
                
            
               echo   '</li>';       

	     
		} // fin de ciclo de categorias 
echo '</ul>';
}//fin de si existe el id de la empresa en session
else
{
    include('../index.php');
}
?>