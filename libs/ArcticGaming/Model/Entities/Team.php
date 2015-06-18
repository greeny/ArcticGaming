<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Entities;


/**
 * @property-read int $id
 * @property string $name
 * @property Game $game m:hasOne
 * @property TeamUser[] $members m:belongsToMany m:filter(orderMembers)
 */
class Team extends BaseEntity
{

}
