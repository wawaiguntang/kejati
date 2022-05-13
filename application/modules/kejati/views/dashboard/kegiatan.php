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
                <div class="card my-1" style="border-radius: 1rem;height: 35vh;">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/all.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 35vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-bars"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-7" style="color: black;">35</p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Semua tugas</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 35vh;">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/complete.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 35vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-check"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-7" style="color: black;">4</p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Tugas selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 35vh;">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/running.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 35vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-regular fa-clock"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-7" style="color: black;">6</p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Tugas berjalan</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-xs-12 py-0">
                <div class="card my-1" style="border-radius: 1rem;height: 35vh;">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/reject.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 35vh;">
                    <div class="card-img-overlay">
                        <div class="col-2">
                            <div class="card card-body p-1" style="border-radius: 0.3rem;"><i style="color: black;" class="fa fa-ban"></i></div>
                        </div>
                        <p class="card-title text-bold fs-1 mt-7" style="color: black;">9</p>
                        <p class="card-text text-bold mt-0 pt-0" style="color: black;">Tugas ditolak</p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
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
    <div class="row">
        <div class="row col-12 col-sm-12 col-md-12 text-sm">
            <div class="col-4 bg-dark">
                Menerima Surat Perintah Tugas Pengayaan Informasi/Data
            </div>
            <div class="col-4 bg-success py-auto">
                3 Jam
            </div>
            <div class="col-4 bg-primary">

            </div>
        </div>
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-4">
                Mengambil Barang
            </div>
            <div class="col-4">
                3 Jam
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
</div>