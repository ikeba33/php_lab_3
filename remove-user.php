<?php

require_once __DIR__ . '/core/main_functions.php';

use \core\Users;

checkPermissions([Users::ROLE_ADMIN]);

$current_user = getUser();
$user_o = new Users();

if(isset($_GET['id'])) {
    $user = $user_o->fromID($_GET['id']);
}

if(!empty($user)) {
    $message = $user_o->delete($user['id']) ? 'Пользователь удален!' : 'Ошибка во время выполнения удаления!';
} else {
    $message = 'Пользователь не найден!';
}

$_SESSION['message'] = $message;
exit(header('Location: /users-list'));