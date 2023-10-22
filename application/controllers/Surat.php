<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['jml_surat'] = $this->db->get('surat')->num_rows();
    $data['jml_users'] = $this->db->get('user')->num_rows();
    $data['jml_pengajuan_sukses'] = $this->db->get_where('pengajuan', ['status' => 2])->num_rows();
    $data['jml_pengajuan_gagal'] = $this->db->get_where('pengajuan', ['status' => 3])->num_rows();


    // $config['total_rows'] = $data['jml_surat'];
    $data['keyword'] = $this->input->get('keyword');
    if ($data['keyword']) {
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->set_userdata('keyword');
    }

    $this->db->like('pemilik', $data['keyword']);
    $this->db->or_like('nomor_surat', $data['keyword']);
    $this->db->from('surat');

    $config['total_rows'] = $this->db->count_all_results();
    $config['per_page'] = 100;


    $this->pagination->initialize($config);
    // mulai pagination
    $data['start'] = $this->uri->segment(3);
    $data['surat'] = $this->Surat_model->getSurat($config['per_page'], $data['start'], $data['keyword']);
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('surat/index', $data, true);
    $this->load->view('layouts/main', $data);
  }
  public function store()
  {
    if ($this->session->role_id == 3) {
      redirect('surat');
    }
    // Validasi input form
    $this->form_validation->set_rules('nomor_surat', 'Nomor Surat Tanah', 'required|is_unique[surat.nomor_surat]', ['is_unique' => 'Nomor Surat Tanah harus unik', 'required' => 'Nomor Surat Tanah harus diisi']);
    $this->form_validation->set_rules('nama_surat', 'Nama Surat Tanah', 'required', ['required' => 'Nama Surat Tanah harus diisi']);
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', ['required' => 'Keterangan harus diisi']);
    $this->form_validation->set_rules('pemilik', 'Nama pemilik', 'required', ['required' => 'Nama pemilik harus diisi']);

    if ($this->form_validation->run() == FALSE) {
      $data['jml_surat'] = $this->db->get('surat')->num_rows();
      $data['jml_users'] = $this->db->get('user')->num_rows();
      $data['jml_pengajuan_sukses'] = $this->db->get_where('pengajuan', ['status' => 2])->num_rows();
      $data['jml_pengajuan_gagal'] = $this->db->get_where('pengajuan', ['status' => 3])->num_rows();


      $config['total_rows'] = $data['jml_surat'];
      $config['per_page'] = 10;


      $this->pagination->initialize($config);
      // mulai pagination
      $data['start'] = $this->uri->segment(3);
      $data['surat'] = $this->Surat_model->getSurat($config['per_page'], $data['start']);
      $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
      $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
      $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
      $data['content'] = $this->load->view('surat/index', $data, true);
      $this->load->view('layouts/main', $data);
    } else {
      $file_surat = $_FILES['file_surat']['name'];

      if ($file_surat) {
        // config untuk upload gambar
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 12048; // 12MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_surat')) {
          $file_surat = $this->upload->data();
          $file_surat = $file_surat['file_name'];
          // Jika validasi sukses, proses simpan data ke database
          $nomor_surat = $this->input->post('nomor_surat');
          $nama_surat = $this->input->post('nama_surat');
          $keterangan = $this->input->post('keterangan');
          $pemilik = $this->input->post('pemilik');

          // Lanjutkan dengan menyimpan data ke dalam array $data
          $data = [
            'nomor_surat' => $nomor_surat,
            'nama_surat' => $nama_surat,
            'keterangan' => $keterangan,
            'pemilik' =>  $pemilik,
            'file_surat' =>  $file_surat,
            'tgl_dibuat' => date('Y-m-d')
          ];
          // Simpan data ke database
          $this->db->insert('surat', $data);
          // Redirect ke halaman sukses atau halaman lainnya
          $this->session->set_flashdata('success', 'Berhasil menambah Surat Tanah');
          redirect('surat');
        } else {
          // $errors = $this->upload->display_errors();
          $this->session->set_flashdata('error', 'Tipe file yang Anda coba unggah harus berupa PDF.');
          redirect('surat');
        }
      } else {
        $this->session->set_flashdata('error_doc', 'file harus terisi');
        redirect('surat');
      }
    }
  }
  public function edit($id)
  {
    if ($this->session->role_id == 3) {
      redirect('surat');
    }
    $data['surat'] = $this->db->get_where('surat', ['id' => $id])->row();
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('surat/edit', $data, true);
    $this->load->view('layouts/main', $data);
  }
  public function update($id)
  {
    if ($this->session->role_id == 3) {
      redirect('surat');
    }
    $this->form_validation->set_rules('nomor_surat', 'Nomor surat Tanah', 'required', ['required' => 'Nomor Surat Tanah harus diisi']);
    $this->form_validation->set_rules('nama_surat', 'Nama surat', 'required', ['required' => 'Nama Surat Tanah harus diisi']);

    if ($this->form_validation->run() == false) {
      $data['surat'] = $this->db->get_where('surat', ['id' => $id])->row();
      $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
      $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
      $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
      $data['content'] = $this->load->view('surat/edit', $data, true);
      $this->load->view('layouts/main', $data);
    } else {
      // Ambil data dari form
      $nomor_surat = $this->input->post('nomor_surat');
      $nama_surat = $this->input->post('nama_surat');
      $keterangan = $this->input->post('keterangan');
      $pemilik = $this->input->post('pemilik');

      // Cek apakah ada file yang diupload
      if ($_FILES['file_surat']['name']) {
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 12048; // max size 12MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_surat')) {
          $error = $this->upload->display_errors();
          // Tangani kesalahan upload file, misalnya tampilkan pesan error
          echo $error;
          return;
        } else {
          $file_data = $this->upload->data();
          $file_name = $file_data['file_name'];

          // Update data surat dengan file baru
          $data = [
            'nomor_surat' => $nomor_surat,
            'nama_surat' => $nama_surat,
            'keterangan' => $keterangan,
            'pemilik' => $pemilik,
            'file_surat' => $file_name
          ];
          // Hapus file surat lama
          $old_surat = $this->db->get_where('surat', ['id' => $id])->row();
          $old_file = './assets/upload/' . $old_surat->file_surat;
          if (file_exists($old_file)) {
            unlink($old_file);
          }
        }
      } else {
        // Update data surat tanpa mengubah file
        $data = [
          'nomor_surat' => $nomor_surat,
          'nama_surat' => $nama_surat,
          'pemilik' => $pemilik,
          'keterangan' => $keterangan
        ];
      }
      // Lakukan update ke database
      $this->db->where('id', $id);
      $this->db->update('surat', $data);

      // Tampilkan pesan berhasil atau redirect ke halaman lain
      $this->session->set_flashdata('success', 'Berhasil mengubah Surat Tanah');
      redirect('surat');
    }
  }


  public function delete($id)
  {
    if ($this->session->role_id == 3) {
      redirect('surat');
    }
    $data['surat'] = $this->db->get_where('surat', ['id' => $id])->row();
    $data['pengajuan'] =  $this->db->get_where('pengajuan', ['surat_id' => $id])->result();

    unlink(FCPATH . 'assets/upload/' . $data['surat']->file_surat);
    $this->db->delete('pengajuan', ['surat_id' => $id]);
    $this->db->delete('surat', ['id' => $id]);
    $this->session->set_flashdata('success', 'Berhasil menghapus Surat Tanah');
    redirect('surat');
  }
}
