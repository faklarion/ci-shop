<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span>Formulir Supplier</span>
                </div>
                <div class="card-body">
                    <?= form_open($form_action, ['method' => 'POST']) ?>
                        <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <?= form_input('nama_supplier', $input->nama_supplier, ['class' => 'form-control', 'id' => 'nama_supplier', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('nama_supplier') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <?= form_input('alamat', $input->alamat, ['class' => 'form-control', 'id' => 'alamat', 'required' => true]) ?>
                            <?= form_error('alamat') ?>
                        </div>
                        <div class="form-group">
                            <label for="">No HP</label>
                            <?= form_input('no_hp', $input->no_hp, ['class' => 'form-control', 'id' => 'no_hp', 'required' => true]) ?>
                            <?= form_error('no_hp') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <?= form_input('email', $input->email, ['class' => 'form-control', 'id' => 'email', 'type' => 'email', 'required' => true]) ?>
                            <?= form_error('email') ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>