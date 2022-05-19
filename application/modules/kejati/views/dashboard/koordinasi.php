<div class="d-flex justify-content-between">
    <p class="text-sm text-bold my-1">Instruksi Khusus</p>
    <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="detailTugas(<?php echo $id ?>)"></i>
</div>
<?php foreach ($tugas as $k => $v) { ?>
    <p class="text-xs my-0">- <?php echo $v['tugas'] ?> <span class="text-bold"><?php echo $v['createAt'] ?></span></p>
<?php } ?>
<div class="d-flex justify-content-between">
    <p class="text-sm text-bold my-1">Koordinasi</p>
    
</div>
<?php foreach ($konsultasi as $k => $v) { ?>
    <div class="card card-body p-1 shadow-lg" role="button" onclick="chat(<?php echo $pdtId ?>,<?php echo $id ?>,<?php echo $v['id'] ?>)">
        <div class="d-flex justify-content-between mx-1 mt-1">
            <p class="text-xs text-bold my-0"><?php echo $v['judul'] ?></p>
            <p class="text-xs text-bold my-0"><span class="badge <?php echo ($v['waktu_selesai'] == NULL ? 'bg-warning' : 'bg-success') ?>"><?php echo ($v['waktu_selesai'] == NULL ? 'Proses' : 'Selesai') ?></span></p>
        </div>
        <div class="d-flex justify-content-start mx-1 p-0">
            <p class="text-xs my-0"><?php echo $v['deskripsi'] ?></p>
        </div>
        <div class="d-flex justify-content-end mx-1 mt-1">
            <p class="text-xs my-0"><?php echo $v['postedOn'] ?></p>
        </div>
    </div>
<?php } ?>