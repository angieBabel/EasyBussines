<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Productos
            <small>Lista de productos</small>
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
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; width:500px;">
                  <div class="row">
                    <div class="col-lg-1"></div>
                      <div class="table-responsive col-lg-10">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr><!--Renglones-->
                                    <th>Id Producto</th><!--Colunas-->
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($productos as $rowproductos){ ?>
                               <tr>
                                   <td><?php echo $rowproductos['id_producto']; ?></td>
                                   <td><?php echo $rowproductos['nombre']; ?></td>
                                   <td><?php echo $rowproductos['precio']; ?></td>
                                   <td><i class="fa fa-pencil-square-o"></i></td>
                                   <td><a href="index.php/uploader/desactivaAlmacen?id=<?php echo $rowAlmacen['clave'];?>"><i class="fa fa-trash-o"></i></a></td>
                               </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("/sections/footer.php") ?>

