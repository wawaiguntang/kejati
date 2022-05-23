<div class="card mb-4">
    <div class="card-body px-5 pt-2 pb-2">
        <div class="d-flex justify-content-end">
            <?php echo ((in_array('CPENGADUAN', $userPermission)) ? '<i class="ri-add-circle-line ri-xl text-success m-3" role="button" title="Create" onclick="addData()"></i>' : '') ?>
        </div>
        <div class="table-responsive">
            <?php $header = (count(array_intersect($userPermission, ['UPENGADUAN', 'DPENGADUAN'])) > 0) ? ["No/Tanggal Pidsus","Asal Surat/Perihal", "Isi", "Action"] : ["No/Tanggal Pidsus","Asal Surat/Perihal", "Isi"]; ?>
            <?php echo table('pengaduan', $header, ['table-hover py-1 px-0 mx-0']); ?>
        </div>
    </div>
</div>