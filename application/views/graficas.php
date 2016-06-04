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
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px; overflow: scroll">
                    <div class="col-lg-12">
                      <div class="col-lg-6" id="chart_div">

                      </div>
                      <div class="col-lg-6">
                       <!--  <canvas id="actuales" width="500" height="500"></canvas> -->
                      </div>
                    </div>
                </div>

              </div><!-- /.nav-tabs-custom -->


            </section><!-- /.Left col -->
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
   <?php
     foreach ($productos as $datos_productos) {
      /*$labelsProductos[]= $datos_productos['nombreproducto'];
      $datosProductos[]= $datos_productos['cantidad'];*/
    }

    ?>
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([<?php foreach ($productos as $datos_productos) { ?>
          ["'<?php  echo $datos_productos['nombreproducto'];?>'", <?php  echo $datos_productos['cantidad'];?>],
          <?php } ?>
        ]);

        // Set chart options
        var options = {'title':'Venta de productos en el periodo',
                       'width':500,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        <?php if ($this->session->userdata('tipografica')=='pastel') { ?>
          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        <?php }else if ($this->session->userdata('tipografica')=='barras') { ?>
          var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        <?php }else if ($this->session->userdata('tipografica')=='lineal') { ?>
          var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        <?php } ?>
      }
</script>


          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>
