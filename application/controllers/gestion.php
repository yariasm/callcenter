<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gestion extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'GES';
        $this->load->helper('miscellaneous');
        $this->load->model('gestion_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');
        $data['title'] = 'Agregar Gestion';
        $data['content'] = 'gestion/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');
    }

    /*     * ***************************AJAX FUNCTIONS************************** */

    public function search_user() {
        validate_login($this->session->userdata('logged_in'));
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            if ($post['search_type'] != '' && $post['search_value'] != '') {
                $data['user'] = $this->gestion_model->get_user($post['search_type'], $post['search_value']);
                if (count($data['user']) > 0)
                    echo $this->load->view('gestion/info_user', $data, true);
                else
                    echo '<div class="alert alert-warning"><strong>Error!</strong> Registro no encontrado.</div>';
            } else {
                echo '<div class="alert alert-warning"><strong>Error!</strong> Registro no encontrado.</div>';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function search_account() {
        validate_login($this->session->userdata('logged_in'));
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            if ($post['search_type'] != '' && $post['search_value'] != '') {
                $data['user'] = $this->gestion_model->get_user($post['search_type'], $post['search_value']);
                if (count($data['user']) > 0)
                    echo $this->load->view('gestion/info_account', $data, true);
                else
                    echo '<div class="alert alert-warning"><strong>Error!</strong> Registro no encontrado.</div>';
            } else {
                echo '<div class="alert alert-warning"><strong>Error!</strong> Registro no encontrado.</div>';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }
    
    public function search_gestion() {
        validate_login($this->session->userdata('logged_in'));
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            if ($post['search_type'] != '' && $post['search_value'] != '') {
                $data['user'] = $this->gestion_model->get_user($post['search_type'], $post['search_value']);
                if (count($data['user']) > 0)
                    echo $this->load->view('gestion/info_gestion', $data, true);
                else
                    echo '<div class="alert alert-warning"><strong>Error!</strong> Registro no encontrado.</div>';
            } else {
                echo '<div class="alert alert-warning"><strong>Error!</strong> Registro no encontrado.</div>';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }    

}
