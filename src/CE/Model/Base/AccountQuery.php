<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Account as ChildAccount;
use CE\Model\AccountQuery as ChildAccountQuery;
use CE\Model\Map\AccountTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'account' table.
 *
 *
 *
 * @method     ChildAccountQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAccountQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildAccountQuery orderByDisplayName($order = Criteria::ASC) Order by the display_name column
 * @method     ChildAccountQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildAccountQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildAccountQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildAccountQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildAccountQuery orderByZipcode($order = Criteria::ASC) Order by the zipcode column
 * @method     ChildAccountQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildAccountQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildAccountQuery orderByLegal($order = Criteria::ASC) Order by the legal column
 * @method     ChildAccountQuery orderByLogo($order = Criteria::ASC) Order by the logo column
 * @method     ChildAccountQuery orderByCreditsLogo($order = Criteria::ASC) Order by the credits_logo column
 * @method     ChildAccountQuery orderByFqdn($order = Criteria::ASC) Order by the fqdn column
 * @method     ChildAccountQuery orderByWrapper($order = Criteria::ASC) Order by the wrapper column
 * @method     ChildAccountQuery orderByWrapperParams($order = Criteria::ASC) Order by the wrapper_params column
 * @method     ChildAccountQuery orderByCultures($order = Criteria::ASC) Order by the cultures column
 * @method     ChildAccountQuery orderByCurrencies($order = Criteria::ASC) Order by the currencies column
 *
 * @method     ChildAccountQuery groupById() Group by the id column
 * @method     ChildAccountQuery groupByName() Group by the name column
 * @method     ChildAccountQuery groupByDisplayName() Group by the display_name column
 * @method     ChildAccountQuery groupByUrl() Group by the url column
 * @method     ChildAccountQuery groupByPhone() Group by the phone column
 * @method     ChildAccountQuery groupByEmail() Group by the email column
 * @method     ChildAccountQuery groupByAddress() Group by the address column
 * @method     ChildAccountQuery groupByZipcode() Group by the zipcode column
 * @method     ChildAccountQuery groupByCity() Group by the city column
 * @method     ChildAccountQuery groupByCountry() Group by the country column
 * @method     ChildAccountQuery groupByLegal() Group by the legal column
 * @method     ChildAccountQuery groupByLogo() Group by the logo column
 * @method     ChildAccountQuery groupByCreditsLogo() Group by the credits_logo column
 * @method     ChildAccountQuery groupByFqdn() Group by the fqdn column
 * @method     ChildAccountQuery groupByWrapper() Group by the wrapper column
 * @method     ChildAccountQuery groupByWrapperParams() Group by the wrapper_params column
 * @method     ChildAccountQuery groupByCultures() Group by the cultures column
 * @method     ChildAccountQuery groupByCurrencies() Group by the currencies column
 *
 * @method     ChildAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccountQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildAccountQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildAccountQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildAccountQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildAccountQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildAccountQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildAccountQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildAccountQuery leftJoinWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Website relation
 * @method     ChildAccountQuery rightJoinWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Website relation
 * @method     ChildAccountQuery innerJoinWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the Website relation
 *
 * @method     ChildAccountQuery joinWithWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Website relation
 *
 * @method     ChildAccountQuery leftJoinWithWebsite() Adds a LEFT JOIN clause and with to the query using the Website relation
 * @method     ChildAccountQuery rightJoinWithWebsite() Adds a RIGHT JOIN clause and with to the query using the Website relation
 * @method     ChildAccountQuery innerJoinWithWebsite() Adds a INNER JOIN clause and with to the query using the Website relation
 *
 * @method     \CE\Model\UserQuery|\CE\Model\WebsiteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAccount findOne(ConnectionInterface $con = null) Return the first ChildAccount matching the query
 * @method     ChildAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAccount matching the query, or a new ChildAccount object populated from the query conditions when no match is found
 *
 * @method     ChildAccount findOneById(int $id) Return the first ChildAccount filtered by the id column
 * @method     ChildAccount findOneByName(string $name) Return the first ChildAccount filtered by the name column
 * @method     ChildAccount findOneByDisplayName(string $display_name) Return the first ChildAccount filtered by the display_name column
 * @method     ChildAccount findOneByUrl(string $url) Return the first ChildAccount filtered by the url column
 * @method     ChildAccount findOneByPhone(string $phone) Return the first ChildAccount filtered by the phone column
 * @method     ChildAccount findOneByEmail(string $email) Return the first ChildAccount filtered by the email column
 * @method     ChildAccount findOneByAddress(string $address) Return the first ChildAccount filtered by the address column
 * @method     ChildAccount findOneByZipcode(string $zipcode) Return the first ChildAccount filtered by the zipcode column
 * @method     ChildAccount findOneByCity(string $city) Return the first ChildAccount filtered by the city column
 * @method     ChildAccount findOneByCountry(string $country) Return the first ChildAccount filtered by the country column
 * @method     ChildAccount findOneByLegal(string $legal) Return the first ChildAccount filtered by the legal column
 * @method     ChildAccount findOneByLogo(string $logo) Return the first ChildAccount filtered by the logo column
 * @method     ChildAccount findOneByCreditsLogo(string $credits_logo) Return the first ChildAccount filtered by the credits_logo column
 * @method     ChildAccount findOneByFqdn(string $fqdn) Return the first ChildAccount filtered by the fqdn column
 * @method     ChildAccount findOneByWrapper(string $wrapper) Return the first ChildAccount filtered by the wrapper column
 * @method     ChildAccount findOneByWrapperParams(string $wrapper_params) Return the first ChildAccount filtered by the wrapper_params column
 * @method     ChildAccount findOneByCultures(string $cultures) Return the first ChildAccount filtered by the cultures column
 * @method     ChildAccount findOneByCurrencies(string $currencies) Return the first ChildAccount filtered by the currencies column *

 * @method     ChildAccount requirePk($key, ConnectionInterface $con = null) Return the ChildAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOne(ConnectionInterface $con = null) Return the first ChildAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccount requireOneById(int $id) Return the first ChildAccount filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByName(string $name) Return the first ChildAccount filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByDisplayName(string $display_name) Return the first ChildAccount filtered by the display_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByUrl(string $url) Return the first ChildAccount filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByPhone(string $phone) Return the first ChildAccount filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByEmail(string $email) Return the first ChildAccount filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByAddress(string $address) Return the first ChildAccount filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByZipcode(string $zipcode) Return the first ChildAccount filtered by the zipcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByCity(string $city) Return the first ChildAccount filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByCountry(string $country) Return the first ChildAccount filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByLegal(string $legal) Return the first ChildAccount filtered by the legal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByLogo(string $logo) Return the first ChildAccount filtered by the logo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByCreditsLogo(string $credits_logo) Return the first ChildAccount filtered by the credits_logo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByFqdn(string $fqdn) Return the first ChildAccount filtered by the fqdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByWrapper(string $wrapper) Return the first ChildAccount filtered by the wrapper column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByWrapperParams(string $wrapper_params) Return the first ChildAccount filtered by the wrapper_params column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByCultures(string $cultures) Return the first ChildAccount filtered by the cultures column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByCurrencies(string $currencies) Return the first ChildAccount filtered by the currencies column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAccount objects based on current ModelCriteria
 * @method     ChildAccount[]|ObjectCollection findById(int $id) Return ChildAccount objects filtered by the id column
 * @method     ChildAccount[]|ObjectCollection findByName(string $name) Return ChildAccount objects filtered by the name column
 * @method     ChildAccount[]|ObjectCollection findByDisplayName(string $display_name) Return ChildAccount objects filtered by the display_name column
 * @method     ChildAccount[]|ObjectCollection findByUrl(string $url) Return ChildAccount objects filtered by the url column
 * @method     ChildAccount[]|ObjectCollection findByPhone(string $phone) Return ChildAccount objects filtered by the phone column
 * @method     ChildAccount[]|ObjectCollection findByEmail(string $email) Return ChildAccount objects filtered by the email column
 * @method     ChildAccount[]|ObjectCollection findByAddress(string $address) Return ChildAccount objects filtered by the address column
 * @method     ChildAccount[]|ObjectCollection findByZipcode(string $zipcode) Return ChildAccount objects filtered by the zipcode column
 * @method     ChildAccount[]|ObjectCollection findByCity(string $city) Return ChildAccount objects filtered by the city column
 * @method     ChildAccount[]|ObjectCollection findByCountry(string $country) Return ChildAccount objects filtered by the country column
 * @method     ChildAccount[]|ObjectCollection findByLegal(string $legal) Return ChildAccount objects filtered by the legal column
 * @method     ChildAccount[]|ObjectCollection findByLogo(string $logo) Return ChildAccount objects filtered by the logo column
 * @method     ChildAccount[]|ObjectCollection findByCreditsLogo(string $credits_logo) Return ChildAccount objects filtered by the credits_logo column
 * @method     ChildAccount[]|ObjectCollection findByFqdn(string $fqdn) Return ChildAccount objects filtered by the fqdn column
 * @method     ChildAccount[]|ObjectCollection findByWrapper(string $wrapper) Return ChildAccount objects filtered by the wrapper column
 * @method     ChildAccount[]|ObjectCollection findByWrapperParams(string $wrapper_params) Return ChildAccount objects filtered by the wrapper_params column
 * @method     ChildAccount[]|ObjectCollection findByCultures(string $cultures) Return ChildAccount objects filtered by the cultures column
 * @method     ChildAccount[]|ObjectCollection findByCurrencies(string $currencies) Return ChildAccount objects filtered by the currencies column
 * @method     ChildAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\AccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\Account', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAccountQuery) {
            return $criteria;
        }
        $query = new ChildAccountQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `name`, `display_name`, `url`, `phone`, `email`, `address`, `zipcode`, `city`, `country`, `legal`, `logo`, `credits_logo`, `fqdn`, `wrapper`, `wrapper_params`, `cultures`, `currencies` FROM `account` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildAccount $obj */
            $obj = new ChildAccount();
            $obj->hydrate($row);
            AccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildAccount|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccountTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccountTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AccountTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AccountTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the display_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayName('fooValue');   // WHERE display_name = 'fooValue'
     * $query->filterByDisplayName('%fooValue%', Criteria::LIKE); // WHERE display_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $displayName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByDisplayName($displayName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($displayName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_DISPLAY_NAME, $displayName, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the zipcode column
     *
     * Example usage:
     * <code>
     * $query->filterByZipcode('fooValue');   // WHERE zipcode = 'fooValue'
     * $query->filterByZipcode('%fooValue%', Criteria::LIKE); // WHERE zipcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipcode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByZipcode($zipcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipcode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ZIPCODE, $zipcode, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%', Criteria::LIKE); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the legal column
     *
     * Example usage:
     * <code>
     * $query->filterByLegal('fooValue');   // WHERE legal = 'fooValue'
     * $query->filterByLegal('%fooValue%', Criteria::LIKE); // WHERE legal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $legal The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByLegal($legal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($legal)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_LEGAL, $legal, $comparison);
    }

    /**
     * Filter the query on the logo column
     *
     * Example usage:
     * <code>
     * $query->filterByLogo('fooValue');   // WHERE logo = 'fooValue'
     * $query->filterByLogo('%fooValue%', Criteria::LIKE); // WHERE logo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $logo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByLogo($logo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_LOGO, $logo, $comparison);
    }

    /**
     * Filter the query on the credits_logo column
     *
     * Example usage:
     * <code>
     * $query->filterByCreditsLogo('fooValue');   // WHERE credits_logo = 'fooValue'
     * $query->filterByCreditsLogo('%fooValue%', Criteria::LIKE); // WHERE credits_logo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $creditsLogo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByCreditsLogo($creditsLogo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($creditsLogo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_CREDITS_LOGO, $creditsLogo, $comparison);
    }

    /**
     * Filter the query on the fqdn column
     *
     * Example usage:
     * <code>
     * $query->filterByFqdn('fooValue');   // WHERE fqdn = 'fooValue'
     * $query->filterByFqdn('%fooValue%', Criteria::LIKE); // WHERE fqdn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fqdn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByFqdn($fqdn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fqdn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_FQDN, $fqdn, $comparison);
    }

    /**
     * Filter the query on the wrapper column
     *
     * Example usage:
     * <code>
     * $query->filterByWrapper('fooValue');   // WHERE wrapper = 'fooValue'
     * $query->filterByWrapper('%fooValue%', Criteria::LIKE); // WHERE wrapper LIKE '%fooValue%'
     * </code>
     *
     * @param     string $wrapper The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByWrapper($wrapper = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wrapper)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_WRAPPER, $wrapper, $comparison);
    }

    /**
     * Filter the query on the wrapper_params column
     *
     * Example usage:
     * <code>
     * $query->filterByWrapperParams('fooValue');   // WHERE wrapper_params = 'fooValue'
     * $query->filterByWrapperParams('%fooValue%', Criteria::LIKE); // WHERE wrapper_params LIKE '%fooValue%'
     * </code>
     *
     * @param     string $wrapperParams The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByWrapperParams($wrapperParams = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wrapperParams)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_WRAPPER_PARAMS, $wrapperParams, $comparison);
    }

    /**
     * Filter the query on the cultures column
     *
     * Example usage:
     * <code>
     * $query->filterByCultures('fooValue');   // WHERE cultures = 'fooValue'
     * $query->filterByCultures('%fooValue%', Criteria::LIKE); // WHERE cultures LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cultures The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByCultures($cultures = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cultures)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_CULTURES, $cultures, $comparison);
    }

    /**
     * Filter the query on the currencies column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencies('fooValue');   // WHERE currencies = 'fooValue'
     * $query->filterByCurrencies('%fooValue%', Criteria::LIKE); // WHERE currencies LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencies The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByCurrencies($currencies = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencies)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_CURRENCIES, $currencies, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\User object
     *
     * @param \CE\Model\User|ObjectCollection $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \CE\Model\User) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ID, $user->getAccountId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \CE\Model\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\CE\Model\UserQuery');
    }

    /**
     * Filter the query by a related \CE\Model\Website object
     *
     * @param \CE\Model\Website|ObjectCollection $website the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByWebsite($website, $comparison = null)
    {
        if ($website instanceof \CE\Model\Website) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ID, $website->getAccountId(), $comparison);
        } elseif ($website instanceof ObjectCollection) {
            return $this
                ->useWebsiteQuery()
                ->filterByPrimaryKeys($website->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsite() only accepts arguments of type \CE\Model\Website or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Website relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function joinWebsite($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Website');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Website');
        }

        return $this;
    }

    /**
     * Use the Website relation Website object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWebsite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Website', '\CE\Model\WebsiteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAccount $account Object to remove from the list of results
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function prune($account = null)
    {
        if ($account) {
            $this->addUsingAlias(AccountTableMap::COL_ID, $account->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccountTableMap::clearInstancePool();
            AccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AccountQuery
