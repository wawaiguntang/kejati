<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
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
    }

    public function data()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RPENGADUAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission
        ];
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Kejati",
                "url" => base_url('kejati/pengaduan')
            ],
            [
                "text" => "Pengaduan",
            ]
        ], 'Data Pengaduan');
        $data['data'] =  $this->load->view($this->module . '/pengaduan/index', $params, TRUE);
        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode($data)
            );
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->pengaduan->get_datatables();
        $data = array();
        foreach ($list as $pengaduan) {
            $row = array();
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $pengaduan->no . '</b></p>
                        <p class="text-sm d-flex py-auto my-auto">Tanggal Surat : ' . $pengaduan->tanggal_surat . '</p>
                        <p class="text-sm d-flex py-auto my-auto">Tanggal Terima : ' . $pengaduan->tanggal_terima . '</p>';

            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $pengaduan->asal_surat . '</b></p>
                        <p class="text-sm d-flex py-auto my-auto" title="' . $pengaduan->perihal . '">' . character_limiter($pengaduan->perihal, 25) . '</p>';

            $row[] = '  <p class="text-sm d-flex py-auto my-auto" title="' . $pengaduan->isi . '">' . character_limiter($pengaduan->isi, 25) . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UPENGADUAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Ubah" onclick="editData(' . $pengaduan->id . ')"></i>' : '') . "
                " . ((in_array('DPENGADUAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Hapus" onclick="deleteData(' . $pengaduan->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pengaduan->count_all(),
            "recordsFiltered" => $this->pengaduan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENGADUAN', $userPermission)) {
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
                'no' => NULL,
                'tanggal_surat' => NULL,
                'tanggal_terima' => NULL,
                'asal_surat' => NULL,
                'perihal' => NULL,
                'isi' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Kejati",
                    "url" => base_url('kejati/pengaduan')
                ],
                [
                    "text" => "Pengaduan",
                    "action" => "back()"
                ],
                [
                    "text" => "Tambah Data"
                ]
            ], 'Tambah Data');
            $data['data'] = $this->load->view($this->module . '/pengaduan/form', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHTML(string $id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPENGADUAN', $userPermission)) {
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
                    'message'         => "ID pengaduan is required"
                );
            } else {
                $pengaduan = $this->pengaduan->get_by_id($id);
                if ($pengaduan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Pengaduan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'title' => 'Ubah Data',
                        'id' => $pengaduan->id,
                        'no' => $pengaduan->no,
                        'tanggal_surat' => $pengaduan->tanggal_surat,
                        'tanggal_terima' => $pengaduan->tanggal_terima,
                        'asal_surat' => $pengaduan->asal_surat,
                        'perihal' => $pengaduan->perihal,
                        'isi' => $pengaduan->isi,
                    ];
                    $data['data'] = $this->load->view($this->module . '/pengaduan/form', $params, TRUE);
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }


    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENGADUAN', $userPermission)) {
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
                    'no' => form_error('no'),
                    'tanggal_surat' => form_error('tanggal_surat'),
                    'tanggal_terima' => form_error('tanggal_terima'),
                    'asal_surat' => form_error('asal_surat'),
                    'perihal' => form_error('perihal'),
                    'isi' => form_error('isi'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'no' => $this->input->post('no'),
                    'tanggal_surat' => $this->input->post('tanggal_surat'),
                    'tanggal_terima' => $this->input->post('tanggal_terima'),
                    'asal_surat' => $this->input->post('asal_surat'),
                    'perihal' => $this->input->post('perihal'),
                    'isi' => $this->input->post('isi'),
                );
                $insert = $this->pengaduan->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Berhasil menambah pengaduan";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah pengaduan";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPENGADUAN', $userPermission)) {
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
                    'message'         => "ID pengaduan is required"
                );
            } else {
                $pengaduan = $this->pengaduan->get_by_id($this->input->post('id'));
                if ($pengaduan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "pengaduan tidak ditemukan!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'no' => form_error('no'),
                            'tanggal_surat' => form_error('tanggal_surat'),
                            'tanggal_terima' => form_error('tanggal_terima'),
                            'asal_surat' => form_error('asal_surat'),
                            'perihal' => form_error('perihal'),
                            'isi' => form_error('isi'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'no' => $this->input->post('no'),
                            'tanggal_surat' => $this->input->post('tanggal_surat'),
                            'tanggal_terima' => $this->input->post('tanggal_terima'),
                            'asal_surat' => $this->input->post('asal_surat'),
                            'perihal' => $this->input->post('perihal'),
                            'isi' => $this->input->post('isi'),
                        );
                        $up = $this->pengaduan->update(array('id' => $this->input->post('id')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil mengubah pengaduan";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengubah pengaduan";
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
        if (!in_array('DPENGADUAN', $userPermission)) {
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
                    'message'         => "ID pengaduan is required"
                );
            } else {
                $pengaduan = $this->pengaduan->get_by_id($id);
                if ($pengaduan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "pengaduan tidak ditemukan!"
                    );
                } else {
                    $del = $this->pengaduan->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menghapus pengaduan";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus pengaduan";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('no', 'No', 'trim|required');
        $this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
        $this->form_validation->set_rules('tanggal_terima', 'Tanggal Terima', 'trim|required');
        $this->form_validation->set_rules('asal_surat', 'Asal Surat', 'trim|required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
        $this->form_validation->set_rules('isi', 'Isi', 'trim|required');
        if ($this->validation_for == 'update') {
            $this->form_validation->set_rules('id', 'Code', 'trim|required');
        }
    }
}
