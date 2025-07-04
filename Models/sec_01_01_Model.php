<?php
    class sec_01_01 extends Conectar
    {
        public function DatosGenerales($IdDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT 
                        sec_01_01.nombre,
                        sec_01_01.apellido1 AS ApellidoUno,
                        sec_01_01.apellido2 AS ApellidoDos,
                        sec_01_01.curp,
                        sec_01_01.rfc,
                        sec_01_01.homoclave,
                        sec_01_01.correo_personal,
                        sec_01_01.correo_institucional,
                        sec_01_01.telefono_celular,
                        c_estado_civil.clave AS Estado_civil_clave,
                        c_estado_civil.nombre AS Estado_civil,
                        c_paisNacimiento.clave AS Pais_Nacimiento,
                        c_paisNacionalidad.clave AS Pais_Nacionalidad,
                        sec_01_01.observaciones
                    FROM sec_01_01
                    INNER JOIN c_estado_civil ON c_estado_civil.id = sec_01_01.id_estado_civil
                    INNER JOIN c_pais AS c_paisNacimiento ON c_paisNacimiento.id = sec_01_01.id_pais
                    INNER JOIN c_pais AS c_paisNacionalidad ON c_paisNacionalidad.id = sec_01_01.id_nacionalidad
                    WHERE sec_01_01.id_declaracion=?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }


        public function RegimenMatrimonial($IdDeclaracion)
        {
            $conectar = parent::conexion("declarachiapas");
            parent::set_names();

            $sql = "SELECT 
                        c_regimen_matrimonial.clave AS Regimen_matrimonial_clave,
                        c_regimen_matrimonial.nombre AS RegimenMatrominial
                    FROM sec_01_01
                    INNER JOIN c_regimen_matrimonial ON c_regimen_matrimonial.id = sec_01_01.id_regimen_matrimonial
                    WHERE sec_01_01.id_declaracion=?";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdDeclaracion);
            $stmt->execute();
            $Resultado = $stmt->fetchAll();
            return $Resultado;
        }

    }
?>
