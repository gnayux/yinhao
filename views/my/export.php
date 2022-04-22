<?php

use app\assets\AppAsset;
use app\models\Supplier;
use yii\bootstrap4\Html;

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
            <form action="/my/exportcsv?<?= $_SERVER["QUERY_STRING"] ?>" method="post">
                <label>请选择需要导出的字段：</label><br>
                <?php
                $fields = Supplier::getExportFields();
                foreach ($fields as $k => $v) {
                    echo '<label>' . $v . '：<input type="checkbox" name="csvfield[]" value="' . $k . '" ';
                    if ($v == 'id') {
                        echo 'onclick="return false;" ';
                    }
                    echo 'checked="checked"></label><br>';
                }
                ?>
                <br>
                <input type="submit" value="确定">
            </form>
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