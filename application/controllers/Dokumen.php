<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function store()
  {
    // Validasi input form
    $this->form_validation->set_rules('nomor_dokumen', 'Nomor Dokumen', 'required|is_unique[dokumen.nomor_dokumen]', ['is_unique' => 'Nomor dokumen harus unik', 'required' => 'Nomor dokumen harus diisi']);
    $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required', ['required' => 'Nama dokumen harus diisi']);
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', ['required' => 'Keterangan harus diisi']);
    // Lanjutkan dengan validasi untuk field lainnya jika diperlukan

    if ($this->form_validation->run() == FALSE) {
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
    } else {
      $file_dokumen = $_FILES['file_dokumen']['name'];

      if ($file_dokumen) {
        // config untuk upload gambar
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 12048; // 12MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_dokumen')) {
          $file_dokumen = $this->upload->data();
          $file_dokumen = $file_dokumen['file_name'];
          // Jika validasi sukses, proses simpan data ke database
          $nomor_dokumen = $this->input->post('nomor_dokumen');
          $nama_dokumen = $this->input->post('nama_dokumen');
          $keterangan = $this->input->post('keterangan');

          // Lanjutkan dengan menyimpan data ke dalam array $data
          $data = [
            'nomor_dokumen' => $nomor_dokumen,
            'nama_dokumen' => $nama_dokumen,
            'keterangan' => $keterangan,
            'file_dokumen' =>  $file_dokumen,
            'tgl_dibuat' => date('Y-m-d')
          ];
          // Simpan data ke database
          $this->db->insert('dokumen', $data);
          // Redirect ke halaman sukses atau halaman lainnya
          $this->session->set_flashdata('success', 'Berhasil menambah dokumen');
          redirect('dashboard');
        } else {
          // $errors = $this->upload->display_errors();
          $this->session->set_flashdata('error', 'Tipe file yang Anda coba unggah harus berupa PDF.');
          redirect('dashboard');
        }
      }
    }
  }
  public function edit($id)
  {
    $data['dokumen'] = $this->db->get_where('dokumen', ['id' => $id])->row();
    $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
    $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
    $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
    $data['content'] = $this->load->view('dokumen/edit', $data, true);
    $this->load->view('layouts/main', $data);
  }
  // $data['tes'] = $this->db->get_where('dokumen', ['id' => $id])->row();
  public function update($id)
  {
    $this->form_validation->set_rules('nomor_dokumen', 'Nomor dokumen', 'required');
    $this->form_validation->set_rules('nama_dokumen', 'Nama dokumen', 'required');

    if ($this->form_validation->run() == false) {
      $data['dokumen'] = $this->db->get_where('dokumen', ['id' => $id])->row();
      $data['jml_pengajuan'] = $this->Pengajuan_model->jumlahPengajuan();
      $data['jml_pengajuan_petugas'] = $this->Pengajuan_model->jumlahPengajuanPetugas();
      $data['jml_pengajuan_camat'] = $this->Pengajuan_model->jumlahPengajuanCamat();
      $data['content'] = $this->load->view('dokumen/edit', $data, true);
      $this->load->view('layouts/main', $data);
    } else {
      // Ambil data dari form
      $nomor_dokumen = $this->input->post('nomor_dokumen');
      $nama_dokumen = $this->input->post('nama_dokumen');
      $keterangan = $this->input->post('keterangan');

      // Cek apakah ada file yang diupload
      if ($_FILES['file_dokumen']['name']) {
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 12048; // max size 12MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_dokumen')) {
          $error = $this->upload->display_errors();
          // Tangani kesalahan upload file, misalnya tampilkan pesan error
          echo $error;
          return;
        } else {
          $file_data = $this->upload->data();
          $file_name = $file_data['file_name'];

          // Update data dokumen dengan file baru
          $data = [
            'nomor_dokumen' => $nomor_dokumen,
            'nama_dokumen' => $nama_dokumen,
            'keterangan' => $keterangan,
            'file_dokumen' => $file_name
          ];
          // Hapus file dokumen lama
          $old_dokumen = $this->db->get_where('dokumen', ['id' => $id])->row();
          $old_file = './assets/upload/' . $old_dokumen->file_dokumen;
          if (file_exists($old_file)) {
            unlink($old_file);
          }
        }
      } else {
        // Update data dokumen tanpa mengubah file
        $data = [
          'nomor_dokumen' => $nomor_dokumen,
          'nama_dokumen' => $nama_dokumen,
          'keterangan' => $keterangan
        ];
      }
      // Lakukan update ke database
      $this->db->where('id', $id);
      $this->db->update('dokumen', $data);

      // Tampilkan pesan berhasil atau redirect ke halaman lain
      $this->session->set_flashdata('success', 'Berhasil mengedit dokumen');
      redirect('dashboard');
    }
  }


  public function delete($id)
  {
    $data['dokumen'] = $this->db->get_where('dokumen', ['id' => $id])->row();
    // var_dump($data['dokumen']);
    // die;
    unlink(FCPATH . 'assets/upload/' . $data['dokumen']->file_dokumen);
    $this->db->delete('dokumen', ['id' => $id]);
    $this->session->set_flashdata('success', 'Berhasil menghapus dokumen');
    redirect('dashboard');
  }
}
