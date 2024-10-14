<?php 
include("../../bd.php"); 
include("../../templates/header.php"); 

// Fragmento de codigo para validar datos a base de su ID
if (isset($_GET['txtID'])) {
    // Sentencia para recuperar los datos del ID correspondiente o seleccionada
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro['usuario'];
    $correo=$registro['correo'];
    $password=$registro['password'];

}

if ($_POST) {
    // Recepción de los valores del formulario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_usuarios 
    SET 
    usuario=:usuario,
    correo=:correo,
    password=:password 
    WHERE id=:id");

    $sentencia->bindParam(":id",$txtID);
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":password",$password);
    $sentencia->execute();
    
    $mensaje="Registro editado con éxito";
    header("Location:index.php?mensaje=".$mensaje);
}
?>

<div class="card">
    <div class="card-header">
        Editar Usuario
    </div>
    <div class="card-body">

    <form action="" enctype="multipart/form-data" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly="true" value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input  value="<?php echo $usuario;?>" type="text"
            class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input value="<?php echo $correo;?>" type="text"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña:</label>
          <input value="<?php echo $password;?>" type="password"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>