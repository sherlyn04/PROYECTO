<?php
// registro.php
require_once 'usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $nombre_completo = $_POST['nombre_completo'];
    $num_cedula = $_POST['num_cedula'];
    $saldo_inicial = $_POST['saldo_inicial'];

    // Validar entradas
    if (empty($nombre_usuario) || empty($contrasena) || empty($nombre_completo) || empty($num_cedula) || empty($saldo_inicial)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Intentar registrar el usuario
        $resultado = registrar_usuario($nombre_usuario, $contrasena, $nombre_completo, $num_cedula, $saldo_inicial);
        if ($resultado) {
            echo "Usuario registrado correctamente.";
        } else {
            echo "-";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <section>
        <class="fondo">
            <form method="post" action="registro.php">
                <div class="login">
                    <h2>Registro de Usuario</h2> 
                    <div class="input-box">
                        <input type="nombre_usuario" placeholder="Nombre de Usuario" name="nombre_usuario">
                    </div>
                    <div class="input-box">
                        <input type="contrasena" placeholder="Contraseña" name="contrasena">
                    </div>
                    <div class="input-box">
                        <input type="nombre_completo" placeholder="Nombre completo" name="nombre_completo">
                    </div>
                    <div class="input-box">
                        <input type="num_cedula" placeholder="Número de cedula" name="num_cedula">
                    </div>
                    <div class="input-box">
                        <input type="saldo_inicial" placeholder="Valor" name="saldo_inicial">
                    </div>
                    <div class="input-box">
                        <input type="submit" value="Registrar">
                    </div>
                </div>               
            </form>
    
</body>
</html>
