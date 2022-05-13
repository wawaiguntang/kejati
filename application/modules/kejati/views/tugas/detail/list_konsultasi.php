 <!-- jika belum ada pesan -->
 <div>lkjhsdllkasdjlaslk</div>
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
     $.ajax({
         url: base_url + 'kejati/ajax/Konsultasi/all/' + <?= $id ?>,
         type: 'GET',
         success: function(data) {

             let html = ``;
             let konsultasi = data.data['konsultasi'];

             if (konsultasi === undefined) {
                 html += `<div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-3">Belum ada pesan</h4>
        <p>Mulai konsultasi dengan ketua Tim</p>
    </div>`;
                 $('#content').html(html);
             } else {
                 konsultasi.forEach(k => {
                     html += `<div id="list-konsul` + k['id'] + `" onclick="tampilChat(` + k['id'] + `)" class="card shadow-lg mb-1">
                                <div class="card-body pt-1"> 
                                <div class="row">
                                <div class="col-10">`;
                     if (k['waktu_selesai'] === null) {
                         html += '<span class="badge bg-gradient-warning">Proses</span>';
                     } else {
                         html += '<span class="badge bg-gradient-success">Selesai</span>';

                     }

                     html += `</div>
                     <div class="col-2">
                     <button class="btn btn-primary btn-sm" onclick="toEditKonsul(` + k['id'] + `)">edit</button>
                     </div>
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
                            </div>`;
                 });

                 $('#content').html(html);
             }
         },
         error: function(e) {
             console.log(e);
         }
     })
 </script>