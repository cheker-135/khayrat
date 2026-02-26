@extends('backend.layouts.master')
@section('title','KHAYRAT || TABLEAU DE BORD')
@section('main-content')
<div class="container-fluid">
    @include('backend.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Category Card -->
      <div class="col-xl-3 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-category h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Catégories</span>
                <h2 class="card-value">{{\App\Models\Category::countActiveCategory()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>
            </div>
            <div class="card-footer-mini">
              <span class="text-white-50"><i class="fas fa-check-circle mr-1"></i> Actives</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Products Card -->
      <div class="col-xl-3 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-products h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Produits</span>
                <h2 class="card-value">{{\App\Models\Product::countActiveProduct()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-cubes"></i>
              </div>
            </div>
            <div class="card-footer-mini">
              <span class="text-white-50"><i class="fas fa-box-open mr-1"></i> En stock</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Order Card -->
      <div class="col-xl-3 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-orders h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Commandes</span>
                <h2 class="card-value">{{\App\Models\Order::countActiveOrder()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-shopping-bag"></i>
              </div>
            </div>
            <div class="card-footer-mini">
              <span class="text-white-50"><i class="fas fa-sync mr-1"></i> À traiter</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Posts Card -->
      <div class="col-xl-3 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-posts h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Articles</span>
                <h2 class="card-value">{{\App\Models\Post::countActivePost()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-newspaper"></i>
              </div>
            </div>
            <div class="card-footer-mini">
              <span class="text-white-50"><i class="fas fa-pen mr-1"></i> Publiés</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="premium-chart-card shadow-sm h-100">
          <div class="card-header-premium">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line mr-2"></i> Aperçu des gains</h6>
          </div>
          <div class="card-body">
            <div class="chart-container-premium">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    
      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5 mb-4">
        <div class="premium-chart-card shadow-sm h-100">
          <div class="card-header-premium">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-pie mr-2"></i> Utilisateurs</h6>
          </div>
          <div class="card-body d-flex align-items-center justify-content-center">
            <div id="pie_chart" class="responsive-google-chart"></div>
          </div>
        </div>
      </div>
    </div>

<style>
/* ============================================================
   PREMIUM DASHBOARD STYLING
   ============================================================ */
.premium-card {
    border: none;
    border-radius: 16px;
    padding: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.premium-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.premium-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 150px;
    height: 150px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    pointer-events: none;
}

.card-category { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.card-products { background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); }
.card-orders   { background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); }
.card-posts    { background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); }

.card-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.8;
}
.card-value {
    font-size: 2rem;
    font-weight: 800;
    margin: 5px 0 0;
}
.card-icon {
    font-size: 2.5rem;
    opacity: 0.3;
    transition: all 0.3s ease;
}
.premium-card:hover .card-icon {
    opacity: 0.6;
    transform: scale(1.1) rotate(10deg);
}
.card-footer-mini {
    margin-top: 15px;
    font-size: 0.75rem;
}

/* Chart Cards */
.premium-chart-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 16px;
    overflow: hidden;
}
.card-header-premium {
    padding: 20px 25px;
    background: #fdfdfd;
    border-bottom: 1px solid #f1f1f1;
    color: #2d3748;
}
.chart-container-premium {
    height: 350px;
    position: relative;
}

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.card-entrance {
    animation: fadeInUp 0.5s ease backwards;
}
.card-entrance:nth-child(1) { animation-delay: 0.1s; }
.card-entrance:nth-child(2) { animation-delay: 0.2s; }
.card-entrance:nth-child(3) { animation-delay: 0.3s; }
.card-entrance:nth-child(4) { animation-delay: 0.4s; }

/* Google Chart Fix */
.responsive-google-chart {
    width: 100% !important;
    height: 320px !important;
}

/* Responsive Overrides */
@media (max-width: 768px) {
    .chart-container-premium { height: 250px; }
    .card-value { font-size: 1.5rem; }
}
</style>
    <!-- Content Row -->
    
  </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{-- pie chart --}}
<script type="text/javascript">
  var analytics = <?php echo $users; ?>

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart()
  {
      var data = google.visualization.arrayToDataTable(analytics);
      var options = {
          title : 'Utilisateurs enregistrés ces 7 derniers jours'
      };
      var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
      chart.draw(data, options);
  }
</script>
  {{-- line chart --}}
  <script type="text/javascript">
    const url = "{{route('product.order.income')}}";
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

      // Area Chart Example
      var ctx = document.getElementById("myAreaChart");

        axios.get(url)
              .then(function (response) {
                const data_keys = Object.keys(response.data);
                const data_values = Object.values(response.data);
                var myLineChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                      label: "Gains",
                      lineTension: 0.3,
                      backgroundColor: "rgba(78, 115, 223, 0.05)",
                      borderColor: "rgba(78, 115, 223, 1)",
                      pointRadius: 3,
                      pointBackgroundColor: "rgba(78, 115, 223, 1)",
                      pointBorderColor: "rgba(78, 115, 223, 1)",
                      pointHoverRadius: 3,
                      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                      pointHitRadius: 10,
                      pointBorderWidth: 2,
                      data:data_values,// [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                    }],
                  },
                  options: {
                    maintainAspectRatio: false,
                    layout: {
                      padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                      }
                    },
                    scales: {
                      xAxes: [{
                        time: {
                          unit: 'date'
                        },
                        gridLines: {
                          display: false,
                          drawBorder: false
                        },
                        ticks: {
                          maxTicksLimit: 7
                        }
                      }],
                      yAxes: [{
                        ticks: {
                          maxTicksLimit: 5,
                          padding: 10,
                          // Include a dollar sign in the ticks
                          callback: function(value, index, values) {
                            return number_format(value) + ' ' + '{{Helper::base_currency()}}';
                          }
                        },
                        gridLines: {
                          color: "rgb(234, 236, 244)",
                          zeroLineColor: "rgb(234, 236, 244)",
                          drawBorder: false,
                          borderDash: [2],
                          zeroLineBorderDash: [2]
                        }
                      }],
                    },
                    legend: {
                      display: false
                    },
                    tooltips: {
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      intersect: false,
                      mode: 'index',
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' ' + '{{Helper::base_currency()}}';
                        }
                      }
                    }
                  }
                });
              })
              .catch(function (error) {
              //   vm.answer = 'Error! Could not reach the API. ' + error
              console.log(error)
              });

  </script>
@endpush