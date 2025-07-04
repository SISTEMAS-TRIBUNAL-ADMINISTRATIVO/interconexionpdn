<?php
    class Declaraciones extends Conectar
    {
        public function TodasLasDeclaracionesFirmadas()
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT 
                        declaraciones.id,
                        personal.nombre,
                        personal.apellido1,
                        personal.apellido2,
                        c_tipo_declaracion.nombre AS TipoDeclaracion,
                        declaraciones.sendPDN,
                        declaraciones.errorPDN
                    FROM declaraciones
                    INNER JOIN c_tipo_declaracion ON c_tipo_declaracion.id = declaraciones.id_tipo_declaracion
                    INNER JOIN personal ON personal.id = declaraciones.id_persona
                    WHERE declaraciones.fecha_firma IS NOT NULL";

            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

        public function DetallesXid($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT 
                        declaraciones.id,
                        declaraciones.id_persona,
                        declaraciones.id_persona_aux,
                        declaraciones.curp_aux,
                        declaraciones.id_declarachiapas,
                        declaraciones.id_tipo_declaracion,
                        declaraciones.id_c_declaracion,
                        declaraciones.dependencia,
                        declaraciones.fecha_inicio,
                        declaraciones.fecha_fin,
                        declaraciones.id_tipo_publicacion,
                        declaraciones.sec_01_01,
                        declaraciones.sec_01_01_p,
                        declaraciones.sec_01_02,
                        declaraciones.sec_01_02_p,  
                        declaraciones.sec_01_03,  
                        declaraciones.sec_01_03_p,  
                        declaraciones.sec_01_03_ninguno,
                        declaraciones.sec_01_04,  
                        declaraciones.sec_01_04_p,  
                        declaraciones.sec_01_05,  
                        declaraciones.sec_01_05_p,  
                        declaraciones.sec_01_05_ninguno,  
                        declaraciones.sec_01_06,  
                        declaraciones.sec_01_06_p,  
                        declaraciones.sec_01_06_ninguno,  
                        declaraciones.sec_01_07,  
                        declaraciones.sec_01_07_p,  
                        declaraciones.sec_01_07_ninguno,  
                        declaraciones.sec_01_08,  
                        declaraciones.sec_01_08_p,  
                        declaraciones.sec_01_09,  
                        declaraciones.sec_01_09_p,  
                        declaraciones.sec_01_10,  
                        declaraciones.sec_01_10_p,  
                        declaraciones.sec_01_10_ninguno,  
                        declaraciones.sec_01_11,  
                        declaraciones.sec_01_11_p,  
                        declaraciones.sec_01_11_ninguno,  
                        declaraciones.sec_01_12,  
                        declaraciones.sec_01_12_p,  
                        declaraciones.sec_01_12_ninguno,  
                        declaraciones.sec_01_13,  
                        declaraciones.sec_01_13_p,  
                        declaraciones.sec_01_13_ninguno,  
                        declaraciones.sec_01_14,  
                        declaraciones.sec_01_14_p,  
                        declaraciones.sec_01_14_ninguno,  
                        declaraciones.sec_01_15,  
                        declaraciones.sec_01_15_p,  
                        declaraciones.sec_01_15_ninguno,  
                        declaraciones.sec_02_01,  
                        declaraciones.sec_02_01_p,  
                        declaraciones.sec_02_01_ninguno,  
                        declaraciones.sec_02_02,  
                        declaraciones.sec_02_02_p,  
                        declaraciones.sec_02_02_ninguno,  
                        declaraciones.sec_02_03,  
                        declaraciones.sec_02_03_p,  
                        declaraciones.sec_02_03_ninguno,  
                        declaraciones.sec_02_04,  
                        declaraciones.sec_02_04_p,  
                        declaraciones.sec_02_04_ninguno,  
                        declaraciones.sec_02_05,  
                        declaraciones.sec_02_05_p,  
                        declaraciones.sec_02_05_ninguno,  
                        declaraciones.sec_02_06,
                        declaraciones.sec_02_06_p,  
                        declaraciones.sec_02_06_ninguno,  
                        declaraciones.sec_02_07,  
                        declaraciones.sec_02_07_p,  
                        declaraciones.sec_02_07_ninguno,  
                        declaraciones.sec_03_01,  
                        declaraciones.sec_03_01_p,  
                        declaraciones.sec_03_01_ninguno,  
                        declaraciones.observaciones,  
                        declaraciones.es_extemporanea,
                        declaraciones.vobo,
                        declaraciones.serie_certificado,
                        declaraciones.secuencia_firma,  
                        declaraciones.fecha_firma,  
                        declaraciones.firma_electronica,  
                        declaraciones.cadena_original,
                        declaraciones.UUID,   
                        declaraciones.noOficio,  
                        declaraciones.fechaSellado,  
                        declaraciones.cadenaSello,  
                        declaraciones.xml,     
                        declaraciones.campo,   
                        declaraciones.sendPDN,
                        declaraciones.dateSendPDN,  
                        declaraciones.errorPDN,  
                        declaraciones.created_at,  
                        declaraciones.updated_at,  
                        declaraciones.deleted_at,  
                        declaraciones.anio_anual,  
                        declaraciones.complementaria,  
                        declaraciones.comodin, 
                        c_tipo_declaracion.nombre AS TipoDeclaracion
                FROM declaraciones
                INNER JOIN c_tipo_declaracion on c_tipo_declaracion.id = declaraciones.id_tipo_declaracion
                WHERE declaraciones.id=?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }
    }
?>
