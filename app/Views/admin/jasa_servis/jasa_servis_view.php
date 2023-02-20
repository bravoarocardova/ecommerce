<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">
  <?php if (session()->has('msg')) : ?>
    <?= session()->getFlashdata('msg') ?>
  <?php endif ?>

  <div class="row">
    <div class="col-12 col-md-8 col-xl-8 d-flex order-2 order-md-1">
      <div class="card flex-fill">
        <div class="card-header">
          <h3>Jasa Servis</h3>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0" id="jasaServis">
            <thead>
              <tr>
                <th>Jasa Servis</th>
                <th>Kategori</th>
                <th>Biaya</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($jasa_servis as $j) : ?>
                <tr>
                  <td><?= $j['nama_jasa'] ?></td>
                  <td><?= $j['kategori'] ?></td>
                  <td>Rp. <?= number_format($j['biaya_jasa']) ?></td>
                  <td>
                    <button class="btn btn-warning" onclick="buttonEditClick(this)" data-id_jasa_servis="<?= $j['id_jasa_servis'] ?>" data-nama_jasa="<?= $j['nama_jasa'] ?>" data-kategori="<?= $j['kategori'] ?>" data-biaya_jasa="<?= $j['biaya_jasa'] ?>">
                      <i class="align-middle" data-feather="edit-3"></i> Edit
                    </button>
                    |
                    <form action="<?= base_url() . '/admin/jasa_servis/' . $j['id_jasa_servis'] ?>" method="POST" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash-2"></i> Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4 col-xl-4 d-flex order-1 order-md-2">
      <div class="card flex-fill">
        <div class="card-header">
          <h3 id="card-judul">Tambah Jasa Servis</h3>

        </div>
        <div class="card-body">

          <form action="" method="post" id="form-input">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="nama_jasa" class="form-label">Nama Jasa Servis</label>
              <input type="text" class="form-control <?= validation_show_error('nama_jasa') ? 'is-invalid' : '' ?>" id="nama_jasa" name="nama_jasa" value="<?= old('nama_jasa', '') ?>" placeholder="">
              <div class="invalid-feedback">
                <?= validation_show_error('nama_jasa') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <select class="form-select  <?= validation_show_error('kategori') ? 'is-invalid' : '' ?>" id="kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                <option value="Laptop" <?php if (old('kategori', '') == 'Laptop') echo 'selected' ?>>Laptop</option>
                <option value="Komputer" <?php if (old('kategori', '') == 'Komputer') echo 'selected' ?>>Komputer</option>
              </select>
              <div class="invalid-feedback">
                <?= validation_show_error('kategori') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="biaya_jasa" class="form-label">Biaya</label>
              <input type="number" class="form-control <?= validation_show_error('biaya_jasa') ? 'is-invalid' : '' ?>" id="biaya_jasa" name="biaya_jasa" value="<?= old('biaya_jasa', '') ?>" placeholder="">
              <div class="invalid-feedback">
                <?= validation_show_error('biaya_jasa') ?>
              </div>
            </div>
            <button type="submit" class="btn btn-success" id="btn_form_submit"><i class="align-middle" data-feather="check"></i> Simpan</button>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>

<script>
  function buttonEditClick(el) {

    const data = el.dataset;
    document.getElementById('card-judul').innerText = "Ubah Jasa Servis";
    document.getElementById('nama_jasa').value = data.nama_jasa;
    document.getElementById('kategori').value = data.kategori;
    document.getElementById('biaya_jasa').value = data.biaya_jasa;

    const form = document.getElementById('form-input');

    if (document.getElementById('inputMethod') == null) {
      const inputMethod = document.createElement('input');
      inputMethod.setAttribute('type', 'hidden');
      inputMethod.setAttribute('name', '_method');
      inputMethod.setAttribute('value', 'PUT');
      inputMethod.setAttribute('id', 'inputMethod');
      form.prepend(inputMethod);
    }

    if (document.getElementById('inputId') == null) {
      const inputId = document.createElement('input');
      inputId.setAttribute('type', 'hidden');
      inputId.setAttribute('name', 'id_jasa_servis');
      inputId.setAttribute('value', data.id_jasa_servis);
      inputId.setAttribute('id', 'inputId');
      form.prepend(inputId);
    } else {
      document.getElementById('inputId').value = data.id_jasa_servis;
    }

    const btn_form_submit = document.getElementById('btn_form_submit');
    btn_form_submit.classList.remove('btn-success');
    btn_form_submit.classList.add('btn-warning');
    btn_form_submit.innerText = 'Ubah';

    const btn_cancel = document.getElementById('btn_cancel');
    if (btn_cancel === null) {
      const btnCancel = document.createElement('button');
      btnCancel.setAttribute('type', 'reset');
      btnCancel.classList.add('btn', 'btn-danger');
      btnCancel.setAttribute('id', 'btn_cancel');
      btnCancel.setAttribute('onclick', 'batalEdit()');
      btnCancel.innerText = "Batal";

      form.append(btnCancel);
    }

  }

  function batalEdit() {
    const form = document.getElementById('form-input');
    form.reset();

    document.getElementById('card-judul').innerText = "Tambah Jasa Servis";

    document.getElementById('btn_cancel').remove();

    const btn_form_submit = document.getElementById('btn_form_submit');
    btn_form_submit.classList.remove('btn-warning');
    btn_form_submit.classList.add('btn-success');
    btn_form_submit.innerText = "Simpan";

    document.getElementById('inputMethod').remove();
    document.getElementById('inputId').remove();

  }

  $(document).ready(function() {
    $('#jasaServis').DataTable();
  });
</script>

<?= $this->endSection() ?>