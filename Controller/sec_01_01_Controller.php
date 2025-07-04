<?php
    require_once("../../models/sec_01_01_Model.php");

    
    function obtenerDatosGenerales($IdDeclaracion)
    {
        $sec_01_01 = new sec_01_01();
        $sec_01_01_general = $sec_01_01->DatosGenerales($IdDeclaracion);
        $sec_01_01_Regimen_matrimonial = $sec_01_01->RegimenMatrimonial($IdDeclaracion);


        return [
            "nombre" => $sec_01_01_general["nombre"],
            "primerApellido" => $sec_01_01_general["apellido1"],
            "segundoApellido" => $sec_01_01_general["apellido2"],
            "curp" => $sec_01_01_general["curp"],
            "rfc" => [
                "rfc" => $sec_01_01_general["rfc"],
                "homoClave" => $sec_01_01_general["homoclave"]
            ],
            "correoElectronico" => [
                "institucional" => $sec_01_01_general["correo_institucional"],
                "personal" => $sec_01_01_general["correo_personal"]
            ],
            "telefono" => [
                "casa" => "", 
                "celularPersonal" => $sec_01_01_general["telefono_celular"]
            ],
            "situacionPersonalEstadoCivil" => [
                "clave" => $sec_01_01_general["Estado_civil_clave"],
                "valor" => $sec_01_01_general["Estado_civil"]
            ],
            "regimenMatrimonial" => [
                "clave" => $sec_01_01_Regimen_matrimonial["Regimen_matrimonial_clave"] ?? "",
                "valor" => $sec_01_01_Regimen_matrimonial["RegimenMatrominial"] ?? ""
            ],
            "paisNacimiento" => $sec_01_01_general["Pais_Nacimiento"],
            "nacionalidad" => $sec_01_01_general["Pais_Nacionalidad"],
            "aclaracionesObservaciones" => $sec_01_01_general["observaciones"] ?? ""
        ];
    }

?>
