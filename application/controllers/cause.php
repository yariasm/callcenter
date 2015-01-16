<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cause extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'CAU';


        $this->load->helper('miscellaneous');
        $this->load->model('cause_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['registros'] = $this->cause_model->get_all();
        $data['title'] = 'Administrar Causales';
        $data['content'] = 'cause/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Nueva Causal';
        $data['content'] = 'cause/add';
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
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)

        $this->form_validation->set_rules('codigo', 'Codigo', 'required|trim');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Nueva Accion';
            $data['content'] = 'cause/add';
            $this->load->view('template/template', $data);
        } else {
            $data = array(
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre' => $this->input->post('nombre', TRUE)
            );

            $insert = $this->cause_model->insert($data);
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
                redirect('index.php/cause', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el Registro', 'message_type' => 'error'));
                redirect('index.php/cause', 'refresh');
            }
        }
    }

    public function edit($id) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id = deencrypt_id($id);
        $data['registro'] = $this->cause_model->get_id($id);
        if (count($data['registro']) > 0) {
            $data['states'] = get_array_states();

            $data['title'] = 'Modificar Causal';
            $data['content'] = 'cause/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('index.php/cause', 'refresh');
        }
    }

    public function update($id) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id = deencrypt_id($id);

        //validation_permission_role($this->module_sigla, 'permission_edit');
        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)        

        $this->form_validation->set_rules('codigo', 'Codigo', 'required|trim');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['registro'] = $this->cause_model->get_id($id);
            if (count($data['registro']) > 0) {
                $data['states'] = get_array_states();

                $data['title'] = 'Modificar Accion';
                $data['content'] = 'cause/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('index.php/cause', 'refresh');
            }
        } else {

            $data = array(
                'causal_id' => $id,
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre' => $this->input->post('nombre', TRUE),
                'estado' => $this->input->post('estado', TRUE)
            );
            $update = $this->cause_model->update($data);

            if ($update) {
                $this->session->set_flashdata(array('message' => 'Registro modificado con exito', 'message_type' => 'info'));
                redirect('index.php/cause', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al modificar el Registro', 'message_type' => 'warning'));
                redirect('index.php/cause', 'refresh');
            }
        }
    }
    
    
    /*     * ***************************AJAX FUNCTIONS************************** */    
    
    public function get_select_cause() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $resultado_id = $this->input->post('resultado_id');
            $cause = get_dropdown_select($this->cause_model->get_select_cause($resultado_id), 'causal_id', 'nombre', '');
            echo form_dropdown('causal_id', $cause, '', 'id="causal_id" class="form-control"');
        } else {
            echo 'Acceso no utorizado';
        }
    }    


}
