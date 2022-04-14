<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Index extends MX_Controller
{
	private $module = 'authentication';
	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Dashboard",
                "url" => base_url('dashboard/index')
            ],
            [
                "text" => "Home",
            ]
        ],'Home');
		$this->load->view('layouts/back/main', $data);
	}
}