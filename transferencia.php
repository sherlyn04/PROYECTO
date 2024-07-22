<?php
// transferencia.php
require_once 'realizar_transferencia.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario_remitente = $_POST['nombre_usuario_remitente'] ?? null;
    $nombre_usuario_receptor = $_POST['nombre_usuario_receptor'] ?? null;
    $monto = $_POST['monto'] ?? null;

    if ($nombre_usuario_remitente && $nombre_usuario_receptor && $monto) {
        $resultado = realizar_transferencia($nombre_usuario_remitente, $nombre_usuario_receptor, $monto);
        if ($resultado) {
            $mensaje = "Transferencia realizada con éxito.";
        } else {
            $mensaje = "El remitente o el receptor no existe.";
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Transferencia de Dinero</title>
    <link rel="stylesheet" href="transferencia.css">
</head>
<body>
    <section>
        <class="fondo">
            <form method="post" action="transferencia.php">
                <div class="login">
                    <h2>Transferencia</h2> 
                    <div class="input-box">
                        <input type="text" placeholder="Nombre del remitente" name="nombre_usuario_remitente" required>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Nombre del receptor" name="nombre_usuario_receptor" required>
                    </div>
                    <div class="input-box">
                        <input type="number" placeholder="Valor" name="monto" required>
                    </div>
                    <div class="input-box">
                            <input type="submit" value="Transferir">
                    </div>
                </div>               
            </form>
</body>
</html>
