<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function get_report1($from, $to) {
        $this->db->set_dbprefix('');
        $this->db->select('accion.codigo AS accioncodigo');
        $this->db->select('resultado.codigo AS resultadocodigo');
        $this->db->select('gestion.*,accion.*,causal.*,resultado.*,cuenta.*,persona.*');
        $this->db->from('gestion,accion,causal,resultado,cuenta,persona');

        $this->db->where("gestion.accion_id", "accion.accion_id", false);
        $this->db->where("gestion.causal_id", "causal.causal_id", false);
        $this->db->where("gestion.resultado_id", "resultado.resultado_id", false);

        $this->db->where("gestion.cuenta_id", "cuenta.cuenta_id", false);

        $this->db->where("gestion.fecha_ingreso between '$from' and '$to'");

        $this->db->group_by("gestion.gestion_id"); 
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_report2($from, $to) {
        $this->db->set_dbprefix('');
        $this->db->select('persona.num_documento,cuenta.cuenta,accion.codigo as accion_codigo,accion.nombre as accion_nombre',false);
        $this->db->select('resultado.codigo as resultado_codigo,resultado.nombre as resultado_nombre',false);
        $this->db->select('causal.codigo as causal_codigo,causal.nombre as causal_nombre,gestion.*',false);
        $this->db->from('gestion,accion,causal,resultado,cuenta,persona');

        $this->db->where("gestion.accion_id", "accion.accion_id", false);
        $this->db->where("gestion.causal_id", "causal.causal_id", false);
        $this->db->where("gestion.resultado_id", "resultado.resultado_id", false);

        $this->db->where("gestion.cuenta_id", "cuenta.cuenta_id", false);

        $this->db->where("gestion.fecha_ingreso between '$from' and '$to'");

        $this->db->group_by("gestion.gestion_id"); 
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
            'tipo_identificacion' => addslashes($data_file[$a]['AW']),
            'num_documento' => addslashes($data_file[$a]['AX']),
            'nombre' => addslashes($data_file[$a]['AC']),
            'ciudad' => addslashes($data_file[$a]['BP']),
            'direccion_domicilio' => addslashes($data_file[$a]['BN']),
            'telefono' => addslashes($data_file[$a]['BQ']),
            'celular' => addslashes($data_file[$a]['BR']),
            'correo' => addslashes($data_file[$a]['AM']),
        );

        $this->db->insert('persona', $data_persona);
        return $this->db->insert_id();
    }

    public function insert_historico($data_file, $a, $persona_id) {

        $data_historico = array(
            'ciudad' => addslashes($data_file[$a]['BP']),
            'direccion' => addslashes($data_file[$a]['BN']),
            'telefono' => addslashes($data_file[$a]['BQ']),
            'celular' => addslashes($data_file[$a]['BR']),
            'persona_id' => $persona_id
        );

        $this->db->insert('historico_persona', $data_historico);
        return $this->db->insert_id();
    }

    public function insert_cuenta($data_file, $a, $persona_id) {
        $data_cuenta = array(
            'cuenta' => addslashes($data_file[$a]['A']),
            'ciudad_oficina' => addslashes($data_file[$a]['B']),
            'casa' => addslashes($data_file[$a]['C']),
            'portafolio' => addslashes($data_file[$a]['D']),
            'segmento' => addslashes($data_file[$a]['E']),
            'fecha_caida' => addslashes($this->input->post('fecha_caida')),
            'cosecha_180' => addslashes((float) str_replace(',', '', $data_file[$a]['G'])),
            'cosecha_210' => addslashes((float) str_replace(',', '', $data_file[$a]['H'])),
            'cosecha_real' => addslashes((float) str_replace(',', '', $data_file[$a]['I'])),
            'SaldoContable' => addslashes((float) str_replace(',', '', $data_file[$a]['J'])),
            'SaldoReal' => addslashes((float) str_replace(',', '', $data_file[$a]['K'])),
            'ESTRATEGIA_0' => addslashes((float) str_replace(',', '', $data_file[$a]['L'])),
            'ESTRATEGIA_1' => addslashes((float) str_replace(',', '', $data_file[$a]['M'])),
            'ESTRATEGIA_2' => addslashes((float) str_replace(',', '', $data_file[$a]['N'])),
            'ESTRATEGIA_3' => addslashes((float) str_replace(',', '', $data_file[$a]['O'])),
            'ESTRATEGIA_4' => addslashes((float) str_replace(',', '', $data_file[$a]['P'])),
            'Capital' => addslashes((float) str_replace(',', '', $data_file[$a]['Q'])),
            'Cuota_manejo' => addslashes((float) str_replace(',', '', $data_file[$a]['S'])),
            'IntCtes' => addslashes((float) str_replace(',', '', $data_file[$a]['T'])),
            'IntMoraFact' => addslashes((float) str_replace(',', '', $data_file[$a]['U'])),
            'IntMoraNoFact' => addslashes((float) str_replace(',', '', $data_file[$a]['W'])),
            'GAST_COBR' => addslashes((float) str_replace(',', '', $data_file[$a]['X'])),
            'Dias_Mora' => addslashes($data_file[$a]['Y']),
            'NumTarj' => addslashes($data_file[$a]['Z']),
            'tipo' => addslashes($data_file[$a]['AA']),
            'situacion' => addslashes($data_file[$a]['AB']),
            'USUARIO_ID' => $this->session->userdata('USUARIO_ID'),
            'persona_id' => $persona_id
        );

        //VALIDAR SI YA SE ENCUENTRA LA CUENTA EN LA BD
        $this->db->set_dbprefix('');
        $this->db->select('*');
        $this->db->from('cuenta');
        $this->db->where('cuenta', addslashes($data_file[$a]['A']));
        $query = $this->db->get();
        $result = $query->result();
        if (count($result) > 0) {
            unset($data_cuenta['cuenta']);
            unset($data_cuenta['persona_id']);
            $this->db->where('cuenta', addslashes($data_file[$a]['A']));
            $this->db->update('cuenta', $data_cuenta);
        } else
            $this->db->insert('cuenta', $data_cuenta);
        return $this->db->insert_id();
    }

}
