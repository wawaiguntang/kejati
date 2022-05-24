<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Index extends MX_Controller
{
    private $module = 'dashboard';
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Dashboard",
                "url" => base_url('dashboard/index')
            ],
            [
                "text" => "Home",
            ]
        ], 'Home');

        $view = [];
        if (in_array('RDASHAPP', $userPermission)) {
            $setting = APPPATH . 'modules\dashboard\dashboard.json';
            if (file_exists($setting)) {
                $setting = json_decode(file_get_contents(separator($setting)), TRUE);
                foreach ($setting as $k => $v) {
                    $viewPerModule = APPPATH . 'modules\\' . $v['modules'] . '\dashboard.json';
                    if (file_exists($viewPerModule)) {
                        $viewPerModule = json_decode(file_get_contents(separator($viewPerModule)), TRUE);
                        foreach ($v['view'] as $s => $d) {
                            if (isset($viewPerModule[$d])) {
                                $view[] = ["path" => $v['modules'] . $viewPerModule[$d]['view'], "params" => $viewPerModule[$d]['params']];
                            }
                        }
                    }
                }
            }
        }else{
            $view = $this->module . '/index';
        }
        $data['_view'] = $view;
        $this->load->view('layouts/back/main', $data);
    }
}
