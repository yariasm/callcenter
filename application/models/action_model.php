<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Action_model extends CI_Model {

    public function get_all() {
        $SQL_string = "SELECT a.*,
                        (   
                        SELECT 
                        GROUP_CONCAT(CONCAT(r.codigo,' - ',r.nombre) SEPARATOR '<br>')
                        FROM resultado r,accion_resultado ar
                        WHERE
                        r.resultado_id = ar.resultado_id
                        AND ar.accion_id = a.accion_id
                        ) accionresultado
                      FROM accion a";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_id($id){
        $SQL_string = "SELECT *
                      FROM accion WHERE accion_id = $id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }
    
    public function get_accion_resultado_id($id){
        $SQL_string = "SELECT *
                      FROM accion_resultado WHERE accion_id = $id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();           
    }    

    public function insert($data) {
        $SQL_string = "INSERT INTO accion
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
    
    public function delete_accion_resultado($accion_id){
        $SQL_string = "DELETE FROM accion_resultado WHERE accion_id = $accion_id";
        $this->db->query($SQL_string);        
    }    

    public function update($data) {
        $SQL_string = "UPDATE accion SET
                        codigo = '{$data['codigo']}',
                        nombre = '{$data['nombre']}',
                        estado = '{$data['estado']}'   
                       WHERE
                       accion_id = {$data['accion_id']}
                       ";
                       //echo $SQL_string;
        return $SQL_string_query = $this->db->query($SQL_string);
    }
    
    public function accion_resultado($data){
        $SQL_string = "INSERT INTO accion_resultado
                      (
                        accion_id,
                        resultado_id
                       )
                      VALUES 
                       (
                        '{$data['accion_id']}',
                        '{$data['resultado_id']}'
                       )
                       ";
        $this->db->db_debug = FALSE;            
        $this->db->query($SQL_string);
    }    
    
    public function get_all_results(){
        $SQL_string = "SELECT resultado_id,CONCAT(codigo,' - ',nombre) codigo_nombre
                      FROM resultado WHERE estado = 1";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();  
    }    
   

}
