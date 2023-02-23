<?php

use app\models\support\QueryModel;
use kartik\select2\Select2;
use samuelelonghin\form\FloatingActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;


/* @var $queryModel QueryModel */
/* @var $formOptions array */
/* @var $selectOptions array */
/* @var $inputView string */
/* @var $inputOptions array */
/* @var $this View */


?>
<?php $form = FloatingActiveForm::begin($formOptions) ?>
    <div class="row g-0">
        <div class="col pr-0 form-control-addon">
			<?= $this->render($inputView, [
				'form' => $form,
				'inputOptions' => $inputOptions,
				'selectOptions' => $selectOptions,
				'queryModel' => $queryModel
			]) ?>
        </div>
        <div class="col-auto form-floating pl-0">
			<?= Html::input('submit', null, Yii::t('app', 'Search'), [
				'class' => 'my-3 form-control form-addon align-middle p-auto btn-outline-primary'
			]) ?>
        </div>
    </div>
<?php FloatingActiveForm::end(); ?>