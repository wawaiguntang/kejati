<div class="d-flex justify-content-end my-4">
    <?php echo ((in_array('CPEGAWAI', $userPermission)) ? '<i class="ri-add-circle-line ri-xl text-success" role="button" title="Tambah" onclick="addData()"></i>' : '') ?>
</div>
<div class="table-responsive">
    <?php echo table('pegawai', ['Nama/Nip', 'Jabatan', 'Pangkat/Golongan', 'Akun', 'Aksi'], ['table-hover py-1 px-0 mx-0 table-sm']); ?>
</div>


<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    function addData() {
        save_label = "add";
        $.ajax({
            url: base_url + 'kejati/ajax/pegawai/addHTML',
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
            url: base_url + 'kejati/ajax/pegawai/editHTML/' + id,
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
            url = base_url + 'kejati/ajax/pegawai/add';
            method = "saved";
        } else {
            url = base_url + 'kejati/ajax/pegawai/update';
            method = "updated";
        }

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
                    pegawai();
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
                    url: base_url + 'kejati/ajax/pegawai/delete/' + id,
                    type: "POST",

                    success: function(data) {
                        if (data.status) {
                            pegawai();
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
<style>
    .example img {
        width: 100%;
        position: relative;
    }

    .example .overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        font-weight: bold;
        text-align: right;
        /* font-size: 30px; */
    }
</style>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="example">
                <img src="" id="imagepreview" class="rounded-lg" style="max-width: 100%;">
                <button type="button" class="btn-close text-dark overlay" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function imageModal(element) {
        $("#imagepreview").attr('src', $(element).attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    };
</script>