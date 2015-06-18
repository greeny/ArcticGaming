<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Entities;

/**
 * @property-read int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property Team[] $teams m:belongsToMany
 */
class Game extends BaseEntity
{

}
