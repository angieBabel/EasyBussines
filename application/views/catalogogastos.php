<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Conceptos
            <small>Catalogo de gastos</small>
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
                  <form  class="form-horizontal" action="index.php/uploader/altacatgasto" id="form" method="post" name="form">
                    <a id="close" href="javascript:%20newdiv_hide()"><i class="fa fa-times-circle fa-lg"></i></a>
                    <h2 id="tituloForm">Agrega concepto</h2>
                    <hr>
                    <input class="form-control" id="name" name="name" placeholder="Nombre del producto" type="text">
                    <input class="form-control" id="precio" name="precio" placeholder="Precio" type="text">
                    <label><input type="radio" name="tiporubro" id="tiporubro" value="Existe"
                    onChange="rubroE();">Rubro Existente</label>
                    <select name="rubroExistente" id="rubroExistente" class="form-control" style="display: none;">
                        <?php foreach ($rubros as $rowrubros ) { ?>
                          <option value="<?php echo $rowrubros['id_rubro']?>">
                            <?php echo $rowrubros['nombre']?>
                          </option>
                       <?php } ?>
                    </select>
                    <label><input type="radio" name="tiporubro" id="tiporubro" value="Nuevo" onChange="rubroN();">Agregar Rubro</label>
                    <input class="form-control" id="rubroNuevo" name="rubroNuevo" placeholder="Rubro" type="text" style="display: none; margin-top: 0px !important">
                    <button type="submit" class="btn btn-success form-control">Save</button>
                  </form>
                </div>
                <!-- Popup Div Ends Here -->
              </div>
              <!-- //Pop up para editar -->
              <div id="edit">
                <!-- Popup Div Starts Here -->
                <div id="popupContact">
                <!-- Contact Us Form -->
                  <form action="index.php/uploader/editacatgastos" id="form" method="post" name="form">
                    <a id="close" href="javascript:%20editdiv_hide()"><i class="fa fa-times-circle fa-lg"></i></a>
                    <h2 id="tituloForm">Edita concepto</h2>
                    <hr>
                    <input type="hidden" id="idG" name="idG">
                    <select name="idRG" id="idRG" class="form-control" onchange="">
                        <?php foreach ($rubros as $rowrubros ) { ?>
                          <option value="<?php echo $rowrubros['id_rubro']?>">
                            <?php echo $rowrubros['nombre']?>
                          </option>
                       <?php } ?>
                    </select>
                    <input class="form-control" id="nameG" name="nameG" placeholder="Nombre del concepto" type="text">
                    <input class="form-control" id="precioG" name="precioG" placeholder="Costo" type="text">
                    <button type="submit" class="btn btn-success form-control">Save</button>
                  </form>
                </div>
                <!-- Popup Div Ends Here -->
              </div>
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; overflow: scroll">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="table-responsive col-lg-10">
                      <table class="table table-hover table-striped">
                          <thead>
                              <tr><!--Renglones-->
                                  <th>Rubro</th>
                                  <th>Concepto</th>
                                  <th>Costo $</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php foreach($catgastos as $rowcatgastos){ ?>
                             <tr>
                                 <td><?php echo $rowcatgastos['nombrerubro']; ?></td>
                                 <td><?php echo $rowcatgastos['nombre']; ?></td>
                                 <td><?php echo $rowcatgastos['costo']; ?></td>
                                 <td><a href="javascript:%20editdiv_showG(<?php echo $rowcatgastos['id_concepto']; ?>,<?php echo $rowcatgastos['id_rubro']; ?>,'<?php echo $rowcatgastos['nombre']; ?>',<?php echo $rowcatgastos['costo']; ?>)"><i class="fa fa-pencil-square-o"></i></a></td>
                                 <td><a href="index.php/uploader/eliminaconcepto?id=<?php echo $rowcatgastos['id_concepto']; ?>"><i class="fa fa-trash-o"></i></a></td>
                             </tr>
                             <?php } ?>

                             <!-- id='<?php //echo $rowcatgastos['id_producto']; ?>',nombre='<?php// echo $rowcatgastos['nombre']; ?>',precio='<?php //echo $rowcatgastos['precio']; ?>' -->
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-lg-8"></div>
                  <div class="col-lg-4" id="add">
                    <a href="javascript:%20newdiv_show()" data-rel="popup">Agregar Concepto <i class="fa fa-plus-square fa-lg"></i></a>
                  </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

