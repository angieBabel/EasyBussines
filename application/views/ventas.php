<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ventas
            <small>Listado de ventas del <?php echo $nice_date = date('d/m/Y', strtotime( $this->session->userdata('fechaInicio')));?> al <?php echo $nice_date2 = date('d/m/Y', strtotime( $this->session->userdata('fechaFin')));?></small>
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
                  <form action="index.php/uploader/altaventa" id="form" method="post" name="form"enctype="multipart/form-data">
                  <?php form_open_multipart('uploader/altaventa'); ?>
                    <a id="close" href="javascript:%20newdiv_hide()"><i class="fa fa-plus-square fa-lg"></i></a>
                    <h2 id="tituloForm">Nueva venta</h2>
                    <hr>
                    <select name="name" id="name" class="form-control" onchange="">
                        <?php foreach ($productos as $rowProductos ) { ?>
                          <option value="<?php echo $rowProductos['id_producto']?>">
                            <?php echo $rowProductos['nombre']?> , $<?php echo $rowProductos['precio']; ?>
                          </option>
                       <?php } ?>
                    </select>
                    <input id="cantidad" name="cantidad" placeholder="Cantidad" type="text">
                    <label for="modopago">Modo de pago</label><br>
                    <label class="radio-inline"><input type="radio" name="modopago" id="modopago" value="Contado">Contado</label>
                    <label class="radio-inline"><input type="radio" name="modopago" id="modopago" value="Credito" onChange="deudorF();">Crédito</label>
                    <input type="text" id="deudor" name="deudor" placeholder="Deudor" style="display: none;">
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
                  <form action="index.php/uploader/editaadeudo" id="form" method="post" name="form">
                    <a id="close" href="javascript:%20editdiv_hide()"><i class="fa fa-plus-square fa-lg"></i></a>
                    <h2 id="tituloForm">Venta de crédito</h2>
                    <hr>
                    <input type="hidden" name="idAdeudo" id="idAdeudo">
                    <input type="hidden" name="abonoT" id="abonoT">
                    <input id="venta" name="venta" placeholder="Nombre de la venta" type="text">
                    <input id="abonoperiodo" name="abonoperiodo" placeholder="Abono periodo" type="text">
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
                      <h3>Contado</h3>
                      <table class="table table-hover table-striped" >
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
                              </tr>
                          </thead>
                          <tbody>
                            <?php foreach($ventas as $rowventas){ ?>
                             <tr>
                                 <td><?php echo $rowventas['nombreproducto']; ?></td>
                                 <td><?php echo $rowventas['precioproducto']; ?></td>
                                 <td><?php echo $rowventas['cantidad']; ?></td>

                                 <td><?php if ($rowventas['modopago']==0) {
                                            echo "Contado";
                                           }else{
                                            echo "Crédito";
                                           }
                                 ?></td>
                                 <td><?php echo $nice_date = date('d/m/Y', strtotime( $rowventas['fechaventa'] ));?></td>
                                 <td><?php echo $rowventas['totalventa']; ?></td>
                                 <td><!-- <?php echo $rowventas['total']; ?> --></td>
                                 <td><a href="index.php/uploader/eliminaventa?id=<?php echo $rowventas['idventa'];?>"><i class="fa fa-trash-o"></i></a></td>
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
                                    <th>Deudor</th>
                                    <th>Deuda</th>
                                    <th>Fecha</th>
                                    <th>Abono</th>
                                    <th>Abono periodo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($adeudos as $rowadeudos){ ?>
                               <tr>
                                   <td><?php echo $rowadeudos['nombreproducto']; ?></td>
                                   <td><?php echo $rowadeudos['deudor']; ?></td>
                                   <td><?php echo $rowadeudos['deuda']; ?></td>

                                   <td><?php echo $nice_date = date('d/m/Y', strtotime( $rowventas['fechaventa'] ));?></td>

                                   <td><?php echo $rowadeudos['abono']; ?></td>
                                   <td><?php echo $rowadeudos['abono_periodo']; ?></td>
                                   <td><a href="javascript:%20editdiv_showA(<?php echo $rowadeudos['idAdeudo']; ?>,'<?php echo $rowadeudos['nombreproducto']; ?>',<?php echo $rowadeudos['abono']; ?>,<?php echo $rowadeudos['abono_periodo']; ?>)"><i class="fa fa-pencil-square-o"></i></a></td></i></a></td>
                               </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="col-lg-10 collapse navbar-collapse navbar-ex1-collapse">
                      <a href="javascript:%20newdiv_show()" data-rel="popup"><i class="fa fa-plus-square fa-lg"></i>Nueva venta</a>
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>

