<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends MX_Controller
{
    private $module = 'kejati';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "Anda harus login terlebih dahulu"
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        //     die();
        // }
    }

    private function checkStatusKegiatan(string $detail_tugas_id)
    {
        $check = $this->db->select('status')->get_where('detail_tugas', ['deleteAt' => NULL, 'id' =>  $detail_tugas_id])->row_array();
        if ($check == NULL) {
            $data['status'] = FALSE;
            $data['message'] = "Kegiatan tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            return $check['status'];
        }
    }

    private function getPegawaiDetailTugasId(string $detail_tugas_id, string $pegawai_id)
    {
        $get = $this->db->select('id')->get_where('pegawai_detail_tugas', ['deleteAt' => NULL, 'pegawai_id' => $pegawai_id, 'detail_tugas_id' => $detail_tugas_id])->row_array();
        if ($get == NULL) {
            $data['status'] = FALSE;
            $data['message'] = "Tugas tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            return $get['id'];
        }
    }

    private function checkKonsultasiDone(string $konsultasi_id)
    {
        $get = $this->db->select('waktu_selesai')->get_where('konsultasi', ['deleteAt' => NULL, 'id' => $konsultasi_id])->row_array();
        if ($get == NULL) {
            $data['status'] = FALSE;
            $data['message'] = "Konsultasi tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($get['waktu_selesai'] == NULL) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function all($pegawai_detail_tugas_id = '')
    {
        // $userPermission = getPermissionFromUser();
        // if (!in_array('UJABATAN', $userPermission)) {
        //     $data = array(
        //         'status'         => FALSE,
        //         'message'         => "Anda tidak memiliki akses!"
        //     );
        //     return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // }
        if ($pegawai_detail_tugas_id == '') {
            $data['status'] = FALSE;
            $data['message'] = "Tugas tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $d = $this->db->get_where('konsultasi', ['deleteAt' => NULL, 'pegawai_detail_tugas_id' => $pegawai_detail_tugas_id])->result_array();
        $temp = [];
        foreach ($d as $k => $v) {
            $r = $v;
            $r['postedOn'] = nice_date($v['createAt'], 'F d, Y');
            $temp['konsultasi'][] = $r;
        }
        $temp['total'] = count($d);
        $data['status'] = TRUE;
        $data['message'] = "";
        $data['data'] = $temp;
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function add($pegawai_detail_tugas_id = '')
    {
        // $userPermission = getPermissionFromUser();
        // if (!in_array('UJABATAN', $userPermission)) {
        //     $data = array(
        //         'status'         => FALSE,
        //         'message'         => "Anda tidak memiliki akses!"
        //     );
        //     return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // }
        if ($pegawai_detail_tugas_id == '') {
            $data['status'] = FALSE;
            $data['message'] = "Tugas tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $d = $this->db->get_where('konsultasi', ['deleteAt' => NULL, 'pegawai_detail_tugas_id' => $pegawai_detail_tugas_id, 'waktu_selesai' => NULL])->row_array();
        if ($d != NULL) {
            $data['status'] = FALSE;
            $data['message'] = "Ada konsultasi yang belum terselesaikan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'judul' => form_error('judul'),
                'deskripsi' => form_error('deskripsi'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $getData = $this->db->join('pegawai', 'pegawai.pegawai_id=pegawai_detail_tugas.pegawai_id')->get_where('pegawai_detail_tugas', ['pegawai_detail_tugas.deleteAt' => NULL, 'pegawai_detail_tugas_id' => $pegawai_detail_tugas_id])->row_array();
            if ($getData == NULL) {
                $data['status'] = FALSE;
                $data['message'] = "Data tidak ditemukan";
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                if ($this->checkStatusKegiatan($getData['detail_tugas_id']) == 'Diterima') {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah konsultasi, kegiatan sudah diterima";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                if ($this->checkStatusKegiatan($getData['detail_tugas_id']) == 'Ditinjau atasan') {
                    $data['status'] = FALSE;
                    $data['message'] = "Gagal menambah konsultasi, kegiatan masih dalam penijauan oleh atasan";
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                if ($getData['leader'] == 0) {
                    $tipe = 0;
                } else {
                    $tipe = 1;
                }
            }
            $insert = array(
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'tipe' => $tipe
            );
            $insert = $this->db->insert('konsultasi', $insert);
            if ($insert) {
                $data['status'] = TRUE;
                $data['message'] = "Berhasil menambah konsultasi";
            } else {
                $data['status'] = FALSE;
                $data['message'] = "Gagal menambah konsultasi";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function edit($konsultasi_id = '')
    {
        // $userPermission = getPermissionFromUser();
        // if (!in_array('UJABATAN', $userPermission)) {
        //     $data = array(
        //         'status'         => FALSE,
        //         'message'         => "Anda tidak memiliki akses!"
        //     );
        //     return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // }
        if ($konsultasi_id == '') {
            $data['status'] = FALSE;
            $data['message'] = "Konsultasi tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($this->checkKonsultasiDone($konsultasi_id) == TRUE) {
            $data['status'] = FALSE;
            $data['message'] = "Tidak dapat merubah konsultasi, konsultasi telah selesai";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'judul' => form_error('judul'),
                'deskripsi' => form_error('deskripsi'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi')
            );
            $insert = $this->db->where('id', $konsultasi_id)->update('konsultasi', $insert);
            if ($insert) {
                $data['status'] = TRUE;
                $data['message'] = "Berhasil mengubah konsultasi";
            } else {
                $data['status'] = FALSE;
                $data['message'] = "Gagal mengubah konsultasi";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function allChat($konsultasi_id = '')
    {
        // $userPermission = getPermissionFromUser();
        // if (!in_array('UJABATAN', $userPermission)) {
        //     $data = array(
        //         'status'         => FALSE,
        //         'message'         => "Anda tidak memiliki akses!"
        //     );
        //     return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // }
        if ($konsultasi_id == '') {
            $data['status'] = FALSE;
            $data['message'] = "Konsultasi tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $d = $this->db->get_where('detail_konsultasi', ['deleteAt' => NULL, 'konsultasi_id' => $konsultasi_id])->result_array();
        $temp = [];
        foreach ($d as $k => $v) {
            $r = $v;
            $r['createAt'] = nice_date($v['createAt'], 'F d, Y, g:i a');
            $temp['chat'][] = $r;
        }
        $temp['total'] = count($d);
        $data['status'] = TRUE;
        $data['message'] = "";
        $data['data'] = $temp;
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function newChat($konsultasi_id = '', $count = '')
    {
        // $userPermission = getPermissionFromUser();
        // if (!in_array('UJABATAN', $userPermission)) {
        //     $data = array(
        //         'status'         => FALSE,
        //         'message'         => "Anda tidak memiliki akses!"
        //     );
        //     return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // }
        if ($konsultasi_id == '') {
            $data['status'] = FALSE;
            $data['message'] = "Konsultasi tidak ditemukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if ($count == '') {
            $data['status'] = FALSE;
            $data['message'] = "Jumlah pesan diperlukan";
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $d = $this->db->get_where('detail_konsultasi', ['deleteAt' => NULL, 'konsultasi_id' => $konsultasi_id])->result_array();
        if ($count < count($d)) {
            $d = $this->db->order_by('createAt', 'DESC')->get_where('detail_konsultasi', ['deleteAt' => NULL, 'konsultasi_id' => $konsultasi_id])->row_array();
            $d['createAt'] = nice_date($d['createAt'], 'F d, Y, g:i a');
            $data['status'] = TRUE;
            $data['new'] = TRUE;
            $data['data'] = $d;
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $data['new'] = FALSE;
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }


}
