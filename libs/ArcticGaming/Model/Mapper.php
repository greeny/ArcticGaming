<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model;

use LeanMapper\DefaultMapper;
use LeanMapper\Exception\InvalidStateException;
use LeanMapper\Row;


class Mapper extends DefaultMapper
{

	protected $defaultEntityNamespace = '\\ArcticGaming\\Model\\Entities\\';

	public function getTable($entityClass)
	{
		return $this->toUnderScore($this->trimNamespace($entityClass));
	}

	public function getEntityClass($table, Row $row = NULL)
	{
		return $this->defaultEntityNamespace . ucfirst($this->toCamelCase($table));
	}

	public function getColumn($entityClass, $field)
	{
		return $this->toUnderScore($field);
	}

	public function getEntityField($table, $column)
	{
		return $this->toCamelCase($column);
	}

	public function getTableByRepositoryClass($repositoryClass)
	{
		$matches = [];
		if (preg_match('#([a-z0-9]+)repository$#i', $repositoryClass, $matches)) {
			return $this->toUnderScore($matches[1]);
		}
		throw new InvalidStateException('Cannot determine table name.');
	}

	private function toUnderScore($str)
	{
		return lcfirst(preg_replace_callback('#(?<=.)([A-Z])#', function ($m) {
			return '_' . strtolower($m[1]);
		}, $str));
	}

	private function toCamelCase($str)
	{
		return preg_replace_callback('#_(.)#', function ($m) {
			return strtoupper($m[1]);
		}, $str);
	}

}
