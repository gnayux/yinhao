<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Supplier;

class MyController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * 报表页面
     */
    public function actionTable()
    {
        $searchModel = new Supplier();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('myview', [
            'provider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * 导出页面
     */
    public function actionExport()
    {
        return $this->render('export', []);
    }

    /**
     * 导出csv
     */
    public function actionExportcsv()
    {
        $fields = Yii::$app->request->post('csvfield');
        $file = '';
        $Supplier = new Supplier();
        $query = $Supplier->getQuery(Yii::$app->request->get());
        $data = $query->select($fields)->all();
        $attrs = $Supplier->attributeLabels();
        //表头
        foreach ($fields as $field) {
            $file .= $attrs[$field] . ',';
        }
        $file = trim($file, ',') . PHP_EOL;
        //数据
        foreach ($data as $item) {
            foreach ($fields as $field) {
                $file .= $item->$field . ',';
            }
            $file = trim($file, ',') . PHP_EOL;
        }
        header("Content-Type: text/csv; charset=utf-8");
        header('Content-Disposition: attachment; filename="file_' . date('YmdHis') . '.csv"');
        echo $file;
        exit();
    }
}
