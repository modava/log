<?php

namespace modava\log\controllers;

use backend\components\MyComponent;
use modava\log\components\MyLogController;
use modava\log\models\search\Voip24hLogSearch;

class Voip24hLogController extends MyLogController
{
    public function init()
    {
        /* If don't have class CallCenter => redirect to index */
        if (!class_exists('\modava\voip24h\CallCenter')) return $this->redirect(['/site/index']);
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
        $searchModel = new Voip24hLogSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $totalPage = $this->getTotalPage($dataProvider);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalPage'    => $totalPage,
        ]);
    }

    /**
     * @param $perpage
     */
    public function actionPerpage($perpage)
    {
        MyComponent::setCookies('pageSize', $perpage);
    }

    /**
     * @param $dataProvider
     * @return float|int
     */
    public function getTotalPage($dataProvider)
    {
        if (MyComponent::hasCookies('pageSize')) {
            $dataProvider->pagination->pageSize = MyComponent::getCookies('pageSize');
        } else {
            $dataProvider->pagination->pageSize = 10;
        }

        $pageSize = $dataProvider->pagination->pageSize;
        $totalCount = $dataProvider->totalCount;
        $totalPage = (($totalCount + $pageSize - 1) / $pageSize);

        return $totalPage;
    }
}