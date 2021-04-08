<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;


$controller = Yii::$app->controller;

$action = $controller->action->id;
if (!empty($controller->actionParams) && isset($controller->actionParams['model'])) {
    $model = $controller->actionParams['model'];
} else {
    $model = '';
}

//$this->registerJsFile('/js/plugins/metisMenu/jquery.metisMenu.js', ['depends' => ['yii\web\JqueryAsset']]);
//$this->registerJsFile('/js/plugins/slimscroll/jquery.slimscroll.min.js', ['depends' => ['yii\web\JqueryAsset']]);
//$this->registerJsFile('/js/plugins/toastr/toastr.min.js', ['depends' => ['yii\web\JqueryAsset']]);
//$this->registerJsFile('/js/plugins/sweetalert/sweetalert.min.js', ['depends' => ['yii\web\JqueryAsset']]);
//'<i class="fa-map"></i>'
//Сюда добавляем свои пункты меню
$menuItemsArray = [

    [
        'label' => Yii::t('app', 'Not confirmed registration' ),
        'url' => '/pdata/registration/deferred-index',
        'iconClass' => 'fa fa-pencil-square-o',
        'active' => ($controller->id == 'site/index' && $action === 'deferred-index'),
    ],

    [
        'label' => Yii::t('app', 'Owners'),
        'url' => '/pdata/ownership',
        'iconClass' => 'fa fa-user',
        'active' => ($controller->id == 'site/login'),
    ],

    [
        'label' => Yii::t('app', 'Persons'),
        'url' => '/pdata/person',
        'iconClass' => 'fa fa-users',

        'active' => ($controller->id == 'site/contact'),
    ],

];





//Формируем список пунктов меню для виджета
//первым элементом всегда идет пункт меню с иконкой пользователя



$menuItems = [
    ['label' => '',
        'url' => '#',
        'template' =>
            Html::beginTag('div', ['class' => 'logo']) .
            Html::tag('img', '',
                [
                    'class' => 'img-rounded',
                    'style' => [
                        'width' => '60%',
                        'height' => 'auto',
                        'margin' => 'auto',
                        'display' => 'block',
                    ],
                    'src' => '/images/logo.jpg'
//                    'src' => '/images/logotip.jpg'//.( file_exists( Yii::getAlias('@webroot').'/images/logo.png' )).
                ]
            ),
        'submenuTemplate' => '<ul class="dropdown-menu animated fadeInRight m-t-xs">{items}</ul>' . Html::endTag('div') . Html::tag('div', 'Logo', ['class' => 'logo-element']),
        'options' => ['class' => 'nav-header'],
        'items' => [
            /*['label' => 'Profile', 'url' => '/'.Yii::$app->controller->id.'/profile'],
            ['label' => 'Contacts', 'url' => '/'.Yii::$app->controller->id.'/contacts'],
            ['label' => 'MailBox', 'url' => '/'.Yii::$app->controller->id.'/mailbox'],
            ['label' => '', 'url' => '', 'options' => [ 'class' => 'divider'] ] ,*/
            //['label' => 'Logout', 'url' => ['/logout'], ['data' => ['method' => 'post'] ]]
        ]
    ],
];



/*$menuItems[] = [
    'label' => '',
    'url' => '#',
    'template' =>  Html::a('История собственности',
        ['/opers/registration/select-flat'],
        [
            'class' => 'btn btn-primary openModal',
            'data' => [
                'target' => '#modal-ws',
                'width' => '700px',
//                        'pjax' => '#flat-form-pjax',
//                        'refresh' => ['#flat-index-pjax'],
            ],
            'title' => Yii::t('app', 'Создать историю собственности'),
            'style' => [
                'text-align' => 'left'
            ],
        ]),
];*/


$currentURL = (mb_strpos(Url::current(), '?') !== false ? explode('?', Url::current())[0] : Url::current());
//foreach ($menuItemsArray as $menuItem) {
//    $menuItems[] = [
//        'label' => $menuItem['label'],
//        'url' => $menuItem['url'],
//        'template' => Html::a(
//            Html::tag('i', '', ['class' => 'fa' . (isset($menuItem['iconClass']) && trim($menuItem['iconClass']) != '' ? ' ' . trim($menuItem['iconClass']) : 'fa-star')]) .
//            Html::tag('span', '{label}', ['class' => 'nav-label']) .
//            (isset($menuItem['subItems']) ? Html::tag('span', '', ['class' => 'fa arrow fa-lg']) : ''),
//            '{url}'),
//        'active' => (isset($menuItem['active']) && $menuItem['active'] ? $menuItem['active'] : false)
//    ];
//    if (isset($menuItem['subItems']) && is_array($menuItem['subItems']) && count($menuItem['subItems']) > 0) {
//        $menuItems[count($menuItems) - 1]['items'] = [];
//        foreach ($menuItem['subItems'] as $subItem) {
//
//            $menuItems[count($menuItems) - 1]['items'][] = [
//                'label' => $subItem['label'],
//                'url' => $subItem['url'],
//                'template' => Html::a(
//                    Html::tag('i', '', ['class' => 'fa' . (isset($subItem['iconClass']) && trim($subItem['iconClass']) != '' ? ' ' . trim($subItem['iconClass']) : 'fa-star')]) .
//                    Html::tag('span', '{label}', ['class' => 'nav-label']) .
//                    (isset($subItem['subItems']) ? Html::tag('span', '', ['class' => 'fa arrow fa-lg']) : ''),
//                    '{url}'),
//                'active' => (isset($subItem['active']) && $subItem['active'] ? $subItem['active'] : false),
//            ];
//
//            if (isset($subItem['subItems']) && is_array($subItem['subItems']) && count($subItem['subItems']) > 0) {
//                $menuItems[count($menuItems) - 1]['items'][count($menuItems[count($menuItems) - 1]['items']) - 1]['items'] = [];
//
//                foreach ($subItem['subItems'] as $subSubItem) {
//                    $menuItems[count($menuItems) - 1]['items'][count($menuItems[count($menuItems) - 1]['items']) - 1]['items'][] = $subSubItem;
//                }
//                $menuItems[count($menuItems) - 1]['items'][count($menuItems[count($menuItems) - 1]['items']) - 1]['submenuTemplate'] = '<ul class="fa-si nav nav-third-level collapse">{items}</ul>';
//            }
//
//        }
//        $menuItems[count($menuItems) - 1]['submenuTemplate'] = '<ul class="fa-si nav nav-second-level collapse">{items}</ul>';
//    }
//}

?>
<?= Html::beginTag('nav', ['class' => 'navbar-default navbar-static-side', 'role' => 'navigation']); ?>
<?= Html::beginTag('div', ['class' => 'sidebar-collapse']); ?>
<?= Menu::widget(
    [
        'items' => $menuItems,
        'options' => [
            'id' => 'side-menu',
            'class' => 'nav metismenu',
        ],
    ]);
?>
<?= Html::endTag('div'); ?>
<?= Html::endTag('nav'); ?>
