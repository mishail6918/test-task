<?php
require __DIR__ . '/auth/auth.php';
$login = getUserLogin();
$link = mysqli_connect("localhost", "mysql", "mysql", "checklist_test");
$query = 'SELECT * FROM `checklist` ORDER BY `user_id` DESC';
$result = $link->query($query);
$arResult = [];
while ($data = mysqli_fetch_array($result)) {
    $arResult[$data['user_login']][] = $data;
}
//echo "<pre>";
//var_dump($arResult);
//echo "</pre>";
?>
<html>
<head>
    <title>Главная страница</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php if ($login === null): ?>
<div class="container">
    <h1>Вы не авторизованы, войдите в свой аккаунт:</h1>
    <form action="/login.php" method="post">
        <label for="login">Имя пользователя: </label><input type="text" name="login" id="login">
        <br>
        <label for="password">Пароль: </label><input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Войти">
    </form>
</div>
<?php else: ?>
<div class="container">
    Добро пожаловать, <?= $login ?>
    <br>
    <a href="/logout.php">Выйти</a>
    <hr>
</div>
<div class="checklist" data-user-id="<?=$arResult[$login][0]['user_id']?>">
    <div class="container">
        <div class="checklist__title"><h1>Чеклист технического аудита сайта</h1></div>
        <hr>
        <div class="checklist__list">
            <?if ($login == $arResult[$login][0]['user_login']):?>
            <?foreach ($arResult[$login] as $key => $user):?>
            <div class="list__item" data-item-id="<?=$user['item_id']?>">
                <div class="item__name">
                    <div class="item__left">
                        <input type="checkbox" class="parent-check" name="parent-check" <?if ($user['item_name'] == 'on'):?> checked="checked"<?endif;?>>
                        <h1>Robots.txt</h1>
                    </div>
                    <div class="item__open"><img src="/img/plus.png" alt=""></div>
                </div>
                <div class="item__dropdown">
                    <div class="dropdown__description">
                        <p><? echo $user['item_desc']?></p>
                    </div>
                    <div class="dropdown__checklist">
                        <?foreach ($user as $itemKey => $item):?>
                        <?if (strpos($itemKey, 'item_child') !== false):?>
                                <div class="checklist__item">
                                    <label><input type="checkbox" class="child-check item" name="child-check<?=substr($itemKey, -1)?>" <?if ($item == 'on'):?> checked="checked"<?endif;?>>Закрыты служебные и ненужные разделы</label>
                                </div>
                        <?endif;?>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
            <?endforeach;?>
            <?endif;?>
        </div>
    </div>
</div>
<?php endif; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>