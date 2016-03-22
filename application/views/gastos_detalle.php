<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gastos
            <small>Listado de gastos</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">

              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; width: 500px;">
                  <div class="row">
                    <div class="col-lg-1"></div>
                      <div class="table-responsive col-lg-10">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr><!--Renglones-->
                                    <th>Gasto</th><!--Colunas-->
                                    <th>Concepto</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($detallegastos as $rowgastos){ ?>
                               <tr>
                                   <td><?php echo $rowgastos['id_gasto']; ?></td>
                                   <td><?php echo $rowgastos['id_concepto']; ?></td>
                                   <td><?php echo $rowgastos['cantidad']; ?></td>
                                   <td><?php echo $rowgastos['fecha']; ?></td>
                                   <td><?php echo $rowgastos['total']; ?></td>
                                   <td><i class="fa fa-pencil-square-o"></i></td>
                                   <td><a href="index.php/uploader/desactivaAlmacen?id=<?php echo $rowAlmacen['clave'];?>"><i class="fa fa-trash-o"></i></a></td>
                               </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

