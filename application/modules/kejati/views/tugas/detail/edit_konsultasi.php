<div class="card p-4 shadow-lg">
    <div class="text-end mb-2">
        <span id="tutup-edit" class="badge bg-gradient-danger " onclick="tutupEdit()" style="cursor: pointer;">X</span>

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
    <form method="POST" id="form-edit-konsul">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text bg-gradient-faded-dark text-white" id="inputGroup-sizing-default">Judul</span>
                <input type="text" name="judul" class="form-control" aria-label="Sizing example input" value="<?= $konsultasi['judul']; ?>" aria-describedby="inputGroup-sizing-default" placeholder="Masukkan judul...">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text bg-gradient-faded-dark text-white">Deskripsi</span>
                <textarea class="form-control" name="deskripsi" aria-label="With textarea" placeholder="Masukkan deskripsi..."><?= $konsultasi['deskripsi']; ?></textarea>
            </div>
        </div>
        <input type="hidden" name='id_pegawai' value="<?= $konsultasi['id']; ?>">

        <button id='tombol-simpan' onclick="updateKonsul(<?= $konsultasi['id']; ?>)" class="btn btn-primary" type="button">simpan</button>
    </form>
</div>
<script>
    function updateKonsul(id_konsul) {
        $.ajax({
            url: base_url + 'kejati/ajax/konsultasi/edit/' + id_konsul,
            type: 'POST',
            data: $('#form-edit-konsul').serialize(),
            success: function(data) {

                if (data.status == false) {
                    $('#alert').html(data.message)

                    $('#alerts').show('slow')
                }
                tutupEdit()


            }
        })
    }
    // $('#from-tambah-konsul').submit(function() {

    // })
</script>