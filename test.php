<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/7/2017
 * Time: 3:12 PM
 */
'editableOptions' => function ($model, $key, $index) {
    return [
        'formOptions' => [
            'action' => ['team/logo-update'],
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
        ],
        'preHeader' => '',
        'submitButton' => [
            'icon' => Icon::show('download',['class' => 'text-primary'], Icon::FA)
        ],
        'resetButton' => [
            'icon' => Icon::show('ban',['class' => 'text-danger'], Icon::FA)
        ],
        'inputType' => Editable::INPUT_FILEINPUT,
        'options' => [
            'options' => ['accept' => 'image/*', 'name' => "Team[logo][$index]", 'id' => "team-logo-$index"],
            'pluginOptions' => [
                'showRemove' => false,
                'showUpload' => false,
            ]
        ],
    ];
},

    public function actions()
{
    return ArrayHelper::merge(parent::actions(), [
        'update' => [                                                       // identifier for your editable action
            'class' => EditableColumnAction::className(),                   // action class name
            'modelClass' => Team::class,       // the update model class
            'outputValue' => function (Team $model, $attribute, $key, $index) {
                if ($attribute === 'country_id') {
                    return $model->country->country;
                }

                return $model->$attribute;
            },
        ]
    ]);
}

    public function actionLogoUpdate()
{
    $post = Yii::$app->request->post();

    if (array_key_exists('editableKey', $post)){
        $teamId = $post['editableKey'];

        /** @var Team $model */
        $model = Team::findOne($teamId);

        $out = Json::encode(['output' => '', 'message' => '']);

        $model->load($post);
        $model->logo = UploadedFile::getInstances($model, 'logo')[0];

        if ($model->validate()){
            $model->save();
            $out = Json::encode(['output' => Html::img($model->fileUrl, ['height' => '50', 'width' => '50']), 'message' => '']);
        }

        echo $out;
        return;
    }
}