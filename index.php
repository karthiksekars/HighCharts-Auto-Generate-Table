<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<div id="container" style="height: 500px; width: 500px;float: left"></div>
<div id="testtbl" style="height: 500px; width: 500px;float: left;"></div>
<script type="text/javascript">
  $(function () {

      function highChartRedrawTable(chObj, tblObj) {
          var postdataURL = 'ajax_genrate_table.php';
          var ajaxType = 'POST';

          //get titles
          var title_array = new Array();
          for (var j = 0; j < chObj.series.length - 1; j++) {
              //console.log(this.series[j].name);return false;
              title_array.push(chObj.series[j].name);
          }

          //Get Values
          var graph_data = new Array();
          for (var i = 0; i < chObj.series[0].points.length; i++) {

              var cdata = new Array();
              cdata.push(chObj.series[0].points[i].x);
              for (var j = 0; j < chObj.series.length - 1; j++) {
                  cdata.push(chObj.series[j].points[i].y);
              }
              graph_data.push(cdata);

          }

          jQuery.ajax({
              type: ajaxType,
              url: postdataURL,
              data: {
                  table_title: JSON.stringify(title_array),
                  table_data: JSON.stringify(graph_data)
              },
              success: function (data) {
                  jQuery(tblObj).html(data);

              }

          });
      }


      $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
          // Create the chart
          $('#container').highcharts('StockChart', {
              chart: {
                  events: {
                      redraw: function () {
                          highChartRedrawTable(this, "#testtbl");
                      },
                      load: function () {
                          highChartRedrawTable(this, "#testtbl");
                      }
                  }

              },
              rangeSelector: {
                  selected: true
              },
              title: {
                  text: 'AAPL Stock Price'
              },
              scrollbar: true,
              _navigator: {
                  enabled: false
              },
              navigator: {
                  enabled: true
              },
              series: [{
                      name: 'Line 1',
                      data: data,
                      tooltip: {
                          valueDecimals: 2
                      }
                  }, {
                      name: 'Line 2',
                      data: data,
                      tooltip: {
                          valueDecimals: 2
                      }
                  }]
          });
      });

  });
</script>