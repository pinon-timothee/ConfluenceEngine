<?php

namespace CE\Model\Map;

use CE\Model\WebsiteRedirection;
use CE\Model\WebsiteRedirectionQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'website_redirection' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WebsiteRedirectionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.CE.Model.Map.WebsiteRedirectionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'website_redirection';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CE\\Model\\WebsiteRedirection';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.CE.Model.WebsiteRedirection';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'website_redirection.id';

    /**
     * the column name for the website_id field
     */
    const COL_WEBSITE_ID = 'website_redirection.website_id';

    /**
     * the column name for the path field
     */
    const COL_PATH = 'website_redirection.path';

    /**
     * the column name for the website_routing_id field
     */
    const COL_WEBSITE_ROUTING_ID = 'website_redirection.website_routing_id';

    /**
     * the column name for the culture field
     */
    const COL_CULTURE = 'website_redirection.culture';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'website_redirection.code';

    /**
     * the column name for the enable field
     */
    const COL_ENABLE = 'website_redirection.enable';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'WebsiteId', 'Path', 'WebsiteRoutingId', 'Culture', 'Code', 'Enable', ),
        self::TYPE_CAMELNAME     => array('id', 'websiteId', 'path', 'websiteRoutingId', 'culture', 'code', 'enable', ),
        self::TYPE_COLNAME       => array(WebsiteRedirectionTableMap::COL_ID, WebsiteRedirectionTableMap::COL_WEBSITE_ID, WebsiteRedirectionTableMap::COL_PATH, WebsiteRedirectionTableMap::COL_WEBSITE_ROUTING_ID, WebsiteRedirectionTableMap::COL_CULTURE, WebsiteRedirectionTableMap::COL_CODE, WebsiteRedirectionTableMap::COL_ENABLE, ),
        self::TYPE_FIELDNAME     => array('id', 'website_id', 'path', 'website_routing_id', 'culture', 'code', 'enable', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'WebsiteId' => 1, 'Path' => 2, 'WebsiteRoutingId' => 3, 'Culture' => 4, 'Code' => 5, 'Enable' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'websiteId' => 1, 'path' => 2, 'websiteRoutingId' => 3, 'culture' => 4, 'code' => 5, 'enable' => 6, ),
        self::TYPE_COLNAME       => array(WebsiteRedirectionTableMap::COL_ID => 0, WebsiteRedirectionTableMap::COL_WEBSITE_ID => 1, WebsiteRedirectionTableMap::COL_PATH => 2, WebsiteRedirectionTableMap::COL_WEBSITE_ROUTING_ID => 3, WebsiteRedirectionTableMap::COL_CULTURE => 4, WebsiteRedirectionTableMap::COL_CODE => 5, WebsiteRedirectionTableMap::COL_ENABLE => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'website_id' => 1, 'path' => 2, 'website_routing_id' => 3, 'culture' => 4, 'code' => 5, 'enable' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('website_redirection');
        $this->setPhpName('WebsiteRedirection');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CE\\Model\\WebsiteRedirection');
        $this->setPackage('src.CE.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('website_id', 'WebsiteId', 'INTEGER', 'website', 'id', true, null, null);
        $this->addColumn('path', 'Path', 'VARCHAR', true, 255, null);
        $this->addForeignKey('website_routing_id', 'WebsiteRoutingId', 'INTEGER', 'website_routing', 'id', true, null, null);
        $this->addColumn('culture', 'Culture', 'VARCHAR', true, 5, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 3, '301');
        $this->addColumn('enable', 'Enable', 'BOOLEAN', true, 1, true);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Website', '\\CE\\Model\\Website', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('WebsiteRouting', '\\CE\\Model\\WebsiteRouting', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? WebsiteRedirectionTableMap::CLASS_DEFAULT : WebsiteRedirectionTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (WebsiteRedirection object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WebsiteRedirectionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WebsiteRedirectionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WebsiteRedirectionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WebsiteRedirectionTableMap::OM_CLASS;
            /** @var WebsiteRedirection $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WebsiteRedirectionTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = WebsiteRedirectionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WebsiteRedirectionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WebsiteRedirection $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WebsiteRedirectionTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_ID);
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_WEBSITE_ID);
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_PATH);
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_WEBSITE_ROUTING_ID);
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_CULTURE);
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_CODE);
            $criteria->addSelectColumn(WebsiteRedirectionTableMap::COL_ENABLE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.website_id');
            $criteria->addSelectColumn($alias . '.path');
            $criteria->addSelectColumn($alias . '.website_routing_id');
            $criteria->addSelectColumn($alias . '.culture');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.enable');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(WebsiteRedirectionTableMap::DATABASE_NAME)->getTable(WebsiteRedirectionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WebsiteRedirectionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WebsiteRedirectionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WebsiteRedirectionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WebsiteRedirection or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WebsiteRedirection object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRedirectionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CE\Model\WebsiteRedirection) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WebsiteRedirectionTableMap::DATABASE_NAME);
            $criteria->add(WebsiteRedirectionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = WebsiteRedirectionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WebsiteRedirectionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WebsiteRedirectionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the website_redirection table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WebsiteRedirectionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WebsiteRedirection or Criteria object.
     *
     * @param mixed               $criteria Criteria or WebsiteRedirection object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRedirectionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WebsiteRedirection object
        }

        if ($criteria->containsKey(WebsiteRedirectionTableMap::COL_ID) && $criteria->keyContainsValue(WebsiteRedirectionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WebsiteRedirectionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = WebsiteRedirectionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WebsiteRedirectionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WebsiteRedirectionTableMap::buildTableMap();
