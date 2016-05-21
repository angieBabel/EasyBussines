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
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px;">
                    <div class="col-lg-12">
                      <div class="col-lg-6">
                        <canvas id="rubros" width="500" height="500"></canvas>
                      </div>
                      <div class="col-lg-6">
                        <canvas id="actuales" width="500" height="500"></canvas>
                      </div>
                    </div>
                </div>

              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->
<script>
      var ctx = document.getElementById("rubros");
      var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: options
      });

      var data = {
              <?php foreach ($datos_rubros as $datos_rubross) { ?>

            labels: ["'<?php echo $datos_rubross['nombrerubro'] ?>'"],
            <?php } ?>
            datasets: [
                {
                    label: "Gastos totales por",
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(255,99,132,0.4)",
                    hoverBorderColor: "rgba(255,99,132,1)",
                    <?php foreach ($datos_rubros as $datos_rubross) { ?>
                    data: [<?php echo $datos_rubross['totalgasto'] ?>],
                    <?php } ?>
                }
            ]

        };
       var datosActuales =
              [

                  <?php foreach ($datos_actuales as $datos_actualess) { ?>
                    {value:<?php echo $datos_actualess['totalgasto'] ?>,color:"#0b82FF",highlight: "#0c62ab",label: "'<?php echo $datos_actualess['nombreconcepto'] ?>'"},
                 <?php } ?>
              ];


        var datosRubros =
              [

                  <?php foreach ($datos_rubros as $datos_rubross) { ?>
                    {value:<?php echo $datos_rubross['totalgasto'] ?>,color:"#0b82FF",highlight: "#0c62ab",label: "'<?php echo $datos_rubross['nombrerubro'] ?>'"},
                 <?php } ?>
              ];

        /*var ctx = document.getElementById("actuales").getContext("2d");
        var ctxx = document.getElementById("rubros").getContext("2d");
        var ctx = document.getElementById("myChart");*/
        /*window.myPie = new Chart(ctx).Bar(datosActuales);
        window.myPie = new Chart(ctxx).Pie(datosRubros);
*/
  </script>


          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>
