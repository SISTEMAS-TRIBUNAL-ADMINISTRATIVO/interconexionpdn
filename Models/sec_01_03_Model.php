<?php
    class sec_01_03 extends Conectar
    {
        public function datosCurriculares($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT
                        c_grado_academico.clave AS Clave_Grado,
                        c_grado_academico.nombre AS Grado_academico,
                        sec_01_03.institucion_educativa,
                        c_pais.clave AS Clave_pais,
                        sec_01_03.carrera,
                        c_estatus_academico.nombre AS Estatus_academico,
                        c_documento_obtenido.nombre AS Documento_obtenido,
                        sec_01_03.fecha_obtencion_documento,
                        sec_01_03.observaciones
                    FROM sec_01_03
                    INNER JOIN c_grado_academico ON c_grado_academico.id = sec_01_03.id_grado_academico
                    INNER JOIN c_pais ON c_pais.id = sec_01_03.id_pais
                    INNER JOIN c_estatus_academico ON c_estatus_academico.id = sec_01_03.id_estatus_academico
                    INNER JOIN c_documento_obtenido ON c_documento_obtenido.id = sec_01_03.id_documento_obtenido
                    WHERE id_declaracion=?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }      
    }
?>
