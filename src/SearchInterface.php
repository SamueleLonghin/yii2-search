<?php

namespace samuelelonghin\db\search;


use yii\data\ActiveDataProvider;
use samuelelonghin\db\ActiveQuery;

interface SearchInterface
{
    public function generateSQL($params = null, $baseActiveQuery = null): ?ActiveQuery;

    public function fromQuery($query, $baseActiveQuery = null): ?ActiveQuery;

    public function search($params = null, $baseActiveQuery = null): ActiveDataProvider;

    public function load($params);

    public function initBaseFilters();

    function initBaseQuery(&$baseActiveQuery): ?ActiveQuery;

    public function getRecursiveModels(): array;
}