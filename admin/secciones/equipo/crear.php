<?php
include("../../bd.php");

if ($_POST) {
    // Recepción de los valores del formulario 
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $nombreCompleto=(isset($_POST["nombreCompleto"]))?$_POST["nombreCompleto"]:"";
    $puesto=(isset($_POST["puesto"]))?$_POST["puesto"]:"";
    $x=(isset($_POST["x"]))?$_POST["x"]:"";
    $instagram=(isset($_POST["instagram"]))?$_POST["instagram"]:"";
    $linkedin=(isset($_POST["linkedin"]))?$_POST["linkedin"]:"";

    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
      // No olvides el slash (/) al final
      move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
    }

    $sentencia=$conexion->prepare("INSERT INTO `tbl_equipo` 
    (`ID`, `imagen`, `nombreCompleto`, `puesto`, `x`, `instagram`, `linkedin`) 
    VALUES (NULL, :imagen, :nombreCompleto, :puesto, :x ,:instagram, :linkedin);");

    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":nombreCompleto",$nombreCompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":x",$x);
    $sentencia->bindParam(":instagram",$instagram);
    $sentencia->bindParam(":linkedin",$linkedin);
    $sentencia->execute();

    $mensaje="Registro creado con éxito";
    header("Location:index.php?mensaje=".$mensaje);
}


include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Crear Equipo
    </div>
    <form action="" enctype="multipart/form-data" method="post">
    <div class="card-body">
        <div class="mb-3">
          <label for=imagen" class="form-label">Imagen:</label>
          <input type="file"
            class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
        </div>

        <div class="mb-3">
      <label for="nombreCompleto" class="form-label">Nombre Completo:</label>
      <input type="text"
        class="form-control" name="nombreCompleto" id="nombreCompleto" aria-describedby="helpId" placeholder="Nombre Completo">
    </div>

    <div class="mb-3">
      <label for="puesto" class="form-label">Puesto:</label>
      <input type="text"
        class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
    </div>

    <div class="mb-3">
      <label for="x" class="form-label">X (Twitter)</label>
      <input type="text"
        class="form-control" name="x" id="x" aria-describedby="helpId" placeholder="X">
    </div>

    <div class="mb-3">
      <label for="instagram" class="form-label">Instagram</label>
      <input type="text"
        class="form-control" name="instagram" id="instagram" aria-describedby="helpId" placeholder="Instagram">
    </div>

    <div class="mb-3">
      <label for="linkedin" class="form-label">Linkedin</label>
      <input type="text"
        class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin">
    </div>
        <button type="submit" class="btn btn-success">Agregar</button>

        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </div>

    </form>
    
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>