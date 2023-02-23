<?php
namespace samuelelonghin\db\search;


use yii\data\ActiveDataProvider;
use samuelelonghin\db\ActiveQuery;

trait SearchTrait
{
    /**
     * If true search recoursively on models
     */
	public bool $recursive = true;

	public array $and_filters = ['and'];
	public array $or_filters = ['or'];
	protected ?ActiveQuery $_baseQuery = null;

    abstract function initBaseFilters();

	public function search($params = null, $baseActiveQuery = null): ActiveDataProvider
	{
		return new ActiveDataProvider([
			'query' => $this->generateSQL($params, $baseActiveQuery),
		]);
	}

	/**
	 * @param null $baseActiveQuery
	 * @return ActiveQuery|null
	 */
	public function initBaseQuery(&$baseActiveQuery = null): ?ActiveQuery
	{
		$hasNewQuery = (bool)$baseActiveQuery;
		if (!$hasNewQuery)
			$baseActiveQuery = $this->_baseQuery;
		if (!$baseActiveQuery || !$baseActiveQuery instanceof self::$QUERY_CLASS)
			$baseActiveQuery = parent::find();
		if (!$hasNewQuery)
			$this->_baseQuery = $baseActiveQuery;
		return $baseActiveQuery;
	}

    /**
	 * @param $query
	 * @param null $baseActiveQuery
	 * @return ActiveQuery|null
	 */
	public function fromQuery($query, $baseActiveQuery = null): ?ActiveQuery
	{
        $this->initBaseQuery($baseActiveQuery);

        $filters = $this->or_filters;

        $filters = array_merge($filters, $this->getRecursiveModels());

        return $baseActiveQuery->andFilterWhere($filters);
    }
    

	public function generateSQL($params = null, $baseActiveQuery = null): ?ActiveQuery
	{
		$this->initBaseQuery($baseActiveQuery);

		if ($this->load($params)) {
			$this->initBaseFilters();
			$baseActiveQuery->andFilterWhere($this->and_filters);
			$baseActiveQuery->orFilterWhere($this->or_filters);
		}
		return $baseActiveQuery;
	}

    public function getRecursiveModels(): array
    {
        return [];
    }
}