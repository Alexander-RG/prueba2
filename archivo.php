<?php
include("cabecera.php");
?>
<div>
    <main>
        <h2>Archivo</h2>
        <form action="archivo.php" method="POST" enctype="multipart/form-data">
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>
            <br>
            <label for="archivo">Archivo:</label>
            <input type="file" name="archivo" id="archivo">
            <br>
            <br>
            <input type="submit" name="subir" value="Subir Archivo">
        </form>

        <?php
        session_start();

        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES["archivo"])) {
                $file_extension = strtolower(pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION));

                if ($file_extension == "pdf" && $_FILES["archivo"]["size"] <= 2000000) 
                {
                    $_SESSION["nombre_archivo"] = $_FILES["archivo"]["name"];
                    
                    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";

                    $archivoInfo = array(
                        "nombre" => $_FILES["archivo"]["name"],
                        "descripcion" => $descripcion,
                        "tipo" => $_FILES["archivo"]["type"],
                        "tamaño" => $_FILES["archivo"]["size"]
                    );
                    
                    setcookie("archivo_cookie", serialize($archivoInfo), time() + 36000);

                    echo "El archivo " . htmlspecialchars($archivoInfo["nombre"]) . " se ha subido correctamente.";
                    print("<break>");
                    print("<break>");
                    echo "<pre>";
                    print_r($archivoInfo);
                    echo "</pre>";
                } else {
                    echo "El archivo debe ser un PDF y su tamano no debe exceder los 2MB.";
                    print("<break>");
                }
            }
        }
        

        if (isset($_SESSION["nombre_archivo"])) 
        {
            echo '<div style="float: right;">Nombre del archivo almacenado en la sesión: ' . $_SESSION["nombre_archivo"] . '</div>';
        }
        ?>
    </main>
</div>
<footer>Examen #2 Alexander Ruiz Gareca</footer>
