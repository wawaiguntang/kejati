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

    public function all()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->tugas->get_datatables();
        $data = array();
        foreach ($list as $tugas) {
            $row = array();
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b><span class="badge ' . (($tugas->detail_tugasStatus == 'Ditinjau atasan' || $tugas->detail_tugasStatus == 'Dalam proses') ? 'bg-warning' : (($tugas->detail_tugasStatus == 'Ditolak') ? 'bg-danger' : 'bg-success')) . '">' . $tugas->detail_tugasStatus . '</span>' . '</b></p>
            <p class="text-sm d-flex py-auto my-auto">' . $tugas->waktu . ' ' . $tugas->satuan . '</p>
            <p class="text-xs d-flex py-auto my-auto">Mulai: ' . $tugas->waktu_mulai . '</p>
            <p class="text-xs d-flex py-auto my-auto">Selesai: ' . $tugas->waktu_selesai . '</p>';
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->tugas->count_all(),
            "recordsFiltered" => $this->tugas->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
