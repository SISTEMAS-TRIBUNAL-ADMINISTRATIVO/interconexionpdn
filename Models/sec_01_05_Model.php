<?php
    class sec_01_05 extends Conectar
    {
        public function ExperianciaLaboral($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT 
                        sec_01_05.id,
                        c_ambito.clave AS Clave_ambito,
                        c_ambito.nombre AS Ambito,
                        c_nivel_gobierno.nombre AS nivelOrdenGobierno,
                        c_poder_ente.nombre AS ambitoPublico,
                        sec_01_05.nombre_ente AS nombreEntePublico,
                        sec_01_05.area_adscripcion,
                        sec_01_05.cargo_puesto,
                        sec_01_05.fecha_ingreso,
                        sec_01_05.fecha_salida,
                        c_pais.clave AS Clave_pais,
                        sec_01_05.observaciones
                    FROM sec_01_05
                    INNER JOIN c_ambito ON c_ambito.id = sec_01_05.id_ambito
                    INNER JOIN c_nivel_gobierno ON c_nivel_gobierno.id = sec_01_05.id_nivel_gobierno
                    INNER JOIN c_poder_ente ON c_poder_ente.id = sec_01_05.id_poder_ente
                    INNER JOIN c_pais ON c_pais.id = sec_01_05.id_pais
                    WHERE sec_01_05.id_declaracion = ?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

        public function FuncionesPrincipales($id_sec_01_05)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT funciones_principales FROM sec_01_05 WHERE id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $id_sec_01_05);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // 2. Decodificar el JSON
            $ids = json_decode($resultado['funciones_principales'], true);
            if (!is_array($ids)) 
            {
                return []; 
            }

            // 3. Convertir todos los valores a enteros para seguridad
            $ids = array_map('intval', $ids);

            // 4. Construir lista segura para consulta IN (...)
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $sql = "SELECT nombre FROM c_funciones_principales WHERE id IN ($placeholders)";
            $stmt = $conectar->prepare($sql);

            // 5. Asignar valores a los placeholders
            foreach ($ids as $k => $id) {
                $stmt->bindValue($k + 1, $id, PDO::PARAM_INT);
            }

            $stmt->execute();
            $catalogo = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // 6. Asociar ID => Descripción
            $descripcion_map = "";
            foreach ($catalogo as $row) 
            {
                $descripcion_map.= $row['nombre'] . ", ";
            }

            return $descripcion_map;
        }

    }
?>
