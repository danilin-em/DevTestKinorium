<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Html\Html;

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>SelectBox</title>
</head>
<body>
    <h1>SelectBox</h1>

    <h2>My Films</h2>
    <?=Html::select([
        'Терминатор',
        'Троя',
        'Матрица',
        'Силиконовая долина',
        'Вавилон 5',
    ]) ?>

    <h2>My Cars</h2>
    <label for="mycars">Choose car</label>
    <?=Html::select([
        'volvo' => 'Volvo',
        'saab' => 'Saab',
        'mercedes' => 'Mercedes',
        'audi' => 'Audi',
    ], ['id'=> 'mycars', 'class' => 'form-item']) ?>
</body>
</html>
