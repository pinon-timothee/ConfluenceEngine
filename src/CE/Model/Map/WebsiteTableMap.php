<?php

namespace CE\Model\Map;

use CE\Model\Website;
use CE\Model\WebsiteQuery;
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
 * This class defines the structure of the 'website' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WebsiteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.CE.Model.Map.WebsiteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'website';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CE\\Model\\Website';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.CE.Model.Website';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'website.id';

    /**
     * the column name for the account_id field
     */
    const COL_ACCOUNT_ID = 'website.account_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'website.name';

    /**
     * the column name for the step_id field
     */
    const COL_STEP_ID = 'website.step_id';

    /**
     * the column name for the template field
     */
    const COL_TEMPLATE = 'website.template';

    /**
     * the column name for the logo field
     */
    const COL_LOGO = 'website.logo';

    /**
     * the column name for the favicon field
     */
    const COL_FAVICON = 'website.favicon';

    /**
     * the column name for the javascript field
     */
    const COL_JAVASCRIPT = 'website.javascript';

    /**
     * the column name for the stylesheet field
     */
    const COL_STYLESHEET = 'website.stylesheet';

    /**
     * the column name for the max_upload field
     */
    const COL_MAX_UPLOAD = 'website.max_upload';

    /**
     * the column name for the currency field
     */
    const COL_CURRENCY = 'website.currency';

    /**
     * the column name for the meta_auto field
     */
    const COL_META_AUTO = 'website.meta_auto';

    /**
     * the column name for the ssl field
     */
    const COL_SSL = 'website.ssl';

    /**
     * the column name for the duplicable field
     */
    const COL_DUPLICABLE = 'website.duplicable';

    /**
     * the column name for the wrapper field
     */
    const COL_WRAPPER = 'website.wrapper';

    /**
     * the column name for the wrapper_params field
     */
    const COL_WRAPPER_PARAMS = 'website.wrapper_params';

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
        self::TYPE_PHPNAME       => array('Id', 'AccountId', 'Name', 'StepId', 'Template', 'Logo', 'Favicon', 'Javascript', 'Stylesheet', 'MaxUpload', 'Currency', 'MetaAuto', 'Ssl', 'Duplicable', 'Wrapper', 'WrapperParams', ),
        self::TYPE_CAMELNAME     => array('id', 'accountId', 'name', 'stepId', 'template', 'logo', 'favicon', 'javascript', 'stylesheet', 'maxUpload', 'currency', 'metaAuto', 'ssl', 'duplicable', 'wrapper', 'wrapperParams', ),
        self::TYPE_COLNAME       => array(WebsiteTableMap::COL_ID, WebsiteTableMap::COL_ACCOUNT_ID, WebsiteTableMap::COL_NAME, WebsiteTableMap::COL_STEP_ID, WebsiteTableMap::COL_TEMPLATE, WebsiteTableMap::COL_LOGO, WebsiteTableMap::COL_FAVICON, WebsiteTableMap::COL_JAVASCRIPT, WebsiteTableMap::COL_STYLESHEET, WebsiteTableMap::COL_MAX_UPLOAD, WebsiteTableMap::COL_CURRENCY, WebsiteTableMap::COL_META_AUTO, WebsiteTableMap::COL_SSL, WebsiteTableMap::COL_DUPLICABLE, WebsiteTableMap::COL_WRAPPER, WebsiteTableMap::COL_WRAPPER_PARAMS, ),
        self::TYPE_FIELDNAME     => array('id', 'account_id', 'name', 'step_id', 'template', 'logo', 'favicon', 'javascript', 'stylesheet', 'max_upload', 'currency', 'meta_auto', 'ssl', 'duplicable', 'wrapper', 'wrapper_params', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AccountId' => 1, 'Name' => 2, 'StepId' => 3, 'Template' => 4, 'Logo' => 5, 'Favicon' => 6, 'Javascript' => 7, 'Stylesheet' => 8, 'MaxUpload' => 9, 'Currency' => 10, 'MetaAuto' => 11, 'Ssl' => 12, 'Duplicable' => 13, 'Wrapper' => 14, 'WrapperParams' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'accountId' => 1, 'name' => 2, 'stepId' => 3, 'template' => 4, 'logo' => 5, 'favicon' => 6, 'javascript' => 7, 'stylesheet' => 8, 'maxUpload' => 9, 'currency' => 10, 'metaAuto' => 11, 'ssl' => 12, 'duplicable' => 13, 'wrapper' => 14, 'wrapperParams' => 15, ),
        self::TYPE_COLNAME       => array(WebsiteTableMap::COL_ID => 0, WebsiteTableMap::COL_ACCOUNT_ID => 1, WebsiteTableMap::COL_NAME => 2, WebsiteTableMap::COL_STEP_ID => 3, WebsiteTableMap::COL_TEMPLATE => 4, WebsiteTableMap::COL_LOGO => 5, WebsiteTableMap::COL_FAVICON => 6, WebsiteTableMap::COL_JAVASCRIPT => 7, WebsiteTableMap::COL_STYLESHEET => 8, WebsiteTableMap::COL_MAX_UPLOAD => 9, WebsiteTableMap::COL_CURRENCY => 10, WebsiteTableMap::COL_META_AUTO => 11, WebsiteTableMap::COL_SSL => 12, WebsiteTableMap::COL_DUPLICABLE => 13, WebsiteTableMap::COL_WRAPPER => 14, WebsiteTableMap::COL_WRAPPER_PARAMS => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'account_id' => 1, 'name' => 2, 'step_id' => 3, 'template' => 4, 'logo' => 5, 'favicon' => 6, 'javascript' => 7, 'stylesheet' => 8, 'max_upload' => 9, 'currency' => 10, 'meta_auto' => 11, 'ssl' => 12, 'duplicable' => 13, 'wrapper' => 14, 'wrapper_params' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('website');
        $this->setPhpName('Website');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CE\\Model\\Website');
        $this->setPackage('src.CE.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('account_id', 'AccountId', 'INTEGER', 'account', 'id', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addForeignKey('step_id', 'StepId', 'INTEGER', 'step', 'id', true, 4, null);
        $this->addColumn('template', 'Template', 'VARCHAR', true, 255, null);
        $this->addColumn('logo', 'Logo', 'VARCHAR', false, 255, null);
        $this->addColumn('favicon', 'Favicon', 'VARCHAR', false, 255, null);
        $this->addColumn('javascript', 'Javascript', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stylesheet', 'Stylesheet', 'LONGVARCHAR', false, null, null);
        $this->addColumn('max_upload', 'MaxUpload', 'INTEGER', false, null, null);
        $this->addColumn('currency', 'Currency', 'VARCHAR', false, 3, null);
        $this->addColumn('meta_auto', 'MetaAuto', 'BOOLEAN', true, 1, true);
        $this->addColumn('ssl', 'Ssl', 'BOOLEAN', true, 1, false);
        $this->addColumn('duplicable', 'Duplicable', 'BOOLEAN', true, 1, false);
        $this->addColumn('wrapper', 'Wrapper', 'VARCHAR', false, 50, null);
        $this->addColumn('wrapper_params', 'WrapperParams', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Account', '\\CE\\Model\\Account', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':account_id',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('Step', '\\CE\\Model\\Step', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':step_id',
    1 => ':id',
  ),
), 'RESTRICT', 'CASCADE', null, false);
        $this->addRelation('Meta', '\\CE\\Model\\Meta', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Metas', false);
        $this->addRelation('ModuleAuthorization', '\\CE\\Model\\ModuleAuthorization', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'ModuleAuthorizations', false);
        $this->addRelation('UserWebsite', '\\CE\\Model\\UserWebsite', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'UserWebsites', false);
        $this->addRelation('WebsiteRedirection', '\\CE\\Model\\WebsiteRedirection', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteRedirections', false);
        $this->addRelation('WebsiteCulture', '\\CE\\Model\\WebsiteCulture', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteCultures', false);
        $this->addRelation('WebsiteDomain', '\\CE\\Model\\WebsiteDomain', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteDomains', false);
        $this->addRelation('WebsiteParameter', '\\CE\\Model\\WebsiteParameter', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteParameters', false);
        $this->addRelation('WebsiteRouting', '\\CE\\Model\\WebsiteRouting', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteRoutings', false);
        $this->addRelation('WebsiteModule', '\\CE\\Model\\WebsiteModule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteModules', false);
        $this->addRelation('WebsiteZone', '\\CE\\Model\\WebsiteZone', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteZones', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to website     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        MetaTableMap::clearInstancePool();
        ModuleAuthorizationTableMap::clearInstancePool();
        UserWebsiteTableMap::clearInstancePool();
        WebsiteRedirectionTableMap::clearInstancePool();
        WebsiteCultureTableMap::clearInstancePool();
        WebsiteDomainTableMap::clearInstancePool();
        WebsiteParameterTableMap::clearInstancePool();
        WebsiteRoutingTableMap::clearInstancePool();
        WebsiteModuleTableMap::clearInstancePool();
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
        return $withPrefix ? WebsiteTableMap::CLASS_DEFAULT : WebsiteTableMap::OM_CLASS;
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
     * @return array           (Website object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WebsiteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WebsiteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WebsiteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WebsiteTableMap::OM_CLASS;
            /** @var Website $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WebsiteTableMap::addInstanceToPool($obj, $key);
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
            $key = WebsiteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WebsiteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Website $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WebsiteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WebsiteTableMap::COL_ID);
            $criteria->addSelectColumn(WebsiteTableMap::COL_ACCOUNT_ID);
            $criteria->addSelectColumn(WebsiteTableMap::COL_NAME);
            $criteria->addSelectColumn(WebsiteTableMap::COL_STEP_ID);
            $criteria->addSelectColumn(WebsiteTableMap::COL_TEMPLATE);
            $criteria->addSelectColumn(WebsiteTableMap::COL_LOGO);
            $criteria->addSelectColumn(WebsiteTableMap::COL_FAVICON);
            $criteria->addSelectColumn(WebsiteTableMap::COL_JAVASCRIPT);
            $criteria->addSelectColumn(WebsiteTableMap::COL_STYLESHEET);
            $criteria->addSelectColumn(WebsiteTableMap::COL_MAX_UPLOAD);
            $criteria->addSelectColumn(WebsiteTableMap::COL_CURRENCY);
            $criteria->addSelectColumn(WebsiteTableMap::COL_META_AUTO);
            $criteria->addSelectColumn(WebsiteTableMap::COL_SSL);
            $criteria->addSelectColumn(WebsiteTableMap::COL_DUPLICABLE);
            $criteria->addSelectColumn(WebsiteTableMap::COL_WRAPPER);
            $criteria->addSelectColumn(WebsiteTableMap::COL_WRAPPER_PARAMS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.account_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.step_id');
            $criteria->addSelectColumn($alias . '.template');
            $criteria->addSelectColumn($alias . '.logo');
            $criteria->addSelectColumn($alias . '.favicon');
            $criteria->addSelectColumn($alias . '.javascript');
            $criteria->addSelectColumn($alias . '.stylesheet');
            $criteria->addSelectColumn($alias . '.max_upload');
            $criteria->addSelectColumn($alias . '.currency');
            $criteria->addSelectColumn($alias . '.meta_auto');
            $criteria->addSelectColumn($alias . '.ssl');
            $criteria->addSelectColumn($alias . '.duplicable');
            $criteria->addSelectColumn($alias . '.wrapper');
            $criteria->addSelectColumn($alias . '.wrapper_params');
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
        return Propel::getServiceContainer()->getDatabaseMap(WebsiteTableMap::DATABASE_NAME)->getTable(WebsiteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WebsiteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WebsiteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WebsiteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Website or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Website object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CE\Model\Website) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WebsiteTableMap::DATABASE_NAME);
            $criteria->add(WebsiteTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = WebsiteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WebsiteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WebsiteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the website table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WebsiteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Website or Criteria object.
     *
     * @param mixed               $criteria Criteria or Website object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Website object
        }

        if ($criteria->containsKey(WebsiteTableMap::COL_ID) && $criteria->keyContainsValue(WebsiteTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WebsiteTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = WebsiteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WebsiteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WebsiteTableMap::buildTableMap();
