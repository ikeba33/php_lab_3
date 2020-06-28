<?php

require_once __DIR__ . '/core/main_functions.php';

use \core\Users;

checkPermissions([Users::ROLE_ADMIN, Users::ROLE_MANAGER]);

$lang = new \core\Language();

$lang->setCurrentLanguage(getLang());

$user = getUser();

$user_o = new Users();
$users = $user_o->getUserList();

$columns = [
    'id' => 'ID',
    'login' => 'Login',
    'first_name' => 'First name',
    'last_name' => 'Last name',
    'lang' => 'Language',
    'role' => 'Role',
    'created' => 'Created',
    'modified' => 'Modified'
];

$head = '';
foreach($columns as $title) {
    $head .= '<th>' . $title . '</th>';
}

if($user->isAdmin()) {
    $head .= '<th>Actions</th>';
}

$message = getMessageFromSession();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Client profile</title>
        <link rel="stylesheet" type="text/css" href="/styles.css">
    </head>
    <body>
    <header>
        <?= createNav($user) ?>
        <div class="logout-btn">
            <a href="/logout"><?=$lang->translate('logout') ?></a>
        </div>
        <?= getLangBlock() ?>
    </header>
    <div class="content">
        <div class="block">
            <h1><?=$lang->translate('user_list')?></h1>
            <?php if(!empty($message)) { ?>
                <div style="color: red; text-align: center; padding: 20px 0px;">
                        <?= $message ?>
                </div>
            <?php } ?>
            <table>
                <thead>
                    <tr>
                        <?= $head ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $row) { ?>
                    <tr>
                        <?php foreach ($columns as $field => $title) { ?>
                            <td><?= $row[$field] ?></td>
                        <?php } ?>
                        <?php if($user->isAdmin()) { ?>
                            <td>
                                <a href="/edit-user?id=<?=$row['id']?>">Edit</a>
                                <a href="/remove-user?id=<?=$row['id']?>">Remove</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
       </div>
    </div>
    </body>
</html>