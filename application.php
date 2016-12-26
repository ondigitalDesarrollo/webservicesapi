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






