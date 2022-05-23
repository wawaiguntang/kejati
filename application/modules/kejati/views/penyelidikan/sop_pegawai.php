<?php
$data = $this->session->userdata('temp')['kegiatan'][$kegiatan_id];
foreach ($data as $k => $v) {
?>
    <tr>
        <td class="d-flex">
            <i class="ri-delete-bin-line text-danger" role="button" title="Delete" onclick="deletePegawai(<?php echo $kegiatan_id ?>,<?php echo $v['pegawai']['id'] ?>)"></i>
            <span class="text-xs my-auto py-auto"><?php echo $v['pegawai']['nama'] ?></span>
        </td>
        <td class="align-middle text-center">
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="leader<?php echo $kegiatan_id ?>" value="<?php echo $kegiatan_id . '|' . $k ?>" id="setLeader" <?php echo (($v['leader'] == 1) ? 'checked' : '') ?>>
                </div>
            </div>
        </td>
    </tr>
<?php
}
?>