 <!-- jika belum ada pesan -->
 <!-- jika sudah ada pesan -->
 <!-- <div id="list-konsul" class="card shadow-lg mb-1">
     <div class="card-body pt-1">
         <span class="badge bg-gradient-warning">Proses <?= $id ?></span>

         <a href="javascript:;" class="card-title h5 mt-3 d-block text-darker mb-0">
             Tersangka Kabur
         </a>
         <p class="card-description mb-0">
             Semalam Tersangka kbur dan belum ditemukan
         </p>
         <div class="row">
             <small class="text-end">Posted on 28 February</small>
         </div>
     </div>
 </div>
 <div id="list-konsul" class="card shadow-lg mb-1">
     <div class="card-body pt-1">
         <span class="badge bg-gradient-success">Selesai</span>
         <a href="javascript:;" class="card-title h5 mt-3 d-block text-darker mb-0">
             Tersangka Kabur
         </a>
         <p class="card-description mb-0">
             Semalam Tersangka kbur dan belum ditemukan
         </p>
         <div class="row">
             <small class="text-end">Posted on 28 February</small>
         </div>
     </div>
 </div> -->
 <div class="card p-2">
     <div class="text-end ml-2 mb-2">
         <span id="tutup-list" class="badge bg-gradient-danger " onclick="detail(<?= $tugas_id ?>)" style="cursor: pointer;">X</span>
     </div>
     <div id="content"></div>

 </div>

 <script>
     list()

     function list() {

         $.ajax({
             url: base_url + 'kejati/ajax/Konsultasi/all/' + <?= $id ?>,
             type: 'GET',
             success: function(data) {

                 let html = ``;
                 let konsultasi = data.data['konsultasi'];

                 if (konsultasi === undefined) {
                     html += `<div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-3">Belum ada Konsultasi</h4>
            
        </div>`;
                     $('#content').html(html);
                 } else {
                     konsultasi.forEach(k => {
                         html += `<div id="list-konsul` + k['id'] + `" onclick="tampilChat(` + k['id'] + `)" class="card shadow-lg mb-1">
                                    <div class="card-body pt-1"> 
                                    <div class="row">
                                    <div class="col-12">`;
                         if (k['waktu_selesai'] === null) {
                             html += `<span class="badge bg-gradient-warning">Proses</span>
                             <div class="text-end">
                             <button class="btn btn-primary mt-2 btn-sm text-end" onclick="selesai(` + k['id'] + `)">selesai</button>
                             </div>
                                    
                                    `;
                         } else {
                             html += '<span class="badge bg-gradient-success">Selesai</span>';

                         }

                         html += `</div>
                         
                         </div>
                         <a href="javascript:;" class="card-title h5 mt-1 d-block text-darker mb-0">` +
                             k['judul'] +
                             `</a><div class="row">
                                        <small class=" col-10 card-description mb-0">` +
                             k['deskripsi'] +
                             `</small>
                                        
                                            <small class="col-2">` + k['postedOn'] + `</small>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div id="chat-konsultasi` + k['id'] + `"></div>`;
                     });

                     $('#content').html(html);
                 }
             },
             error: function(e) {
                 console.log(e);
             }
         })
     }

     function tampilChat(id) {
         $.ajax({
             url: base_url + 'kejati/ajax/Konsultasi/cardChatKonsultasi/',
             type: "GET",
             success: function(data) {
                 $('#list-konsul' + id).siblings().hide()
                 $('#chat-konsultasi' + id).html(data).show()

             }
         })
         // $('#list-konsul' + id).siblings().hide('fast')


     }

     function tutupChat() {
         backList()
         $('[id^=chat-konsultasi]').empty()
     }

     function backList() {
         list()
         $('#tutup-list').show()
         $('#tombol-tambah').show()
     }

     function selesai(id) {
         $.ajax({
             url: base_url + 'kejati/ajax/Konsultasi/selesaiKonsul/' + id,
             type: "GET",
             success: function(data) {
                 if (data.status) {
                     handleToast("success", data.message);
                 } else {
                     handleError(data);
                 }
                 backList()
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert("Error get data from ajax");
                 $("#btnSave").text("Kirim ke atasan");
                 $("#btnSave").attr("disabled", false);
             },
             complete: function() {

             },
         })
     }
 </script>
 <script>

 </script>