<?php
// realizar_transferencia.php

require_once 'db.php';
require_once 'usuario.php';

function obtener_usuario_por_nombre($nombre_usuario) {
    $conn = conectar_bd();
    $query = "SELECT id, saldo FROM usuarios WHERE nombre_usuario = $1";
    $result = pg_query_params($conn, $query, array($nombre_usuario));
    if ($result) {
        return pg_fetch_assoc($result);
    } else {
        echo "Error al obtener el usuario: " . pg_last_error($conn);
        return null;
    }
    pg_close($conn);
}

function actualizar_saldo($id_usuario, $monto) {
    $conn = conectar_bd();
    $query = "UPDATE usuarios SET saldo = saldo + $1 WHERE id = $2";
    $result = pg_query_params($conn, $query, array($monto, $id_usuario));
    if (!$result) {
        echo "Error al actualizar el saldo: " . pg_last_error($conn);
    }
    pg_close($conn);
}

function realizar_transferencia($nombre_usuario_remitente, $nombre_usuario_receptor, $monto) {
    $remitente = obtener_usuario_por_nombre($nombre_usuario_remitente);
    $receptor = obtener_usuario_por_nombre($nombre_usuario_receptor);

    if ($remitente == null || $receptor == null) {
        echo "El remitente o el receptor no existe.";
        return;
    }

    if ($remitente['saldo'] < $monto) {
        echo "Fondos insuficientes.";
        return;
    }

    actualizar_saldo($remitente['id'], -$monto);
    actualizar_saldo($receptor['id'], $monto);

    $conn = conectar_bd();
    $query = "INSERT INTO transferencias (id_remitente, id_receptor, monto) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($remitente['id'], $receptor['id'], $monto));
    if ($result) {
        echo "Transferencia completada exitosamente.";
    } else {
        echo "Error al realizar la transferencia: " . pg_last_error($conn);
    }
    pg_close($conn);
}
?>
