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
                'message'         => "Anda harus login terlebih dahulu!"
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
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $sop->kategori . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . formatWaktu($sop->waktu) . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('USOP', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Ubah" onclick="editData(' . $sop->id . ')"></i>' : '') . "
                " . ((in_array('DSOP', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Hapus" onclick="deleteData(' . $sop->id . ')"></i>' : '') . "
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
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Tambah Data',
                'id' => '',
                'sop' => '',
                'kategori' => '',
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
                    "text" => "Tambah Data"
                ]
            ], 'Tambah Data');
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
                'message'         => "Anda tidak memiliki akses!"
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
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'title' => 'Ubah Data',
                        'id' => $sop->id,
                        'sop' => $sop->sop,
                        'kategori' => $sop->kategori,
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
                            "text" => "Ubah Data"
                        ]
                    ], 'Ubah Data');
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
                    'sop' => form_error('sop'),
                    'kategori' => form_error('kategori'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'sop' => $this->input->post('sop'),
                    'kategori' => $this->input->post('kategori'),
                );
                $insert = $this->sop->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Berhasil menambah sop";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah sop";
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
                    'message'         => "ID sop is required"
                );
            } else {
                $sop = $this->sop->get_by_id($this->input->post('id'));
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'sop'     => form_error('sop'),
                            'kategori' => form_error('kategori'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'sop' => $this->input->post('sop'),
                            'kategori' => $this->input->post('kategori'),
                        );
                        $up = $this->sop->update(array('id' => $this->input->post('id')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil mengubah sop";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengubah sop";
                        }
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function delete($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DSOP', $userPermission)) {
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
                    'message'         => "ID sop is required"
                );
            } else {
                $sop = $this->sop->get_by_id($id);
                if ($sop == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $del = $this->sop->delete_by_id($id);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menghapus sop";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus sop";
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
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
    }

    public function detailHTML($id = '')
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
                        'message'         => "SOP tidak ditemukan!"
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
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function listKegiatan($id = '')
    {
        $userPermission = getPermissionFromUser();
        $list = $this->kegiatan->get_datatables($id);
        $data = array();
        foreach ($list as $kegiatan) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto" title="">' . AbstractHTMLContents($kegiatan->kegiatan, 10) . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $kegiatan->waktu . ' ' . $kegiatan->satuan . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto" title="' . $kegiatan->keterangan . '">' . character_limiter($kegiatan->keterangan, 25) . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('UKEGIATAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Ubah" onclick="editKegiatan(' . $kegiatan->id . ')"></i>' : '') . "
                " . ((in_array('DKEGIATAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Hapus" onclick="deleteKegiatan(' . $kegiatan->id . ')"></i>' : '') . "
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

    public function addKegiatanHTML($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
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
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $params = [
                        'title' => 'Tambah Data Kegiatan',
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
                            "action" => "infoKegiatan(" . $id . ")"
                        ],
                        [
                            "text" => "Tambah Data Kegiatan"
                        ]
                    ], 'Tambah Data Kegiatan');
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/add', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    public function editKegiatanHTML($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID Kegiatan is required"
                );
            } else {
                $kegiatan = $this->kegiatan->get_by_id($id);
                if ($kegiatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan tidak ditemukan!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $params = [
                        'title' => 'Ubah Data Kegiatan',
                        'sop_id' => $kegiatan->sop_id,
                        'kegiatan_id' => $kegiatan->id,
                        'kegiatan' => $kegiatan->kegiatan,
                        'waktu' => $kegiatan->waktu,
                        'satuan' => $kegiatan->satuan,
                        'keterangan' => $kegiatan->keterangan,
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
                            "action" => "infoKegiatan(" . $id . ")"
                        ],
                        [
                            "text" => "Ubah Data Kegiatan"
                        ]
                    ], 'Ubah Data Kegiatan');
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/edit', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }


    public function addKegiatan($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
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
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $this->validation_for = 'add';
                    $this->_validateKegiatan();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'kegiatan' => form_error('kegiatan'),
                            'waktu' => form_error('waktu'),
                            'keterangan' => form_error('keterangan'),
                            'satuan' => form_error('satuan'),
                            'sop_id' => form_error('sop_id'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $insert = array(
                            'kegiatan' => $this->input->post('kegiatan'),
                            'waktu' => $this->input->post('waktu'),
                            'keterangan' => $this->input->post('keterangan'),
                            'satuan' => $this->input->post('satuan'),
                            'sop_id' => $this->input->post('sop_id'),
                        );
                        $this->db->trans_start();
                        $kegiatan = $this->kegiatan->save($insert);
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menambah kegiatan";
                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal menambah kegiatan";
                        }

                        if (!empty($this->input->post('kelengkapan')) && $this->input->post('kelengkapan') != NULL) {
                            $params = [];
                            foreach (explode(',', $this->input->post('kelengkapan')) as $k => $v) {
                                $params[] = [
                                    'kegiatan_id' => $kegiatan,
                                    'kelengkapan' => $v
                                ];
                            }
                            $this->db->insert_batch('kelengkapan', $params);
                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $data['status'] = FALSE;
                                $data['message'] = "Gagal menambah kegiatan";
                            }
                        }
                        if (!empty($this->input->post('hasil')) && $this->input->post('hasil') != NULL) {
                            $params = [];
                            foreach (explode(',', $this->input->post('hasil')) as $k => $v) {
                                $params[] = [
                                    'kegiatan_id' => $kegiatan,
                                    'hasil' => $v
                                ];
                            }
                            $this->db->insert_batch('hasil', $params);
                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $data['status'] = FALSE;
                                $data['message'] = "Gagal menambah kegiatan";
                            }
                        }
                        if ($this->input->post('satuan') == 'menit') {
                            $newWaktu = $this->input->post('waktu');
                        } elseif ($this->input->post('satuan') == 'jam') {
                            $newWaktu = $this->input->post('waktu') * 60;
                        } elseif ($this->input->post('satuan') == 'hari') {
                            $newWaktu = $this->input->post('waktu') * 24 * 60;
                        } else {
                            $newWaktu = $this->input->post('waktu');
                        }
                        $this->db->update('sop', ['waktu' => (int)$sop->waktu + (int)$newWaktu], ['id' => $sop->id]);
                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal menambah kegiatan";
                        }
                        $this->db->trans_complete();
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function editKegiatan($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID Kegiatan is required"
                );
            } else {
                $kegiatan = $this->kegiatan->get_by_id($id);
                if ($kegiatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan tidak ditemukan!"
                    );
                } else {
                    $this->validation_for = 'update';

                    $this->_validateKegiatan();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'kegiatan' => form_error('kegiatan'),
                            'waktu' => form_error('waktu'),
                            'keterangan' => form_error('keterangan'),
                            'satuan' => form_error('satuan'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'kegiatan' => $this->input->post('kegiatan'),
                            'waktu' => $this->input->post('waktu'),
                            'keterangan' => $this->input->post('keterangan'),
                            'satuan' => $this->input->post('satuan'),
                        );
                        $sop = $this->sop->get_by_id($kegiatan->sop_id);
                        if ($sop == NULL) {
                            $data = array(
                                'status'         => FALSE,
                                'message'         => "SOP tidak ditemukan!"
                            );
                        } else {
                            if ($this->input->post('satuan') == 'menit') {
                                $newWaktu = $this->input->post('waktu');
                            } elseif ($this->input->post('satuan') == 'jam') {
                                $newWaktu = $this->input->post('waktu') * 60;
                            } elseif ($this->input->post('satuan') == 'hari') {
                                $newWaktu = $this->input->post('waktu') * 24 * 60;
                            } else {
                                $newWaktu = $this->input->post('waktu');
                            }
                            if ($kegiatan->satuan == 'menit') {
                                $lastWaktu = $kegiatan->waktu;
                            } elseif ($kegiatan->satuan == 'jam') {
                                $lastWaktu = $kegiatan->waktu * 60;
                            } elseif ($kegiatan->satuan == 'hari') {
                                $lastWaktu = $kegiatan->waktu * 24 * 60;
                            } else {
                                $lastWaktu = $kegiatan->waktu;
                            }
                            $this->db->update('sop', ['waktu' => ($sop->waktu - $lastWaktu) + $newWaktu], ['id' => $sop->id]);
                            $update = $this->kegiatan->update(['id' => $id], $update);
                            if ($update) {
                                $data['status'] = TRUE;
                                $data['message'] = "Berhasil mengubah kegiatan";
                            } else {
                                $data['status'] = FALSE;
                                $data['message'] = "Gagal mengubah kegiatan";
                            }
                        }
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function deleteKegiatan($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID Kegiatan is required"
                );
            } else {
                $kegiatan = $this->kegiatan->get_by_id($id);
                if ($kegiatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan tidak ditemukan!"
                    );
                } else {
                    $sop = $this->sop->get_by_id($kegiatan->sop_id);
                    if ($sop == NULL) {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => "SOP tidak ditemukan!"
                        );
                    } else {
                        if ($kegiatan->satuan == 'menit') {
                            $lastWaktu = $kegiatan->waktu;
                        } elseif ($kegiatan->satuan == 'jam') {
                            $lastWaktu = $kegiatan->waktu * 60;
                        } elseif ($kegiatan->satuan == 'hari') {
                            $lastWaktu = $kegiatan->waktu * 24 * 60;
                        } else {
                            $lastWaktu = $kegiatan->waktu;
                        }
                        $this->db->update('sop', ['waktu' => ($sop->waktu - $lastWaktu)], ['id' => $sop->id]);
                        $del = $this->kegiatan->delete_by_id($id);
                        if ($del) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil menghapus kegiatan";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal menghapus kegiatan";
                        }
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }


    private function _validateKegiatan()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'trim|required');
        $this->form_validation->set_rules('waktu', 'Waktu', 'trim|required');
        // $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
        if ($this->validation_for == 'add') {
            $this->form_validation->set_rules('sop_id', 'SOP', 'trim|required');
        }
    }

    public function detailKegiatanHTML($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (in_array('RDETAILKEGIATAN', $userPermission)) {
            $data = array();
            $data['status'] = TRUE;
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID Kegiatan is required"
                );
            } else {
                $kegiatan = $this->kegiatan->get_by_id($id);
                if ($kegiatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'userPermission' => $userPermission,
                        'kelengkapan' => $this->db->get_where('kelengkapan', ['deleteAt' => NULL, 'kegiatan_id' => $id])->result(),
                        'hasil' => $this->db->get_where('hasil', ['deleteAt' => NULL, 'kegiatan_id' => $id])->result(),
                        'kegiatan_id' => $id,
                        'kegiatan' => $kegiatan
                    ];
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/kegiatan/index', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function addKelengkapanHTML($id  = '')
    {
        $userPermission = getPermissionFromUser();
        if (in_array('CKELENGKAPANKEGIATAN', $userPermission)) {
            $data = array();
            $data['status'] = TRUE;
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID Kegiatan is required"
                );
            } else {
                $kegiatan = $this->kegiatan->get_by_id($id);
                if ($kegiatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'userPermission' => $userPermission,
                        'kegiatan_id' => $id,
                        'title' => 'Add kelengkapan',
                        'id' => '',
                        'kelengkapan' => '',
                        'for' => 'add'
                    ];
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/kegiatan/kelengkapan/form', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editKelengkapanHTML($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (in_array('UKELENGKAPANKEGIATAN', $userPermission)) {
            $data = array();
            $data['status'] = TRUE;
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID kelengkapan is required"
                );
            } else {
                $kelengkapan = $this->db->get_where('kelengkapan', ['id' => $id, 'deleteAt' => NULL])->row_array();
                if ($kelengkapan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "kelengkapan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'userPermission' => $userPermission,
                        'kegiatan_id' => $kelengkapan['kegiatan_id'],
                        'title' => 'Edit kelengkapan',
                        'id' => $kelengkapan['id'],
                        'kelengkapan' => $kelengkapan['kelengkapan'],
                        'for' => 'edit'
                    ];
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/kegiatan/kelengkapan/form', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function addKelengkapan()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CKELENGKAPANKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validateKelengkapan();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'kelengkapan' => form_error('kelengkapan'),
                    'kegiatan_id' => form_error('kegiatan_id'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'kelengkapan' => $this->input->post('kelengkapan'),
                    'kegiatan_id' => $this->input->post('kegiatan_id')
                );
                $insert = $this->db->insert('kelengkapan', $insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Berhasil menambah kelengkapan";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah kelengkapan";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function updateKelengkapan()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UKELENGKAPANKEGIATAN', $userPermission)) {
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
                    'message'         => "ID kelengkapan is required"
                );
            } else {
                $kelengkapan = $this->db->get_where('kelengkapan', ['id' => $this->input->post('id'), 'deleteAt' => NULL])->row();
                if ($kelengkapan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $this->_validateKelengkapan();
                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'kelengkapan' => form_error('kelengkapan'),
                            'kegiatan_id' => form_error('kegiatan_id'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'kelengkapan' => $this->input->post('kelengkapan'),
                        );
                        $up = $this->db->update('kelengkapan', $update, ['id' => $this->input->post('id')]);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil mengubah kelengkapan";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengubah kelengkapan";
                        }
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function deleteKelengkapan($id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('DKELENGKAPANKEGIATAN', $userPermission)) {
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
                    'message'         => "ID kelengkapan is required"
                );
            } else {

                $kelengkapan = $this->db->get_where('kelengkapan', ['id' => $id, 'deleteAt' => NULL])->row();
                if ($kelengkapan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kelengkapan tidak ditemukan!"
                    );
                } else {
                    $params['deleteAt'] = date('Y-m-d H:i:s');
                    $del = $this->db->update('kelengkapan', $params, ['id' => $id]);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menghapus kelengkapan";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus kelengkapan";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validateKelengkapan()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kelengkapan', 'Kelengkapan', 'trim|required');
        $this->form_validation->set_rules('kegiatan_id', 'Kegiatan', 'trim|required');
    }

    public function addHasilHTML($id  = '')
    {
        $userPermission = getPermissionFromUser();
        if (in_array('CHASILKEGIATAN', $userPermission)) {
            $data = array();
            $data['status'] = TRUE;
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID Kegiatan is required"
                );
            } else {
                $kegiatan = $this->kegiatan->get_by_id($id);
                if ($kegiatan == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'userPermission' => $userPermission,
                        'kegiatan_id' => $id,
                        'title' => 'Add hasil',
                        'id' => '',
                        'hasil' => '',
                        'for' => 'add'
                    ];
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/kegiatan/hasil/form', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editHasilHTML($id = '')
    {
        $userPermission = getPermissionFromUser();
        if (in_array('UHASILKEGIATAN', $userPermission)) {
            $data = array();
            $data['status'] = TRUE;
            if ($id == '' || $id == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID hasil is required"
                );
            } else {
                $hasil = $this->db->get_where('hasil', ['id' => $id, 'deleteAt' => NULL])->row_array();
                if ($hasil == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "hasil tidak ditemukan!"
                    );
                } else {
                    $params = [
                        'userPermission' => $userPermission,
                        'kegiatan_id' => $hasil['kegiatan_id'],
                        'title' => 'Edit hasil',
                        'id' => $hasil['id'],
                        'hasil' => $hasil['hasil'],
                        'for' => 'edit'
                    ];
                    $data['data'] = $this->load->view($this->module . '/master/sop/detail/kegiatan/hasil/form', $params, TRUE);
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function addHasil()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CHASILKEGIATAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda tidak memiliki akses!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validateHasil();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'hasil' => form_error('hasil'),
                    'kegiatan_id' => form_error('kegiatan_id'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'hasil' => $this->input->post('hasil'),
                    'kegiatan_id' => $this->input->post('kegiatan_id')
                );
                $insert = $this->db->insert('hasil', $insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Berhasil menambah hasil";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah hasil";
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function updateHasil()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UHASILKEGIATAN', $userPermission)) {
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
                    'message'         => "ID hasil is required"
                );
            } else {
                $hasil = $this->db->get_where('hasil', ['id' => $this->input->post('id'), 'deleteAt' => NULL])->row();
                if ($hasil == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SOP tidak ditemukan!"
                    );
                } else {
                    $this->_validateHasil();
                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'hasil' => form_error('hasil'),
                            'kegiatan_id' => form_error('kegiatan_id'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'hasil' => $this->input->post('hasil'),
                        );
                        $up = $this->db->update('hasil', $update, ['id' => $this->input->post('id')]);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Berhasil mengubah hasil";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Gagal mengubah hasil";
                        }
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function deleteHasil($id = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('DHASILKEGIATAN', $userPermission)) {
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
                    'message'         => "ID hasil is required"
                );
            } else {

                $hasil = $this->db->get_where('hasil', ['id' => $id, 'deleteAt' => NULL])->row();
                if ($hasil == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Hasil tidak ditemukan!"
                    );
                } else {
                    $params['deleteAt'] = date('Y-m-d H:i:s');
                    $del = $this->db->update('hasil', $params, ['id' => $id]);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Berhasil menghapus hasil";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus hasil";
                    }
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    private function _validateHasil()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('hasil', 'Hasil', 'trim|required');
        $this->form_validation->set_rules('kegiatan_id', 'Kegiatan', 'trim|required');
    }
}
