<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function update($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row();
        if (!$data['user']) {
            show_404();
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama harus di isi']);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', ['required' => 'Email harus di isi', 'valid_email' => 'Email harus valid']);

        if (!empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'required');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Periksa kembali inputan');
            $this->session->set_flashdata('error_nama', form_error('nama'));
            $this->session->set_flashdata('error_email', form_error('email'));
            redirect('dashboard');
        } else {
            $updated_data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
            ];

            if (!empty($this->input->post('password'))) {
                $hashed_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $updated_data['password'] = $hashed_password;
            }

            $this->db->where('id', $id);
            $this->db->update('user', $updated_data);

            $this->session->set_flashdata('success', 'Berhasil mengubah Pengelola');
            redirect('dashboard');
        }
    }
    public function delete($id)
    {
        $this->db->delete('user', ['id' => $id]);
        $this->session->set_flashdata('success', 'Berhasil menghapus Pengelola');
        redirect('dashboard');
    }
}
