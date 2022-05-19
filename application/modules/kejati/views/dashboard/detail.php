<div class="card card-body">
    <p class="text-sm text-bold my-0">Instruksi Umum</p>
    <?php foreach ($instruksi as $k => $v) { ?>
        <p class="text-xs my-0">- <?php echo $v['umum'] ?> <span class="text-bold"><?php echo $v['createAt'] ?></span></p>
    <?php } ?>
    <?php if ($leader == '0') { ?>
        <p class="text-sm text-bold my-1">Instruksi Khusus</p>
        <?php foreach ($tugas as $k => $v) { ?>
            <p class="text-xs my-0">- <?php echo $v['tugas'] ?> <span class="text-bold"><?php echo $v['createAt'] ?></span></p>
        <?php } ?>
        <hr>
        <?php foreach ($konsultasi as $k => $v) { ?>
            <div class="card card-body p-0">
                <div class="d-flex justify-content-between mx-1 mt-1">
                    <p class="text-xs text-bold my-0"><?php echo $v['judul'] ?></p>
                    <p class="text-xs text-bold my-0"><span class="badge <?php echo ($v['waktu_selesai'] == NULL ? 'bg-warning' : 'bg-success') ?>"><?php echo ($v['waktu_selesai'] == NULL ? 'Proses' : 'Selesai') ?></span></p>
                </div>
                <div class="d-flex justify-content-start mx-1 p-0">
                    <p class="text-xs my-0"><?php echo $v['deskripsi']?></p>
                </div>
                <div class="d-flex justify-content-end mx-1 mt-1">
                    <p class="text-xs text-bold my-0"><?php echo $v['postedOn']?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>