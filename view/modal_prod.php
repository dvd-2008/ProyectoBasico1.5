<?php 
include_once('f_Cat.php');

// Obtener categorías
$categorias = obtenerCategorias($pdo);

?>

<div class="modal fade" id="add_prod" tabindex="-1" role="dialog" aria-labelledby="agregarProductoModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar producto -->
                <form action="../controller/controller_prod.php?accion=agregarProducto" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nombreProducto">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcionProducto">Descripción</label>
                        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precioCompra">Precio de Compra</label>
                        <input type="text" class="form-control" id="precioCompra" name="precioCompra" required>
                    </div>
                    <div class="form-group">
                        <label for="precioVenta">Precio de Venta</label>
                        <input type="text" class="form-control" id="precioVenta" name="precioVenta" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id_cat']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagenProducto">Imagen</label>
                        <input type="file" class="form-control-file" id="imagenProducto" name="imagenProducto" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar producto -->
<?php foreach ($productos as $producto): ?>
    <div class="modal fade" id="edit_prod_<?php echo $producto['id_pro']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel<?php echo $producto['id_pro']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarProductoLabel<?php echo $producto['id_pro']; ?>">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar producto -->
                    <form action="../controller/controller_prod.php?accion=editarProducto" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $producto['id_pro']; ?>">
                        <div class="form-group">
                            <label for="nombreProducto<?php echo $producto['id_pro']; ?>">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombreProducto<?php echo $producto['id_pro']; ?>" name="nombreProducto" value="<?php echo $producto['nombre_producto']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProducto<?php echo $producto['id_pro']; ?>">Descripción</label>
                            <textarea class="form-control" id="descripcionProducto<?php echo $producto['id_pro']; ?>" name="descripcionProducto" rows="3"><?php echo $producto['descripcion']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precioCompra<?php echo $producto['id_pro']; ?>">Precio de Compra</label>
                            <input type="text" class="form-control" id="precioCompra<?php echo $producto['id_pro']; ?>" name="precioCompra" value="<?php echo $producto['precio_compra']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="precioVenta<?php echo $producto['id_pro']; ?>">Precio de Venta</label>
                            <input type="text" class="form-control" id="precioVenta<?php echo $producto['id_pro']; ?>" name="precioVenta" value="<?php echo $producto['precio_venta']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="stock<?php echo $producto['id_pro']; ?>">Stock</label>
                            <input type="text" class="form-control" id="stock<?php echo $producto['id_pro']; ?>" name="stock" value="<?php echo $producto['stock']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="categoria<?php echo $producto['id_pro']; ?>">Categoría</label>
                            <select class="form-control" id="categoria<?php echo $producto['id_pro']; ?>" name="categoria" required>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria['id_cat']; ?>" <?php if ($categoria['id_cat'] == $producto['id_cat']) echo 'selected'; ?>><?php echo $categoria['nombre_categoria']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagenProducto<?php echo $producto['id_pro']; ?>">Imagen</label>
                            <input type="file" class="form-control-file" id="imagenProducto<?php echo $producto['id_pro']; ?>" name="imagenProducto">
                            <img style="width: 200px;" src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" alt="Imagen actual">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
