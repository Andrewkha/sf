<?php
    use app\modules\admin\resources\AdminMenuItems;
    use kartik\helpers\Html;

$this->title = 'Админка';
?>
<div class="admin-default-index">
    <?= Html::ul(AdminMenuItems::MENU_ITEMS,['item' => function($item, $index){
        return Html::tag('li', Html::a($item, ["$index/"]));
    }]);?>
</div>
