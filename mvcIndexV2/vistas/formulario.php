<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="vistas/estiloformulario.css">
    <title>Registro</title>
</head>
<body>
    <?php
        if(isset($_SESSION['error'])){
            echo '<div style="color: red">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);  
        }
    ?>
    <section id="formulario">
        
        <fieldset>
            <legend><h2>Formulario de Registro</h2></legend>
            <form action="index.php?&m=registrar" method="post">

                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input type="text" name="pw" id="pw" placeholder="Ingrese su contraseña" required>
                </div>

                <div>
                    <label for="pais">País:</label>
                    <select name="pais" id="pais" required>
                        <option value="">Seleccione un país</option>
                    <?php 
                        foreach ($datos as $pais) {
                            echo '<option value="'.$pais["idpais"].'">'.$pais["nombre"].'</option>';
                        }
                    ?>
                    </select>
                </div>

                <button type="submit" id="enviar">Registrar</button>
                <button type="reset" id="limpiar">Limpiar</button>

            </form>
            <a href="index.php">Volver</a>
        </fieldset>
    </section>  
</body>
</html>