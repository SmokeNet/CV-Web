<?php 
session_start();
$url_base="http://localhost/website/admin/"; 
if (!isset($_SESSION['usuario'])) {
  header("Location:".$url_base."login.php");
}
?>


<!doctype html>
<html lang="en">
<head>
  <title>Admin de Sitio Web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
  <header>
    <!-- place navbar here -->
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios/">Habilidades</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/portafolio/">Portafolio</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/entradas/">Estudios</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/equipo/">Experiencia</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/configuraciones/">Configuraciones</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/usuarios/">Usuarios</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesión</a>
        </div>
    </nav>
  </header>
  <main class="container">
    <br/>
    <script>
      <?php if(isset($_GET['mensaje'])){ ?>
        Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']?>"});
        <?php }?>
    </script>