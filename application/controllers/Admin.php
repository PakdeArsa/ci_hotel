<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jumuser'] = $this->user->countUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        // Ambil data user sesuai session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // set hak akses 
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        // Ambil data menu selain admin
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        // cek menu sesuai hak akses
        $result = $this->db->get_where('user_access_menu', $data);

        // jika ada maka hapus, jika blm maka tambahkan
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    // ========================== Data User ================================

    public function dataUser()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stat'] = $this->user->getAllUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('data/datauser', $data);
        $this->load->view('templates/footer');
    }

    public function addUser()
    {

        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]', [
            'required'      => 'Nama tidak boleh kosong!',
            'min_length'    => 'Minimal 5 karakter!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email', [
            'required'      => 'Alamat email tidak boleh kosong!',
            'valid_email'   => 'Alamat email tidak valid',
            'min_length'    => 'Minimal 5 karakter!'

        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/datauser');
            $this->load->view('templates/footer');
        } else {

            $data = [
                'name'           => $this->input->post('name'),
                'email'          => $this->input->post('email'),
                'image'          => 'default.jpg',
                'password'       => '$2y$10$VXR1fxw88Md2llegYPzAV.OG1qblv2JfDLDJqWR/AwNENT6iOsAIe',
                'role_id'        => 2,
                'is_active'      => 1,
                'date_created'   => time("now")

            ];

            // insert data melalui model User_model

            $this->user->addUser($data);

            // set alert insert berhasil
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil ditambahkan.
          </div>');

            redirect('admin/datauser');
        }

        //var_dump($data);

    }

    public function editUser()
    {
        $id = $this->uri->segment(3);
        //var_dump($id);
        if ($id) {
            $kirim['title'] = 'Edit Data User';
            $kirim['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $kirim['stat'] = $this->user->getAllUser();
            $data = $this->user->getUserByID($id);
            //var_dump($data);
            foreach ($data->result() as $row) {
                //var_dump($row);   
                $kar['id']       = $row->id;
                $kar['name']     = $row->name;
                $kar['email']    = $row->email;
            }
            $this->load->view('templates/header', $kirim);
            $this->load->view('templates/sidebar');
            $this->load->view('data/editdatauser', $kar);
            $this->load->view('templates/footer');
        } else {
            redirect('admin/datauser');
        }
    }

    public function updateUser()
    {
        $kirim['title'] = 'Update Data User';
        $kirim['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('data/datauser');
            $this->load->view('templates/footer');
        } else {

            $data = [
                'name'           => $this->input->post('name'),
                'email'         => $this->input->post('email'),

            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil diupdate.
          </div>');
            redirect('admin/datauser');
        }
    }

    public function deleteUser($id)
    {
        $id = $this->uri->segment(3);
        //var_dump($id);
        if ($id) {

            $data = $this->user->delUser($id);


            redirect('admin/datauser');
        } else {
            redirect('admin/datauser');
        }
    }

    // ============================== End of Data User ==========================

    // ============================== Data Dosen ================================

    public function dataDosen()
    {
        $data['title'] = 'Data Dosen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stat'] = $this->dosen->getAllDosen();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('data/dataDosen', $data);
        $this->load->view('templates/footer');
    }

    public function addDosen()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]', [
            'required'      => 'Nama tidak boleh kosong!',
            'min_length'    => 'Minimal 5 karakter!'
        ]);
        $this->form_validation->set_rules('matkul', 'Mata kuliah', 'trim|required|min_length[5]', [
            'required'      => 'Alamat email tidak boleh kosong!',
            'min_length'    => 'Minimal 5 karakter!'

        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/datadosen');
            $this->load->view('templates/footer');
        } else {

            $data = [
                'name'           => $this->input->post('name'),
                'matkul'          => $this->input->post('matkul'),
                'date_created'   => time("now")

            ];

            // insert data melalui model User_model

            $this->dosen->addDosen($data);

            // set alert insert berhasil
            $this->session->set_flashdata('dosen', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil ditambahkan.
          </div>');

            redirect('admin/datadosen');
        }

        //var_dump($data);

    }

    public function editDosen()
    {
        $id = $this->uri->segment(3);
        //var_dump($id);
        if ($id) {
            $kirim['title'] = 'Edit Data Dosen';
            $kirim['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            //$kirim['stat'] = $this->user->getAllUser();
            $data = $this->dosen->getDosenByID($id);
            //var_dump($data);
            foreach ($data->result() as $row) {
                //var_dump($row);   
                $kar['id']       = $row->id;
                $kar['nama']     = $row->nama_dosen;
                $kar['matkul']    = $row->matkul;
            }
            $this->load->view('templates/header', $kirim);
            $this->load->view('templates/sidebar');
            $this->load->view('data/editdatadosen', $kar);
            $this->load->view('templates/footer');
        } else {
            redirect('admin/datadosen');
        }
    }

    public function updateDosen()
    {
        $kirim['title'] = 'Update Data Dosen';
        $kirim['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'trim|required|min_length[5]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('data/datadosen');
            $this->load->view('templates/footer');
        } else {

            $data = [
                'nama'           => $this->input->post('nama'),
                'matkul'         => $this->input->post('matkul'),

            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tbl_dosen', $data);
            $this->session->set_flashdata('dosen', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil diupdate.
          </div>');
            redirect('admin/datadosen');
        }
    }

    public function deleteDosen($id)
    {
        $id = $this->uri->segment(3);
        //var_dump($id);
        if ($id) {

            $data = $this->user->delDosen($id);


            redirect('admin/datadosen');
        } else {
            redirect('admin/datadosen');
        }
    }

    // ======================== End of Data Dosen ===================================

    // ======================== Data Ka Laboratorium ================================


    // ======================== End of Data Ka Lab ==================================


}
