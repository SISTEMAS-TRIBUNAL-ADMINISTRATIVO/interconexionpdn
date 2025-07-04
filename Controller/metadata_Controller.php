<?php
    require_once("../../models/DeclaracionesModel.php");

    function obtenerMetadata($IdDeclaracion)
    {
        $Declaraciones = new Declaraciones();
        $Sec_Data = $Declaraciones->DetallesXid($IdDeclaracion);

        return [
            "id_organismo" => 74,
            "organismo" => "TRIBUNAL DE JUSTICIA ADMINISTRATIVA DEL ESTADO DE CHIAPAS",
            "formato" => "COMPLETA",
            "tipo" => mb_strtoupper($Sec_Data["TipoDeclaracion"], 'UTF-8'),
            "fechaPresentacion" => $Sec_Data["fecha_fin"],
            "anio" => intval($Sec_Data["anio_anual"]),
            "actualizacionConflictoInteres" => false
        ];
    }
?>