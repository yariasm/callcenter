<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Result extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'RES';


        $this->load->helper('miscellaneous');
        $this->load->model('result_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['registros'] = $this->result_model->get_all();
        $data['title'] = 'Administrar resultados';
        $data['content'] = 'result/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Nueva resultado';
        $data['content'] = 'result/add';
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
            $data['title'] = 'Nueva resultado';
            $data['content'] = 'result/add';
            $this->load->view('template/template', $data);
        } else {
            $data = array(
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre' => $this->input->post('nombre', TRUE)
            );

            $insert = $this->result_model->insert($data);
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));

                //AGREGAR CAUSALES
                $total_causales = $this->input->post('total_causes', TRUE);
                for ($a = 1; $a <= $total_causales; $a++) {
                    $data_ar = array(
                        'causal_id' => $this->input->post('cause_id_' . $a),
                        'resultado_id' => $insert
                    );
                    $this->result_model->resultado_causal($data_ar);
                }
                redirect('index.php/result', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el Registro', 'message_type' => 'error'));
                redirect('index.php/result', 'refresh');
            }
        }
    }

    public function edit($id) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id = deencrypt_id($id);
        $data['registro'] = $this->result_model->get_id($id);
        if (count($data['registro']) > 0) {
            $data['states'] = get_array_states();

            $data['resultado_causal'] = $this->result_model->get_resultado_causal_id($id);
            $data['causes'] = get_dropdown($this->result_model->get_all_causes(), 'causal_id', 'codigo_nombre');

            $data['title'] = 'Modificar resultado';
            $data['content'] = 'result/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('index.php/result', 'refresh');
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
            $data['registro'] = $this->result_model->get_id($id);
            if (count($data['registro']) > 0) {
                $data['states'] = get_array_states();

                $data['title'] = 'Modificar resultado';
                $data['content'] = 'result/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('index.php/result', 'refresh');
            }
        } else {

            $data = array(
                'resultado_id' => $id,
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre' => $this->input->post('nombre', TRUE),
                'estado' => $this->input->post('estado', TRUE)
            );
            $update = $this->result_model->update($data);

            if ($update) {
                //ELIMINAR CAUSAS ACTUALES
                $this->result_model->delete_resultado_causal($id);
                //AGREGAR CAUSALES
                $total_causales = $this->input->post('total_causes', TRUE);
                for ($a = 1; $a <= $total_causales; $a++) {
                    $data_ar = array(
                        'causal_id' => $this->input->post('cause_id_' . $a),
                        'resultado_id' => $id
                    );
                    $this->result_model->resultado_causal($data_ar);
                }

                $this->session->set_flashdata(array('message' => 'Registro modificado con exito', 'message_type' => 'info'));
                redirect('index.php/result', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al modificar el Registro', 'message_type' => 'warning'));
                redirect('index.php/result', 'refresh');
            }
        }
    }

    /*     * ***************************AJAX FUNCTIONS************************** */

    public function get_causes() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $count = $this->input->post('count');
            $count++;
            $causes = get_dropdown($this->result_model->get_all_causes(), 'causal_id', 'codigo_nombre');

            echo form_dropdown("cause_id_$count", $causes, '', 'class="form-control"');
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
