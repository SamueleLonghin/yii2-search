<?php


namespace samuelelonghin\db\search;


use samuelelonghin\db\ActiveQuery;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class QuerySearchModel extends Model implements SearchInterface
{
    use SearchTrait;
    public ?Model $filterModel = null;
    public ?string $query = null;
    public bool $ignoreTags = false;


    public function rules(): array
    {
        return [
            [['query'], 'string']
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'query' => Yii::t('samuelelonghin/search', 'Digita qualcosa per ricercare')
        ];
    }

    public function generateSQL($params = null, $baseActiveQuery = null): ?ActiveQuery
    {
        if (str_contains($this->query, '-')) {
            $this->query = substr($this->query, 0, strpos($this->query, '-'));
        }
        if ($this->filterModel instanceof SearchInterface) {
            $this->filterModel->load($params);
            if ($this->load($params) || $this->query) {
                $baseActiveQuery = $this->filterModel->fromQuery($this->query, $baseActiveQuery);
            }
            return $this->filterModel->generateSQL($params, $baseActiveQuery);
        }
        return null;
    }

    public function search($params = null, $baseActiveQuery = null): ActiveDataProvider
    {
        $pagination = self::getPagination(Yii::$app->request->get());
        return new ActiveDataProvider([
            'pagination' => $pagination,
            'query' => $this->generateSQL($params, $baseActiveQuery)
        ]);

    }


    public static function getPagination($request_params): array
    {
        $param_val = 'page';
        foreach ($request_params as $key => $value) {
            if (str_contains($key, '_tog')) {
                $param_val = $value;
            }
        }
        $pagination = array();
        if ($param_val == 'all') { //returns empty array, which will show all data.
            $pagination = ['pageSize' => 500];
            return $pagination;
        } else if ($param_val == 'page') { //return pageSize as 5
//			$pagination = ['pageSize' => 5];
            return $pagination;
        }
        return $pagination;  // returns empty array again.
    }

    function initBaseFilters()
    {
        // TODO: Implement initBaseFilters() method.
    }
}