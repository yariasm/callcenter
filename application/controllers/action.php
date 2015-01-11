<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Action extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'ACC';


        $this->load->helper('miscellaneous');
        $this->load->model('action_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['registros'] = $this->action_model->get_all();
        $data['title'] = 'Administrar Acciones';
        $data['content'] = 'action/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Nueva Accion';
        $data['content'] = 'action/add';
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
            $data['content'] = 'action/add';
            $this->load->view('template/template', $data);
        } else {
            $data = array(
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre' => $this->input->post('nombre', TRUE)
            );

            $insert = $this->action_model->insert($data);
            if ($insert) {
                //AGREGAR RESULTADO
                $total_resultados = $this->input->post('total_results', TRUE);
                for ($a = 1; $a <= $total_resultados; $a++) {
                    $data_ar = array(
                        'resultado_id' => $this->input->post('result_id_' . $a),
                        'accion_id' => $insert
                    );
                    $this->action_model->accion_resultado($data_ar);
                }

                $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
                redirect('index.php/action', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el Registro', 'message_type' => 'error'));
                redirect('index.php/action', 'refresh');
            }
        }
    }

    public function edit($id) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id = deencrypt_id($id);
        $data['registro'] = $this->action_model->get_id($id);
        if (count($data['registro']) > 0) {
            $data['states'] = get_array_states();
            
            $data['accion_resultado'] = $this->action_model->get_accion_resultado_id($id);
            $data['results'] = get_dropdown($this->action_model->get_all_results(), 'resultado_id', 'codigo_nombre');           

            $data['title'] = 'Modificar Accion';
            $data['content'] = 'action/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('index.php/action', 'refresh');
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
            $data['registro'] = $this->action_model->get_id($id);
            if (count($data['registro']) > 0) {
                $data['states'] = get_array_states();

                $data['title'] = 'Modificar Accion';
                $data['content'] = 'action/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('index.php/action', 'refresh');
            }
        } else {

            $data = array(
                'accion_id' => $id,
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre' => $this->input->post('nombre', TRUE),
                'estado' => $this->input->post('estado', TRUE)
            );
            $update = $this->action_model->update($data);

            if ($update) {
                //ELIMINAR CAUSAS ACTUALES
                $this->action_model->delete_accion_resultado($id);                
                //AGREGAR RESULTADO
                $total_resultados = $this->input->post('total_results', TRUE);
                for ($a = 1; $a <= $total_resultados; $a++) {
                    $data_ar = array(
                        'resultado_id' => $this->input->post('result_id_' . $a),
                        'accion_id' => $id
                    );
                    $this->action_model->accion_resultado($data_ar);
                }                
                
                $this->session->set_flashdata(array('message' => 'Registro modificado con exito', 'message_type' => 'info'));
                redirect('index.php/action', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al modificar el Registro', 'message_type' => 'warning'));
                redirect('index.php/action', 'refresh');
            }
        }
    }

    /*     * ***************************AJAX FUNCTIONS************************** */

    public function get_results() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $count = $this->input->post('count');
            $count++;
            $results = get_dropdown($this->action_model->get_all_results(), 'resultado_id', 'codigo_nombre');

            echo form_dropdown("result_id_$count", $results, '', 'class="form-control"');
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
