<?php


namespace samuelelonghin\db\search;

class AjaxSearchBar extends SearchBar
{

	public string $inputView = 'ajax-select';
	public string $queryUrl;

	public function init()
	{
		$this->selectOptions = [
			'options' => [
				'id' => 'user_id',
				'class' => 'kartik2',
				'title' => 'User',
			],
			'pluginOptions' => [
				'ajax' => [
					'url' => $this->queryUrl,
					'dataType' => 'json',
				],
				'allowClear' => true,
				'minimumInputLength' => 2,
			],
			'pluginEvents' => [
				"change" => "function() { $(this).parents('form').submit() }",
			]
		];
		parent::init();
	}


}