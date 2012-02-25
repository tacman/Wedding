<?php

namespace Acme\MovieBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'producers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Acme.MovieBundle.Model.map
 */
class ProducerTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'src.Acme.MovieBundle.Model.map.ProducerTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('producers');
		$this->setPhpName('Producer');
		$this->setClassname('Acme\\MovieBundle\\Model\\Producer');
		$this->setPackage('src.Acme.MovieBundle.Model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->getColumn('NAME', false)->setPrimaryString(true);
		$this->addColumn('IS_PUBLISHED', 'IsPublished', 'BOOLEAN', false, 1, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Movie', 'Acme\\MovieBundle\\Model\\Movie', RelationMap::ONE_TO_MANY, array('id' => 'producer_id', ), 'CASCADE', 'CASCADE', 'Movies');
	} // buildRelations()

} // ProducerTableMap
