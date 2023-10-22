<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{
  public function getSurat($limit, $start, $keyword = null)
  {
    if ($keyword) {
      $this->db->like('pemilik', $keyword);
      $this->db->or_like('nomor_surat', $keyword);
    }
    return $this->db->get('surat', $limit, $start)->result();
  }
}
