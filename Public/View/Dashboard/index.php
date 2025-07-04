<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tribunal de Justicia Administrativa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: "Segoe UI", system-ui, sans-serif;
      background-color: #f8f9fa;
      color: #212529;
    }

    .header-top {
      background-color: white;
      padding: 1rem 2rem;
      border-bottom: 1px solid #dee2e6;
    }

    .header-top h1 {
      font-size: 1.25rem;
      font-weight: bold;
      margin: 0;
      color: #0b2447;
    }

    .navbar {
      background-color: #0b2447;
      padding: 0.5rem 2rem;
    }

    .navbar a {
      color: white !important;
      margin-right: 1rem;
      font-weight: 500;
    }

    .user-box {
      text-align: right;
      font-size: 0.85rem;
      color: #212529;
    }

    .user-box strong {
      display: block;
      font-size: 0.95rem;
      color: #0b2447;
    }

    .btn-logout {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 0.3rem 0.7rem;
      font-size: 0.75rem;
      margin-top: 0.3rem;
      border-radius: 0.25rem;
    }

    .card {
      border-radius: 0.75rem;
      padding: 1.25rem;
      color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .card.green { background-color: #28a745; }
    .card.orange { background-color: #fd7e14; }
    .card.red { background-color: #dc3545; }

    .btn-transferir {
      background-color: #0d6efd;
      border: none;
      padding: 0.75rem 2rem;
      border-radius: 0.5rem;
      font-weight: 500;
      color: white;
      margin-bottom: 1.5rem;
    }

    .custom-table thead th {
      background-color: #e9ecef;
      color: #212529;
      font-weight: 600;
      text-align: center;
    }

    .custom-table tbody td {
      vertical-align: middle;
      text-align: center;
      background-color: white;
    }

    .custom-table tbody tr:nth-child(even) {
      background-color: #f1f3f5;
    }

    .footer {
      border-top: 1px solid #dee2e6;
      padding: 2rem 1rem 1rem;
      background-color: #fff;
      text-align: center;
    }

    .footer h5 {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .footer img {
      max-height: 60px;
      margin: 0 1.5rem;
    }

    .footer p {
      font-size: 0.9rem;
      color: #666;
      margin-top: 1rem;
    }
  </style>
</head>
<body>

  <!-- ENCABEZADO -->
  <div class="header-top d-flex justify-content-between align-items-center flex-wrap">
    <h1>Tribunal de Justicia Administrativa del Estado de Chiapas</h1>
    <div class="user-box">
      <strong>JOSE FERNANDO VALDES NANDUCA</strong>
      valdesnanduca@gmail.com<br>
      VANF961224HCSLNR02<br>
      <button class="btn-logout">Cerrar sesión</button>
    </div>
  </div>

  <!-- NAVBAR -->
  <div class="navbar navbar-expand-lg">
    <a href="#">Inicio</a>
    <a href="#">Formatos</a>
    <a href="#">Resguardos</a>
    <a href="#">Avisos</a>
    <a href="#">Usuarios</a>
  </div>

  <!-- TARJETAS -->
  <div class="container my-4">
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="card green text-center">
          <h5>Transferencias Enviadas</h5>
          <h3>0</h3>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card orange text-center">
          <h5>No Enviadas</h5>
          <h3>0</h3>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card red text-center">
          <h5>Con Errores</h5>
          <h3>0</h3>
        </div>
      </div>
    </div>

    <!-- BOTÓN -->
    <div class="text-center">
      <button class="btn btn-transferir">Empezar con la transferencia de información</button>
    </div>

    <!-- TABLA -->
    <div class="table-responsive">
      <table class="table table-bordered custom-table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Tipo de Declaración</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Juan Pérez</td>
            <td>Inicial</td>
            <td>Enviada</td>
            <td><button class="btn btn-sm btn-outline-primary">Ver</button></td>
          </tr>
          <tr>
            <td>Maria López</td>
            <td>Modificación</td>
            <td>Error</td>
            <td><button class="btn btn-sm btn-outline-primary">Ver</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <h5>Sitios de Interés</h5>
    <div class="d-flex justify-content-center align-items-center flex-wrap">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Logotipo_Gobierno_de_Chiapas_2024-2030.svg/2560px-Logotipo_Gobierno_de_Chiapas_2024-2030.svg.png" alt="Gobierno de Chiapas">
      <img src="https://www.scjn.gob.mx/sites/all/themes/scjn_bootstrap/images/logo-scjn.png" alt="Suprema Corte">
      <img src="https://transparencia.org.mx/wp-content/uploads/2021/08/logo-pnt-transparencia.png" alt="Plataforma Nacional">
      <img src="https://www.sna.org.mx/wp-content/uploads/2019/06/logo-sna-oficial-2018.png" alt="SNA">
    </div>
    <p>Tribunal de Justicia Administrativa del Estado de Chiapas - Todos los derechos reservados 2025</p>
  </div>

</body>

<!-- DataTables JS y CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tabla-transferencias').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
      },
      paging: true,
      searching: true,
      ordering: true
    });
  });
</script>

</html>
