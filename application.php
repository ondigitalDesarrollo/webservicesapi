<?php

/* 
 * author: Arnold Restrepo Hernandez
 * version: 1.0
 * comments: Ejercicios de Web Services utilizando PHP
 */


// Incluir la libreria
include 'lib/nusoap.php';

//Activar el metodo
$server = new soap_server();

//Parametros de salida
$server->configureWSDL('servidor','urn:Servidor');


//Configuracion de la funcion
$server->register('MetodoConsulta',
        array('param_id' => 'xsd:string','param_text' => 'xsd:string'),
        array('return' => 'xsd:string'),
        'urn:MetodoConsultawsdl',
        'urn:MetodoConsultawsdl#MetodoConsulta',
        'rpc',
        'encoded',
        'Retorna el datos' 
);

//Metodo de la consulta
function MetodoConsulta($param_id,$param_text){
    //Conectamos y seleccionamos la base de datos
    $link = mysql_connect(SQL_SERVER,SQL_USER,SQL_USER_PASS) or die("Error: ".mysal_error());
    $ddbb = mysql_select_db(SQL_DB)or die("Error ".mysal_error());
    
    //Realizar la consulta Mysql
    $query = "SELECT * FROM articulos WHERE id = '$param_id' AND txt = '$param_text'";
    $result = mysql_query($query) or die('Consulta Fallida' . mysql_error());
    
    //Tratar datos seleccionados
    $row = mysql_fetch_array($result);
    
    //Obtener los campos seleccionados
    $descripcion    = $row['txt'];
    $precio         = $row['precio'];
    
    // Devolver el descriptivo y el precio consultado
    return "RESULTADO =".strtoupper($descripcion)."\n". strtoupper($precio)."$";
    
    // liberar resultados
    mysql_free_result($result);
    
    // Cerrar la conexion
    mysql_close($link);
            
}


// Invocar Servicio Web
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$sError->service($HTTP_RAW_POST_DATA);






