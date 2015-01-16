<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cause_model extends CI_Model {

    public function get_all() {
        $SQL_string = "SELECT *
                      FROM causal";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_id($id){
        $SQL_string = "SELECT *
                      FROM causal WHERE causal_id = $id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }

    public function insert($data) {
        $SQL_string = "INSERT INTO causal
                      (
                        codigo,
                        nombre
                       )
                      VALUES 
                       (
                        '{$data['codigo']}',
                        '{$data['nombre']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function update($data) {
        $SQL_string = "UPDATE causal SET
                        codigo = '{$data['codigo']}',
                        nombre = '{$data['nombre']}',
                        estado = '{$data['estado']}'   
                       WHERE
                       causal_id = {$data['causal_id']}
                       ";
                       //echo $SQL_string;
        return $SQL_string_query = $this->db->query($SQL_string);
    }
    
    
    
    public function get_select_cause($resultado_id) {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('causal,resultado_causal');
        $this->db->where('resultado_causal.resultado_id', $resultado_id);
        $this->db->where("causal.causal_id", "resultado_causal.causal_id", false);
        $query = $this->db->get();
        return $query->result();
    }       
   

}
