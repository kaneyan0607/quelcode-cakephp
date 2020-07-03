<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;

class PeopleTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setDisplayField('name');
        $this->hasMany('Messages');
    }

    public function findMe(Query $query, array $options)
    {
        $me = $options['me'];
        return $query->where(['name like' => '%' . $me . '%'])
            ->orWhere(['mail like' => '%' . $me . '%'])
            ->order(['age' => 'asc']);
    }

    public function findByAge(Query $query, array $options)
    {
        return $query->order(['age' => 'asc'])->order(['name' => 'asc']);
    }
}
