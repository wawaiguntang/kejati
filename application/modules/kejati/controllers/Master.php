<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends MX_Controller
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
        (count(array_intersect($userPermission, ["RJABATAN", "RPANGKAT", "RGOLONGAN"])) > 0) ? '' : redirect('authentication/logout');
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Kejati",
                "url" => base_url('kejati/master')
            ],
            [
                "text" => "Master",
            ]
        ], 'Data Master');
        if ($action != '') {
            if($id != ''){
                $this->db->where('id',$id)->update('notifikasi',['isRead' => 1]);
            }
            $data['action'] = decrypt($action);
        }
        $data['userPermission'] = $userPermission;
        $data['_view'] = $this->module . '/master';
        $this->load->view('layouts/back/main', $data);
    }
}
