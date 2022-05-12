<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends MX_Controller
{
    private $module = 'management_users';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
    }

    public function index($action = '', $id = '')
    {
        $userPermission = getPermissionFromUser();
        (!in_array('RR', $userPermission)) ? redirect('authentication/logout') : '';
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Management Users",
                "url" => base_url('management_users/users')
            ],
            [
                "text" => "Roles",
            ]
        ], 'Data Roles');
        if($action != ''){
            if ($id != '') {
                $this->db->where('id', $id)->update('notifikasi', ['isRead' => 1]);
            }
            $data['action'] = decrypt($action);
        }
        $data['_view'] = $this->module . '/roles';
        $this->load->view('layouts/back/main', $data);
    }
}
