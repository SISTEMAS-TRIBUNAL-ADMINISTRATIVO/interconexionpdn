<?php
    require_once("../../models/sec_01_06_Model.php");

    
    function obtenerDatosPareja($IdDeclaracion)
    {
        $sec_01_06 = new sec_01_06();
        $DatosDeLaPareja = $sec_01_06->DatosDeLaPareja($IdDeclaracion);
        $Domicilio_Mexico = $sec_01_06->DatosDeLaPareja($IdDeclaracion);
        $Domicilio_Extranjero = $sec_01_06->DatosDeLaPareja($IdDeclaracion);
        $TrabajoPublico = $sec_01_06->TrabajoAmbitoPublico($IdDeclaracion);
        $TrabajoPrivado = $sec_01_06->TrabajoAmbitoPrivadoOtro($IdDeclaracion);
        $Ninguno = true;


        if (is_array($DatosDeLaPareja) && count($DatosDeLaPareja) > 0) 
        {
            $Ninguno = false;
        }


        return [
            "ninguno" => $Ninguno,
            "tipoOperacion" => "AGREGAR",
            "nombre" => $DatosDeLaPareja["nombre"] ?? "",
            "primerApellido" => $DatosDeLaPareja["apellido1"] ?? "",
            "segundoApellido" => $DatosDeLaPareja["apellido2"] ?? "",
            "fechaNacimiento" => $DatosDeLaPareja["fecha_nacimiento"] ?? "",
            "rfc" => $DatosDeLaPareja["rfc"] ?? "",
            "relacionConDeclarante" => $DatosDeLaPareja["relacionConDeclarante"] ?? "",
            "ciudadanoExtranjero" => $DatosDeLaPareja["ciudadanoExtranjero"] ?? "",
            "curp" => $DatosDeLaPareja["curp"] ?? "",
            "esDependienteEconomico" => $DatosDeLaPareja["esDependienteEconomico"] ?? "",
            "habitaDomicilioDeclarante" => $DatosDeLaPareja["habitaDomicilioDeclarante"] ?? "",
            "lugarDondeReside" => $DatosDeLaPareja["lugarDondeReside"] ?? "",

            // Domicilio México
            "domicilioMexico" => [
                "calle" => $Domicilio_Mexico["calle"] ?? "",
                "numeroExterior" => $Domicilio_Mexico["num_exterior"] ?? "",
                "numeroInterior" => $Domicilio_Mexico["num_interior"] ?? "",
                "coloniaLocalidad" => $Domicilio_Mexico["colonia"] ?? "",
                "municipioAlcaldia" => [
                    "clave" => $Domicilio_Mexico["Clave_municipio"] ?? "",
                    "valor" => $Domicilio_Mexico["Municipio"] ?? ""
                ],
                "entidadFederativa" => [
                    "clave" => $Domicilio_Mexico["Estado"] ?? "",
                    "valor" => $Domicilio_Mexico["Estado"] ?? ""
                ],
                "codigoPostal" => $Domicilio_Mexico["codigo_postal"] ?? ""
            ],

            // Domicilio extranjero
            "domicilioExtranjero" => [
                "calle" => $Domicilio_Extranjero["calle"] ?? "",
                "numeroExterior" => $Domicilio_Extranjero["num_exterior"] ?? "",
                "numeroInterior" => $Domicilio_Extranjero["num_interior"] ?? "",
                "ciudadLocalidad" => $Domicilio_Extranjero["Municipio"] ?? "",
                "estadoProvincia" =>  $Domicilio_Extranjero["Estado"] ?? "",
                "pais" => $Domicilio_Extranjero["pais"] ?? "",
                "codigoPostal" => $Domicilio_Extranjero["codigo_postal"] ?? ""
            ],

            // Actividad laboral general
            "actividadLaboral" => [
                "clave" => $datosPareja["Clave_ActividadLAboral"] ?? "",
                "valor" => $datosPareja["AmbitoLaboral"] ?? ""
            ],

            // Sector público
            "actividadLaboralSectorPublico" => [
                "nivelOrdenGobierno" => $TrabajoPublico["Nivel_Gobierno"] ?? "",
                "ambitoPublico" => $TrabajoPublico["Clave_Ambito"] ?? "",
                "nombreEntePublico" => $TrabajoPublico["nombreEntePublico"] ?? "",
                "areaAdscripcion" => $TrabajoPublico["area_adscripcion"] ?? "",
                "empleoCargoComision" => $TrabajoPublico["cargo_puesto"] ?? "",
                "funcionPrincipal" =>  $sec_01_06->FuncionesPrincipales($TrabajoPublico["id"]),
                "salarioMensualNeto" => [
                    "valor" => $TrabajoPublico["salario_mensual"] ?? "",
                    "moneda" => "MXN"
                ],
                "fechaIngreso" => $TrabajoPublico["fecha_ingreso"] ?? ""
            ],

            // Sector privado/otro
            "actividadLaboralSectorPrivadoOtro" => [
                "nombreEmpresaSociedadAsociacion" => $TrabajoPrivado["nombre_ente"] ?? "",
                "empleoCargoComision" => $TrabajoPrivado["cargo_puesto"] ?? "",
                "rfc" => $TrabajoPrivado["rfc_empresa"] ?? "",
                "fechaIngreso" => $sec_01_06_TrabajoPrivado["fecha_ingreso"] ?? "",
                "sector" => [
                    "clave" => $TrabajoPrivado["Clave_Sector"] ?? "",
                    "valor" => $TrabajoPrivado["Sector"] ?? ""
                ],
                "salarioMensualNeto" => [
                    "valor" => $TrabajoPrivado["salario_mensual"] ?? "",
                    "moneda" => "MXN"
                ],
                "proveedorContratistaGobierno" => $DatosDeLaPareja["proveedorContratistaGobierno"]
            ],

            "aclaracionesObservaciones" => $DatosDeLaPareja["observaciones"] ?? ""
        ];
    }
?>




