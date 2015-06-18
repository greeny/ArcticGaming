<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Entities;

/**
 * @property-read int $id
 * @property Tournament|NULL $tournament m:hasOne
 * @property Team $team m:hasOne
 * @property Opponent $opponent m:hasOne
 * @property int $start
 * @property int|NULL $resultHome
 * @property int|NULL $resultOpponent
 */
class Match extends BaseEntity
{

}
