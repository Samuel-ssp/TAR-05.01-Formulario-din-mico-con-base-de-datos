<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .contenedor-formulario {
            width: 300px;
            margin: 80px auto;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
        }
        input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #3498db;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="contenedor-formulario">
        <h3>Iniciar Sesión</h3>
        <form action="index.php?c=Usuario&m=iniciarSesion" method="POST">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="pw" placeholder="Contraseña">
            <label><input type="radio" name="metodo" checked> Query</label>
            <label><input type="radio" name="metodo"> Prepare</label>
            <button type="submit">Entrar</button>
        </form>
        <a href="index.php?c=Usuario&m=mostrarRegistro">¿Quieres registrarte?</a>
    </div>
</body>
</html>