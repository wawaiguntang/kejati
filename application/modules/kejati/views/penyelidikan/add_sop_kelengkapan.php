<div class="row mb-3">
    <div class="d-flex justify-content-between mt-2 py-auto">
        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php echo form_open('', ["id" => "form"]); ?>
<?php echo input('hidden', 'kegiatan_id', '', [], ["value" => $kegiatan_id, 'id' => 'kegiatan_id']); ?>
<?php echo input('hidden', 'kelengkapan_id', '', [], ["value" => $kelengkapan_id, 'id' => 'kelengkapan_id']); ?>
<?php echo inputWithFormGroup('File', 'file', 'file') ?>
<div class="d-flex justify-content-end">
    <?php echo button('Add', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveKelengkapan()"]); ?>
</div>
<?php echo form_close(); ?>