<div class="card p-4 shadow-lg">
    <div class="text-end mt-2 mb-2">

        <span id="tutup-tambah" class="badge bg-gradient-danger " onclick="backList()" style="cursor: pointer;">X</span>
    </div>
    <div class="row">
        <div class="col">
            <div id="alerts" class="alert alert-danger p-1 text-white alert-dismissible fade show" style="display: none;" role="alert">
                <span id="alert" class="alert-text">Semua Field harus terisi</span>
                <button type="button" class="text-white btn-close p-1" data-bs-dismiss="alert" aria-label="Close">
                    x
                </button>
            </div>
        </div>
    </div>
    <form method="POST" id="form-tambah-konsul<?= $id_pegawai; ?>">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text bg-bg-gradient-white border-end" id="inputGroup-sizing-default">Judul :</span>
                <input type="text" name="judul" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Masukkan judul...">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text bg-bg-gradient-white border-end">Deskripsi :</span>
                <textarea class="form-control" name="deskripsi" aria-label="With textarea" placeholder="Masukkan deskripsi..."></textarea>
            </div>
        </div>
        <input type="hidden" name='id_pegawai' value="<?= $id_pegawai; ?>">

        <button id='tombol-simpan' onclick="simpanKonsul(<?= $id_pegawai; ?>)" class="btn btn-primary" type="button">Simpan</button>
    </form>
</div>
<script>

</script>