<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Golongan extends MX_Controller
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
        $this->load->model($this->module . '/golongan_model', 'golongan');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RGOLONGAN', $userPermission)) {
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
                "text" => "Golongan"
            ]
        ], 'Data Golongan');
        $data['data'] = $this->load->view($this->module . '/master/golongan', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->golongan->get_datatables();
        $data = array();
        foreach ($list as $golongan) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $golongan->golongan . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UGOLONGAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Update" onclick="editData(' . $golongan->id . ')"></i>' : '') . "
                " . ((in_array('DGOLONGAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Delete" onclick="deleteData(' . $golongan->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->golongan->count_all(),
            "recordsFiltered" => $this->golongan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CGOLONGAN', $userPermission)) {
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
                'golongan' => NULL,
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
                    "text" => "Golongan",
                    "action" => "golongan()"
                ],
                [
                    "text" => "Add Data"
                ]
            ], 'Add Data');
            $data['data'] = $this->load->view($this->module . '/master/golongan/form', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHTML(string $id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UGOLONGAN', $userPermission)) {
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
                    'message'         => "ID golongan is required"
                );
            } else {
                $golongan = $this->golongan->get_by_id($id);
                if ($golongan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Golongan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'id' => $golongan->id,
                        'golongan' => $golongan->golongan,
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
                            "text" => "Golongan",
                            "action" => "golongan()"
                        ],
                        [
                            "text" => "Edit Data"
                        ]
                    ], 'Edit Data');
                    $data['data'] = $this->load->view($this->module . '/master/golongan/form', $params, TRUE);
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CGOLONGAN', $userPermission)) {
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
                    'golongan' => form_error('golongan')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'golongan' => $this->input->post('golongan')
                );
                $insert = $this->golongan->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add golongan";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add golongan";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UGOLONGAN', $userPermission)) {
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
                    'message'         => "ID golongan is required"
                );
            } else {
                $golongan = $this->golongan->get_by_id($this->input->post('id'));
                if ($golongan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Golongan tidak ditemukan!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'golongan'     => form_error('golongan')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'golongan' => $this->input->post('golongan'),
                        );
                        $up = $this->golongan->update(array('id' => $this->input->post('id')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update golongan";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update golongan";
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
        if (!in_array('DGOLONGAN', $userPermission)) {
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
                    'message'         => "ID golongan is required"
                );
            } else {
                $golongan = $this->golongan->get_by_id($id);
                if ($golongan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Golongan tidak ditemukan!"
                    );
                } else {
                    $del = $this->golongan->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete golongan";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete golongan";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
    }
}

