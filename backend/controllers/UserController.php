<?php

namespace backend\controllers;

use common\components\actions\CreateAction;
use common\components\actions\DeleteAction;
use common\components\actions\SearchAction;
use common\components\actions\UpdateAction;
use common\components\actions\ViewAction;
use common\components\controllers\BaseController;
use common\components\orm\ActiveRecord;
use common\models\User;
use common\models\search\UserSearch;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
                        'activate' => ['POST'],
                        'reactivate' => ['POST'],
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
                'modelClass' => $this->modelClass,
                'scenario' => ActiveRecord::SCENARIO_CREATE
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => $this->modelClass,
                'scenario' => ActiveRecord::SCENARIO_UPDATE,
                'findModel' => function ($id) {
                    return $this->findModel($id);
                }
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
            ],
        ]);
    }

    public function actionActivate($id)
    {
        $model = User::findOne(['id' => $id, 'status' => User::STATUS_INACTIVE]);

        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->status = User::STATUS_ACTIVE;

        if ($model->save(false, ['status'])) {
            return $this->formatResponse($model, 'success', 'activated');
        }

        return $this->formatResponse($model, 'error', 'activated');
    }

    public function actionDeactivate($id)
    {
        $model = User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);

        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->status = User::STATUS_INACTIVE;

        if ($model->save(false, ['status'])) {
            return $this->formatResponse($model, 'success', 'deactivated');
        }

        return $this->formatResponse($model, 'error', 'deactivated');
    }

    public function formatResponse(User $model, $type, $action = 'updated')
    {

        if ($type === 'success') {
            $message = Yii::t('app', "{:model} successfully {$action} !", [':model' => $model->getPublicName()]);
            $response =  [
                'success' => true,
                'message' => $message
            ];
        } else {
            $message = $model->getPublicName() . " canno't be {$action} !<br>" . implode('<br>', $model->getFirstErrors());
            $response = [
                'success' => false,
                'message' =>  $message,
                'errors' => ActiveForm::validate($model)
            ];
        }

        if (Yii::$app->request->getIsAjax()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $response;
        }

        \Yii::$app->getSession()->setFlash($type, $message);

        return $this->redirect(Yii::$app->request->referrer);
    }
}
