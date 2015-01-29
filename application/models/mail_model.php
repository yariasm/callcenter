<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail_model extends CI_Model {

    public function get_bancos() {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('bancos');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_plantillas() {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('plantillas_correo');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_plantilla_id($id) {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('plantillas_correo');
        $this->db->where('plantilla_id', $id);
        $query = $this->db->get();
        return $query->result();
    }      
    
    public function get_users_idbanco($id) {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('banco_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
       

    public function insert($data) {
        $this->db->set_dbprefix('');    
        $this->db->insert('log_correos', $data);
        return $this->db->insert_id();
    }
    
    public function update($data,$plantilla_id) {
        $this->db->set_dbprefix('');
        $this->db->where('plantilla_id', $plantilla_id);
        return $this->db->update('plantillas_correo', $data);
    }    


}
