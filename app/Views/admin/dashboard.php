<?= $this->extend('admin/layout/layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

  <div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="w-100">
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Penjualan Produk</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="truck"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $penjualan_produk['jumlah'] ?? 0 ?></h1>
                <div class="mb-0">
                  <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                  <span class="text-muted"></span>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Servis Masuk</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="sliders"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3"><?= $servis_masuk ?></h1>
                <div class="mb-0">
                  <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                  <span class="text-muted"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Pendapatan Penjualan</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="dollar-sign"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">Rp. <?= number_format($pendapatan_penjualan['pendapatan']) ?? 0 ?></h1>
                <div class="mb-0">
                  <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                  <span class="text-muted"></span>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Pendapatan Servis</h5>
                  </div>

                  <div class="col-auto">
                    <div class="stat text-primary">
                      <i class="align-middle" data-feather="dollar-sign"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">Rp. <?= number_format($pendapatan_servis['total_biaya']) ?></h1>
                <div class="mb-0">
                  <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                  <span class="text-muted"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-xxl-7">
      <div class="card flex-fill w-100">
        <div class="card-header">

          <h5 class="card-title mb-0">Recent Movement</h5>
        </div>
        <div class="card-body py-3">
          <div class="chart chart-sm">
            <canvas id="chartjs-dashboard-line"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
      <div class="card flex-fill w-100">
        <div class="card-header">

          <h5 class="card-title mb-0">Monthly Sales</h5>
        </div>
        <div class="card-body d-flex w-100">
          <div class="align-self-center chart chart-lg">
            <canvas id="chartjs-dashboard-bar"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
      <div class="card flex-fill">
        <div class="card-header">

          <h5 class="card-title mb-0">Calendar</h5>
        </div>
        <div class="card-body d-flex">
          <div class="align-self-center w-100">
            <div class="chart">
              <div id="datetimepicker-dashboard"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var cvs = document.getElementById("chartjs-dashboard-line");
    if (cvs != null) {
      var ctx = cvs.getContext("2d");
      var gradient = ctx.createLinearGradient(0, 0, 0, 225);
      gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
      gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
      // Line chart
      new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales (Rp.)",
            fill: true,
            backgroundColor: gradient,
            borderColor: window.theme.primary,
            data: <?= json_encode($chart_pendapatan) ?>
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          tooltips: {
            intersect: false
          },
          hover: {
            intersect: true
          },
          plugins: {
            filler: {
              propagate: false
            }
          },
          scales: {
            xAxes: [{
              reverse: true,
              gridLines: {
                color: "rgba(0,0,0,0.0)"
              }
            }],
            yAxes: [{
              ticks: {
                stepSize: 1000
              },
              display: true,
              borderDash: [3, 3],
              gridLines: {
                color: "rgba(0,0,0,0.0)"
              }
            }]
          }
        }
      });
    }
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
    var ctx = document.getElementById("chartjs-dashboard-bar");
    if (ctx != null) {
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "This year",
            backgroundColor: window.theme.primary,
            borderColor: window.theme.primary,
            hoverBackgroundColor: window.theme.primary,
            hoverBorderColor: window.theme.primary,
            data: <?= json_encode($chart_terjual) ?>,
            barPercentage: .75,
            categoryPercentage: .5
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false
              },
              stacked: false,
              ticks: {
                stepSize: 20
              }
            }],
            xAxes: [{
              stacked: false,
              gridLines: {
                color: "transparent"
              }
            }]
          }
        }
      });
    }
  });
</script>

<!-- Calender -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var date = new Date(Date.now() - 0 * 24 * 60 * 60 * 1000);
    var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
    var calenderdiv = document.getElementById("datetimepicker-dashboard");
    if (calenderdiv != null) {
      calenderdiv.flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: defaultDate
      });
    }
  });
</script>
<?= $this->endSection() ?>