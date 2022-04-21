<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/pengaduan_model', 'pengaduan');
        $this->load->model($this->module . '/penyelidikan_model', 'penyelidikan');
        $this->load->model($this->module . '/pegawai_model', 'pegawai');
        $this->load->model($this->module . '/sop_model', 'sop');
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
            $page = ($this->input->post('page') == null ? 1 : $this->input->post('page'));
            $no = ($this->input->post('noPengaduan') == null ? 0 : $this->input->post('noPengaduan'));
            $search = ($this->input->post('cari') == null ? null : $this->input->post('cari'));

            $peng = [];
            $where = ($no != 0) ? ['pengaduan.deleteAt' => NULL, 'pengaduan.id' => $no] : ['pengaduan.deleteAt' => NULL];
            $pengaduan = $this->db->where($where)->get('pengaduan')->result_array(); //4

            foreach ($pengaduan as $s => $k) {
                $ff = [];
                if ($search == null) {
                    $tugas = $this->db
                        ->join('sop', 'sop.id=tugas.sop_id')
                        ->get_where('tugas', ['sop.kategori' => 'Penyelidikan', 'tugas.deleteAt' => NULL, 'tugas.pengaduan_id' => $k['id']])
                        ->result_array();
                    if ($tugas != NULL) {
                        $jaksa = [];
                        foreach ($tugas as $r => $t) {
                            $temp = $this->db
                                ->select('pegawai.id')
                                ->join('pegawai', 'pegawai.id=jaksa_tugas.pegawai_id')
                                ->get_where('jaksa_tugas', [
                                    'jaksa_tugas.tugas_id' => $t['id'],
                                    'jaksa_tugas.deleteAt' => NULL,
                                    'pegawai.deleteAt' => NULL
                                ])
                                ->result_array();
                            $temp = array_values(array_column($temp, 'id'));
                            $jaksa = array_merge($jaksa, $temp);
                        }
                        $jaksa = array_unique(array_values($jaksa));
                        $sementara = [];
                        foreach ($jaksa  as $j => $a) {
                            $semen = json_decode(json_encode($this->pegawai->get_by_id($a)), TRUE);
                            $semen['tugas'] = count($this->db->where_in('tugas_id', array_values(array_column($tugas, 'id')))->where('deleteAt', NULL)->get('jaksa_tugas')->result_array());
                            $sementara[] = $semen;
                        }
                        $ff = $k;
                        $proses = array_count_values(array_values(array_column($tugas, 'status')));
                        $ff['total'] = count($tugas);
                        $ff['proses'] = isset($proses['Dalam proses']) ? $proses['Dalam proses'] : 0;
                        $ff['selesai'] = isset($proses['Selesai']) ? $proses['Selesai'] : 0;
                        $ff['persen'] = number_format(($ff['total'] != 0) ? (($ff['selesai'] / $ff['total']) * 100) : 0, 0);
                        $ff['jaksa'] = $sementara;
                        $peng[] = $ff;
                    }
                } else {
                    $tugas = $this->db
                        ->group_start()
                        ->like('no_surat_tugas', $search)
                        ->or_like('no_nota_dinas', $search)
                        ->or_like('tanggal_nota_dinas', $search)
                        ->or_like('perihal_nota_dinas', $search)
                        ->or_like('status', $search)
                        ->group_end()
                        ->join('sop', 'sop.id=tugas.sop_id')
                        ->get_where('tugas', ['sop.kategori' => 'Penyelidikan', 'tugas.deleteAt' => NULL, 'tugas.pengaduan_id' => $k['id']])
                        ->result_array();
                    if ($tugas != NULL) {
                        $ff = $k;
                        $tugas = $this->db
                            ->join('sop', 'sop.id=tugas.sop_id')
                            ->get_where('tugas', ['sop.kategori' => 'Penyelidikan', 'tugas.deleteAt' => NULL, 'tugas.pengaduan_id' => $k['id']])
                            ->result_array();
                        $jaksa = [];
                        foreach ($tugas as $r => $t) {
                            $temp = $this->db
                                ->select('pegawai.id')
                                ->join('pegawai', 'pegawai.id=jaksa_tugas.pegawai_id')
                                ->get_where('jaksa_tugas', [
                                    'jaksa_tugas.tugas_id' => $t['id'],
                                    'jaksa_tugas.deleteAt' => NULL,
                                    'pegawai.deleteAt' => NULL
                                ])
                                ->result_array();
                            $temp = array_values(array_column($temp, 'id'));
                            $jaksa = array_merge($jaksa, $temp);
                        }
                        $jaksa = array_unique(array_values($jaksa));
                        $sementara = [];
                        foreach ($jaksa  as $j => $a) {
                            $semen = json_decode(json_encode($this->pegawai->get_by_id($a)), TRUE);
                            $semen['tugas'] = count($this->db->where_in('tugas_id', array_values(array_column($tugas, 'id')))->where('deleteAt', NULL)->get('jaksa_tugas')->result_array());
                            $sementara[] = $semen;
                        }
                        $proses = array_count_values(array_values(array_column($tugas, 'status')));
                        $ff['total'] = count($tugas);
                        $ff['proses'] = isset($proses['Dalam proses']) ? $proses['Dalam proses'] : 0;
                        $ff['selesai'] = isset($proses['Selesai']) ? $proses['Selesai'] : 0;
                        $ff['persen'] = number_format(($ff['total'] != 0) ? (($ff['selesai'] / $ff['total']) * 100) : 0, 0);
                        $ff['jaksa'] = $sementara;
                        $peng[] = $ff;
                    }
                }
            }

            $params = [
                'userPermission' => $userPermission,
                'pengaduan' => $peng,
                'total' => count($peng),
                'page' => $page
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
            $params = [
                'title' => 'Add Data Penyelidikan',
                'id' => NULL,
                'no' => NULL,
                'tanggal_surat' => NULL,
                'tanggal_terima' => NULL,
                'asal_surat' => NULL,
                'perihal' => NULL,
                'isi' => NULL,
                'pengaduan' => $pengaduan
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
                        'message'         => "pengaduan not found!"
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
}
