<?php

namespace CE\Model\Map;

use CE\Model\Account;
use CE\Model\AccountQuery;
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
 * This class defines the structure of the 'account' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.CE.Model.Map.AccountTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'account';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CE\\Model\\Account';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.CE.Model.Account';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the id field
     */
    const COL_ID = 'account.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'account.name';

    /**
     * the column name for the display_name field
     */
    const COL_DISPLAY_NAME = 'account.display_name';

    /**
     * the column name for the url field
     */
    const COL_URL = 'account.url';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'account.phone';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'account.email';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'account.address';

    /**
     * the column name for the zipcode field
     */
    const COL_ZIPCODE = 'account.zipcode';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'account.city';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'account.country';

    /**
     * the column name for the legal field
     */
    const COL_LEGAL = 'account.legal';

    /**
     * the column name for the logo field
     */
    const COL_LOGO = 'account.logo';

    /**
     * the column name for the credits_logo field
     */
    const COL_CREDITS_LOGO = 'account.credits_logo';

    /**
     * the column name for the fqdn field
     */
    const COL_FQDN = 'account.fqdn';

    /**
     * the column name for the wrapper field
     */
    const COL_WRAPPER = 'account.wrapper';

    /**
     * the column name for the wrapper_params field
     */
    const COL_WRAPPER_PARAMS = 'account.wrapper_params';

    /**
     * the column name for the cultures field
     */
    const COL_CULTURES = 'account.cultures';

    /**
     * the column name for the currencies field
     */
    const COL_CURRENCIES = 'account.currencies';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'DisplayName', 'Url', 'Phone', 'Email', 'Address', 'Zipcode', 'City', 'Country', 'Legal', 'Logo', 'CreditsLogo', 'Fqdn', 'Wrapper', 'WrapperParams', 'Cultures', 'Currencies', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'displayName', 'url', 'phone', 'email', 'address', 'zipcode', 'city', 'country', 'legal', 'logo', 'creditsLogo', 'fqdn', 'wrapper', 'wrapperParams', 'cultures', 'currencies', ),
        self::TYPE_COLNAME       => array(AccountTableMap::COL_ID, AccountTableMap::COL_NAME, AccountTableMap::COL_DISPLAY_NAME, AccountTableMap::COL_URL, AccountTableMap::COL_PHONE, AccountTableMap::COL_EMAIL, AccountTableMap::COL_ADDRESS, AccountTableMap::COL_ZIPCODE, AccountTableMap::COL_CITY, AccountTableMap::COL_COUNTRY, AccountTableMap::COL_LEGAL, AccountTableMap::COL_LOGO, AccountTableMap::COL_CREDITS_LOGO, AccountTableMap::COL_FQDN, AccountTableMap::COL_WRAPPER, AccountTableMap::COL_WRAPPER_PARAMS, AccountTableMap::COL_CULTURES, AccountTableMap::COL_CURRENCIES, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'display_name', 'url', 'phone', 'email', 'address', 'zipcode', 'city', 'country', 'legal', 'logo', 'credits_logo', 'fqdn', 'wrapper', 'wrapper_params', 'cultures', 'currencies', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'DisplayName' => 2, 'Url' => 3, 'Phone' => 4, 'Email' => 5, 'Address' => 6, 'Zipcode' => 7, 'City' => 8, 'Country' => 9, 'Legal' => 10, 'Logo' => 11, 'CreditsLogo' => 12, 'Fqdn' => 13, 'Wrapper' => 14, 'WrapperParams' => 15, 'Cultures' => 16, 'Currencies' => 17, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'displayName' => 2, 'url' => 3, 'phone' => 4, 'email' => 5, 'address' => 6, 'zipcode' => 7, 'city' => 8, 'country' => 9, 'legal' => 10, 'logo' => 11, 'creditsLogo' => 12, 'fqdn' => 13, 'wrapper' => 14, 'wrapperParams' => 15, 'cultures' => 16, 'currencies' => 17, ),
        self::TYPE_COLNAME       => array(AccountTableMap::COL_ID => 0, AccountTableMap::COL_NAME => 1, AccountTableMap::COL_DISPLAY_NAME => 2, AccountTableMap::COL_URL => 3, AccountTableMap::COL_PHONE => 4, AccountTableMap::COL_EMAIL => 5, AccountTableMap::COL_ADDRESS => 6, AccountTableMap::COL_ZIPCODE => 7, AccountTableMap::COL_CITY => 8, AccountTableMap::COL_COUNTRY => 9, AccountTableMap::COL_LEGAL => 10, AccountTableMap::COL_LOGO => 11, AccountTableMap::COL_CREDITS_LOGO => 12, AccountTableMap::COL_FQDN => 13, AccountTableMap::COL_WRAPPER => 14, AccountTableMap::COL_WRAPPER_PARAMS => 15, AccountTableMap::COL_CULTURES => 16, AccountTableMap::COL_CURRENCIES => 17, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'display_name' => 2, 'url' => 3, 'phone' => 4, 'email' => 5, 'address' => 6, 'zipcode' => 7, 'city' => 8, 'country' => 9, 'legal' => 10, 'logo' => 11, 'credits_logo' => 12, 'fqdn' => 13, 'wrapper' => 14, 'wrapper_params' => 15, 'cultures' => 16, 'currencies' => 17, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
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
        $this->setName('account');
        $this->setPhpName('Account');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CE\\Model\\Account');
        $this->setPackage('src.CE.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('display_name', 'DisplayName', 'VARCHAR', false, 100, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 100, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 20, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 100, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 255, null);
        $this->addColumn('zipcode', 'Zipcode', 'VARCHAR', false, 10, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 100, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 3, null);
        $this->addColumn('legal', 'Legal', 'LONGVARCHAR', false, null, null);
        $this->addColumn('logo', 'Logo', 'VARCHAR', false, 12, null);
        $this->addColumn('credits_logo', 'CreditsLogo', 'VARCHAR', false, 12, null);
        $this->addColumn('fqdn', 'Fqdn', 'VARCHAR', false, 100, null);
        $this->addColumn('wrapper', 'Wrapper', 'VARCHAR', false, 50, null);
        $this->addColumn('wrapper_params', 'WrapperParams', 'LONGVARCHAR', false, null, null);
        $this->addColumn('cultures', 'Cultures', 'VARCHAR', false, 255, null);
        $this->addColumn('currencies', 'Currencies', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\CE\\Model\\User', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':account_id',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'Users', false);
        $this->addRelation('Website', '\\CE\\Model\\Website', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':account_id',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'Websites', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to account     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        UserTableMap::clearInstancePool();
        WebsiteTableMap::clearInstancePool();
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
        return $withPrefix ? AccountTableMap::CLASS_DEFAULT : AccountTableMap::OM_CLASS;
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
     * @return array           (Account object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AccountTableMap::OM_CLASS;
            /** @var Account $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AccountTableMap::addInstanceToPool($obj, $key);
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
            $key = AccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Account $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AccountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AccountTableMap::COL_ID);
            $criteria->addSelectColumn(AccountTableMap::COL_NAME);
            $criteria->addSelectColumn(AccountTableMap::COL_DISPLAY_NAME);
            $criteria->addSelectColumn(AccountTableMap::COL_URL);
            $criteria->addSelectColumn(AccountTableMap::COL_PHONE);
            $criteria->addSelectColumn(AccountTableMap::COL_EMAIL);
            $criteria->addSelectColumn(AccountTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(AccountTableMap::COL_ZIPCODE);
            $criteria->addSelectColumn(AccountTableMap::COL_CITY);
            $criteria->addSelectColumn(AccountTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(AccountTableMap::COL_LEGAL);
            $criteria->addSelectColumn(AccountTableMap::COL_LOGO);
            $criteria->addSelectColumn(AccountTableMap::COL_CREDITS_LOGO);
            $criteria->addSelectColumn(AccountTableMap::COL_FQDN);
            $criteria->addSelectColumn(AccountTableMap::COL_WRAPPER);
            $criteria->addSelectColumn(AccountTableMap::COL_WRAPPER_PARAMS);
            $criteria->addSelectColumn(AccountTableMap::COL_CULTURES);
            $criteria->addSelectColumn(AccountTableMap::COL_CURRENCIES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.display_name');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.zipcode');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.legal');
            $criteria->addSelectColumn($alias . '.logo');
            $criteria->addSelectColumn($alias . '.credits_logo');
            $criteria->addSelectColumn($alias . '.fqdn');
            $criteria->addSelectColumn($alias . '.wrapper');
            $criteria->addSelectColumn($alias . '.wrapper_params');
            $criteria->addSelectColumn($alias . '.cultures');
            $criteria->addSelectColumn($alias . '.currencies');
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
        return Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME)->getTable(AccountTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AccountTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AccountTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AccountTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Account or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Account object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CE\Model\Account) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AccountTableMap::DATABASE_NAME);
            $criteria->add(AccountTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Account or Criteria object.
     *
     * @param mixed               $criteria Criteria or Account object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Account object
        }

        if ($criteria->containsKey(AccountTableMap::COL_ID) && $criteria->keyContainsValue(AccountTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AccountTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AccountTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AccountTableMap::buildTableMap();
