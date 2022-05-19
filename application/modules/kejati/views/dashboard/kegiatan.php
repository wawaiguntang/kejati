<style>
    .menuDash:hover {
        color: black;
        text-decoration: underline;
    }

    .menuDash.active {
        color: black;
        text-decoration: underline;
    }
</style>
<div class="col-8 col-sm-12 col-xs-12 col-md-8">
    <?php
    $permission = getPermissionFromUser();
    if (in_array("RDASHSELF", $permission)) {
    ?>
        <div class="row mb-3">
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="allList()">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/all.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-bars"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-4 allCount" style="color: black;"></p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Semua tugas</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="doneList()">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/complete.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-check"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-4 doneCount" style="color: black;"></p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Tugas selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="runningList()">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/running.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-regular fa-clock"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-4 runningCount" style="color: black;"></p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Tugas berjalan</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="rejectList()">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/reject.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-ban"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-4 rejectCount" style="color: black;"></p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Tugas ditolak</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dataList allList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Semua tugas</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash active text-sm" role="button">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash text-sm" role="button">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="card card-body my-1 p-0 px-1" style="border-radius: 1rem;" role="button">
                    <div class="d-flex justify-content-center m-0">
                        <p class="text-sm text-bold my-0">Melakukan rapat koordinasi TIM</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <div>
                            <p class="text-xs text-bold my-0">No Pengaduan: DD-002-123</p>
                            <p class="text-xs text-bold my-0">No Surat Perintah: DD-002-123</p>
                        </div>
                        <p class="text-xs text-bold my-0"><span class="badge bg-warning">Dalam proses</span></p>
                    </div>
                    <div class="d-flex justify-content-center m-0 mt-1">
                        <p class="text-xs text-bold my-0">10 MEI 2022 22:05:08 - Sekarang </p>
                    </div>
                    <div class="d-flex justify-content-center m-0 my-1">
                        <p class="text-xs text-bold my-0"><span class="badge bg-danger">+10 Menit</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="dataList runningList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas selesai</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash active text-sm" role="button">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash text-sm" role="button">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="card card-body my-1 p-0 px-1" style="border-radius: 1rem;" role="button">
                    <div class="d-flex justify-content-center m-0">
                        <p class="text-sm text-bold my-0">Melakukan rapat koordinasi TIM</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <div>
                            <p class="text-xs text-bold my-0">No Pengaduan: DD-002-123</p>
                            <p class="text-xs text-bold my-0">No Surat Perintah: DD-002-123</p>
                        </div>
                        <p class="text-xs text-bold my-0"><span class="badge bg-warning">Dalam proses</span></p>
                    </div>
                    <div class="d-flex justify-content-center m-0 mt-1">
                        <p class="text-xs text-bold my-0">10 MEI 2022 22:05:08 - Sekarang </p>
                    </div>
                    <div class="d-flex justify-content-center m-0 my-1">
                        <p class="text-xs text-bold my-0"><span class="badge bg-danger">+10 Menit</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="dataList doneList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas berjalan</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash active text-sm" role="button">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash text-sm" role="button">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="card card-body my-1 p-0 px-1" style="border-radius: 1rem;" role="button">
                    <div class="d-flex justify-content-center m-0">
                        <p class="text-sm text-bold my-0">Melakukan rapat koordinasi TIM</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <div>
                            <p class="text-xs text-bold my-0">No Pengaduan: DD-002-123</p>
                            <p class="text-xs text-bold my-0">No Surat Perintah: DD-002-123</p>
                        </div>
                        <p class="text-xs text-bold my-0"><span class="badge bg-warning">Dalam proses</span></p>
                    </div>
                    <div class="d-flex justify-content-center m-0 mt-1">
                        <p class="text-xs text-bold my-0">10 MEI 2022 22:05:08 - Sekarang </p>
                    </div>
                    <div class="d-flex justify-content-center m-0 my-1">
                        <p class="text-xs text-bold my-0"><span class="badge bg-danger">+10 Menit</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="dataList rejectList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas ditolak</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash active text-sm" role="button">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash text-sm" role="button">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="card card-body my-1 p-0 px-1" style="border-radius: 1rem;" role="button">
                    <div class="d-flex justify-content-center m-0">
                        <p class="text-sm text-bold my-0">Melakukan rapat koordinasi TIM</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <div>
                            <p class="text-xs text-bold my-0">No Pengaduan: DD-002-123</p>
                            <p class="text-xs text-bold my-0">No Surat Perintah: DD-002-123</p>
                        </div>
                        <p class="text-xs text-bold my-0"><span class="badge bg-warning">Dalam proses</span></p>
                    </div>
                    <div class="d-flex justify-content-center m-0 mt-1">
                        <p class="text-xs text-bold my-0">10 MEI 2022 22:05:08 - Sekarang </p>
                    </div>
                    <div class="d-flex justify-content-center m-0 my-1">
                        <p class="text-xs text-bold my-0"><span class="badge bg-danger">+10 Menit</span></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    var base_url = "<?php echo base_url() ?>";
    $(document).ready(function() {
        allList();
        getAnggota();
    });

    function getAnggota(tipe = 'anggota') {
        $.ajax({
            url: base_url + 'kejati/ajax/dashboard/get',
            type: "POST",
            data: {
                tipe: tipe,
            },
            success: function(data) {
                if (data.status) {
                    dat = data.data;
                    $(".allCount").text(dat.all.count);
                    $(".doneCount").text(dat.done.count);
                    $(".runningCount").text(dat.running.count);
                    $(".rejectCount").text(dat.reject.count);

                    allList = dat.all.data;
                    allList.forEach(){
                        
                    }
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            }
        });
    }

    function getKetua(tipe = 'ketua') {
        $.ajax({
            url: base_url + 'kejati/ajax/dashboard/get',
            type: "POST",
            data: {
                tipe: tipe,
            },
            success: function(data) {
                if (data.status) {
                    dat = data.data;
                    $(".allCount").text(dat.all.count);
                    $(".doneCount").text(dat.done.count);
                    $(".runningCount").text(dat.running.count);
                    $(".rejectCount").text(dat.reject.count);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            }
        });
    }

    function allList() {
        $('.dataList').addClass('d-none');
        $('.allList').removeClass('d-none');
    }

    function runningList() {
        $('.dataList').addClass('d-none');
        $('.runningList').removeClass('d-none');
    }

    function doneList() {
        $('.dataList').addClass('d-none');
        $('.doneList').removeClass('d-none');
    }

    function rejectList() {
        $('.dataList').addClass('d-none');
        $('.rejectList').removeClass('d-none');
    }
</script>