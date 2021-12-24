<?php
function checkAuth(string $login, string $password): bool
{
    $link = mysqli_connect("localhost", "mysql", "mysql", "checklist_test");
    $query = 'SELECT user_login, user_password FROM `users` ORDER BY `user_id` DESC';
    $result = $link->query($query);
    $dataResult = [];
    while ($data = mysqli_fetch_array($result)) {
        $dataResult[] = $data;
    }

    foreach ($dataResult as $user) {
        if ($user['user_login'] === $login && $user['user_password'] === $password) {
            return true;
        }
    }
    return false;
}

function getUserLogin() {
    $loginFromCookie = $_COOKIE['login'] ?? '';
    $passwordFromCookie = $_COOKIE['password'] ?? '';

    if (checkAuth($loginFromCookie, $passwordFromCookie)) {
        return $loginFromCookie;
    }

    return null;
}