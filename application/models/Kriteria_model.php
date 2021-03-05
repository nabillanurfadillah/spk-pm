<?php

class Kriteria_model extends CI_Model
{
    public function getKriteriaById($id_kriteria)
    {
        return $this->db->get_where('kriteria', ['id_kriteria' => $id_kriteria])->row_array();
    }
    public function getAllKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }
    public function tambahDataKriteria()
    {
        $data = [
            'nama_kriteria' => $this->input->post('nama_kriteria', true),
            'nilai_kriteria' => $this->input->post('nilai_kriteria', true)
        ];

        $this->db->insert('kriteria', $data);
    }
    public function ubahDataKriteria($kriteria, $id_kriteria)
    {
        $nama_kriteria = $this->input->post('nama_kriteria', true);
        $nilai_kriteria = $this->input->post('nilai_kriteria', true);
        $data = [
            'nama_kriteria' => $nama_kriteria,
            'nilai_kriteria' => $nilai_kriteria
        ];
        $this->db->set($data);
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->update('kriteria');
    }

    public function hapusDataKriteria($id_kriteria)
    {
        $this->db->delete('kriteria', ['id_kriteria' => $id_kriteria]);
    }
  }