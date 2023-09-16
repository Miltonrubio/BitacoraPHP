<!DOCTYPE html>
<html>

<head>
</head>
<style>
    /* Agregar estilos personalizados aquí */
    .custom-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<body>

    <h1> Subir foto </h1>
    <br><br>
    <div class="container mt-5">
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Inicio de Sesion</h2>
                        <h5 class="card-title">fotoImagen="file"</h5>
                        <h5 class="card-title">nombreFoto="nombreDeFoto"</h5><br>
                        <form method="POST" action="mostrar2.php">
                            <input class="form-control mb-2" type="text" name="opcion" value="9">
                            <input class="form-control mb-2" type="text" name="nombreFoto" value="NombreDeFoto">
                            <input class="form-control mb-2" type="file" name="fotoImagen">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <br><br>
</body>