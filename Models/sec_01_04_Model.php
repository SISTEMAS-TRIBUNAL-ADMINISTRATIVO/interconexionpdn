<?php
    class sec_01_04 extends Conectar
    {
        public function DatosDelCargo($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT 
                        sec_01_04.id_padron,
                        c_nivel_gobierno.nombre AS nivelOrdenGobierno,
                        c_poder_ente.nombre AS ambitoPublico,
                        c_dependencia.nombre AS nombreEntePublico,
                        c_estructura.nombre AS areaAdscripcion,
                        c_cargo_puesto.nombre AS empleoCargoComision,
                        IF(padron.contrato_honorarios = 0, 'false', 'true') AS contratadoPorHonorarios,
                        padron.nivel_encargo AS nivelEmpleoCargoComision,
                        padron.fecha_inicio AS fechaTomaPosesion,
                        domicilios.calle,
                        domicilios.num_exterior,
                        domicilios.num_interior,
                        domicilios.colonia,
                        c_municipio.clave AS Clave_Municipio,
                        c_municipio.nombre AS Municipio,
                        c_estado.clave AS Clave_Estado,
                        c_estado.nombre AS Estado,
                        domicilios.codigo_postal,
                        sec_01_04.observaciones,
                        c_pais.nombre AS pais,
                        c_pais.id AS IdPais
                    FROM sec_01_04
                    INNER JOIN padron ON padron.id = sec_01_04.id_padron
                    INNER JOIN c_nivel_gobierno ON c_nivel_gobierno.id = padron.id_nivel_gobierno
                    INNER JOIN c_estructura ON c_estructura.id = padron.id_estructura
                    INNER JOIN c_cargo_puesto ON c_cargo_puesto.id = padron.id_cargo_puesto
                    INNER JOIN domicilios ON domicilios.id = padron.id_domicilio
                    INNER JOIN c_municipio ON c_municipio.id = domicilios.id_municipio
                    INNER JOIN c_estado ON c_estado.id = domicilios.id_estado
                    INNER JOIN c_poder_ente  ON c_poder_ente.id = padron.id_poder_ente
                    INNER JOIN c_dependencia ON c_dependencia.id = c_estructura.id_dependencia
                    INNER JOIN c_pais ON c_pais.id = domicilios.id_pais
                    WHERE sec_01_04.id_declaracion=?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

       public function FuncionesPrincipales($IdPadron)
       {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT funciones_principales FROM padron WHERE id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdPadron);
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

            $sql = "SELECT otras_funciones FROM padron WHERE id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdPadron);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            $descripcion_map = $Resultado[0]["otras_funciones"];

            return $descripcion_map;
        }

    }
?>