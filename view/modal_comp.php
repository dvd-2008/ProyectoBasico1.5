<!-- Modal para agregar compra -->
<div class="modal fade" id="add_comp" tabindex="-1" role="dialog" aria-labelledby="agregarCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCompraModalLabel">Agregar Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/controller_comp.php?accion=agregarCompra" method="post">
                    <!-- Usuario -->
                    <div class="form-group">
                        <label for="usuarioCompra">Usuario</label>
                        <select class="form-control" id="usuarioCompra" name="usuarioCompra" required>
                            <!-- Aquí debes cargar dinámicamente los usuarios desde la base de datos -->
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nombre_usuario']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Proveedor -->
                    <div class="form-group">
                        <label for="proveedorCompra">Proveedor</label>
                        <select class="form-control" id="proveedorCompra" name="proveedorCompra" required>
                            <!-- Aquí debes cargar dinámicamente los proveedores desde la base de datos -->
                            <?php foreach ($proveedores as $proveedor): ?>
                                <option value="<?php echo $proveedor['id_prov']; ?>"><?php echo $proveedor['nombre_prov']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Fecha de Compra -->
                    <div class="form-group">
                        <label for="fechaCompra">Fecha de Compra</label>
                        <input type="date" class="form-control" id="fechaCompra" name="fechaCompra" required>
                    </div>

                    <!-- Producto -->
                    <div class="form-group">
                        <label for="productoCompra">Producto</label>
                        <select class="form-control" id="productoCompra" name="productoCompra" required>
                            <!-- Aquí debes cargar dinámicamente los productos desde la base de datos -->
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id_pro']; ?>"><?php echo $producto['nombre_producto']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Cantidad -->
                    <div class="form-group">
                        <label for="cantidadCompra">Cantidad</label>
                        <input type="number" class="form-control" id="cantidadCompra" name="cantidadCompra" required>
                    </div>

                    <!-- Precio Unitario -->
                    <div class="form-group">
                        <label for="precioUniCompra">Precio Unitario</label>
                        <input type="number" step="0.01" class="form-control" id="precioUniCompra" name="precioUniCompra" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Compra</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php foreach ($compras as $compra): ?>
    <?php
    // Consulta para obtener los detalles de compra de esta compra en particular
    $query = "SELECT cantidad, precio_uni FROM detalles_de_compra WHERE id_compra = :id_compra";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id_compra', $compra['id_compra']);
    $statement->execute();
    $detalles_compra = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?> 

    <!-- Modal para editar compra -->
    <div class="modal fade" id="edit_comp_<?php echo $compra['id_compra']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarCompraLabel<?php echo $compra['id_compra']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarCompraLabel<?php echo $compra['id_compra']; ?>">Editar Detalles de Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="controller/controller_comp.php?accion=editarCompra" method="post">
                        <input type="hidden" name="id_compra" value="<?php echo $compra['id_compra']; ?>">
                        
                        <!-- Usuario -->
                        <div class="form-group">
                            <label for="usuarioCompra<?php echo $compra['id_compra']; ?>">Usuario</label>
                            <select class="form-control" id="usuarioCompra<?php echo $compra['id_compra']; ?>" name="usuarioCompra" required>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nombre_usuario']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Proveedor -->
                        <div class="form-group">
                            <label for="proveedorCompra<?php echo $compra['id_compra']; ?>">Proveedor</label>
                            <select class="form-control" id="proveedorCompra<?php echo $compra['id_compra']; ?>" name="proveedorCompra" required>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <option value="<?php echo $proveedor['id_prov']; ?>"><?php echo $proveedor['nombre_prov']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Fecha de Compra -->
                        <div class="form-group">
                            <label for="fechaCompra<?php echo $compra['id_compra']; ?>">Fecha de Compra</label>
                            <input type="date" class="form-control" id="fechaCompra<?php echo $compra['id_compra']; ?>" name="fechaCompra" value="<?php echo $compra['fecha_compra']; ?>" required>
                        </div>
                        
                        <!-- Producto -->
                        <div class="form-group">
                            <label for="productoCompra<?php echo $compra['id_compra']; ?>">Producto</label>
                            <select class="form-control" id="productoCompra<?php echo $compra['id_compra']; ?>" name="productoCompra" required>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['id_pro']; ?>"><?php echo $producto['nombre_producto']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Cantidad -->
                        <div class="form-group">
                            <label for="cantidadCompra<?php echo $compra['id_compra']; ?>">Cantidad</label>
                            <input type="text" class="form-control" id="cantidadCompra<?php echo $compra['id_compra']; ?>" name="cantidadCompra" value="<?php echo $detalles_compra[0]['cantidad']; ?>" required>
                        </div>
                        
                        <!-- Precio Unitario -->
                        <div class="form-group">
                            <label for="precioUniCompra<?php echo $compra['id_compra']; ?>">Precio Unitario</label>
                            <input type="text" class="form-control" id="precioUniCompra<?php echo $compra['id_compra']; ?>" name="precioUniCompra" value="<?php echo $detalles_compra[0]['precio_uni']; ?>" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
