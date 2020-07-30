<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evaluation Entity
 *
 * @property int $id
 * @property int $receive_evaluation_user_id
 * @property int $evaluation_user_id
 * @property int $bidinfo_id
 * @property string $comment
 * @property bool $evaluation
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\ReceiveEvaluationUser $receive_evaluation_user
 * @property \App\Model\Entity\EvaluationUser $evaluation_user
 * @property \App\Model\Entity\Bidinfo $bidinfo
 */
class Evaluation extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'receive_evaluation_user_id' => true,
        'evaluation_user_id' => true,
        'bidinfo_id' => true,
        'comment' => true,
        'evaluation' => true,
        'created' => true,
        'receive_evaluation_user' => true,
        'evaluation_user' => true,
        'bidinfo' => true,
    ];
}
