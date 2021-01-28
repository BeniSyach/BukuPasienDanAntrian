<?php

function cek_login()
{


    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $rule_id = $ci->session->userdata('rule_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'rule_id' => $rule_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
function cek_akses($rule_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('rule_id', $rule_id);
    $ci->db->where('menu_id', $menu_id);
    $result =   $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function cek_riwayat($riwayat, $pasien)
{
    $ci = get_instance();

    $ci->db->where('nama', $riwayat);
    $ci->db->where('nama', $pasien);
    $result = $ci->db->get('riwayat_pasien');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
