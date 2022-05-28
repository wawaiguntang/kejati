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
<div class="card card-body rounded-lg shadow-lg py-2">
    <h3 id="welcome"> Selamat Datang, <?= $$this->session->userdata('name'); ?> </h3>
</div>
<?php
$permission = getPermissionFromUser();
if (in_array("RDASHSELF", $permission)) { ?>
    <div class="col-12 col-sm-12 col-xs-12 col-md-8">
        <div class="row mb-3">
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="allListFunc()">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="doneListFunc()">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="runningListFunc()">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="rejectListFunc()">
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
                        <p class="menuDash menuDashAllAnggota text-sm " role="button" onclick="getAnggota('All')">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash menuDashAllKetua text-sm" role="button" onclick="getKetua('All')">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="allHtml"></div>
            </div>
        </div>

        <div class="dataList runningList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas selesai</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash menuDashRunningAnggota text-sm" role="button" onclick="getAnggota('Running')">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash menuDashRunningKetua text-sm" role="button" onclick="getKetua('Running')">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="runningHtml"></div>
            </div>
        </div>

        <div class="dataList doneList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas berjalan</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash menuDashDoneAnggota text-sm" role="button" onclick="getAnggota('Done')">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash menuDashDoneKetua text-sm" role="button" onclick="getKetua('Done')">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="doneHtml"></div>
            </div>
        </div>

        <div class="dataList rejectList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas ditolak</p>
                <div class="d-flex gap-3">
                    <?php
                    if (in_array("RDASHSELF", $permission)) {
                    ?>
                        <p class="menuDash menuDashRejectAnggota text-sm" role="button" onclick="getAnggota('Reject')">Sebagai anggota</p>
                    <?php
                    }
                    ?>
                    <p class="menuDash menuDashRejectKetua text-sm" role="button" onclick="getKetua('Reject')">Sebagai ketua</p>
                </div>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="rejectHtml"></div>
            </div>
        </div>
    </div>
    <div class="col-4 col-sm-12 col-md-4">
        <div class="detailTugas">

        </div>
    </div>
    <script>
        var base_url = "<?php echo base_url() ?>";
        $(document).ready(function() {
            allListFunc();
            getAnggota();
        });

        const formatDate = (dateString) => {
            const options = {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "numeric",
                minute: "numeric",
                second: "numeric",
            }
            return new Date(dateString).toLocaleDateString(undefined, options)
        }

        function html(item) {
            return `<div class="card card-body my-1 p-1 px-1 shadow-lg" style="border-radius: 1rem;" role="button" onclick=detailTugas(` + item.id + `)>
                    <div class="d-flex justify-content-center m-0">
                        <p class="text-sm text-bold my-0">` + item.kegiatan + `</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <div>
                            <p class="text-xs text-bold my-0">No Pengaduan: ` + item.no + `</p>
                            <p class="text-xs text-bold my-0">No Surat Perintah: ` + item.no_surat_tugas + `</p>
                        </div>
                        <p class="text-xs text-bold my-0"><span class="badge ` + ((item.status == 'Diterima') ? 'bg-success' : ((item.status == 'Ditolak') ? 'bg-danger' : 'bg-warning')) + `">` + item.status + `</span></p>
                    </div>
                    <div class="d-flex justify-content-center m-0 mt-1">
                        <p class="text-xs text-bold my-0">` + formatDate(item.waktu_mulai) + ` - ` + (item.waktu_selesai == null ? 'Sekarang' : formatDate(item.waktu_selesai)) + ` </p>
                    </div>` +
                ((item.waktu_selesai != null) ?
                    `<div class="d-flex justify-content-center m-0 my-1">
                        <p class="text-xs text-bold my-0"><span class="badge ` + (item.status_waktu == 'lewat' ? 'bg-danger' : 'bg-success') + `">` + item.selisih + `</span></p>
                    </div>` : ``) +
                `
                </div>`;
        }

        function getAnggota(tipe = 'All') {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard/get',
                type: "POST",
                data: {
                    tipe: 'anggota',
                },
                success: function(data) {
                    if (data.status) {
                        $('.menuDash' + tipe + 'Ketua').removeClass('active');
                        $('.menuDash' + tipe + 'Anggota').addClass('active');
                        dat = data.data;
                        $(".allCount").text(dat.all.count);
                        $(".doneCount").text(dat.done.count);
                        $(".runningCount").text(dat.running.count);
                        $(".rejectCount").text(dat.reject.count);

                        allList = dat.all.data;
                        var allHtml = '';
                        allList.forEach((item, index) => {
                            allHtml += html(item);
                        });
                        $(".allHtml").html(allHtml);

                        runningList = dat.running.data;
                        var runningHtml = '';
                        runningList.forEach((item, index) => {
                            runningHtml += html(item);
                        });
                        $(".runningHtml").html(runningHtml);

                        doneList = dat.done.data;
                        var doneHtml = '';
                        doneList.forEach((item, index) => {
                            doneHtml += html(item);
                        });
                        $(".doneHtml").html(doneHtml);

                        rejectList = dat.reject.data;
                        var rejectHtml = '';
                        rejectList.forEach((item, index) => {
                            rejectHtml += html(item);
                        });
                        $(".rejectHtml").html(rejectHtml);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function getKetua(tipe = 'All') {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard/get',
                type: "POST",
                data: {
                    tipe: 'ketua',
                },
                success: function(data) {
                    if (data.status) {
                        $('.menuDash' + tipe + 'Anggota').removeClass('active');
                        $('.menuDash' + tipe + 'Ketua').addClass('active');
                        dat = data.data;
                        $(".allCount").text(dat.all.count);
                        $(".doneCount").text(dat.done.count);
                        $(".runningCount").text(dat.running.count);
                        $(".rejectCount").text(dat.reject.count);

                        allList = dat.all.data;
                        var allHtml = '';
                        allList.forEach((item, index) => {
                            allHtml += html(item);
                        });
                        $(".allHtml").html(allHtml);

                        runningList = dat.running.data;
                        var runningHtml = '';
                        runningList.forEach((item, index) => {
                            runningHtml += html(item);
                        });
                        $(".runningHtml").html(runningHtml);

                        doneList = dat.done.data;
                        var doneHtml = '';
                        doneList.forEach((item, index) => {
                            doneHtml += html(item);
                        });
                        $(".doneHtml").html(doneHtml);

                        rejectList = dat.reject.data;
                        var rejectHtml = '';
                        rejectList.forEach((item, index) => {
                            rejectHtml += html(item);
                        });
                        $(".rejectHtml").html(rejectHtml);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function allListFunc() {
            $('.dataList').addClass('d-none');
            $('.allList').removeClass('d-none');
            getAnggota('All');
        }

        function runningListFunc() {
            $('.dataList').addClass('d-none');
            $('.runningList').removeClass('d-none');
            getAnggota('Running');
        }

        function doneListFunc() {
            $('.dataList').addClass('d-none');
            $('.doneList').removeClass('d-none');
            getAnggota('Done');
        }

        function rejectListFunc() {
            $('.dataList').addClass('d-none');
            $('.rejectList').removeClass('d-none');
            getAnggota('Reject');
        }

        function detailTugas(id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard/detail',
                type: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".detailTugas").html(data.data);
                    } else {
                        handleError(data);
                    }
                }
            });
        }

        function koordinasi(pdtId, id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard/koordinasi',
                type: "POST",
                data: {
                    pdtId: pdtId,
                    id: id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".koordinasiHtml").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function chat(pdtId, id, konsultasi_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard/chat',
                type: "POST",
                data: {
                    pdtId: pdtId,
                    id: id,
                    konsultasi_id: konsultasi_id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".koordinasiHtml").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function chat_self(pdtId, id, konsultasi_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard/chat_self',
                type: "POST",
                data: {
                    pdtId: pdtId,
                    id: id,
                    konsultasi_id: konsultasi_id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".koordinasiHtmlSelf").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }
    </script>
<?php } else { ?>
    <div class="col-12 col-sm-12 col-xs-12 col-md-8">
        <div class="row mb-3">
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="allListFunc()">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="doneListFunc()">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="runningListFunc()">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button" onclick="rejectListFunc()">
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
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="allHtml"></div>
            </div>
        </div>

        <div class="dataList doneList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas selesai</p>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="doneHtml"></div>
            </div>
        </div>

        <div class="dataList  runningList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas berjalan</p>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="runningHtml"></div>
            </div>
        </div>

        <div class="dataList rejectList">
            <div class="row">
                <p class="fs-5 mb-0 pb-0 text-bold" style="color: black;">Tugas ditolak</p>
            </div>
            <div class="row" style="height: 35vh;overflow-y: scroll;">
                <div class="rejectHtml"></div>
            </div>
        </div>
    </div>
    <div class="col-4 col-sm-12 col-md-4">
        <div class="detailTugas">

        </div>
    </div>
    <script>
        var base_url = "<?php echo base_url() ?>";
        $(document).ready(function() {
            allListFunc();
        });

        const formatDate = (dateString) => {
            const options = {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "numeric",
                minute: "numeric",
                second: "numeric",
            }
            return new Date(dateString).toLocaleDateString(undefined, options)
        }

        function html(item) {
            return `<div class="card card-body my-1 p-1 px-1 shadow-lg" style="border-radius: 1rem;" role="button" onclick=detailTugas(` + item.id + `)>
                    <div class="d-flex justify-content-center m-0">
                        <p class="text-sm text-bold my-0">` + item.kegiatan + `</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <div>
                            <p class="text-xs text-bold my-0">No Pengaduan: ` + item.no + `</p>
                            <p class="text-xs text-bold my-0">No Surat Perintah: ` + item.no_surat_tugas + `</p>
                        </div>
                        <p class="text-xs text-bold my-0"><span class="badge ` + ((item.status == 'Diterima') ? 'bg-success' : ((item.status == 'Ditolak') ? 'bg-danger' : 'bg-warning')) + `">` + item.status + `</span></p>
                    </div>
                    <div class="d-flex justify-content-center m-0 mt-1">
                        <p class="text-xs text-bold my-0">` + formatDate(item.waktu_mulai) + ` - ` + (item.waktu_selesai == null ? 'Sekarang' : formatDate(item.waktu_selesai)) + ` </p>
                    </div>` +
                ((item.waktu_selesai != null) ?
                    `<div class="d-flex justify-content-center m-0 my-1">
                        <p class="text-xs text-bold my-0"><span class="badge ` + (item.status_waktu == 'lewat' ? 'bg-danger' : 'bg-success') + `">` + item.selisih + `</span></p>
                    </div>` : ``) +
                `
                </div>`;
        }

        function getAll(tipe = 'All') {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard2/get',
                type: "POST",
                data: {
                    tipe: 'anggota',
                },
                success: function(data) {
                    if (data.status) {
                        $('.menuDash' + tipe + 'Ketua').removeClass('active');
                        $('.menuDash' + tipe + 'Anggota').addClass('active');
                        dat = data.data;
                        $(".allCount").text(dat.all.count);
                        $(".doneCount").text(dat.done.count);
                        $(".runningCount").text(dat.running.count);
                        $(".rejectCount").text(dat.reject.count);

                        allList = dat.all.data;
                        var allHtml = '';
                        allList.forEach((item, index) => {
                            allHtml += html(item);
                        });
                        $(".allHtml").html(allHtml);

                        runningList = dat.running.data;
                        var runningHtml = '';
                        runningList.forEach((item, index) => {
                            runningHtml += html(item);
                        });
                        $(".runningHtml").html(runningHtml);

                        doneList = dat.done.data;
                        var doneHtml = '';
                        doneList.forEach((item, index) => {
                            doneHtml += html(item);
                        });
                        $(".doneHtml").html(doneHtml);

                        rejectList = dat.reject.data;
                        var rejectHtml = '';
                        rejectList.forEach((item, index) => {
                            rejectHtml += html(item);
                        });
                        $(".rejectHtml").html(rejectHtml);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function allListFunc() {
            $('.dataList').addClass('d-none');
            $('.allList').removeClass('d-none');
            getAll('All');
        }

        function runningListFunc() {
            $('.dataList').addClass('d-none');
            $('.runningList').removeClass('d-none');
            getAll('Running');
        }

        function doneListFunc() {
            $('.dataList').addClass('d-none');
            $('.doneList').removeClass('d-none');
            getAll('Done');
        }

        function rejectListFunc() {
            $('.dataList').addClass('d-none');
            $('.rejectList').removeClass('d-none');
            getAll('Reject');
        }

        function detailTugas(id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard2/detail',
                type: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".detailTugas").html(data.data);
                    } else {
                        handleError(data);
                    }
                }
            });
        }

        function koordinasi(pdtId, id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard2/koordinasi',
                type: "POST",
                data: {
                    pdtId: pdtId,
                    id: id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".koordinasiHtml").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function chat(pdtId, id, konsultasi_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard2/chat',
                type: "POST",
                data: {
                    pdtId: pdtId,
                    id: id,
                    konsultasi_id: konsultasi_id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".koordinasiHtml").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }

        function chat_self(pdtId, id, konsultasi_id) {
            $.ajax({
                url: base_url + 'kejati/ajax/dashboard2/chat_self',
                type: "POST",
                data: {
                    pdtId: pdtId,
                    id: id,
                    konsultasi_id: konsultasi_id,
                },
                success: function(data) {
                    if (data.status) {
                        $(".koordinasiHtmlSelf").html(data.data);
                    } else {
                        handleError(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data from ajax");
                }
            });
        }
    </script>
<?php } ?>