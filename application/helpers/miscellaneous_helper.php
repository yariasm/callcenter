<?php

function print_y($array) {
    return '<pre>' . print_r($array, true) . '</pre>';
}

function get_array_states($type = 0) {
    if ($type == 0)
        $states = array(
            1 => 'Activo',
            0 => 'Inactivo',
        );
    elseif ($type == 1)
        $states = array(
            1 => 'SI',
            0 => 'NO',
        );
    return $states;
}

function get_dropdown($array_objects, $value, $name) {
    $array_return = array();
    foreach ($array_objects as $array) {
        $array_return[$array->$value] = $array->$name;
    }
    return $array_return;
}

function get_dropdown_select($array_objects, $value, $name, $select_value, $select_name = 'Seleccionar...') {
    $array_return = array($select_value => $select_name);
    foreach ($array_objects as $array) {
        $array_return[$array->$value] = $array->$name;
    }
    return $array_return;
}

function encrypt_id($id) {
    return base64_encode(rand(111111, 999999) . $id . rand(11111, 99999));
}

function deencrypt_id($id) {
    $id = base64_decode($id);
    $id = substr($id, 6, strlen($id));
    $id = substr($id, 0, strlen($id) - 5);
    return $id;
}

function dias_transcurridos($fecha_i, $fecha_f) {
    $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
    $dias = abs($dias);
    $dias = floor($dias);
    return $dias;
}

function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function getUltimoDiaMes($elAnio, $elMes) {
    return date("d", (mktime(0, 0, 0, $elMes + 1, 1, $elAnio) - 1));
}

function get_date_selectcut() {
    $return = array();

    $year1 = date("Y", strtotime(date("Y-m-d") . " -1 year"));
    $year2 = date("Y");
    $year3 = date("Y", strtotime(date("Y-m-d") . " +1 year"));

    for ($a = 1; $a <= 12; $a++) {
        $return[$year1 . '/' . $a] = $year1 . '/' . $a;
    }
    for ($a = 1; $a <= 12; $a++) {
        $return[$year2 . '/' . $a] = $year2 . '/' . $a;
    }
    for ($a = 1; $a <= 12; $a++) {
        $return[$year3 . '/' . $a] = $year3 . '/' . $a;
    }

    return $return;
}

function get_type_search(){
    return array(
        '1' => 'Numero de Documento',
        '2' => 'Cuenta'
    );
}