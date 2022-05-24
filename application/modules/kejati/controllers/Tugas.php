<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends MX_Controller
{
    private $module = 'kejati';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
    }

    public function index($action = '', $id = '')
    {
        $userPermission = getPermissionFromUser();
        (count(array_intersect($userPermission, ["RTUGASSELF"])) > 0) ? '' : redirect('authentication/logout');
        $data['userPermission'] = $userPermission;
        if ($action != '') {
            if ($id != '') {
                $this->db->where('id', $id)->update('notifikasi', ['isRead' => 1]);
            }
            $data['action'] = decrypt($action);
        }
        $data['_view'] = $this->module . '/tugas';
        $this->load->view('layouts/back/main', $data);
    }

    public function download($path, $name)
    {
        $this->load->helper('download');

        force_download($name, file_get_contents(DIR . separator(decrypt($path))));
    }
}
