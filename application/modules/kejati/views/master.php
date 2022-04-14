<ul class="nav nav-tabs">
    <?php echo ((in_array('RJABATAN', $userPermission)) ? '
    <li class="nav-item">
        <a class="forActive nav-link" href="javascript:void(0)" onclick="jabatan()">Jabatan</a>
    </li>' : '') ?>
    <?php echo ((in_array('RPANGKAT', $userPermission)) ? '
    <li class="nav-item">
        <a class="forActive nav-link" href="javascript:void(0)" onclick="pangkat()">Pangkat</a>
    </li>' : '') ?>
    <?php echo ((in_array('RGOLONGAN', $userPermission)) ? '
    <li class="nav-item">
        <a class="forActive nav-link" href="javascript:void(0)" onclick="golongan()">Golongan</a>
    </li>' : '') ?>
    <?php echo ((in_array('RPEGAWAI', $userPermission)) ? '
    <li class="nav-item">
        <a class="forActive nav-link" href="javascript:void(0)" onclick="pegawai()">Pegawai</a>
    </li>' : '') ?>
    <?php echo ((in_array('RSOP', $userPermission)) ? '
    <li class="nav-item">
        <a class="forActive nav-link" href="javascript:void(0)" onclick="sop()">SOP</a>
    </li>' : '') ?>
</ul>
<div class="card mb-4 border-start border-end border-bottom" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
    <div class="card-body px-5 pt-2 pb-2">
        <div class="data">
        </div>
    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    $(document).ready(function() {});

    $('.forActive').click((e) => {
        $('.forActive').removeClass('active');
        $(e.target).addClass('active');
    });

    function back() {
        jabatan();
    }

    // function backDetail(id) {
    //     infoData(id);
    // }

    function jabatan() {
        $.ajax({
            url: base_url + 'kejati/ajax/jabatan',
            type: "GET",
            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
                    breadcrumb(data.breadcrumb);
                    getData("jabatan");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function pangkat() {
        $.ajax({
            url: base_url + 'kejati/ajax/pangkat',
            type: "GET",
            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
                    breadcrumb(data.breadcrumb);
                    getData("pangkat");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function golongan() {
        $.ajax({
            url: base_url + 'kejati/ajax/golongan',
            type: "GET",
            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
                    breadcrumb(data.breadcrumb);
                    getData("golongan");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function pegawai() {
        $.ajax({
            url: base_url + 'kejati/ajax/pegawai',
            type: "GET",
            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
                    breadcrumb(data.breadcrumb);
                    getData("pegawai");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function sop() {
        $.ajax({
            url: base_url + 'kejati/ajax/sop',
            type: "GET",
            success: function(data) {
                if (data.status) {
                    $(".data").html(data.data);
                    breadcrumb(data.breadcrumb);
                    getData("sop");
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }

    function getData(tab) {
        let list = $('#' + tab).DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: base_url + 'kejati/ajax/' + tab + '/list',
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
        });
    }
</script>