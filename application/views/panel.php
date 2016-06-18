<?php include_once("sidemenu.php") ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel Principal
            <small>Principal</small>
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
                <?php
                switch (date("n")) {
                      case 1:
                          $mes='Enero';
                          break;
                      case 2:
                          $mes='Febrero';
                          break;
                      case 3:
                          $mes='Marzo';
                          break;
                      case 4:
                          $mes='Abril';
                          break;
                      case 5:
                          $mes='Mayo';
                          break;
                      case 6:
                          $mes='Junio';
                          break;
                      case 7:
                          $mes='Julio';
                          break;
                      case 8:
                          $mes='Agosto';
                          break;
                      case 9:
                          $mes='Septiempre';
                          break;
                      case 10:
                          $mes='Octubre';
                          break;
                      case 11:
                          $mes='Noviembre';
                          break;
                      case 12:
                          $mes='Diciembre';
                          break;
                } ?>
                  <h1>Resumen General del mes de <?php echo $mes ?></h1>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="col-lg-6">
                        <h2>Ventas del Mes</h2>
                        <p>Consulte la sección de ventas en caso de alguna duda o anomalia.</p>
                        <div  id="chart_div" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <h2>Productos</h2>
                          <p>Se enlistan los productos más vendidos durante el mes actual</p>
                          <p>Más información en la sección de productos</p>
                        <div class="col-lg-12">
                          <table class="table table-hover table-striped" >
                            <thead>
                                <tr><!--Renglones-->
                                    <th>Producto</th>
                                    <th>Modo pago</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($ventasMes as $rowventas){ ?>
                               <tr>
                                   <td><?php echo $rowventas['nombreproducto']; ?></td>
                                   <td><?php if ($rowventas['modopago']==0) {
                                              echo "Contado";
                                             }else{
                                              echo "Crédito";
                                             }
                                   ?></td>
                                   <td><?php echo $rowventas['totalUV']; ?></td>
                                   <td><?php echo $rowventas['totalventa']; ?></td>
                               </tr>
                               <?php } ?>
                            </tbody>
                          </table>
                        </div>
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
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Cantidad');
        data.addRows([<?php foreach ($comparativaVentas as $comparativa) { ?>
          ["'<?php if ($comparativa['modopago']==0) {
                          echo "Contado";
                         }else{
                          echo "Crédito";
                         }
               ?>'", <?php echo $comparativa['totalmodopago']  ?>],
          <?php } ?>
        ]);



        // Set chart options
        var options = {'title':'Ventas del Mes',
                       'width':550,
                       'height':350};

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
