<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-0">

  <?php if (session()->has('msg')) : ?>
    <?= session()->getFlashdata('msg') ?>
  <?php endif ?>

  <div class="row">
    <div class="col-md-3 col-xl-2">

      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Form</h5>
        </div>

        <div class="list-group list-group-flush" role="tablist">
          <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
            Edit
          </a>

        </div>
      </div>
    </div>

    <div class="col-md-9 col-xl-10">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="account" role="tabpanel">

          <div class="card">
            <div class="card-header">

              <h5 class="card-title mb-0">Produk Info</h5>
            </div>
            <div class="card-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="put">
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label class="form-label" for="inputNamaProduk">Nama Produk</label>
                      <input type="text" class="form-control <?= validation_show_error('nama_produk') ? 'is-invalid' : '' ?>" id="inputNamaProduk" name="nama_produk" placeholder="Nama Produk" value="<?= old('nama_produk', $data_produk['nama_produk']) ?>">
                      <div class="invalid-feedback">
                        <?= validation_show_error('nama_produk') ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputHargaProduk">Harga</label>
                          <input type="number" class="form-control <?= validation_show_error('harga_produk') ? 'is-invalid' : '' ?>" id="inputHargaProduk" min="0" name="harga_produk" placeholder="Harga Produk" value="<?= old('harga_produk', $data_produk['harga_produk']) ?>">
                          <div class="invalid-feedback">
                            <?= validation_show_error('harga_produk') ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputKondisi">Kondisi</label>
                          <select name="kondisi" id="inputKondisi" class="form-control <?= validation_show_error('kondisi') ? 'is-invalid' : '' ?>">
                            <option value="Baru" <?php if (old('kondisi', $data_produk['kondisi_produk']) == 'Baru') echo 'selected' ?>>Baru</option>
                            <option value="Second" <?php if (old('kondisi', $data_produk['kondisi_produk']) == 'Second') echo 'selected' ?>>Second</option>
                          </select>
                          <div class="invalid-feedback">
                            <?= validation_show_error('kondisi') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputStok">Stok</label>
                          <input type="number" class="form-control <?= validation_show_error('stok') ? 'is-invalid' : '' ?>" id="inputStok" min="0" name="stok" placeholder="Stok" value="<?= old('stok', $data_produk['stok_produk']) ?>">
                          <div class="invalid-feedback">
                            <?= validation_show_error('stok') ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="inputBerat">Berat (g)</label>
                          <input type="number" class="form-control <?= validation_show_error('berat') ? 'is-invalid' : '' ?>" id="inputBerat" min="0" name="berat" placeholder="Berat" value="<?= old('berat', $data_produk['berat_produk']) ?>">
                          <div class="invalid-feedback">
                            <?= validation_show_error('berat') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="inputDeskripsi">Deskripsi</label>
                      <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : '' ?>" name="deskripsi" id="inputDeskripsi" cols="30" rows="5"><?= old('deskripsi', $data_produk['deskripsi_produk']) ?></textarea>
                      <div class="invalid-feedback">
                        <?= validation_show_error('deskripsi') ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="text-center mb-3">
                      <img alt="" src="<?= base_url() . '/img/produk/' . $data_produk['foto_produk'] ?>" class="rounded img-responsive mt-2" width="128" height="128" id="img-profile-upload">
                      <div class="mt-2">
                        <label for="foto">
                          <span class="btn btn-primary"><i class="fas fa-upload"></i> Pilih Foto</span>
                        </label>
                        <input type="file" name="foto_produk" id="foto" class="d-none <?= validation_show_error('foto_produk') ? 'is-invalid' : '' ?>" onchange="document.getElementById('img-profile-upload').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback">
                          <?= validation_show_error('foto_produk') ?>
                        </div>
                      </div>
                      <small>Max 4MB .jpg|.png|.jpeg format</small>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<script>
  var editor = new FroalaEditor('#inputDeskripsi', {
    toolbarButtons: {

      'moreText': {

        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']

      },

      'moreParagraph': {

        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']

      },

      'moreRich': {

        'buttons': ['insertLink', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertHR']

      },

      'moreMisc': {

        'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],

        'align': 'right',

        'buttonsVisible': 2

      }

    }
  });
</script>
<?= $this->endSection() ?>