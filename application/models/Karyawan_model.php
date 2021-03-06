<?php

class Karyawan_model extends CI_Model
{
    public function getKaryawanById($id_karyawan)
    {
        return $this->db->get_where('karyawan', ['id_karyawan' => $id_karyawan])->row_array();
    }
    public function getAllKaryawan()
    {
        return $this->db->get('karyawan')->result_array();
    }
    public function tambahDataKaryawan()
    {
        $data = [
            'nama_karyawan' => $this->input->post('nama_karyawan', true)
        ];

        $this->db->insert('karyawan', $data);
    }
    public function ubahDataKaryawan($karyawan, $id_karyawan)
    {
        $nama_karyawan = $this->input->post('nama_karyawan', true);
        $data = [
            'nama_karyawan' => $nama_karyawan,
        ];
        $this->db->set($data);
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->update('karyawan');
    }

    public function hapusDataKaryawan()
    {
        $id_karyawan =  $this->input->post('id_karyawan', true);
        $this->db->delete('karyawan', ['id_karyawan' => $id_karyawan]);
    }
  }