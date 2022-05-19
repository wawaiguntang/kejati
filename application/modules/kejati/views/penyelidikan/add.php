<div class="row">
    <div class="col-md-12">
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
                <?php echo inputWithFormGroup('No Surat Perintah Penyelidikan', 'text', 'no_surat_tugas', 'No Surat Perintah Penyelidikan',[],['id'=> 'no_surat_tugas']) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo inputWithFormGroup('No Nota Dinas', 'text', 'no_nota_dinas', 'No Nota Dinas',[],['id'=> 'no_nota_dinas']) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo inputWithFormGroup('Tanggal Nota Dinas', 'date', 'tanggal_nota_dinas', 'Tanggal Nota Dinas',[],['id'=> 'tanggal_nota_dinas']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Perihal Nota Dinas</label>
                    <textarea class="form-control" name="perihal_nota_dinas" id="perihal_nota_dinas" placeholder="Perihal Nota Dinas" rows="3"><?php echo $perihal; ?></textarea>
                </div>
                <?php echo selectWithFormGroup('pengaduan', 'No Pengaduan', 'pengaduan', $pengaduan, '', ['form-control', 'form-select-transparent']) ?>
                <div class="row">
                    <div id="detailPengaduan"></div>
                </div>
                <?php echo selectWithFormGroup('sop', 'SOP', 'sop', $sop, '', ['form-control', 'form-select-transparent']) ?>
                <div class="row">
                    <div id="detailSOP"></div>
                </div>
                <div class="row" id="mustBeTembusan">
                    <div class="form-group">
                        <label class="form-control-label" for="">Tembusan</label>
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Tembusan" id="tembusan" name="tembusan[]">
                            <button class="btn btn-outline-primary mb-0" type="button" onclick="tambahTembusan()" id="btnTambahTembusan">Tambah</button>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <?php echo button('Save', ["btn-primary"], ["id" => "btnSave", "onclick" => "savePenyelidikan()"]); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#pengaduan").select2({});
        $("#sop").select2({});
        $(".select2-container").addClass('form-control');
    });
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
    $('body').delegate("#sop", "change", (e) => {
        var id = e.target.value;
        if (id == 0) {
            $("#detailSOP").html('');
        } else {
            $.ajax({
                url: base_url + 'kejati/ajax/penyelidikan/sop',
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status) {
                        $("#detailSOP").html(data.data);
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

    function tambahTembusan() {
        var tembusan = `<div class="row" id="copyTembusan">
            <div class="input-group mb-1">
                <input type="text" class="form-control" placeholder="Tembusan" name="tembusan[]" value="">
                <button class="btn btn-outline-primary mb-0" type="button" onclick="hapusTembusan(this)" id="btnHapusTembusan">Hapus</button>
            </div>
        </div>`;
        $('#mustBeTembusan').append(tembusan);
    }

    function hapusTembusan(element) {
        $(element).parent().parent().remove();
    }
</script>