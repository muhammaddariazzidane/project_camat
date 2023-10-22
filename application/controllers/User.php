<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function edit($id)
    {
    }
    public function update($id)
    {
    }
    public function delete($id)
    {
        $this->db->delete('user', ['id' => $id]);
        $this->session->set_flashdata('success', 'Berhasil menghapus Pengelola');
        redirect('dashboard');
    }
}
