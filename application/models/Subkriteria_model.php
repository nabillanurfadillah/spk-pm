<?php

class Subkriteria_model extends CI_Model
{
    public function getSubkriteriaById($id_subkriteria)
    {
        return $this->db->get_where('subkriteria', ['id_subkriteria' => $id_subkriteria])->row_array();
    }

    public function getAllSubkriteria()
    {
      $query = "SELECT subkriteria.*, nama_kriteria
                FROM subkriteria join kriteria
                 ON subkriteria.id_kriteria = kriteria.id_kriteria";
        return $this->db->query($query)->result_array();
    }

    public function tambahDataSubkriteria()
    {
        $data = [
            'id_kriteria' => $this->input->post('id_kriteria', true),
            'nama_subkriteria' => $this->input->post('nama_subkriteria', true),
            'faktor' => $this->input->post('faktor', true),
            'nilai_subkriteria' => $this->input->post('nilai_subkriteria', true)
        ];
        
        $this->db->insert('subkriteria', $data);
    }

    public function ubahDataSubkriteria($subkriteria, $id_subkriteria)
    {
        $id_kriteria = $this->input->post('id_kriteria', true);
        $nama_subkriteria = $this->input->post('nama_subkriteria', true);
        $faktor = $this->input->post('faktor', true);
        $nilai_subkriteria = $this->input->post('nilai_subkriteria', true);
       $data = [
            'nama_subkriteria' => $nama_subkriteria,
            'faktor' => $faktor,
            'nilai_subkriteria' => $nilai_subkriteria,
            'id_kriteria' => $id_kriteria
        ];
        $this->db->set($data);
        $this->db->where('id_subkriteria', $id_subkriteria);
        $this->db->update('subkriteria');
    }

    public function hapusDataSubkriteria()
    {
        $id_subkriteria =  $this->input->post('id_subkriteria', true);
        $this->db->delete('subkriteria', ['id_subkriteria' => $id_subkriteria]);
    }
}