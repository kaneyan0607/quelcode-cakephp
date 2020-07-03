<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bidrequest Entity
 *
 * @property int $id
 * @property int $biditem_id
 * @property int $user_id
 * @property int $price
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Biditem $biditem
 * @property \App\Model\Entity\User $user
 */
class Bidrequest extends Entity
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
        'biditem_id' => true,
        'user_id' => true,
        'price' => true,
        'created' => true,
        'biditem' => true,
        'user' => true,
    ];
}
