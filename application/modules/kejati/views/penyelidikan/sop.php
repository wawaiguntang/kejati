<div class="card card-body p-2" style="border: 1px solid #D4D4D4;">
    <div class="d-flex justify-content-between my-0 py-0 mb-1">
        <span class="text-uppercase text-sm font-weight-bold" title="SOP"><?php echo $sop->sop ?></span>
        <span class="text-uppercase text-sm font-weight-bold" title="Waktu"><?php echo formatWaktu($sop->waktu) ?></span>
    </div>
    <div class="row">
        <div class="col-md-10">
            <?php echo selectWithFormGroup('kegiatan', 'Kegiatan', 'kegiatan', $kegiatan, '', ['form-control-sm']) ?>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-sm btn-primary" onclick="addKegiatanHTML()"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <div id="kegiatanHTML">

    </div>

</div>
<div id="forModal"></div>

<script>
    function getKegiatan(sop_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/getKegiatan',
            type: "POST",
            data: {
                sop_id: sop_id
            },
            success: function(data) {
                if (data.status) {
                    $("#kegiatan").html(data.data);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function addKegiatanHTML() {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/addKegiatanHTML',
            type: "POST",
            data: {
                kegiatan_id: $("#kegiatan").val()
            },
            success: function(data) {
                if (data.status) {
                    $("#kegiatanHTML").append(data.data);
                    getKelengkapan($("#kegiatan").val());
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function deleteKegiatanHTML(kegiatan_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/deleteKegiatanHTML',
            type: "POST",
            data: {
                kegiatan_id: kegiatan_id
            },
            success: function(data) {
                if (data.status) {
                    $("#kegiatan" + kegiatan_id).remove();
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function getPegawai(kegiatan_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/getPegawai',
            type: "POST",
            data: {
                kegiatan_id: kegiatan_id
            },
            success: function(data) {
                if (data.status) {
                    $("#detail_tugas" + kegiatan_id).html(data.data);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function addPegawaiHTML(kegiatan_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/addPegawaiHTML',
            type: "POST",
            data: {
                kegiatan_id: kegiatan_id
            },
            success: function(data) {
                if (data.status) {
                    $("#forModal").html(data.data);
                    $("#add_sop_pegawai").modal("show");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function savePegawai() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/penyelidikan/addPegawai';
        method = "saved";

        $.ajax({
            url: url,
            type: "POST",
            data: {
                kegiatan_id: $("#kegiatan_id").val(),
                jaksa: $("#jaksa").val(),
            },
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    getPegawai($("#kegiatan_id").val());
                    $("#add_sop_pegawai").modal("hide");
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

    function deletePegawai(kegiatan_id, jaksa) {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/penyelidikan/deletePegawai';
        method = "saved";

        $.ajax({
            url: url,
            type: "POST",
            data: {
                kegiatan_id: kegiatan_id,
                jaksa: jaksa,
            },
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    getPegawai(kegiatan_id);
                    $("#add_sop_pegawai").modal("hide");
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

    function getKelengkapan(kegiatan_id) {
        id = kegiatan_id;
        console.log(id);
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/getKelengkapan',
            type: "POST",
            data: {
                kegiatan_id: id
            },
            success: function(data) {
                if (data.status) {
                    $("#kelengkapanHTML" + id).html(data.data);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function uploadKelengkapan(kegiatan_id, kelengkapan_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/uploadKelengkapanHTML',
            type: "POST",
            data: {
                kegiatan_id: kegiatan_id,
                kelengkapan_id: kelengkapan_id,
            },
            success: function(data) {
                if (data.status) {
                    $("#forModal").html(data.data);
                    $("#upload_kelengkapan").modal("show");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function saveKelengkapan() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/penyelidikan/uploadKelengkapan';
        method = "saved";

        var formData = new FormData(this.form);
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
                    $("#upload_kelengkapan").modal("hide");
                    getKelengkapan(data.kegiatan_id);
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

    $("body").delegate("#setLeader", "click", (e) => {
        id = e.target.value;
        setLeader(id);
    });

    function setLeader(id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/setLeader',
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                if (data.status) {
                    getPegawai(3);
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function uploadHasil(kegiatan_id, hasil_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/uploadHasilHTML',
            type: "POST",
            data: {
                kegiatan_id: kegiatan_id,
                hasil_id: hasil_id,
            },
            success: function(data) {
                if (data.status) {
                    $("#forModal").html(data.data);
                    $("#upload_hasil").modal("show");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function saveHasil() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/penyelidikan/uploadHasil';
        method = "saved";

        var formData = new FormData(this.form);
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
                    $("#upload_hasil").modal("hide");
                    getKelengkapan(data.kegiatan_id);
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