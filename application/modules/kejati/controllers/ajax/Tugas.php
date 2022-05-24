<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';
    private $sop_for = 'add';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/tugas_model', 'penyelidikan');
        $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
        $this->load->model($this->module . '/tugas_model', 'tugas');
        $this->load->model($this->module . '/pegawai_model', 'pegawai');
        $this->load->model($this->module . '/sop_model', 'sop');
        $this->load->model($this->module . '/kegiatan_model', 'kegiatan');
        $this->load->model($this->module . '/kelengkapan_model', 'kelengkapan');
        $this->load->model($this->module . '/hasil_model', 'hasil');
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda harus login terlebih dahulu!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            die();
        }
    }

    public function data()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $params = [
                'userPermission' => $userPermission
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Kejati",
                    "url" => base_url('kejati/tugas')
                ],
                [
                    "text" => "Tugas",
                ]
            ], 'Data Tugas');
            $data['data'] =  $this->load->view($this->module . '/tugas/index', $params, TRUE);
            $this->output
                ->set_content_type('application/json')
                ->set_output(
                    json_encode($data)
                );
        }
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->penyelidikan->get_datatables();
        $data = array();
        foreach ($list as $penyelidikan) {
            $check = $this->db
                ->join('pegawai_detail_tugas', 'pegawai_detail_tugas.detail_tugas_id=detail_tugas.id')
                ->join('pegawai', 'pegawai.id=pegawai_detail_tugas.pegawai_id')
                ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.tugas_id' => $penyelidikan->id, 'pegawai.userCode' => $this->session->userdata('userCode')])->result_array();
            if ($check != NULL) {
                $row = array();
                $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->no_surat_tugas . '</b></p>
                            <p class="text-sm d-flex py-auto my-auto">Jumlah Tugas : ' . count($check) . '</p>';
                $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->no_nota_dinas . '</b></p>';
                $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->sop . '</b></p>';
                $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . character_limiter($penyelidikan->perihal, 25) . '</b></p>';

                // $row[] = "
                //     <div class='d-flex justify-content-center'>
                //     " . ((in_array('UPENYELIDIKAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Ubah" onclick="editData(' . $penyelidikan->id . ')"></i>' : '') . "
                //     " . ((in_array('DPENYELIDIKAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Hapus" onclick="deleteData(' . $penyelidikan->id . ')"></i>' : '') . "
                //     " . ((in_array('RDETAILPENYELIDIKAN', $userPermission)) ? '<i class="ri-information-line ri-lg text-primary m-1" role="button" title="Info" onclick="detail(' . $penyelidikan->id . ')"></i>' : '') . "
                //     </div>
                //     ";

                $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('RDETAILTUGASSELF', $userPermission)) ? '<i class="ri-information-line ri-lg text-primary m-1" role="button" title="Info" onclick="detail(' . $penyelidikan->id . ')"></i>' : '') . "
                </div>
            ";

                $data[] = $row;
            }
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->penyelidikan->count_all(),
            "recordsFiltered" => $this->penyelidikan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function detail()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode tugas dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $temp = [];
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, detail_tugas.catatan, detail_tugas.umum,sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'tugas.id' => $this->input->post('tugas_id')])
            ->result_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        foreach ($tugas as $t => $v) {
            $r = $v;
            $r['pegawai'] = $this->db
                ->select('*,pegawai_detail_tugas.id as pdtId')
                ->join('pegawai', 'pegawai.id=pegawai_detail_tugas.pegawai_id')
                ->join('user', 'user.userCode=pegawai.userCode', 'left')
                ->where(['pegawai.deleteAt' => NULL, 'pegawai_detail_tugas.deleteAt' => NULL, 'pegawai_detail_tugas.detail_tugas_id' => $v['id']])
                ->get('pegawai_detail_tugas')
                ->result_array();
            $r['leader'] = $this->db
                ->select('pegawai.userCode')
                ->join('pegawai', 'pegawai.id=pegawai_detail_tugas.pegawai_id')
                ->where(['pegawai.deleteAt' => NULL, 'pegawai_detail_tugas.deleteAt' => NULL, 'pegawai_detail_tugas.leader' => 1, 'pegawai_detail_tugas.detail_tugas_id' => $v['id']])
                ->get('pegawai_detail_tugas')
                ->row_array();
            $r['kelengkapan'] = $this->db->join('kelengkapan', 'kelengkapan.id=kelengkapan_data.kelengkapan_id')
                ->where(['kelengkapan.deleteAt' => NULL, 'kelengkapan_data.deleteAt' => NULL, 'kelengkapan_data.detail_tugas_id' => $v['id']])
                ->get('kelengkapan_data')
                ->result_array();
            $r['hasil'] = $this->db
                ->join('hasil', 'hasil.id=hasil_data.hasil_id')
                ->where(['hasil.deleteAt' => NULL, 'hasil_data.deleteAt' => NULL, 'hasil_data.detail_tugas_id' => $v['id']])
                ->get('hasil_data')
                ->result_array();
            $temp[] = $r;
        }
        $tug = $this->db->join('sop', 'sop.id=tugas.sop_id')->get_where('tugas', ['tugas.deleteAt' => NULL, 'tugas.id' => $this->input->post('tugas_id')])->row_array();
        $pengaduan = $this->pengaduan->get_by_id($tug['pengaduan_id']);
        if ($pengaduan == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pengaduan tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $data['status'] = TRUE;
        $params = [
            'title' => 'Detail tugas',
            'tugas_id' => $this->input->post('tugas_id'),
            'tugas' => $tug,
            'detail_tugas' => $temp,
            'pengaduan' => $this->load->view($this->module . '/tugas/pengaduan', $pengaduan, TRUE),
        ];
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Kejati",
                "url" => base_url('kejati/tugas')
            ],
            [
                "text" => "Tugas",
                "action" => "back()"
            ],
            [
                "text" => "Detail Data Tugas"
            ]
        ], 'Detail Data Tugas');

        $data['data'] = $this->load->view($this->module . '/tugas/detail/index', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function addTugasUntukAnggota()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $pegawai_detail_tugas = $this->db->get_where('pegawai_detail_tugas', ['deleteAt' => NULL, 'id' => $this->input->post('id')])->row_array();
        if ($pegawai_detail_tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'title' => 'Bagi tugas untuk anggota',
            'id' => $this->input->post('id'),
            'detail_tugas_id' => $this->input->post('detail_tugas_id'),
            'tugas' => $pegawai_detail_tugas['tugas'],
        ];
        $data['status'] = TRUE;
        $data['data'] = modal('addTugasUntukAnggota', $this->load->view($this->module . '/tugas/detail/tugas_anggota', $params, TRUE));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function saveTugasUntukAnggota()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $pegawai_detail_tugas = $this->db->get_where('pegawai_detail_tugas', ['deleteAt' => NULL, 'id' => $this->input->post('id')])->row_array();
        if ($pegawai_detail_tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tempTugas = json_decode($pegawai_detail_tugas['tugas'],TRUE);
        if($this->input->post('tugas') != NULL){
            $tempTugas[] = [
                'tugas' => $this->input->post('tugas'),
                'createAt' => date('Y-m-d H:i:s')
            ];
        }
        $tempTugas = json_encode($tempTugas,TRUE);
        $params = [
            'tugas' => $tempTugas,
        ];
        $update = $this->db->where('id', $this->input->post('id'))->update('pegawai_detail_tugas', $params);
        if ($update) {
            $data['status'] = TRUE;
            $data['message'] = "Berhasil memberikan tugas ke anggota";
        } else {
            $data['status'] = FALSE;
            $data['message'] = "Gagal memberikan tugas ke anggota";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function addTugasUmumUntukAnggota()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'title' => 'Bagi instruksi umum untuk anggota',
            'detail_tugas_id' => $this->input->post('detail_tugas_id'),
        ];
        $data['status'] = TRUE;
        $data['data'] = modal('addTugasUmumUntukAnggota', $this->load->view($this->module . '/tugas/detail/tugas_umum_anggota', $params, TRUE));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function saveTugasUmumUntukAnggota()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka,  detail_tugas.umum, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        
        $tempTugas = json_decode($tugas['umum'],TRUE);
        if($this->input->post('umum') != NULL){
            $tempTugas[] = [
                'umum' => $this->input->post('umum'),
                'createAt' => date('Y-m-d H:i:s')
            ];
        }
        $tempTugas = json_encode($tempTugas,TRUE);
        $params = [
            'umum' => $tempTugas,
        ];
        $update = $this->db->where('id', $this->input->post('detail_tugas_id'))->update('detail_tugas', $params);
        if ($update) {
            $data['status'] = TRUE;
            $data['message'] = "Berhasil memberikan instruksi umum ke anggota";
        } else {
            $data['status'] = FALSE;
            $data['message'] = "Gagal memberikan instruksi umum ke anggota";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function bagikan()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $update = $this->db->where('id', $this->input->post('detail_tugas_id'))->update('detail_tugas', ['dibuka' => '2']);
        if ($update) {
            $notifParam = [];
            $pegawai = $this->db->get_where('pegawai_detail_tugas', ['detail_tugas_id' => $this->input->post('detail_tugas_id'), 'deleteAt' => NULL])->result_array();
            foreach ($pegawai as $p => $i) {
                $p = $this->db->get_where('pegawai', ['pegawai.deleteAt' => NULL, 'pegawai.id' => $i['pegawai_id']])->row_array();
                if ($this->session->userdata('userCode') != $p['userCode']) {
                    $notifParam[] = [
                        'from' => $this->session->userdata('userCode'),
                        'to' => $p['userCode'],
                        'description' => "Anda diberi tugas oleh ketua tim dalam kegiatan " . $tugas['kegiatan'] . " dengan no surat tugas " . $tugas['no_surat_tugas'],
                        'data' => json_encode([
                            'link' => base_url('kejati/tugas/index/' . encrypt('detail(' . $tugas['id'] . ');')),
                            'action' => 'detail(' . $tugas['id'] . ');'
                        ], true)
                    ];
                }
            }

            $notif = $this->db->insert_batch('notifikasi', $notifParam);
            if ($notif == FALSE) {
                $data['status'] = FALSE;
                $data['message'] = "Gagal memberikan tugas ke anggota";
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $data['status'] = TRUE;
            $data['message'] = "Berhasil membagikan tugas ke anggota";
        } else {
            $data['status'] = FALSE;
            $data['message'] = "Berhasil membagikan tugas ke anggota";
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function addFile()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $pegawai_detail_tugas = $this->db->get_where('pegawai_detail_tugas', ['deleteAt' => NULL, 'id' => $this->input->post('id')])->row_array();
        if ($pegawai_detail_tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'title' => 'Upload dokumen',
            'id' => $this->input->post('id'),
            'detail_tugas_id' => $this->input->post('detail_tugas_id'),
        ];
        $data['status'] = TRUE;
        $data['data'] = modal('addFile', $this->load->view($this->module . '/tugas/detail/upload_file', $params, TRUE));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function saveFile()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $pegawai_detail_tugas = $this->db->get_where('pegawai_detail_tugas', ['deleteAt' => NULL, 'id' => $this->input->post('id')])->row_array();
        if ($pegawai_detail_tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pegawai tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nama', 'Kegiatan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'nama' => form_error('nama'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'nama' => $this->input->post('nama'),
            );

            if (isset($_FILES['dokumen']['name'])) {
                $config['upload_path'] = './assets/kejati/dokumenTim/';
                $config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx';
                $config['max_size']     = '20000';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('dokumen')) {
                    $errors = array('dokumen' => $this->upload->display_errors());
                    $data = array(
                        'status'         => FALSE,
                        'errors'         => $errors
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $dataFile = $this->upload->data();
                    $insert['dokumen'] = $dataFile['file_name'];

                    $dokumen = ($pegawai_detail_tugas['dokumen'] == NULL) ? [] : json_decode($pegawai_detail_tugas['dokumen'], TRUE);
                    $dokumen[] = [
                        'nama' => $insert['nama'],
                        'dokumen' => $insert['dokumen']
                    ];

                    $update = $this->db->where('id', $this->input->post('id'))->update('pegawai_detail_tugas', ['dokumen' => json_encode($dokumen, TRUE)]);
                    if ($update) {
                        $leader = $this->db->get_where('pegawai_detail_tugas', ['detail_tugas_id' => $pegawai_detail_tugas['detail_tugas_id'], 'leader' => 1])->row_array();
                        $p = $this->db->get_where('pegawai', ['pegawai.deleteAt' => NULL, 'pegawai.id' => $pegawai_detail_tugas['pegawai_id']])->row_array();
                        $l = $this->db->get_where('pegawai', ['pegawai.deleteAt' => NULL, 'pegawai.id' => $leader['pegawai_id']])->row_array();
                        $notifParam = [
                            'from' => $this->session->userdata('userCode'),
                            'to' => $l['userCode'],
                            'description' => $p['nama'] . ' mengunggah dokumen ' . $this->input->post('nama') . ' dalam kegiatan ' . $tugas['kegiatan'],
                            'data' => json_encode([
                                'link' => base_url('kejati/tugas/index/' . encrypt('detail(' . $tugas['id'] . ');')),
                                'action' => 'detail(' . $tugas['id'] . ');'
                            ], true)
                        ];

                        $notif = $this->db->insert('notifikasi', $notifParam);
                        if ($notif == FALSE) {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengunggah dokumen";
                            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        }
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil mengunggah dokumen";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal mengunggah dokumen";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            } else {
                $data = array(
                    'status'         => FALSE,
                    'errors'         => [
                        'file' => 'File is required'
                    ]
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function uploadHasilHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode tugas dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $data['status'] = TRUE;

        $hasil = $this->hasil->get_by_id($this->input->post('hasil_id'));

        $params = [
            'title' => 'Upload file ' . $hasil->hasil,
            'detail_tugas_id' => $this->input->post('detail_tugas_id'),
            'hasil_id' => $this->input->post('hasil_id'),
        ];
        $data['data'] = modal('upload_hasil', $this->load->view($this->module . '/tugas/detail/upload_hasil', $params, TRUE));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function uploadHasil()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data = array();
            $data['status'] = TRUE;

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('detail_tugas_id', 'Tugas', 'trim|required');
            $this->form_validation->set_rules('hasil_id', 'Hasil', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'detail_tugas_id' => form_error('detail_tugas_id'),
                    'hasil_id' => form_error('hasil_id')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'detail_tugas_id' => $this->input->post('detail_tugas_id'),
                    'hasil_id' => $this->input->post('hasil_id')
                );

                $tugas = $this->db
                    ->select('tugas.id as tugas_id')
                    ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
                    ->join('sop', 'sop.id=tugas.sop_id')
                    ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
                    ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
                    ->row_array();
                if ($tugas == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Tugas tidak ditemukan"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                if (isset($_FILES['dokumen']['name'])) {
                    $config['upload_path'] = './assets/kejati/files/';
                    $config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx';
                    $config['max_size']     = '20000';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('dokumen')) {
                        $errors = array('dokumen' => $this->upload->display_errors());
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $dataFile = $this->upload->data();
                        $insert['dokumen'] = $dataFile['file_name'];
                        $insert['tipe'] = $dataFile['file_type'];

                        $update = $this->db->where([
                            'detail_tugas_id' => $this->input->post('detail_tugas_id'),
                            'hasil_id' => $this->input->post('hasil_id')
                        ])->update('hasil_data', $insert);
                        if ($update) {
                            $data['status'] = TRUE;
                            $data['tugas_id'] = $tugas['tugas_id'];
                            $data['message'] = "Berhasil mengunggah dokumen";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengunggah dokumen";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                } else {
                    $data = array(
                        'status'         => FALSE,
                        'errors'         => [
                            'file' => 'Dokumen is required'
                        ]
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    public function kirim()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('detail_tugas.id as id, detail_tugas.dibuka, detail_tugas.tugas_id, tugas.userCode as pembuatTugas, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->where_in('detail_tugas.status', ['Dalam proses', 'Ditolak'])
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id')])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $update = $this->db->where('id', $this->input->post('detail_tugas_id'))->update('detail_tugas', ['status' => 'Ditinjau atasan', 'waktu_selesai' => date('Y-m-d H:i:s')]);
        if ($update) {
            $leader = $this->db->get_where('pegawai_detail_tugas', ['detail_tugas_id' => $tugas['id'], 'leader' => 1])->row_array();
            $l = $this->db->get_where('pegawai', ['pegawai.deleteAt' => NULL, 'pegawai.id' => $leader['pegawai_id']])->row_array();
            $notifParam = [
                'from' => $this->session->userdata('userCode'),
                'to' => $tugas['pembuatTugas'],
                'description' => $l['nama'] . ' mengirim hasil dokumen kegiatan ' . $tugas['kegiatan'],
                'data' => json_encode([
                    'link' => base_url('kejati/penyelidikan/index/' . encrypt('detail(' . $tugas['tugas_id'] . ');')),
                    'action' => 'detail(' . $tugas['tugas_id'] . ');'
                ], true)
            ];

            $notif = $this->db->insert('notifikasi', $notifParam);
            if ($notif == FALSE) {
                $data['status'] = FALSE;
                $data['message'] = "Gagal mengirim tugas ke atasan";
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $data['status'] = TRUE;
            $data['message'] = "Berhasil mengirim tugas ke atasan";
        } else {
            $data['status'] = FALSE;
            $data['message'] = "Gagal mengirim tugas ke atasan";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
