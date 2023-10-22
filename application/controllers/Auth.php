<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function index()
  {
    if ($this->session->nama) {
      redirect('dashboard');
    }
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[25]', ['required' => 'Email harus diisi', 'valid_email' => 'Email tidak valid', 'max_length' => 'Email Terlalu Panjang']);
    $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password harus diisi']);

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Login';
      $data['content'] = $this->load->view('auth/login', '', true);
      $this->load->view('layouts/auth', $data);
    } else {
      $this->authenticate();
    }
  }
  private function authenticate()
  {
    if ($this->session->nama) {
      redirect('/');
    }
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->db->get_where('user', ['email' => $email])->row();
    if ($user) {
      if (password_verify($password, $user->password)) {
        // echo 'berhasil';
        $data = [
          'id' => $user->id,
          'nama' => $user->nama,
          'role_id' => $user->role_id,
          'email' => $user->email,
        ];
        if ($user->role_id == 3) {
          $this->session->set_userdata($data);
          redirect('surat');
        }
        $this->session->set_userdata($data);
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('error', 'Email atau Password salah');
        redirect('login');
      }
    } else {
      $this->session->set_flashdata('error', 'login invalid');
      redirect('login');
    }
  }
  public function register()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[20]', ['max_length' => 'Nama maksimal 20 karakter']);
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|max_length[25]', ['is_unique' => 'Email harus unik', 'max_length' => 'Email maksimal 25 karakter']);
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]', ['min_length' => 'Password minimal 5 karakter']);

    if ($this->form_validation->run() == false) {
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
      $data['content'] = $this->load->view('dashboard/index', $data, true);
      $this->load->view('layouts/main', $data);
    } else {
      $this->Auth_model->store();
      $this->session->set_flashdata('success', 'Berhasil menambahkan pengelola baru!');
      redirect('dashboard');
    }
  }
  public function register_admin()
  {
    if ($this->session->username) {
      redirect('/');
    }
    $this->form_validation->set_rules('username', 'Username', 'required|max_length[20]');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|max_length[25]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Register Admin';
      $data['content'] = $this->load->view('auth/register_admin', '', true);
      // ini adalah layout nya
      $this->load->view('layouts/auth', $data);
    } else {
      $this->Auth_model->store_admin();
      $this->session->set_flashdata('success', 'Berhasil registrasi, silahkan login!');
      redirect('login');
    }
  }

  public function logout()
  {
    if (!$this->session->nama) {
      redirect('/');
    }
    $data = [
      'id',
      'nama',
      'role_id',
      'email',
    ];
    $this->session->unset_userdata($data);
    redirect('login');
  }
}
