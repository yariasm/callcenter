<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gestion_model extends CI_Model {

    public function get_user($search_type,$search_value) {
        
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('persona,cuenta');
        ($search_type==1)?$this->db->where('num_documento', $search_value):$this->db->where('cuenta', $search_value);
        $this->db->where("persona.persona_id","cuenta.persona_id",false);
        $query = $this->db->get();
        return $query->result();
    }

       public function insert_persona($data_file, $a) {
        $data_persona = array(
            'tipo_identificacion' => addslashes($data_file[$a]['AW']),
            'num_documento' => addslashes($data_file[$a]['AX']),
            'nombre' => addslashes($data_file[$a]['AC']),
            'ciudad' => addslashes($data_file[$a]['BP']),
            'direccion_domicilio' => addslashes($data_file[$a]['BN']),
            'telefono' => addslashes($data_file[$a]['BQ']),
            'celular' => addslashes($data_file[$a]['BR'])
        );
        $this->db->insert('persona', $data_persona);
        return $this->db->insert_id();
    }


}
