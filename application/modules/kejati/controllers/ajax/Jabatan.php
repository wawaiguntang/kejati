<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda harus login terlebih dahulu!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            die();
        }
        $this->load->model($this->module . '/jabatan_model', 'jabatan');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RJABATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
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
                "text" => "Jabatan"
            ]
        ], 'Data Jabatan');
        $data['data'] = $this->load->view($this->module . '/master/jabatan', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->jabatan->get_datatables();
        $data = array();
        foreach ($list as $jabatan) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $jabatan->jabatan . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UJABATAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Ubah" onclick="editData(' . $jabatan->id . ')"></i>' : '') . "
                " . ((in_array('DJABATAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Hapus" onclick="deleteData(' . $jabatan->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->jabatan->count_all(),
            "recordsFiltered" => $this->jabatan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CJABATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Tambah Data',
                'id' => NULL,
                'jabatan' => NULL,
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
                    "text" => "Jabatan",
                    "action" => "jabatan()"
                ],
                [
                    "text" => "Tambah Data"
                ]
            ], 'Tambah Data');
            $data['data'] = $this->load->view($this->module . '/master/jabatan/form', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHTML(string $id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UJABATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($id == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID jabatan is required"
                );
            } else {
                $jabatan = $this->jabatan->get_by_id($id);
                if ($jabatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Jabatan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'title' => 'Ubah Data',
                        'id' => $jabatan->id,
                        'jabatan' => $jabatan->jabatan,
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
                            "text" => "Jabatan",
                            "action" => "jabatan()"
                        ],
                        [
                            "text" => "Ubah Data"
                        ]
                    ], 'Ubah Data');
                    $data['data'] = $this->load->view($this->module . '/master/jabatan/form', $params, TRUE);
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CJABATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validate();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'jabatan' => form_error('jabatan')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'jabatan' => $this->input->post('jabatan')
                );
                $insert = $this->jabatan->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Berhasil menambah jabatan";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah jabatan";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UJABATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('id') == '' || $this->input->post('id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID jabatan is required"
                );
            } else {
                $jabatan = $this->jabatan->get_by_id($this->input->post('id'));
                if ($jabatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Jabatan tidak ditemukan!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'jabatan'     => form_error('jabatan')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'jabatan' => $this->input->post('jabatan'),
                        );
                        $up = $this->jabatan->update(array('id' => $this->input->post('id')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil mengubah jabatan";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengubah jabatan";
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
        if (!in_array('DJABATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($id == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID jabatan is required"
                );
            } else {
                $jabatan = $this->jabatan->get_by_id($id);
                if ($jabatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Jabatan tidak ditemukan!"
                    );
                } else {
                    $del = $this->jabatan->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menghapus jabatan";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus jabatan";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
    }
}

