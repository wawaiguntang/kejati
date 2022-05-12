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
                                    <td><?php echo $tugas['no_surat_tugas'] ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-md" for="No Nota Dinas"><b>No Nota Dinas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas['no_nota_dinas'] ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-md" for="Tanggal Nota Dinas"><b>Tanggal Nota Dinas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas['tanggal_nota_dinas'] ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-md" for="Perihal Nota Dinas"><b>Perihal Nota Dinas</b></span></td>
                                    <td>:</td>
                                    <td><?php echo $tugas['perihal_nota_dinas'] ?></td>
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
                    </div>
                    <div class="mx-2">
                        <div class="card card-body p-2" style="border: 1px solid #D4D4D4;">
                            <div class="d-flex justify-content-between my-0 py-0 mb-1">
                                <span class="text-uppercase text-sm font-weight-bold" title="SOP">PERMINTAAN DAN PENERIMAAN DOKUMEN</span>
                                <span class="text-uppercase text-sm font-weight-bold" title="Waktu"><?php echo formatWaktu($tugas['sopWaktu']) ?></span>
                            </div>
                            <div class="card card-body py-1 mb-1 mx-1 px-2" style="border: 1px solid #D4D4D4;" id="kegiatan3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <span class="text-sm"><span class="badge <?php echo ($tugas['detail_tugasStatus'] == 'Ditinjau atasan' || $tugas['detail_tugasStatus'] == 'Dalam proses') ? 'bg-warning' : (($tugas['detail_tugasStatus'] == 'Ditolak') ? 'bg-danger' : 'bg-success') ?>"><?php echo $tugas['detail_tugasStatus'] ?></span></span>
                                            <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $tugas['kegiatan'] ?></span>
                                            <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $tugas['waktu'] ?> <?php echo $tugas['satuan'] ?></span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="text-xs" title="Ket">
                                                        <b>Kelengkapan: </b>
                                                        <div id="kelengkapanHTML3">
                                                            <ul class="mt-1">
                                                                <?php
                                                                foreach ($tugas['kelengkapan'] as $n => $m) {
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
                                                    <span class="text-xs" title="Ket">
                                                        <b>Hasil: </b>
                                                        <div id="kelengkapanHTML3">
                                                            <ul class="mt-1">

                                                                <?php
                                                                $push = FALSE;
                                                                foreach ($tugas['hasil'] as $n => $z) {
                                                                ?>
                                                                    <li>
                                                                        <?php
                                                                        if (isset($tugas['leader']['userCode']) && ($tugas['detail_tugasStatus'] == 'Dalam proses' || $tugas['detail_tugasStatus'] == 'Ditolak')) {
                                                                            if ($this->session->userdata('userCode') == $tugas['leader']['userCode']) {
                                                                        ?>
                                                                                <i class="ri-file-upload-line ri-lg text-success" role="button" title="Upload Hasil" onclick="uploadHasil(<?php echo $detail_tugas_id . ',' . $z['hasil_id'] ?>)"></i>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        echo $z['hasil'];
                                                                        $push = FALSE;
                                                                        ?>
                                                                        <?php
                                                                        if ($z['dokumen'] != NULL) {
                                                                            $push = TRUE;
                                                                        ?>
                                                                            <a href="<?php echo base_url('kejati/penyelidikan/download/' . encrypt('\assets\kejati\files\\' . $z['dokumen']) . '/' . $z['dokumen']) ?>" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Kelengkapan"></i></a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>

                                                        <?php if ($tugas['leader']['userCode'] == $this->session->userdata('userCode') && $push == TRUE && ($tugas['detail_tugasStatus'] == 'Dalam proses' || $tugas['detail_tugasStatus'] == 'Ditolak')) { ?>
                                                            <div class="d-flex justify-content-end">
                                                                <button class="btn btn-sm btn-primary" onclick="kirim(<?php echo $detail_tugas_id ?>)" title="Kirim ke atasan">Kirim ke atasan</button>
                                                            </div>
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="text-xs" title="Ket"><b>Ket: </b><?php echo $tugas['keterangan'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-md">Jaksa</span>
                                        </div>
                                        <table class="table table-sm">
                                            <tbody id="detail_tugas3">
                                                <?php
                                                foreach ($tugas['pegawai'] as $w => $a) {
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
                                <?php if ($tugas['leader']['userCode'] == $this->session->userdata('userCode')) { ?>
                                    <hr>
                                    <div class="row m-2">
                                        <span class="text-sm"><b>Detail Tugas Dari Ketua Tim</b></span>
                                        <table class="table table-sm">
                                            <tbody id="detail_tugas3">
                                                <?php
                                                foreach ($tugas['pegawai'] as $w => $a) {
                                                    if ($a['leader'] == 0) {
                                                ?>
                                                        <tr>
                                                            <td class="d-flex">
                                                                <div class="author align-items-center mb-1">
                                                                    <img src="<?php echo base_url('assets/img/pegawai/foto/' . $a['foto']) ?>" alt="..." class="avatar shadow">
                                                                    <div class="name ps-3">
                                                                        <span class=""><?php echo $a['nama'] ?> <?php echo (($tugas['detail_tugasStatus'] == 'Dalam proses' || $tugas['detail_tugasStatus'] == 'Ditolak')) ? '<i class="ri-add-circle-line ri-lg text-success" role="button" title="Bagi tugas untuk anggota" onclick="addTugasUntukAnggota(' . $a['pdtId'] . ',' . $detail_tugas_id . ')"></i>' : ''; ?></span>
                                                                        <div class="stats">
                                                                            <small><?php echo $a['leader'] == 1 ? 'Ketua Tim' : 'Anggota Tim' ?></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-xs">
                                                                <?php
                                                                if ($a['tugas'] == NULL) {
                                                                    echo "Tugas belum di atur";
                                                                } else {
                                                                    echo $a['tugas'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-xs">
                                                                <?php
                                                                if ($a['dokumen'] == NULL) {
                                                                    echo "Belum ada dokumen yang di upload";
                                                                } else {
                                                                    $dokumen = json_decode($a['dokumen'], true);
                                                                ?>
                                                                    <ul>
                                                                        <?php
                                                                        foreach ($dokumen as $k => $v) {
                                                                            echo '<li class="text-xs">' . $v['nama'] . '<a href="' . base_url("kejati/tugas/download/" . encrypt("\assets\kejati\dokumenTim\\" . $v['dokumen']) . "/" . $v['dokumen']) . '" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Hasil Tim"></i></a></li>';
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if ($tugas['dibuka'] == '1') { ?>
                                        <div class="d-flex justify-content-end">
                                            <button id="bagikan" class="btn btn-sm btn-primary" onclick="bagikan(<?php echo $detail_tugas_id ?>)">Bagikan</button>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <hr>
                                    <div class="row m-2">
                                        <div class="col-10"></div>
                                        <span class="text-sm"><b>Tugas Dari Ketua Tim</b></span>
                                        <?php
                                        foreach ($tugas['pegawai'] as $w => $a) {
                                            if ($a['userCode'] == $this->session->userdata('userCode')) {
                                        ?>
                                                <div class="row">
                                                    <div class="col-10">
                                                        <span class="text-xs mb-2">
                                                            <?php
                                                            if ($a['tugas'] == NULL) {
                                                                echo "Tugas belum di atur";
                                                            } else {
                                                                echo $a['tugas'];
                                                            }
                                                            ?>

                                                        </span>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn  p-2 bg-gradient-info position-relative" data-bs-toggle="modal" data-bs-target="#modal-default">
                                                            Konsultasi
                                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-gradient-danger">
                                                                99+
                                                                <span class="visually-hidden">unread messages</span>
                                                            </span>
                                                        </button>

                                                    </div>
                                                </div>
                                                <hr>
                                                <span class="text-sm"><b>Dokumen</b> <i class="ri-add-circle-line ri-lg text-success" role="button" title="Upload File" onclick="addFile(<?php echo $a['pdtId'] . ',' . $detail_tugas_id; ?>)"></i></span>
                                                <div class="text-xs">
                                                    <?php
                                                    if ($a['dokumen'] == NULL) {
                                                        echo "Belum ada dokumen yang di upload";
                                                    } else {
                                                        $dokumen = json_decode($a['dokumen'], true);
                                                    ?>
                                                        <ul>
                                                            <?php
                                                            foreach ($dokumen as $k => $v) {
                                                                echo '<li class="text-xs">' . $v['nama'] . '<a href="' . base_url("kejati/tugas/download/" . encrypt("\assets\kejati\dokumenTim\\" . $v['dokumen']) . "/" . $v['dokumen']) . '" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Hasil Tim"></i></a></li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                <?php } ?>

                                <!-- Modal Konsultasi -->
                                <div class="modal fade " id="modal-default" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="modal-default" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-notification">Konsultasi</h6>
                                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- jika belum ada pesan -->
                                                <!-- <div class="py-3 text-center">
                                                    <i class="ni ni-bell-55 ni-3x"></i>
                                                    <h4 class="text-gradient text-danger mt-3">Belum ada pesan</h4>
                                                    <p>Mulai konsultasi dengan ketua Tim</p>
                                                </div> -->
                                                <!-- jika sudah ada pesan -->
                                                <div id="list-konsul" class="card shadow-lg mb-1">
                                                    <div class="card-body pt-1">
                                                        <span class="badge bg-gradient-warning">Proses</span>

                                                        <a href="javascript:;" class="card-title h5 mt-3 d-block text-darker mb-0">
                                                            Tersangka Kabur
                                                        </a>
                                                        <p class="card-description mb-0">
                                                            Semalam Tersangka kbur dan belum ditemukan
                                                        </p>
                                                        <div class="row">
                                                            <small class="text-end">Posted on 28 February</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="list-konsul" class="card shadow-lg mb-1">
                                                    <div class="card-body pt-1">
                                                        <span class="badge bg-gradient-success">Selesai</span>
                                                        <a href="javascript:;" class="card-title h5 mt-3 d-block text-darker mb-0">
                                                            Tersangka Kabur
                                                        </a>
                                                        <p class="card-description mb-0">
                                                            Semalam Tersangka kbur dan belum ditemukan
                                                        </p>
                                                        <div class="row">
                                                            <small class="text-end">Posted on 28 February</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="chat-konsul" class="container" style="display: none;">
                                                    <span id="tutup-chat" class="badge bg-gradient-danger" style="cursor: pointer;">X</span>
                                                    <div class="row clearfix mb-1">
                                                        <div class="col-lg-12">
                                                            <div class="card chat-app">
                                                                <div class="chat">
                                                                    <div class="chat-header clearfix mb-1">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                                                                </a>
                                                                                <div class="chat-about">
                                                                                    <h6 class="m-b-0">Aiden Chavez</h6>
                                                                                    <small>Ketua Tim</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat-history">
                                                                        <ul class="m-b-0">
                                                                            <li class="clearfix mb-1">
                                                                                <div class="message-data text-end">
                                                                                    <span class="message-data-time">10:10 AM, Today</span>
                                                                                </div>
                                                                                <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                                                            </li>
                                                                            <li class="clearfix mb-1">
                                                                                <div class="message-data">
                                                                                    <span class="message-data-time">10:12 AM, Today</span>
                                                                                </div>
                                                                                <div class="message my-message">Are we meeting today?</div>
                                                                            </li>
                                                                            <li class="clearfix mb-1">
                                                                                <div class="message-data">
                                                                                    <span class="message-data-time">10:15 AM, Today</span>
                                                                                </div>
                                                                                <div class="message my-message">Project has been already finished and I have results to show you.</div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="chat-message clearfix mb-1">
                                                                        <div class="input-group mb-0">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fa fa-send"></i></span>
                                                                            </div>
                                                                            <input type="text" class="form-control" placeholder="Enter text here...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white">Ok, Got it</button>
                                                <button type="button" class="btn btn-link text-white ml-auto" data-bs-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- Akhir Modal Konsultasi -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="forModal"></div>
    <script>
        function addTugasUntukAnggota(id, detail_tugas_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/tugas/addTugasUntukAnggota',
                type: "POST",
                data: {
                    id: id,
                    detail_tugas_id: detail_tugas_id
                },
                success: function(data) {
                    if (data.status) {
                        $("#forModal").html(data.data);
                        $("#addTugasUntukAnggota").modal("show");
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function saveTugasUntukAnggota() {
            $("#btnSave").text("saving...");
            $("#btnSave").attr("disabled", true);
            var url, method;

            url = base_url + 'kejati/ajax/tugas/saveTugasUntukAnggota';
            method = "saved";

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: $("#id").val(),
                    detail_tugas_id: $("#detail_tugas_id").val(),
                    tugas: $("#tugas").val(),
                },
                dataType: "json",
                success: function(data) {
                    if (data.status) {
                        detail($("#detail_tugas_id").val());
                        $("#addTugasUntukAnggota").modal("hide");
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

        function bagikan(detail_tugas_id) {
            $("#bagikan").text("loading...");
            $("#bagikan").attr("disabled", true);
            $.ajax({
                url: base_url + 'kejati/ajax/tugas/bagikan',
                type: "POST",
                data: {
                    detail_tugas_id: detail_tugas_id
                },
                success: function(data) {
                    if (data.status) {
                        detail(detail_tugas_id);
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

        function addFile(id, detail_tugas_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/tugas/addFile',
                type: "POST",
                data: {
                    id: id,
                    detail_tugas_id: detail_tugas_id
                },
                success: function(data) {
                    if (data.status) {
                        $("#forModal").html(data.data);
                        $("#addFile").modal("show");
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function saveFile() {
            $("#btnSave").text("saving...");
            $("#btnSave").attr("disabled", true);
            var url, method;

            url = base_url + 'kejati/ajax/tugas/saveFile';
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
                        detail($("#detail_tugas_id").val());
                        $("#addFile").modal("hide");
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

        function kirim(detail_tugas_id = '') {
            $("#btnSave").text("mengirim...");
            $("#btnSave").attr("disabled", true);
            $.ajax({
                url: base_url + 'kejati/ajax/tugas/kirim',
                type: "POST",
                data: {
                    detail_tugas_id: detail_tugas_id,
                },
                success: function(data) {
                    if (data.status) {
                        handleToast("success", data.message);
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
                complete: function() {
                    detail(detail_tugas_id);
                },
            });
        }

        $('[id="list-konsul"]').click(function() {
            $(this).siblings().hide('fast')
            $('#chat-konsul').show('fast')
        })
        $('#tutup-chat').click(function() {
            $('#chat-konsul').hide('fast')
            $('[id="list-konsul"]').show()
        })
    </script>