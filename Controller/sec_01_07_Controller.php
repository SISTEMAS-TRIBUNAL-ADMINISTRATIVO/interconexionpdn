<?php
    require_once("../../models/sec_01_06_Model.php");

    function obtenerDatosDependientesEconomicos($IdDeclaracion)
    {

        
        $estructura = 
        [
            "ninguno" => empty($dependientes),
            "dependienteEconomico" => [],
            "aclaracionesObservaciones" => ""
        ];

        foreach ($dependientes as $dep) 
        {
            $estructura["dependienteEconomico"][] = 
            [
                "tipoOperacion" => "AGREGAR",
                "nombre" => $dep["nombre"] ?? "",
                "primerApellido" => $dep["apellido1"] ?? "",
                "segundoApellido" => $dep["apellido2"] ?? "",
                "fechaNacimiento" => $dep["fecha_nacimiento"] ?? "",
                "rfc" => $dep["rfc"] ?? "",
                "parentescoRelacion" => [
                    "clave" => $dep["claveParentesco"] ?? "",
                    "valor" => $dep["valorParentesco"] ?? ""
                ],
                "extranjero" => ($dep["extranjero"] ?? 'false') === 'true',
                "curp" => $dep["curp"] ?? "",
                "habitaDomicilioDeclarante" => ($dep["habita"] ?? 'true') === 'true',
                "lugarDondeReside" => $dep["residencia"] ?? "MÉXICO",

                "domicilioMexico" => [
                    "calle" => $dep["calle"] ?? "",
                    "numeroExterior" => $dep["num_ext"] ?? "",
                    "numeroInterior" => $dep["num_int"] ?? "",
                    "coloniaLocalidad" => $dep["colonia"] ?? "",
                    "municipioAlcaldia" => [
                        "clave" => $dep["claveMunicipio"] ?? "",
                        "valor" => $dep["valorMunicipio"] ?? ""
                    ],
                    "entidadFederativa" => [
                        "clave" => $dep["claveEstado"] ?? "07",
                        "valor" => $dep["valorEstado"] ?? "CHIAPAS"
                    ],
                    "codigoPostal" => $dep["cp"] ?? "00000"
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