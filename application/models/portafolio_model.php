<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portafolio_model extends CI_Model {

    public function get_persona_id($num_documento) {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('num_documento', $num_documento);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_cuenta_id_fecha_caida($cuenta, $fecha_caida) {
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('cuenta');
        $this->db->where('cuenta', $cuenta);
        $this->db->where('fecha_caida', $fecha_caida);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_persona($data_file, $a) {
        $data_persona = array(
            'tipo_identificacion' => addslashes(@$data_file[$a][array_search('Tipo Documento', $data_file[1])]),
            'num_documento' => addslashes(@$data_file[$a][array_search('Num Documento', $data_file[1])]),
            'nombre' => addslashes(@$data_file[$a][array_search('NOMBRE', $data_file[1])]),
            'ciudad' => addslashes(@$data_file[$a][array_search('nom_ciudad', $data_file[1])]),
            'direccion_domicilio' => addslashes(@$data_file[$a][array_search('direccion', $data_file[1])]),
            'telefono' => addslashes(@$data_file[$a][array_search('telefono', $data_file[1])]),
            'celular' => addslashes(@$data_file[$a][array_search('celular', $data_file[1])]),
            'correo' => addslashes(@$data_file[$a][array_search('mail', $data_file[1])]),
        );
        $this->db->insert('persona', $data_persona);
        return $this->db->insert_id();
    }

    public function insert_historico($data_file, $a, $persona_id) {
        $data_historico = array(
            'ciudad' => addslashes(@$data_file[$a][array_search('nom_ciudad', $data_file[1])]),
            'direccion' => addslashes(@$data_file[$a][array_search('direccion', $data_file[1])]),
            'telefono' => addslashes(@$data_file[$a][array_search('telefono', $data_file[1])]),
            'celular' => addslashes(@$data_file[$a][array_search('celular', $data_file[1])]),
            'persona_id' => $persona_id
        );
        $this->db->insert('historico_persona', $data_historico);
        return $this->db->insert_id();
    }

    public function insert_cuenta($data_file, $a, $persona_id) {
        $array_busqueda = array('$',',');
        $data_cuenta = array(
            'cuenta' => addslashes(@$data_file[$a][array_search('CUENTA', $data_file[1])]),
            'ciudad_oficina' => addslashes(@$data_file[$a][array_search('OF-Ciudad', $data_file[1])]),
            'casa' => addslashes(@$data_file[$a][array_search('CASA', $data_file[1])]),
            'portafolio' => addslashes(@$data_file[$a][array_search('PORTAFOLIO', $data_file[1])]),
            'segmento' => addslashes(@$data_file[$a][array_search('SEGMENTO', $data_file[1])]),
            'fecha_caida' => addslashes($this->input->post('fecha_caida')),
            'cosecha_180' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('COSECHA >180', $data_file[1])])),
            'cosecha_210' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('COSECHA >210', $data_file[1])])),
            'cosecha_real' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('COSECHA REAL', $data_file[1])])),
            'SaldoContable' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('SaldoContable', $data_file[1])])),
            'SaldoReal' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('SaldoReal', $data_file[1])])),
            'ESTRATEGIA_0' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('ESTRATEGIA 0', $data_file[1])])),
            'ESTRATEGIA_1' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('ESTRATEGIA 1', $data_file[1])])),
            'ESTRATEGIA_2' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('ESTRATEGIA 2', $data_file[1])])),
            'ESTRATEGIA_3' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('ESTRATEGIA 3 O CONTADO', $data_file[1])])),
            'ESTRATEGIA_4' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('ESTRATEGIA 4', $data_file[1])])),
            'MESES12' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('12 MESES', $data_file[1])])),
            'MESES3' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('3 MESES', $data_file[1])])),
            'MESES6' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('6 MESES', $data_file[1])])),
            'MESES2' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('2 MESES', $data_file[1])])),
            'Capital' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('Capital', $data_file[1])])),
            'Cuota_manejo' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('Cuota_manejo', $data_file[1])])),
            'IntCtes' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('IntCtes', $data_file[1])])),
            'IntMoraFact' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('IntMoraFact', $data_file[1])])),
            'IntMoraNoFact' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('IntMoraNoFact', $data_file[1])])),
            'GAST_COBR' => addslashes((float) str_replace($array_busqueda, '', @$data_file[$a][array_search('GAST_COBR', $data_file[1])])),
            'Dias_Mora' => addslashes(@$data_file[$a][array_search('Dias Mora', $data_file[1])]),
            'NumTarj' => addslashes(@$data_file[$a][array_search('NumTarj', $data_file[1])]),
            'tipo' => addslashes(@$data_file[$a][array_search('tipo', $data_file[1])]),
            'situacion' => addslashes(@$data_file[$a][array_search('situacion', $data_file[1])]),
            'USUARIO_ID' => $this->session->userdata('USUARIO_ID'),
            'persona_id' => $persona_id
        );//echo print_y($data_cuenta);

        //VALIDAR SI YA SE ENCUENTRA LA CUENTA EN LA BD
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('cuenta');
        $this->db->where('cuenta', addslashes(@$data_file[$a]['A']));
        $query = $this->db->get();
        $result = $query->result();
        if (count($result) > 0) {
            unset($data_cuenta['cuenta']);
            unset($data_cuenta['persona_id']);
            $this->db->where('cuenta', addslashes(@$data_file[$a]['A']));
            $this->db->update('cuenta', $data_cuenta);
        } else
            $this->db->insert('cuenta', $data_cuenta);
        return $this->db->insert_id();
    }

}
