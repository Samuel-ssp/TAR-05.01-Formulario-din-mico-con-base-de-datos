<?php
    //Conecta con la base de datos
    include 'configdb.php';
    include 'conexion.php';

    //CONSULTA SQL	
    $sqlpaises = "SELECT * FROM paises_select;"; 
    $sqlintereses = "SELECT * FROM intereses_check;";

    //Ejecuta las consultas
    $resultado = $conexion->query($sqlpaises);
    $resultado2 = $conexion->query($sqlintereses);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estiloformulario.css">
    <title>Document</title>
</head>
<body>

    <section id="formulario">
        
        <fieldset>
            <legend><h2>Formulario</h2></legend>
            <form action="registroUsuario.php" method="post">

                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
                </div>
                <div>
                    <label for="email">
                    Email:
                    <input type="email" name="email" id="email" placeholder="@email.com">
                </label>
                </div>
                <div>
                    <!-- Checkbox -->
                    <label><u>Intereses:</u></label><br>
                    <?php
                        if($resultado2->num_rows > 0){
                            while($fila = $resultado2->fetch_assoc()){
                                echo '<input type="checkbox" name="intereses[]" value="'.$fila['idinteres'].'">';
                                echo '<label for="'.$fila['abreviatura'].'">'.$fila['contenido'].'</label><br>';
                            }
                        }
                    ?>
                </div>
                <div>
                    <!--  Checkbox 1 opcion-->
                    <p><u>Condiciones</u></p>
                    <input type="checkbox" name="condiciones" id="condiciones" value="Aceptadas" required>
                    <label for="condiciones">Acepto las condiciones</label>
                </div>
                <div>
                    <!-- Radio buttons -->
                    <label>Género:</label>
                    <input type="radio" name="genero" id="masculino" value="M" required>
                    <label for="masculino">Masculino</label>
                    <input type="radio" name="genero" id="femenino" value="F">
                    <label for="femenino">Femenino</label>
                    <input type="radio" name="genero" id="otro" value="O">
                    <label for="otro">Otro</label>
                </div>
                <div>
                    <!-- Select -->
                    <label for="pais">País:</label>
                    <?php
                        echo '<select name="pais" id="pais">';
                        if($resultado->num_rows > 0){
                            while($fila = $resultado->fetch_assoc()){
                                echo '<option value="'.$fila['idpais'].'">'.$fila['contenido'].'</option>';
                            }
                        }
                        echo "</select>";
                    ?>
                </div>
                <div>
                    <!--Date -->
                    <label for="nacimiento">Año de nacimiento</label>
                    <input type="date" name="nacimiento" id="nacimiento">
                </div>
                <button type="submit" id="enviar">Enviar</button>
                <button type="reset" id="limpiar">Limpiar</button>

        </form>
        </fieldset>
    </section>

    <?php
        //Cierra la conexión
        $conexion->close();
    ?>
    
</body>
</html>