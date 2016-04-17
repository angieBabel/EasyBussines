<!-- <?php// include_once("sidemenu.php") ?> -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ventas
            <small>Listado de ventas</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- //Pop up para agregar -->
              <div id="abc">
                <!-- Popup Div Starts Here -->
                <div id="popupContact">
                <!-- Contact Us Form -->
                  <form action="#" id="form" method="post" name="form"enctype="multipart/form-data">
                  <?php form_open_multipart('uploader/altaventa'); ?>
                    <a id="close" href="javascript:%20div_hide()"><i class="fa fa-plus-square fa-lg"></i></a>
                    <h2 id="tituloForm">Nueva venta</h2>
                    <hr>
                    <select name="name" id="name" class="form-control">
                        <?php foreach ($productos as $rowProductos ) { ?>
                          <option value="<?php echo $rowProductos['id_producto']?>">
                            <?php echo $rowProductos['nombre']?>
                          </option>
                       <?php } ?>
                      </select>
                      <?php
                        $idProducto=$rowProductos['id_producto'];
                        $ssql = "SELECT precio FROM productos WHERE id_producto=$idProducto";
                        $resultado = mysql_query($ssql);
                        $fila=mysql_fetch_object($resultado);
                       ?>
                    <input id="precio" name="precio" placeholder="Precio" type="text"value="<?php echo "$fila->precio"; ?>">
                    <input id="cantidad" name="cantidad" placeholder="Cantidad" type="text">
                    <input id="modopago" name="modopago" placeholder="Modo pago" type="text">
                    <a href="javascript:%20check_empty()" id="submit">Send</a>
                  </form>
                </div>
                <!-- Popup Div Ends Here -->
              </div>

              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; ">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="table-responsive col-lg-10">
                      <h3>Contado</h3>
                      <table class="table table-hover table-striped">
                          <thead>
                              <tr><!--Renglones-->
                                  <th>Producto</th>
                                  <th>Precio</th>
                                  <th>Cantidad</th>
                                  <th>Modo pago</th>
                                  <th>Fecha</th>
                                  <th>Total</th>
                                  <th>% del periodo</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php foreach($ventas as $rowventas){ ?>
                             <tr>
                                 <td><?php echo $rowventas['nombreproducto']; ?></td>
                                 <td><?php echo $rowventas['precioproducto']; ?></td>
                                 <td><?php echo $rowventas['cantidad']; ?></td>
                                 <td><?php echo $rowventas['modopago']; ?></td>
                                 <td><?php echo $rowventas['fechaventa']; ?></td>
                                 <td><?php echo $rowventas['totalventa']; ?></td>
                                 <td><!-- <?php echo $rowventas['total']; ?> --></td>
                                 <td><i class="fa fa-pencil-square-o"></i></td>
                                 <td><!-- <a href="index.php/uploader/desactivaAlmacen?id=<?php echo $rowAlmacen['clave'];?>"> --><i class="fa fa-trash-o"></i></a></td>
                             </tr>
                             <?php } ?>
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-1"></div>
                      <div class="table-responsive col-lg-10">
                        <h3>Crédito</h3>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr><!--Renglones-->
                                    <th>Venta</th><!--Colunas-->
                                    <th>Deuda</th>
                                    <th>Fecha</th>
                                    <th>Abono</th>
                                    <th>Abono periodo</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($adeudos as $rowadeudos){ ?>
                               <tr>
                                   <td><?php echo $rowadeudos['nombreproducto']; ?></td>
                                   <td><?php echo $rowadeudos['deuda']; ?></td>
                                   <td><?php echo $rowventas['fechaventa']; ?></td>
                                   <td><?php echo $rowadeudos['abono']; ?></td>
                                   <td><?php echo $rowadeudos['abono_periodo']; ?></td>
                                   <td><i class="fa fa-pencil-square-o"></i></td>
                                   <td><!-- <a href="index.php/uploader/desactivaAlmacen?id=<?php echo $rowAlmacen['clave'];?>"> --><i class="fa fa-trash-o"></i></a></td>
                               </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="col-lg-10 collapse navbar-collapse navbar-ex1-collapse">
                      <a href="javascript:%20div_show()" data-rel="popup"><i class="fa fa-plus-square fa-lg"></i>Nueva venta</a>
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

