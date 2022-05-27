<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends MX_Controller
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
        $this->load->model($this->module . '/pegawai_model', 'pegawai');
        $this->load->model($this->module . '/jabatan_model', 'jabatan');
        $this->load->model($this->module . '/golongan_model', 'golongan');
        $this->load->model($this->module . '/pangkat_model', 'pangkat');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RPEGAWAI', $userPermission)) {
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
                "text" => "Pegawai"
            ]
        ], 'Data Pegawai');
        $data['data'] = $this->load->view($this->module . '/master/pegawai', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->pegawai->get_datatables();

        $data = array();
        foreach ($list as $pegawai) {
            $row = array();
            $row[] = '<div class="d-flex px-2 py-1">
                            <div>
                                <img src="' . base_url('assets/img/pegawai/foto/' . $pegawai->foto) . '" onclick="imageModal(this)" role="button" class="avatar avatar-sm me-3" alt="pegawai">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $pegawai->nama . '</h6>
                                <p class="text-xs text-secondary mb-0">' . $pegawai->nip . '</p>
                            </div>
                        </div>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $pegawai->jabatan . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $pegawai->pangkat . '/' . $pegawai->golongan . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $pegawai->email . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UPEGAWAI', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Ubah" onclick="editData(' . $pegawai->pegawai_id . ')"></i>' : '') . "
                " . ((in_array('DPEGAWAI', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Hapus" onclick="deleteData(' . $pegawai->pegawai_id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pegawai->count_all(),
            "recordsFiltered" => $this->pegawai->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPEGAWAI', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Tambah Data',
                'id' => '',
                'nama' => '',
                'nip' => '',
                'foto' => '',
                'jabatan_id' => '',
                'golongan_id' => '',
                'pangkat_id' => '',
                'userCode' => '',
            ];
            $jabatan = [];
            $getJabatan = $this->jabatan->get_all();
            foreach ($getJabatan as $k) {
                $jabatan[$k->id] = $k->jabatan;
            }
            $params['jabatan'] = $jabatan;

            $pangkat = [];
            $getPangkat = $this->pangkat->get_all();
            foreach ($getPangkat as $k) {
                $pangkat[$k->id] = $k->pangkat;
            }
            $params['pangkat'] = $pangkat;

            $golongan = [];
            $getGolongan = $this->golongan->get_all();
            foreach ($getGolongan as $k) {
                $golongan[$k->id] = $k->golongan;
            }
            $params['golongan'] = $golongan;

            $inUse = array_values(array_column($this->pegawai->get_all(), 'userCode'));
            $user = [];
            $this->db->select('userCode, email');
            if ($inUse != NULL) {
                $this->db->where_not_in('userCode', $inUse);
            }
            $getUser = $this->db->get_where('user', ['deleteAt' => NULL])->result();
            foreach ($getUser as $k) {
                $user[$k->userCode] = $k->email;
            }
            $params['user'] = $user;

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
                    "text" => "Pegawai",
                    "action" => "pegawai()"
                ],
                [
                    "text" => "Tambah Data"
                ]
            ], 'Tambah Data');
            $data['data'] = $this->load->view($this->module . '/master/pegawai/form', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHTML(string $id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UPEGAWAI', $userPermission)) {
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
                    'message'         => "ID pegawai is required"
                );
            } else {
                $pegawai = $this->pegawai->get_by_id($id);
                if ($pegawai == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pegawai tidak ditemukan!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $params = [
                        'title' => 'Ubah Data',
                        'id' => $pegawai->id,
                        'nama' => $pegawai->nama,
                        'nip' => $pegawai->nip,
                        'foto' => $pegawai->foto,
                        'jabatan_id' => $pegawai->jabatan_id,
                        'golongan_id' => $pegawai->golongan_id,
                        'pangkat_id' => $pegawai->pangkat_id,
                        'userCode' => $pegawai->userCode,
                    ];
                    $jabatan = [];
                    $getJabatan = $this->jabatan->get_all();
                    foreach ($getJabatan as $k) {
                        $jabatan[$k->id] = $k->jabatan;
                    }
                    $params['jabatan'] = $jabatan;

                    $pangkat = [];
                    $getPangkat = $this->pangkat->get_all();
                    foreach ($getPangkat as $k) {
                        $pangkat[$k->id] = $k->pangkat;
                    }
                    $params['pangkat'] = $pangkat;

                    $golongan = [];
                    $getGolongan = $this->golongan->get_all();
                    foreach ($getGolongan as $k) {
                        $golongan[$k->id] = $k->golongan;
                    }
                    $params['golongan'] = $golongan;

                    $tempUserUse = [];
                    $inUse = $this->pegawai->get_all();
                    foreach($inUse as $k => $ve){
                        if($pegawai->userCode != $ve->userCode){
                            $tempUserUse[] = $ve->userCode;
                        }
                    }
                    $user = [];
                    $this->db->select('userCode, email');
                    if ($inUse != NULL) {
                        $this->db->where_not_in('userCode', $tempUserUse);
                    }
                    $getUser = $this->db->get_where('user', ['deleteAt' => NULL])->result();
                    foreach ($getUser as $k) {
                        $user[$k->userCode] = $k->email;
                    }
                    $params['user'] = $user;

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
                            "text" => "Pegawai",
                            "action" => "pegawai()"
                        ],
                        [
                            "text" => "Ubah Data"
                        ]
                    ], 'Ubah Data');
                    $data['data'] = $this->load->view($this->module . '/master/pegawai/form', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPEGAWAI', $userPermission)) {
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
                    'nama' =>  form_error('nama'),
                    'nip' =>  form_error('nip'),
                    'jabatan_id' =>  form_error('jabatan_id'),
                    'golongan_id' =>  form_error('golongan_id'),
                    'pangkat_id' =>  form_error('pangkat_id'),
                    'userCode' =>  form_error('userCode'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'nama' => $this->input->post('nama'),
                    'nip' => $this->input->post('nip'),
                    'jabatan_id' => $this->input->post('jabatan_id'),
                    'golongan_id' => $this->input->post('golongan_id'),
                    'pangkat_id' => $this->input->post('pangkat_id'),
                    'userCode' => $this->input->post('userCode'),
                );
                if (isset($_FILES['foto']['name'])) {
                    $config['upload_path'] = './assets/img/pegawai/foto/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']     = '2000';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('foto')) {
                        $errors = array('foto' => $this->upload->display_errors());
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                    } else {
                        $name = $this->upload->data()['file_name'];
                        $insert['foto'] = $name;
                        $insert = $this->pegawai->save($insert);
                        if ($insert) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil menambah pegawai";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal menambah pegawai";
                        }
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $errors = array(
                        'foto' => 'Foto is required'
                    );
                    $data = array(
                        'status'         => FALSE,
                        'errors'         => $errors
                    );
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPEGAWAI', $userPermission)) {
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
                    'message'         => "ID pegawai is required"
                );
            } else {
                $pegawai = $this->pegawai->get_by_id($this->input->post('id'));
                if ($pegawai == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pegawai tidak ditemukan!"
                    );
                } else {
                    $this->_validate();
                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'nama' =>  form_error('nama'),
                            'nip' =>  form_error('nip'),
                            'jabatan_id' =>  form_error('jabatan_id'),
                            'golongan_id' =>  form_error('golongan_id'),
                            'pangkat_id' =>  form_error('pangkat_id'),
                            'userCode' =>  form_error('userCode'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'nama' => $this->input->post('nama'),
                            'nip' => $this->input->post('nip'),
                            'jabatan_id' => $this->input->post('jabatan_id'),
                            'golongan_id' => $this->input->post('golongan_id'),
                            'pangkat_id' => $this->input->post('pangkat_id'),
                            'userCode' => $this->input->post('userCode'),
                        );
                        if ($_FILES['foto']['name']) {
                            $config['upload_path'] = './assets/img/pegawai/foto/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['max_size']     = '2000';
                            $config['encrypt_name'] = true;

                            $this->load->library('upload', $config);

                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('foto')) {
                                $errors = array('foto' => $this->upload->display_errors());
                                $data = array(
                                    'status'         => FALSE,
                                    'errors'         => $errors
                                );
                            } else {
                                $name = $this->upload->data()['file_name'];
                                $update['foto'] = $name;
                                $up = $this->pegawai->update(array('id' => $this->input->post('id')), $update);
                                if ($up) {
                                    $data['status'] = TRUE;
                                    $data['message'] = "Berhasil mengubah pegawai";
                                } else {
                                    $data['status'] = FALSE;
                                    $data['message'] = "Gagal mengubah pegawai";
                                }
                            }
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        } else {
                            $up = $this->pegawai->update(array('id' => $this->input->post('id')), $update);
                            if ($up) {
                                $data['status'] = TRUE;
                                $data['message'] = "Berhasil mengubah pegawai";
                            } else {
                                $data['status'] = FALSE;
                                $data['message'] = "Gagal mengubah pegawai";
                            }
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        }
                    }
                }
            }
        }
    }

    public function delete($id)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DPEGAWAI', $userPermission)) {
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
                    'message'         => "ID pegawai is required"
                );
            } else {
                $pegawai = $this->pegawai->get_by_id($id);
                if ($pegawai == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pegawai tidak ditemukan!"
                    );
                } else {
                    $del = $this->pegawai->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menghapus pegawai";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus pegawai";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('golongan_id', 'Golongan', 'trim|required');
        $this->form_validation->set_rules('pangkat_id', 'Pangkat', 'trim|required');
        $this->form_validation->set_rules('userCode', 'Akun', 'trim|required');

        $nip = '';
        if ($this->validation_for == 'add') {
            $nip = '|is_unique[pegawai.nip]';
        } else if ($this->validation_for == 'update') {
            $this->form_validation->set_rules('id', 'ID', 'trim|required');
            $getData = $this->pegawai->get_by_id($this->input->post('id'));
            if ($this->input->post('nip') != $getData->nip) {
                $nip = '|is_unique[pegawai.nip]';
            }
        }
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required' . $nip);
    }
}
