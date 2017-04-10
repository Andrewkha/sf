<?php

namespace app\modules\admin\models;

use Yii;
use yii\log\Logger;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property string $id
 * @property integer $level
 * @property string $category
 * @property double $log_time
 * @property string $prefix
 * @property string $message
 */
class Log extends \yii\db\ActiveRecord
{
    const CATEGORY_CONSOLE = 'console';
    const CATEGORY_APPLICATION = 'application';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'integer'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Тип',
            'log_time' => 'Дата',
            'prefix' => 'Prefix',
            'message' => 'Содержание',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\query\LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\LogQuery(get_called_class());
    }
}
