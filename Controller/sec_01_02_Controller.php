<?php
    require_once("../../models/sec_01_02_Model.php");

    
    function obtenerDatosDomicilioDeclarante($IdDeclaracion)
    {
        $sec_01_02 = new sec_01_02();
        $sec_01_02_Domicilio_Mexico = $sec_01_02->DomicilioMexico($IdDeclaracion);
        $sec_01_02_Domicilio_Extranjero = $sec_01_02->DomicilioExtranjero($IdDeclaracion);


        // Si no hay datos, devolver estructura vacía
        $domicilioMexico = [
            "calle" => $sec_01_02_Domicilio_Mexico["calle_Mexico"] ?? "",
            "numeroExterior" => $sec_01_02_Domicilio_Mexico["num_exterior_Mexico"] ?? "",
            "numeroInterior" => $sec_01_02_Domicilio_Mexico["num_interior_Mexico"] ?? "",
            "coloniaLocalidad" => $sec_01_02_Domicilio_Mexico["colonia_Mexico"] ?? "",
            "municipioAlcaldia" => [
                "clave" => $sec_01_02_Domicilio_Mexico["Clave_municipio_Mexico"] ?? "",
                "valor" => $sec_01_02_Domicilio_Mexico["Municipio_Mexico"] ?? ""
            ],
            "entidadFederativa" => [
                "clave" => $sec_01_02_Domicilio_Mexico["Clave_Estado_Mexico"] ?? "",
                "valor" => $sec_01_02_Domicilio_Mexico["Estado_Mexico"] ?? ""
            ],
            "codigoPostal" => $sec_01_02_Domicilio_Mexico["codigo_postal_Mexico"] ?? ""
        ];

        $domicilioExtranjero = [
            "calle" => $sec_01_02_Domicilio_Extranjero["calle_Extranjero"] ?? "",
            "numeroExterior" => $sec_01_02_Domicilio_Extranjero["num_exterior_Extranjero"] ?? "",
            "numeroInterior" => $sec_01_02_Domicilio_Extranjero["num_interior_Extranjero"] ?? "",
            "ciudadLocalidad" => $sec_01_02_Domicilio_Extranjero["colonia_Extranjero"] ?? "",
            "estadoProvincia" => $sec_01_02_Domicilio_Extranjero["Estado_Extranjero"] ?? "",
            "pais" => $sec_01_02_Domicilio_Extranjero["Clave_pais_Extranjero"] ?? "",
            "codigoPostal" => $sec_01_02_Domicilio_Extranjero["codigo_postal_Extranjero"] ?? ""
        ];

        return [
            "domicilioMexico" => $domicilioMexico,
            "domicilioExtranjero" => $domicilioExtranjero,
            "aclaracionesObservaciones" => $datosMexico["observaciones_Mexico"] ?? "",
            "domicilio" => $datosMexico["Clave_pais_Mexico"] ?? "MX"
        ];

    }

?>
