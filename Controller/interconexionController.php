<?php
    require_once("../../config/conexion.php");
    //require_once("../controller/get_tokenController.php");
    require_once("../../models/ConexionSesaech/DeclaracionesModel.php");

    $declaraciones = new Declaraciones();
    $html = "";


   /* $token = 

    function sendDeclaracion($token, $jsonData) 
{
    $ch = curl_init(API_DECLARACION_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ]);
    curl_setopt($ch, CURLOPT_CAINFO, CACERT_PATH);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "[RESPONSE $httpCode]:\n$response\n\n";
}

// === A partir de aquí puedes cargar y recorrer tus declaraciones ===
$token = getValidToken();

// Ejemplo: cargar múltiples declaraciones desde un array
$declaraciones = [
    json_encode(["metadata" => [...], "declaracion" => [...]], JSON_UNESCAPED_UNICODE),
    // Agrega más aquí...
];

foreach ($declaraciones as $jsonDecl) {
    sendDeclaracion($token, $jsonDecl);
    sleep(1); // opcional: evitar saturar el servidor
}



    $conexion = new Conectar();
    $usuario = new Usuario();
    $html = "";

    header('Content-Type: application/json');

*/
    switch ($_GET["opcion"]) 
    {
        case "TodasLasDeclaracionesFirmadas":
                $datos = $declaraciones->TodasLasDeclaracionesFirmadas();
                $data = array(); 
        
                foreach ($datos as $resultado) 
                {
                    $DatosDeRespuesta = array();
                    $DatosDeRespuesta[] = $resultado["nombre"] . " " . $resultado["apellido1"] . " " . $resultado["apellido2"];
                    $DatosDeRespuesta[] = $resultado["TipoDeclaracion"];

                    if ($resultado["sendPDN"] == 1) 
                    {
                        $DatosDeRespuesta[] = '<span class="badge bg-success">Enviado</span>';
                    } 
                    else if ($resultado["sendPDN"] == 0) 
                    {
                        if($resultado["errorPDN"] != null)
                        {
                            $DatosDeRespuesta[] = '<span class="badge bg-danger">Error al enviar</span>';
                        }
                        else
                        {
                            $DatosDeRespuesta[] = '<span class="badge bg-warning text-dark">No enviado</span>';
                        }
                        
                    }

                    $DatosDeRespuesta[] = '<div class="text-center">
                                                <button class="btn btn-info btn-sm me-1" onclick="verUsuario('.$resultado['id'] .')">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                                <button class="btn btn-warning btn-sm me-1" onclick="editarUsuario('.$resultado['id'].')">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                        </div>';

                    $data[] = $DatosDeRespuesta;
                }
        
                $results = array
                (
                    "sEcho" => 1,
                    "iTotalRecords" => count($data),
                    "iTotalDisplayRecords" => count($data),
                    "aaData" => $data
                );
                echo json_encode($results);
        break;

    }
?>
