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

     <div class="row">
         <div class="col">

             <button id="tombol-tambah" type="button" class="btn bg-gradient-primary" onclick="toTambahKonsultasi(<?= $id ?>,<?= $tugas_id ?>)"><i class="fa-solid fa-circle-plus"></i> Buat Konsultasi</button>
         </div>
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
            <p>Mulai konsultasi dengan ketua Tim</p>
        </div>`;
                     $('#content').html(html);
                 } else {
                     konsultasi.forEach(k => {
                         html += `<div id="list-konsul` + k['id'] + `"  class="card shadow-lg mb-1">
                                    <div class="card-body  pt-1" > 
                                    <div class="row">
                                    <div class="col-3">`;
                         if (k['waktu_selesai'] === null) {
                             html += '<span class="badge bg-gradient-warning">Proses</span>';
                         } else {
                             html += '<span class="badge bg-gradient-success">Selesai</span>';

                         }

                         html += `</div>
                         <div class="col-9 text-end">
                         <button class="btn btn-primary btn-sm" onclick="toEditKonsul(` + k['id'] + `)"><i class="fa-solid fa-file-pen"></i>edit</button>
                         </div>
                         </div>
                         <a onclick="tampilChat(` + k['id'] + `,` + <?= $pegawai_id_leader; ?> + `,` + <?= $pegawai_id; ?> + `)" href="javascript:;" class="card-title h5 mt-1 d-block text-darker mb-0">` +
                             k['judul'] +
                             `</a><div class="row">
                                        <small class=" col-10 card-description mb-0">` +
                             k['deskripsi'] +
                             `</small>
                                        
                                            <small class="col-2">` + k['postedOn'] + `</small>
                                        </div>
                                    </div>
                                    <div id="chat-konsultasi` + k['id'] + `" style="display : none"></div>
                                </div>
                                `;
                     });

                     $('#content').html(html);
                 }
             },
             error: function(e) {
                 console.log(e);
             }
         })
     }

     function tampilChat(id, pegawai_id_leader, pegawai_id) { // konsultasi_id, pegawai_id_leader, id_pegawai
         $.ajax({
             url: base_url + 'kejati/ajax/Konsultasi/cardChatKonsultasi/' + id + '/' + pegawai_id_leader + '/' + pegawai_id,
             type: "GET",
             success: function(data) {
                 $('#chat-konsultasi' + id).html(data)
                 localStorage.setItem('chatId' + id, 'show');
                 if ($('#chat-konsultasi' + id).css('display') === 'none' || $('#chat-konsultasi' + id).css("visibility") === "hidden") {
                     //  console.log('show');

                     localStorage.setItem('chatId' + id, 'hide');
                     //  console.log(localStorage.getItem('chatId' + id));
                 } else {
                     //  console.log('hide');
                     let myChat;
                     list();
                     localStorage.setItem('chatId' + id, 'show');
                     //  console.log(localStorage.getItem('chatId' + id));
                     //  $('#chat-konsultasi' + id).empty();
                 }
                 $('#close-modal1').click(function() {
                     localStorage.setItem('chatId' + id, 'show');
                 });
                 $('#close-modal2').click(function() {
                     localStorage.setItem('chatId' + id, 'show');
                 });
                 $('#chat-konsultasi' + id).toggle('slow');
                 $('#list-konsul' + id).siblings().toggle();


             }
         })
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
 </script>
 <script>

 </script>