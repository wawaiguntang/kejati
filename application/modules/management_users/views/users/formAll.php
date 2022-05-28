<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body px-2 pt-2 pb-2">
                <div class="row mb-3">
                </div>
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'userCode', '', [], ["value" => $userCode]); ?>
                <?php echo inputWithFormGroup('Name', 'text', 'name', 'Name', [], ["value" => $name]); ?>
                <?php echo inputWithFormGroup('Email', 'email', 'email', 'Email', [], ["value" => $email]); ?>
                <?php echo inputWithFormGroup('Password', 'password', 'password', 'Password'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>