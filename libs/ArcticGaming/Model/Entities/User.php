<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Entities;

/**
 * @property-read int $id
 * @property string $nick
 * @property string $password
 * @property string $email
 * @property string $role
 * @property TeamUser[] $teams m:belongsToMany
 */
class User extends BaseEntity
{

}
