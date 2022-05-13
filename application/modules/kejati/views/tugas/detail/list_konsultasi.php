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
 <div id="content"></div>
 <script>
     let id = "<?= $id ?>"
     let html = ``
     $.ajax({
         url: base_url + 'kejati/ajax/Konsultasi/all/' + id,
         type: 'GET',
         success: function(data) {

             let konsultasi = data.data['konsultasi']
             console.log(konsultasi);
             if (konsultasi === undefined) {
                 html += `<div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-3">Belum ada pesan</h4>
        <p>Mulai konsultasi dengan ketua Tim</p>
    </div>`
                 $('#content').html(html)
             } else {
                 konsultasi.forEach(k => {
                     html += `<div id="list-konsul` + k['id'] + `" onclick="tampilChat(` + k['id'] + `)" class="card shadow-lg mb-1">
                                <div class="card-body pt-1">
                                    <span class="badge bg-gradient-success">Selesai</span>
                                    <a href="javascript:;" class="card-title h5 mt-3 d-block text-darker mb-0">` +
                         k['judul'] +
                         `</a>
                                    <p class="card-description mb-0">` +
                         k['deskripsi'] +
                         `</p>
                                    <div class="row">
                                        <small class="text-end">` + k['postedOn'] + `</small>
                                    </div>
                                </div>
                            </div>`
                 });

                 $('#content').html(html)
             }
         }
     })

     function tampilChat(id) {

         $('#list-konsul' + id).siblings().hide('fast')
         $('#chat-konsul').show('fast')

     }

     function tutupChat() {
         $('#chat-konsul').hide('fast')
         $('[id^="list-konsul"]').show()
     }
 </script>