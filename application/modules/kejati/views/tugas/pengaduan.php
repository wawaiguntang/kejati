<div class="card card-body p-2" style="border: 1px solid #D4D4D4;">
    <div class="d-flex justify-content-between my-0 py-0">
        <span class="text-uppercase text-xs font-weight-bold" title="No Pengaduan"><?php echo $no ?></span>
        <span class="text-uppercase text-xs font-weight-bold" title="Tanggal Terima"><?php echo nice_date($tanggal_terima, 'd-F-Y') ?></span>
    </div>
    <span class="text-xs mt-0 pt-0" title="Tanggal Surat"><?php echo nice_date($tanggal_surat, 'd-F-Y') ?></span>
    <h6 title="Perihal" class="text-sm font-weight-bold mb-1 mt-0 pt-0"><?php echo $perihal ?></h6>
    <div class="row">
        <p class="text-xs"><?php echo $isi ?></p>
    </div>
</div>