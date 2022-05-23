    <div class="card card-body py-1 mb-1 mx-1 px-2" style="border: 1px solid #D4D4D4;" id="kegiatan<?php echo $kegiatan->id ?>">
        <div class="row">
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                <i class="ri-delete-bin-line ri-lg text-danger" role="button" title="Delete Kegiatan" onclick="deleteKegiatanHTML(<?php echo $kegiatan->id ?>)"></i>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <span class="text-sm" title="Kegiatan"><b>Kegiatan: </b><?php echo $kegiatan->kegiatan ?></span>
                    <span class="text-xs" title="Waktu"><b>Waktu: </b><?php echo $kegiatan->waktu . ' ' . $kegiatan->satuan ?></span>
                    <span class="text-xs" title="Ket">
                        <b>Kelengkapan: </b>
                        <div id="kelengkapanHTML<?php echo $kegiatan->id; ?>"></div>
                    </span>
                    <span class="text-xs" title="Ket"><b>Ket: </b><?php echo $kegiatan->keterangan ?></span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-between">
                    <span class="text-md">Jaksa</span>
                    <div>
                        <span class="badge bg-primary text-white" role="button" title="Tambah Jaksa" onclick="addPegawaiHTML(<?php echo $kegiatan->id ?>)"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
                <table class="table table-sm">
                    <tbody id="detail_tugas<?php echo $kegiatan->id; ?>">

                    </tbody>
                </table>
            </div>
        </div>
    </div>