<?= $this->extend('admin/layout/layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <div class="row justify-content-center">
    <div class="col-10 col-md-8">
      <div class="card flex-fill">
        <div class="card-header">
          <h3 class="text-center">Laporan Data Penjualan</h3>

        </div>
        <div class="card-body">
          <form action="" method="post" target="_blank">
            <div class="row">
              <div class="col-sm-6 text-center">
                Tanggal
              </div>
              <div class="col-sm-5 pb-4">
                <div class="input-group input-group-outline">
                  <input type="text" class="form-control text-center" name="tanggal" id="tanggal">
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="align-middle" data-feather="printer"></i> Cetak Laporan
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>

</div>

<script>
  $(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
      $('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }

    $('#tanggal').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
        '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
          'month').endOf('month')],
        'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
        'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
          .endOf('year')
        ]
      }
    }, cb);

    cb(start, end);
  });
</script>

<?= $this->endSection() ?>