<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{
  public function cetak($file_dokumen, $id)
  {
    $this->db->set('printed', 1);
    $this->db->where('id', $id);
    $this->db->update('pengajuan');
    redirect(base_url('assets/upload/' . $file_dokumen));
  }
}
