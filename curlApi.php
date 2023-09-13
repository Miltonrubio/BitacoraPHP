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
                            <h5 class="card-title">ID_nombre_actividad="1"</h5>
                            <h5 class="card-title">descripcionActividad="descripcion"</h5>
                            <h5 class="card-title">ID_usuario="2"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="4">
                            <input class="form-control mb-2" type="text" name="ID_nombre_actividad" value="1">
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
                        <h2 class="card-title">Eliminar Nombre de Actividad</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="12"</h5>
                            <h5 class="card-title">ID_nombre_actividad="8"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="12">
                            <input class="form-control mb-2" type="text" name="ID_nombre_actividad" value="8">
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
                        <h2 class="card-title">Mandar foto de evidencia</h2>
                        <h5 class="card-title">opcion="9"</h5>
                        <h5 class="card-title">ID_actividad="2"</h5>
                        <h5 class="card-title">ID_usuario="1"</h5>
                        <h5 class="card-title">archivo="foto.png"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">

                            <input class="form-control mb-2" type="text" name="opcion" value="9">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="2">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="1">

                            <label for="imagen">Seleccionar Imagen:</label>
                            <input class="form-control mb-2" type="file" id="imagen" name="imagen" accept="image/*" required>
                            <br>

                            <input class="btn btn-primary" type="submit" value="Subir Imagen y Datos">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Ver todas las fotos</h2>
                        <h5 class="card-title">opcion="10"</h5>
                        <h5 class="card-title">ID_actividad="1"</h5>
                        <form action="mostrar.php" method="POST">

                        <input class="form-control mb-2" type="text" name="opcion" value="10">
                        <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Ver todos los nombres de actividad</h2>
                        <h5 class="card-title">opcion="11"</h5>

                        <form action="mostrar.php" method="POST">

                            <input class="form-control mb-2" type="text" name="opcion" value="11">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Ver todos los usuarios</h2>
                        <h5 class="card-title">opcion="13"</h5>

                        <form action="mostrar.php" method="POST">

                            <input class="form-control mb-2" type="text" name="opcion" value="13">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Registrar Nuevo Usuario</h2>
                        <h5 class="card-title">opcion="14"</h5>
                        <h5 class="card-title">permisos="USUARIO"</h5>
                        <h5 class="card-title">nombre="Milton"</h5>
                        <h5 class="card-title">correo="milton@gmail.com"</h5>
                        <h5 class="card-title">clave="123456"</h5>
                        <h5 class="card-title">telefono="238131121"</h5>

                        <form action="mostrar.php" method="POST">
                            <input class="form-control mb-2" type="text" name="opcion" value="14">
                            <select class="form-select mb-2" aria-label="Selecciona una opción" name="permisos">
                                <option selected value="SUPERADMIN">SUPERADMIN</option>
                                <option value="USUARIO">USUARIO</option>
                            </select>

                            <input class="form-control mb-2" type="text" name="nombre" value="Milton Rubio">

                            <input class="form-control mb-2" type="text" name="correo" value="milton@gmail.com">

                            <input class="form-control mb-2" type="text" name="clave" value="123456">

                            <input class="form-control mb-2" type="text" name="telefono" value="2382115594">

                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>  
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Editar Usuario</h2>
                        <h5 class="card-title">opcion="15"</h5>

                        <form action="mostrar.php" method="POST">

                            <input class="form-control mb-2" type="text" name="opcion" value="15">


                            <select class="form-select mb-2" aria-label="Selecciona una opción" name="permisos">

                                <option selected value="SUPERADMIN">SUPERADMIN</option>
                                <option value="USUARIO">USUARIO</option>
                            </select>

                            <input class="form-control mb-2" type="text" name="nombre" value="Milton Rubio">

                            <input class="form-control mb-2" type="text" name="correo" value="milton@gmail.com">

                            <input class="form-control mb-2" type="text" name="clave" value="123456">

                            <input class="form-control mb-2" type="text" name="telefono" value="2382115594">

                            <input class="form-control mb-2" type="text" name="ID_usuario" value="5">


                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Eliminar Usuario</h2>
                        <h5 class="card-title">opcion="16"</h5>
                        <h5 class="card-title">ID_usuario="6"</h5>
                        <form action="mostrar.php" method="POST">
                            <input class="form-control mb-2" type="text" name="opcion" value="16">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="6">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Editar Actividad</h2>
                        <h5 class="card-title">opcion="17"</h5>
                        <h5 class="card-title">ID_nombre_actividad="17"</h5>
                        <h5 class="card-title">descripcionActividad="Nueva Descripcion"</h5>
                        <h5 class="card-title">ID_actividad="1"</h5>
                        <form action="mostrar.php" method="POST">
                            <input class="form-control mb-2" type="text" name="opcion" value="17">
                            <input class="form-control mb-2" type="text" name="ID_nombre_actividad" value="1">
                            <input class="form-control mb-2" type="text" name="descripcionActividad" value="Nueva Descripcion Actualizada">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Eliminar Actividad</h2>
                        <h5 class="card-title">opcion="18"</h5>
                        <h5 class="card-title">ID_actividad="1"</h5>
                        <form action="mostrar.php" method="POST">
                            <input class="form-control mb-2" type="text" name="opcion" value="18">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Mostrar ubicaciones</h2>
                        <h5 class="card-title">opcion="19"</h5>
                        <h5 class="card-title">ID_actividad="1"</h5>
                        <form action="mostrar.php" method="POST">
                            <input class="form-control mb-2" type="text" name="opcion" value="19">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
    </div>
</body>

</html>