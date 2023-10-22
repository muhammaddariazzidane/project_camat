<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{
  public function getAll($limit, $start)
  {
    if ($this->session->role_id == 3) {
      $this->db->select('pengajuan.id, pengajuan.alasan, surat.nama_surat, surat.keterangan, surat.file_surat, surat.nomor_surat, user.nama, pengajuan.tgl_pengajuan, pengajuan.status, pengajuan.tgl_selesai, pengajuan.keterangan, pengajuan.printed');
      $this->db->from('pengajuan');
      $this->db->join('surat', 'surat.id = pengajuan.surat_id');
      $this->db->join('user', 'user.id = pengajuan.user_id');
      $this->db->where('pengajuan.user_id', $this->session->id);
      $this->db->order_by('pengajuan.id DESC');
      if ($limit) {
        $this->db->limit($limit, $start);
      }
      $query = $this->db->get();
      return $query->result();
    } else {
      $this->db->select('pengajuan.id, pengajuan.alasan, surat.nama_surat, surat.keterangan, surat.file_surat, surat.nomor_surat, user.nama, pengajuan.tgl_pengajuan, pengajuan.status, pengajuan.tgl_selesai, pengajuan.keterangan, pengajuan.printed');
      $this->db->from('pengajuan');
      $this->db->join('surat', 'surat.id = pengajuan.surat_id');
      $this->db->join('user', 'user.id = pengajuan.user_id');
      $this->db->order_by('pengajuan.id DESC');
      if ($limit) {
        $this->db->limit($limit, $start);
      }
      $query = $this->db->get();
      return $query->result();
    }
  }

  public function jumlahPengajuan()
  {
    $this->db->select('surat.nama_surat, surat.keterangan, surat.file_surat, surat.nomor_surat, user.nama, pengajuan.tgl_pengajuan, pengajuan.status, pengajuan.tgl_selesai, pengajuan.keterangan, pengajuan.printed');
    $this->db->from('pengajuan');
    $this->db->join('surat', 'surat.id = pengajuan.surat_id');
    $this->db->join('user', 'user.id = pengajuan.user_id');
    $this->db->where('pengajuan.user_id', $this->session->id);
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function jumlahPengajuanPetugas()
  {
    $this->db->select('surat.nama_surat, surat.keterangan, surat.file_surat, surat.nomor_surat, user.nama, pengajuan.tgl_pengajuan, pengajuan.status, pengajuan.tgl_selesai, pengajuan.keterangan, pengajuan.printed');
    $this->db->from('pengajuan');
    $this->db->join('surat', 'surat.id = pengajuan.surat_id');
    $this->db->join('user', 'user.id = pengajuan.user_id');
    $this->db->where('pengajuan.status', 0);
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function jumlahPengajuanCamat()
  {
    $this->db->select('surat.nama_surat, surat.keterangan, surat.file_surat, surat.nomor_surat, user.nama, pengajuan.tgl_pengajuan, pengajuan.status, pengajuan.tgl_selesai, pengajuan.keterangan, pengajuan.printed');
    $this->db->from('pengajuan');
    $this->db->join('surat', 'surat.id = pengajuan.surat_id');
    $this->db->join('user', 'user.id =pengajuan.user_id');
    $this->db->where('pengajuan.status', 1);

    $query = $this->db->get();
    return $query->num_rows();
  }
  public function getRiwayat($limit, $start)
  {
    $this->db->select('pengajuan.id, surat.nama_surat, surat.keterangan, surat.file_surat, surat.nomor_surat, user.nama, pengajuan.tgl_pengajuan, pengajuan.status, pengajuan.tgl_selesai, pengajuan.keterangan, pengajuan.printed');
    $this->db->from('riwayat_pengajuan');
    $this->db->join('pengajuan', 'riwayat_pengajuan.pengajuan_id = pengajuan.id');
    $this->db->join('surat', 'surat.id = pengajuan.surat_id');
    $this->db->join('user', 'user.id =pengajuan.user_id');
    if ($limit) {
      $this->db->limit($limit, $start);
    }
    $query = $this->db->get();
    return $query->result();
  }
}
