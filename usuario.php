<?php
// usuario.php
require_once 'db.php';

function registrar_usuario($nombre_usuario, $contrasena, $nombre_completo, $num_cedula, $saldo_inicial) {
    $conn = conectar_bd();
    $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);
    $query = "INSERT INTO usuarios (nombre_usuario, contrasena, nombre_completo, num_cedula, saldo) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $query, array($nombre_usuario, $contrasena_hash, $nombre_completo, $num_cedula, $saldo_inicial));
    if ($result) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario: " . pg_last_error($conn);
    }
    pg_close($conn);
}
?>
