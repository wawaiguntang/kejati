<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pangkat extends MX_Controller
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
        $this->load->model($this->module . '/pangkat_model', 'pangkat');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RPANGKAT', $userPermission)) {
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
                "text" => "Pangkat"
            ]
        ], 'Data Pangkat');
        $data['data'] = $this->load->view($this->module . '/master/pangkat', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->pangkat->get_datatables();
        $data = array();
        foreach ($list as $pangkat) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $pangkat->pangkat . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UGOLONGAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Update" onclick="editData(' . $pangkat->id . ')"></i>' : '') . "
                " . ((in_array('DGOLONGAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Delete" onclick="deleteData(' . $pangkat->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pangkat->count_all(),
            "recordsFiltered" => $this->pangkat->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPANGKAT', $userPermission)) {
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
                'pangkat' => NULL,
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
                    "text" => "Pangkat",
                    "action" => "pangkat()"
                ],
                [
                    "text" => "Add Data"
                ]
            ], 'Add Data');
            $data['data'] = $this->load->view($this->module . '/master/pangkat/form', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHTML(string $id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UPANGKAT', $userPermission)) {
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
                    'message'         => "ID pangkat is required"
                );
            } else {
                $pangkat = $this->pangkat->get_by_id($id);
                if ($pangkat == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pangkat not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'id' => $pangkat->id,
                        'pangkat' => $pangkat->pangkat,
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
                            "text" => "Pangkat",
                            "action" => "pangkat()"
                        ],
                        [
                            "text" => "Edit Data"
                        ]
                    ], 'Edit Data');
                    $data['data'] = $this->load->view($this->module . '/master/pangkat/form', $params, TRUE);
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPANGKAT', $userPermission)) {
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
                    'pangkat' => form_error('pangkat')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'pangkat' => $this->input->post('pangkat')
                );
                $insert = $this->pangkat->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add pangkat";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add pangkat";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPANGKAT', $userPermission)) {
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
                    'message'         => "ID pangkat is required"
                );
            } else {
                $pangkat = $this->pangkat->get_by_id($this->input->post('id'));
                if ($pangkat == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pangkat not found!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'pangkat'     => form_error('pangkat')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'pangkat' => $this->input->post('pangkat'),
                        );
                        $up = $this->pangkat->update(array('id' => $this->input->post('id')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update pangkat";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update pangkat";
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
        if (!in_array('DPANGKAT', $userPermission)) {
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
                    'message'         => "ID pangkat is required"
                );
            } else {
                $pangkat = $this->pangkat->get_by_id($id);
                if ($pangkat == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pangkat not found!"
                    );
                } else {
                    $del = $this->pangkat->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete pangkat";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete pangkat";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
    }
}

