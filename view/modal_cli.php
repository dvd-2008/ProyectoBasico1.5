<!-- modal_cli.php -->
<div class="modal fade" id="add_cli" tabindex="-1" role="dialog" aria-labelledby="agregarClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarClienteModalLabel">Agregar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar cliente -->
                    <form action="../controller/controller_cli.php?accion=agregarCliente" method="post">

                        <div class="form-group">
                            <label for="nombreCliente">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionCliente">Dirección</label>
                            <input type="text" class="form-control" id="direccionCliente" name="direccionCliente">
                        </div>
                        <div class="form-group">
                            <label for="telefonoCliente">Teléfono</label>
                            <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente">
                        </div>
                        <div class="form-group">
                            <label for="emailCliente">Correo electrónico</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente">
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php foreach ($clientes as $cliente): ?>
    <div class="modal fade" id="edit_cli_<?php echo $cliente['id_cliente']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarClienteLabel<?php echo $cliente['id_cliente']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarClienteLabel<?php echo $cliente['id_cliente']; ?>">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controller/controller_cli.php?accion=editarCliente" method="post">
                        <!-- Formulario para editar cliente -->
                        <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
                        <div class="form-group">
                            <label for="nombreCliente<?php echo $cliente['id_cliente']; ?>">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="nombreCliente<?php echo $cliente['id_cliente']; ?>" name="nombreCliente" value="<?php echo $cliente['nombre_cliente']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionCliente<?php echo $cliente['id_cliente']; ?>">Dirección</label>
                            <input type="text" class="form-control" id="direccionCliente<?php echo $cliente['id_cliente']; ?>" name="direccionCliente" value="<?php echo $cliente['direccion']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefonoCliente<?php echo $cliente['id_cliente']; ?>">Teléfono</label>
                            <input type="text" class="form-control" id="telefonoCliente<?php echo $cliente['id_cliente']; ?>" name="telefonoCliente" value="<?php echo $cliente['telefono']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="emailCliente<?php echo $cliente['id_cliente']; ?>">Correo electrónico</label>
                            <input type="email" class="form-control" id="emailCliente<?php echo $cliente['id_cliente']; ?>" name="emailCliente" value="<?php echo $cliente['email']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
