<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan_model extends CI_Model
{

	var $table = 'tugas';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all()
	{
		$this->db->from($this->table)
			->join('sop', 'sop.id=tugas.sop_id')
			->where('tipe_sop', 'Penyelidikan')
			->where('deleteAt', NULL);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id', $id)->where('deleteAt', NULL);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$data['updateAt'] = date('Y-m-d H:i:s');
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$data['deleteAt'] = date('Y-m-d H:i:s');
		$this->db->update($this->table, $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}
