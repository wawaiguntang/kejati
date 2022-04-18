<div class="data">
</div>
<script>
    var base_url = '<?php echo base_url() ?>';
    var save_label = "add";

    $(document).ready(function() {
        getData();
    });

    function back() {
        getData();
    }

    function getData() {
        $.ajax({
            url: base_url + 'kejati/ajax/penyelidikan/data',
            type: "GET",

            success: function(data) {
                $(".data").html(data.data);
                breadcrumb(data.breadcrumb);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }



</script>