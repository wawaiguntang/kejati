<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MX_Controller
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
        (!in_array('RU', $userPermission)) ? redirect('authentication/logout') : '';
        if ($action != '') {
            if ($id != '') {
                $this->db->where('id', $id)->update('notifikasi', ['isRead' => 1]);
            }
            $data['action'] = decrypt($action);
        }
        $data['_view'] = $this->module . '/users';
        $this->load->view('layouts/back/main', $data);
    }
}
