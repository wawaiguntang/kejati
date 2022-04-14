<div class="d-flex justify-content-end my-4">
    <?php echo ((in_array('CGOLONGAN', $userPermission)) ? '<i class="ri-add-circle-line ri-xl text-success" role="button" title="Create" onclick="addData()"></i>' : '') ?>
</div>
<div class="table-responsive">
    <?php echo table('golongan', ['Golongan', 'Aksi'], ['table-hover py-1 px-0 mx-0']); ?>
</div>


<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    function addData() {
        save_label = "add";
        $.ajax({
            url: base_url + 'kejati/ajax/golongan/addHTML',
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
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

    function editData(id) {
        save_label = "update";
        $.ajax({
            url: base_url + 'kejati/ajax/golongan/editHTML/' + id,
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
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

    function save() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        if (save_label == "add") {
            url = base_url + 'kejati/ajax/golongan/add';
            method = "saved";
        } else {
            url = base_url + 'kejati/ajax/golongan/update';
            method = "updated";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $("#form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    golongan();
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
                    url: base_url + 'kejati/ajax/golongan/delete/' + id,
                    type: "POST",

                    success: function(data) {
                        if (data.status) {
                            golongan();
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