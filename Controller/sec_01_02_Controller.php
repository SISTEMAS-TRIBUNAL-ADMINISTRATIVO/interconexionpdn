<?php
    require_once("../../models/sec_01_02_Model.php");

    
    function obtenerDatosDomicilioDeclarante($IdDeclaracion)
    {
        $sec_01_02 = new sec_01_02();
        $Domicilio_Mexico = $sec_01_02->DomicilioMexico($IdDeclaracion);
        $Domicilio_Extranjero = $sec_01_02->DomicilioExtranjero($IdDeclaracion);


        // Si no hay datos, devolver estructura vacía
        $domicilioMexico = [
            "calle" => $Domicilio_Mexico["calle_Mexico"] ?? "",
            "numeroExterior" => $Domicilio_Mexico["num_exterior_Mexico"] ?? "",
            "numeroInterior" => $Domicilio_Mexico["num_interior_Mexico"] ?? "",
            "coloniaLocalidad" => $_Domicilio_Mexico["colonia_Mexico"] ?? "",
            "municipioAlcaldia" => [
                "clave" => $Domicilio_Mexico["Clave_municipio_Mexico"] ?? "",
                "valor" => $Domicilio_Mexico["Municipio_Mexico"] ?? ""
            ],
            "entidadFederativa" => [
                "clave" => $Domicilio_Mexico["Clave_Estado_Mexico"] ?? "",
                "valor" => $Domicilio_Mexico["Estado_Mexico"] ?? ""
            ],
            "codigoPostal" => $Domicilio_Mexico["codigo_postal_Mexico"] ?? ""
        ];

        $domicilioExtranjero = [
            "calle" => $Domicilio_Extranjero["calle_Extranjero"] ?? "",
            "numeroExterior" => $Domicilio_Extranjero["num_exterior_Extranjero"] ?? "",
            "numeroInterior" => $Domicilio_Extranjero["num_interior_Extranjero"] ?? "",
            "ciudadLocalidad" => $Domicilio_Extranjero["colonia_Extranjero"] ?? "",
            "estadoProvincia" => $Domicilio_Extranjero["Estado_Extranjero"] ?? "",
            "pais" => $Domicilio_Extranjero["Clave_pais_Extranjero"] ?? "",
            "codigoPostal" => $Domicilio_Extranjero["codigo_postal_Extranjero"] ?? ""
        ];

        return [
            "domicilioMexico" => $domicilioMexico,
            "domicilioExtranjero" => $domicilioExtranjero,
            "aclaracionesObservaciones" => $datosMexico["observaciones_Mexico"] ?? "",
            "domicilio" => $Domicilio_Extranjero["Clave_pais_Extranjero"] ?? "MX"
        ];

    }

?>
