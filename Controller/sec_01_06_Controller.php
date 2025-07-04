<?php
    require_once("../../models/sec_01_06_Model.php");

    
    function obtenerDatosPareja($IdDeclaracion)
    {
        $sec_01_06 = new sec_01_06();
        $sec_01_06_DatosDeLaPareja = $sec_01_06->DatosDeLaPareja($IdDeclaracion);
        $sec_01_06_Domicilio_Mexico = $sec_01_06->DatosDeLaPareja($IdDeclaracion);
        $sec_01_06_Domicilio_Extranjero = $sec_01_06->DatosDeLaPareja($IdDeclaracion);
        $sec_01_06_TrabajoPublico = $sec_01_06->TrabajoAmbitoPublico($IdDeclaracion);
        $sec_01_06_TrabajoPrivado = $sec_01_06->TrabajoAmbitoPrivadoOtro($IdDeclaracion);
        $sec_01_06_Ninguno = true;


        if (is_array($sec_01_06_DatosDeLaPareja) && count($sec_01_06_DatosDeLaPareja) > 0) 
        {
            $sec_01_06_Ninguno = false;
        }


        return [
            "ninguno" => $sec_01_06_Ninguno,
            "tipoOperacion" => "AGREGAR",
            "nombre" => $sec_01_06_DatosDeLaPareja["nombre"] ?? "",
            "primerApellido" => $sec_01_06_DatosDeLaPareja["apellido1"] ?? "",
            "segundoApellido" => $sec_01_06_DatosDeLaPareja["apellido2"] ?? "",
            "fechaNacimiento" => $sec_01_06_DatosDeLaPareja["fecha_nacimiento"] ?? "",
            "rfc" => $sec_01_06_DatosDeLaPareja["rfc"] ?? "",
            "relacionConDeclarante" => $sec_01_06_DatosDeLaPareja["relacionConDeclarante"] ?? "",
            "ciudadanoExtranjero" => $sec_01_06_DatosDeLaPareja["ciudadanoExtranjero"] ?? "",
            "curp" => $sec_01_06_DatosDeLaPareja["curp"] ?? "",
            "esDependienteEconomico" => $sec_01_06_DatosDeLaPareja["esDependienteEconomico"] ?? "",
            "habitaDomicilioDeclarante" => $sec_01_06_DatosDeLaPareja["habitaDomicilioDeclarante"] ?? "",
            "lugarDondeReside" => $sec_01_06_DatosDeLaPareja["lugarDondeReside"] ?? "",

            // Domicilio México
            "domicilioMexico" => [
                "calle" => $sec_01_06_Domicilio_Mexico["calle"] ?? "",
                "numeroExterior" => $sec_01_06_Domicilio_Mexico["num_exterior"] ?? "",
                "numeroInterior" => $sec_01_06_Domicilio_Mexico["num_interior"] ?? "",
                "coloniaLocalidad" => $sec_01_06_Domicilio_Mexico["colonia"] ?? "",
                "municipioAlcaldia" => [
                    "clave" => $sec_01_06_Domicilio_Mexico["Clave_municipio"] ?? "",
                    "valor" => $sec_01_06_Domicilio_Mexico["Municipio"] ?? ""
                ],
                "entidadFederativa" => [
                    "clave" => $sec_01_06_Domicilio_Mexico["Estado"] ?? "",
                    "valor" => $sec_01_06_Domicilio_Mexico["Estado"] ?? ""
                ],
                "codigoPostal" => $sec_01_06_Domicilio_Mexico["codigo_postal"] ?? ""
            ],

            // Domicilio extranjero
            "domicilioExtranjero" => [
                "calle" => $sec_01_06_Domicilio_Extranjero["calle"] ?? "",
                "numeroExterior" => $sec_01_06_Domicilio_Extranjero["num_exterior"] ?? "",
                "numeroInterior" => $sec_01_06_Domicilio_Extranjero["num_interior"] ?? "",
                "ciudadLocalidad" => $sec_01_06_Domicilio_Extranjero["Municipio"] ?? "",
                "estadoProvincia" =>  $sec_01_06_Domicilio_Extranjero["Estado"] ?? "",
                "pais" => $sec_01_06_Domicilio_Extranjero["pais"] ?? "",
                "codigoPostal" => $sec_01_06_Domicilio_Extranjero["codigo_postal"] ?? ""
            ],

            // Actividad laboral general
            "actividadLaboral" => [
                "clave" => $datosPareja["Clave_ActividadLAboral"] ?? "",
                "valor" => $datosPareja["AmbitoLaboral"] ?? ""
            ],

            // Sector público
            "actividadLaboralSectorPublico" => [
                "nivelOrdenGobierno" => $sec_01_06_TrabajoPublico["Nivel_Gobierno"] ?? "",
                "ambitoPublico" => $sec_01_06_TrabajoPublico["Clave_Ambito"] ?? "",
                "nombreEntePublico" => $sec_01_06_TrabajoPublico["nombreEntePublico"] ?? "",
                "areaAdscripcion" => $sec_01_06_TrabajoPublico["area_adscripcion"] ?? "",
                "empleoCargoComision" => $sec_01_06_TrabajoPublico["cargo_puesto"] ?? "",
                "funcionPrincipal" =>  $sec_01_06->FuncionesPrincipales($sec_01_06_TrabajoPublico["id"]),
                "salarioMensualNeto" => [
                    "valor" => $sec_01_06_TrabajoPublico["salario_mensual"] ?? "",
                    "moneda" => "MXN"
                ],
                "fechaIngreso" => $sec_01_06_TrabajoPublico["fecha_ingreso"] ?? ""
            ],

            // Sector privado/otro
            "actividadLaboralSectorPrivadoOtro" => [
                "nombreEmpresaSociedadAsociacion" => $sec_01_06_TrabajoPrivado["nombre_ente"] ?? "",
                "empleoCargoComision" => $sec_01_06_TrabajoPrivado["cargo_puesto"] ?? "",
                "rfc" => $sec_01_06_TrabajoPrivado["rfc_empresa"] ?? "",
                "fechaIngreso" => $sec_01_06_TrabajoPrivado["fecha_ingreso"] ?? "",
                "sector" => [
                    "clave" => $sec_01_06_TrabajoPrivado["Clave_Sector"] ?? "",
                    "valor" => $sec_01_06_TrabajoPrivado["Sector"] ?? ""
                ],
                "salarioMensualNeto" => [
                    "valor" => $sec_01_06_TrabajoPrivado["salario_mensual"] ?? "",
                    "moneda" => "MXN"
                ],
                "proveedorContratistaGobierno" => $sec_01_06_DatosDeLaPareja["proveedorContratistaGobierno"]
            ],

            "aclaracionesObservaciones" => $sec_01_06_DatosDeLaPareja["observaciones"] ?? ""
        ];
    }
?>




