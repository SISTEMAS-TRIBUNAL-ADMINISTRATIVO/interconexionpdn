<?php
    require_once("../../models/sec_01_01_Model.php");

    
    function obtenerDatosGenerales($IdDeclaracion)
    {
        $sec_01_01 = new sec_01_01();
        $general = $sec_01_01->DatosGenerales($IdDeclaracion);
        $Regimen_matrimonial = $sec_01_01->RegimenMatrimonial($IdDeclaracion);


        return [
            "nombre" => $general["nombre"],
            "primerApellido" => $general["apellido1"],
            "segundoApellido" => $general["apellido2"],
            "curp" => $general["curp"],
            "rfc" => [
                "rfc" => $general["rfc"],
                "homoClave" => $general["homoclave"]
            ],
            "correoElectronico" => [
                "institucional" => $general["correo_institucional"],
                "personal" => $general["correo_personal"]
            ],
            "telefono" => [
                "casa" => "", 
                "celularPersonal" => $general["telefono_celular"]
            ],
            "situacionPersonalEstadoCivil" => [
                "clave" => $general["Estado_civil_clave"],
                "valor" => $general["Estado_civil"]
            ],
            "regimenMatrimonial" => [
                "clave" => $Regimen_matrimonial["Regimen_matrimonial_clave"] ?? "",
                "valor" => $Regimen_matrimonial["RegimenMatrominial"] ?? ""
            ],
            "paisNacimiento" => $general["Pais_Nacimiento"],
            "nacionalidad" => $general["Pais_Nacionalidad"],
            "aclaracionesObservaciones" => $general["observaciones"] ?? ""
        ];
    }

?>
