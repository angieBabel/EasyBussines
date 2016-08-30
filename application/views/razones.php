<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Razones Financieras
            <small>Datos del periodo del <?php echo $nice_date = date('d/m/Y', strtotime( $this->session->userdata('fechaInicio')));?> al <?php echo $nice_date2 = date('d/m/Y', strtotime( $this->session->userdata('fechaFin')));?></small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
            <?php
              $CP=0;
              $TV=0;
                foreach ($rotacion as $rotacion) {
                  if ($rotacion['mp']==1 ) {
                    $CP=$CP+1;
                  }
                  $TV=$TV+1;
                }
              if ($CP!=0) {
                $RC= round($TV/$CP, 2);
                $PC= round(365/$RC, 2);
              }else{
                echo "No tienes ninguna cuenta por cobrar";
                $RC= 0;
                $PC= 0;
              }

            ?>

              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; ">
                <div class="row">
                  <div class=" col-lg-12 razones"><!-- rotacion -->
                    <div class="class col-lg-2"></div>
                    <div class="class col-lg-8">
                      <h3>Rotación de cobros</h3>
                    <p><span style="text-decoration:underline;"><b><?php echo $RC;?></b></span> veces se crean y cobran las cuentas por cobrar <br>
    <b>Significado</b> : Representa el número de veces que se cumple el círculo comercial en el periodo a que se refieren las ventas netas. <br>
    <b>Aplicación</b>: proporciona el elemento básico para conocer la rapidez y la eficiencia del crédito
    </p>
                    </div>
                  </div>
                  <div class="col-lg-12 razones" > <!-- promedio -->
                    <div class="class col-lg-2"></div>
                    <div class="class col-lg-8">
                       <h3>Periodo promedio de crédito</h3>
                   La empresa tarda <span style="text-decoration:underline;"><b><?php echo $PC;?></b></span> días en trasformar en efectivo las ventas realizadas. <br>
  <b>Significado</b>: Indica el periodo promedio de tiempo que se requiere para cobrar las cuentas pendientes <br>
  <b>Aplicación</b>: Mide la eficiencia en la rapidez del cobro.
                    </div>


                  </div>

                </div>


                </div>
              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>
