<?php 
include("../../bd.php");

if (isset($_GET['txtID'])){
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

  // Sentencia para recuperar los datos del ID correspondiente o seleccionada
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  $sentencia=$conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id");
  $sentencia->bindParam(":id",$txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);

  $imagen=$registro["imagen"];
  $nombreCompleto=$registro["nombreCompleto"];
  $puesto=$registro["puesto"];
  $x=$registro["x"];
  $instagram=$registro["instagram"];
  $linkedin=$registro["linkedin"];
}

if ($_POST) {
  $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
  $nombreCompleto=(isset($_POST["nombreCompleto"]))?$_POST["nombreCompleto"]:"";
  $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
  $x=(isset($_POST["x"]))?$_POST["x"]:"";
  $instagram=(isset($_POST["instagram"]))?$_POST["instagram"]:"";
  $linkedin=(isset($_POST["linkedin"]))?$_POST["linkedin"]:"";

  $sentencia=$conexion->prepare("UPDATE tbl_equipo SET 
    nombreCompleto=:nombreCompleto,
    puesto=:puesto,
    x=:x,
    instagram=:instagram,
    linkedin=:linkedin
    WHERE ID=:id");

    // $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":nombreCompleto",$nombreCompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":x",$x);
    $sentencia->bindParam(":instagram",$instagram);
    $sentencia->bindParam(":linkedin",$linkedin);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    if ($_FILES["imagen"]["tmp_name"]!="") {

      $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
      $fecha_imagen=new DateTime();
      $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
      
      $tmp_imagen=$_FILES["imagen"]["tmp_name"];
      // No olvides el slash (/) al final
      move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);

      // Este fragmento de codigo es para borrar el archivo anterior
      $sentencia=$conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();
      $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($registro_imagen["imagen"])) {

        if(file_exists("../../../assets/img/team/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/team/".$registro_imagen["imagen"]);
        }
    }

      $sentencia=$conexion->prepare("UPDATE tbl_equipo SET imagen=:imagen WHERE id=:id");
      $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();
      $imagen=$nombre_archivo_imagen;

    }

    $mensaje="Registro editado con éxito";
    header("Location:index.php?mensaje=".$mensaje);

}

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">
        Editor de Equipo
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly=true value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
        </div>

        <div class="mb-3">
          <label for="imagen" class="form-label">Imagen:</label>
          <img width="50" src="../../../assets/img/team/<?php echo $imagen;?>" />
          <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
        </div>

        <div class="mb-3">
         <label for="nombreCompleto" class="form-label">Nombre Completo:</label>
            <input type="text"
            class="form-control" value="<?php echo $nombreCompleto;?>" name="nombreCompleto" id="nombreCompleto" aria-describedby="helpId" placeholder="Nombre Completo">
        </div>

        <div class="mb-3">
         <label for="puesto" class="form-label">Puesto:</label>
            <input type="text"
            class="form-control" value="<?php echo $puesto;?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
        </div>

        <div class="mb-3">
          <label for="x" class="form-label">X (Twitter):</label>
          <input type="text"
            class="form-control" value="<?php echo $x;?>" name="x" id="x" aria-describedby="helpId" placeholder="X">
        </div>

        <div class="mb-3">
          <label for="instagram" class="form-label">Instagram:</label>
          <input type="text"
            class="form-control" value="<?php echo $instagram;?>" name="instagram" id="instagram" aria-describedby="helpId" placeholder="Instagram">
        </div>

        <div class="mb-3">
          <label for="linkedin" class="form-label">Linkedin:</label>
          <input type="text"
            class="form-control" value="<?php echo $linkedin;?>" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin">
        </div>

          <button type="submit" class="btn btn-success">Actualizar</button>
          <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>