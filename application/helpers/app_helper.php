<?php

function _is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('id') || !$ci->session->userdata('is_logged_in')) {
        redirect('/login');
    } else {

        $role_id = $ci->session->userdata('id_role');
        $menu = $ci->uri->segment(1);
        $query_menu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $query_menu['id'];

        $user_access = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($user_access->num_rows() < 0) {
            redirect('/auth/blocked');
        }
    }
}
