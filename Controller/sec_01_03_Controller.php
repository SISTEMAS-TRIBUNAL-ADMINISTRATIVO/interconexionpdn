<?php
    require_once("../../models/sec_01_03_Model.php");

    
    function obtenerDatosCurriculares($IdDeclaracion)
    {
        $sec_01_03 = new sec_01_03();
        $Curricular = $sec_01_03->datosCurriculares($IdDeclaracion);

        $ninguno = true;
        $escolaridad = [];
        $observaciones = "";

        if (is_array($Curricular) && count($Curricular) > 0) 
        {
            foreach ($Curricular as $estudio) {
                $escolaridad[] = [
                    "tipoOperacion" => "AGREGAR",
                    "nivel" => [
                        "clave" => $estudio["Clave_Grado"] ?? "",
                        "valor" => $estudio["Grado_academico"] ?? ""
                    ],
                    "institucionEducativa" => [
                        "nombre" => $estudio["institucion_educativa"] ?? "",
                        "ubicacion" => $estudio["Clave_pais"] ?? ""
                    ],
                    "carreraAreaConocimiento" => $estudio["carrera"] ?? "",
                    "estatus" => $estudio["Estatus_academico"] ?? "",
                    "documentoObtenido" => $estudio["Documento_obtenido"] ?? "",
                    "fechaObtencion" => $estudio["fecha_obtencion_documento"] ?? ""
                ];

                $observaciones .= $estudio["observaciones"] ?? "";
            }

            $ninguno = false;
        }

        return [
            "ninguno" => $ninguno,
            "escolaridad" => $escolaridad,
            "aclaracionesObservaciones" => $observaciones
        ];
    }
?>
