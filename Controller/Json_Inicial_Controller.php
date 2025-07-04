<?php
//LSC. JOSE FERNANDO VALDES NANDUCA 
//30/06/2025
session_start();

require_once("metadata_Controller.php");
require_once("sec_01_01_Controller.php");
require_once("sec_01_02_Controller.php");
require_once("sec_01_03_Controller.php");
require_once("sec_01_04_Controller.php");
require_once("sec_01_05_Controller.php");
require_once("sec_01_06_Controller.php");


$IdDeclaracion=12;

//Sec_Metadata
$estructuraJson["metadata"] = obtenerMetadata($IdDeclaracion);
//sec_01_01
$estructuraJson["declaracion"]["situacionPatrimonial"]["datosGenerales"] = obtenerDatosGenerales($IdDeclaracion);
//sec_01_02
$estructuraJson["declaracion"]["situacionPatrimonial"]["domicilioDeclarante"] = obtenerDatosDomicilioDeclarante($IdDeclaracion);
//sec_01_03
$estructuraJson["declaracion"]["situacionPatrimonial"]["datosCurricularesDeclarante"] = obtenerDatosCurriculares($IdDeclaracion);
//sec_01_04
$estructuraJson["declaracion"]["situacionPatrimonial"]["datosEmpleoCargoComision"] = obtenerDatosEmpleoCargoComision($IdDeclaracion);
//sec_01_05
$estructuraJson["declaracion"]["situacionPatrimonial"]["experienciaLaboral"] = obtenerExperienciaLaboral($IdDeclaracion);
//sec_01_06
$estructuraJson["declaracion"]["situacionPatrimonial"]["datosPareja"] = obtenerDatosPareja($IdDeclaracion);
//sec_01_07
?>