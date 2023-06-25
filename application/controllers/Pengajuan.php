<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function store($nomor_dokumen, $id)
  {
    $data['dokumen'] = $this->db->get_where('dokumen', ['nomor_dokumen' => $nomor_dokumen])->row();
    $data['user'] = $this->db->get_where('user', ['id' => $id])->row();
    $cek = $this->db->get_where('pengajuan', ['dokumen_id' => $data['dokumen']->id, 'user_id' => $id])->row();
    if ($cek) {
      if ($cek->status == 0) {
        $this->session->set_flashdata('info', 'Pengajuan sudah ada, silahkan tunggu');
        redirect('dashboard');
      }
      if ($cek->status == 1) {
        $this->session->set_flashdata('info', 'Pengajuan sudah ada, silahkan tunggu disetujui camat');
        redirect('dashboard');
      }
      if ($cek->status == 3) {
        $data = [
          'dokumen_id' => $data['dokumen']->id,
          'user_id' => $data['user']->id,
          'tgl_pengajuan' => date('Y-m-d'),
          'status' => 0,
        ];
        $this->db->insert('pengajuan', $data);
        $this->session->set_flashdata('success', 'Berhasil mengajukan, tunggu disetujui petugas');
        redirect('dashboard');
      }
      if ($cek->status == 2) {
        $data = [
          'dokumen_id' => $data['dokumen']->id,
          'user_id' => $data['user']->id,
          'tgl_pengajuan' => date('Y-m-d'),
          'status' => 0,
        ];
        $this->db->insert('pengajuan', $data);
        $this->session->set_flashdata('success', 'Berhasil mengajukan, tunggu disetujui petugas');
        redirect('dashboard');
      }
    } else {
      $data = [
        'dokumen_id' => $data['dokumen']->id,
        'user_id' => $data['user']->id,
        'tgl_pengajuan' => date('Y-m-d'),
        'status' => 0,
      ];
      $this->db->insert('pengajuan', $data);
      $this->session->set_flashdata('success', 'Berhasil mengajukan, tunggu disetujui petugas');
      redirect('dashboard');
    }
  }
  public function ubah_status($id)
  {
    if ($this->session->role_id == 2) {
      $this->db->set('status', 1);
      $this->db->where('id', $id);
      $this->db->update('pengajuan');
      $this->session->set_flashdata('success', 'Berhasil menyetujui pengajuan');
    }
    if ($this->session->role_id == 1) {
      $this->db->set('status', 2);
      $this->db->set('tgl_selesai', date('Y-m-d'));
      $this->db->where('id', $id);
      $this->db->update('pengajuan');
      $this->db->insert('riwayat_pengajuan', ['pengajuan_id' => $id]);
      $this->session->set_flashdata('success', 'Berhasil menyetujui pengajuan dan pengajuan selesai');
    }
    redirect('pengajuan');
  }
  public function tolak($id)
  {
    $keterangan = $this->input->post('keterangan');
    if ($keterangan) {
      $this->db->set('status', 3);
      $this->db->set('keterangan', $keterangan);
      $this->db->set('tgl_selesai', date('Y-m-d'));
      $this->db->where('id', $id);
      $this->db->update('pengajuan');
      $this->db->insert('riwayat_pengajuan', ['pengajuan_id' => $id]);
    } else {
      $this->db->set('status', 3);
      $this->db->set('tgl_selesai', date('Y-m-d'));
      $this->db->where('id', $id);
      $this->db->update('pengajuan');
      $this->db->insert('riwayat_pengajuan', ['pengajuan_id' => $id]);
    }
    $this->session->set_flashdata('success', 'Berhasil menolak pengajuan');
    redirect('pengajuan');
  }
}
