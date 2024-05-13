<!-- Modal para agregar impuesto -->
<div class="modal fade" id="add_imp" tabindex="-1" role="dialog" aria-labelledby="agregarImpuestoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarImpuestoModalLabel">Agregar Impuesto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar impuesto -->
                <form action="../controller/controller_imp.php?accion=agregarImpuesto" method="post">
                    <div class="form-group">
                        <label for="nombreImpuesto">Nombre del Impuesto</label>
                        <input type="text" class="form-control" id="nombreImpuesto" name="nombreImpuesto" required>
                    </div>
                    <div class="form-group">
                        <label for="porcentajeImpuesto">Porcentaje</label>
                        <input type="number" class="form-control" id="porcentajeImpuesto" name="porcentajeImpuesto" min="0" max="100" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar impuesto -->
<?php foreach ($impuestos as $impuesto): ?>
    <div class="modal fade" id="edit_imp_<?php echo $impuesto['id_impuesto']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarImpuestoLabel<?php echo $impuesto['id_impuesto']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarImpuestoLabel<?php echo $impuesto['id_impuesto']; ?>">Editar Impuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar impuesto -->
                    <form action="../controller/controller_imp.php?accion=editarImpuesto" method="post">
                        <input type="hidden" name="id" value="<?php echo $impuesto['id_impuesto']; ?>">
                        <div class="form-group">
                            <label for="nombreImpuesto<?php echo $impuesto['id_impuesto']; ?>">Nombre del Impuesto</label>
                            <input type="text" class="form-control" id="nombreImpuesto<?php echo $impuesto['id_impuesto']; ?>" name="nombreImpuesto" value="<?php echo $impuesto['nombre_impuesto']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="porcentajeImpuesto<?php echo $impuesto['id_impuesto']; ?>">Porcentaje de Impuesto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="porcentajeImpuesto<?php echo $impuesto['id_impuesto']; ?>" name="porcentajeImpuesto" value="<?php echo $impuesto['porcentaje_impuesto']; ?>" required>
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
