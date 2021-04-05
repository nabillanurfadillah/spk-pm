<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Kriteria_model');
        $this->load->model('Subkriteria_model');
        $this->load->model('Karyawan_model');
        $this->load->model('NilaiGap_model');
        $this->load->model('Penilaian_model');
    }
    public function kriteria()
    {
        $data['title'] = 'Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->Kriteria_model->getAllKriteria();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('spk/kriteria/kriteria', $data);
        $this->load->view('templates/footer');
    }

    public function tambahkriteria()
    {
        $data['title'] = 'Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required|trim');
        $this->form_validation->set_rules('nilai_kriteria', 'Nilai Kriteria', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/kriteria/tambahkriteria', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Kriteria_model->tambahDataKriteria();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('spk/kriteria');
        }
    }

    public function editkriteria($id_kriteria)
    {
        $data['title'] = 'Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->Kriteria_model->getKriteriaById($id_kriteria);
        $kriteria = $this->Kriteria_model->getKriteriaById($id_kriteria);

        $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required|trim');
        $this->form_validation->set_rules('nilai_kriteria', 'Nilai Kriteria', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/kriteria/editkriteria', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Kriteria_model->ubahDataKriteria($kriteria, $id_kriteria);

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('spk/kriteria');
        }
    }

    public function hapusKriteria()
    {
        $this->Kriteria_model->hapusDataKriteria();
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert"> Data berhasil dihapus!</div>');
        redirect('spk/kriteria');
    }

    public function subkriteria()
    {
        $data['title'] = 'Sub Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['subkriteria'] = $this->Subkriteria_model->getAllSubkriteria();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('spk/subkriteria/subkriteria', $data);
        $this->load->view('templates/footer');
    }

    public function tambahsubkriteria()
    {
        $data['title'] = 'Sub Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_kriteria', 'Kriteria', 'required');
        $this->form_validation->set_rules('nama_subkriteria', 'Nama Subkriteria', 'required|trim');
        $this->form_validation->set_rules('nilai_subkriteria', 'Nilai Subkriteria', 'required|trim');
        $data['subkriteria'] = $this->db->get('subkriteria')->result_array();
        $data['kriteria'] = $this->Kriteria_model->getAllKriteria();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/subkriteria/tambahsubkriteria', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Subkriteria_model->tambahDataSubkriteria();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('spk/subkriteria');
        }
    }

    public function editsubkriteria($id_subkriteria)
    {
        $data['title'] = 'Sub Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $subkriteria = $this->Subkriteria_model->getSubkriteriaById($id_subkriteria);
        $data['subkriteria'] = $this->Subkriteria_model->getSubkriteriaById($id_subkriteria);
        $data['kriteria'] = $this->Kriteria_model->getAllKriteria();
        $data['faktor'] = ['Core', 'Secondary'];
        $data['nilai_subkriteria'] = [5, 4, 3, 2, 1];
        $data['subkriteriaall'] = $this->db->get('subkriteria')->result_array();
        $this->form_validation->set_rules('nama_subkriteria', 'Nama Sub Kriteria', 'required|trim');
        $this->form_validation->set_rules('nilai_subkriteria', 'Nilai Sub Kriteria', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/subkriteria/editsubkriteria', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Subkriteria_model->ubahDataSubkriteria($subkriteria, $id_subkriteria);
            // $this->Alternatif_model->updateNormalisasiHasil();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('spk/subkriteria');
        }
    }

    public function hapussubkriteria()
    {

        $this->Subkriteria_model->hapusDataSubkriteria();
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert"> Data berhasil dihapus!</div>');
        redirect('spk/subkriteria');
    }

    public function karyawan()
    {
        $data['title'] = 'Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['karyawan'] = $this->Karyawan_model->getAllKaryawan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('spk/karyawan/karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahkaryawan()
    {
        $data['title'] = 'Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/karyawan/tambahkaryawan', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Karyawan_model->tambahDataKaryawan();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('spk/karyawan');
        }
    }

    public function editkaryawan($id_karyawan)
    {
        $data['title'] = 'Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['karyawan'] = $this->Karyawan_model->getKaryawanById($id_karyawan);
        $karyawan = $this->Karyawan_model->getKaryawanById($id_karyawan);

        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/karyawan/editkaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Karyawan_model->ubahDataKaryawan($karyawan, $id_karyawan);

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('spk/karyawan');
        }
    }

    public function hapuskaryawan()
    {
        $this->Karyawan_model->hapusDataKaryawan();
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert"> Data berhasil dihapus!</div>');
        redirect('spk/karyawan');
    }

    public function hapuskaryawannilai()
    {
        $this->Karyawan_model->hapusDataKaryawanNilai();
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert"> Data berhasil dihapus!</div>');
        redirect('spk/penilaian');
    }

    public function nilaigap()
    {
        $data['title'] = 'Nilai GAP';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['nilaigap'] = $this->NilaiGap_model->getAllNilaiGap();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('spk/nilaigap/nilaigap', $data);
        $this->load->view('templates/footer');
    }

    public function penilaian()
    {
        $data['title'] = 'Penilaian';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['penilaian'] = $this->Penilaian_model->getAllPenilaian();
        $data['hitung'] = $this->Penilaian_model->getAllHitung();
        $data['nilaiakhir'] = $this->Penilaian_model->getAllNilaiAkhir();
        $data['nilai'] = [
            ["id_nilai" => 1, "nama_nilai" => "1-Sangat Kurang"],
            ["id_nilai" => 2, "nama_nilai" => "2-Kurang"],
            ["id_nilai" => 3, "nama_nilai" => "3-Cukup"],
            ["id_nilai" => 4, "nama_nilai" => "4-Baik"],
            ["id_nilai" => 5, "nama_nilai" => "5-Sangat Baik"]
        ];
        // echo '<pre>';
        // var_dump($data['nilai']);
        // echo '</pre>';
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('spk/penilaian/penilaian', $data);
        $this->load->view('templates/footer');
    }

    public function tambahpenilaian()
    {
        $data['title'] = 'Penilaian';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id_karyawan', 'Karyawan', 'required');

        $data['penilaian'] = $this->db->get('penilaian')->result_array();
        $data['karyawan'] = $this->Karyawan_model->getAllKaryawanAdded();
        $data['kriteria'] = $this->Kriteria_model->getAllKriteria();
        $data['subkriteria'] = $this->Subkriteria_model->getAllSubkriteria();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('spk/penilaian/tambahpenilaian', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Penilaian_model->tambahDataPenilaian();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('spk/penilaian');
        }
    }

    public function editpenilaian()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->Penilaian_model->editDataPenilaian();
        $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Data berhasil diubah!</div>');
        redirect('spk/penilaian');
    }
}
