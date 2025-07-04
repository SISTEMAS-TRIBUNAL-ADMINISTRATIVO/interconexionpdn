<?php
    class sec_01_02 extends Conectar
    {
        public function DomicilioMexico($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT
                        sec_01_02.calle,
                        sec_01_02.num_exterior,
                        sec_01_02.num_interior,
                        sec_01_02.colonia,
                        c_municipio.clave AS Clave_municipio,
                        c_municipio.nombre AS Municipio,
                        c_estado.clave AS Clave_Estado,
                        c_estado.nombre AS Estado,
                        sec_01_02.codigo_postal,
                        c_pais.clave AS Clave_pais,
                        sec_01_02.observaciones
                    FROM sec_01_02
                    INNER JOIN c_municipio ON c_municipio.id = sec_01_02.id_municipio
                    INNER JOIN c_estado ON c_estado.id = sec_01_02.id_estado
                    INNER JOIN c_pais ON c_pais.id = sec_01_02.id_pais
                    WHERE sec_01_02.id_declaracion =? AND sec_01_02.id_pais=37";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

        public function DomicilioExtranjero($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT
                        sec_01_02.calle,
                        sec_01_02.num_exterior,
                        sec_01_02.num_interior,
                        sec_01_02.colonia,
                        c_municipio.clave AS Clave_municipio,
                        c_municipio.nombre AS Municipio,
                        c_estado.clave AS Clave_Estado,
                        c_estado.nombre AS Estado,
                        sec_01_02.codigo_postal,
                        c_pais.clave AS Clave_pais,
                        sec_01_02.observaciones
                    FROM sec_01_02
                    INNER JOIN c_municipio ON c_municipio.id = sec_01_02.id_municipio
                    INNER JOIN c_estado ON c_estado.id = sec_01_02.id_estado
                    INNER JOIN c_pais ON c_pais.id = sec_01_02.id_pais
                    WHERE sec_01_02.id_declaracion =? AND sec_01_02.id_pais <> 37";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

    }
?>
