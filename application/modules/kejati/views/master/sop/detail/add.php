<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row mb-3">
            <div class="d-flex justify-content-between mt-2 py-auto">
                <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="infoKegiatan(<?php echo $id ?>)"></i>
                <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?></p>
            </div>
        </div>
        <?php echo form_open('', ["id" => "form"]); ?>
        <div class="row">
            <label for="">Kegiatan</label>
            <div class="form-group">
                <textarea name="kegiatan" id="kegiatan" rows="10"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <?php echo inputWithFormGroup('Waktu', 'number', 'waktu', 'Waktu', [], []); ?>
            </div>
            <div class="col-md-6 col-12">
                <?php echo selectWithFormGroup('satuan', 'Satuan', 'satuan', [
                    "menit" => "Menit",
                    "jam" => "Jam",
                    "hari" => "Hari"
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row" id="mustBeKelengkapan">
                    <div class="form-group">
                        <label class="form-control-label" for="">Kelengkapan</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Kelengkapan" id="valKelengkapan" required>
                            <button class="btn btn-outline-primary mb-0" type="button" onclick="tambahKelengkapan()" id="btnTambahKelengkapan">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row" id="mustBeHasil">
                    <div class="form-group">
                        <label class="form-control-label" for="">Hasil</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Hasil" id="valHasil" required>
                            <button class="btn btn-outline-primary mb-0" type="button" onclick="tambahHasil()" id="btnTambahHasil">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo inputWithFormGroup('Keterangan', 'text', 'keterangan', 'Keterangan', [], []); ?>
        <div class="d-flex justify-content-end">
            <?php echo button('Simpan', ["btn-primary"], ["id" => "btnSave", "onclick" => "saveKegiatan(" . $id . ")"]); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    function tambahKelengkapan() {
        const valKelengkapan = $("#valKelengkapan").val();
        $("#valKelengkapan").removeClass('is-invalid');
        if (valKelengkapan == null || valKelengkapan == 'undefined' || valKelengkapan == '') {
            $("#valKelengkapan").addClass('is-invalid');
        } else {
            var kelengkapan = `<div class="row" id="copyKelengkapan">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Kelengkapan" name="kelengkapan[]" id="kelengkapan" value="` + valKelengkapan + `" disabled>
                    <button class="btn btn-outline-primary mb-0" type="button" onclick="hapusKelengkapan(this)" id="btnHapusKelengkapan">Hapus</button>
                </div>
            </div>`;
            $('#mustBeKelengkapan').append(kelengkapan);
            $("#valKelengkapan").val("");
        }
    }

    function hapusKelengkapan(element) {
        $(element).parent().parent().remove();
    }

    function tambahHasil() {
        const valHasil = $("#valHasil").val();
        $("#valHasil").removeClass('is-invalid');
        if (valHasil == null || valHasil == 'undefined' || valHasil == '') {
            $("#valHasil").addClass('is-invalid');
        } else {
            var hasil = `<div class="row" id="copyHasil">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Hasil" name="hasil[]" id="hasil" value="` + valHasil + `" disabled>
                    <button class="btn btn-outline-primary mb-0" type="button" onclick="hapusHasil(this)" id="btnHapusHasil">Hapus</button>
                </div>
            </div>`
            $('#mustBeHasil').append(hasil);
            $("#valHasil").val("");
        }
    }

    function hapusHasil(element) {
        $(element).parent().parent().remove();
    }


    function saveKegiatan(id) {
        var formData = new FormData(this.form);
        sop_id = id;
        var hasil = $("input[name='hasil[]']")
            .map(function() {
                return $(this).val();
            }).get();

        var kelengkapan = $("input[name='kelengkapan[]']")
            .map(function() {
                return $(this).val();
            }).get();
        formData.append('sop_id', <?php echo $id ?>);
        formData.append('kegiatan', editorKegiatan.getData());
        formData.append('kelengkapan', kelengkapan);
        formData.append('hasil', hasil);

        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/sop/addKegiatan/' + id;
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
                    infoKegiatan(sop_id);
                    handleToast("success", data.message);
                } else {
                    ckKegiatan();
                    handleError(data);
                }
                delete("editorKegiatan");
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
        ckKegiatan()
    });

    if (typeof editorKegiatan === 'undefined') {
        let editorKegiatan;
    }

    function ckKegiatan() {
        ClassicEditor
            .create(document.querySelector('#kegiatan'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
            })
            .then(newEditor => {
                editorKegiatan = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>