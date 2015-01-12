<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gestion_model extends CI_Model {

    public function get_user($search_type, $search_value) {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('persona,cuenta');
        ($search_type == 1) ? $this->db->where('num_documento', $search_value) : $this->db->where('cuenta', $search_value);
        $this->db->where("persona.persona_id", "cuenta.persona_id", false);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_user_id($id){
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('persona,cuenta');
        $this->db->where('persona.persona_id', $id);
        $this->db->where("persona.persona_id", "cuenta.persona_id", false);
        $query = $this->db->get();
        return $query->result();        
    }
    
    public function get_gestion_callcenter($cuenta_id){
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->select('( SELECT accion.nombre FROM accion WHERE gestion.accion_id = accion.accion_id ) accion');
        $this->db->select('( SELECT resultado.nombre FROM resultado WHERE gestion.resultado_id = resultado.resultado_id ) resultado');
        $this->db->select('( SELECT causal.nombre FROM causal WHERE gestion.causal_id = causal.causal_id ) causal');
        $this->db->from('gestion,proyecto_usuarios_sistema');
        $this->db->where('cuenta_id', $cuenta_id);
        $this->db->where("gestion.USUARIO_ID", "proyecto_usuarios_sistema.USUARIO_ID", false);
        $this->db->order_by("fecha_ingreso", "desc"); 
        $query = $this->db->get();
        return $query->result();          
    }
    
    public function get_gestion_visita($cuenta_id){
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('visita,proyecto_usuarios_sistema');
        $this->db->where('cuenta_id', $cuenta_id);
        $this->db->where("visita.USUARIO_ID", "proyecto_usuarios_sistema.USUARIO_ID", false);
        $query = $this->db->get();
        return $query->result();          
    }    

    public function insert($post) {
        $data = array(
            'accion_id' => addslashes($post['accion_id']),
            'resultado_id' => addslashes($post['resultado_id']),
            'causal_id' => addslashes($post['causal_id']),
            'observacion' => addslashes($post['observacion']),
            'telefono' => addslashes($post['telefono']),
            'estado_tel' => addslashes($post['estado_tel']),
            'direccion' => addslashes($post['direccion']),
            'estado_dir' => addslashes($post['estado_dir']),
            'cuenta_id' => addslashes($post['cuenta_id']),
            'USUARIO_ID' => $this->session->userdata('USUARIO_ID')
        );
        $this->db->set_dbprefix('');
        $this->db->insert('gestion', $data);
        return $this->db->insert_id();
    }
    
    public function insert_visita($post) {
        $data = array(
            'observacion' => addslashes($post['observacion']),
            'cuenta_id' => addslashes($post['cuenta_id']),
            'USUARIO_ID' => $this->session->userdata('USUARIO_ID')
        );
        $this->db->set_dbprefix('');
        $this->db->insert('visita', $data);
        return $this->db->insert_id();
    }    

}
