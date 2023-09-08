<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

    <h1> Consulta todas las apis para bitacora </h1>
    <br><br>
    <div class="container mt-5">
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Inicio de Sesion</h2>
                        <h5 class="card-title">opcion='1"</h5>
                        <h5 class="card-title">correo="a@gmail.com"</h5>
                        <h5 class="card-title">clave="1234"</h5><br>
                        <form method="post" action="mostrar.php">
                            <input class="form-control mb-2" type="text" name="opcion" value="1">
                            <input class="form-control mb-2" type="text" name="correo" value="a@gmail.com">
                            <input class="form-control mb-2" type="text" name="clave" value="1234">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Consultar Actividades por usuario</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="2"</h5>
                            <h5 class="card-title">ID_usuario="2"</h5><br>
                            <input class="form-control mb-2" type="text" name="opcion" value="2">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="2">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Consultar todas las actividades</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="3"</h5>
                            <input class="form-control mb-2" type="text" name="opcion" value="3">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Insertar Actividad</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="4"</h5>
                            <h5 class="card-title">nombreActividad="Prueba de nombreActividad"</h5>
                            <h5 class="card-title">descripcionActividad="Prueba de descripcionActividad"</h5>
                            <h5 class="card-title">ID_usuario="2"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="4">
                            <input class="form-control mb-2" type="text" name="nombreActividad" value="Prueba de nombreActividad">
                            <input class="form-control mb-2" type="text" name="descripcionActividad" value="Prueba de descripcionActividad">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="2">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div> <br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Actualizar Estado de Actividad</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="5"</h5>
                            <h5 class="card-title">nuevoEstado="Pendiente"</h5>
                            <h5 class="card-title">ID_actividad="1"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="5">
                            <input class="form-control mb-2" type="text" name="nuevoEstado" value="Pendiente">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Agregar Nuevo Nombre de Actividad</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="6"</h5>
                            <h5 class="card-title">nuevoNombreActividad="Nueva Actividad"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="6">
                            <input class="form-control mb-2" type="text" name="nuevoNombreActividad" value="Nueva Actividad">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Editar Nombre de Actividad</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="7"</h5>
                            <h5 class="card-title">ID_nombre_actividad="1"</h5>
                            <h5 class="card-title">nuevoNombreActividad="Nuevo Nombre de Actividad"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="7">

                            <input class="form-control mb-2" type="text" name="ID_nombre_actividad" value="1">
                            <input class="form-control mb-2" type="text" name="nuevoNombreActividad" value="Nueva Actividad Actualizado">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Mandar Ubicacion</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="8"</h5>
                            <h5 class="card-title">ID_actividad="1"</h5>
                            <h5 class="card-title">ID_usuario="1"</h5>
                            <h5 class="card-title">longitud="18.141"</h5>
                            <h5 class="card-title">latitud="-97.141"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="8">

                            <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="1">
                            <input class="form-control mb-2" type="text" name="longitud" value="18.141">
                            <input class="form-control mb-2" type="text" name="latitud" value="-97.141">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Mandar foto de evidencia </h2>
                        <h5 class="card-title">opcion="9"</h5>
                        <h5 class="card-title">ID_actividad="2"</h5>
                        <h5 class="card-title">ID_usuario="1"</h5>
                        <h5 class="card-title">archivo="foto.png"</h5>

                        <form action="mostrar.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="opcion" value="9">
                            <input type="hidden" name="ID_usuario" value="1"> <!-- Cambia esto con el ID de usuario adecuado -->
                            <input type="hidden" name="ID_actividad" value="2"> <!-- Cambia esto con el ID de actividad adecuado -->

                            <label for="archivo">Selecciona una imagen:</label>
                            <input type="file" name="archivo" id="archivo">
                            <input type="submit" value="Subir Imagen">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>