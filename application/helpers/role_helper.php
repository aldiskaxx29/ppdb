<?php
function role_user($role_id)
{
    $name_role = null;
    switch ($role_id) {
        case 1:
            $name_role = 'Admin';
            break;
        case 2:
            $name_role = 'Calon Siswa';
            break;
        case 3:
            $name_role = 'Siswa';
            break;
        default:
            $name_role = 'Kepala Sekolah';
            break;
    }

    return $name_role;
}

function redirect_role($role_id)
{
    switch ($role_id) {
        case 1:
            redirect(site_url('admin/dashboard'));
            break;
        case 2:
            redirect(site_url('pendaftaran/dashboard'));
            break;
        case 3:
            redirect(site_url('siswa/dashboard'));
            break;
        default:
            $name_role = 'Kepala Sekolah';
            break;
    }
}
