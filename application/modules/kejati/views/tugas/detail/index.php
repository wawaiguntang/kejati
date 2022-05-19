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
                                <span class="text-uppercase text-sm font-weight-bold" title="SOP"><?php echo $tugas['sop'] ?></span>
                                <span class="text-uppercase text-sm font-weight-bold" title="Waktu"><?php echo formatWaktu($tugas['waktu']) ?></span>
                            </div>
                            <?php
                            $pegawai = '';
                            foreach ($detail_tugas as $k => $g) {
                            ?>
                                <div class="card card-body py-1 mb-1 mx-1 px-2" style="border: 1px solid #D4D4D4;" id="kegiatan3">
                                    <?php if ($g['leader']['userCode'] == $this->session->userdata('userCode')) {
                                        if ($g['dibuka'] == '0') {
                                            $this->db->where(['id' => $g['id']])->update('detail_tugas', ['dibuka' => '1', 'waktu_mulai' => date('Y-m-d H:i:s')]);
                                        }
                                    ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <span class="text-sm"><span class="badge <?php echo ($g['detail_tugasStatus'] == 'Ditinjau atasan' || $g['detail_tugasStatus'] == 'Dalam proses') ? 'bg-warning' : (($g['detail_tugasStatus'] == 'Ditolak') ? 'bg-danger' : 'bg-success') ?>"><?php echo $g['detail_tugasStatus'] ?></span></span>
                                                    <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $g['kegiatan'] ?></span>
                                                    <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $g['waktu'] ?> <?php echo $g['satuan'] ?></span>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span class="text-xs" title="Ket">
                                                                <b>Kelengkapan: </b>
                                                                <div id="kelengkapanHTML3">
                                                                    <ul class="mt-1">
                                                                        <?php
                                                                        foreach ($g['kelengkapan'] as $n => $m) {
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
                                                                        foreach ($g['hasil'] as $n => $z) {
                                                                        ?>
                                                                            <li>
                                                                                <?php
                                                                                if (isset($g['leader']['userCode']) && ($g['detail_tugasStatus'] == 'Dalam proses' || $g['detail_tugasStatus'] == 'Ditolak')) {
                                                                                    if ($this->session->userdata('userCode') == $g['leader']['userCode']) {
                                                                                ?>
                                                                                        <i class="ri-file-upload-line ri-lg text-success" role="button" title="Upload Hasil" onclick="uploadHasil(<?php echo $g['id'] . ',' . $z['hasil_id'] ?>)"></i>
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

                                                                <?php if ($g['leader']['userCode'] == $this->session->userdata('userCode') && $push == TRUE && ($g['detail_tugasStatus'] == 'Dalam proses' || $g['detail_tugasStatus'] == 'Ditolak')) { ?>
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-sm btn-primary" onclick="kirim(<?php echo $g['id'] ?>)" title="Kirim ke atasan">Kirim ke atasan</button>
                                                                    </div>
                                                                <?php } ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs" title="Ket"><b>Ket: </b><?php echo $g['keterangan'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-md">Jaksa</span>
                                                </div>
                                                <table class="table table-sm">
                                                    <tbody id="detail_tugas3">
                                                        <?php
                                                        foreach ($g['pegawai'] as $w => $a) {
                                                        ?>
                                                            <?php if ($a['leader'] == 1) {
                                                                $leader = $a['pegawai_id'];
                                                            } ?>
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
                                        <hr>
                                        <div class="row m-2">
                                            <span class="text-sm"><b>Detail Tugas Dari Ketua Tim</b></span>
                                            <table class="table table-sm">
                                                <tbody id="detail_tugas3">
                                                    <?php

                                                    foreach ($g['pegawai'] as $w => $a) {
                                                        if ($a['leader'] == 0) {
                                                    ?>
                                                            <tr>
                                                                <td class="d-flex">
                                                                    <div class="author align-items-center mb-1">
                                                                        <img src="<?php echo base_url('assets/img/pegawai/foto/' . $a['foto']) ?>" alt="..." class="avatar shadow">
                                                                        <div class="name ps-3">
                                                                            <span class=""><?php echo $a['nama'] ?> <?php echo (($g['detail_tugasStatus'] == 'Dalam proses' || $g['detail_tugasStatus'] == 'Ditolak')) ? '<i class="ri-add-circle-line ri-lg text-success" role="button" title="Bagi tugas untuk anggota" onclick="addTugasUntukAnggota(' . $a['pdtId'] . ',' . $g['id'] . ')"></i>' : ''; ?></span>
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
                                                                            foreach ($dokumen as $k => $v) { ?>
                                                                                <?php echo '<li class="text-xs">' . $v['nama'] . '<a href="' . base_url("kejati/tugas/download/" . encrypt("\assets\kejati\dokumenTim\\" . $v['dokumen']) . "/" . $v['dokumen']) . '" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Hasil Tim"></i></a></li>'; ?>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <div class="col-2">
                                                                        <button type="button" class="btn  p-2 bg-gradient-info position-relative" onclick="cardKonsulKetua(<?= $a['pdtId']; ?>,<?= $g['id'] ?>,<?= $a['pegawai_id']; ?>,<?= $leader; ?>)">
                                                                            Konsultasi
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php if ($g['dibuka'] == '1') { ?>
                                            <div class="d-flex justify-content-end">
                                                <button id="bagikan" class="btn btn-sm btn-primary" onclick="bagikan(<?php echo $g['id'] ?>)">Bagikan</button>
                                            </div>
                                        <?php } ?>
                                        <?php
                                    } else {

                                        if ($g['dibuka'] == '0') {
                                        ?>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <span class="text-sm"><span class="badge <?php echo ($g['detail_tugasStatus'] == 'Ditinjau atasan' || $g['detail_tugasStatus'] == 'Dalam proses') ? 'bg-warning' : (($g['detail_tugasStatus'] == 'Ditolak') ? 'bg-danger' : 'bg-success') ?>"><?php echo $g['detail_tugasStatus'] ?></span></span>
                                                        <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $g['kegiatan'] ?></span>
                                                        <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $g['waktu'] ?> <?php echo $g['satuan'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <p class="text-bold">Tugas harus dibuka pertama kali oleh ketua tim</p>
                                            </div>
                                            <?php
                                        } else {
                                            if ($g['dibuka'] == '1') {
                                            ?>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <span class="text-sm"><span class="badge <?php echo ($g['detail_tugasStatus'] == 'Ditinjau atasan' || $g['detail_tugasStatus'] == 'Dalam proses') ? 'bg-warning' : (($g['detail_tugasStatus'] == 'Ditolak') ? 'bg-danger' : 'bg-success') ?>"><?php echo $g['detail_tugasStatus'] ?></span></span>
                                                            <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $g['kegiatan'] ?></span>
                                                            <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $g['waktu'] ?> <?php echo $g['satuan'] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <p class="text-bold">Ketua tim belum membagi tugas</p>
                                                </div>
                                            <?php
                                            } else {
                                            ?>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <span class="text-sm"><span class="badge <?php echo ($g['detail_tugasStatus'] == 'Ditinjau atasan' || $g['detail_tugasStatus'] == 'Dalam proses') ? 'bg-warning' : (($g['detail_tugasStatus'] == 'Ditolak') ? 'bg-danger' : 'bg-success') ?>"><?php echo $g['detail_tugasStatus'] ?></span></span>
                                                            <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $g['kegiatan'] ?></span>
                                                            <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $g['waktu'] ?> <?php echo $g['satuan'] ?></span>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <span class="text-xs" title="Ket">
                                                                        <b>Kelengkapan: </b>
                                                                        <div id="kelengkapanHTML3">
                                                                            <ul class="mt-1">
                                                                                <?php
                                                                                foreach ($g['kelengkapan'] as $n => $m) {
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
                                                                                foreach ($g['hasil'] as $n => $z) {
                                                                                ?>
                                                                                    <li>
                                                                                        <?php
                                                                                        if (isset($g['leader']['userCode']) && ($g['detail_tugasStatus'] == 'Dalam proses' || $g['detail_tugasStatus'] == 'Ditolak')) {
                                                                                            if ($this->session->userdata('userCode') == $g['leader']['userCode']) {
                                                                                        ?>
                                                                                                <i class="ri-file-upload-line ri-lg text-success" role="button" title="Upload Hasil" onclick="uploadHasil(<?php echo $g['id'] . ',' . $z['hasil_id'] ?>)"></i>
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

                                                                        <?php if ($g['leader']['userCode'] == $this->session->userdata('userCode') && $push == TRUE && ($g['detail_tugasStatus'] == 'Dalam proses' || $g['detail_tugasStatus'] == 'Ditolak')) { ?>
                                                                            <div class="d-flex justify-content-end">
                                                                                <button class="btn btn-sm btn-primary" onclick="kirim(<?php echo $g['id'] ?>)" title="Kirim ke atasan">Kirim ke atasan</button>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <span class="text-xs" title="Ket"><b>Ket: </b><?php echo $g['keterangan'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-md">Jaksa</span>
                                                        </div>
                                                        <table class="table table-sm">
                                                            <tbody id="detail_tugas3">
                                                                <?php
                                                                foreach ($g['pegawai'] as $w => $a) {

                                                                ?>

                                                                    <?php if ($a['leader'] == 1) {
                                                                        $leader = $a['pegawai_id'];
                                                                    } ?>
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
                                                <hr>
                                                <div class="row m-2">
                                                    <div class="col-10"></div>
                                                    <span class="text-sm"><b>Tugas Dari Ketua Tim</b></span>
                                                    <?php




                                                    foreach ($g['pegawai'] as $w => $a) {
                                                        if ($a['userCode'] == $this->session->userdata('userCode')) {
                                                    ?>
                                                            <div class="row list-konsultasi" id="list-<?= $a['pdtId']; ?>">
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
                                                                    <button type="button" class="btn  p-2 bg-gradient-info position-relative" onclick="cardKonsul(<?= $a['pdtId']; ?>,<?= $g['id'] ?>,<?= $leader; ?>,<?= $a['pegawai_id']; ?>)">
                                                                        Konsultasi
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <span class="text-sm"><b>Dokumen</b>
                                                                <?php if ($g['detail_tugasStatus'] != "Diterima") { ?>
                                                                    <i class="ri-add-circle-line ri-lg text-success" role="button" title="Upload File" onclick="addFile(<?php echo $a['pdtId'] . ',' . $g['id']; ?>)"></i>
                                                                <?php } ?>
                                                            </span>
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
                                        <?php

                                            }
                                        }
                                        ?>
                                    <?php } ?>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Konsultasi -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-konsultasi" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-xl  modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Konsultasi</h6>
                    <button id="close-modal1" type="button" class="btn-close text-dark" data-bs-dismiss="modal" onclick="clearModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!-- <input id="pegawai-detail-tugas-id" type="hidden" value="">
                    <input id="detail-tugas-id" type="hidden" value="<?= $a['detail_tugas_id'] ?>">
                    <div id="list-konsultasi"></div>
                    <div id="chat-konsultasi"></div>
                    <div id="tambah-konsultasi"></div>
                    <div id="edit-konsultasi"></div>
                 -->

                </div>
                <div class="modal-footer">
                    <button id="close-modal2" type="button" class="btn btn-link  ml-auto" onclick="clearModal()" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>

    </div>
    <!-- Akhir Modal Konsultasi -->
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
                        detail(<?php echo $tugas_id ?>);
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
                        detail(<?php echo $tugas_id ?>);
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
                        detail(<?php echo $tugas_id ?>);
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
                    detail(<?php echo $tugas_id ?>);
                },
            });
        }

        // $.ajax({
        //     url: base_url + 'kejati/ajax/Konsultasi/cardListKonsultasi/' + $('#pegawai-detail-tugas-id').val() + '/' + $('#detail-tugas-id').val(),
        //     type: "GET",
        //     success: function(data) {
        //         $('#list-konsultasi').html(data)
        //     }
        // })
        // $.ajax({
        //     url: base_url + 'kejati/ajax/Konsultasi/cardChatKonsultasi/',
        //     type: "GET",
        //     success: function(data) {
        //         $('#chat-konsultasi').html(data)
        //     }
        // })

        function cardKonsul(pdtId, tugasId, pegawai_id_leader, pegawai_id) {


            $.ajax({
                url: base_url + 'kejati/ajax/konsultasi/cardListKonsultasi/' + pdtId + '/' + tugasId + '/' + pegawai_id_leader + '/' + pegawai_id,
                type: "GET",
                success: function(data) {

                    $('#modal-body').empty()
                    $('#modal-body').html(data)
                    $('#modal-konsultasi').modal('show');


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }

        function cardKonsulKetua(pdtId, tugasId, idPegawai, leader) {

            $.ajax({
                url: base_url + 'kejati/ajax/konsultasi/cardListKonsultasiKetua/' + pdtId + '/' + tugasId + '/' + idPegawai + '/' + leader,
                type: "GET",
                success: function(data) {

                    $('#modal-body').empty()
                    $('#modal-body').html(data)
                    $('#modal-konsultasi').modal('show');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                },
            });
        }


        function toTambahKonsultasi(id_pegawai) {

            $.ajax({
                url: base_url + 'kejati/ajax/Konsultasi/cardTambahKonsultasi/' + id_pegawai,
                type: "GET",
                success: function(data) {

                    $('#content').html(data)
                    $('#tutup-list').hide()
                    $('#tombol-tambah').hide()
                }
            })
        }

        function toEditKonsul(id_konsul) {
            $.ajax({
                url: base_url + 'kejati/ajax/Konsultasi/cardEditKonsultasi/' + id_konsul,
                type: 'GET',
                success: function(data) {
                    $('#content').html(data)
                    $('#tutup-list').hide()
                    $('#tombol-tambah').hide()
                }
            })
        }

        function tutupTambah() {
            $.ajax({
                url: base_url + 'kejati/ajax/Konsultasi/cardListKonsultasi/' + $('#pegawai-detail-tugas-id').val() + '/' + $('#detail-tugas-id').val(),
                type: "GET",
                success: function(data) {
                    $('#list-konsultasi').html(data)
                }
            })
            $('#tambah-konsultasi').hide('fast')
            $('#tombol-tambah').show()
            $('[id^="list-konsul"]').show()

        }

        function tutupEdit() {
            $.ajax({
                url: base_url + 'kejati/ajax/Konsultasi/cardListKonsultasi/' + $('#pegawai-detail-tugas-id').val() + '/' + $('#detail-tugas-id').val(),
                type: "GET",
                success: function(data) {
                    $('#list-konsultasi').html(data)
                }
            })

            $('#edit-konsultasi').hide('fast')
            $('#tombol-tambah').show()
            $('[id^="list-konsul"]').show()

        }

        function simpanKonsul(pegawai_detail_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/konsultasi/add/' + pegawai_detail_id,
                type: 'POST',
                data: $('#form-tambah-konsul' + pegawai_detail_id).serialize(),
                success: function(data) {

                    if (data.status) {
                        handleToast("success", data.message)

                    } else {
                        handleError(data);
                    }
                    backList()

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                    $("#btnSave").text("Kirim ke atasan");
                    $("#btnSave").attr("disabled", false);
                },
                complete: function() {

                },
            });
        }

        function clearModal() {
            $('#modal-body').html('');
        }
    </script>