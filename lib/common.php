<?php   

function sign_password ($password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    return $hash;
}

function verify_password ($password, $hash) {
    $result = password_verify($password, $hash);

    return $result;
}