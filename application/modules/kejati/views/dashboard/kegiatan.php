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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/all.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/complete.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/running.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
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
                <div class="card my-1" style="border-radius: 1rem;height: 30vh;" role="button">
                    <img class="card-img-top" src="<?php echo base_url('assets/kejati/image/reject.png') ?>" alt="Photo of sunset" style="border-radius: 1rem;height: 30vh;">
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
            <div class="card" style="border-radius: 1rem;height: 40vh;overflow-y: scroll;">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php echo table('all', ['Tugas'], ['table-hover py-1 px-0 mx-0']); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    var base_url = "<?php echo base_url() ?>";
    $(document).ready(function() {
        all();
        console.log('adadad');
    });

    function all() {
        $("#all").DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: base_url + 'kejati/ajax/dashboard/all',
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
            "aLengthMenu": [
                [3, 5, 10, -1],
                [3, 5, 10, "All"]
            ],
            "iDisplayLength": 3,
            "bLengthChange": false,
            "bFilter": true,
            "searching": false,
            "info": false
        });
    }
</script>