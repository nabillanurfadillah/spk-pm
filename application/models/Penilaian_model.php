<?php

class Penilaian_model extends CI_Model
{
    public function getPenilaianById($id_penilaian)
    {
        return $this->db->get_where('penilaian', ['id_penilaian' => $id_penilaian])->row_array();
    }

    public function getAllPenilaian()
    {
        $query = "SELECT penilaian.*, karyawan.nama_karyawan, kriteria.nama_kriteria, subkriteria.nama_subkriteria, subkriteria.faktor, nilai_subkriteria
                    FROM penilaian join karyawan
                    ON penilaian.id_karyawan = karyawan.id_karyawan
                    join subkriteria
                    on penilaian.id_subkriteria = subkriteria.id_subkriteria
                    join kriteria
                    on subkriteria.id_kriteria = kriteria.id_kriteria";
        return $this->db->query($query)->result_array();
    }

    public function getAllHitung()
    {
        $query = "SELECT hitung.faktor, hitung.rata_rata, karyawan.nama_karyawan, kriteria.nama_kriteria 
                    FROM hitung join karyawan
                    ON hitung.id_karyawan = karyawan.id_karyawan
                    join kriteria
                    on hitung.id_kriteria = kriteria.id_kriteria";
        return $this->db->query($query)->result_array();
    }

    public function getAllNilaiAkhir()
    {
        $query = "SELECT nilai_akhir.nilai_total, nilai_akhir.nilai_akhir, karyawan.nama_karyawan, kriteria.nama_kriteria 
                    FROM nilai_akhir join karyawan
                    ON  nilai_akhir.id_karyawan = karyawan.id_karyawan
                    join kriteria
                    on  nilai_akhir.id_kriteria = kriteria.id_kriteria";
        return $this->db->query($query)->result_array();
    }

    public function tambahDataPenilaian()
    {

        $subkriteria = $this->db->get('subkriteria')->result_array();

        foreach ($subkriteria as $s) {
            $idk =  $s['id_kriteria'];
            $idsub =  $s['id_subkriteria'];
            $nilai = $this->input->post('nilai' . $idsub);
            $nilaisub = $s['nilai_subkriteria'];
            $selisih = $nilai - $nilaisub;
            $this->db->select('nilai_gap');
            $nilai_gap = $this->db->get_where('nilai_gap', ['selisih_gap' => $selisih])->row_array();
            $result = implode(",", $nilai_gap);

            $data = [
                'id_karyawan' => $this->input->post('id_karyawan', true),
                'id_kriteria' =>   $idk,
                'id_subkriteria' =>   $idsub,
                'nilai' => $nilai,
                'selisih' => $selisih,
                'nilai_gap' => $result
            ];
            $this->db->insert('penilaian', $data);
        }

        $id_karyawan = $this->input->post('id_karyawan', true);

        $kriteria =  $this->db->get('kriteria')->result_array();

        foreach ($kriteria  as $kri) {
            $idkri =  $kri['id_kriteria'];

            $this->db->join('subkriteria', 'subkriteria.id_subkriteria = penilaian.id_subkriteria');
            $penilaian =  $this->db->get_where('penilaian', ['penilaian.id_kriteria' => $idkri, 'id_karyawan' => $id_karyawan])->result_array();

            $nilai = 0;
            $nilai2 = 0;
            $count = 0;
            $count2 = 0;
            $faktorcore = '';
            $faktorsec = '';

            foreach ($penilaian  as $pen) {

                if ($pen['faktor'] == "Core") {
                    $nilai += $pen['nilai_gap'];
                    $count++;
                    $faktorcore = $pen['faktor'];
                } else {
                    $nilai2 += $pen['nilai_gap'];
                    $count2++;
                    $faktorsec = $pen['faktor'];
                }
            }

            $rata_ratacore = $nilai / $count;
            $datacore = [
                'id_karyawan' => $id_karyawan,
                'id_kriteria' => $idkri,
                'faktor' => $faktorcore,
                'rata_rata' => $rata_ratacore

            ];

            $this->db->insert('hitung', $datacore);

            $rata_ratasec =  $nilai2 / $count2;
            $datasec = [
                'id_karyawan' => $id_karyawan,
                'id_kriteria' => $idkri,
                'faktor' => $faktorsec,
                'rata_rata' => $rata_ratasec
            ];

            $this->db->insert('hitung', $datasec);

            // echo '<pre>';          
            // var_dump($datacore) ;              
            // echo '</pre>';

            $hitung = $this->db->get_where('hitung', ['id_kriteria' => $idkri, 'id_karyawan' => $id_karyawan])->result_array();

            $nilai_total = 0;
            foreach ($hitung as $h) {

                if ($h['faktor'] == "Core") {
                    $nilai = $h['rata_rata'] * 0.6;
                } else {
                    $nilai2 = $h['rata_rata'] * 0.4;
                }
                $nilai_total = $nilai + $nilai2;
            }

            $nilai_kriteria = $kri['nilai_kriteria'] / 100;

            $nilai_akhir = $nilai_total * $nilai_kriteria;

            // echo '<pre>';
            // var_dump($nilai_akhir);
            // echo '</pre>';

            $data = [
                'id_karyawan' => $id_karyawan,
                'id_kriteria' => $idkri,
                'nilai_total' => $nilai_total,
                'nilai_akhir' =>  $nilai_akhir
            ];
            $this->db->insert('nilai_akhir', $data);

            // echo '<pre>';
            // var_dump($nilai_akhir);
            // echo '</pre>';
        }
        $jumlah_akhir = $this->db->select('sum(nilai_akhir) nilai_rangking')->get_where('nilai_akhir', ['id_karyawan' => $id_karyawan])->row_array();

        $data = [
            'id_karyawan' => $id_karyawan,
        ];
        $this->db->set($jumlah_akhir);
        $this->db->insert('rangking', $data);

        // echo '<pre>';
        // var_dump($jumlah_akhir);
        // echo '</pre>';
        // die;
    }

    public function editDataPenilaian()
    {

        $id_penilaian = $this->input->post('id_penilaian', true);
        $nilai_subkriteria =  $this->input->post('nilai_subkriteria', true);


        $nilai = $this->input->post('nilai', true);
        $selisih = $nilai -  $nilai_subkriteria;
        $nilai_gap = $this->db->select('nilai_gap')->get_where('nilai_gap', ['selisih_gap' => $selisih])->row_array();

        $data = [
            'nilai' => $nilai,
            'selisih' => $selisih,
        ];
        $this->db->set($nilai_gap)->where('id_penilaian', $id_penilaian)->update('penilaian', $data);


        $id_karyawan = $this->input->post('id_karyawan', true);

        $kriteria =  $this->db->get('kriteria')->result_array();

        foreach ($kriteria  as $kri) {
            $idkri =  $kri['id_kriteria'];

            $this->db->join('subkriteria', 'subkriteria.id_subkriteria = penilaian.id_subkriteria');
            $penilaian =  $this->db->get_where('penilaian', ['penilaian.id_kriteria' => $idkri, 'id_karyawan' => $id_karyawan])->result_array();

            $nilai = 0;
            $nilai2 = 0;
            $count = 0;
            $count2 = 0;

            foreach ($penilaian  as $pen) {

                if ($pen['faktor'] == "Core") {
                    $nilai += $pen['nilai_gap'];
                    $count++;
                } else {
                    $nilai2 += $pen['nilai_gap'];
                    $count2++;
                }
            }

            $rata_ratacore = $nilai / $count;
            $datacore = [
                'rata_rata' => $rata_ratacore
            ];

            $this->db->set($datacore)->where(['id_karyawan' => $id_karyawan, 'id_kriteria' => $idkri, 'faktor' => 'Core'])->update('hitung');

            $rata_ratasec =  $nilai2 / $count2;
            $datasec = [
                'rata_rata' => $rata_ratasec
            ];

            $this->db->set($datasec)->where(['id_karyawan' => $id_karyawan, 'id_kriteria' => $idkri,  'faktor' => 'Secondary'])->update('hitung');

            $hitung = $this->db->get_where('hitung', ['id_kriteria' => $idkri, 'id_karyawan' => $id_karyawan])->result_array();

            $nilai_total = 0;
            foreach ($hitung as $h) {

                if ($h['faktor'] == "Core") {
                    $nilai = $h['rata_rata'] * 0.6;
                } else {
                    $nilai2 = $h['rata_rata'] * 0.4;
                }
                $nilai_total = $nilai + $nilai2;
            }

            $nilai_kriteria = $kri['nilai_kriteria'] / 100;

            $nilai_akhir = $nilai_total * $nilai_kriteria;

            $data = [
                'nilai_total' => $nilai_total,
                'nilai_akhir' =>  $nilai_akhir
            ];
            $this->db->set($data)->where(['id_karyawan' => $id_karyawan, 'id_kriteria' => $idkri])->update('nilai_akhir');

            // echo '<pre>';
            // var_dump($nilai_akhir);
            // echo '</pre>';
        }

        $jumlah_akhir = $this->db->select('sum(nilai_akhir) nilai_rangking')->get_where('nilai_akhir', ['id_karyawan' => $id_karyawan])->row_array();

        $data = [
            'id_karyawan' => $id_karyawan,
        ];
        $this->db->set($jumlah_akhir);
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->update('rangking', $data);

        // echo '<pre>';
        // var_dump($jumlah_akhir);
        // echo '</pre>';
        // die;

    }
}
