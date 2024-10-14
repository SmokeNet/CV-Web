<?php 
include("../../bd.php");

// Fragmento de codigo para validar datos a base de su ID
if (isset($_GET['txtID'])) {
    // Sentencia para recuperar los datos del ID correspondiente o seleccionada
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nombreConfiguracion=$registro['nombreConfiguracion'];
    $valor=$registro['valor'];
}

if ($_POST) {
    // Recepción de los valores del formulario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombreConfiguracion=(isset($_POST['nombreConfiguracion']))?$_POST['nombreConfiguracion']:"";
    $valor=(isset($_POST['valor']))?$_POST['valor']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_configuraciones
    SET
    nombreConfiguracion=:nombreConfiguracion,
    valor=:valor
    WHERE id=:id");

    $sentencia->bindParam(":id",$txtID);
    $sentencia->bindParam(":nombreConfiguracion",$nombreConfiguracion);
    $sentencia->bindParam(":valor",$valor);
    $sentencia->execute();

    $mensaje="Registro editado con éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Editar Configuraciones
    </div>
    <div class="card-body">

    <form action="" enctype="multipart/form-data" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly="true" value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

        <div class="mb-3">
          <label for="nombreConfiguracion" class="form-label">Nombre de Configuración:</label>
          <input value="<?php echo $nombreConfiguracion;?>" type="text"
            class="form-control" name="nombreConfiguracion" id="nombreConfiguracion" aria-describedby="helpId" placeholder="Nombre de Configuración">
        </div>

        <div class="mb-3">
          <label for="valor" class="form-label">Valor:</label>
          <input value="<?php echo $valor;?>" type="text"
            class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>