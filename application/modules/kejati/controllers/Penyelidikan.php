<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan extends MX_Controller
{
    private $module = 'kejati';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
        $this->session->unset_userdata('temp_edit');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        (count(array_intersect($userPermission, ["RPENYELIDIKAN"])) > 0) ? '' : redirect('authentication/logout');
        $pengaduan = [];
        $pengaduan[0] = '-- Semua --';
        $getPengaduan = $this->pengaduan->get_all();
        foreach ($getPengaduan as $k) {
            $pengaduan[$k->id] = $k->no;
        }
        $data['pengaduan'] = $pengaduan;
        $data['userPermission'] = $userPermission;
        $data['_view'] = $this->module . '/penyelidikan';
        $this->load->view('layouts/back/main', $data);
    }

    public function download($path, $name)
    {
        $this->load->helper('download');

        force_download($name, file_get_contents(DIR . decrypt($path)));
    }
}
