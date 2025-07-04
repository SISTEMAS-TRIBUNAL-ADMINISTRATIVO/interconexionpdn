<?php
    class sec_01_06 extends Conectar
    {

        public function DatosDeLaPareja($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = " SELECT	
                        sec_01_06.id,
                        sec_01_06.nombre,
                        sec_01_06.apellido1,
                        sec_01_06.apellido2,
                        sec_01_06.fecha_nacimiento,
                        sec_01_06.rfc,
                        c_relacion_declarante.nombre AS relacionConDeclarante,
                        if(sec_01_06.id_nacionalidad <> 37, 'true', 'false') AS ciudadanoExtranjero,
                        sec_01_06.curp,
                        if(sec_01_06.dependiente_economico = "."b'1'"." , 'true', 'false') AS esDependienteEconomico,
                        if(sec_01_06.habita_con_declarante = "."b'1'"." , 'true', 'false') AS habitaDomicilioDeclarante,
                        c_pais.nombre AS lugarDondeReside,
                        c_ambito.clave AS Clave_ActividadLAboral,
                        c_ambito.nombre AS AmbitoLaboral,
                        IF(sec_01_06.es_proveedor_contratista = "."b'1'".", 'true', 'false') AS proveedorContratistaGobierno,
                        sec_01_06.observaciones
                    FROM sec_01_06
                    INNER JOIN c_relacion_declarante ON c_relacion_declarante.id = sec_01_06.id_relacion_declarante
                    INNER JOIN c_pais ON c_pais.id = sec_01_06.id_pais_residencia
                    INNER JOIN c_ambito ON c_ambito.id = sec_01_06.id_ambito
                    WHERE sec_01_06.id_declaracion = ?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }


        public function DomicilioMexico($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = " SELECT 
                        domicilios.calle,
                        domicilios.num_exterior,
                        domicilios.num_interior,
                        domicilios.colonia,
                        c_municipio.clave AS Clave_municipio,
                        c_municipio.nombre AS Municipio,
                        c_estado.clave AS Clave_Estado,
                        c_estado.nombre AS Estado,
                        domicilios.codigo_postal,
                        c_pais.nombre AS Pais
                    FROM sec_01_06
                    INNER JOIN domicilios ON domicilios.id = sec_01_06.id_domicilio
                    INNER JOIN c_estado ON c_estado.id = domicilios.id_estado
                    INNER JOIN c_municipio ON c_municipio.id = domicilios.id_municipio
                    INNER JOIN c_pais ON c_pais.id = domicilios.id_pais
                    WHERE sec_01_06.id_declaracion=? AND domicilios.id_pais = 37";

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

            $sql = " SELECT 
                        domicilios.calle,
                        domicilios.num_exterior,
                        domicilios.num_interior,
                        domicilios.colonia,
                        c_municipio.clave AS Clave_municipio,
                        c_municipio.nombre AS Municipio,
                        c_estado.clave AS Clave_Estado,
                        c_estado.nombre AS Estado,
                        domicilios.codigo_postal,
                        c_pais.nombre AS Pais
                    FROM sec_01_06
                    INNER JOIN domicilios ON domicilios.id = sec_01_06.id_domicilio
                    INNER JOIN c_estado ON c_estado.id = domicilios.id_estado
                    INNER JOIN c_municipio ON c_municipio.id = domicilios.id_municipio
                    INNER JOIN c_pais ON c_pais.id = domicilios.id_pais
                    WHERE sec_01_06.id_declaracion=? AND domicilios.id_pais <> 37";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

        public function TrabajoAmbitoPublico($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = " SELECT
                        c_nivel_gobierno.nombre AS Nivel_Gobierno,
                        c_ambito.clave AS Clave_Ambito,
                        sec_01_06.nombre_ente AS nombreEntePublico,
                        sec_01_06.area_adscripcion,
                        sec_01_06.cargo_puesto,
                        sec_01_06.salario_mensual,
                        sec_01_06.fecha_ingreso
                    FROM sec_01_06
                    INNER JOIN c_nivel_gobierno on c_nivel_gobierno.id = sec_01_06.id_nivel_gobierno
                    INNER JOIN c_ambito on c_ambito.id = sec_01_06.id_ambito
                    WHERE sec_01_06.id_ambito = 1 AND sec_01_06.id_declaracion= ?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

        public function TrabajoAmbitoPrivadoOtro($idDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = " SELECT
                        sec_01_06.nombre_ente,
                        sec_01_06.cargo_puesto,
                        sec_01_06.rfc_empresa,
                        sec_01_06.fecha_ingreso,
                        sec_01_06.salario_mensual,
                        c_sector_industria.clave AS Clave_Sector,
                        c_sector_industria.nombre AS Sector
                    FROM sec_01_06
                    INNER JOIN c_sector_industria on c_sector_industria.id = sec_01_06.id_sector_industria
                    WHERE sec_01_06.id_ambito <> 1 AND sec_01_06.id_declaracion=?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $idDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

       public function FuncionesPrincipales($Id)
       {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT funciones_principales FROM sec_01_06 WHERE id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $Id);
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

            $sql = "SELECT otras_funciones FROM sec_01_06 WHERE id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            $descripcion_map = $Resultado[0]["otras_funciones"];

            return $descripcion_map;
        }
    }
?>
