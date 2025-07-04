<?php
    require_once("../../models/sec_01_04_Model.php");

    function obtenerDatosEmpleoCargoComision($IdDeclaracion)
    {
        $sec_01_04 = new sec_01_04();
        $sec_01_02_DatosDelCargo = $sec_01_04->DatosDelCargo($IdDeclaracion);


        return [
            "tipoOperacion" => "AGREGAR",
            "nivelOrdenGobierno" => $sec_01_02_DatosDelCargo["nivelOrdenGobierno"],
            "ambitoPublico" => $sec_01_02_DatosDelCargo["ambitoPublico"],
            "nombreEntePublico" => $sec_01_02_DatosDelCargo["nombreEntePublico"],
            "areaAdscripcion" => $sec_01_02_DatosDelCargo["areaAdscripcion"],
            "empleoCargoComision" => $sec_01_02_DatosDelCargo["empleoCargoComision"],
            "contratadoPorHonorarios" => (bool) $sec_01_02_DatosDelCargo["contratadoPorHonorarios"],
            "nivelEmpleoCargoComision" => $sec_01_02_DatosDelCargo["nivelEmpleoCargoComision"],
            "funcionPrincipal" => $$sec_01_04->FuncionesPrincipales($sec_01_02_DatosDelCargo["id_padron"]),
            "fechaTomaPosesion" => $sec_01_02_DatosDelCargo["fechaTomaPosesion"] ?? "",
            "telefonoOficina" => [
                "telefono" => "",
                "extension" => ""
            ],
            "domicilioMexico" => [
                "calle" => $sec_01_02_DatosDelCargo["calle"],
                "numeroExterior" => $sec_01_02_DatosDelCargo["num_exterior"],
                "numeroInterior" => $sec_01_02_DatosDelCargo["num_interior"],
                "coloniaLocalidad" => $sec_01_02_DatosDelCargo["colonia"],
                "municipioAlcaldia" => [
                    "clave" => $sec_01_02_DatosDelCargo["Clave_Municipio"],
                    "valor" => $sec_01_02_DatosDelCargo["Municipio"]
                ],
                "entidadFederativa" => [
                    "clave" => $sec_01_02_DatosDelCargo["Clave_Estado"],
                    "valor" => $sec_01_02_DatosDelCargo["Estado"]
                ],
                "codigoPostal" => $sec_01_02_DatosDelCargo["codigo_postal"]
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
            "aclaracionesObservaciones" => $sec_01_02_DatosDelCargo["observaciones"],
            "domicilio" =>"MX"
        ];
    }
?>




