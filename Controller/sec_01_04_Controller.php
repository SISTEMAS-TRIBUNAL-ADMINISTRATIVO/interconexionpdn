<?php
    require_once("../../models/sec_01_04_Model.php");

    function obtenerDatosEmpleoCargoComision($IdDeclaracion)
    {
        $sec_01_04 = new sec_01_04();
        $DatosDelCargo = $sec_01_04->DatosDelCargo($IdDeclaracion);


        return [
            "tipoOperacion" => "AGREGAR",
            "nivelOrdenGobierno" => $DatosDelCargo["nivelOrdenGobierno"],
            "ambitoPublico" => $DatosDelCargo["ambitoPublico"],
            "nombreEntePublico" => $DatosDelCargo["nombreEntePublico"],
            "areaAdscripcion" => $DatosDelCargo["areaAdscripcion"],
            "empleoCargoComision" => $DatosDelCargo["empleoCargoComision"],
            "contratadoPorHonorarios" => (bool) $DatosDelCargo["contratadoPorHonorarios"],
            "nivelEmpleoCargoComision" => $DatosDelCargo["nivelEmpleoCargoComision"],
            "funcionPrincipal" => $$sec_01_04->FuncionesPrincipales($DatosDelCargo["id_padron"]),
            "fechaTomaPosesion" => $DatosDelCargo["fechaTomaPosesion"] ?? "",
            "telefonoOficina" => [
                "telefono" => "",
                "extension" => ""
            ],
            "domicilioMexico" => [
                "calle" => $DatosDelCargo["calle"],
                "numeroExterior" => $DatosDelCargo["num_exterior"],
                "numeroInterior" => $DatosDelCargo["num_interior"],
                "coloniaLocalidad" => $DatosDelCargo["colonia"],
                "municipioAlcaldia" => [
                    "clave" => $DatosDelCargo["Clave_Municipio"],
                    "valor" => $DatosDelCargo["Municipio"]
                ],
                "entidadFederativa" => [
                    "clave" => $DatosDelCargo["Clave_Estado"],
                    "valor" => $DatosDelCargo["Estado"]
                ],
                "codigoPostal" => $DatosDelCargo["codigo_postal"]
            ],
            "domicilioExtranjero" => [
                "calle" => "",
                "numeroExterior" => "",
                "numeroInterior" => "",
                "ciudadLocalidad" => "",
                "estadoProvincia" => "",
                "pais" => "",
                "codigoPostal" => ""
            ],
            "aclaracionesObservaciones" => $DatosDelCargo["observaciones"],
            "domicilio" =>"MX"
        ];
    }
?>




