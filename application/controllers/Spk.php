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

  }