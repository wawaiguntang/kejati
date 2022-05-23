<div class="card mb-4">
    <div class="card-body px-5 pt-4 pb-2">
        <div class="table-responsive">
            <?php $header = (count(array_intersect($userPermission, ['RDETAILTUGASSELF'])) > 0) ? ['No Surat Tugas', 'No Nota Dinas', 'SOP', 'Perihal Pengaduan',  'Aksi'] : ['No Surat Tugas', 'No Nota Dinas', 'SOP', 'Perihal Pengaduan']; ?>
            <?php echo table('tugas', $header, ['table-hover py-1 px-0 mx-0']); ?>
        </div>
    </div>
</div>