<?php

use app\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\grid\GridView;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>

    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?php
            echo GridView::widget([
                'dataProvider' => $provider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                    ],
                    [
                        'attribute' => 'id',
                    ],
                    [
                        'attribute' => 'name',
                    ],
                    [
                        'attribute' => 'code',
                    ],
                    [
                        'attribute' => 't_status',
                        'filter' => $searchModel->getStatusEnum(),
                    ],
                ],
            ]);
            ?>
            <input type="button" value="导出全部结果" onclick="window.location.href = '/my/export?<?= $_SERVER["QUERY_STRING"] ?>'">
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>