<?php

namespace common\components\actions;

use Yii;
use yii\base\InvalidConfigException;

class SearchAction extends Action
{
    public $modelClass = null;
    public $searchModel = null;
    public $view = 'index';

    public function init()
    {
        parent::init();

        $this->modelClass = $this->modelClass ?: $this->controller->modelClass;
    }

    /**
     * @return mixed
     * @throws InvalidConfigException
     */
    public function run()
    {
        $class = $this->modelClass;
        $searchClass = $this->searchModel;

        if (empty($searchClass)) {
            throw new InvalidConfigException('Action must have searchClass property defined.');
        }

        if (empty($class)) {
            throw new InvalidConfigException('Controller must have modelClass property defined.');
        }

        $searchModel = new $searchClass();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render($this->view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}