<?php
    if (session_status() == PHP_SESSION_NONE) 
    {
        session_start();
    }
    
class Conectar
{
    protected $dbh;
    public $configMysql = "Produccion";
    
    protected function Conexion($db)
    {
        try {
            if ($this->configMysql == "Local") 
            {
                switch ($db) 
                {
                    case "siai":
                        $this->dbh = new PDO("mysql:host=localhost;dbname=siai", "root", "");
                        break;

                    case "siga":
                        $this->dbh = new PDO("mysql:host=localhost;dbname=siga_administrativo", "root", "");
                        break;

                    case "portal_empleado":
                        $this->dbh = new PDO("mysql:host=localhost;dbname=portal_tjaech", "root", "");
                        break;
                }
            } 
            else if($this->configMysql == "Produccion")
            {
                switch ($db) 
                {
                    case "siai":
                        $this->dbh = new PDO("mysql:host=192.168.1.225;dbname=siai", "SIAI_USER", "ChiapasInformatica$10");
                        break;

                    case "siga":
                        $this->dbh = new PDO("mysql:host=192.168.1.224;dbname=siga_administrativo", "siga", 'siga&%$admvo01');
                        break;
                    
                    case "portal_empleado":
                        $this->dbh = new PDO("mysql:host=192.168.1.225;dbname=portal_empleado", "SIAI_USER", 'ChiapasInformatica$10');
                        break;

                    case "declarachiapas":
                        $this->dbh = new PDO("mysql:host=localhost;dbname=declara_chiapas", "root", '');
                        break;
                }
            }

            return $this->dbh;
        } catch (PDOException $e) 
        {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    } 

    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8mb4'");
    }
}
?>
