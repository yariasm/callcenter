<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'REP';
        $this->load->helper('miscellaneous');
        $this->load->model('report_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Generar Reporte';
        $data['content'] = 'report/index';
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

        $this->form_validation->set_rules('from', 'Fecha de Inicio', 'required|trim|date');
        $this->form_validation->set_rules('to', 'Fecha Final', 'required|trim|date');
        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Generar Reporte';
            $data['content'] = 'report/index';
            $this->load->view('template/template', $data);
        } else {
            $gestion = $this->report_model->get_report1($this->input->post('from'), $this->input->post('to'));
            if (count($gestion) > 0) {
                echo print_y($gestion);
            } else {
                $this->session->set_flashdata(array('message' => 'No se encontraron Registros.', 'message_type' => 'error'));
                redirect('index.php/report', 'refresh');
            }
        }
    }

}
