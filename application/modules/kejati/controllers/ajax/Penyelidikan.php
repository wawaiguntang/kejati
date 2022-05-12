<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';
    private $sop_for = 'add';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
        $this->load->model($this->module . '/penyelidikan_model', 'penyelidikan');
        $this->load->model($this->module . '/pegawai_model', 'pegawai');
        $this->load->model($this->module . '/sop_model', 'sop');
        $this->load->model($this->module . '/kegiatan_model', 'kegiatan');
        $this->load->model($this->module . '/kelengkapan_model', 'kelengkapan');
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You must login first!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        //     die();
        // }

    }

    public function data()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $params = [
                'userPermission' => $userPermission
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Kejati",
                    "url" => base_url('kejati/penyelidikan')
                ],
                [
                    "text" => "Penyelidikan",
                ]
            ], 'Data Penyelidikan');
            $data['data'] =  $this->load->view($this->module . '/penyelidikan/index', $params, TRUE);
            $this->output
                ->set_content_type('application/json')
                ->set_output(
                    json_encode($data)
                );
        }
    }

    public function list()
    {
        $userPermission = getPermissionFromUser();
        $list = $this->penyelidikan->get_datatables();
        $data = array();
        foreach ($list as $penyelidikan) {
            $row = array();
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->no_surat_tugas . '</b></p>';
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->no_nota_dinas . '</b></p>';
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->sop . '</b></p>';
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . character_limiter($penyelidikan->perihal, 25) . '</b></p>';
            $row[] = '  <p class="text-sm d-flex py-auto my-auto"><b>' . $penyelidikan->status . '</b></p>';

            // $row[] = "
            //     <div class='d-flex justify-content-center'>
            //     " . ((in_array('UPENYELIDIKAN', $userPermission)) ? '<i class="ri-edit-2-line ri-lg text-warning m-1" role="button" title="Update" onclick="editData(' . $penyelidikan->id . ')"></i>' : '') . "
            //     " . ((in_array('DPENYELIDIKAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Delete" onclick="deleteData(' . $penyelidikan->id . ')"></i>' : '') . "
            //     " . ((in_array('RDETAILPENYELIDIKAN', $userPermission)) ? '<i class="ri-information-line ri-lg text-primary m-1" role="button" title="Info" onclick="detail(' . $penyelidikan->id . ')"></i>' : '') . "
            //     </div>
            //     ";

            $row[] = "
                <div class='d-flex justify-content-center'>
                " . ((in_array('DPENYELIDIKAN', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger m-1" role="button" title="Delete" onclick="deleteData(' . $penyelidikan->id . ')"></i>' : '') . "
                " . ((in_array('RDETAILPENYELIDIKAN', $userPermission)) ? '<i class="ri-information-line ri-lg text-primary m-1" role="button" title="Info" onclick="detail(' . $penyelidikan->id . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->penyelidikan->count_all(),
            "recordsFiltered" => $this->penyelidikan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function addHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $pengaduan = [];
            $pengaduan[0] = '-- Pilih Pengaduan --';
            $getPengaduan = $this->pengaduan->get_all();
            foreach ($getPengaduan as $k) {
                $pengaduan[$k->id] = $k->no;
            }

            $sop = [];
            $sop[0] = '-- Pilih SOP --';
            $getSOP = $this->sop->get_all();
            foreach ($getSOP as $k) {
                if ($k->kategori == 'Penyelidikan') {
                    $sop[$k->id] = $k->sop;
                }
            }

            $params = [
                'title' => 'Add Data Penyelidikan',
                'id' => NULL,
                'no' => NULL,
                'tanggal_surat' => NULL,
                'tanggal_terima' => NULL,
                'asal_surat' => NULL,
                'perihal' => NULL,
                'isi' => NULL,
                'pengaduan' => $pengaduan,
                'sop' => $sop,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Kejati",
                    "url" => base_url('kejati/penyelidikan')
                ],
                [
                    "text" => "Penyelidikan",
                    "action" => "back()"
                ],
                [
                    "text" => "Add Data Penyelidikan"
                ]
            ], 'Add Data Penyelidikan');
            $data['data'] = $this->load->view($this->module . '/penyelidikan/add', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function pengaduan()
    {
        $userPermission = getPermissionFromUser();
        if (!(count(array_intersect($userPermission, ['CPENYELIDIKAN', 'UPENYELIDIKAN'])) > 0)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
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
                    $data['data'] =  $this->load->view($this->module . '/penyelidikan/pengaduan', $pengaduan, TRUE);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(
                            json_encode($data)
                        );
                }
            }
        }
    }

    public function sop()
    {
        $userPermission = getPermissionFromUser();
        if (!(count(array_intersect($userPermission, ['CPENYELIDIKAN', 'UPENYELIDIKAN'])) > 0)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
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
                        'message'         => "sop tidak ditemukan!"
                    );
                } else {
                    $tempKegiatan = [];

                    $kegiatan = [];
                    $keg = $this->kegiatan->get_all($sop->id);
                    foreach ($keg as $k) {
                        // $k->kelengkapan = $this->kelengkapan->get_all($k->id);
                        $kegiatan[$k->id] = $k->kegiatan;
                        //buat add
                        // $tempKegiatan[$k->id] = [];
                    }

                    $params = [
                        'sop' => $sop,
                        'kegiatan' => $kegiatan
                    ];

                    $this->session->set_userdata([
                        'temp' => [
                            'kegiatan' => $tempKegiatan
                        ]
                    ]);
                    $data['data'] =  $this->load->view($this->module . '/penyelidikan/sop', $params, TRUE);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(
                            json_encode($data)
                        );
                }
            }
        }
    }

    public function addKegiatanHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($this->input->post('kegiatan_id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Kegiatan is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $data['status'] = TRUE;
            $kegiatan = $this->session->userdata('temp')['kegiatan'];
            // var_dump($kegiatan);
            // die;
            foreach ($kegiatan as $k => $v) {
                if ($k == $this->input->post('kegiatan_id')) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan has been added"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
            $kelengkapan = [];
            $kelengkapanData = $this->kelengkapan->get_all($this->input->post('kegiatan_id'));
            foreach ($kelengkapanData as $k) {
                $kelengkapan[$k->id] = [];
            }
            $kegiatan[$this->input->post('kegiatan_id')] = [];
            $kegiatan_kelengkapan = [];
            $kegiatan_kelengkapan[$this->input->post('kegiatan_id')] = $kelengkapan;
            $this->session->set_userdata([
                'temp' => [
                    'kegiatan' => $kegiatan,
                    'kegiatan_kelengkapan' => $kegiatan_kelengkapan
                ]
            ]);

            $kegiatanData = $this->kegiatan->get_by_id($this->input->post('kegiatan_id'));
            $kegiatanData->kelengkapan = $this->kelengkapan->get_all($this->input->post('kegiatan_id'));

            $params = [
                'kegiatan' => $kegiatanData,
            ];
            $data['data'] = $this->load->view($this->module . '/penyelidikan/sop_kegiatan', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function editKegiatanHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($this->input->post('kegiatan_id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Kegiatan is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $data['status'] = TRUE;
            // $kegiatan = [];

            // echo json_encode($this->session->userdata('temp')['kegiatan']);

            if (isset($this->session->userdata('temp')['kegiatan'])) {
                $kegiatan = $this->session->userdata('temp')['kegiatan'];
                foreach ($kegiatan as $k => $v) {
                    if ($k == $this->input->post('kegiatan_id')) {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => "Kegiatan has been added"
                        );
                        // $this->session->unset_userdata('temp');
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }



            $tugas = $this->session->userdata('tugas_id');
            $cek_tugas = $this->db->get_where('detail_tugas', array('tugas_id' => $tugas))->result();
            foreach ($cek_tugas as $k) {
                if ($k->kegiatan_id == $this->input->post('kegiatan_id')) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Kegiatan has been added"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
            $kelengkapan = [];
            $kelengkapanData = $this->kelengkapan->get_all($this->input->post('kegiatan_id'));
            foreach ($kelengkapanData as $k) {
                $kelengkapan[$k->id] = [];
            }
            $kegiatan[$this->input->post('kegiatan_id')] = [];
            $kegiatan_kelengkapan = [];
            $kegiatan_kelengkapan[$this->input->post('kegiatan_id')] = $kelengkapan;
            $this->session->set_userdata([
                'temp' => [
                    'kegiatan' => $kegiatan,
                    'kegiatan_kelengkapan' => $kegiatan_kelengkapan
                ]
            ]);

            $kegiatanData = $this->kegiatan->get_by_id($this->input->post('kegiatan_id'));
            $kegiatanData->kelengkapan = $this->kelengkapan->get_all($this->input->post('kegiatan_id'));

            $params = [
                'kegiatan' => $kegiatanData,
            ];
            $data['data'] = $this->load->view($this->module . '/penyelidikan/sop_kegiatan', $params, TRUE);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function deleteKegiatanHTML()
    {
        if (isset($this->session->userdata('temp')['kegiatan'])) {
            $this->session->unset_userdata('temp');
        }
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data = array();
            $data['status'] = TRUE;

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('kegiatan_id', 'Kegiatan', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'kegiatan_id' => form_error('kegiatan_id'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'kegiatan_id' => $this->input->post('kegiatan_id'),
                );
                $temp = [];
                if (isset($this->session->userdata('temp')['kegiatan'])) {
                    $temp = $this->session->userdata('temp')['kegiatan'];
                }
                unset($temp[$insert['kegiatan_id']]);
                unset($this->session->userdata('temp')['kegiatan_kelengkapan'][$insert['kegiatan_id']]);
                $this->session->set_userdata([
                    'temp' => [
                        'kegiatan' => $temp
                    ]
                ]);

                $data['status'] = TRUE;
                $data['message'] = "Success to delete kegiatan";
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function getPegawai()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('kegiatan_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kegiatan is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission,
            'kegiatan_id' => $this->input->post('kegiatan_id')
        ];
        $data['status'] = TRUE;
        $data['data'] = $this->load->view($this->module . '/penyelidikan/sop_pegawai', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function addPegawaiHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($this->input->post('kegiatan_id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Kegiatan is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $data['status'] = TRUE;
            $jaksa = [];
            $getJaksa = $this->db->get_where('pegawai', ['deleteAt' => NULL])->result();
            foreach ($getJaksa as $k) {
                $jaksa[$k->id] = $k->nama;
            }

            $params = [
                'title' => 'Add jaksa',
                'kegiatan_id' => $this->input->post('kegiatan_id'),
                'jaksa' => $jaksa,
            ];
            $data['data'] = modal('add_sop_pegawai', $this->load->view($this->module . '/penyelidikan/add_sop_pegawai', $params, TRUE));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function addPegawai()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data = array();
            $data['status'] = TRUE;

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('kegiatan_id', 'Kegiatan', 'trim|required');
            $this->form_validation->set_rules('jaksa', 'Jaksa', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'kegiatan_id' => form_error('kegiatan_id'),
                    'jaksa' => form_error('jaksa')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'kegiatan_id' => $this->input->post('kegiatan_id'),
                    'jaksa' => $this->input->post('jaksa')
                );
                $cek = FALSE;
                // var_dump($this->session->userdata('temp')['kegiatan']);
                // die;
                foreach ($this->session->userdata('temp')['kegiatan'][$insert['kegiatan_id']] as $k => $v) {
                    if (isset($v['pegawai']['id'])) {
                        if ($v['pegawai']['id'] == $insert['jaksa']) {
                            $cek = TRUE;
                            $data = array(
                                'status'         => FALSE,
                                'errors'         => [
                                    'jaksa' => 'Jaksa has been added'
                                ]
                            );
                            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        }
                    }
                }

                $temp = $this->session->userdata('temp');
                if ($cek == FALSE) {
                    $set_temp[$insert['kegiatan_id']] = $temp['kegiatan'][$insert['kegiatan_id']];
                    $set_temp[$insert['kegiatan_id']][] = [
                        'pegawai' => $this->db->get_where('pegawai', ['id' => $insert['jaksa']])->row_array(),
                        'leader' => 0
                    ];
                    $temp['kegiatan'][$insert['kegiatan_id']] = $set_temp[$insert['kegiatan_id']];
                    $this->session->set_userdata([
                        'temp' => $temp
                    ]);
                }

                $data['status'] = TRUE;
                $data['message'] = "Success to add jaksa";
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function deletePegawai()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data = array();
            $data['status'] = TRUE;

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('kegiatan_id', 'Kegiatan', 'trim|required');
            $this->form_validation->set_rules('jaksa', 'Jaksa', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'kegiatan_id' => form_error('kegiatan_id'),
                    'jaksa' => form_error('jaksa')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'kegiatan_id' => $this->input->post('kegiatan_id'),
                    'jaksa' => $this->input->post('jaksa')
                );

                $temp = $this->session->userdata('temp');
                $set_temp[$insert['kegiatan_id']] = [];
                foreach ($temp['kegiatan'][$insert['kegiatan_id']] as $k => $v) {
                    if ($v['pegawai']['id'] != $insert['jaksa']) {
                        $set_temp[$insert['kegiatan_id']][] = $v;
                    }
                }
                $temp['kegiatan'][$insert['kegiatan_id']] = $set_temp[$insert['kegiatan_id']];
                $this->session->set_userdata([
                    'temp' => $temp
                ]);

                $data['status'] = TRUE;
                $data['message'] = "Success to delete jaksa";
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function getKelengkapan()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('kegiatan_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Kegiatan is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission,
            'kelengkapan' => $this->kelengkapan->get_all($this->input->post('kegiatan_id')),
            'kegiatan_id' => $this->input->post('kegiatan_id')
        ];
        $data['status'] = TRUE;
        $data['data'] = $this->load->view($this->module . '/penyelidikan/sop_kelengkapan', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    // public function getDetailKelengkapan()
    // {
    //     $userPermission = getPermissionFromUser();
    //     if (!in_array('CPENYELIDIKAN', $userPermission)) {
    //         $data = array(
    //             'status'         => FALSE,
    //             'message'         => "You don't have access!"
    //         );
    //         return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    //     }
    //     if ($this->input->post('kegiatan_id') == NULL) {
    //         $data = array(
    //             'status'         => FALSE,
    //             'message'         => "Kegiatan is required"
    //         );
    //         return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    //     }
    //     $params = [
    //         'userPermission' => $userPermission,
    //         'kelengkapan' => $this->kelengkapan->get_all($this->input->post('kegiatan_id')),
    //         'kegiatan_id' => $this->input->post('kegiatan_id')
    //     ];
    //     $data['status'] = TRUE;
    //     $data['data'] = $this->load->view($this->module . '/penyelidikan/detail_sop_kelengkapan', $params, TRUE);
    //     $this->output->set_content_type('application/json')->set_output(json_encode($data));
    // }

    public function uploadKelengkapanHTML()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($this->input->post('kegiatan_id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Kegiatan is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            if ($this->input->post('kelengkapan_id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Kelengkapan is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $data['status'] = TRUE;

            $kelengkapan = $this->kelengkapan->get_by_id($this->input->post('kelengkapan_id'));

            $params = [
                'title' => 'Upload file ' . $kelengkapan->kelengkapan,
                'kegiatan_id' => $this->input->post('kegiatan_id'),
                'kelengkapan_id' => $this->input->post('kelengkapan_id'),
            ];
            $data['data'] = modal('upload_kelengkapan', $this->load->view($this->module . '/penyelidikan/add_sop_kelengkapan', $params, TRUE));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function uploadKelengkapan()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data = array();
            $data['status'] = TRUE;

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('kegiatan_id', 'Kegiatan', 'trim|required');
            $this->form_validation->set_rules('kelengkapan_id', 'Jaksa', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'kegiatan_id' => form_error('kegiatan_id'),
                    'kelengkapan_id' => form_error('kelengkapan_id')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'kegiatan_id' => $this->input->post('kegiatan_id'),
                    'kelengkapan_id' => $this->input->post('kelengkapan_id')
                );

                if (isset($_FILES['file']['name'])) {
                    $config['upload_path'] = './assets/kejati/files/';
                    $config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx';
                    $config['max_size']     = '20000';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('file')) {
                        $errors = array('file' => $this->upload->display_errors());
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                    } else {
                        $dataFile = $this->upload->data();
                        $insert['file'] = $dataFile['file_name'];
                        $insert['type'] = $dataFile['file_type'];

                        $temp = $this->session->userdata('temp');
                        $temp['kegiatan_kelengkapan'][$insert['kegiatan_id']][$insert['kelengkapan_id']] = $insert;
                        $this->session->set_userdata([
                            'temp' => $temp
                        ]);
                        $data['status'] = TRUE;
                        $data['kegiatan_id'] = $insert['kegiatan_id'];
                        $data['message'] = "Success to upload file";
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                } else {
                    $data = array(
                        'status'         => FALSE,
                        'errors'         => [
                            'file' => 'File is required'
                        ]
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    public function setLeader()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($this->input->post('id') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Code is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $ex = explode('|', $this->input->post('id'));
            if ($ex[0] == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Kegiatan is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            if ($ex[1] == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "Pegawai is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $temp = $this->session->userdata('temp');
            foreach ($temp['kegiatan'][$ex[0]] as $k => $v) {
                $temp['kegiatan'][$ex[0]][$k]['leader'] = 0;
            }
            $temp['kegiatan'][$ex[0]][$ex[1]]['leader'] = 1;
            $this->session->set_userdata([
                'temp' => $temp
            ]);

            $data = array(
                'status'         => TRUE,
                'message'         => "Success to set leader",
                'kegiatan_id' => $ex[0],
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function save()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('no_surat_tugas', 'No Surat Tugas', 'trim|required|is_unique[tugas.no_surat_tugas]');
            $this->form_validation->set_rules('no_nota_dinas', 'No Nota Dinas', 'trim|required');
            $this->form_validation->set_rules('tanggal_nota_dinas', 'Tanggal Nota Dinas', 'trim|required');
            $this->form_validation->set_rules('perihal_nota_dinas', 'Perihal Nota Dinas', 'trim|required');
            $this->form_validation->set_rules('pengaduan', 'Pengaduan', 'trim|required');
            $this->form_validation->set_rules('sop', 'SOP', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'no_surat_tugas' => form_error('no_surat_tugas'),
                    'no_nota_dinas' => form_error('no_nota_dinas'),
                    'tanggal_nota_dinas' => form_error('tanggal_nota_dinas'),
                    'perihal_nota_dinas' => form_error('perihal_nota_dinas'),
                    'pengaduan' => form_error('pengaduan'),
                    'sop' => form_error('sop'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'no_surat_tugas' => $this->input->post('no_surat_tugas'),
                    'no_nota_dinas' => $this->input->post('no_nota_dinas'),
                    'tanggal_nota_dinas' => $this->input->post('tanggal_nota_dinas'),
                    'perihal_nota_dinas' => $this->input->post('perihal_nota_dinas'),
                    'pengaduan_id' => $this->input->post('pengaduan'),
                    'sop_id' => $this->input->post('sop'),
                    'status' => 'Dalam proses'
                );

                // cek kelengkapan
                $temp = $this->session->userdata('temp');
                // var_dump($temp);
                // die;
                foreach ($temp['kegiatan_kelengkapan'] as $k => $v) {
                    if ($v == NULL || $v == '') {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => 'Lengkapi file kelengkapan terlebih dahulu'
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        foreach ($v as $t => $y) {
                            if ($y == NULL || $y == '') {
                                $data = array(
                                    'status'         => FALSE,
                                    'message'         => 'Lengkapi file kelengkapan terlebih dahulu'
                                );
                                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                            }
                        }
                    }
                }

                // cek pegawai dan leader
                foreach ($temp['kegiatan'] as $k => $v) {
                    if ($v == NULL || $v == '') {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => 'Setiap tugas minimal 1 jaksa'
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $leader = FALSE;
                        foreach ($v as $kk => $x) {
                            if ($x['leader'] == 1) {
                                $leader = TRUE;
                            }
                        }
                        if ($leader == FALSE) {
                            $data = array(
                                'status'         => FALSE,
                                'message'         => 'Setiap tugas harus mempunyai ketua tim jaksa'
                            );
                            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        }
                    }
                }

                $this->db->trans_start();
                $tugas = $this->db->insert('tugas', $insert);
                if ($this->db->trans_status() === FALSE || $tugas == FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add penyelidikan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                $tugas_id = $this->db->insert_id();

                $tembusanParams = [];
                $no = 1;
                $tembusanData = $this->input->post('tembusan') == NULL ? [] : $this->input->post('tembusan');
                foreach ($tembusanData as $t => $v) {
                    $tembusanParams[] = [
                        'tugas_id' => $tugas_id,
                        'tembusan' => $v,
                        'no_urut' => $no
                    ];
                    $no++;
                }
                $tembusan = $this->db->insert_batch('tembusan', $tembusanParams);
                if ($this->db->trans_status() === FALSE || $tembusan == FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add penyelidikan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }

                foreach ($temp['kegiatan'] as $k => $v) {
                    $kegiatanData = $this->kegiatan->get_by_id($k);
                    $kegiatanParams = [
                        'tugas_id' => $tugas_id,
                        'kegiatan_id' => $k,
                        'status' => 'Dalam proses',
                        'waktu' => $kegiatanData->waktu,
                        'satuan' => $kegiatanData->satuan,
                        // 'waktu_mulai' => date('Y-m-d H:i:s'),
                        'dibuka' => 0
                    ];
                    $kegiatan = $this->db->insert('detail_tugas', $kegiatanParams);
                    if ($this->db->trans_status() === FALSE || $kegiatan == FALSE) {
                        $this->db->trans_rollback();
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to add penyelidikan";
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                    $kegiatan_id = $this->db->insert_id();
                    $pegawai_detail_tugasParams = [];
                    foreach ($v as $k => $x) {
                        $pegawai_detail_tugasParams[] = [
                            'pegawai_id' => $x['pegawai']['id'],
                            'detail_tugas_id' => $kegiatan_id,
                            'leader' => $x['leader']
                        ];
                    }
                    $pegawai_detail_tugas = $this->db->insert_batch('pegawai_detail_tugas', $pegawai_detail_tugasParams);
                    if ($this->db->trans_status() === FALSE || $pegawai_detail_tugas == FALSE) {
                        $this->db->trans_rollback();
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to add penyelidikan";
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }

                    // var_dump($temp['kegiatan_kelengkapan'][$kegiatanData->id]);
                    // die;
                    $kelengkapanParams = [];
                    foreach ($temp['kegiatan_kelengkapan'][$kegiatanData->id] as $t => $y) {
                        $kelengkapanParams[] = [
                            'detail_tugas_id' => $kegiatan_id,
                            'kelengkapan_id' => $t,
                            'dokumen' => $y['file'],
                            'tipe' => $y['type']
                        ];
                    }
                    $kelengkapan = $this->db->insert_batch('kelengkapan_data', $kelengkapanParams);
                    if ($this->db->trans_status() === FALSE || $kelengkapan == FALSE) {
                        $this->db->trans_rollback();
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to add penyelidikan";
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }

                    $hasilData = $this->db->get_where('hasil', ['deleteAt' => NULL, 'kegiatan_id' => $kegiatanData->id])->result_array();


                    $hasilParams = [];
                    foreach ($hasilData as $h => $r) {
                        $hasilParams[] = [
                            'detail_tugas_id' => $kegiatan_id,
                            'hasil_id' => $r['id']
                        ];
                    }
                    $hasil = $this->db->insert_batch('hasil_data', $hasilParams);
                    if ($this->db->trans_status() === FALSE || $hasil == FALSE) {
                        $this->db->trans_rollback();
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to add penyelidikan";
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
                $this->db->trans_commit();

                $data['status'] = TRUE;
                $data['message'] = "Success to add penyelidikan";
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function saveEdit()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;




            // cek kelengkapan
            $temp = $this->session->userdata('temp');
            // var_dump($temp);
            // die;
            foreach ($temp['kegiatan_kelengkapan'] as $k => $v) {
                if ($v == NULL || $v == '') {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'Lengkapi file kelengkapan terlebih dahulu'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    foreach ($v as $t => $y) {
                        if ($y == NULL || $y == '') {
                            $data = array(
                                'status'         => FALSE,
                                'message'         => 'Lengkapi file kelengkapan terlebih dahulu'
                            );
                            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        }
                    }
                }
            }

            // cek pegawai dan leader
            foreach ($temp['kegiatan'] as $k => $v) {
                if ($v == NULL || $v == '') {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'Setiap tugas minimal 1 jaksa'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $leader = FALSE;
                    foreach ($v as $kk => $x) {
                        if ($x['leader'] == 1) {
                            $leader = TRUE;
                        }
                    }
                    if ($leader == FALSE) {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => 'Setiap tugas harus mempunyai ketua tim jaksa'
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }

            $this->db->trans_start();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $data['status'] = FALSE;
                $data['message'] = "Failed to add penyelidikan";
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            $tugas_id = $this->session->userdata('tugas_id');




            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $data['status'] = FALSE;
                $data['message'] = "Failed to add penyelidikan";
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }

            foreach ($temp['kegiatan'] as $k => $v) {
                // var_dump($v);
                // die;
                $kegiatanData = $this->kegiatan->get_by_id($k);
                $kegiatanParams = [
                    'tugas_id' => $tugas_id,
                    'kegiatan_id' => $k,
                    'status' => 'Dalam proses',
                    'waktu' => $kegiatanData->waktu,
                    'satuan' => $kegiatanData->satuan,
                    // 'waktu_mulai' => date('Y-m-d H:i:s'),
                    'dibuka' => 0
                ];
                $kegiatan = $this->db->insert('detail_tugas', $kegiatanParams);
                if ($this->db->trans_status() === FALSE || $kegiatan == FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add penyelidikan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                $kegiatan_id = $this->db->insert_id();
                $pegawai_detail_tugasParams = [];
                foreach ($v as $k => $x) {
                    $pegawai_detail_tugasParams[] = [
                        'pegawai_id' => $x['pegawai']['id'],
                        'detail_tugas_id' => $kegiatan_id,
                        'leader' => $x['leader']
                    ];
                }
                $pegawai_detail_tugas = $this->db->insert_batch('pegawai_detail_tugas', $pegawai_detail_tugasParams);
                if ($this->db->trans_status() === FALSE || $pegawai_detail_tugas == FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add penyelidikan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }

                // var_dump($temp['kegiatan_kelengkapan'][$kegiatanData->id]);
                // die;
                $kelengkapanParams = [];
                foreach ($temp['kegiatan_kelengkapan'][$kegiatanData->id] as $t => $y) {
                    $kelengkapanParams[] = [
                        'detail_tugas_id' => $kegiatan_id,
                        'kelengkapan_id' => $t,
                        'dokumen' => $y['file'],
                        'tipe' => $y['type']
                    ];
                }
                $kelengkapan = $this->db->insert_batch('kelengkapan_data', $kelengkapanParams);
                if ($this->db->trans_status() === FALSE || $kelengkapan == FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add penyelidikan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }

                $hasilData = $this->db->get_where('hasil', ['deleteAt' => NULL, 'kegiatan_id' => $kegiatanData->id])->result_array();


                $hasilParams = [];
                foreach ($hasilData as $h => $r) {
                    $hasilParams[] = [
                        'detail_tugas_id' => $kegiatan_id,
                        'hasil_id' => $r['id']
                    ];
                }
                $hasil = $this->db->insert_batch('hasil_data', $hasilParams);
                if ($this->db->trans_status() === FALSE || $hasil == FALSE) {
                    $this->db->trans_rollback();
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add penyelidikan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
            $this->db->trans_commit();

            $data['status'] = TRUE;
            $data['message'] = "Success to add penyelidikan";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function detail()
    {
        if (isset($this->session->userdata('temp')['kegiatan'])) {
            $this->session->unset_userdata('temp');
        }
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->session->set_userdata('tugas_id', $this->input->post('tugas_id'));
        if ($this->input->post('tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->join('sop', 'sop.id=tugas.sop_id')
            ->get_where('tugas', ['tugas.deleteAt' => NULL, 'tugas.id' => $this->input->post('tugas_id')])
            ->row();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $detail_tugas = [];
        $detail_tugas_data = $this->db->select('*,detail_tugas.id as detail_tugas_id')->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.tugas_id' => $this->input->post('tugas_id')])->result_array();
        foreach ($detail_tugas_data as $k) {
            $k['pegawai'] = $this->db->join('pegawai', 'pegawai.id=pegawai_detail_tugas.pegawai_id')
                ->where(['pegawai.deleteAt' => NULL, 'pegawai_detail_tugas.deleteAt' => NULL, 'pegawai_detail_tugas.detail_tugas_id' => $k['detail_tugas_id']])
                ->get('pegawai_detail_tugas')
                ->result_array();
            $k['kelengkapan'] = $this->db->join('kelengkapan', 'kelengkapan.id=kelengkapan_data.kelengkapan_id')
                ->where(['kelengkapan.deleteAt' => NULL, 'kelengkapan_data.deleteAt' => NULL, 'kelengkapan_data.detail_tugas_id' => $k['detail_tugas_id']])
                ->get('kelengkapan_data')
                ->result_array();
            $k['hasil'] = $this->db->join('hasil', 'hasil.id=hasil_data.hasil_id')
                ->where(['hasil.deleteAt' => NULL, 'hasil_data.deleteAt' => NULL, 'hasil_data.detail_tugas_id' => $k['detail_tugas_id']])
                ->get('hasil_data')
                ->result_array();
            $temp = $k;
            $detail_tugas[] = $temp;
        }
        $pengaduan = $this->pengaduan->get_by_id($tugas->pengaduan_id);
        if ($pengaduan == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Pengaduan tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $kegiatanData = $this->kegiatan->get_all($tugas->sop_id);
        $kegiatan = [];
        foreach ($kegiatanData as $k => $v) {
            $kegiatan[$v->id] = $v->kegiatan;
        }
        $data['status'] = TRUE;
        $params = [
            'title' => 'Detail penyelidikan',
            'tugas' => $tugas,
            'detail_tugas' => $detail_tugas,
            'pengaduan' => $this->load->view($this->module . '/penyelidikan/pengaduan', $pengaduan, TRUE),
            'kegiatan' => $kegiatan
        ];
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Kejati",
                "url" => base_url('kejati/penyelidikan')
            ],
            [
                "text" => "Penyelidikan",
                "action" => "back()"
            ],
            [
                "text" => "Detail Data Penyelidikan"
            ]
        ], 'Detail Data Penyelidikan');
        $data['data'] = $this->load->view($this->module . '/penyelidikan/detail/index', $params, TRUE);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function terima()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('tugas.id as tugas_id, detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id'), 'detail_tugas.status' => 'Ditinjau atasan'])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $update = $this->db->where('id', $this->input->post('detail_tugas_id'))->update('detail_tugas', ['status' => 'Diterima']);
        if ($update) {
            $data['status'] = TRUE;
            $data['message'] = "Berhasil menerima tugas dari ketua tim";
        } else {
            $data['status'] = FALSE;
            $data['message'] = "Berhasil menerima tugas dari ketua tim";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function tolak()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDETAILPENYELIDIKAN', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->input->post('detail_tugas_id') == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas is required"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $tugas = $this->db
            ->select('tugas.id as tugas_id, detail_tugas.id as id, detail_tugas.dibuka, sop.sop, sop.kategori, sop.waktu as sopWaktu, tugas.no_surat_tugas, tugas.no_nota_dinas, tugas.tanggal_nota_dinas, tugas.perihal_nota_dinas, tugas.status as tugasStatus, kegiatan.kegiatan, detail_tugas.waktu, detail_tugas.satuan, detail_tugas.waktu_mulai, detail_tugas.waktu_selesai, detail_tugas.status as detail_tugasStatus, tugas.pengaduan_id, kegiatan.keterangan')
            ->join('tugas', 'tugas.id=detail_tugas.tugas_id')
            ->join('sop', 'sop.id=tugas.sop_id')
            ->join('kegiatan', 'kegiatan.id=detail_tugas.kegiatan_id')
            ->get_where('detail_tugas', ['detail_tugas.deleteAt' => NULL, 'detail_tugas.id' => $this->input->post('detail_tugas_id'), 'detail_tugas.status' => 'Ditinjau atasan'])
            ->row_array();
        if ($tugas == NULL) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Tugas tidak ditemukan"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $update = $this->db->where('id', $this->input->post('detail_tugas_id'))->update('detail_tugas', ['status' => 'Ditolak', 'waktu_selesai' => NULL]);
        if ($update) {
            $data['status'] = TRUE;
            $data['message'] = "Berhasil menolak tugas dari ketua tim";
        } else {
            $data['status'] = FALSE;
            $data['message'] = "Berhasil menolak tugas dari ketua tim";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
