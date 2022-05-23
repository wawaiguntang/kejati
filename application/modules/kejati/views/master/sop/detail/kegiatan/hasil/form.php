<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="infoDetailKegiatan(<?php echo $kegiatan_id ?>)"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open('', ["id" => "form"]); ?>
        <?php echo input('hidden', 'kegiatan_id', '', [], ["value" => $kegiatan_id]); ?>
        <?php echo input('hidden', 'id', '', [], ["value" => $id]); ?>
        <?php echo inputWithFormGroup('Hasil', 'text', 'hasil', 'Hasil', [], ["value" => $hasil]); ?>
        <div class="d-flex justify-content-end">
            <?php echo button('Simpan', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = <?php echo $for ?>;

    function save() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        if (save_label == "add") {
            url = base_url + 'kejati/ajax/sop/addHasil';
            method = "saved";
        } else {
            url = base_url + 'kejati/ajax/sop/updateHasil';
            method = "updated";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $("#form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    infoDetailKegiatan(<?php echo $kegiatan_id?>);
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
                $("#btnSave").text("save");
                $("#btnSave").attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding / update data");
                $("#btnSave").text("save");
                $("#btnSave").attr("disabled", false);
            },
        });

        $("#form input, #form textarea").on("keyup", function() {
            $(this).removeClass("is-valid is-invalid");
        });
        $("#form select").on("change", function() {
            $(this).removeClass("is-valid is-invalid");
        });
    }
</script>