<?php
function auth_check()
{
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        if ($_SESSION['role_id'] == 1) {
            redirect(site_url('admin/dashboard'));
        } else {
            redirect(site_url('pendaftaran/dashboard'));
        }
    }
}

function not_auth_check()
{
    if (!isset($_SESSION['email'])) {
        redirect(site_url('auth'));
    }
}
