<div class="card card-body">
    <?php if (isset($pimpinan)) { ?>
        <p class="text-sm text-bold my-0">Jaksa</p>
        <?php foreach ($pegawai as $w => $a) { ?>
            <div class="author align-items-center mb-1">
                <img src="<?php echo base_url('assets/img/pegawai/foto/' . $a['foto']) ?>" alt="..." class="avatar shadow">
                <div class="name ps-3">
                    <p class="pb-0 mb-0 text-sm text-bold"><?php echo $a['nama'] ?></p>
                    <p class="text-xs py-0 my-0"><?php echo $a['leader'] == 1 ? 'Ketua Tim' : 'Anggota Tim' ?></p>
                </div>
            </div>
        <?php } ?>
        <hr>
    <?php } ?>
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
        <div class="koordinasiHtmlSelf">
            <p class="text-sm text-bold my-1">Koordinasi</p>
            <?php foreach ($konsultasi as $k => $v) { ?>
                <div class="card card-body p-1 shadow-lg" role="button" onclick="chat_self(<?php echo $pdtId ?>,<?php echo $id ?>,<?php echo $v['id'] ?>)">
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
        </div>
    <?php } else { ?>
        <hr>
        <div class="koordinasiHtml">
            <p class="text-sm text-bold my-1">Anggota</p>
            <?php
            foreach ($pegawai as $w => $a) {
            ?>
                <?php if ($a['leader'] != 1) { ?>
                    <div class="card card-body p-1 shadow-lg">
                        <div class="d-flex justify-content-between">
                            <div class="author align-items-center mb-1">
                                <img src="<?php echo base_url('assets/img/pegawai/foto/' . $a['foto']) ?>" alt="..." class="avatar shadow">
                                <div class="name ps-3">
                                    <p class="pb-0 mb-0 text-sm text-bold"><?php echo $a['nama'] ?></p>
                                    <p class="text-xs py-0 my-0"><?php echo $a['leader'] == 1 ? 'Ketua Tim' : 'Anggota Tim' ?></p>
                                </div>
                            </div>
                            <div class="d-flex text-sm align-items-center">
                                <span class="badge bg-primary" role="button" onclick="koordinasi(<?php echo $a['pdtId'] ?>,<?php echo $id ?>)">Koordinasi</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php
            }
            ?>
        </div>
    <?php } ?>
</div>