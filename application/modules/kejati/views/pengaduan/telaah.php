<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body px-2 pt-1 pb-1">
                <div class="row" hidden> <?= $id; ?></div>
                <div class="row">
                    <small><?= $no; ?></small>
                </div>
                <div class="row">
                    <small>Tanggal Surat :<?= $tanggal_surat; ?></small>
                </div>
                <div class="row">
                    <small>Tanggal Terima :<?= $tanggal_terima; ?></small>
                </div>
                <div class="row">
                    <small>Asal Surat :<?= $asal_surat; ?></small>
                </div>
                <div class="row mt-2">
                    <h4><?= $perihal; ?></h4>
                </div>
                <div class="row">
                    <p><?= $isi; ?></p>
                </div>
                <div class="row justify-content-end">
                    <div class="col-1 cursor-pointer" data-bs-dismiss="modal" onclick="updateTelaah(<?= $id; ?>, 'diterima')"> <span class="badge bg-gradient-info"><i class="fa-solid fa-check"></i> Terima</span></div>
                    <div class="col-1 cursor-pointer" data-bs-dismiss="modal" onclick="updateTelaah(<?= $id; ?>, 'ditolak')"> <span class="badge bg-gradient-danger"><i class="fa-solid fa-xmark"></i> Tolak</span></div>
                </div>
            </div>
        </div>
    </div>
</div>