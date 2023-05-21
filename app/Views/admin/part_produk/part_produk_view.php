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
          <h3>Part Produk</h3>
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
              <?php foreach ($part_produk as $j) : ?>
                <tr>
                  <td><?= $j['nama_part'] ?></td>
                  <td><?= $j['kategori'] ?></td>
                  <td>Rp. <?= number_format($j['biaya_part']) ?></td>
                  <td>
                    <button class="btn btn-warning" onclick="buttonEditClick(this)" data-id_part_produk="<?= $j['id_part_produk'] ?>" data-nama_part="<?= $j['nama_part'] ?>" data-kategori="<?= $j['kategori'] ?>" data-biaya_part="<?= $j['biaya_part'] ?>">
                      <i class="align-middle" data-feather="edit-3"></i> Edit
                    </button>
                    |
                    <form action="<?= base_url() . '/admin/part_produk/' . $j['id_part_produk'] ?>" method="POST" class="d-inline">
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
          <h3 id="card-judul">Tambah Part Produk</h3>

        </div>
        <div class="card-body">

          <form action="" method="post" id="form-input">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="nama_part" class="form-label">Nama Part</label>
              <input type="text" class="form-control <?= validation_show_error('nama_part') ? 'is-invalid' : '' ?>" id="nama_part" name="nama_part" value="<?= old('nama_part', '') ?>" placeholder="">
              <div class="invalid-feedback">
                <?= validation_show_error('nama_part') ?>
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
              <label for="biaya_part" class="form-label">Biaya</label>
              <input type="number" class="form-control <?= validation_show_error('biaya_part') ? 'is-invalid' : '' ?>" id="biaya_part" name="biaya_part" value="<?= old('biaya_part', '') ?>" placeholder="">
              <div class="invalid-feedback">
                <?= validation_show_error('biaya_part') ?>
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
    document.getElementById('card-judul').innerText = "Ubah Part Produk";
    document.getElementById('nama_part').value = data.nama_part;
    document.getElementById('kategori').value = data.kategori;
    document.getElementById('biaya_part').value = data.biaya_part;

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
      inputId.setAttribute('name', 'id_part_produk');
      inputId.setAttribute('value', data.id_part_produk);
      inputId.setAttribute('id', 'inputId');
      form.prepend(inputId);
    } else {
      document.getElementById('inputId').value = data.id_part_produk;
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

    document.getElementById('card-judul').innerText = "Tambah Part Produk";

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