<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gestion_model extends CI_Model {

    public function get_() {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('num_documento', $num_documento);
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
