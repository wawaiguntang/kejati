<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="pangkat()"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open('', ["id" => "form"]); ?>
        <?php echo input('hidden', 'id', '', [], ["value" => $id]); ?>
        <?php echo inputWithFormGroup('Pangkat', 'text', 'pangkat', 'Pangkat', [], ["value" => $pangkat]); ?>
        <div class="d-flex justify-content-end">
            <?php echo button('Simpan', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>