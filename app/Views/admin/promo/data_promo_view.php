<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <?php if (session()->has('msg')) : ?>
    <?= session()->getFlashdata('msg') ?>
  <?php endif ?>

  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h3>Data Promosi Gambar</h3>

              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#promosiGambar">
                <i class="align-middle" data-feather="plus-circle"></i> Tambah Promosi Gambar
              </button>

            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataPromosiGambar">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar Promosi</th>
                <th>Tanggal Dibuat</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data_promo as $r) : ?>
                <?php
                if (!in_array($r['tipe_promosi'], ['gambar'])) {
                  continue;
                }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                    <img src="<?= base_url() . '/img/promosi/' . $r['gambar'] ?>" class="img-fluid rounded me-1" style="width:100px" />
                  </td>
                  <td><?= $r['created_at'] ?></td>
                  <td>
                    <form action="<?= base_url() . '/admin/promosi/' . $r['id_promosi'] ?>" method="POST" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Apakah anda yakin?')">
                        <i class="align-middle" data-feather="trash-2"></i>
                        <!-- Delete -->
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-xxl-10 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h3>Data Promosi Text</h3>

              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#promosiText">
                <i class="align-middle" data-feather="plus-circle"></i> Tambah Promosi Text
              </button>

            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="dataPromosiText">
            <thead>
              <tr>
                <th>No</th>
                <th>Text Promosi</th>
                <th>Tanggal Dibuat</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data_promo as $r) : ?>
                <?php
                if (!in_array($r['tipe_promosi'], ['text'])) {
                  continue;
                }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $r['text'] ?></td>
                  <td><?= $r['created_at'] ?></td>
                  <td>
                    <form action="<?= base_url() . '/admin/promosi/' . $r['id_promosi'] ?>" method="POST" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Apakah anda yakin?')">
                        <i class="align-middle" data-feather="trash-2"></i>
                        <!-- Delete -->
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Modal Promosi Gambar -->
<div class="modal fade" id="promosiGambar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Tambah Gambar</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>/admin/promosi/tambah" method="post" id="form-input" enctype="multipart/form-data">
        <div class="modal-body">
          <?= csrf_field() ?>
          <input type="hidden" name="tipe" value="gambar">
          <div class="text-center mb-3">
            <img alt="" src="" class="rounded img-responsive mt-2" width="168" height="128" id="img-profile-upload">
            <div class="mt-2">
              <label for="gambar">
                <span class="btn btn-primary"><i class="fas fa-upload"></i> Pilih Gambar</span>
              </label>
              <input type="file" name="gambar" id="gambar" class="d-none <?= validation_show_error('gambar') ? 'is-invalid' : '' ?>" onchange="document.getElementById('img-profile-upload').src = window.URL.createObjectURL(this.files[0])">
              <div class=" invalid-feedback">
                <?= validation_show_error('gambar') ?>
              </div>
            </div>
            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success"><i class="align-middle" data-feather="check"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Promosi Text-->
<div class="modal fade" id="promosiText" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">Tambah Text</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>/admin/promosi/tambah" method="post" id="form-input">
        <div class="modal-body">
          <?= csrf_field() ?>
          <input type="hidden" name="tipe" value="text">
          <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <input type="text" class="form-control <?= validation_show_error('text') ? 'is-invalid' : '' ?>" id="text" name="text" value="<?= old('text', '') ?>" placeholder="" required>
            <div class="invalid-feedback">
              <?= validation_show_error('text') ?>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success"><i class="align-middle" data-feather="check"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#dataPromosiGambar').DataTable();
    $('#dataPromosiText').DataTable();
  });
</script>
<?= $this->endSection() ?>