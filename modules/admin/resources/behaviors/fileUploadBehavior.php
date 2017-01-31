<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 8/27/2015
 * Time: 4:04 PM
 */

namespace app\modules\admin\resources\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\db\BaseActiveRecord;

class fileUploadBehavior extends Behavior
{

     /* @property UploadedFile $_file */
     /* @property string $toAttribute */
     /* @property string $imagePath */
     /* @property string $default */

    protected $_file;
    public $toAttribute;
    public $imagePath;
    public $default = '';

    //if the prefix === time, the timestamp will be added, otherwise, the value of the attribute provided
    public $prefix = '';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'onBeforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
            ActiveRecord::EVENT_AFTER_DELETE => 'onAfterDelete',
        ];
    }

    public function getFileUrl() {

        return Yii::getAlias('@web/'.$this->imagePath). '/'.$this->owner->{$this->toAttribute};
    }

    public function getFilePath() {

        return $this->getFileDir().'/'.$this->owner->{$this->toAttribute};
    }

    public function getFileDir() {

        return Yii::getAlias('@webroot/' . $this->imagePath);
    }

    public function onBeforeValidate() {

        if($this->owner->{$this->toAttribute} instanceof UploadedFile) {

            $this->_file = $this->owner->{$this->toAttribute};
            return;
        }
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;

        $this->_file = UploadedFile::getInstance($owner, $this->toAttribute);

        if (empty($this->_file)) {
            $this->_file = UploadedFile::getInstanceByName($this->toAttribute);
        }

        if($this->_file instanceof UploadedFile) {

            $this->owner->{$this->toAttribute} = $this->_file;
        } else {
            $this->owner->{$this->toAttribute} = NULL;
        }
    }

    public function onBeforeSave() {

        $this->getPrefix();

        if(!$this->owner->isNewRecord && !empty($this->owner->{$this->toAttribute})) {
            /* @var $owner BaseActiveRecord */
            $owner = $this->owner;
            $oldFile = $owner->getOldAttribute($this->toAttribute);
            $oldPath = $this->getFileDir().'/'.$oldFile;

            if($oldFile !== $this->default) {
                unlink($oldPath);
            }
        }

        if(($this->owner->{$this->toAttribute})) {

            /* @var $file UploadedFile */

            $file = $this->_file;
            $this->owner->{$this->toAttribute} = $this->prefix . '_' . $file->name;
            $path = $this->getFileDir() . '/' . $this->owner->{$this->toAttribute};
            $file->saveAs($path);
        } elseif ($this->owner->isNewRecord) {
            $this->owner->{$this->toAttribute} = $this->default;
        } else {
            if (!$this->owner->isNewRecord && empty($this->owner->{$this->toAttribute}))
                $this->owner->{$this->toAttribute} = ArrayHelper::getValue($this->owner->oldAttributes, $this->toAttribute, null);
        }
    }

    public function onAfterDelete() {

        if($this->owner->{$this->toAttribute} !== $this->default) {

            unlink($this->filePath);
        }
    }

    private function getPrefix() {

        if($this->prefix === 'time') {
            $this->prefix = time();
        } else {
            $this->prefix = $this->owner->{$this->prefix};
        }
    }

}