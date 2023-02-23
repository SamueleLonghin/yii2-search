<?php

/* @var $queryModel QueryModel */
/* @var $formOptions array */
/* @var $selectOptions array */
/* @var $inputOptions array */
/* @var $form ActiveForm */

/* @var $this View */

use app\models\support\QueryModel;
use kartik\select2\Select2;
use samuelelonghin\form\ActiveForm;
use yii\web\View;

?>

<?= $form->field($queryModel, 'query', $inputOptions)->widget(Select2::class, $selectOptions) ?>
