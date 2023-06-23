<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen_model extends CI_Model
{
  public function getDokumen($limit, $start)
  {
    return $this->db->get('dokumen', $limit, $start)->result();
  }
}
