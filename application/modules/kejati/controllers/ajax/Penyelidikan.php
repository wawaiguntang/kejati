<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        // $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You must login first!"
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
        if (!in_array('RPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission
        ];
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Kejati",
                "url" => base_url('kejati/penyelidikan')
            ],
            [
                "text" => "Penyelidikan",
            ]
        ], 'Data Penyelidikan');
        $data['data'] =  $this->load->view($this->module . '/penyelidikan/index', $params, TRUE);
        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode($data)
            );
    }
}
