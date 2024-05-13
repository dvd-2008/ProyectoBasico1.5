<?php 
include_once('f_Cat.php');

// Obtener usuarios, clientes, categorías, productos, descuentos e impuestos
$usuarios = obtenerUsuarios($pdo);
$clientes = obtenerClientes($pdo);
$categorias = obtenerCategorias($pdo);
$productos = obtenerProductos($pdo);
$descuentos = obtenerDescuentos($pdo);
$impuestos = obtenerImpuestos($pdo);
?>

<div class="modal fade" id="add_ven" tabindex="-1" role="dialog" aria-labelledby="agregarVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarVentaModalLabel">Agregar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/controller_ven.php?accion=agregarVenta" method="post">
                    <!-- Usuario -->
                    <div class="form-group">
                        <label for="usuarioVenta">Usuario</label>
                        <select class="form-control" id="usuarioVenta" name="usuarioVenta" required>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nombre_usuario']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Cliente -->
                    <div class="form-group">
                        <label for="clienteVenta">Cliente</label>
                        <select class="form-control" id="clienteVenta" name="clienteVenta" required>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre_cliente']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Fecha de Venta -->
                    <div class="form-group">
                        <label for="fechaVenta">Fecha de Venta</label>
                        <input type="date" class="form-control" id="fechaVenta" name="fechaVenta" required>
                    </div>

                    <!-- Producto -->
                    <div class="form-group">
                        <label for="productoVenta">Producto</label>
                        <select class="form-control" id="productoVenta" name="productoVenta" required onchange="actualizarPrecioVenta()">
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id_pro']; ?>"><?php echo $producto['nombre_producto']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Cantidad -->
                    <div class="form-group">
                        <label for="cantidadVenta">Cantidad</label>
                        <input type="number" class="form-control" id="cantidadVenta" name="cantidadVenta" required>
                    </div>

                    <!-- Precio de Venta -->
                    <div class="form-group">
                        <label for="precioVenta">Precio de Venta</label>
                        <select class="form-control" id="precioVenta" name="precioVenta" required>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['precio_venta']; ?>"><?php echo $producto['precio_venta']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Porcentaje de Descuento -->
                    <div class="form-group">
                        <label for="descuentoVenta">Porcentaje de Descuento</label>
                        <select class="form-control" id="descuentoVenta" name="descuentoVenta" required>
                            <?php foreach ($descuentos as $descuento): ?>
                                <option value="<?php echo $descuento['id_descuento']; ?>"><?php echo $descuento['porcentaje_descuento']; ?>%</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Porcentaje de Impuesto -->
                    <div class="form-group">
                        <label for="impuestoVenta">Porcentaje de Impuesto</label>
                        <select class="form-control" id="impuestoVenta" name="impuestoVenta" required>
                            <?php foreach ($impuestos as $impuesto): ?>
                                <option value="<?php echo $impuesto['id_impuesto']; ?>"><?php echo $impuesto['porcentaje_impuesto']; ?>%</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Venta</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar venta -->
<?php foreach ($ventas as $venta): ?>
    <div class="modal fade" id="edit_ven_<?php echo $venta['id_venta']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarVentaLabel<?php echo $venta['id_venta']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarVentaLabel<?php echo $venta['id_venta']; ?>">Editar Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controller/controller_ven.php?accion=editarVenta" method="post">
                        <input type="hidden" name="id_venta" value="<?php echo $venta['id_venta']; ?>">

                        <!-- Usuario -->
                        <div class="form-group">
                            <label for="usuarioVenta">Usuario</label>
                            <select class="form-control" id="usuarioVenta" name="usuarioVenta" required>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nombre_usuario']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Cliente -->
                        <div class="form-group">
                            <label for="clienteVenta">Cliente</label>
                            <select class="form-control" id="clienteVenta" name="clienteVenta" required>
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre_cliente']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Fecha de Venta -->
                        <div class="form-group">
                            <label for="fechaVenta">Fecha de Venta</label>
                            <input type="date" class="form-control" id="fechaVenta" name="fechaVenta" value="<?php echo $venta['fecha_venta']; ?>" required>
                        </div>

                        <!-- Producto -->
                        <div class="form-group">
                            <label for="productoVenta">Producto</label>
                            <select class="form-control" id="productoVenta" name="productoVenta" required onchange="actualizarPrecioVenta()">
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['id_pro']; ?>"><?php echo $producto['nombre_producto']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Cantidad -->
                        <div class="form-group">
                            <label for="cantidadVenta">Cantidad</label>
                            <input type="number" class="form-control" id="cantidadVenta" name="cantidadVenta" value="<?php echo $detalles_venta[0]['cantidad']; ?>" required>
                        </div>

                        <!-- Precio de Venta -->
                        <div class="form-group">
                            <label for="precioVenta">Precio de Venta</label>
                            <select class="form-control" id="precioVenta" name="precioVenta" required>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['precio_venta']; ?>" <?php if(isset($detalles_venta) && $producto['precio_venta'] == $detalles_venta['precio_uni']) echo 'selected'; ?>><?php echo $producto['precio_venta']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Porcentaje de Descuento -->
                        <div class="form-group">
                            <label for="descuentoVenta">Porcentaje de Descuento</label>
                            <select class="form-control" id="descuentoVenta" name="descuentoVenta" required>
                                <?php foreach ($descuentos as $descuento): ?>
                                    <option value="<?php echo $descuento['id_descuento']; ?>"><?php echo $descuento['porcentaje_descuento']; ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Porcentaje de Impuesto -->
                        <div class="form-group">
                            <label for="impuestoVenta">Porcentaje de Impuesto</label>
                            <select class="form-control" id="impuestoVenta" name="impuestoVenta" required>
                                <?php foreach ($impuestos as $impuesto): ?>
                                    <option value="<?php echo $impuesto['id_impuesto']; ?>"><?php echo $impuesto['porcentaje_impuesto']; ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
