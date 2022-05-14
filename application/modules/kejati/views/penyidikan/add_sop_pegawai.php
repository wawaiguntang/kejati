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
<div class="row">
    <div class="col-md-12">
        <?php echo selectWithFormGroup('jaksa', 'Jaksa', 'jaksa', $jaksa, '', []) ?>
    </div>
</div>
<div class="d-flex justify-content-end">
    <?php echo button('Add', ["btn-primary"], ["id" => "btnSave", "onclick" => "savePegawai()"]); ?>
</div>
<?php echo form_close(); ?>


<script>
    $(document).ready(function() {
        // $("#jaksa").select2({});
        // $(".select2-container").addClass('form-control');
    });
</script>
<style>
    .select2-dropdown {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        border-bottom-right-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
        border: 1px solid #d2d6da;
    }

    .select2-search__field {
        border: 1px solid #d2d6da;
        border-radius: 0.5rem;
    }

    .select2-container {
        padding: 0.35rem 0.075rem;
        margin: 0px;
    }

    .select2-selection {
        padding: 0px;
        margin: 0px;
        border: 0px !important;
    }

    .select2-selection__arrow {
        display: none;
    }
</style>