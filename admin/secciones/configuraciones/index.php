<?php 
include("../../bd.php");
include("../../templates/header.php"); 

// Fragmento de codigo para validar datos a base de su ID
if (isset($_GET['txtID'])) {
    // Sentencia para eliminar registros desde el administrador
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}

// Sentencia para seleccion de registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de Configuracion</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_configuraciones as $registros) { ?>
                    <tr class="">
                        <td><?php echo $registros['ID'];?></td>
                        <td><?php echo $registros['nombreConfiguracion'];?></td>
                        <td><?php echo $registros['valor'];?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID'];?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>

</div>


<?php include("../../templates/footer.php"); ?>