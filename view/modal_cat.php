<!-- Modal para agregar categoría -->
<div class="modal fade" id="add_cat" tabindex="-1" role="dialog" aria-labelledby="agregarCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCategoriaModalLabel">Agregar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar categoría -->
                <form action="../controller/controller_cat.php?accion=agregarCategoria" method="post">

                    <div class="form-group">
                        <label for="nombreCategoria">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcionCategoria">Descripción</label>
                        <textarea class="form-control" id="descripcionCategoria" name="descripcionCategoria" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar categoría -->
<?php foreach ($categorias as $categoria): ?>
    <div class="modal fade" id="edit_cat_<?php echo $categoria['id_cat']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarCategoriaLabel<?php echo $categoria['id_cat']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarCategoriaLabel<?php echo $categoria['id_cat']; ?>">Editar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar categoría -->
                    <form action="../controller/controller_cat.php?accion=editarCategoria" method="post">
                        <input type="hidden" name="id" value="<?php echo $categoria['id_cat']; ?>">
                        <div class="form-group">
                            <label for="nombreCategoria<?php echo $categoria['id_cat']; ?>">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombreCategoria<?php echo $categoria['id_cat']; ?>" name="nombreCategoria" value="<?php echo $categoria['nombre_categoria']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionCategoria<?php echo $categoria['id_cat']; ?>">Descripción</label>
                            <textarea class="form-control" id="descripcionCategoria<?php echo $categoria['id_cat']; ?>" name="descripcionCategoria" rows="3"><?php echo $categoria['descripcion']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
