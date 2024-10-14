<?php 
include("../../bd.php"); 
include("../../templates/header.php");

// Fragmento de codigo para validar datos a base de su ID
if (isset($_GET['txtID'])) {
    // Sentencia para recuperar los datos del ID correspondiente o seleccionada
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $icono=$registro['icono'];
    $titulo=$registro['titulo'];
    $descripcion=$registro['descripcion'];
}

if ($_POST) {
        // Recepción de los valores del formulario
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $icono=(isset($_POST['icono']))?$_POST['icono']:"";
        $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
        $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    
        $sentencia=$conexion->prepare("UPDATE tbl_servicios 
        SET 
        icono=:icono,
        titulo=:titulo,
        descripcion=:descripcion 
        WHERE id=:id");
    
        $sentencia->bindParam(":id",$txtID);
        $sentencia->bindParam(":icono",$icono);
        $sentencia->bindParam(":titulo",$titulo);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->execute();
        
        $mensaje="Registro editado con éxito";
        header("Location:index.php?mensaje=".$mensaje);
}

?>

<div class="card">
    <div class="card-header">
        Editar servicios
    </div>
    <div class="card-body">

    <form action="" enctype="multipart/form-data" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly=true value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Icono:</label>
          <input  value="<?php echo $icono;?>" type="text"
            class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono">
        </div>

        <div class="mb-3">
          <label for="titulo" class="form-label">Título:</label>
          <input value="<?php echo $titulo;?>" type="text"
            class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título">
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción:</label>
          <input value="<?php echo $descripcion;?>" type="text"
            class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>

        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

    </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>