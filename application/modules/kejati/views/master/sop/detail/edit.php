<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="infoKegiatan(<?php echo $sop_id ?>)"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open('', ["id" => "form"]); ?>
        <?php echo input('hidden', 'kegiatan_id', '', [], ['value' => $kegiatan_id]) ?>
        <div class="row">
            <label for="">Kegiatan</label>
            <div class="form-group">
                <textarea name="kegiatan" id="kegiatan" rows="10"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <?php echo inputWithFormGroup('Waktu', 'number', 'waktu', 'Waktu', [], ['value' => $waktu]); ?>
            </div>
            <div class="col-md-6 col-12">
                <?php echo selectWithFormGroup('satuan', 'Satuan', 'satuan', [
                    "menit" => "Menit",
                    "jam" => "Jam",
                    "hari" => "Hari"
                ], $satuan) ?>
            </div>
        </div>
        <?php echo inputWithFormGroup('Keterangan', 'text', 'keterangan', 'Keterangan', [], ['value' => $keterangan]); ?>
        <div class="d-flex justify-content-end">
            <?php echo button('Simpan', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveKegiatan(" . $kegiatan_id . ")"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    function saveKegiatan(id) {
        var formData = new FormData(this.form);
        formData.append('kegiatan', editorKegiatanEdit.getData());
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;
        sop_id = id;
        url = base_url + 'kejati/ajax/sop/editKegiatan/' + id;
        method = "saved";


        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status) {
                    infoKegiatan(<?php echo $sop_id ?>);
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
                delete("editorKegiatanEdit");
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

    $(document).ready(function() {
        ckKegiatan();
    });

    if (typeof editorKegiatanEdit === 'undefined') {
        let editorKegiatanEdit;
    }

    function ckKegiatan() {
        ClassicEditor
            .create(document.querySelector('#kegiatan'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
            })
            .then(newEditor => {
                editorKegiatanEdit = newEditor;
                editorKegiatanEdit.setData("<?php echo $kegiatan ?>");
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>