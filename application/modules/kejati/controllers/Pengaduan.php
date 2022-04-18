<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends MX_Controller
{
    private $module = 'kejati';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        (count(array_intersect($userPermission, ["RPENGADUAN"])) > 0) ? '' : redirect('authentication/logout');
        
        $data['userPermission'] = $userPermission;
        $data['_view'] = $this->module . '/pengaduan';
        $this->load->view('layouts/back/main', $data);
    }
}
