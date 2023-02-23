<?php


namespace samuelelonghin\db\search;


use yii\base\Model;
use yii\bootstrap5\Widget;

class SearchBar extends Widget
{
	public ?Model $queryModel = null;
	public ?array $formOptions = ['method' => 'get'];
	public ?array $selectOptions = [];
	public ?array $inputOptions = ['enableClientValidation' => false];
	public string $inputView = 'text-input';

	public function run(): string
	{
		return $this->render('search-bar', [
			'inputOptions' => $this->inputOptions,
			'formOptions' => $this->formOptions,
			'selectOptions' => $this->selectOptions,
			'queryModel' => $this->queryModel,
			'inputView' => $this->inputView,
		]);
	}

}