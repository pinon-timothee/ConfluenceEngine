<?php

namespace CE\Model\Map;

use CE\Model\WebsiteRouting;
use CE\Model\WebsiteRoutingQuery;
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
 * This class defines the structure of the 'website_routing' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WebsiteRoutingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.CE.Model.Map.WebsiteRoutingTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'website_routing';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CE\\Model\\WebsiteRouting';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.CE.Model.WebsiteRouting';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'website_routing.id';

    /**
     * the column name for the website_id field
     */
    const COL_WEBSITE_ID = 'website_routing.website_id';

    /**
     * the column name for the comment field
     */
    const COL_COMMENT = 'website_routing.comment';

    /**
     * the column name for the tags field
     */
    const COL_TAGS = 'website_routing.tags';

    /**
     * the column name for the enable field
     */
    const COL_ENABLE = 'website_routing.enable';

    /**
     * the column name for the page field
     */
    const COL_PAGE = 'website_routing.page';

    /**
     * the column name for the javascript field
     */
    const COL_JAVASCRIPT = 'website_routing.javascript';

    /**
     * the column name for the stylesheet field
     */
    const COL_STYLESHEET = 'website_routing.stylesheet';

    /**
     * the column name for the controller field
     */
    const COL_CONTROLLER = 'website_routing.controller';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'website_routing.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'website_routing.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // i18n behavior

    /**
     * The default locale to use for translations.
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'WebsiteId', 'Comment', 'Tags', 'Enable', 'Page', 'Javascript', 'Stylesheet', 'Controller', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'websiteId', 'comment', 'tags', 'enable', 'page', 'javascript', 'stylesheet', 'controller', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(WebsiteRoutingTableMap::COL_ID, WebsiteRoutingTableMap::COL_WEBSITE_ID, WebsiteRoutingTableMap::COL_COMMENT, WebsiteRoutingTableMap::COL_TAGS, WebsiteRoutingTableMap::COL_ENABLE, WebsiteRoutingTableMap::COL_PAGE, WebsiteRoutingTableMap::COL_JAVASCRIPT, WebsiteRoutingTableMap::COL_STYLESHEET, WebsiteRoutingTableMap::COL_CONTROLLER, WebsiteRoutingTableMap::COL_CREATED_AT, WebsiteRoutingTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'website_id', 'comment', 'tags', 'enable', 'page', 'javascript', 'stylesheet', 'controller', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'WebsiteId' => 1, 'Comment' => 2, 'Tags' => 3, 'Enable' => 4, 'Page' => 5, 'Javascript' => 6, 'Stylesheet' => 7, 'Controller' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'websiteId' => 1, 'comment' => 2, 'tags' => 3, 'enable' => 4, 'page' => 5, 'javascript' => 6, 'stylesheet' => 7, 'controller' => 8, 'createdAt' => 9, 'updatedAt' => 10, ),
        self::TYPE_COLNAME       => array(WebsiteRoutingTableMap::COL_ID => 0, WebsiteRoutingTableMap::COL_WEBSITE_ID => 1, WebsiteRoutingTableMap::COL_COMMENT => 2, WebsiteRoutingTableMap::COL_TAGS => 3, WebsiteRoutingTableMap::COL_ENABLE => 4, WebsiteRoutingTableMap::COL_PAGE => 5, WebsiteRoutingTableMap::COL_JAVASCRIPT => 6, WebsiteRoutingTableMap::COL_STYLESHEET => 7, WebsiteRoutingTableMap::COL_CONTROLLER => 8, WebsiteRoutingTableMap::COL_CREATED_AT => 9, WebsiteRoutingTableMap::COL_UPDATED_AT => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'website_id' => 1, 'comment' => 2, 'tags' => 3, 'enable' => 4, 'page' => 5, 'javascript' => 6, 'stylesheet' => 7, 'controller' => 8, 'created_at' => 9, 'updated_at' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('website_routing');
        $this->setPhpName('WebsiteRouting');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CE\\Model\\WebsiteRouting');
        $this->setPackage('src.CE.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('website_id', 'WebsiteId', 'INTEGER', 'website', 'id', true, null, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, 255, null);
        $this->addColumn('enable', 'Enable', 'BOOLEAN', true, 1, true);
        $this->addColumn('page', 'Page', 'VARCHAR', true, 255, null);
        $this->addColumn('javascript', 'Javascript', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stylesheet', 'Stylesheet', 'LONGVARCHAR', false, null, null);
        $this->addColumn('controller', 'Controller', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('Meta', '\\CE\\Model\\Meta', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Metas', false);
        $this->addRelation('WebsiteRedirection', '\\CE\\Model\\WebsiteRedirection', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteRedirections', false);
        $this->addRelation('WebsiteRoutingI18n', '\\CE\\Model\\WebsiteRoutingI18n', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteRoutingI18ns', false);
        $this->addRelation('WebsiteRoutingPath', '\\CE\\Model\\WebsiteRoutingPath', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteRoutingPaths', false);
        $this->addRelation('WebsiteRoutingParameter', '\\CE\\Model\\WebsiteRoutingParameter', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteRoutingParameters', false);
        $this->addRelation('WebsiteModuleLocation', '\\CE\\Model\\WebsiteModuleLocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteModuleLocations', false);
        $this->addRelation('WebsiteZone', '\\CE\\Model\\WebsiteZone', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_routing_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteZones', false);
        $this->addRelation('WebsiteModule', '\\CE\\Model\\WebsiteModule', RelationMap::MANY_TO_MANY, array(), 'CASCADE', 'CASCADE', 'WebsiteModules');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'name, title, description', 'i18n_pk_column' => '', 'locale_column' => 'culture', 'locale_length' => '5', 'default_locale' => '', 'locale_alias' => '', ),
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to website_routing     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        MetaTableMap::clearInstancePool();
        WebsiteRedirectionTableMap::clearInstancePool();
        WebsiteRoutingI18nTableMap::clearInstancePool();
        WebsiteRoutingPathTableMap::clearInstancePool();
        WebsiteRoutingParameterTableMap::clearInstancePool();
        WebsiteModuleLocationTableMap::clearInstancePool();
        WebsiteZoneTableMap::clearInstancePool();
    }

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
        return $withPrefix ? WebsiteRoutingTableMap::CLASS_DEFAULT : WebsiteRoutingTableMap::OM_CLASS;
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
     * @return array           (WebsiteRouting object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WebsiteRoutingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WebsiteRoutingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WebsiteRoutingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WebsiteRoutingTableMap::OM_CLASS;
            /** @var WebsiteRouting $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WebsiteRoutingTableMap::addInstanceToPool($obj, $key);
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
            $key = WebsiteRoutingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WebsiteRoutingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WebsiteRouting $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WebsiteRoutingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_ID);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_WEBSITE_ID);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_COMMENT);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_TAGS);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_ENABLE);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_PAGE);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_JAVASCRIPT);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_STYLESHEET);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_CONTROLLER);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WebsiteRoutingTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.website_id');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.enable');
            $criteria->addSelectColumn($alias . '.page');
            $criteria->addSelectColumn($alias . '.javascript');
            $criteria->addSelectColumn($alias . '.stylesheet');
            $criteria->addSelectColumn($alias . '.controller');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(WebsiteRoutingTableMap::DATABASE_NAME)->getTable(WebsiteRoutingTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WebsiteRoutingTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WebsiteRoutingTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WebsiteRoutingTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WebsiteRouting or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WebsiteRouting object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CE\Model\WebsiteRouting) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WebsiteRoutingTableMap::DATABASE_NAME);
            $criteria->add(WebsiteRoutingTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = WebsiteRoutingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WebsiteRoutingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WebsiteRoutingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the website_routing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WebsiteRoutingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WebsiteRouting or Criteria object.
     *
     * @param mixed               $criteria Criteria or WebsiteRouting object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WebsiteRouting object
        }

        if ($criteria->containsKey(WebsiteRoutingTableMap::COL_ID) && $criteria->keyContainsValue(WebsiteRoutingTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WebsiteRoutingTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = WebsiteRoutingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WebsiteRoutingTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WebsiteRoutingTableMap::buildTableMap();
