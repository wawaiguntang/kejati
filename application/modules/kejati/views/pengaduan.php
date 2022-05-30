<div class="data">
</div>
<!-- Modal -->
<div class="modal fade" id="telaahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu Telaah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-telaah">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    $(document).ready(function() {
        <?php echo (isset($action)) ? $action : 'getData()' ?>

    });

    function back() {
        getData();
    }

    function getData() {
        $.ajax({
            url: base_url + 'kejati/ajax/pengaduan/data',
            type: "GET",

            success: function(data) {
                $(".data").html(data.data);
                breadcrumb(data.breadcrumb);
                let list = $("#pengaduan").DataTable({
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: {
                        url: base_url + 'kejati/ajax/pengaduan/list',
                        type: "POST",
                    },
                    columnDefs: [{
                        targets: [-1],
                        orderable: false,
                    }, ],
                    language: {
                        paginate: {
                            previous: "<",
                            next: ">",
                        },
                    },
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function addData() {
        save_label = "add";
        $.ajax({
            url: base_url + 'kejati/ajax/pengaduan/addHTML',
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
            url: base_url + 'kejati/ajax/pengaduan/editHTML/' + id,
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
            url = base_url + 'kejati/ajax/pengaduan/add';
            method = "saved";
        } else {
            url = base_url + 'kejati/ajax/pengaduan/update';
            method = "updated";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $("#form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    back();
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
                    url: base_url + 'kejati/ajax/pengaduan/delete/' + id,
                    type: "POST",

                    success: function(data) {
                        if (data.status) {
                            back();
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

    function telaahData(id) {
        $.ajax({
            url: base_url + 'kejati/ajax/pengaduan/telaahHTML/' + id,
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $("#telaahModal").modal('show');
                    $('#modal-body-telaah').html(data.data);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function updateTelaah(id, status) {
        $.ajax({
            url: base_url + 'kejati/ajax/pengaduan/updateTelaah',
            type: "POST",
            data: {
                status: status,
                id: id
            },
            success: function(data) {
                if (data.status) {
                    handleToast("success", data.message);
                    back();
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