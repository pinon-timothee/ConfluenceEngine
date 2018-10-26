<?php

namespace CE\Model\Map;

use CE\Model\WebsiteModule;
use CE\Model\WebsiteModuleQuery;
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
 * This class defines the structure of the 'website_module' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WebsiteModuleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.CE.Model.Map.WebsiteModuleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'website_module';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CE\\Model\\WebsiteModule';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.CE.Model.WebsiteModule';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    const COL_ID = 'website_module.id';

    /**
     * the column name for the website_id field
     */
    const COL_WEBSITE_ID = 'website_module.website_id';

    /**
     * the column name for the module_name field
     */
    const COL_MODULE_NAME = 'website_module.module_name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'website_module.description';

    /**
     * the column name for the css field
     */
    const COL_CSS = 'website_module.css';

    /**
     * the column name for the class field
     */
    const COL_CLASS = 'website_module.class';

    /**
     * the column name for the block field
     */
    const COL_BLOCK = 'website_module.block';

    /**
     * the column name for the twig field
     */
    const COL_TWIG = 'website_module.twig';

    /**
     * the column name for the javascript field
     */
    const COL_JAVASCRIPT = 'website_module.javascript';

    /**
     * the column name for the tags field
     */
    const COL_TAGS = 'website_module.tags';

    /**
     * the column name for the enable field
     */
    const COL_ENABLE = 'website_module.enable';

    /**
     * the column name for the title_tag field
     */
    const COL_TITLE_TAG = 'website_module.title_tag';

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
        self::TYPE_PHPNAME       => array('Id', 'WebsiteId', 'ModuleName', 'Description', 'Css', 'Class', 'Block', 'Twig', 'Javascript', 'Tags', 'Enable', 'TitleTag', ),
        self::TYPE_CAMELNAME     => array('id', 'websiteId', 'moduleName', 'description', 'css', 'class', 'block', 'twig', 'javascript', 'tags', 'enable', 'titleTag', ),
        self::TYPE_COLNAME       => array(WebsiteModuleTableMap::COL_ID, WebsiteModuleTableMap::COL_WEBSITE_ID, WebsiteModuleTableMap::COL_MODULE_NAME, WebsiteModuleTableMap::COL_DESCRIPTION, WebsiteModuleTableMap::COL_CSS, WebsiteModuleTableMap::COL_CLASS, WebsiteModuleTableMap::COL_BLOCK, WebsiteModuleTableMap::COL_TWIG, WebsiteModuleTableMap::COL_JAVASCRIPT, WebsiteModuleTableMap::COL_TAGS, WebsiteModuleTableMap::COL_ENABLE, WebsiteModuleTableMap::COL_TITLE_TAG, ),
        self::TYPE_FIELDNAME     => array('id', 'website_id', 'module_name', 'description', 'css', 'class', 'block', 'twig', 'javascript', 'tags', 'enable', 'title_tag', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'WebsiteId' => 1, 'ModuleName' => 2, 'Description' => 3, 'Css' => 4, 'Class' => 5, 'Block' => 6, 'Twig' => 7, 'Javascript' => 8, 'Tags' => 9, 'Enable' => 10, 'TitleTag' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'websiteId' => 1, 'moduleName' => 2, 'description' => 3, 'css' => 4, 'class' => 5, 'block' => 6, 'twig' => 7, 'javascript' => 8, 'tags' => 9, 'enable' => 10, 'titleTag' => 11, ),
        self::TYPE_COLNAME       => array(WebsiteModuleTableMap::COL_ID => 0, WebsiteModuleTableMap::COL_WEBSITE_ID => 1, WebsiteModuleTableMap::COL_MODULE_NAME => 2, WebsiteModuleTableMap::COL_DESCRIPTION => 3, WebsiteModuleTableMap::COL_CSS => 4, WebsiteModuleTableMap::COL_CLASS => 5, WebsiteModuleTableMap::COL_BLOCK => 6, WebsiteModuleTableMap::COL_TWIG => 7, WebsiteModuleTableMap::COL_JAVASCRIPT => 8, WebsiteModuleTableMap::COL_TAGS => 9, WebsiteModuleTableMap::COL_ENABLE => 10, WebsiteModuleTableMap::COL_TITLE_TAG => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'website_id' => 1, 'module_name' => 2, 'description' => 3, 'css' => 4, 'class' => 5, 'block' => 6, 'twig' => 7, 'javascript' => 8, 'tags' => 9, 'enable' => 10, 'title_tag' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('website_module');
        $this->setPhpName('WebsiteModule');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CE\\Model\\WebsiteModule');
        $this->setPackage('src.CE.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('website_id', 'WebsiteId', 'INTEGER', 'website', 'id', false, null, null);
        $this->addColumn('module_name', 'ModuleName', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('css', 'Css', 'LONGVARCHAR', false, null, null);
        $this->addColumn('class', 'Class', 'VARCHAR', false, 255, null);
        $this->addColumn('block', 'Block', 'VARCHAR', false, 255, null);
        $this->addColumn('twig', 'Twig', 'VARCHAR', false, 255, null);
        $this->addColumn('javascript', 'Javascript', 'LONGVARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, 255, null);
        $this->addColumn('enable', 'Enable', 'BOOLEAN', true, 1, true);
        $this->addColumn('title_tag', 'TitleTag', 'VARCHAR', true, 12, 'h2');
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
        $this->addRelation('WebsiteModuleParameter', '\\CE\\Model\\WebsiteModuleParameter', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_module_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteModuleParameters', false);
        $this->addRelation('WebsiteModuleLocation', '\\CE\\Model\\WebsiteModuleLocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':website_module_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'WebsiteModuleLocations', false);
        $this->addRelation('WebsiteModuleI18n', '\\CE\\Model\\WebsiteModuleI18n', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'WebsiteModuleI18ns', false);
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
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'title, content', 'i18n_pk_column' => '', 'locale_column' => 'culture', 'locale_length' => '5', 'default_locale' => '', 'locale_alias' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to website_module     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        WebsiteModuleParameterTableMap::clearInstancePool();
        WebsiteModuleLocationTableMap::clearInstancePool();
        WebsiteModuleI18nTableMap::clearInstancePool();
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
        return $withPrefix ? WebsiteModuleTableMap::CLASS_DEFAULT : WebsiteModuleTableMap::OM_CLASS;
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
     * @return array           (WebsiteModule object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WebsiteModuleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WebsiteModuleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WebsiteModuleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WebsiteModuleTableMap::OM_CLASS;
            /** @var WebsiteModule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WebsiteModuleTableMap::addInstanceToPool($obj, $key);
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
            $key = WebsiteModuleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WebsiteModuleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WebsiteModule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WebsiteModuleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_ID);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_WEBSITE_ID);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_MODULE_NAME);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_CSS);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_CLASS);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_BLOCK);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_TWIG);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_JAVASCRIPT);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_TAGS);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_ENABLE);
            $criteria->addSelectColumn(WebsiteModuleTableMap::COL_TITLE_TAG);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.website_id');
            $criteria->addSelectColumn($alias . '.module_name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.css');
            $criteria->addSelectColumn($alias . '.class');
            $criteria->addSelectColumn($alias . '.block');
            $criteria->addSelectColumn($alias . '.twig');
            $criteria->addSelectColumn($alias . '.javascript');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.enable');
            $criteria->addSelectColumn($alias . '.title_tag');
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
        return Propel::getServiceContainer()->getDatabaseMap(WebsiteModuleTableMap::DATABASE_NAME)->getTable(WebsiteModuleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WebsiteModuleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WebsiteModuleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WebsiteModuleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WebsiteModule or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WebsiteModule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CE\Model\WebsiteModule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WebsiteModuleTableMap::DATABASE_NAME);
            $criteria->add(WebsiteModuleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = WebsiteModuleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WebsiteModuleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WebsiteModuleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the website_module table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WebsiteModuleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WebsiteModule or Criteria object.
     *
     * @param mixed               $criteria Criteria or WebsiteModule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WebsiteModule object
        }

        if ($criteria->containsKey(WebsiteModuleTableMap::COL_ID) && $criteria->keyContainsValue(WebsiteModuleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WebsiteModuleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = WebsiteModuleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WebsiteModuleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WebsiteModuleTableMap::buildTableMap();
