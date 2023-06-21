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
    $data['dokumen'] = $this->db->get('dokumen')->result();
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('dashboard/index', $data, true);
    $this->load->view('layouts/main', $data);
  }
  public function pengajuan()
  {
    $data['pengajuan'] = $this->Pengajuan_model->getAll();
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
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
