<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Meta as ChildMeta;
use CE\Model\MetaQuery as ChildMetaQuery;
use CE\Model\Map\MetaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'meta' table.
 *
 *
 *
 * @method     ChildMetaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMetaQuery orderByWebsiteId($order = Criteria::ASC) Order by the website_id column
 * @method     ChildMetaQuery orderByWebsiteRoutingId($order = Criteria::ASC) Order by the website_routing_id column
 * @method     ChildMetaQuery orderByCulture($order = Criteria::ASC) Order by the culture column
 * @method     ChildMetaQuery orderByHtml($order = Criteria::ASC) Order by the html column
 *
 * @method     ChildMetaQuery groupById() Group by the id column
 * @method     ChildMetaQuery groupByWebsiteId() Group by the website_id column
 * @method     ChildMetaQuery groupByWebsiteRoutingId() Group by the website_routing_id column
 * @method     ChildMetaQuery groupByCulture() Group by the culture column
 * @method     ChildMetaQuery groupByHtml() Group by the html column
 *
 * @method     ChildMetaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMetaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMetaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMetaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMetaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMetaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMetaQuery leftJoinWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Website relation
 * @method     ChildMetaQuery rightJoinWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Website relation
 * @method     ChildMetaQuery innerJoinWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the Website relation
 *
 * @method     ChildMetaQuery joinWithWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Website relation
 *
 * @method     ChildMetaQuery leftJoinWithWebsite() Adds a LEFT JOIN clause and with to the query using the Website relation
 * @method     ChildMetaQuery rightJoinWithWebsite() Adds a RIGHT JOIN clause and with to the query using the Website relation
 * @method     ChildMetaQuery innerJoinWithWebsite() Adds a INNER JOIN clause and with to the query using the Website relation
 *
 * @method     ChildMetaQuery leftJoinWebsiteRouting($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRouting relation
 * @method     ChildMetaQuery rightJoinWebsiteRouting($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRouting relation
 * @method     ChildMetaQuery innerJoinWebsiteRouting($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRouting relation
 *
 * @method     ChildMetaQuery joinWithWebsiteRouting($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRouting relation
 *
 * @method     ChildMetaQuery leftJoinWithWebsiteRouting() Adds a LEFT JOIN clause and with to the query using the WebsiteRouting relation
 * @method     ChildMetaQuery rightJoinWithWebsiteRouting() Adds a RIGHT JOIN clause and with to the query using the WebsiteRouting relation
 * @method     ChildMetaQuery innerJoinWithWebsiteRouting() Adds a INNER JOIN clause and with to the query using the WebsiteRouting relation
 *
 * @method     \CE\Model\WebsiteQuery|\CE\Model\WebsiteRoutingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMeta findOne(ConnectionInterface $con = null) Return the first ChildMeta matching the query
 * @method     ChildMeta findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMeta matching the query, or a new ChildMeta object populated from the query conditions when no match is found
 *
 * @method     ChildMeta findOneById(int $id) Return the first ChildMeta filtered by the id column
 * @method     ChildMeta findOneByWebsiteId(int $website_id) Return the first ChildMeta filtered by the website_id column
 * @method     ChildMeta findOneByWebsiteRoutingId(int $website_routing_id) Return the first ChildMeta filtered by the website_routing_id column
 * @method     ChildMeta findOneByCulture(string $culture) Return the first ChildMeta filtered by the culture column
 * @method     ChildMeta findOneByHtml(string $html) Return the first ChildMeta filtered by the html column *

 * @method     ChildMeta requirePk($key, ConnectionInterface $con = null) Return the ChildMeta by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMeta requireOne(ConnectionInterface $con = null) Return the first ChildMeta matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMeta requireOneById(int $id) Return the first ChildMeta filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMeta requireOneByWebsiteId(int $website_id) Return the first ChildMeta filtered by the website_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMeta requireOneByWebsiteRoutingId(int $website_routing_id) Return the first ChildMeta filtered by the website_routing_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMeta requireOneByCulture(string $culture) Return the first ChildMeta filtered by the culture column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMeta requireOneByHtml(string $html) Return the first ChildMeta filtered by the html column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMeta[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMeta objects based on current ModelCriteria
 * @method     ChildMeta[]|ObjectCollection findById(int $id) Return ChildMeta objects filtered by the id column
 * @method     ChildMeta[]|ObjectCollection findByWebsiteId(int $website_id) Return ChildMeta objects filtered by the website_id column
 * @method     ChildMeta[]|ObjectCollection findByWebsiteRoutingId(int $website_routing_id) Return ChildMeta objects filtered by the website_routing_id column
 * @method     ChildMeta[]|ObjectCollection findByCulture(string $culture) Return ChildMeta objects filtered by the culture column
 * @method     ChildMeta[]|ObjectCollection findByHtml(string $html) Return ChildMeta objects filtered by the html column
 * @method     ChildMeta[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MetaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\MetaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\Meta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMetaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMetaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMetaQuery) {
            return $criteria;
        }
        $query = new ChildMetaQuery();
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
     * @return ChildMeta|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MetaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MetaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMeta A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `website_id`, `website_routing_id`, `culture`, `html` FROM `meta` WHERE `id` = :p0';
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
            /** @var ChildMeta $obj */
            $obj = new ChildMeta();
            $obj->hydrate($row);
            MetaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMeta|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MetaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MetaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MetaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MetaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the website_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsiteId(1234); // WHERE website_id = 1234
     * $query->filterByWebsiteId(array(12, 34)); // WHERE website_id IN (12, 34)
     * $query->filterByWebsiteId(array('min' => 12)); // WHERE website_id > 12
     * </code>
     *
     * @see       filterByWebsite()
     *
     * @param     mixed $websiteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterByWebsiteId($websiteId = null, $comparison = null)
    {
        if (is_array($websiteId)) {
            $useMinMax = false;
            if (isset($websiteId['min'])) {
                $this->addUsingAlias(MetaTableMap::COL_WEBSITE_ID, $websiteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteId['max'])) {
                $this->addUsingAlias(MetaTableMap::COL_WEBSITE_ID, $websiteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetaTableMap::COL_WEBSITE_ID, $websiteId, $comparison);
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
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterByWebsiteRoutingId($websiteRoutingId = null, $comparison = null)
    {
        if (is_array($websiteRoutingId)) {
            $useMinMax = false;
            if (isset($websiteRoutingId['min'])) {
                $this->addUsingAlias(MetaTableMap::COL_WEBSITE_ROUTING_ID, $websiteRoutingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteRoutingId['max'])) {
                $this->addUsingAlias(MetaTableMap::COL_WEBSITE_ROUTING_ID, $websiteRoutingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetaTableMap::COL_WEBSITE_ROUTING_ID, $websiteRoutingId, $comparison);
    }

    /**
     * Filter the query on the culture column
     *
     * Example usage:
     * <code>
     * $query->filterByCulture('fooValue');   // WHERE culture = 'fooValue'
     * $query->filterByCulture('%fooValue%', Criteria::LIKE); // WHERE culture LIKE '%fooValue%'
     * </code>
     *
     * @param     string $culture The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterByCulture($culture = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($culture)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetaTableMap::COL_CULTURE, $culture, $comparison);
    }

    /**
     * Filter the query on the html column
     *
     * Example usage:
     * <code>
     * $query->filterByHtml('fooValue');   // WHERE html = 'fooValue'
     * $query->filterByHtml('%fooValue%', Criteria::LIKE); // WHERE html LIKE '%fooValue%'
     * </code>
     *
     * @param     string $html The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function filterByHtml($html = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($html)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetaTableMap::COL_HTML, $html, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\Website object
     *
     * @param \CE\Model\Website|ObjectCollection $website The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMetaQuery The current query, for fluid interface
     */
    public function filterByWebsite($website, $comparison = null)
    {
        if ($website instanceof \CE\Model\Website) {
            return $this
                ->addUsingAlias(MetaTableMap::COL_WEBSITE_ID, $website->getId(), $comparison);
        } elseif ($website instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MetaTableMap::COL_WEBSITE_ID, $website->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildMetaQuery The current query, for fluid interface
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
     * Filter the query by a related \CE\Model\WebsiteRouting object
     *
     * @param \CE\Model\WebsiteRouting|ObjectCollection $websiteRouting The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMetaQuery The current query, for fluid interface
     */
    public function filterByWebsiteRouting($websiteRouting, $comparison = null)
    {
        if ($websiteRouting instanceof \CE\Model\WebsiteRouting) {
            return $this
                ->addUsingAlias(MetaTableMap::COL_WEBSITE_ROUTING_ID, $websiteRouting->getId(), $comparison);
        } elseif ($websiteRouting instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MetaTableMap::COL_WEBSITE_ROUTING_ID, $websiteRouting->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildMetaQuery The current query, for fluid interface
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
     * @param   ChildMeta $meta Object to remove from the list of results
     *
     * @return $this|ChildMetaQuery The current query, for fluid interface
     */
    public function prune($meta = null)
    {
        if ($meta) {
            $this->addUsingAlias(MetaTableMap::COL_ID, $meta->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the meta table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MetaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MetaTableMap::clearInstancePool();
            MetaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MetaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MetaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MetaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MetaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MetaQuery
