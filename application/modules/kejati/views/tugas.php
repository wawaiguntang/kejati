<div class="data">
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";
    var tabActive = 'semua';
    $(document).ready(function() {
        <?php echo (isset($action)) ? $action : 'getData()' ?>
    });

    $('body').delegate("#semua", "click", () => {
        tabActive = 'semua';
    });

    $('body').delegate("#takeit", "click", () => {
        tabActive = 'takeit';
    });

    $('body').delegate("#delivery", "click", () => {
        tabActive = 'delivery';
    });

    $('body').delegate("#kurir", "click", () => {
        tabActive = 'kurir';
    });

    function back() {
        getData();
    }

    function getData() {
        $.ajax({
            url: base_url + 'kejati/ajax/tugas/data',
            type: "GET",

            success: function(data) {
                $(".data").html(data.data);
                breadcrumb(data.breadcrumb);
                let list = $("#tugas").DataTable({
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: {
                        url: base_url + 'kejati/ajax/tugas/list',
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


    function detail(tugas_id = '') {
        $.ajax({
            url: base_url + 'kejati/ajax/tugas/detail',
            type: "POST",
            data: {
                tugas_id: tugas_id,
            },
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

    function uploadHasil(detail_tugas_id, hasil_id) {
        $.ajax({
            url: base_url + 'kejati/ajax/tugas/uploadHasilHTML',
            type: "POST",
            data: {
                detail_tugas_id: detail_tugas_id,
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

        url = base_url + 'kejati/ajax/tugas/uploadHasil';
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
                    detail(data.tugas_id);
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