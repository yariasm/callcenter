<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'COR';
        $this->load->helper('miscellaneous');
        $this->load->model('mail_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['title'] = 'Envio de Correos';
        $data['bancos'] = get_dropdown($this->mail_model->get_bancos(), 'banco_id', 'nombre');
        $data['plantillas'] = get_dropdown($this->mail_model->get_plantillas(), 'plantilla_id', 'nombre');

        $data['content'] = 'mail/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $users = $this->mail_model->get_users_idbanco($this->input->post('banco_id'));
        $plantilla = $this->mail_model->get_plantilla_id($this->input->post('plantilla_id'));

        $log = '';
        foreach ($users as $user) {
            echo $user->correo;
            $mails_destinations = array($user->correo => $user->nombre);
            $message = $plantilla[0]->texto;
            $replace_search = array('[CONTENIDO]', '[USUARIO]');
            $replace = array($this->input->post('contenido'), $user->nombre);
            $message = str_replace($replace_search, $replace, $message);
            $enviar = send_mail($mails_destinations, $subject = 'CORREO INFORMATIVO', $message);
            if ($enviar) {
                $data = array(
                    'id_usuario' => $user->persona_id,
                    'id_plantilla' => $this->input->post('plantilla_id'),
                    'banco_id' => $this->input->post('banco_id'),  
                );
                $insert = $this->mail_model->insert($data);
                if ($insert)
                    $log.="<br>Exito al enviar correo al usuario: " . $user->correo;
            } else {
                $log.="<br>Error al enviar correo al usuario: " . $user->correo;
            }
        }

        $this->session->set_flashdata(array('message' => 'Detalles del envio de correos: <br>'.$log, 'message_type' => 'info'));
        redirect('index.php/mail/add', 'refresh');
    }
    
    public function edit($id = 1) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $data['registro'] = $this->mail_model->get_plantilla_id($id);
        if (count($data['registro']) > 0) {
            $data['title'] = 'Modificar Plantilla';
            $data['content'] = 'mail/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('index.php/user', 'refresh');
        }
    }    

}
