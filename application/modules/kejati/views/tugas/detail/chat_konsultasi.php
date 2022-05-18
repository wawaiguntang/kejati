<div id="chat-konsul" class="container">
    <div class="row clearfix mb-1">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div class="chat">
                    <div class="chat-header clearfix mb-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="<?php echo base_url('assets/img/pegawai/foto/' . $leader['foto']) ?>" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0"><?= $leader['nama']; ?></h6>
                                    <small>Ketua Tim</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul id="list-pesan" class="m-b-0">
                            <!-- <li class="clearfix mb-1">
                                <div class="message-data text-end">
                                    <span class="message-data-time">10:10 AM, Today</span>
                                </div>
                                <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                            </li>
                            <li class="clearfix mb-1">
                                <div class="message-data">
                                    <span class="message-data-time">10:12 AM, Today</span>
                                </div>
                                <div class="message my-message">Are we meeting today?</div>
                            </li>
                            <li class="clearfix mb-1">
                                <div class="message-data">
                                    <span class="message-data-time">10:15 AM, Today</span>
                                </div>
                                <div class="message my-message">Project has been already finished and I have results to show you.</div>
                            </li> -->
                        </ul>
                    </div>
                    <div class="chat-message clearfix mb-1">
                        <form id="form-chat" action="">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend" onclick="kirimPesan()" style="cursor: pointer;">
                                    <span class="input-group-text"><i class="fa fa-paper-plane m-1"></i></span>
                                </div>
                                <input id="pesan" type="text" class="form-control" placeholder="Enter text here...">
                                <input id="dari" type="hidden" class="form-control" value="<?= $pegawai_id; ?>">
                                <input id="untuk" type="hidden" class="form-control" value="<?= $leader['id']; ?>">
                                <input id="id_konsultasi" type="hidden" class="form-control" value="<?= $id_konsultasi; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function kirimPesan() {
        $.ajax({
            url: base_url + 'kejati/ajax/konsultasi/kirimPesan',
            type: "POST",
            data: {
                pesan: $('#pesan').val(),
                dari: $('#dari').val(),
                untuk: $('#untuk').val(),
                id_konsultasi: $('#id_konsultasi').val()
            },
            success: function(data) {
                if (data.status) {
                    handleToast("success", data.message);
                    $('#pesan').val("");
                    $('#list-pesan').html();
                    allChat();
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }
    allChat();
    // const myInterval = setInterval(allChat, 6000);

    function allChat() {
        $.ajax({
            url: base_url + 'kejati/ajax/konsultasi/allChat/' + <?= $id_konsultasi; ?>,
            type: "GET",
            success: function(data) {
                console.log(data)
                var html = '';
                if (data.status) {
                    handleToast("success", data.message);
                    let chat = data.data.chat;
                    chat.forEach(c => {
                        if (c.dari == <?= $pegawai_id; ?>) {
                            html += `<li class="clearfix mb-1">
                                <div class="message-data text-end">
                                    <span class="message-data-time">` + c.createAt + `</span>
                                </div>
                                <div class="message other-message float-right"> ` + c.pesan + ` </div>
                            </li>`;
                        } else if (c.untuk == <?= $pegawai_id; ?>) {
                            html += `<li class="clearfix mb-1">
                                <div class="message-data">
                                    <span class="message-data-time">` + c.createAt + `</span>
                                </div>
                                <div class="message my-message">` + c.pesan + `</div>
                            </li>`
                        }
                    });

                    $('#list-pesan').html(html);
                } else {
                    handleError(data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data from ajax");
            },
        });
    }
</script>