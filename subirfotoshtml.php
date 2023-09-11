<!DOCTYPE html>
<html>
<head>
    <title>Subir Imagen</title>
</head>
<body>
    <h1>Subir Imagen</h1>
    <form action="subirfotos.php" method="POST" enctype="multipart/form-data">
        <label for="imagen">Selecciona una imagen:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">
        <br>
        <label for="opcion">Opcion:</label>
        <input type="text" name="opcion" id="opcion" value="9">
        <br>
        <label for="ID_usuario">ID_actividad:</label>
        <input type="text" name="ID_actividad" id="ID_actividad" value="1" required>
        <br><br>
        <label for="ID_usuario">ID_usuario:</label>
        <input type="text" name="ID_usuario" id="ID_usuario" value="1" required>
        <br><br>

        <label for="descripcion">Descripción de la imagen:</label>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50"></textarea>
        <br>
        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>