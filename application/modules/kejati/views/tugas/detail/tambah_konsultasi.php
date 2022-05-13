<div class="card p-4 shadow-lg">
    <div class="row">
        <div class="col">

            <span id="tutup-tambah" class="badge bg-gradient-danger" style="cursor: pointer;">X</span>
        </div>
    </div>
    <form method="POST" action="<?= base_url('kejati/ajax/konsultasi/add/' . $id_pegawai) ?>" id="form-tambah-konsul">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text bg-gradient-faded-dark text-white" id="inputGroup-sizing-default">Judul</span>
                <input type="text" name="judul" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Masukkan judul...">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text bg-gradient-faded-dark text-white">Deskripsi</span>
                <textarea class="form-control" name="deskripsi" aria-label="With textarea" placeholder="Masukkan deskripsi..."></textarea>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
    </form>
</div>
<script>
    $('#from-tambah-konsul').submit(function() {


    })
    $('#tutup-tambah').click(function() {
        $('#tambah-konsultasi').hide('fast')
        $('#list-konsultasi').show()
    })

    function tampilChat(id) {

        $('#list-konsul' + id).siblings().hide('fast')
        $('#chat-konsul').show('fast')

    }
</script>