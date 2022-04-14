<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sop extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You must login first!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            die();
        }
        $this->load->model($this->module . '/sop_model', 'sop');
        $this->load->model($this->module . '/kegiatan_model', 'kegiatan');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RSOP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission
        ];
        $data['status'] = TRUE;
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Kejati",
                "url" => base_url('kejati/master')
            ],
            [
                "text" => "Master",
                "action" => "back()"
            ],
            [
                "text" => "SOP"
            ]
        ], 'Data SOP');
        $data['data'] = $this->load->view($this->module . '/master/sop', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->sop->get_datatables();
        $sopRow = 1;
        $data = array();
        foreach ($list as $sop) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $sop->sop . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $sop->waktu . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('USOP', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Update" onclick="editData(' . $sop->id . ')"></i>' : '') . "
                " . ((in_array('DSOP', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Delete" onclick="deleteData(' . $sop->id . ')"></i>' : '') . "
                " . ((in_array('RKEGIATAN', $userPermission)) ? '<i class="ri-information-line ri-lg text-primary m-1" role="button" title="Info" onclick="infoKegiatan(' . $sop->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->sop->count_all(),
            "recordsFiltered" => $this->sop->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSOP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'id' => NULL,
                'sop' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Kejati",
                    "url" => base_url('kejati/master')
                ],
                [
                    "text" => "Master",
                    "action" => "back()"
                ],
                [
                    "text" => "SOP",
                    "action" => "sop()"
                ],
                [
                    "text" => "Add Data"
                ]
            ], 'Add Data');
            $data['data'] = $this->load->view($this->module . '/master/sop/form', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHTML(string $id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('USOP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($id == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID sop is required"
                );
            } else {
                $sop = $this->sop->get_by_id($id);
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'id' => $sop->id,
                        'sop' => $sop->sop,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Kejati",
                            "url" => base_url('kejati/master')
                        ],
                        [
                            "text" => "Master",
                            "action" => "back()"
                        ],
                        [
                            "text" => "SOP",
                            "action" => "sop()"
                        ],
                        [
                            "text" => "Edit Data"
                        ]
                    ], 'Edit Data');
                    $data['data'] = $this->load->view($this->module . '/master/sop/form', $params, TRUE);
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSOP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validate();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'sop' => form_error('sop')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'sop' => $this->input->post('sop')
                );
                $insert = $this->sop->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add sop";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add sop";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('USOP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('id') == '' || $this->input->post('id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID sop is required"
                );
            } else {
                $sop = $this->sop->get_by_id($this->input->post('id'));
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP not found!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'sop'     => form_error('sop')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'sop' => $this->input->post('sop'),
                        );
                        $up = $this->sop->update(array('id' => $this->input->post('id')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update sop";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update sop";
                        }
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function delete($id)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DSOP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($id == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID sop is required"
                );
            } else {
                $sop = $this->sop->get_by_id($id);
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP not found!"
                    );
                } else {
                    $del = $this->sop->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete sop";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete sop";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('sop', 'SOP', 'trim|required');
    }

    public function detailHTML($id)
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RKEGIATAN', $userPermission)) {
            $data = array();
            $data['status'] = TRUE;
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID SOP is required"
                );
            } else {
                $sop = $this->sop->get_by_id($id);
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP not found!"
                    );
                } else {
                    $params = [
                        'userPermission' => $userPermission,
                        'id' => $sop->id,
                        'sop' => $sop->sop
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Kejati",
                            "url" => base_url('kejati/master')
                        ],
                        [
                            "text" => "Master",
                            "action" => "back()"
                        ],
                        [
                            "text" => "SOP",
                            "action" => "sop()"
                        ],
                        [
                            "text" => "Detail Kegiatan"
                        ]
                    ], 'Detail Kegiatan');
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/index', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function listKegiatan($id)
    {
        $userPermission = getPermissionFromUser();
        $list = $this->kegiatan->get_datatables($id);
        $data = array();
        foreach ($list as $kegiatan) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $kegiatan->kegiatan . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $kegiatan->waktu . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $kegiatan->keterangan . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UKEGIATAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Update" onclick="editKegiatan(' . $kegiatan->id . ')"></i>' : '') . "
                " . ((in_array('DKEGIATAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Delete" onclick="deleteKegiatan(' . $kegiatan->id . ')"></i>' : '') . "
                " . ((in_array('RDETAILKEGIATAN', $userPermission)) ? '<i class="ri-information-line ri-lg text-primary m-1" role="button" title="Info" onclick="infoDetailKegiatan(' . $kegiatan->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->kegiatan->count_all(),
            "recordsFiltered" => $this->kegiatan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addKegiatanHTML($id)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID SOP is required"
                );
            } else {
                $sop = $this->sop->get_by_id($id);
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP not found!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $params = [
                        'title' => 'Add Data Kegiatan',
                        'id' => $sop->id,
                        'sop' => $sop->sop,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Kejati",
                            "url" => base_url('kejati/master')
                        ],
                        [
                            "text" => "Master",
                            "action" => "back()"
                        ],
                        [
                            "text" => "SOP",
                            "action" => "sop()"
                        ],
                        [
                            "text" => "Detail Kegiatan",
                            "action" => "infoKegiatan(".$id.")"
                        ],
                        [
                            "text" => "Add Data Kegiatan"
                        ]
                    ], 'Add Data Kegiatan');
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/add', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
}
