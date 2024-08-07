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
                            <h5 class="card-title">nuevoEstado="Iniciado"</h5>
                            <h5 class="card-title">ID_actividad="1"</h5>
                            <input class="form-control mb-2" type="text" name="opcion" value="5">
                            <input class="form-control mb-2" type="text" name="nuevoEstado" value="Iniciado">
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
                        <h2 class="card-title">Cancelar de Actividad</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="29"</h5>
                            <h5 class="card-title">nuevoEstado="Cancelado"</h5>
                            <h5 class="card-title">ID_actividad="25"</h5>
                            <h5 class="card-title">motivocancelacion="Tuve problemas para realizar esta actividad"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="29">
                            <input class="form-control mb-2" type="text" name="nuevoEstado" value="Cancelado">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="25">
                            <input class="form-control mb-2" type="text" name="motivocancelacion" value="Tuve problemas para realizar esta actividad">
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
                            <h5 class="card-title">tipo_actividad="GENERAL/OFICINAS"</h5>

                            <input class="form-control mb-2" type="text" name="opcion" value="6">
                            <input class="form-control mb-2" type="text" name="nuevoNombreActividad" value="Nueva Actividad">
                            <input class="form-control mb-2" type="text" name="tipo_actividad" value="GENERAL">
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
                            <h5 class="card-title">nuevoTipoActividad="GENERAL/OFICINAS"</h5>
                            <input class="form-control mb-2" type="text" name="opcion" value="7">
                            <input class="form-control mb-2" type="text" name="ID_nombre_actividad" value="1">
                            <input class="form-control mb-2" type="text" name="nuevoNombreActividad" value="Nueva Actividad Actualizado">
                            <input class="form-control mb-2" type="text" name="nuevoTipoActividad" value="GENERAL">
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
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Editar Foto de Usuario</h2>
                        <h5 class="card-title">opcion="25"</h5>
                        <h5 class="card-title">imagen23="foto"</h5>
                        <h5 class="card-title">ID_usuario="1"</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="25">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="1">
                            <input class="form-control mb-2" type="file" name="imagen23">
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
                        <h2 class="card-title">VER ACTIVIDADES PARA OFICINA</h2>
                        <h5 class="card-title">opcion="26"</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="26">
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
                        <h2 class="card-title">MANDAR NOTIFICACIONES</h2>
                        <h5 class="card-title">opcion="27"</h5>
                        <h5 class="card-title">TokenFIREBASE="edm8qIrqTy-pHw7bAXuVrU:APA91bHmyJqdNgsAf-DfrXGfHwqej_hafeobD2MFdPouYkYGAR4JR24BINfNuUuYA_7x4p8lpo757okuVeMI1YlR-UiM3NBV5zWjgYj7M2644wNhxIsW1iY1v618DrsvzFSeCyPnv-9p"</h5>
                        <h5 class="card-title">TituloMensaje="Titulo del mensaje"</h5>
                        <h5 class="card-title">CuerpoMensaje="Cuerpo del mensaje"</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="27">
                            <input class="form-control mb-2" type="text" name="TokenFIREBASE" value="edm8qIrqTy-pHw7bAXuVrU:APA91bHmyJqdNgsAf-DfrXGfHwqej_hafeobD2MFdPouYkYGAR4JR24BINfNuUuYA_7x4p8lpo757okuVeMI1YlR-UiM3NBV5zWjgYj7M2644wNhxIsW1iY1v618DrsvzFSeCyPnv-9p">
                            <input class="form-control mb-2" type="text" name="TituloMensaje" value="Titulo del mensaje">
                            <input class="form-control mb-2" type="text" name="CuerpoMensaje" value="Cuerpo del mensaje">
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
                        <h2 class="card-title">ACTUALIZAR TOKEN DE USUARIO</h2>
                        <h5 class="card-title">opcion="28"</h5>
                        <h5 class="card-title">TokenFIREBASE="edm8qIrqTy-pHw7bAXuVrU:APA91bHmyJqdNgsAf-DfrXGfHwqej_hafeobD2MFdPouYkYGAR4JR24BINfNuUuYA_7x4p8lpo757okuVeMI1YlR-UiM3NBV5zWjgYj7M2644wNhxIsW1iY1v618DrsvzFSeCyPnv-9p"</h5>
                        <h5 class="card-title">ID_usuario="13"</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="28">
                            <input class="form-control mb-2" type="text" name="TokenFIREBASE" value="edm8qIrqTy-pHw7bAXuVrU:APA91bHmyJqdNgsAf-DfrXGfHwqej_hafeobD2MFdPouYkYGAR4JR24BINfNuUuYA_7x4p8lpo757okuVeMI1YlR-UiM3NBV5zWjgYj7M2644wNhxIsW1iY1v618DrsvzFSeCyPnv-9p">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="13">
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
                        <h2 class="card-title">ASIGNAR SALDO A USUARIO</h2>
                        <h5 class="card-title">opcion="51"</h5>
                        <h5 class="card-title">ID_usuario="13"</h5>
                        <h5 class="card-title">saldo_asignado="13"</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="51">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="13">
                            <input class="form-control mb-2" type="text" name="saldo_asignado" value="5000">
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
                        <h2 class="card-title">CONSULTAR SALDO ACTUAL DE USUARIO</h2>
                        <h5 class="card-title">opcion="52"</h5>
                        <h5 class="card-title">ID_usuario="13"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="52">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="13">
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
                        <h2 class="card-title">ASIGNAR GASTO A UNA ACTIVIDAD</h2>
                        <h5 class="card-title">opcion="53"</h5>
                        <h5 class="card-title">total_gastado=500.0</h5>
                        <h5 class="card-title">ID_saldo=1</h5>
                        <h5 class="card-title">ID_actividad=1</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="53">
                            <input class="form-control mb-2" type="text" name="total_gastado" value="500.0">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="1">
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
                        <h2 class="card-title">CONSULTAR SALDO RESTANTE</h2>
                        <h5 class="card-title">opcion="54"</h5>
                        <h5 class="card-title">ID_saldo=1</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="54">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="1">
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
                        <h2 class="card-title">CORREGIR SALDO</h2>
                        <h5 class="card-title">opcion="55"</h5>
                        <h5 class="card-title">ID_saldo=1</h5>
                        <h5 class="card-title">nuevoSaldo=5500</h5>
                        <h5 class="card-title">NuevaCaja=Capital/Gastos/Prueba</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="55">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="1">
                            <input class="form-control mb-2" type="text" name="nuevoSaldo" value="5500">
                            <input class="form-control mb-2" type="text" name="NuevaCaja" value="Capital">
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
                        <h2 class="card-title">FINALIZAR SALDO</h2>
                        <h5 class="card-title">opcion="56"</h5>
                        <h5 class="card-title">ID_saldo=1</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="56">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="1">
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
                        <h2 class="card-title">CONSULTAR TODOS LOS SALDOS POR USUARIO</h2>
                        <h5 class="card-title">opcion="57"</h5>
                        <h5 class="card-title">ID_usuario=45</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="57">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
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
                        <h2 class="card-title">CONSULTAR TODOS LOS SALDOS POR USUARIO POR RANGO DE FECHA</h2>
                        <h5 class="card-title">opcion="58"</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                        <h5 class="card-title">fechaInicio</h5>
                        <h5 class="card-title">fechaFin</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="58">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="date" name="fechaInicio">
                            <input class="form-control mb-2" type="date" name="fechaFin">
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
                        <h2 class="card-title">GENERAR PDF DE SALDOS DE USUARIO POR RANGO DE FECHA </h2>
                        <h5 class="card-title">opcion="59"</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                        <h5 class="card-title">fechaInicio</h5>
                        <h5 class="card-title">fechaFin</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="59">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="date" name="fechaInicio">
                            <input class="form-control mb-2" type="date" name="fechaFin">
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
                        <h2 class="card-title">DEPOSITAR POR ID_SALDO ACTUAL </h2>
                        <h5 class="card-title">opcion="60"</h5>
                        <h5 class="card-title">ID_saldo=7</h5>
                        <h5 class="card-title">deposito=450</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="60">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="7">
                            <input class="form-control mb-2" type="text" name="deposito" value="450">
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
                        <h2 class="card-title">REPORTE DE ACTIVIDADES POR USUARIO</h2>
                        <h5 class="card-title">opcion="61"</h5>
                        <h5 class="card-title">ID_usuario=42</h5>
                        <h5 class="card-title">rango=hoy/semana/mes/anio</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="61">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="text" name="rango" value="semana">
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
                        <h2 class="card-title">ASIGNAR SALDO A USUARIO CON TIPO DE CAJA</h2>
                        <h5 class="card-title">opcion="62"</h5>
                        <h5 class="card-title">ID_usuario="13"</h5>
                        <h5 class="card-title">saldo_asignado="13"</h5>
                        <h5 class="card-title">tipo_caja="gastos/capital/prueba"</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="62">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="13">
                            <input class="form-control mb-2" type="text" name="tipo_caja" value="prueba">
                            <input class="form-control mb-2" type="text" name="saldo_asignado" value="5000">
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
                        <h2 class="card-title">ASIGNAR GASTO CON CAJA A UNA ACTIVIDAD</h2>
                        <h5 class="card-title">opcion="63"</h5>
                        <h5 class="card-title">total_gastado=500.0</h5>
                        <h5 class="card-title">ID_saldo=1</h5>
                        <h5 class="card-title">ID_actividad=1</h5>
                        <h5 class="card-title">tipo_caja="gastos/capital/prueba"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="63">
                            <input class="form-control mb-2" type="text" name="total_gastado" value="500.0">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="1">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="1">
                            <input class="form-control mb-2" type="text" name="tipo_caja" value="Gastos">
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
                        <h2 class="card-title">DEPOSITAR MAS SALDO A UN USUARIO POR ID_SALDO </h2>
                        <h5 class="card-title">opcion="64"</h5>
                        <h5 class="card-title">ID_saldo=7</h5>
                        <h5 class="card-title">deposito=450</h5>
                        <h5 class="card-title">ID_admin_asig=42</h5>
                        
                        <h5 class="card-title">tipo_caja="gastos/capital/prueba"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="64">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="7">
                            <input class="form-control mb-2" type="text" name="deposito" value="450">
                            <input class="form-control mb-2" type="text" name="ID_admin_asig" value="42">
                            <input class="form-control mb-2" type="text" name="tipo_caja" value="Gastos">
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
                        <h2 class="card-title">Consultar Saldo restante con separacion por ID_usuario </h2>
                        <h5 class="card-title">opcion="65"</h5>
                        <h5 class="card-title">ID_usuario=45</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="65">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
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
                        <h2 class="card-title">GENERAR PDF DE SALDOS DE USUARIO POR SELECCION </h2>
                        <h5 class="card-title">opcion="66"</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                        <h5 class="card-title">listaSeleccion=</h5>
                        <?php
                        // Ejemplo de array a enviar
                        $listaSeleccion = array('12', '10');
                        ?>
                        <form action="disenioPDF.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="66">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input type="text" name="listaSeleccion" value='<?php echo json_encode($listaSeleccion); ?>'>
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
                        <h2 class="card-title">Mandar archivos de evidencia</h2>
                        <h5 class="card-title">opcion="66"</h5>
                        <h5 class="card-title">ID_actividad="27"</h5>
                        <h5 class="card-title">ID_usuario="45"</h5>
                        <h5 class="card-title">archivo="foto.png"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">

                            <input class="form-control mb-2" type="text" name="opcion" value="66">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="27">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">

                            <label for="imagen">Seleccionar archivo:</label>
                            <input class="form-control mb-2" type="file" id="archivo" name="archivo" required>
                            <br>

                            <input class="btn btn-primary" type="submit" value="Subir archivo y Datos">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>



        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Consultar archivos por actividad</h2>
                        <h5 class="card-title">opcion="67"</h5>
                        <h5 class="card-title">ID_actividad="27"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">

                            <input class="form-control mb-2" type="text" name="opcion" value="67">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="27">

                            <input class="btn btn-primary" type="submit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>


        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Eliminar archivos de la actividad </h2>
                        <h5 class="card-title">opcion="68"</h5>
                        <h5 class="card-title">ID_archivo="1"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">

                            <input class="form-control mb-2" type="text" name="opcion" value="68">
                            <input class="form-control mb-2" type="text" name="ID_archivo" value="1">
                            <input class="btn btn-primary" type="submit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>


        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Actualizar nombre del archivo </h2>
                        <h5 class="card-title">opcion="69"</h5>
                        <h5 class="card-title">nuevoNombreArchivo="PDF DE Gastos"</h5>
                        <h5 class="card-title">ID_archivo="1"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">

                            <input class="form-control mb-2" type="text" name="opcion" value="69">
                            <input class="form-control mb-2" type="text" name="ID_archivo" value="1">
                            <input class="form-control mb-2" type="text" name="nuevoNombreArchivo" value="PDF DE Gastos">
                            <input class="btn btn-primary" type="submit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>



        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Consultar Ultimo saldo activo</h2>
                        <h5 class="card-title">opcion="70"</h5>
                        <h5 class="card-title">ID_usuario="45"</h5>

                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">

                            <input class="form-control mb-2" type="text" name="opcion" value="70">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="btn btn-primary" type="submit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>


        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Asignar Actividad a Usuario</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="71"</h5>
                            <h5 class="card-title">ID_nombre_actividad="45"</h5>
                            <h5 class="card-title">descripcionActividad="descripcion"</h5>
                            <h5 class="card-title">ID_usuario="2"</h5>
                            <h5 class="card-title">ID_usuario="ID_admin_asig"</h5>

                            

                            <input class="form-control mb-2" type="text" name="opcion" value="71">
                            <input class="form-control mb-2" type="text" name="ID_nombre_actividad" value="45">
                            <input class="form-control mb-2" type="text" name="descripcionActividad" value="Prueba de descripcionActividad">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="13">
                            <input class="form-control mb-2" type="text" name="ID_admin_asig" value="42">
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
                        <h2 class="card-title">Consultar Actividades por usuario solo de hoy</h2>
                        <form method="post" action="mostrar.php">
                            <h5 class="card-title">opcion="72"</h5>
                            <h5 class="card-title">ID_usuario="45"</h5><br>
                            <input class="form-control mb-2" type="text" name="opcion" value="72">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
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
                        <h2 class="card-title">GENERAR TICKET DE SALDOS DE USUARIO POR SELECCION </h2>
                        <h5 class="card-title">ID_usuario=45 - Usuario mandadero </h5>
                        <h5 class="card-title">ID_encargado=42 - Administrador que imprimio el ticket</h5>
                        <h5 class="card-title">listaSeleccion=</h5>
                        <?php
                        // Ejemplo de array a enviar
                        $listaSeleccion = array('10', '12');
                        ?>
                        <form action="ticket.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="text" name="ID_encargado" value="42">
                            <input type="text" name="listaSeleccion" value='<?php echo json_encode($listaSeleccion); ?>'>
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
                        <h2 class="card-title">GENERAR TICKET ANTERIOR DISEÑO DE SALDOS DE USUARIO POR SELECCION </h2>
                        <h5 class="card-title">ID_usuario=45 - Usuario mandadero </h5>
                        <h5 class="card-title">ID_encargado=42 - Administrador que imprimio el ticket</h5>
                        <h5 class="card-title">listaSeleccion=</h5>
                        <?php
                        // Ejemplo de array a enviar
                        $listaSeleccion = array('13', '8');
                        ?>
                        <form action="ticketRespaldo.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="text" name="ID_encargado" value="42">
                            <input type="text" name="listaSeleccion" value='<?php echo json_encode($listaSeleccion); ?>'>
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
                        <h2 class="card-title">Nuevo Registro De Saldo  </h2>
                        <h5 class="card-title">opcion=73</h5>
                        <h5 class="card-title">ID_admin_asig=42</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                        <h5 class="card-title">nuevoSaldoAsignado=1900</h5>
                        <h5 class="card-title">nuevoTipoCaja="Gastos/Capital/Prueba"</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="73">
                            <input class="form-control mb-2" type="text" name="ID_admin_asig" value="42">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="text" name="nuevoSaldoAsignado" value="1900">
                            <input class="form-control mb-2" type="text" name="nuevoTipoCaja" value="Gastos">
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
                        <h2 class="card-title">Finalizar Ambos Saldos</h2>
                        <h5 class="card-title">opcion=74</h5>
                        <h5 class="card-title">ID_registro_saldo=1</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="74">
                            <input class="form-control mb-2" type="text" name="ID_registro_saldo" value="1">
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
                        <h2 class="card-title">Finalizar Un Saldo por tipo de caja</h2>
                        <h5 class="card-title">opcion=75</h5>
                        <h5 class="card-title">ID_registro_saldo=1</h5>
                        <h5 class="card-title">nuevoTipoCaja=Gastos/Capital</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="75">
                            <input class="form-control mb-2" type="text" name="ID_registro_saldo" value="1">
                            <input class="form-control mb-2" type="text" name="nuevoTipoCaja" value="Capital">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>

<!--

                            <input class="form-control mb-2" type="text" name="" value="Gastos">
-->


<div class="row col-md-12">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Agregar saldo de otra caja </h2>
                        <h5 class="card-title">opcion=76</h5>
                        <h5 class="card-title">ID_admin_asig=42</h5>
                        <h5 class="card-title">ID_registro_saldo=6</h5>
                        <h5 class="card-title">nuevoSaldoAsignado=1900</h5>
                        <h5 class="card-title">nuevoTipoCaja="Gastos/Capital/Prueba"</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="76">
                            <input class="form-control mb-2" type="text" name="ID_admin_asig" value="42">
                            <input class="form-control mb-2" type="text" name="ID_registro_saldo" value="6">
                            <input class="form-control mb-2" type="text" name="nuevoSaldoAsignado" value="1900">
                            <input class="form-control mb-2" type="text" name="nuevoTipoCaja" value="Gastos">
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
                        <h2 class="card-title">Mostrar saldo activo por usuario</h2>
                        <h5 class="card-title">opcion=77</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="77">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
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
                        <h2 class="card-title">Agregar mas dinero a registro de saldo</h2>
                        <h5 class="card-title">opcion=78</h5>
                        <h5 class="card-title">saldoAgregado=500</h5>
                        <h5 class="card-title">ID_saldo=10</h5>
                        <h5 class="card-title">ID_admin_asig=42</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="78">
                            <input class="form-control mb-2" type="text" name="saldoAgregado" value="500">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="10">
                            <input class="form-control mb-2" type="text" name="ID_admin_asig" value="42">
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
                        <h2 class="card-title">Asignar Gasto a una actividad en tabla nuevo_saldo</h2>
                        <h5 class="card-title">opcion=79</h5>
                        <h5 class="card-title">dinero_gastado=500</h5>
                        <h5 class="card-title">ID_saldo=10</h5>
                        <h5 class="card-title">ID_actividad=42</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="79">
                            <input class="form-control mb-2" type="text" name="dinero_gastado" value="500">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="10">
                            <input class="form-control mb-2" type="text" name="ID_actividad" value="42">
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
                        <h2 class="card-title">Mostrar todos los saldos de usuario</h2>
                        <h5 class="card-title">opcion=80</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="80">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
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
                        <h2 class="card-title">Mostrar el desglose por id_saldo</h2>
                        <h5 class="card-title">opcion=81</h5>
                        <h5 class="card-title">ID_saldo=10</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="81">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="10">
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
                        <h2 class="card-title">Mostrar todos los usuarios y su saldo</h2>
                        <h5 class="card-title">opcion=82</h5>
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="82">
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
                        <h2 class="card-title">Mostrar todos los saldos de usuario</h2>
                        <h5 class="card-title">opcion=83</h5>
                        <h5 class="card-title">ID_usuario=45</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="83">
                            <input class="form-control mb-2" type="text" name="ID_usuario" value="45">
                            <input class="form-control mb-2" type="date" name="fecha_inicioBusqueda" value="">
                            <input class="form-control mb-2" type="date" name="fecha_finBusqueda" value="">
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
                        <h2 class="card-title">Corregir Saldo Asignado</h2>
                        <h5 class="card-title">opcion=84</h5>
                        <h5 class="card-title">ID_saldo=10</h5>
                        <h5 class="card-title">montoCorregido=1500</h5>
                   
                        <form action="mostrar.php" method="POST" enctype="multipart/form-data">
                            <input class="form-control mb-2" type="text" name="opcion" value="84">
                            <input class="form-control mb-2" type="text" name="ID_saldo" value="10">
                            <input class="form-control mb-2" type="text" name="montoCorregido" value="1500">
                            <input class="btn btn-primary" type="submit" value="Consultar">
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>



    </div>

</body>

</html>