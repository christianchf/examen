<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Reserva */

$this->title = 'Crear reserva del vuelo ' . $vuelo;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="reserva-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'asiento')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Reservar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
