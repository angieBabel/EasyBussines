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
            <section class="col-lg-12 connectedSortable">
              <!-- //Pop up para agregar -->
              <div id="new">
                <!-- Popup Div Starts Here -->
                <div id="popupContact">
                <!-- Contact Us Form -->
                  <form action="index.php/uploader/altaproducto" id="form" method="post" name="form">
                    <a id="close" href="javascript:%20newdiv_hide()"><i class="fa fa-plus-square fa-lg"></i></a>
                    <h2 id="tituloForm">Agrega producto</h2>
                    <hr>
                    <input id="name" name="name" placeholder="Nombre del producto" type="text">
                    <input id="precio" name="precio" placeholder="Precio" type="text">
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
                  <form action="index.php/uploader/editaproducto" id="form" method="POST" name="form">
                    <a id="close" href="javascript:%20editdiv_hide()"><i class="fa fa-plus-square fa-lg"></i></a>
                    <h2 id="tituloForm">Edita producto</h2>
                    <hr>
                    <input type="hidden" id="idP">
                    <input id="nameP" name="name" placeholder="Nombre del producto" type="text">
                    <input id="precioP" name="precio" placeholder="Precio" type="text">
                    <button type="submit" class="btn btn-success form-control">Save</button>
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
                      <table class="table table-hover table-striped">
                          <thead>
                              <tr><!--Renglones-->
                                  <th>Nombre</th>
                                  <th>Precio $</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php foreach($productos as $rowproductos){ ?>
                             <tr>
                                 <td><?php echo $rowproductos['nombre']; ?></td>
                                 <td><?php echo $rowproductos['precio']; ?></td>
                                 <td><a href="javascript:%20editdiv_showP(<?php echo $rowproductos['id_producto']; ?>,'<?php echo $rowproductos['nombre']; ?>',<?php echo $rowproductos['precio']; ?>)"><i class="fa fa-pencil-square-o"></i></a></td>
                                 <td><a href="index.php/uploader/eliminaproducto?id=<?php echo $rowproductos['id_producto']; ?>"><i class="fa fa-trash-o"></i></a></td>
                             </tr>
                             <?php } ?>

                             <!-- id='<?php //echo $rowproductos['id_producto']; ?>',nombre='<?php// echo $rowproductos['nombre']; ?>',precio='<?php //echo $rowproductos['precio']; ?>' -->
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-lg-4 collapse navbar-collapse navbar-ex1-collapse">
                    <a href="javascript:%20newdiv_show()" data-rel="popup"><i class="fa fa-plus-square fa-lg"></i>  Agregar Producto</a>
                  </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

