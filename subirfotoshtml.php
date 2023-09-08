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
        <label for="descripcion">Descripción de la imagen:</label>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50"></textarea>
        <br>
        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>