<?php
    use app\modules\admin\resources\MenuItems;
    use yii\helpers\Html;

$this->title = 'Админка';
?>
<div class="admin-default-index">
    <?= Html::ul(MenuItems::MENU_ITEMS,['item' => function($item, $index){
        return Html::a($item, ["$index/"]);
    }]);?>
</div>
