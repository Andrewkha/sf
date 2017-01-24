<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/24/2017
 * Time: 5:27 PM
 */

namespace app\modules\admin\resources;


class MenuItems
{
    const MENU_ITEMS = [
        'country' => 'Страны',
        'team' => 'Команды',
        'tournament' => 'Турниры',
        'news' => 'Новости',
        'log' => 'Журнал',
        'user' => 'Пользователи',
    ];

    public static function createArray()
    {
        $count = count(self::MENU_ITEMS);
        $adminMenu = [];

        foreach (self::MENU_ITEMS as $k => $item)
        {
            $adminMenu[] = ['label' => $item, 'url' => ['/#']];
            if ($k != $count - 1)
                $adminMenu[] = '<li class="divider"></li>';
        }

        $lastElement = array_pop($adminMenu);

        return $adminMenu;
    }
}