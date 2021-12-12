<?php

namespace common\components\actions;
use Yii;

/**
 * Class ViewAction
 *
 */
class ViewAction extends ItemAction
{
    /**
     * @var string the name of the view action.
     */
    public $view = 'view';

    /**
     * @var string the name of the view action.
     */
    public $ajaxView = 'view_modal';

    /**
     * @param string $id
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess($model);

        $params = $this->resolveParams(['model' => $model], $model);

        return $this->render($params);
    }

    private function render(array $params = [])
    {
        $view = Yii::$app->request->getIsAjax() ? $this->ajaxView : $this->view;

        return $this->controller->renderAjaxConditional($view, $params);
    }
}
