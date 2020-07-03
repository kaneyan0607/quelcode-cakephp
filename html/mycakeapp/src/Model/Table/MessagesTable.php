<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MessagesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setDisplayField('message');
        $this->belongsTo('People');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->integer('person_id', 'person idは整数で入力下さい。')
            ->notEmpty('person_id', 'person idは必ず記入下さい。');

        $validator
            ->scalar('message', 'テキストを入力下さい。')
            ->requirePresence('message', 'create')
            ->notEmpty('message', 'メッセージは必ず記入して下さい。');

        return $validator;
    }
}
