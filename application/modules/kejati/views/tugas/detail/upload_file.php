<div class="row mb-3">
    <div class="d-flex justify-content-between mt-2 py-auto">
        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php echo form_open('', ["id" => "form"]); ?>
<?php echo input('hidden', 'detail_tugas_id', '', [], ["value" => $detail_tugas_id, 'id' => 'detail_tugas_id']); ?>
<?php echo input('hidden', 'id', '', [], ["value" => $id, 'id' => 'id']); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo inputWithFormGroup('Nama', 'text', 'nama', 'Nama', []); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php echo inputWithFormGroup('Dokumen', 'file', 'dokumen', 'Dokumen', []); ?>
    </div>
</div>
<div class="d-flex justify-content-end">
    <?php echo button('Add', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveFile()"]); ?>
</div>
<?php echo form_close(); ?>