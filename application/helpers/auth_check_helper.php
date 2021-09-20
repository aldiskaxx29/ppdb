<?php
function auth_check()
{
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        redirect_role($_SESSION['role_id']);
    }
}

function not_auth_check()
{
    if (!isset($_SESSION['email'])) {
        redirect(site_url('auth'));
    }
}
