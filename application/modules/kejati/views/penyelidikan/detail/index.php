<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body px-5 pt-2 pb-2">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between mt-2 py-auto">
                        <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="back()"></i>
                        <p class="pl-4 my-auto fw-bolder"> <?php echo $title ?> </p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tr>
                                    <td><span class="text-md" for="No Surat Tugas"><b>No Surat Tugas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas->no_surat_tugas ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-md" for="No Nota Dinas"><b>No Nota Dinas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas->no_nota_dinas ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-md" for="Tanggal Nota Dinas"><b>Tanggal Nota Dinas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas->tanggal_nota_dinas ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-md" for="Perihal Nota Dinas"><b>Perihal Nota Dinas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas->perihal_nota_dinas ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row mb-2">
                    <span class="text-md" for="pengaduan"><b>Pengaduan</b></span>
                    <div class="mx-2">
                        <?php echo $pengaduan ?>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between my-0 py-0 mt-3">
                        <span class="text-md align-middle"><b>SOP</b></span>
                        <i class="ri-add-circle-line ri-xl text-success" role="button" title="Create" onclick="addTugas()"></i>
                    </div>
                    <div class="row" id="addTugas" style="display: none;">
                        <div class="col-md-10">
                            <?php echo selectWithFormGroup('kegiatan', 'Kegiatan', 'kegiatan', $kegiatan, '', ['form-control-sm']) ?>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-primary" onclick="editKegiatanHTML()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="mx-2">
                        <div class="card card-body p-2" style="border: 1px solid #D4D4D4;">
                            <div class="d-flex justify-content-between my-0 py-0 mb-1">
                                <span class="text-uppercase text-sm font-weight-bold" title="SOP">PERMINTAAN DAN PENERIMAAN DOKUMEN</span>
                                <span class="text-uppercase text-sm font-weight-bold" title="Waktu"><?php echo formatWaktu($tugas->waktu) ?></span>
                            </div>
                            <?php $this->session->set_userdata('tugas_id', $detail_tugas[0]['tugas_id']);
                            foreach ($detail_tugas as $k => $v) { ?>
                                <div class="card card-body py-1 mb-1 mx-1 px-2" style="border: 1px solid #D4D4D4;" id="kegiatan">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <span class="text-sm"><span class="badge <?php echo ($v['status'] == 'Ditinjau atasan' || $v['status'] == 'Dalam proses') ? 'bg-warning' : (($v['status'] == 'Ditolak') ? 'bg-danger' : 'bg-success') ?>"><?php echo $v['status'] ?></span></span>
                                                <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $v['kegiatan'] ?></span>
                                                <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $v['waktu'] ?> <?php echo $v['satuan'] ?></span>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="text-xs">
                                                            <b>Kelengkapan: </b>
                                                            <div id="kelengkapanHTML">
                                                                <ul class="mt-1">
                                                                    <?php
                                                                    foreach ($v['kelengkapan'] as $n => $m) {
                                                                    ?>
                                                                        <li>
                                                                            <?php echo $m['kelengkapan'] ?>
                                                                            <?php if ($m['dokumen'] != NULL) { ?>
                                                                                <a href="<?php echo base_url('kejati/penyelidikan/download/' . encrypt('\assets\kejati\files\\' . $m['dokumen']) . '/' . $m['dokumen']) ?>" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Kelengkapan"></i></a>
                                                                            <?php } ?>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="text-xs">
                                                            <b>Hasil: </b>
                                                            <div id="hasilHtml">
                                                                <ul class="mt-1">
                                                                    <?php
                                                                    foreach ($v['hasil'] as $n => $z) {
                                                                    ?>
                                                                        <li>
                                                                            <?php echo $z['hasil'] ?>
                                                                            <?php if ($z['dokumen'] != NULL) { ?>
                                                                                <a href="<?php echo base_url('kejati/penyelidikan/download/' . encrypt('\assets\kejati\files\\' . $z['dokumen']) . '/' . $z['dokumen']) ?>" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Kelengkapan"></i></a>
                                                                            <?php } ?>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <span class="text-xs" title="Ket"><b>Ket: </b><?php echo $v['keterangan'] ?></span>
                                            </div>
                                            <?php
                                            if (($v['status'] == 'Ditinjau atasan')) {
                                            ?>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-danger mr-1" onclick="tolak(<?php echo $v['detail_tugas_id'] ?>)" title="Tolak">Tolak</button>
                                                    <button class="btn btn-sm btn-primary" onclick="terima(<?php echo $v['detail_tugas_id'] ?>)" title="Terima">Terima</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-md">Jaksa</span>
                                            </div>
                                            <table class="table table-sm">
                                                <tbody id="detail_tugas">
                                                    <?php
                                                    foreach ($v['pegawai'] as $w => $a) {
                                                    ?>
                                                        <tr>
                                                            <td class="d-flex">
                                                                <div class="author align-items-center mb-1">
                                                                    <img src="<?php echo base_url('assets/img/pegawai/foto/' . $a['foto']) ?>" alt="..." class="avatar shadow">
                                                                    <div class="name ps-3">
                                                                        <span class=""><?php echo $a['nama'] ?></span>
                                                                        <div class="stats">
                                                                            <small><?php echo $a['leader'] == 1 ? 'Ketua Tim' : 'Anggota Tim' ?></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div id="test"></div>
                            <div class="row ">
                                <div class="col align-self-end">
                                    <button class="btn btn-primary btn-sm" id="simpan" type="button" style="display: none; " onclick="saveEditPenyelidikan()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="forModal"></div>


<script>
    function addTugas() {
        $("#addTugas").css('display', '');
    }

    function terima(detail_tugas_id = '') {
        $("#btnSave").text("mengirim...");
        $("#btnSave").attr("disabled", true);
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/terima',
            type: "POST",
            data: {
                detail_tugas_id: detail_tugas_id,
            },
            success: function(data) {
                if (data.status) {
                    handleToast("success", data.message);
                    detail(detail_tugas_id);
                    breadcrumb(data.breadcrumb);
                } else {
                    handleError(data);
                    $("#btnSave").text("Kirim ke atasan");
                    $("#btnSave").attr("disabled", false);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
                $("#btnSave").text("Kirim ke atasan");
                $("#btnSave").attr("disabled", false);
            },
        });
    }

    function tolak(detail_tugas_id = '') {
        $("#btnSave").text("mengirim...");
        $("#btnSave").attr("disabled", true);
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/tolak',
            type: "POST",
            data: {
                detail_tugas_id: detail_tugas_id,
            },
            success: function(data) {
                if (data.status) {
                    handleToast("success", data.message);
                    detail(detail_tugas_id);
                    breadcrumb(data.breadcrumb);
                } else {
                    handleError(data);
                    $("#btnSave").text("Kirim ke atasan");
                    $("#btnSave").attr("disabled", false);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
                $("#btnSave").text("Kirim ke atasan");
                $("#btnSave").attr("disabled", false);
            }
        });
    }

    function editKegiatanHTML() {
        $('#simpan').show();
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/editKegiatanHTML',
            type: "POST",
            data: {
                kegiatan_id: $("#kegiatan").val()
            },
            success: function(data) {
                if (data.status) {
                    $("#test").append(data.data);
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
                $('#simpan').hide()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function getKelengkapan(kegiatan_id) {
        id = kegiatan_id;

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

    function saveEditPenyelidikan() {
        $("#simpan").text("saving...");
        $("#simpan").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/penyelidikan/saveEdit';
        method = "saved";

        var formData = $("#kegiatan").serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.status) {
                    back();
                    handleToast("success", data.message);
                } else {
                    handleError(data);
                }
                $("#simpan").text("save");
                $("#simpan").attr("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding / update data");
                $("#simpan").text("save");
                $("#simpan").attr("disabled", false);
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

                    getPegawai(data.kegiatan_id);
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
</script>