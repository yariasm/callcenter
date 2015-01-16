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
        $this->load->model('action_model');
        $this->load->model('result_model');
        $this->load->model('cause_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        
    }

    public function add($id = '') {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $id = ($id != '') ? deencrypt_id($id) : '';
        $data['user'] = ($id != '') ? $this->gestion_model->get_user_id($id) : array();
        $data['title'] = 'Agregar Gestion';
        $data['content'] = 'gestion/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //
        $this->form_validation->set_rules('accion_id', 'Accion', 'required|trim');
        //
        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS

        if ($this->form_validation->run() == FALSE) {

            $data['user'] = $this->gestion_model->get_user_id($this->input->post('persona_id'));
            $data['title'] = 'Agregar Gestion';
            $data['content'] = 'gestion/add';
            $this->load->view('template/template', $data);
        } else {
            $insert = $this->gestion_model->insert($this->input->post());
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
                redirect('index.php/gestion/add/' . encrypt_id($this->input->post('persona_id')), 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el Registro', 'message_type' => 'error'));
                redirect('index.php/gestion/add/' . encrypt_id($this->input->post('persona_id')), 'refresh');
            }
        }
    }

    public function insert_visita() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //
        $this->form_validation->set_rules('observacion', 'Observacion', 'required|trim');
        //
        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS

        if ($this->form_validation->run() == FALSE) {

            $data['user'] = $this->gestion_model->get_user_id($this->input->post('persona_id'));
            $data['title'] = 'Agregar Gestion';
            $data['content'] = 'gestion/add';
            $this->load->view('template/template', $data);
        } else {
            $insert = $this->gestion_model->insert_visita($this->input->post());
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
                redirect('index.php/gestion/add/' . encrypt_id($this->input->post('persona_id')), 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el Registro', 'message_type' => 'error'));
                redirect('index.php/gestion/add/' . encrypt_id($this->input->post('persona_id')), 'refresh');
            }
        }
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
                    echo '';
            } else {
                echo '';
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
                if (count($data['user']) > 0) {
                    $data['gestion_callcenter'] = $this->gestion_model->get_gestion_callcenter($data['user'][0]->cuenta_id);
                    $data['gestion_visita'] = $this->gestion_model->get_gestion_visita($data['user'][0]->cuenta_id);
                    echo $this->load->view('gestion/info_gestion', $data, true);
                } else {
                    echo '';
                }
            } else {
                echo '';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function new_gestion() {
        validate_login($this->session->userdata('logged_in'));
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            if ($post['search_type'] != '' && $post['search_value'] != '') {
                $data['user'] = $this->gestion_model->get_user($post['search_type'], $post['search_value']);
                if (count($data['user']) > 0) {
                    $data['action'] = get_dropdown_select($this->action_model->get_all(), 'accion_id', 'nombre','');
                    //$data['result'] = get_dropdown($this->result_model->get_all(), 'resultado_id', 'nombre');
                    //$data['cause'] = get_dropdown($this->cause_model->get_all(), 'causal_id', 'nombre');
                    echo $this->load->view('gestion/new_gestion', $data, true);
                } else {
                    echo '';
                }
            } else {
                echo '';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
