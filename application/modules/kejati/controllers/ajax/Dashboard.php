<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/penyelidikan_model', 'penyelidikan');
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
                'message'         => "Anda harus login terlebih dahulu"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->load->model($this->module . '/tugas_model', 'tugas');
        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        //     die();
        // }
    }

    public function get()
    {
        $userPermission = getPermissionFromUser();
        $anggota = ($this->input->post('tipe') == NULL) ? 'anggota' : $this->input->post('tipe');
        if ($anggota == 'anggota') {
            $tipe = '0';
        } else {
            $tipe = '1';
        }
        $all = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();

        $allData = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe
            ])
            ->order_by('dt.id', 'DESC')
            ->get('pegawai_detail_tugas pdt')->result_array();

        $tempAllData = $allData;
        $allData = [];
        foreach ($tempAllData as $k => $v) {
            $awal  = strtotime($v['waktu_mulai']);
            $akhir = strtotime($v['waktu_selesai']);
            $diff  = $akhir - $awal;

            $jam = floor($diff / (60 * 60));
            if ($v['satuan'] == 'menit') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - $v['waktu'] . " Menit";
                if ($v['selisih'] > $v['waktu']) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'jam') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60) . " Jam";
                if ($v['selisih'] > ($v['waktu'] * 60)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'hari') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60 * 24) . " Hari";
                if ($v['selisih'] > ($v['waktu'] * 60 * 24)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            }
            // $v['selisih'] = formatWaktu($v['selisih']);
            $allData[] = $v;
        }
        $done = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'dt.status' => 'Diterima'
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $doneData = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe,
                'dt.status' => 'Diterima'
            ])
            ->order_by('dt.id', 'DESC')
            ->get('pegawai_detail_tugas pdt')->result_array();
        $tempDoneData = $doneData;
        $doneData = [];
        foreach ($tempDoneData as $k => $v) {
            $awal  = strtotime($v['waktu_mulai']);
            $akhir = strtotime($v['waktu_selesai']);
            $diff  = $akhir - $awal;

            $jam = floor($diff / (60 * 60));
            if ($v['satuan'] == 'menit') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - $v['waktu'] . " Menit";
                if ($v['selisih'] > $v['waktu']) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'jam') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60) . " Jam";
                if ($v['selisih'] > ($v['waktu'] * 60)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'hari') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60 * 24) . " Hari";
                if ($v['selisih'] > ($v['waktu'] * 60 * 24)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            }
            // $v['selisih'] = formatWaktu($v['selisih']);
            $doneData[] = $v;
        }
        $running = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where_in('dt.status', ['Dalam proses', 'Ditinjau atasan'])
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $runningData = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where_in('dt.status', ['Dalam proses', 'Ditinjau atasan'])
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe
            ])
            ->order_by('dt.id', 'DESC')
            ->get('pegawai_detail_tugas pdt')->result_array();

        $tempRunningData = $runningData;
        $runningData = [];
        foreach ($tempRunningData as $k => $v) {
            $awal  = strtotime($v['waktu_mulai']);
            $akhir = strtotime($v['waktu_selesai']);
            $diff  = $akhir - $awal;

            $jam = floor($diff / (60 * 60));
            if ($v['satuan'] == 'menit') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - $v['waktu'] . " Menit";
                if ($v['selisih'] > $v['waktu']) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'jam') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60) . " Jam";
                if ($v['selisih'] > ($v['waktu'] * 60)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'hari') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60 * 24) . " Hari";
                if ($v['selisih'] > ($v['waktu'] * 60 * 24)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            }
            // $v['selisih'] = formatWaktu($v['selisih']);
            $runningData[] = $v;
        }
        $reject = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'dt.status' => 'Ditolak'
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $rejectData = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe,
                'dt.status' => 'Ditolak'
            ])
            ->order_by('dt.id', 'DESC')
            ->get('pegawai_detail_tugas pdt')->result_array();

        $tempRejectData = $rejectData;
        $rejectData = [];
        foreach ($tempRejectData as $k => $v) {
            $awal  = strtotime($v['waktu_mulai']);
            $akhir = strtotime($v['waktu_selesai']);
            $diff  = $akhir - $awal;

            $jam = floor($diff / (60 * 60));
            if ($v['satuan'] == 'menit') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - $v['waktu'] . " Menit";
                if ($v['selisih'] > $v['waktu']) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'jam') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60) . " Jam";
                if ($v['selisih'] > ($v['waktu'] * 60)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            } elseif ($v['satuan'] == 'hari') {
                $v['selisih'] = round((($diff - $jam * (60 * 60)) / 60), 0) - ($v['waktu'] * 60 * 24) . " Hari";
                if ($v['selisih'] > ($v['waktu'] * 60 * 24)) {
                    $v['status_waktu'] = 'lewat';
                } else {
                    $v['status_waktu'] = 'kurang';
                }
            }
            $rejectData[] = $v;
        }
        $params = [
            'all' => [
                'count' => count($all),
                'data' => $allData
            ],
            'running' => [
                'count' => count($running),
                'data' => $runningData
            ],
            'done' => [
                'count' => count($done),
                'data' => $doneData
            ],
            'reject' => [
                'count' => count($reject),
                'data' => $rejectData
            ]
        ];
        $data = array(
            'status' => TRUE,
            'data' => $params,
            'pimpinan' => TRUE

        );
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode tugas dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $temp = [];
        $tugas = $this->db
            ->select('dt.id, k.kegiatan, t.no_surat_tugas, pe.no, dt.status, dt.waktu_mulai, dt.waktu_selesai, dt.waktu, dt.satuan, dt.umum, pdt.leader, pdt.tugas, pdt.id as pdtId')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('kegiatan k', 'k.id=dt.kegiatan_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->join('pengaduan pe', 'pe.id=t.pengaduan_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'dt.id' => $this->input->post('id'),
                'p.userCode' => $this->session->userdata('userCode')
            ])
            ->get('pegawai_detail_tugas pdt')->row_array();

        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'instruksi' => json_decode($tugas['umum'], TRUE),
            'tugas' => json_decode($tugas['tugas'], TRUE),
            'leader' => $tugas['leader'],
        ];

        if ($tugas['leader'] == 0) {
            $d = $this->db->order_by("id", "desc")->get_where('konsultasi', ['deleteAt' => NULL, 'pegawai_detail_tugas_id' => $tugas['pdtId']])->result_array();
            $temp = [];
            foreach ($d as $k => $v) {
                $r = $v;
                $r['postedOn'] = nice_date($v['createAt'], 'F d, Y');
                $temp[] = $r;
            }
            $params['konsultasi'] =  $temp;
        } else {
            $params['pegawai'] = $this->db
                ->select('*,pegawai_detail_tugas.id as pdtId')
                ->join('pegawai', 'pegawai.id=pegawai_detail_tugas.pegawai_id')
                ->join('user', 'user.userCode=pegawai.userCode', 'left')
                ->where(['pegawai.deleteAt' => NULL, 'pegawai_detail_tugas.deleteAt' => NULL, 'pegawai_detail_tugas.detail_tugas_id' => $tugas['id']])
                ->get('pegawai_detail_tugas')
                ->result_array();
        }
        $params['id'] = $this->input->post('id');
        $params['pdtId'] = $tugas['pdtId'];


        $data['status'] = TRUE;
        $data['data'] = $this->load->view($this->module . '/dashboard/detail', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function koordinasi()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('pdtId') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $d = $this->db->order_by("id", "desc")->get_where('konsultasi', ['deleteAt' => NULL, 'pegawai_detail_tugas_id' => $this->input->post('pdtId')])->result_array();

        $temp = [];
        foreach ($d as $k => $v) {
            $r = $v;
            $r['postedOn'] = nice_date($v['createAt'], 'F d, Y');
            $temp[] = $r;
        }
        $params['konsultasi'] =  $temp;
        $params['id'] = $this->input->post('id');
        $params['pdtId'] = $this->input->post('pdtId');
        $tugas = $this->db->get_where('pegawai_detail_tugas', ['id' => $this->input->post('pdtId')])->row_array();
        $params['tugas'] = json_decode($tugas['tugas'], TRUE);

        $data['status'] = TRUE;
        $data['data'] = $this->load->view($this->module . '/dashboard/koordinasi', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    public function chat()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('pdtId') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        if ($this->input->post('konsultasi_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $d = $this->db->order_by("id", "desc")->get_where('konsultasi', ['deleteAt' => NULL, 'id' => $this->input->post('konsultasi_id')])->row_array();
        $d['postedOn'] = nice_date($d['createAt'], 'F d, Y');

        $ad = $this->db
            ->select('*,detail_konsultasi.createAt as postedAd')
            ->get_where('detail_konsultasi', ['detail_konsultasi.deleteAt' => NULL, 'detail_konsultasi.konsultasi_id' => $this->input->post('konsultasi_id')])->result_array();
        $sf = [];
        foreach ($ad as $k => $v) {
            $r['dari'] = $v['dari'];
            $r['untuk'] = $v['untuk'];
            $r['pesan'] = $v['pesan'];
            $r['postedAd'] = nice_date($v['postedAd'], 'F d, Y, g:i a');
            $sf[] = $r;
        }

        $self = $this->db->get_where('pegawai', ['deleteAt' => NULL, 'userCode' => $this->session->userdata('userCode')])->row_array();
        $params['koordinasi'] =  $d;
        $params['chat'] =  $sf;
        $params['self'] =  $self;
        $params['id'] = $this->input->post('id');
        $params['pdtId'] = $this->input->post('pdtId');



        $data['status'] = TRUE;
        $data['data'] = $this->load->view($this->module . '/dashboard/chat', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function chat_self()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILTUGASSELF', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('pdtId') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        if ($this->input->post('id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        if ($this->input->post('konsultasi_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kode koordinasi dibutuhkan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $d = $this->db->order_by("id", "desc")->get_where('konsultasi', ['deleteAt' => NULL, 'id' => $this->input->post('konsultasi_id')])->row_array();
        $d['postedOn'] = nice_date($d['createAt'], 'F d, Y');

        $ad = $this->db
            ->select('*,detail_konsultasi.createAt as postedAd')
            ->get_where('detail_konsultasi', ['detail_konsultasi.deleteAt' => NULL, 'detail_konsultasi.konsultasi_id' => $this->input->post('konsultasi_id')])->result_array();
        $sf = [];
        foreach ($ad as $k => $v) {
            $r['dari'] = $v['dari'];
            $r['untuk'] = $v['untuk'];
            $r['pesan'] = $v['pesan'];
            $r['postedAd'] = nice_date($v['postedAd'], 'F d, Y, g:i a');
            $sf[] = $r;
        }

        $self = $this->db->get_where('pegawai', ['deleteAt' => NULL, 'userCode' => $this->session->userdata('userCode')])->row_array();
        $params['koordinasi'] =  $d;
        $params['chat'] =  $sf;
        $params['self'] =  $self;
        $params['id'] = $this->input->post('id');
        $params['pdtId'] = $this->input->post('pdtId');



        $data['status'] = TRUE;
        $data['data'] = $this->load->view($this->module . '/dashboard/chat_self', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
