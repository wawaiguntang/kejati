<div class="d-flex justify-content-between">
    <p class="text-sm text-bold my-1">Koordinasi</p>
    <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="detailTugas(<?php echo $id ?>)"></i>
</div>
<div class="card card-body p-1 shadow-lg">
    <div class="d-flex justify-content-between mx-1 mt-1">
        <p class="text-xs text-bold my-0"><?php echo $koordinasi['judul'] ?></p>
        <p class="text-xs text-bold my-0"><span class="badge <?php echo ($koordinasi['waktu_selesai'] == NULL ? 'bg-warning' : 'bg-success') ?>"><?php echo ($koordinasi['waktu_selesai'] == NULL ? 'Proses' : 'Selesai') ?></span></p>
    </div>
    <div class="d-flex justify-content-start mx-1 p-0">
        <p class="text-xs my-0"><?php echo $koordinasi['deskripsi'] ?></p>
    </div>
    <div class="d-flex justify-content-end mx-1 mt-1">
        <p class="text-xs my-0"><?php echo $koordinasi['postedOn'] ?></p>
    </div>
</div>
<div class="d-flex justify-content-between">
    <p class="text-xs text-bold my-1">Percakapan koordinasi</p>
</div>
<div class="card card-body p-1 shadow-lg" style="max-height: 40vh;overflow-y: scroll">
    <?php foreach ($chat as $k => $v) {
        if ($v['dari'] == $self['id']) {
    ?>
            <div class="d-flex justify-content-end mx-1 p-0 mt-1">
                <div>
                    <p class="text-xs text-bold my-0 text-end"><?php echo $self['nama'] ?></p>
                    <p class="text-xs my-0 text-end"><?php echo $v['pesan'] ?></p>
                    <p class="text-xs my-0 text-end"><?php echo $v['postedAd'] ?></p>
                </div>
            </div>
        <?php } else { ?>
            <div class="d-flex justify-content-start mx-1 mt-1">
                <div>
                    <p class="text-xs text-bold my-0"><?php echo $this->db->select('nama')->get_where('pegawai',['id' => $v['dari']])->row_array()['nama'] ?></p>
                    <p class="text-xs my-0"><?php echo $v['pesan'] ?></p>
                    <p class="text-xs my-0"><?php echo $v['postedAd'] ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>