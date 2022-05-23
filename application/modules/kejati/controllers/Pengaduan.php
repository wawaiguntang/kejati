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

    public function index($action = '', $id = '')
    {
        $userPermission = getPermissionFromUser();
        (count(array_intersect($userPermission, ["RPENGADUAN"])) > 0) ? '' : redirect('authentication/logout');
        if($action != ''){
               if($id != ''){
                $this->db->where('id',$id)->update('notifikasi',['isRead' => 1]);
            }
            $data['action'] = decrypt($action);
        }
        $data['userPermission'] = $userPermission;
        $data['_view'] = $this->module . '/pengaduan';
        $this->load->view('layouts/back/main', $data);
    }
}
