<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
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
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();

        $allData = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();

        $done = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'dt.status' => 'Diterima'
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $doneData = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe,
                'dt.status' => 'Diterima'
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $running = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where_in('dt.status', ['Dalam proses', 'Ditinjau atasan'])
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $runningData = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where_in('dt.status', ['Dalam proses', 'Ditinjau atasan'])
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $reject = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'dt.status' => 'Ditolak'
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
        $rejectData = $this->db
            ->select('*')
            ->join('pegawai p', 'p.id=pdt.pegawai_id')
            ->join('detail_tugas dt', 'dt.id=pdt.detail_tugas_id')
            ->join('tugas t', 't.id=dt.tugas_id')
            ->where([
                'pdt.deleteAt' => NULL,
                'p.userCode' => $this->session->userdata('userCode'),
                'pdt.leader' => $tipe,
                'dt.status' => 'Ditolak'
            ])
            ->get('pegawai_detail_tugas pdt')->result_array();
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
            'data' => $params
        );
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
