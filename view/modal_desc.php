<!-- Modal para agregar descuento -->
<div class="modal fade" id="add_desc" tabindex="-1" role="dialog" aria-labelledby="agregarDescuentoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarDescuentoModalLabel">Agregar Descuento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar descuento -->
                <form action="../controller/controller_desc.php?accion=agregarDescuento" method="post">
                    <div class="form-group">
                        <label for="nombreDescuento">Nombre del Descuento</label>
                        <input type="text" class="form-control" id="nombreDescuento" name="nombreDescuento" required>
                    </div>
                    <div class="form-group">
                        <label for="porcentajeDescuento">Porcentaje</label>
                        <input type="number" class="form-control" id="porcentajeDescuento" name="porcentajeDescuento" min="0" max="100" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar descuento -->
<?php foreach ($descuentos as $descuento): ?>
    <div class="modal fade" id="edit_desc_<?php echo $descuento['id_descuento']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarDescuentoLabel<?php echo $descuento['id_descuento']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarDescuentoLabel<?php echo $descuento['id_descuento']; ?>">Editar Descuento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar descuento -->
                    <form action="../controller/controller_desc.php?accion=editarDescuento" method="post">
                        <input type="hidden" name="id" value="<?php echo $descuento['id_descuento']; ?>">
                        <div class="form-group">
                            <label for="nombreDescuento<?php echo $descuento['id_descuento']; ?>">Nombre del Descuento</label>
                            <input type="text" class="form-control" id="nombreDescuento<?php echo $descuento['id_descuento']; ?>" name="nombreDescuento" value="<?php echo $descuento['nombre_descuento']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="porcentajeDescuento<?php echo $descuento['id_descuento']; ?>">Porcentaje de Descuento</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="porcentajeDescuento<?php echo $descuento['id_descuento']; ?>" name="porcentajeDescuento" value="<?php echo $descuento['porcentaje_descuento']; ?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
