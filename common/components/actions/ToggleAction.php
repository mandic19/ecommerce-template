<?php

namespace common\components\actions;

use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ToggleAction extends ItemAction
{
    /**
     * @var string the class name of the model.
     */
    public $modelClass;

    /**
     * @var string  Model attribute name
     */
    public $attribute = 'is_active';

    /**
     * @var mixed   Active state value to be inserted
     */
    public $onValue = 1;

    /**
     * @var mixed   Inactive state value to be inserted
     */
    public $offValue = 0;

    /**
     * @var string   Action label for active state in flash message
     */
    public $onActionLabel = 'activated';

    /**
     * @var string   Action label for inactive state in flash message
     */
    public $offActionLabel = 'deactivated';

    /**
     * @var string scenario for this action
     **/
    public $scenario = 'default';

    /**
     * @param null $id
     * @return array
     * @throws BadRequestHttpException|NotFoundHttpException
     */
    public function run($id = null)
    {
        if (Yii::$app->request->isAjax) {

            $model = $this->findModel($id);
            $model->setScenario($this->scenario);
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->{$this->attribute} === $this->offValue) {
                $model->{$this->attribute} = $this->onValue;
                $actionLabel = $this->onActionLabel;
            } else {
                $model->{$this->attribute} = $this->offValue;
                $actionLabel = $this->offActionLabel;
            }

            if ($model->save(false, [$this->attribute])) {
                $message = Yii::t('app', '{:model} successfully {:action}!', [
                    ':model' => $model->getPublicName(),
                    ':action' => $actionLabel
                ]);

                return [
                    'success' => true,
                    'message' => $message
                ];
            }

            $errorMessage = Yii::t('app', '{:model} canno\'t be {:action}!', [
                    ':model' => $model->getPublicName(),
                    ':action' => $actionLabel
                ]) . '<br>' . implode('<br>', $model->getFirstErrors());

            return [
                'success' => false,
                'message' => $errorMessage,
                'errors' => ActiveForm::validate($model)
            ];
        }
        throw new BadRequestHttpException(Yii::t('app', 'Invalid request'));
    }
}