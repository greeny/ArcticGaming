<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Entities;

/**
 * @property-read int $id
 * @property Team $team m:hasOne
 * @property User $user m:hasOne
 * @property string $firstName
 * @property string $nick
 * @property string $lastName
 * @property string $role
 * @property int $order
 */
class TeamUser extends BaseEntity
{

}
