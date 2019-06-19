<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Depan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Hotel Melati';
        $this->load->view('templates/header_depan', $data);
        $this->load->view('templates/menu_depan', $data);
        $this->load->view('depan/index', $data);
        $this->load->view('templates/depan_footer');
    }

    public function service()
    {
        $data['title'] = 'Service';
        $this->load->view('templates/header_depan', $data);
        $this->load->view('templates/menu_depan', $data);
        $this->load->view('depan/service', $data);
        $this->load->view('templates/depan_footer');
    }

    public function booking()
    {
        $data['title'] = 'Booking';
        $this->load->view('templates/header_depan', $data);
        $this->load->view('templates/menu_depan', $data);
        $this->load->view('depan/booking', $data);
        $this->load->view('templates/depan_footer');
    }

    public function rooms()
    {
        $data['title'] = 'Rooms';
        $this->load->view('templates/header_depan', $data);
        $this->load->view('templates/menu_depan', $data);
        $this->load->view('depan/rooms', $data);
        $this->load->view('templates/depan_footer');
    }

    public function locations()
    {
        $data['title'] = 'Locations';
        $this->load->view('templates/header_depan', $data);
        $this->load->view('templates/menu_depan', $data);
        $this->load->view('depan/locations', $data);
        $this->load->view('templates/depan_footer');
    }
}
