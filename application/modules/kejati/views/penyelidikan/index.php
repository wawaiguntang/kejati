<div class="card mb-4">
    <div class="card-body px-5 pt-2 pb-2">
        <div class="d-flex justify-content-end mt-2">
            <?php echo ((in_array('CPENYELIDIKAN', $userPermission)) ? button('Tambah Penyelidikan', ["btn-primary"], ["onclick" => "addData()"]) : '') ?>
        </div>
        <div class="table-responsive">
            <?php echo table('penyelidikan', ['No Surat Tugas', 'No Nota Dinas', 'SOP', 'Perihal Pengaduan', 'Kategori', 'Aksi'], ['table-hover py-1 px-0 mx-0']); ?>
        </div>
    </div>
</div>