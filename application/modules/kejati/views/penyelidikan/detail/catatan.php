<div class="row mb-3">
    <div class="d-flex justify-content-between mt-2 py-auto">
        <p class="pl-4 my-auto fw-bolder">Catatan untuk ketua dan tim</p>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php echo form_open('', ["id" => "form"]); ?>
<?php echo input('hidden', 'detail_tugas_id', '', [], ["value" => $detail_tugas_id, 'id' => 'detail_tugas_id']); ?>
<?php echo input('hidden', 'tipe', '', [], ["value" => $tipe, 'id' => 'tipe']); ?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea class="form-control" id="catatan" rows="3"></textarea>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    <?php echo button('Tambah', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveCatatan()"]); ?>
</div>
<?php echo form_close(); ?>