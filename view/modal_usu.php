<!-- Modal para agregar usuario -->
<div class="modal fade" id="add_usu" tabindex="-1" role="dialog" aria-labelledby="agregarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar usuario -->
                <form action="../controller/controller_usu.php?accion=agregarUsuario" method="post">
                    <div class="form-group">
                        <label for="nombreUsuario">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasenaUsuario">Contraseña</label>
                        <input type="password" class="form-control" id="contrasenaUsuario" name="contrasenaUsuario" required>
                    </div>
                    <div class="form-group">
                        <label for="correoUsuario">Correo electrónico</label>
                        <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->
<?php foreach ($usuarios as $usuario): ?>
    <div class="modal fade" id="edit_usu_<?php echo $usuario['id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel<?php echo $usuario['id_usuario']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarUsuarioLabel<?php echo $usuario['id_usuario']; ?>">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar usuario -->
                    <form action="../controller/controller_usu.php?accion=editarUsuario" method="post">
                        <input type="hidden" name="id" value="<?php echo $usuario['id_usuario']; ?>">
                        <div class="form-group">
                            <label for="nombreUsuario<?php echo $usuario['id_usuario']; ?>">Nombre del Usuario</label>
                            <input type="text" class="form-control" id="nombreUsuario<?php echo $usuario['id_usuario']; ?>" name="nombreUsuario" value="<?php echo $usuario['nombre_usuario']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasenaUsuario<?php echo $usuario['id_usuario']; ?>">Contraseña</label>
                            <input type="text" class="form-control" id="contrasenaUsuario<?php echo $usuario['id_usuario']; ?>" name="contrasenaUsuario" value="<?php echo $usuario['contrasena']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="correoUsuario<?php echo $usuario['id_usuario']; ?>">Correo electrónico</label>
                            <input type="email" class="form-control" id="correoUsuario<?php echo $usuario['id_usuario']; ?>" name="correoUsuario" value="<?php echo $usuario['correo_electronico']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
