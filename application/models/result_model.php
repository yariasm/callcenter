<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Result_model extends CI_Model {

    public function get_all() {
        $SQL_string = "SELECT r.*,
                        (
                        SELECT 
                        GROUP_CONCAT(CONCAT(c.codigo,' - ',c.nombre) SEPARATOR '<br>')
                        FROM causal c,resultado_causal rc 
                        WHERE
                        c.causal_id = rc.causal_id
                        AND rc.resultado_id = r.resultado_id
                        ) resultadocausal
                      FROM resultado r";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_id($id){
        $SQL_string = "SELECT *
                      FROM resultado WHERE resultado_id = $id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }
    
    public function get_resultado_causal_id($id){
        $SQL_string = "SELECT *
                      FROM resultado_causal WHERE resultado_id = $id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();           
    }

    public function insert($data) {
        $SQL_string = "INSERT INTO resultado
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
        if($this->db->query($SQL_string)){
            return $this->db->insert_id();
        }else{
            return 0;
        }
    }
    
    public function delete_resultado_causal($resultado_id){
        $SQL_string = "DELETE FROM resultado_causal WHERE resultado_id = $resultado_id";
        $this->db->query($SQL_string);        
    }
    
    public function resultado_causal($data){
        $SQL_string = "INSERT INTO resultado_causal
                      (
                        causal_id,
                        resultado_id
                       )
                      VALUES 
                       (
                        '{$data['causal_id']}',
                        '{$data['resultado_id']}'
                       )
                       ";
        $this->db->db_debug = FALSE;            
        $this->db->query($SQL_string);
    }

    public function update($data) {
        $SQL_string = "UPDATE resultado SET
                        codigo = '{$data['codigo']}',
                        nombre = '{$data['nombre']}',
                        estado = '{$data['estado']}'   
                       WHERE
                       resultado_id = {$data['resultado_id']}
                       ";
                       //echo $SQL_string;
        return $SQL_string_query = $this->db->query($SQL_string);
    }
    
    public function get_all_causes(){
        $SQL_string = "SELECT causal_id,CONCAT(codigo,' - ',nombre) codigo_nombre
                      FROM causal WHERE estado = 1";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();  
    }
   

}
