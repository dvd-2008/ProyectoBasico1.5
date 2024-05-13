<!-- Modal para agregar proveedor -->
<div class="modal fade" id="add_prov" tabindex="-1" role="dialog" aria-labelledby="agregarProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarProveedorModalLabel">Agregar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar proveedor -->
                <form action="../controller/controller_prov.php?accion=agregarProveedor" method="post">
                    <div class="form-group">
                        <label for="nombreProveedor">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="nombreProveedor" name="nombreProveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="direccionProveedor">Dirección</label>
                        <input type="text" class="form-control" id="direccionProveedor" name="direccionProveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="telefonoProveedor">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoProveedor" name="telefonoProveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="emailProveedor">Correo electrónico</label>
                        <input type="email" class="form-control" id="emailProveedor" name="emailProveedor" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar proveedor -->
<?php foreach ($proveedores as $proveedor): ?>
    <div class="modal fade" id="edit_prov_<?php echo $proveedor['id_prov']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarProveedorLabel<?php echo $proveedor['id_prov']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarProveedorLabel<?php echo $proveedor['id_prov']; ?>">Editar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar proveedor -->
                    <form action="../controller/controller_prov.php?accion=editarProveedor" method="post">
                        <input type="hidden" name="id" value="<?php echo $proveedor['id_prov']; ?>">
                        <div class="form-group">
                            <label for="nombreProveedor<?php echo $proveedor['id_prov']; ?>">Nombre del Proveedor</label>
                            <input type="text" class="form-control" id="nombreProveedor<?php echo $proveedor['id_prov']; ?>" name="nombreProveedor" value="<?php echo $proveedor['nombre_prov']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionProveedor<?php echo $proveedor['id_prov']; ?>">Dirección</label>
                            <input type="text" class="form-control" id="direccionProveedor<?php echo $proveedor['id_prov']; ?>" name="direccionProveedor" value="<?php echo $proveedor['direccion']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefonoProveedor<?php echo $proveedor['id_prov']; ?>">Teléfono</label>
                            <input type="text" class="form-control" id="telefonoProveedor<?php echo $proveedor['id_prov']; ?>" name="telefonoProveedor" value="<?php echo $proveedor['telefono']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="emailProveedor<?php echo $proveedor['id_prov']; ?>">Correo electrónico</label>
                            <input type="email" class="form-control" id="emailProveedor<?php echo $proveedor['id_prov']; ?>" name="emailProveedor" value="<?php echo $proveedor['email']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
