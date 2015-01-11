<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portafolio extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'GCA';
        $this->load->helper('miscellaneous');
        $this->load->model('portafolio_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Cargar Gestion de Cartera';
        $data['content'] = 'portafolio/add';
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

        $this->form_validation->set_rules('fecha_caida', 'Fecha Caida', 'required|trim|date');
        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Cargar Gestion de Cartera';
            $data['content'] = 'portafolio/add';
            $this->load->view('template/template', $data);
        } else {
            $FECHA = date("Y_m_d_H_i_s");
            $config['upload_path'] = 'archivos/caidas/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['encrypt_name'] = FALSE;
            //$config['max_size'] = '2000';//KB
            $FINE_NAME = 'Archivo_Caidas' . '_' . $FECHA;
            $config['file_name'] = $FINE_NAME;
            $this->load->library('upload', $config);
            $field_name = "userfile";
            //VALIDAMOS EL ARCHIVO
            if (!$this->upload->do_upload($field_name)) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(array('message' => strip_tags($error), 'message_type' => 'danger'));
                redirect('index.php/portafolio/add', 'refresh');
            } else {
                $output = '';
                $upload_data = $this->upload->data();
                $archivoexcel = 'archivos/caidas/' . $upload_data['file_name'];
                $this->load->library('my_phpexcel');
                $objPHPExcel = PHPExcel_IOFactory::load($archivoexcel);
                $data_file = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $total_registros = count($data_file) - 1;
                $output.='*****Registros Encontrados en el Archivo: ' . $total_registros . '*****<br>';
                //echo '<pre>' . $total_registros . print_r($data_file, true) . '</pre>';
                //VALIDAR SI EL ARCHIVO CONTIENE LAS COLUMNAS NECESARIAS (87 - CI), ADEMAS SE VALIDA LA PRIMERA Y ULTIMA FILA.
                $var_filas = 87;
                if (count($data_file[1]) != $var_filas || $data_file[1]['A'] != 'CUENTA' || $data_file[1]['CI'] != 'tienda') {
                    $this->session->set_flashdata(array('message' => "Error al leer el archivo, no contiene las $var_filas filas necesarias", 'message_type' => 'danger'));
                    redirect('index.php/portafolio/add', 'refresh');
                }

                //RECORREMOS TODOS LOS REGISTROS
                for ($a = 2; $a <= count($data_file); $a++) {
                    $output.='<br>***Procesando Registro No.: ' . ($a - 1) . '***<br>';
                    //VALIDAR SI EL USUARIO ESTA CREADO EN EL SISTEMA (TABLA PERSONA)
                    $get_persona_id = $this->portafolio_model->get_persona_id($data_file[$a]['AX']);
                    if (count($get_persona_id) == 0) {
                        //CREACION DEL USUARIO (TABLA PERSONA)
                        $persona_id = $this->portafolio_model->insert_persona($data_file, $a);
                        $output.='<span class="label label-success">OK</span> Nueva Persona Creada: Doc.: ' . $data_file[$a]['AX'] . '<br>';
                    } else {
                        $persona_id = $get_persona_id[0]->persona_id;
                    }
                    //VALIDAR SI PARA EL USUARIO YA SE SUBIERON CAIDAS DE LA FECHA (fecha_caida)
                    $get_cuenta_id_fecha_caida = $this->portafolio_model->get_cuenta_id_fecha_caida($data_file[$a]['A'], $this->input->post('fecha_caida'));
                    if (count($get_cuenta_id_fecha_caida) == 0) {
                        //AGREGAR HISTORICO PERSONA
                        $this->portafolio_model->insert_historico($data_file, $a, $persona_id);
                        $output.='<span class="label label-success">OK</span> Se Agrego Historico Persona: Doc.: ' . $data_file[$a]['AX'] . '<br>';
                        //AGREGAR CUENTA
                        $this->portafolio_model->insert_cuenta($data_file, $a, $persona_id);
                        $output.='<span class="label label-success">OK</span> Se Agrego Cuenta: ' . $data_file[$a]['A'] . ' - Doc.: ' . $data_file[$a]['AX'] . '<br>';
                    } else {
                        $output.='<span class="label label-danger">ERROR</span> &#161; Cuenta en Fecha_Caida ya se encontraba : Cuenta: ' . $data_file[$a]['A'] . ' - Doc.: ' . $data_file[$a]['AX'] . ' &#33;<br>';
                    }
                }
                $output.='.<br>.<br>.<br>.<br>.<br>&#161; Fin del proceso &#33;';
                $this->session->set_flashdata(array('message' => 'Registros agregados con exito', 'message_type' => 'success'));               
                $this->session->set_flashdata(array('message_log' => $output, 'message_type_log' => 'info'));
                redirect('index.php/portafolio/add', 'refresh');                
            }
        }
    }

}
