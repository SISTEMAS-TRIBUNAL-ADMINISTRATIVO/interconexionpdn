<?php
    require_once("../../models/sec_01_05_Model.php");

    
    function obtenerExperienciaLaboral($IdDeclaracion)
    {
        $sec_01_05 = new sec_01_05();
        $ExperianciaLaboral = $sec_01_05->ExperianciaLaboral($IdDeclaracion);
        $Ninguno = true;
        $Observaciones = "";


        if (is_array($ExperianciaLaboral) && count($ExperianciaLaboral) > 0) 
        {
            $Ninguno = false;
        }

        $experiencia = [];

        foreach ($ExperianciaLaboral as $row) 
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
            "ninguno" => $Ninguno,
            "experiencia" => $experiencia,
            "aclaracionesObservaciones" => $Observaciones
        ];
}
?>
