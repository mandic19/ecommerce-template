<?php

namespace backend\controllers;

use common\components\actions\CreateAction;
use common\components\actions\DeleteAction;
use common\components\actions\SearchAction;
use common\components\actions\ToggleAction;
use common\components\actions\UpdateAction;
use common\components\actions\ViewAction;
use common\components\controllers\BaseController;
use common\models\forms\RegistrationForm;
use common\models\User;
use common\models\search\UserSearch;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{
    public $modelClass = User::class;
    public $searchModelClass = UserSearch::class;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'toggle-status' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'class' => SearchAction::class,
                'searchModel' => $this->searchModelClass,
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => RegistrationForm::class,
                'scenario' => RegistrationForm::SCENARIO_ADMIN_REGISTRATION
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => RegistrationForm::class,
                'scenario' => RegistrationForm::SCENARIO_ADMIN_UPDATE,
                'findModel' => function ($id) {
                    return RegistrationForm::findOne($id);
                }
            ],
            'toggle-status' => [
                'class' => ToggleAction::class,
                'modelClass' => $this->modelClass,
                'attribute' => 'status',
                'onValue' => User::STATUS_ACTIVE,
                'offValue' => User::STATUS_INACTIVE
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
            ],
        ]);
    }
}
