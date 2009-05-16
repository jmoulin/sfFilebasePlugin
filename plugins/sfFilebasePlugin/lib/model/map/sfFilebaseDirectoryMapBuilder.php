<?php


/**
 * This class adds structure of 'sf_filebase_directories' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Sat May 16 21:42:36 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfFilebasePlugin.lib.model.map
 */
class sfFilebaseDirectoryMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfFilebasePlugin.lib.model.map.sfFilebaseDirectoryMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(sfFilebaseDirectoryPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(sfFilebaseDirectoryPeer::TABLE_NAME);
		$tMap->setPhpName('sfFilebaseDirectory');
		$tMap->setClassname('sfFilebaseDirectory');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('SF_FILEBASE_FILES_ID', 'SfFilebaseFilesId', 'INTEGER', 'sf_filebase_files', 'ID', false, 11);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

	} // doBuild()

} // sfFilebaseDirectoryMapBuilder
