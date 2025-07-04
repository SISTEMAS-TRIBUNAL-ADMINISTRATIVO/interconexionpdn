<?php
    require_once("../../models/sec_01_05_Model.php");

    
    function obtenerExperienciaLaboral($IdDeclaracion)
    {
        $sec_01_05 = new sec_01_05();
        $sec_01_05_ExperianciaLaboral = $sec_01_05->ExperianciaLaboral($IdDeclaracion);
        $sec_01_05_Ninguno = true;
        $Observaciones = "";


        if (is_array($sec_01_05_ExperianciaLaboral) && count($sec_01_05_ExperianciaLaboral) > 0) 
        {
            $sec_01_05_Ninguno = false;
        }

        $experiencia = [];

        foreach ($sec_01_05_ExperianciaLaboral as $row) 
        {
            $experiencia[] = 
            [
                "tipoOperacion" => "AGREGAR",
                "ambitoSector" => [
                    "clave" => $row["Clave_ambito"] ?? "",
                    "valor" => $row["Ambito"] ?? ""
                ],
                "nivelOrdenGobierno" => $row["nivelOrdenGobierno"] ?? "",
                "ambitoPublico" => $row["ambitoPublico"] ?? "",
                "nombreEntePublico" => $row["nombreEntePublico"] ?? "",
                "areaAdscripcion" => $row["area_adscripcion"] ?? "",
                "empleoCargoComision" => $row["cargo_puesto"] ?? "",
                "funcionPrincipal" => $sec_01_05->FuncionesPrincipales( $row["id"] ) ?? "",
                "fechaIngreso" => $row["fecha_ingreso"] ?? "",
                "fechaEgreso" => $row["fecha_salida"] ?? "",
                "ubicacion" => $row["Clave_pais"] ?? "MX"
            ];

            $Observaciones .= $row["observaciones"] . ", ";
        }

        return [
            "ninguno" => $sec_01_05_Ninguno,
            "experiencia" => $experiencia,
            "aclaracionesObservaciones" => $Observaciones
        ];
}
?>
