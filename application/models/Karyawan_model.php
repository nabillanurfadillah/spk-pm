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

    public function getAllKaryawanAdded()
    {
        $karyawan =  $this->db->get('karyawan')->result_array();
        $karyawanadd = [];
        foreach ($karyawan as  $value) {
            $idkar = $value['id_karyawan'];
            $karyawan2 =  $this->db->get_where('rangking', 'rangking.id_karyawan = ' . $idkar)->row_array();
            if (!$karyawan2['id_karyawan']) {
                $karyawanadd[] = $value;
            }
        }
        return $karyawanadd;
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

    public function hapusDataKaryawanNilai()
    {
        $id_karyawan =  $this->input->post('id_karyawan', true);
        $this->db->delete('penilaian', ['id_karyawan' => $id_karyawan]);
        $this->db->delete('hitung', ['id_karyawan' => $id_karyawan]);
        $this->db->delete('nilai_akhir', ['id_karyawan' => $id_karyawan]);
        $this->db->delete('rangking', ['id_karyawan' => $id_karyawan]);
    }
}
