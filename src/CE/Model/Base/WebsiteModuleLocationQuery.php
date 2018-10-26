<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteModuleLocation as ChildWebsiteModuleLocation;
use CE\Model\WebsiteModuleLocationQuery as ChildWebsiteModuleLocationQuery;
use CE\Model\Map\WebsiteModuleLocationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website_module_location' table.
 *
 *
 *
 * @method     ChildWebsiteModuleLocationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteModuleLocationQuery orderByWebsiteModuleId($order = Criteria::ASC) Order by the website_module_id column
 * @method     ChildWebsiteModuleLocationQuery orderByWebsiteRoutingId($order = Criteria::ASC) Order by the website_routing_id column
 * @method     ChildWebsiteModuleLocationQuery orderByZone($order = Criteria::ASC) Order by the zone column
 * @method     ChildWebsiteModuleLocationQuery orderByRank($order = Criteria::ASC) Order by the rank column
 * @method     ChildWebsiteModuleLocationQuery orderByEnable($order = Criteria::ASC) Order by the enable column
 *
 * @method     ChildWebsiteModuleLocationQuery groupById() Group by the id column
 * @method     ChildWebsiteModuleLocationQuery groupByWebsiteModuleId() Group by the website_module_id column
 * @method     ChildWebsiteModuleLocationQuery groupByWebsiteRoutingId() Group by the website_routing_id column
 * @method     ChildWebsiteModuleLocationQuery groupByZone() Group by the zone column
 * @method     ChildWebsiteModuleLocationQuery groupByRank() Group by the rank column
 * @method     ChildWebsiteModuleLocationQuery groupByEnable() Group by the enable column
 *
 * @method     ChildWebsiteModuleLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteModuleLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteModuleLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteModuleLocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteModuleLocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteModuleLocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteModuleLocationQuery leftJoinWebsiteModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleLocationQuery rightJoinWebsiteModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleLocationQuery innerJoinWebsiteModule($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleLocationQuery joinWithWebsiteModule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleLocationQuery leftJoinWithWebsiteModule() Adds a LEFT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleLocationQuery rightJoinWithWebsiteModule() Adds a RIGHT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleLocationQuery innerJoinWithWebsiteModule() Adds a INNER JOIN clause and with to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleLocationQuery leftJoinWebsiteRouting($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRouting relation
 * @method     ChildWebsiteModuleLocationQuery rightJoinWebsiteRouting($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRouting relation
 * @method     ChildWebsiteModuleLocationQuery innerJoinWebsiteRouting($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRouting relation
 *
 * @method     ChildWebsiteModuleLocationQuery joinWithWebsiteRouting($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRouting relation
 *
 * @method     ChildWebsiteModuleLocationQuery leftJoinWithWebsiteRouting() Adds a LEFT JOIN clause and with to the query using the WebsiteRouting relation
 * @method     ChildWebsiteModuleLocationQuery rightJoinWithWebsiteRouting() Adds a RIGHT JOIN clause and with to the query using the WebsiteRouting relation
 * @method     ChildWebsiteModuleLocationQuery innerJoinWithWebsiteRouting() Adds a INNER JOIN clause and with to the query using the WebsiteRouting relation
 *
 * @method     \CE\Model\WebsiteModuleQuery|\CE\Model\WebsiteRoutingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsiteModuleLocation findOne(ConnectionInterface $con = null) Return the first ChildWebsiteModuleLocation matching the query
 * @method     ChildWebsiteModuleLocation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsiteModuleLocation matching the query, or a new ChildWebsiteModuleLocation object populated from the query conditions when no match is found
 *
 * @method     ChildWebsiteModuleLocation findOneById(int $id) Return the first ChildWebsiteModuleLocation filtered by the id column
 * @method     ChildWebsiteModuleLocation findOneByWebsiteModuleId(int $website_module_id) Return the first ChildWebsiteModuleLocation filtered by the website_module_id column
 * @method     ChildWebsiteModuleLocation findOneByWebsiteRoutingId(int $website_routing_id) Return the first ChildWebsiteModuleLocation filtered by the website_routing_id column
 * @method     ChildWebsiteModuleLocation findOneByZone(string $zone) Return the first ChildWebsiteModuleLocation filtered by the zone column
 * @method     ChildWebsiteModuleLocation findOneByRank(int $rank) Return the first ChildWebsiteModuleLocation filtered by the rank column
 * @method     ChildWebsiteModuleLocation findOneByEnable(boolean $enable) Return the first ChildWebsiteModuleLocation filtered by the enable column *

 * @method     ChildWebsiteModuleLocation requirePk($key, ConnectionInterface $con = null) Return the ChildWebsiteModuleLocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleLocation requireOne(ConnectionInterface $con = null) Return the first ChildWebsiteModuleLocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModuleLocation requireOneById(int $id) Return the first ChildWebsiteModuleLocation filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleLocation requireOneByWebsiteModuleId(int $website_module_id) Return the first ChildWebsiteModuleLocation filtered by the website_module_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleLocation requireOneByWebsiteRoutingId(int $website_routing_id) Return the first ChildWebsiteModuleLocation filtered by the website_routing_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleLocation requireOneByZone(string $zone) Return the first ChildWebsiteModuleLocation filtered by the zone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleLocation requireOneByRank(int $rank) Return the first ChildWebsiteModuleLocation filtered by the rank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleLocation requireOneByEnable(boolean $enable) Return the first ChildWebsiteModuleLocation filtered by the enable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsiteModuleLocation objects based on current ModelCriteria
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection findById(int $id) Return ChildWebsiteModuleLocation objects filtered by the id column
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection findByWebsiteModuleId(int $website_module_id) Return ChildWebsiteModuleLocation objects filtered by the website_module_id column
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection findByWebsiteRoutingId(int $website_routing_id) Return ChildWebsiteModuleLocation objects filtered by the website_routing_id column
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection findByZone(string $zone) Return ChildWebsiteModuleLocation objects filtered by the zone column
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection findByRank(int $rank) Return ChildWebsiteModuleLocation objects filtered by the rank column
 * @method     ChildWebsiteModuleLocation[]|ObjectCollection findByEnable(boolean $enable) Return ChildWebsiteModuleLocation objects filtered by the enable column
 * @method     ChildWebsiteModuleLocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteModuleLocationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteModuleLocationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\WebsiteModuleLocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteModuleLocationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteModuleLocationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteModuleLocationQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteModuleLocationQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $website_module_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWebsiteModuleLocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteModuleLocationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteModuleLocationTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildWebsiteModuleLocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `website_module_id`, `website_routing_id`, `zone`, `rank`, `enable` FROM `website_module_location` WHERE `id` = :p0 AND `website_module_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWebsiteModuleLocation $obj */
            $obj = new ChildWebsiteModuleLocation();
            $obj->hydrate($row);
            WebsiteModuleLocationTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWebsiteModuleLocation|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WebsiteModuleLocationTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the website_module_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsiteModuleId(1234); // WHERE website_module_id = 1234
     * $query->filterByWebsiteModuleId(array(12, 34)); // WHERE website_module_id IN (12, 34)
     * $query->filterByWebsiteModuleId(array('min' => 12)); // WHERE website_module_id > 12
     * </code>
     *
     * @see       filterByWebsiteModule()
     *
     * @param     mixed $websiteModuleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByWebsiteModuleId($websiteModuleId = null, $comparison = null)
    {
        if (is_array($websiteModuleId)) {
            $useMinMax = false;
            if (isset($websiteModuleId['min'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $websiteModuleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteModuleId['max'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $websiteModuleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $websiteModuleId, $comparison);
    }

    /**
     * Filter the query on the website_routing_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsiteRoutingId(1234); // WHERE website_routing_id = 1234
     * $query->filterByWebsiteRoutingId(array(12, 34)); // WHERE website_routing_id IN (12, 34)
     * $query->filterByWebsiteRoutingId(array('min' => 12)); // WHERE website_routing_id > 12
     * </code>
     *
     * @see       filterByWebsiteRouting()
     *
     * @param     mixed $websiteRoutingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByWebsiteRoutingId($websiteRoutingId = null, $comparison = null)
    {
        if (is_array($websiteRoutingId)) {
            $useMinMax = false;
            if (isset($websiteRoutingId['min'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID, $websiteRoutingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteRoutingId['max'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID, $websiteRoutingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID, $websiteRoutingId, $comparison);
    }

    /**
     * Filter the query on the zone column
     *
     * Example usage:
     * <code>
     * $query->filterByZone('fooValue');   // WHERE zone = 'fooValue'
     * $query->filterByZone('%fooValue%', Criteria::LIKE); // WHERE zone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByZone($zone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_ZONE, $zone, $comparison);
    }

    /**
     * Filter the query on the rank column
     *
     * Example usage:
     * <code>
     * $query->filterByRank(1234); // WHERE rank = 1234
     * $query->filterByRank(array(12, 34)); // WHERE rank IN (12, 34)
     * $query->filterByRank(array('min' => 12)); // WHERE rank > 12
     * </code>
     *
     * @param     mixed $rank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByRank($rank = null, $comparison = null)
    {
        if (is_array($rank)) {
            $useMinMax = false;
            if (isset($rank['min'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_RANK, $rank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rank['max'])) {
                $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_RANK, $rank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_RANK, $rank, $comparison);
    }

    /**
     * Filter the query on the enable column
     *
     * Example usage:
     * <code>
     * $query->filterByEnable(true); // WHERE enable = true
     * $query->filterByEnable('yes'); // WHERE enable = true
     * </code>
     *
     * @param     boolean|string $enable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByEnable($enable = null, $comparison = null)
    {
        if (is_string($enable)) {
            $enable = in_array(strtolower($enable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteModuleLocationTableMap::COL_ENABLE, $enable, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModule object
     *
     * @param \CE\Model\WebsiteModule|ObjectCollection $websiteModule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByWebsiteModule($websiteModule, $comparison = null)
    {
        if ($websiteModule instanceof \CE\Model\WebsiteModule) {
            return $this
                ->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $websiteModule->getId(), $comparison);
        } elseif ($websiteModule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $websiteModule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByWebsiteModule() only accepts arguments of type \CE\Model\WebsiteModule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteModule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function joinWebsiteModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteModule');

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
            $this->addJoinObject($join, 'WebsiteModule');
        }

        return $this;
    }

    /**
     * Use the WebsiteModule relation WebsiteModule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteModuleQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModule', '\CE\Model\WebsiteModuleQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRouting object
     *
     * @param \CE\Model\WebsiteRouting|ObjectCollection $websiteRouting The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function filterByWebsiteRouting($websiteRouting, $comparison = null)
    {
        if ($websiteRouting instanceof \CE\Model\WebsiteRouting) {
            return $this
                ->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID, $websiteRouting->getId(), $comparison);
        } elseif ($websiteRouting instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID, $websiteRouting->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByWebsiteRouting() only accepts arguments of type \CE\Model\WebsiteRouting or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteRouting relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function joinWebsiteRouting($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteRouting');

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
            $this->addJoinObject($join, 'WebsiteRouting');
        }

        return $this;
    }

    /**
     * Use the WebsiteRouting relation WebsiteRouting object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteRoutingQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteRoutingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWebsiteRouting($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRouting', '\CE\Model\WebsiteRoutingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWebsiteModuleLocation $websiteModuleLocation Object to remove from the list of results
     *
     * @return $this|ChildWebsiteModuleLocationQuery The current query, for fluid interface
     */
    public function prune($websiteModuleLocation = null)
    {
        if ($websiteModuleLocation) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WebsiteModuleLocationTableMap::COL_ID), $websiteModuleLocation->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID), $websiteModuleLocation->getWebsiteModuleId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website_module_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleLocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteModuleLocationTableMap::clearInstancePool();
            WebsiteModuleLocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleLocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteModuleLocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteModuleLocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteModuleLocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WebsiteModuleLocationQuery
