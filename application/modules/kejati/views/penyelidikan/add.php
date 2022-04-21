<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-body px-5 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="back()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo  $title ?> </p>
                    </div>
                </div>
                <?php echo form_open('', ["id" => "form"]); ?>
                <?php echo input('hidden', 'id', '', [], ["value" => $id]); ?>
                <?php echo selectWithFormGroup('pengaduan', 'No Pengaduan', 'pengaduan', $pengaduan, '', ['form-control', 'form-select-transparent']) ?>
                <div class="row">
                    <div id="detailPengaduan"></div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?php echo inputWithFormGroup('Tanggal Surat', 'date', 'tanggal_surat', 'Tanggal Surat', [], ["value" => $tanggal_surat]); ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php echo inputWithFormGroup('Tanggal Terima', 'date', 'tanggal_terima', 'Tanggal Terima', [], ["value" => $tanggal_terima]); ?>
                    </div>
                </div>
                <?php echo inputWithFormGroup('Asal Surat', 'text', 'asal_surat', 'Asal Surat', [], ["value" => $asal_surat]); ?>
                <div class="form-group">
                    <label>Perihal</label>
                    <textarea class="form-control" name="perihal" placeholder="Perihal" rows="3"><?php echo $perihal; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Isi</label>
                    <textarea class="form-control" name="isi" placeholder="Isi" rows="3"><?php echo $isi; ?></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "save()"]); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').delegate("#pengaduan", "change", (e) => {
        var id = e.target.value;
        if (id == 0) {
            $("#detailPengaduan").html('');
        } else {
            $.ajax({
                url: base_url + 'kejati/ajax/penyelidikan/pengaduan',
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status) {
                        $("#detailPengaduan").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }
    });
</script>