<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gastos
            <small>Detalle de gastos</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- //Pop up para agregar -->
              <div id="new">
                <!-- Popup Div Starts Here -->
                <div id="popupContact">

                <!-- Contact Us Form -->
                  <form action="index.php/uploader/altagasto" id="form" method="post" name="form">
                    <a id="close" href="javascript:%20newdiv_hide()"><i class="fa fa-plus-square fa-lg"></i></a>
                    <h2 id="tituloForm">Agregar gasto</h2>
                    <hr>
                    <select name="name" id="name" class="form-control">
                        <?php foreach ($catalogogastos as $rowcatalogogastos ) { ?>
                          <option value="<?php echo $rowcatalogogastos['idconcepto']?>">
                            <?php echo $rowcatalogogastos['nombreconcepto']?>
                          </option>
                       <?php } ?>
                    </select>
                    <input id="cantidad" name="cantidad" placeholder="Cantidad" type="text">
                    <input type="hidden" name="costo" id="costo" value="<?php echo $rowcatalogogastos['costo']?>">
                    <input type="hidden" name="rubro" id="rubro" value="<?php echo $rowcatalogogastos['rubro']?>">
                    <button type="submit" class="btn btn-success form-control">Save</button>
                  </form>
                </div>
                <!-- Popup Div Ends Here -->
              </div>

              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px;">
                  <div class="row">
                    <div class="col-lg-1"></div>
                      <div class="table-responsive col-lg-10">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr><!--Renglones-->
                                    <th>Concepto</th><!--Colunas-->
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
                                   <td><?php echo $rowgastos['nombreconcepto']; ?></td>
                                   <td><?php echo $rowgastos['cantidad']; ?></td>
                                   <td><?php echo $nice_date = date('d/m/Y', strtotime( $rowgastos['fecha'] ));?></td>
                                   <td><?php echo $rowgastos['totalgasto']; ?></td>
                                   <td><a href="index.php/uploader/eliminagasto?id=<?php echo $rowgastos['idgasto']; ?>&rubro=<?php echo $rowgastos['rubro']; ?>"><i class="fa fa-trash-o"></i></a></td>
                               </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="col-lg-4 collapse navbar-collapse navbar-ex1-collapse">
                    <a href="javascript:%20newdiv_show()" data-rel="popup"><i class="fa fa-plus-square fa-lg"></i>Agregar Gasto</a>
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->

            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

