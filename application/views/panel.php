<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel Principal
            <small>Principal</small>
            <?php echo $this->session->userdata('tipografica'); ?>
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
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; overflow: scroll">
                  <h1>Resumen General</h1>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="col-lg-4">
                        <h2>Ventas del Mes</h2>
                        <p>Consulte la sección de ventas en caso de alguna duda o anomalia.</p>
                      </div>
                      <div class="col-lg-8">

                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="col-lg-8">

                      </div>
                      <div class="col-lg-4">
                        <h2>Productos</h2>
                        <p>Se enlistan los productos más vendidos durante el mes actual</p>
                        <p>Más información en la sección de productos</p>
                      </div>
                    </div>
                  </div>


              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include_once("sections/footer.php") ?>
