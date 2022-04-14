<div class="row mt-2">
    <div class="d-flex justify-content-center">
        <h4><?php echo $sop ?> </h4>
    </div>
</div>
<div class="row kegiatanHTML">
    <div class="col-md-6 col-12">
        <div class="d-flex justify-content-between my-3">
            <i title="back" role="button" class="ri-arrow-left-circle-line ri-lg my-auto text-danger" onclick="sop()"></i>
            <?php echo ((in_array('CKEGIATAN', $userPermission)) ? '<i class="ri-add-circle-line ri-xl text-success" role="button" title="Create" onclick="addKegiatan(' . $id . ')"></i>' : '') ?>
        </div>
        <div class="table-responsive">
            <?php echo table('kegiatan', ['Kegiatan', 'Waktu', 'Keterangan', 'Aksi'], ['table-hover py-1 px-0 mx-0']); ?>
        </div>
    </div>
    <div class="col-md-6 col-12">

    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    function addKegiatan(id) {
        save_label = "add";
        $.ajax({
            url: base_url + 'kejati/ajax/sop/addKegiatanHTML/' + id,
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $(".kegiatanHTML").html(data.data);
                    breadcrumb(data.breadcrumb);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function editKegiatan(id) {
        save_label = "update";
        $.ajax({
            url: base_url + 'kejati/ajax/sop/editKegiatanHTML/' + id,
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $(".kegiatanHTML").html(data.data);
                    breadcrumb(data.breadcrumb);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function saveKegiatan() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        if (save_label == "add") {
            url = base_url + 'kejati/ajax/sop/addKegiatan';
            method = "saved";
        } else {
            url = base_url + 'kejati/ajax/sop/updateKegiatan';
            method = "updated";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $("#form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    sop();
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

    function deleteData(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + 'kejati/ajax/sop/deleteKegiatan/' + id,
                    type: "POST",

                    success: function(data) {
                        if (data.status) {
                            sop();
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
        });
    }
</script>