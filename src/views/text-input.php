<?php

/* @var $queryModel QueryModel */
/* @var $formOptions array */
/* @var $selectOptions array */
/* @var $inputOptions array */
/* @var $form ActiveForm */

/* @var $this View */

use app\models\support\QueryModel;
use samuelelonghin\form\ActiveForm;
use yii\web\View;

?>

<?= $form->field($queryModel, 'query', $inputOptions)->textInput() ?>
