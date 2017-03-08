<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VueloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vuelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vuelo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id_vuelo',
            'origen.id_aero',
            'destino.id_aero',
            'compania.den_comp',
            'salida:datetime',
            'llegada:datetime',
            'plazas',
            'disponibles',
            'precio',
            [
                'label' => 'Reservar',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(
                        'Reservar',
                        ['reservas/crear', 'vuelo_id' => $model->id],
                        ['class' => 'btn-sm btn-primary']
                    );
                },
                'format' => 'html',
            ],
        ],
    ]); ?>
</div>
