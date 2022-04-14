<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="pegawai()"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open_multipart('', ["id" => "form"]); ?>
        <?php echo input('hidden', 'id', '', [], ["value" => $id]); ?>
        <?php echo inputWithFormGroup('Nama', 'text', 'nama', 'Nama', [], ["value" => $nama]); ?>
        <?php echo inputWithFormGroup('Foto', 'file', 'foto', 'Foto', []); ?>
        <?php echo inputWithFormGroup('NIP', 'text', 'nip', 'NIP', [], ["value" => $nip]); ?>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <?php echo selectWithFormGroup('jabatan_id', 'Jabatan', 'jabatan_id', $jabatan, $jabatan_id); ?>
            </div>
            <div class="col-md-4 col-sm-12">
                <?php echo selectWithFormGroup('pangkat_id', 'Pangkat', 'pangkat_id', $pangkat, $pangkat_id); ?>
            </div>
            <div class="col-md-4 col-sm-12">
                <?php echo selectWithFormGroup('golongan_id', 'Golongan', 'golongan_id', $golongan, $golongan_id); ?>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <?php echo selectWithFormGroup('userCode', 'Akun', 'userCode', $user, $userCode); ?>
        </div>
        <div class="d-flex justify-content-end">
            <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>