<?php
    require_once __dir__."/../modelos/inputs.php";

    $inputs = new Input();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="vistas/estiloformulario.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION['error'])){
            echo '<div style="color: red">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);  // Borra  error
        }
    ?>
    <section id="formulario">
        
        <fieldset>
            <legend><h2>Formulario</h2></legend>
            <form action="index.php?accion=registrar" method="post">

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
                        foreach ($intereses as $interes){
                            echo '<label><input type="checkbox" name="intereses[]" value="'.$interes["idinteres"].'">'.$interes["contenido"].'</label><br>';
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
                    <select name="pais">
                    <?php 
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais["idpais"].'">'.$pais["contenido"].'</option>';
                        }
                    ?>
                    </select>
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
</body>
</html>