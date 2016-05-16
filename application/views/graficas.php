<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gráficas
            <small>Estados del mes</small>
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
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; width: 600px;">
                <div id="canvas-holder" align="center">
                    <canvas id="actuales" width="300" height="300"></canvas>
                </div>
              </div>

              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->
<script>


  var datosRubros =
        [

            <?php foreach ($datos_rubros as $datos_rubross) { ?>
              {value:<?php echo $datos_rubross['totalgasto'] ?>,color:"#0b82FF",highlight: "#0c62ab",label: "'<?php echo $datos_rubross['nombrerubro'] ?>'"},
           <?php } ?>
        ];


        var ctx = document.getElementById("actuales").getContext("2d");

        window.myPie = new Chart(ctx).Pie(datosRubros);

  </script>


          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>
