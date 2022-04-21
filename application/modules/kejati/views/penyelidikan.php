<script src="<?php echo base_url('assets/js/paginate/paginate.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/js/paginate/pag.css'); ?>">
<div id="headerContent">
    <div class="d-flex justify-content-end">
        <?php echo button('Tambah Penyelidikan', ["btn-primary"], ["onclick" => "addData()"]); ?>
    </div>
    <div class="d-flex justify-content-between">
        <div class="col-4 col-sm-6 col-md-4">
            <?php echo selectWithFormGroup('noPengaduan', 'No Pengaduan', 'noPengaduan', $pengaduan, '', ['form-control', 'form-select-transparent']) ?>
        </div>
        <div class="col-4 col-sm-6 col-md-4">
            <div class="form-group">
                <label for="Cari" class="form-control-label">Cari</label>
                <input class="form-control" type="search" placeholder="Cari Tugas" id="Cari">
            </div>
        </div>
    </div>
</div>
<div class="data">
</div>
<div class="mt-3 d-flex justify-content-center">
    <div class="pagination"  id="footerContent"></div>
</div>
<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    $(document).ready(function() {
        getData();
        $("#noPengaduan").select2({});
        $(".select2-container").addClass('form-control');

    });

    function back() {
        getData();
    }

    function getData(noPengaduan = '', cari = '') {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/data',
            type: "POST",
            data: {
                noPengaduan: noPengaduan,
                cari: cari
            },
            success: function(data) {
                $(".data").html(data.data);
                $("#headerContent").css('display','');
                $("#footerContent").css('display','');
                $('.pagination').html('');
                $('.pagination').pagination({
                    itemsToPaginate: ".pluginPaginate",
                    activeClass: 'activePaginate'
                });
                breadcrumb(data.breadcrumb);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function addData() {
        save_label = "add";
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/addHTML',
            type: "POST",

            success: function(data) {
                if (data.status) {
                    $("#headerContent").css('display','none');
                    $("#footerContent").css('display','none');
                    $(".data").html(data.data);
                    breadcrumb(data.breadcrumb);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    $('body').delegate("#noPengaduan", "change", () => {
        var pengaduanTag = $("#noPengaduan").val();
        var cariTag = $("#Cari").val();
        getData(pengaduanTag, cariTag);
    });

    $('body').delegate("#Cari", "keyup", () => {
        var pengaduanTag = $("#noPengaduan").val();
        var cariTag = $("#Cari").val();
        getData(pengaduanTag, cariTag);
    });
</script>

<style>
    .select2-dropdown {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        border-bottom-right-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
        border: 1px solid #d2d6da;
    }

    .select2-search__field {
        border: 1px solid #d2d6da;
        border-radius: 0.5rem;
    }

    .select2-container {
        padding: 0.35rem 0.075rem;
        margin: 0px;
    }

    .select2-selection {
        padding: 0px;
        margin: 0px;
        border: 0px !important;
    }

    .select2-selection__arrow {
        display: none;
    }
</style>