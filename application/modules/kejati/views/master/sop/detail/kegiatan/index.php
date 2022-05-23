    <div class="row mt-2">
        <div class="col-md-6 col-sm-12 col-12">
            <h6 class="d-flex my-auto">Kelengkapan <?php echo ((in_array('CKELENGKAPANKEGIATAN', $userPermission)) ? '<i class="my-auto ri-add-circle-line ri-xl text-success" role="button" title="Tambah" onclick="addKelengkapanKegiatan(' . $kegiatan_id . ')"></i>' : '') ?></h6>
            <ul class="mt-3">
                <?php foreach ($kelengkapan as $k) { ?>
                    <li>
                        <?php echo ((in_array('DKELENGKAPANKEGIATAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-xl text-danger" role="button" title="Delete" onclick="deleteKelengkapanKegiatan(' . $k->id . ')"></i>' : '') ?>
                        <?php echo ((in_array('UKELENGKAPANKEGIATAN', $userPermission)) ? '<i class="ri-edit-2-line ri-xl text-warning" role="button" title="Update" onclick="editKelengkapanKegiatan(' . $k->id . ')"></i>' : '') ?>
                        <?php echo $k->kelengkapan ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
            <h6 class="d-flex my-auto">Hasil <?php echo ((in_array('CHASILKEGIATAN', $userPermission)) ? '<i class="my-auto ri-add-circle-line ri-xl text-success" role="button" title="Tambah" onclick="addHasilKegiatan(' . $kegiatan_id . ')"></i>' : '') ?></h6>
            <ul class="mt-3">
                <?php foreach ($hasil as $h) { ?>
                    <li>
                        <?php echo ((in_array('DHASILKEGIATAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-xl text-danger" role="button" title="Delete" onclick="deleteHasilKegiatan(' . $h->id . ')"></i>' : '') ?>
                        <?php echo ((in_array('UHASILKEGIATAN', $userPermission)) ? '<i class="ri-edit-2-line ri-xl text-warning" role="button" title="Update" onclick="editHasilKegiatan(' . $h->id . ')"></i>' : '') ?>
                        <?php echo $h->hasil ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>



    <script>
        var base_url = '<?php echo base_url() ?>';
        var save_label = "add";

        function addKelengkapanKegiatan(id) {
            save_label = "add";
            $.ajax({
                url: base_url + 'kejati/ajax/sop/addKelengkapanHTML/' + id,
                type: "POST",

                success: function(data) {
                    if (data.status) {
                        $(".detailKegiatan").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function editKelengkapanKegiatan(id) {
            save_label = "update";
            $.ajax({
                url: base_url + 'kejati/ajax/sop/editKelengkapanHTML/' + id,
                type: "POST",

                success: function(data) {
                    if (data.status) {
                        $(".detailKegiatan").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function deleteKelengkapanKegiatan(id) {
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
                        url: base_url + 'kejati/ajax/sop/deleteKelengkapan/' + id,
                        type: "POST",

                        success: function(data) {
                            if (data.status) {
                                infoDetailKegiatan(<?php echo $kegiatan_id ?>);
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

        function addHasilKegiatan(id) {
            save_label = "add";
            $.ajax({
                url: base_url + 'kejati/ajax/sop/addHasilHTML/' + id,
                type: "POST",

                success: function(data) {
                    if (data.status) {
                        $(".detailKegiatan").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function editHasilKegiatan(id) {
            save_label = "update";
            $.ajax({
                url: base_url + 'kejati/ajax/sop/editHasilHTML/' + id,
                type: "POST",

                success: function(data) {
                    if (data.status) {
                        $(".detailKegiatan").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function deleteHasilKegiatan(id) {
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
                        url: base_url + 'kejati/ajax/sop/deleteHasil/' + id,
                        type: "POST",

                        success: function(data) {
                            if (data.status) {
                                infoDetailKegiatan(<?php echo $kegiatan_id ?>);
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