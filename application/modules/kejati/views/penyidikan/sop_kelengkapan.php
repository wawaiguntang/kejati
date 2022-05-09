<!-- <pre>
    <?php //echo var_dump($this->session->userdata('temp'))?>
</pre> -->
<ul class="mt-1">
    <?php foreach ($kelengkapan as $kel) { ?>
        <li>
            <i class="ri-file-upload-line ri-lg text-success" role="button" title="Upload Kelengkapan" onclick="uploadKelengkapan(<?php echo $kegiatan_id ?>,<?php echo $kel->id ?>)"></i>
            <?php echo $kel->kelengkapan ?>
            <?php
            $kelengkapanSession = $this->session->userdata('temp')['kegiatan_kelengkapan'][$kegiatan_id][$kel->id];
            if ($kelengkapanSession != NULL && $kelengkapanSession != '') {
            ?>
                <a href="<?php echo base_url('kejati/penyelidikan/download/' . encrypt('\assets\kejati\files\\' . $kelengkapanSession['file']) . '/' . $kelengkapanSession['file']) ?>" style="text-decoration: none;"><i class="ri-file-download-line ri-lg text-primary" role="button" title="Download Kelengkapan"></i></a>
            <?php
            }
            ?>
        </li>
    <?php } ?>
</ul>