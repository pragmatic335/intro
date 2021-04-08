<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">

                <li>
                    <a href="/statistics/"><i class="fa fa-th-large"></i> <span class="nav-label">Статистика</span></a>
                </li>
                <li>
                    <a href="/categories/"><i class="fa fa-th-large"></i> <span class="nav-label">Категории</span></a>
                </li>
                <li>
                    <a href="/objects/"><i class="fa fa-diamond"></i> <span class="nav-label">Объекты</span></a>
                </li>
                <li>
                    <a href="/charges/"><i class="fa fa-diamond"></i> <span class="nav-label">Начисления</span></a>
                </li>
                <li>
                    <a href="/charge-types/"><i class="fa fa-diamond"></i> <span class="nav-label">Тип начисления</span></a>
                </li>
                <li>
                    <a href="/currencies/"><i class="fa fa-diamond"></i> <span class="nav-label">Валюта</span></a>
                </li>


            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg" style="min-height: 979px;">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

            </nav>
        </div>
        <div class="wrapper wrapper-content">
            <?= $content ?>
        </div>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
