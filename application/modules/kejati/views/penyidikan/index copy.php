<div class="row">
    <?php
    foreach ($pengaduan as $s => $k) { ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 pluginPaginate mt-2">
            <div class="card">
                <div class="card-body pt-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2" title="No Pengaduan"><?php echo $k['no'] ?></span>
                        </div>
                        <div>
                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2" title="Waktu"><?php //echo formatWaktu($k['waktu']) 
                                                                                                                                ?></span>
                        </div>
                    </div>
                    <a href="javascript:void(0);" onclick="detail()" class="card-title h5 d-block text-darker">
                        <?php echo character_limiter($k['perihal'], 25) ?>
                    </a>
                    <div class="row">
                        <div class="progress-wrapper w-100 mx-auto">
                            <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold"><?php echo $k['persen'] ?>%</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-gradient-primary w-<?php echo progress($k['persen']) ?>" role="progressbar" aria-valuenow="<?php echo $k['persen'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="card-description text-justify">
                    <h6>Tugas</h6>
                    <ul style="list-style-type: none;">
                        <li><small>Selesai : <?php echo $k['selesai'] ?></small></li>
                        <li><small>Dalam proses : <?php echo $k['proses'] ?></small></li>
                        <li><small>Total : <?php echo $k['total'] ?></small></li>
                    </ul>
                    </p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6>Jaksa</h6>
                        <div>
                            <!-- <span class="badge bg-primary" role="button">Detail</span> -->
                        </div>
                    </div>
                    <?php foreach ($k['jaksa'] as $j => $a) { ?>
                        <div class="author align-items-center mb-1">
                            <img src="<?php echo base_url('assets/img/pegawai/foto/' . $a['foto']) ?>" alt="..." class="avatar shadow">
                            <div class="name ps-3">
                                <span class=""><?php echo $a['nama'] ?></span>
                                <div class="stats">
                                    <small><?php echo $a['tugas'] ?> tugas</small>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>