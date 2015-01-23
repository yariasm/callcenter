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
            $gestiones = $this->report_model->get_report1($this->input->post('from'), $this->input->post('to'));
            if (count($gestiones) > 0) {
                $name = "c_200_06AM0006_" . date("Y") . date("m") . date("d");
                header("Content-type:text/plain");
                header("Content-type: text/plain; charset=UTF-8");
                header('Content-Disposition: attachment; filename="' . $name . '.txt"');
                //echo print_y($gestiones);
                foreach ($gestiones as $gestion) {
                    echo "200";
                    echo "6";
                    //echo str_pad($gestion->cuenta, 10, "-=", STR_PAD_LEFT);
                    echo str_pad($gestion->cuenta, 25);
                    echo str_pad(date("m") . date("d") . date("Y") . ' ' . date("H:m:i"), 18);
                    echo substr($gestion->accioncodigo, 0, 2);
                    echo substr($gestion->resultadocodigo, 0, 2);
                    echo substr($gestion->observacion, 0, 56);
                    echo "\r\n";
                }
            } else {
                $this->session->set_flashdata(array('message' => 'No se encontraron Registros.', 'message_type' => 'danger'));
                redirect('index.php/report', 'refresh');
            }
        }
    }

    public function excel() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Generar Reporte Excel';
        $data['content'] = 'report/excel';
        $this->load->view('template/template', $data);
    }

    public function get_excel() {
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
            $data['title'] = 'Generar Reporte Excel';
            $data['content'] = 'report/excel';
            $this->load->view('template/template', $data);
        } else {
            $gestiones = $this->report_model->get_report1($this->input->post('from'), $this->input->post('to'));
            if (count($gestiones) > 0) {
                $name = "c_200_06AM0006_" . date("Y") . date("m") . date("d");
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-type:   application/x-msexcel; charset=utf-8");
                header("Content-Disposition: attachment; filename=abc.xls");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false);
                $report2 = '<table>';
                foreach ($gestiones as $gestion) {
                    $report2.= '<tr>';
                    $report2.= "<td>1</td>";
                    $report2.= "<td>2</td>";
                    $report2.= "<td>3</td>";
                    $report2.= "<td>4</td>";
                    $report2.= "<td>5</td>";
                    $report2.= '</tr>';
                }
                $report2.= '</table>';
                echo $report2;
            } else {
                $this->session->set_flashdata(array('message' => 'No se encontraron Registros.', 'message_type' => 'danger'));
                redirect('index.php/report', 'refresh');
            }
        }
    }

}
