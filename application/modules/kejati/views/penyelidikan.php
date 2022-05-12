<div class="data">
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    $(document).ready(function() {
        <?php echo (isset($action)) ? $action : 'getData();' ?>
        $("#noPengaduan").select2({});
        $(".select2-container").addClass('form-control');
    });

    function back() {
        getData();
    }

    function getData() {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/data',
            type: "GET",

            success: function(data) {
                $(".data").html(data.data);
                breadcrumb(data.breadcrumb);
                let list = $("#penyelidikan").DataTable({
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: {
                        url: base_url + 'kejati/ajax/penyelidikan/list',
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
            url: base_url + 'kejati/ajax/penyelidikan/addHTML',
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $("#headerContent").css('display', 'none');
                    $("#footerContent").css('display', 'none');
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

    $('body').delegate("#noPengaduan", "change", () => {
        var pengaduanTag = $("#noPengaduan").val();
        var cariTag = $("#Cari").val();
        getData(pengaduanTag, cariTag);
    });

    $('body').delegate("#Cari", "keyup", () => {
        var pengaduanTag = $("#noPengaduan").val();
        var cariTag = $("#Cari").val();
        getData(pengaduanTag, cariTag);
    });

    function savePenyelidikan() {
        $("#btnSave").text("saving...");
        $("#btnSave").attr("disabled", true);
        var url, method;

        url = base_url + 'kejati/ajax/penyelidikan/save';
        method = "saved";

        var formData = $("#form").serialize();
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

    function detail(tugas_id = '') {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/detail',
            type: "POST",
            data: {
                tugas_id: tugas_id,
            },
            success: function(data) {
                $("#headerContent").css('display', 'none');
                $("#footerContent").css('display', 'none');
                $(".data").html(data.data);
                breadcrumb(data.breadcrumb);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }
</script>