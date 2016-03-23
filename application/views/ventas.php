<?php include_once("sidemenu.php") ?>
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
                                    <th>Venta</th><!--Columnas-->
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
                                   <td><?php echo $rowventas['idventa']; ?></td>
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
                                    <th>Abono</th>
                                    <th>Abono periodo</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($adeudos as $rowadeudos){ ?>
                               <tr>
                                   <td><?php echo $rowadeudos['id_venta']; ?></td>
                                   <td><?php echo $rowadeudos['deuda']; ?></td>
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
                      <ul class="nav navbar-nav navbar-right ">
                          <li id="lista3"><a href=""><i class="fa fa-plus-square fa-lg"></i>  Nueva Venta</a></li>
                      </ul>
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

