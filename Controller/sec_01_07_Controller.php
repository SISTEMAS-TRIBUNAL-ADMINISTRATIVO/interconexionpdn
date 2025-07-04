<?php
    require_once("../../models/sec_01_06_Model.php");

    function obtenerDatosDependientesEconomicos($IdDeclaracion)
    {
        $sec_01_07 = new sec_01_07();
        $Dependiente = $sec_01_07->DependienteEconomico($IdDeclaracion);
        $Ninguno = true;


        if (is_array($Dependiente) && count($Dependiente) > 0) 
        {
            $Ninguno = false;
        }


        $estructura = 
        [
            "ninguno" => $Ninguno,
            "dependienteEconomico" => [],
            "aclaracionesObservaciones" => ""
        ];


        foreach ($Dependiente as $Dependiente_Res) 
        {
            $DomicilioMexico = $sec_01_07->DomicilioMexico($Dependiente_Res["id"]);
            $DomicilioExtranjero = $sec_01_07->DomicilioExtranjero($Dependiente_Res["id"]);
            $TrabajoPublico = $sec_01_07->TrabajoAmbitoPublico($Dependiente_Res["id"]);
            $TrabajoPrivado = $sec_01_07->TrabajoAmbitoPrivadoOtro($Dependiente_Res["id"]);


            $estructura["dependienteEconomico"][] = 
            [
                "tipoOperacion" => "AGREGAR",
                "nombre" => $Dependiente_Res["nombre"] ?? "",
                "primerApellido" => $Dependiente_Res["apellido1"] ?? "",
                "segundoApellido" => $Dependiente_Res["apellido2"] ?? "",
                "fechaNacimiento" => $Dependiente_Res["fecha_nacimiento"] ?? "",
                "rfc" => $Dependiente_Res["rfc"] ?? "",
                "parentescoRelacion" => [
                    "clave" => $Dependiente_Res["Clave_Relacion_familiar"] ?? "",
                    "valor" => $Dependiente_Res["Relacion_familiar"] ?? ""
                ],
                "extranjero" => $Dependiente_Res["ciudadanoExtranjero"],
                "curp" => $Dependiente_Res["curp"] ?? "",
                "habitaDomicilioDeclarante" => $Dependiente_Res["habitaDomicilioDeclarante"],
                "lugarDondeReside" => $Dependiente_Res["LugarDondeReside"],

                "domicilioMexico" => [
                    "calle" => $DomicilioMexicop["calle"] ?? "",
                    "numeroExterior" => $DomicilioMexico["num_ext"] ?? "",
                    "numeroInterior" => $DomicilioMexico["num_int"] ?? "",
                    "coloniaLocalidad" => $DomicilioMexico["colonia"] ?? "",
                    "municipioAlcaldia" => [
                        "clave" => $DomicilioMexico["claveMunicipio"] ?? "",
                        "valor" => $DomicilioMexico["valorMunicipio"] ?? ""
                    ],
                    "entidadFederativa" => [
                        "clave" => $DomicilioMexico["claveEstado"] ?? "07",
                        "valor" => $DomicilioMexico["valorEstado"] ?? "CHIAPAS"
                    ],
                    "codigoPostal" => $DomicilioMexico["cp"] ?? "00000"
                ],

                "domicilioExtranjero" => [
                    "calle" => "",
                    "numeroExterior" => "",
                    "numeroInterior" => "",
                    "ciudadLocalidad" => "",
                    "estadoProvincia" => "",
                    "pais" => "AF",
                    "codigoPostal" => ""
                ],

                "actividadLaboral" => [
                    "clave" => $dep["claveActividad"] ?? "PRI",
                    "valor" => $dep["valorActividad"] ?? "PRIVADO"
                ],

                "actividadLaboralSectorPublico" => [
                    "nivelOrdenGobierno" => "",
                    "ambitoPublico" => "",
                    "nombreEntePublico" => "",
                    "areaAdscripcion" => "",
                    "empleoCargoComision" => "",
                    "funcionPrincipal" => "",
                    "salarioMensualNeto" => [
                        "valor" => "",
                        "moneda" => "MXN"
                    ],
                    "fechaIngreso" => "YYYY-MM-DD"
                ],

                "actividadLaboralSectorPrivadoOtro" => [
                    "nombreEmpresaSociedadAsociacion" => "",
                    "rfc" => "",
                    "empleoCargo" => "",
                    "fechaIngreso" => "YYYY-MM-DD",
                    "salarioMensualNeto" => [
                        "valor" => "0",
                        "moneda" => "MXN"
                    ],
                    "proveedorContratistaGobierno" => false,
                    "sector" => [
                        "clave" => "AGRI",
                        "valor" => "AGRICULTURA"
                    ]
                ]
            ];
        }

        return $estructura;
    }

?>