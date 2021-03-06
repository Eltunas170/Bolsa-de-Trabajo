<?php
include("conexion.php");
$msg = ""; //Cambiar los mensajes de cada validacion respecto a la tabla
$estatusAlta = "Alta";
$estatusBaja = "Baja";
$estatusMuerto = "Muerto";

//name de los Input para las Consultas
$idQuery = ""; //Llena el campo id con el id de la tabla en html
$nameQuery = ""; //Llena el campo name con el name de la tabla en html
$lastname1Query = "";
$lastname2Query = "";
$estadoCivilQuery = "";
$direccionQuery = "";
$telefonoQuery = "";
$sexoQuery = "";
$fechaNacimientoQuery = "";
$estatusQuery = "";
$nacionalidadQuery = "";
$escolaridadQuery = "";
$experienciaQuery = "";
$perfilQuery = "";
$fechaIngresoQuery = "";
$idDocumentosQuery = "";
$observacionesQuery = "";
$nacionalidadNameQuery = "";

//Name/Id de los Inputs
$id = $_POST['id']; //id hare referencia a la clave de la tabla actual
$name = trim($_POST['name']); //name hare referencia al campo nombre de la tabla actual
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$estadoCivil = $_POST['estadoCivil'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$estatus = $_POST['estatus'];
$nacionalidad = $_POST['nacionalidad'];
$escolaridad = $_POST['escolaridad'];
$experiencia = $_POST['experiencia'];
$perfil = $_POST['perfil'];
$fechaIngreso = $_POST['fechaIngreso'];
$idDocumentos = $_POST['idDocumentos'];
$observaciones = $_POST['observaciones'];
$nacionalidadName = $_POST['nacionalidadName'];

// Nombre de tabla y campos de tabla
$table = "Bolsa";
$cveTabla = "noControl";
$nombre = "nombre";
$lastname1 = "aPaterno";
$lastname2 = "aMaterno";
$address = "direccion";
$phoneNumber = "telefono";
$sex = "sexo";
$status = "estatus";
$maritalStatus = "estadoCivil";
$birthDay = "fechaNacimiento";
$admissionDate = "fechaIngreso";
$cveExperiencia = "cveExperiencia";
$cveEscolaridad = "cveEscolaridad";
$cveNacionalidad = "cveNacionalidad";
$cvePerfil = "cvePerfil";
$idDocumentosBolsa = "idDocumentosBolsa";
$observations = "observaciones";


$empleadoTable = "Empleados";
$cveEmpleado = "cveEmpleado";
$cvePuesto = "cvePuesto";
$cveCategoria = "cveCategoria";
$cveDepartamento = "cveDepartamento";
$idCursoEmpleado = "idCursoEmpleado";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="styleMantenimieto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Bolsa de Trabajo</title>
</head>

<body>

    <?php
    // ALTA
    if (isset($_POST["alta"])) {
        $consulta = "SELECT * FROM $table WHERE $cveTabla = '$id'";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_array($resultado);
        if ($row > 0) {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >Ya existe la clave y/o nombre.</h4>";
        } elseif (strlen($id) >= 1 && strcmp($estatus, $estatusBaja) == 0) {
            // $consulta = "INSERT INTO $table($cveTabla, $nombre, $cvePerfil, $lastname1, $lastname2, $address, $phoneNumber, $sex, $status, $maritalStatus, $birthDay, $cveExperiencia, $cveEscolaridad, $idDocumentosBolsa, $observations, $admissionDate, $cveNacionalidad) 
            // VALUES ('$id', '$name', '$perfil', '$aPaterno', '$aMaterno', '$direccion', '$telefono', '$sexo', '$estatus', '$estadoCivil', '$fechaNacimiento', '$experiencia', '$escolaridad', '$idDocumentos', '$observaciones', '$fechaIngreso', '$nacionalidad')";
            // $resultado = mysqli_query($conexion, $consulta);
            $msg .= "<h4 class = 'text-danger text-center mt-4'>El registro solo se realiza con Estatus Alta, favor de verificar.</h4>";
        } elseif (strlen($id) >= 1 && strcmp($estatus, $estatusAlta) == 0) {
            $consulta = "INSERT INTO $table($cveTabla, $nombre, $cvePerfil, $lastname1, $lastname2, $address, $phoneNumber, $sex, $status, $maritalStatus, $birthDay, $cveExperiencia, $cveEscolaridad, $idDocumentosBolsa, $observations, $admissionDate, $cveNacionalidad) 
            VALUES ('$id', '$name', '$perfil', '$aPaterno', '$aMaterno', '$direccion', '$telefono', '$sexo', '$estatus', '$estadoCivil', '$fechaNacimiento', '$experiencia', '$escolaridad', '$idDocumentos', '$observaciones', '$fechaIngreso', '$nacionalidad')";
            $resultado = mysqli_query($conexion, $consulta);

            if($resultado){
                $consulta = "INSERT INTO Empleados(cveEmpleado, $nombre, $lastname1, $lastname2, $address, $phoneNumber, $sex, $status, $maritalStatus, $birthDay, cvePuesto, cveCategoria, idCursoEmpleado, $observations, $admissionDate, cveDepartamento) 
                VALUES ('$id', '$name', '$aPaterno', '$aMaterno', '$direccion', '$telefono', '$sexo', '$estatusBaja', '$estadoCivil', '$fechaNacimiento', 1, 1, 1, '$observaciones', '$fechaIngreso', 1)";
                $resultado = mysqli_query($conexion, $consulta);
            }            
            
            $msg .= "<h4 class = 'text-success text-center mt-4'>Alta realizada con exito con Estatus Alta.</h4>";
        } elseif (strlen($id) >= 1 && strcmp($estatus, "Muerto") == 0) {
            $msg .= "<h4 class = 'text-success text-center mt-4'>Alta realizada con exito con Estatus Muerto.</h4>";
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >Llene todos los campos por favor</h4>";
        }
    }

    // BAJA
    if (isset($_POST["baja"])) {
        $consulta = "SELECT * FROM $table WHERE $cveTabla = '$id'";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_array($resultado);
        if ($row > 0) {
            $delete = "DELETE FROM $table WHERE $cveTabla = '$id'";
            $resultado = mysqli_query($conexion, $delete);
            $msg .= "<h4 class = 'text-success text-center mt-4'>Baja realizada con exito.</h4>";
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe registro a eliminar.</h4>";
        }
    }

    // CONSULTA
    if (isset($_POST["consulta"])) {
        if (strlen($id) >=1) {
            $consulta = "SELECT * FROM $table WHERE $cveTabla = '$id'";
            $resultado = mysqli_query($conexion, $consulta);
            $getConsulta = mysqli_fetch_array($resultado);
            if ($getConsulta >= 0) {
                $idQuery = $getConsulta[$cveTabla];
                $nameQuery = $getConsulta[$nombre];
                $lastname1Query = $getConsulta[$lastname1];
                $lastname2Query = $getConsulta[$lastname2];
                $perfilQuery = $getConsulta[$cvePerfil];
                $direccionQuery = $getConsulta[$address];
                $telefonoQuery = $getConsulta[$phoneNumber];
                $sexoQuery = $getConsulta[$sex];
                $estatusQuery = $getConsulta[$status];
                $estadoCivilQuery = $getConsulta[$maritalStatus];
                $fechaNacimientoQuery = $getConsulta[$birthDay];
                $experienciaQuery = $getConsulta[$cveExperiencia];
                $escolaridadQuery = $getConsulta[$cveEscolaridad];
                $fechaIngresoQuery = $getConsulta[$admissionDate];
                $idDocumentosQuery= $getConsulta[$idDocumentosBolsa];
                $observacionesQuery = $getConsulta[$observations];
                $nacionalidadQuery = $getConsulta[$cveNacionalidad];
                $queryNacionalidad = "SELECT nacionalidad FROM Nacionalidades WHERE cveNacionalidad = '$nacionalidad'"; 
                $resultNacionalidad = mysqli_query($conexion, $queryNacionalidad);
                $rowNacionalidad = mysqli_fetch_array($resultNacionalidad);
                $msg .= "<h4 class = 'text-success text-center mt-4'>Consulta realizada con exito.</h4>";
            } else {
                $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe el registro que quiere consultar.</h4>";
            }
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe el registro que quiere consultar.</h4>";
        }
    }

    if(isset($_POST["consultaCampos"])){
        $queryNacionalidad = "SELECT nacionalidad FROM Nacionalidades WHERE cveNacionalidad = '$nacionalidad'"; 
        $resultNacionalidad = mysqli_query($conexion, $queryNacionalidad);
        $rowNacionalidad = mysqli_fetch_array($resultNacionalidad);
        if($rowNacionalidad > 0){
            $consulta = "SELECT * FROM $table WHERE $cveTabla = '$id'";
            $resultado = mysqli_query($conexion, $consulta);
            $getConsulta = mysqli_fetch_array($resultado);
            if($getConsulta > 0){
                $idQuery = $getConsulta[$cveTabla];
                $nameQuery = $getConsulta[$nombre];
                $lastname1Query = $getConsulta[$lastname1];
                $lastname2Query = $getConsulta[$lastname2];
                $perfilQuery = $getConsulta[$cvePerfil];
                $direccionQuery = $getConsulta[$address];
                $telefonoQuery = $getConsulta[$phoneNumber];
                $sexoQuery = $getConsulta[$sex];
                $estatusQuery = $getConsulta[$status];
                $estadoCivilQuery = $getConsulta[$maritalStatus];
                $fechaNacimientoQuery = $getConsulta[$birthDay];
                $experienciaQuery = $getConsulta[$cveExperiencia];
                $escolaridadQuery = $getConsulta[$cveEscolaridad];
                $fechaIngresoQuery = $getConsulta[$admissionDate];
                $idDocumentosQuery= $getConsulta[$idDocumentosBolsa];
                $observacionesQuery = $getConsulta[$observations];
                // $nacionalidadQuery = $getConsulta[$cveNacionalidad];
                $nacionalidadQuery = $nacionalidad;
                // $queryNacionalidad = "SELECT nacionalidad FROM Nacionalidades WHERE cveNacionalidad = '$nacionalidad'"; 
                // $resultNacionalidad = mysqli_query($conexion, $queryNacionalidad);
                // $rowNacionalidad = mysqli_fetch_array($resultNacionalidad);
                $msg .= "<h4 class = 'text-success text-center mt-4'>Consulta realizada con exito.</h4>";
            }
        }
    }

    //MODIFICACION     
    if (isset($_POST["modificar"])) {
        $consulta = "SELECT * FROM $table WHERE $cveTabla = '$id'";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_array($resultado);
        if ($row > 0 && $name != "" && strcmp($estatus, $estatusAlta) == 0) {
            $update = "UPDATE $table SET $nombre='$name', $cvePerfil='$perfil', $lastname1='$aPaterno', $lastname2='$aMaterno', $address='$direccion', $phoneNumber='$telefono', $sex='$sexo', $status='$estatus', $maritalStatus='$estadoCivil', $birthDay='$fechaNacimiento', $cveExperiencia='$experiencia', $cveEscolaridad='$escolaridad', $idDocumentosBolsa='$idDocumentos', $observations='$observaciones', $admissionDate='$fechaIngreso', $cveNacionalidad='$nacionalidad' 
            WHERE $cveTabla = '$id'";
            $resultado = mysqli_query($conexion, $update);
            if($resultado){
                $update = "UPDATE $empleadoTable SET $status='$estatusBaja' WHERE $cveEmpleado = '$id'";
                $resultado = mysqli_query($conexion, $update);
            }
            $msg .= "<h4 class = 'text-success text-center mt-4'>Registro modificado con exito</h4>";
        } if ($row > 0 && $name != "" && strcmp($estatus, $estatusBaja) == 0) {
            $update = "UPDATE $table SET $nombre='$name', $cvePerfil='$perfil', $lastname1='$aPaterno', $lastname2='$aMaterno', $address='$direccion', $phoneNumber='$telefono', $sex='$sexo', $status='$estatus', $maritalStatus='$estadoCivil', $birthDay='$fechaNacimiento', $cveExperiencia='$experiencia', $cveEscolaridad='$escolaridad', $idDocumentosBolsa='$idDocumentos', $observations='$observaciones', $admissionDate='$fechaIngreso', $cveNacionalidad='$nacionalidad' 
            WHERE $cveTabla = '$id'";
            $resultado = mysqli_query($conexion, $update);
            if($resultado){
                $update = "UPDATE $empleadoTable SET $status='$estatusAlta' WHERE $cveEmpleado = '$id'";
                $resultado = mysqli_query($conexion, $update);
            }
            $msg .= "<h4 class = 'text-success text-center mt-4'>Registro modificado con exito</h4>";
        } if ($row > 0 && $name != "" && strcmp($estatus, $estatusMuerto) == 0) {
            $update = "UPDATE $table SET $nombre='$name', $cvePerfil='$perfil', $lastname1='$aPaterno', $lastname2='$aMaterno', $address='$direccion', $phoneNumber='$telefono', $sex='$sexo', $status='$estatus', $maritalStatus='$estadoCivil', $birthDay='$fechaNacimiento', $cveExperiencia='$experiencia', $cveEscolaridad='$escolaridad', $idDocumentosBolsa='$idDocumentos', $observations='$observaciones', $admissionDate='$fechaIngreso', $cveNacionalidad='$nacionalidad' 
            WHERE $cveTabla = '$id'";
            $resultado = mysqli_query($conexion, $update);
            if($resultado){
                $update = "UPDATE $empleadoTable SET $nombre='$name', $lastname1='$aPaterno', $lastname2='$aMaterno', $address='$direccion', $phoneNumber='$telefono', $sex='$sexo', $status='$estatusAlta', $maritalStatus='$estadoCivil', $birthDay='$fechaNacimiento', $cvePuesto='$perfil', $cveCategoria='$perfil', $idCursoEmpleado='$perfil', $observations='$observaciones', $admissionDate='$fechaIngreso', $cveDepartamento='$perfil' 
                WHERE $cveEmpleado = '$id'";
                $resultado = mysqli_query($conexion, $update);
            }
            $msg .= "<h4 class = 'text-success text-center mt-4'>Registro modificado con exito</h4>";
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe registro a modificar.</h4>";
        }
    }
    ?>

    <!-- Inicio del HTML FORM -->
    <h1>Bolsa de Trabajo</h1>
    <h2>Mantenimientos Fuertes</h2>
    <h2>Mantenimiento de Bolsa.</h2>
    <form action="bolsa2.php" method="POST" name="form" id="form" class="row g-3">
        <div class="col-md-4">
            <label for="" class="form-label">Clave Empleado</label>
            <input type="text" name="id" id="id" class="form-control" value="<?php echo htmlspecialchars($idQuery); ?>">
        </div>
        <div class="col-md-8">
            <label for="inputPassword4" class="form-label">Nombre(s)</label>
            <input type="text" name="name" id="name" class="form-control" id="inputPassword4" value="<?php echo htmlspecialchars($nameQuery); ?>">
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label">Apellido Paterno</label>
            <input type="text" name="aPaterno" id="aPaterno" class="form-control" id="inputAddress" value="<?php echo htmlspecialchars($lastname1Query); ?>">
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label">Apellido Materno</label>
            <input type="text" name="aMaterno" id="aMaterno" class="form-control" id="inputAddress" value="<?php echo htmlspecialchars($lastname2Query); ?>">
        </div>
        <div class="col-md-4">
            <label for="inputCity" class="form-label">Estado Civil</label>
            <input type="text" name="estadoCivil" id="estadoCivil" class="form-control" id="inputCity" value="<?php echo htmlspecialchars($estadoCivilQuery); ?>">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Direccion</label>
            <input type="text" name="direccion" id="direccion" class="form-control" id="inputAddress2" placeholder="Apartamento, Estudio, o Piso" value="<?php echo htmlspecialchars($direccionQuery); ?>">
        </div>
        <div class="col-3">
            <label for="inputAddress" class="form-label">Telefono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" id="inputAddress" placeholder="Ej: 6864566546" value="<?php echo htmlspecialchars($telefonoQuery); ?>">
        </div>
        <div class="col-3">
            <label for="inputAddress" class="form-label">Sexo</label>
            <input type="text" name="sexo" id="sexo" class="form-control" id="inputAddress" placeholder="1234 Main St" placeholder="H/M" value="<?php echo htmlspecialchars($sexoQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Fecha Nacimiento</label>
            <input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control" id="inputCity" placeholder="AAAA-MM-DD" value="<?php echo htmlspecialchars($fechaNacimientoQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Estatus</label>
            <input type="text" name="estatus" id="estatus" class="form-control" id="inputCity" placeholder="Alta/Baja/Muerto" value="<?php echo htmlspecialchars($estatusQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Nacionalidad</label>
            <input onkeyup="buscarAhora($('#nacionalidad').val());" type="text" name="nacionalidad" id="nacionalidad" class="form-control" id="inputCity" value="<?php echo htmlspecialchars($nacionalidadQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Resultado</label>
            <p>
                <?php
                    echo $rowNacionalidad["nacionalidad"]; 
                ?>
            </p>
            <input type="text" name="nacionalidadResultado" id="nacionalidadResultado" class="form-control" id="inputCity" value="<?php echo $rowNacionalidad["nacionalidad"]; ?>">
        </div>
        <div class="col-md-3">
            <label for="inputZip" class="form-label">Escolaridad</label>
            <input type="text" name="escolaridad" id="escolaridad" class="form-control" id="inputZip" value="<?php echo htmlspecialchars($escolaridadQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputZip" class="form-label">Experiencia</label>
            <input type="text" name="experiencia" id="experiencia" class="form-control" id="inputZip" value="<?php echo htmlspecialchars($experienciaQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputZip" class="form-label">Perfil</label>
            <input type="text" name="perfil" id="perfil" class="form-control" id="inputZip" value="<?php echo htmlspecialchars($perfilQuery); ?>">
        </div>
        <div class="col-md-3">
            <label for="inputCity" class="form-label">Fecha Ingreso</label>
            <input type="text" name="fechaIngreso" id="fechaIngreso" class="form-control" id="inputCity" placeholder="AAAA-MM-DD" value="<?php echo htmlspecialchars($fechaIngresoQuery); ?>">
        </div>
        <div class="col-md-9">
            <label for="inputCity" class="form-label">Documentos</label>
            <input type="text" name="idDocumentos" id="idDocumentos" class="form-control" id="inputCity" value="<?php echo htmlspecialchars($idDocumentosQuery); ?>">
        </div>
        <div class="col-md-12">
            <label for="inputCity" class="form-label">Observaciones</label>
            <input type="text" name="observaciones" id="observaciones" class="form-control" id="inputCity" placeholder="..." value="<?php echo htmlspecialchars($observacionesQuery); ?>">
        </div>
        <div class="container-btn">
            <button class="btn btn-primary" type="submit" name="alta">Alta</button>
            <button class="btn btn-primary" type="submit" name="baja">Baja</button>
            <button class="btn btn-primary" type="submit" name="modificar">Modificar</button>
            <button class="btn btn-primary" type="submit" name="consulta">Consulta</button>
            <button class="btn btn-primary" type="submit" name="consultaCampos">Campos</button>
            <a href="index.html" class="btn btn-danger btn-lg" role="button">Salir</a>
        </div>
        <!-- msg son los mensajes de errores para la validacion -->
        <?php echo $msg; ?>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function buscarAhora(buscar){
            var parametros = {"nacionalidad":nacionalidad}
            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'buscardor.php',
                success: function(data) {
                    document.getElementById("nacionalidadResultado").innerHTML = data;
                }
            })
        }
    </script>
</body>
</html>