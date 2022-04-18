<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan extends MX_Controller
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
        (count(array_intersect($userPermission, ["RPENYELIDIKAN"])) > 0) ? '' : redirect('authentication/logout');
        
        $data['userPermission'] = $userPermission;
        $data['_view'] = $this->module . '/penyelidikan';
        $this->load->view('layouts/back/main', $data);
    }
}
