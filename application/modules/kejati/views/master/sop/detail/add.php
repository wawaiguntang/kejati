<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="infoKegiatan(<?php echo $id ?>)"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open('', ["id" => "form"]); ?>
        <div class="row">
            <?php echo inputWithFormGroup('Kegiatan', 'text', 'kegiatan', 'Kegiatan', [], []); ?>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <?php echo inputWithFormGroup('Waktu', 'number', 'waktu', 'Waktu', [], []); ?>
            </div>
            <div class="col-md-6 col-12">
                <?php echo selectWithFormGroup('satuan', 'Satuan', 'satuan', [
                    "menit" => "Menit",
                    "jam" => "Jam",
                    "hari" => "Hari"
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row" id="mustBeKelengkapan">
                    <div class="form-group">
                        <label class="form-control-label" for="">Kelengkapan</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Kelengkapan" name="kelengkapan[]">
                            <button class="btn btn-outline-primary mb-0" type="button" onclick="tambahKelengkapan()" id="btnTambahKelengkapan">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row" id="mustBeHasil">
                    <div class="form-group">
                        <label class="form-control-label" for="">Hasil</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Hasil" name="hasil[]">
                            <button class="btn btn-outline-primary mb-0" type="button" onclick="tambahHasil()" id="btnTambahHasil">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo inputWithFormGroup('Keterangan', 'text', 'keterangan', 'Keterangan', [], []); ?>
        <div class="d-flex justify-content-end">
            <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<div class="d-none">
    <div class="row" id="copyKelengkapan">
        <div class="input-group mb-1">
            <input type="text" class="form-control" placeholder="Kelengkapan" name="kelengkapan[]">
            <button class="btn btn-outline-primary mb-0" type="button" onclick="hapusKelengkapan(this)" id="btnHapusKelengkapan">Hapus</button>
        </div>
    </div>
    <div class="row" id="copyHasil">
        <div class="input-group mb-1">
            <input type="text" class="form-control" placeholder="Hasil" name="hasil[]">
            <button class="btn btn-outline-primary mb-0" type="button" onclick="hapusHasil(this)" id="btnHapusHasil">Hapus</button>
        </div>
    </div>
</div>

<script>
    function tambahKelengkapan() {
        var kelengkapan = $('#copyKelengkapan').clone();
        $('#mustBeKelengkapan').append(kelengkapan);
    }

    function hapusKelengkapan(element) {
        $(element).parent().parent().remove();
    }

    function tambahHasil() {
        var kelengkapan = $('#copyHasil').clone();
        $('#mustBeHasil').append(kelengkapan);
    }

    function hapusHasil(element) {
        $(element).parent().parent().remove();
    }
</script>