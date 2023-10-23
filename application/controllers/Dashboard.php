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
    if ($this->session->role_id == 3) {
      redirect('surat');
    }

    $data['jml_surat'] = $this->db->get('surat')->num_rows();
    $data['jml_users'] = $this->db->get_where('user', ['role_id' => 3])->num_rows();
    $data['jml_pengajuan_sukses'] = $this->db->get_where('pengajuan', ['status' => 2])->num_rows();
    $data['jml_pengajuan_gagal'] = $this->db->get_where('pengajuan', ['status' => 3])->num_rows();


    $config['total_rows'] = $data['jml_surat'];
    $config['per_page'] = 100;


    $this->pagination->initialize($config);
    // mulai pagination
    $data['start'] = $this->uri->segment(3);
    $data['surat'] = $this->Surat_model->getSurat($config['per_page'], $data['start']);
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['pengelola'] = $this->db->get_where('user', ['role_id' => 3])->result();
    $data['content'] = $this->load->view('dashboard/index', $data, true);
    $this->load->view('layouts/main', $data);
  }
  public function pengajuan()
  {
    $data['hitung'] = $this->db->get_where('pengajuan', ['status' => 0])->num_rows();
    $config['base_url'] = base_url('dashboard/pengajuan/');

    $config['total_rows'] = $data['hitung'];
    $config['per_page'] = 100;

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
    if ($this->session->role_id == 3) {
      redirect('surat');
    }

    $data['jml_riwayat'] = $this->db->get('riwayat_pengajuan')->num_rows();
    $config['base_url'] = base_url('dashboard/riwayat/');

    $config['total_rows'] = $data['jml_riwayat'];
    $config['per_page'] = 100;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['riwayat'] = $this->Pengajuan_model->getRiwayat($config['per_page'], $data['start']);
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('pengajuan/riwayat', $data, true);
    $this->load->view('layouts/main', $data);
  }
}
