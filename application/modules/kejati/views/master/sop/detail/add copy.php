<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="infoKegiatan(<?php echo $id ?>)"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open('', ["id" => "form"]); ?>
        <?php echo inputWithFormGroup('Kegiatan', 'text', 'kegiatan', 'Kegiatan', [], ["value" => $kegiatan]); ?>
        <div class="row">
            <div class="col-md-6 col-12">
                <?php echo inputWithFormGroup('Waktu', 'number', 'waktu', 'Waktu', [], ["value" => $waktu]); ?>
            </div>
            <div class="col-md-6 col-12">
                <?php echo selectWithFormGroup('satuan', 'Satuan', 'satuan', [
                    "menit" => "Menit",
                    "jam" => "Jam",
                    "hari" => "Hari"
                ], $satuan) ?>
            </div>
        </div>
        <div class="row">
            <?php echo inputWithFormGroup('Kelengkapan','text','kelengkapan[]','Kelengkapan') ?>
        </div>
        <?php echo inputWithFormGroup('Keterangan', 'text', 'keterangan', 'Keterangan', [], ["value" => $keterangan]); ?>
        <div class="d-flex justify-content-end">
            <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>