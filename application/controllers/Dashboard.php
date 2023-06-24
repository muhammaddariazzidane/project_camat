<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['jml_dokumen'] = $this->db->get('dokumen')->num_rows();
    $data['jml_users'] = $this->db->get('user')->num_rows();
    $data['jml_pengajuan_sukses'] = $this->db->get_where('pengajuan', ['status' => 2])->num_rows();
    $data['jml_pengajuan_gagal'] = $this->db->get_where('pengajuan', ['status' => 3])->num_rows();


    $config['total_rows'] = $data['jml_dokumen'];
    $config['per_page'] = 10;


    $this->pagination->initialize($config);
    // mulai pagination
    $data['start'] = $this->uri->segment(3);
    $data['dokumen'] = $this->Dokumen_model->getDokumen($config['per_page'], $data['start']);
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('dashboard/index', $data, true);
    $this->load->view('layouts/main', $data);
  }
  public function pengajuan()
  {
    // hitung
    $data['hitung'] = $this->Pengajuan_model->hitung();
    $config['base_url'] = base_url('pengajuan/');

    $config['total_rows'] = $data['hitung'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['pengajuan'] = $this->Pengajuan_model->getAll($config['per_page'], $data['start']);
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();

    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['content'] = $this->load->view('pengajuan/index', $data, true);
    $this->load->view('layouts/main', $data);
  }
  public function riwayat()
  {
    $data['riwayat'] = $this->Pengajuan_model->getRiwayat();
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('pengajuan/riwayat', $data, true);
    $this->load->view('layouts/main', $data);
  }
}