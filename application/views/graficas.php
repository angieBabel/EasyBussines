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
                      <div class="col-lg-6" id="ventasPeriodo">
                      </div>
                      <div class="col-lg-6" id="comparativaVentas">
                      </div>
                      <div class="col-lg-6" id="gastosPeriodo">
                      </div>
                      <div class="col-lg-6" id="comparativaGastos">
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
        //datos para las ventas del periodo
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Topping');
        data1.addColumn('number', 'Total');
        data1.addRows([<?php foreach ($ventasPeriodo as $ventas_Periodo) { ?>
          ["'<?php  echo $ventas_Periodo['nombreproducto'];?>'", <?php  echo $ventas_Periodo['cantidad'];?>],
          <?php } ?>
        ]);

        // Set chart options
        var options1 = {'title':'Venta de productos en el periodo del <?php echo $nice_date = date('d/m/Y', strtotime( $this->session->userdata('fechaInicio')));?> al <?php echo $nice_date2 = date('d/m/Y', strtotime( $this->session->userdata('fechaFin')));?> ',
                       'width':450,
                       'height':400};

//datos para la comparativa de ventas
        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Topping');
        data2.addColumn('number', 'Total');
        data2.addRows([<?php foreach ($comparativaVentas as $comparativa_Ventas) { ?>
          ["'<?php  echo $comparativa_Ventas['mes'];?>'", <?php  echo $comparativa_Ventas['total'];?>],
          <?php } ?>
        ]);

        // Set chart options
        var options2 = {'title':'Ventas totales por mes',
                       'width':450,
                       'height':400};
//datos para los gastos del periodo
        var data3 = new google.visualization.DataTable();
        data3.addColumn('string', 'Topping');
        data3.addColumn('number', 'Total');
        data3.addRows([<?php foreach ($gastosPeriodo as $gastos_Periodo) { ?>
          ["'<?php  echo $gastos_Periodo['nombreconcepto'];?>'", <?php  echo $gastos_Periodo['cantidad'];?>],
          <?php } ?>
        ]);

        // Set chart options
        var options3 = {'title':'Gatos del periodo del <?php echo $nice_date = date('d/m/Y', strtotime( $this->session->userdata('fechaInicio')));?> al <?php echo $nice_date2 = date('d/m/Y', strtotime( $this->session->userdata('fechaFin')));?>',
                       'width':450,
                       'height':400};

//datos para la comparativa de gastos
        var data4 = new google.visualization.DataTable();
        data4.addColumn('string', 'Topping');
        data4.addColumn('number', 'Total');
        data4.addRows([<?php foreach ($comparativaGastos as $comparativa_Gastos) { ?>
          ["'<?php  echo $comparativa_Gastos['mes'];?>'", <?php  echo $comparativa_Gastos['totalgasto'];?>],
          <?php } ?>
        ]);

        // Set chart options
        var options4 = {'title':'Gastos totales por mes',
                       'width':450,
                       'height':400};
        // Instantiate and draw our chart, passing in some options.
        //Ventas del Periodo
        <?php if ($this->session->userdata('tipografica')=='pastel') { ?>
          //ventas periodo
          var chart1 = new google.visualization.PieChart(document.getElementById('ventasPeriodo'));
          chart1.draw(data1, options1);
          //comparativaVentas
          var chart2 = new google.visualization.PieChart(document.getElementById('comparativaVentas'));
          chart2.draw(data2, options2);
          //gastosPeriodo
          var chart3 = new google.visualization.PieChart(document.getElementById('gastosPeriodo'));
          chart3.draw(data3, options3);
          //comparativaGastos
          var chart4 = new google.visualization.PieChart(document.getElementById('comparativaGastos'));
          chart4.draw(data4, options4);


        <?php }else if ($this->session->userdata('tipografica')=='barras') { ?>
          //ventas periodo
          var chart1 = new google.visualization.BarChart(document.getElementById('ventasPeriodo'));
          chart1.draw(data1, options1);
          //comparativaVentas
          var chart2 = new google.visualization.BarChart(document.getElementById('comparativaVentas'));
          chart2.draw(data2, options2);
          //gastosPeriodo
          var chart3 = new google.visualization.BarChart(document.getElementById('gastosPeriodo'));
          chart3.draw(data3, options3);
          //comparativaGastos
          var chart4 = new google.visualization.BarChart(document.getElementById('comparativaGastos'));
          chart4.draw(data4, options4);


        <?php }else if ($this->session->userdata('tipografica')=='lineal') { ?>
          //ventas periodo
          var chart1 = new google.visualization.LineChart(document.getElementById('ventasPeriodo'));
          chart1.draw(data1, options1);
          //comparativaVentas
          var chart2 = new google.visualization.LineChart(document.getElementById('comparativaVentas'));
          chart2.draw(data2, options2);
          //gastosPeriodo
          var chart3 = new google.visualization.LineChart(document.getElementById('gastosPeriodo'));
          chart3.draw(data3, options3);
          //comparativaGastos
          var chart4 = new google.visualization.LineChart(document.getElementById('comparativaGastos'));
          chart4.draw(data4, options4);
        <?php } ?>

      }
</script>


          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once("sections/footer.php") ?>
