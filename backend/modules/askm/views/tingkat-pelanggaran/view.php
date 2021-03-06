<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\TingkatPelanggaran */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tingkat Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="tingkat-pelanggaran-view">

    <div class="pull-right">
        <p>
            <?= Html::a('<i class="fa fa-pencil"></i> Edit', ['edit', 'id' => $model->tingkat_id], ['class' => 'btn btn-default btn-flat btn-set btn-sm']) ?>
        </p>
    </div>

    <h1>Pelanggaran <?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'name',
                'label' => 'Nama',
                'value' => $model->name,
            ],
            [
                'attribute' => 'desc',
                'label' => 'Keterangan',
                'value' => $model->desc,
            ],

        ],
    ]) ?>

</div>
