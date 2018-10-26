<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteCulture as ChildWebsiteCulture;
use CE\Model\WebsiteCultureQuery as ChildWebsiteCultureQuery;
use CE\Model\Map\WebsiteCultureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website_culture' table.
 *
 *
 *
 * @method     ChildWebsiteCultureQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteCultureQuery orderByWebsiteId($order = Criteria::ASC) Order by the website_id column
 * @method     ChildWebsiteCultureQuery orderByCultureId($order = Criteria::ASC) Order by the culture_id column
 * @method     ChildWebsiteCultureQuery orderByDefault($order = Criteria::ASC) Order by the default column
 * @method     ChildWebsiteCultureQuery orderByEnable($order = Criteria::ASC) Order by the enable column
 * @method     ChildWebsiteCultureQuery orderByRank($order = Criteria::ASC) Order by the rank column
 *
 * @method     ChildWebsiteCultureQuery groupById() Group by the id column
 * @method     ChildWebsiteCultureQuery groupByWebsiteId() Group by the website_id column
 * @method     ChildWebsiteCultureQuery groupByCultureId() Group by the culture_id column
 * @method     ChildWebsiteCultureQuery groupByDefault() Group by the default column
 * @method     ChildWebsiteCultureQuery groupByEnable() Group by the enable column
 * @method     ChildWebsiteCultureQuery groupByRank() Group by the rank column
 *
 * @method     ChildWebsiteCultureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteCultureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteCultureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteCultureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteCultureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteCultureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteCultureQuery leftJoinWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Website relation
 * @method     ChildWebsiteCultureQuery rightJoinWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Website relation
 * @method     ChildWebsiteCultureQuery innerJoinWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the Website relation
 *
 * @method     ChildWebsiteCultureQuery joinWithWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Website relation
 *
 * @method     ChildWebsiteCultureQuery leftJoinWithWebsite() Adds a LEFT JOIN clause and with to the query using the Website relation
 * @method     ChildWebsiteCultureQuery rightJoinWithWebsite() Adds a RIGHT JOIN clause and with to the query using the Website relation
 * @method     ChildWebsiteCultureQuery innerJoinWithWebsite() Adds a INNER JOIN clause and with to the query using the Website relation
 *
 * @method     ChildWebsiteCultureQuery leftJoinCulture($relationAlias = null) Adds a LEFT JOIN clause to the query using the Culture relation
 * @method     ChildWebsiteCultureQuery rightJoinCulture($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Culture relation
 * @method     ChildWebsiteCultureQuery innerJoinCulture($relationAlias = null) Adds a INNER JOIN clause to the query using the Culture relation
 *
 * @method     ChildWebsiteCultureQuery joinWithCulture($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Culture relation
 *
 * @method     ChildWebsiteCultureQuery leftJoinWithCulture() Adds a LEFT JOIN clause and with to the query using the Culture relation
 * @method     ChildWebsiteCultureQuery rightJoinWithCulture() Adds a RIGHT JOIN clause and with to the query using the Culture relation
 * @method     ChildWebsiteCultureQuery innerJoinWithCulture() Adds a INNER JOIN clause and with to the query using the Culture relation
 *
 * @method     \CE\Model\WebsiteQuery|\CE\Model\CultureQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsiteCulture findOne(ConnectionInterface $con = null) Return the first ChildWebsiteCulture matching the query
 * @method     ChildWebsiteCulture findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsiteCulture matching the query, or a new ChildWebsiteCulture object populated from the query conditions when no match is found
 *
 * @method     ChildWebsiteCulture findOneById(int $id) Return the first ChildWebsiteCulture filtered by the id column
 * @method     ChildWebsiteCulture findOneByWebsiteId(int $website_id) Return the first ChildWebsiteCulture filtered by the website_id column
 * @method     ChildWebsiteCulture findOneByCultureId(int $culture_id) Return the first ChildWebsiteCulture filtered by the culture_id column
 * @method     ChildWebsiteCulture findOneByDefault(boolean $default) Return the first ChildWebsiteCulture filtered by the default column
 * @method     ChildWebsiteCulture findOneByEnable(boolean $enable) Return the first ChildWebsiteCulture filtered by the enable column
 * @method     ChildWebsiteCulture findOneByRank(int $rank) Return the first ChildWebsiteCulture filtered by the rank column *

 * @method     ChildWebsiteCulture requirePk($key, ConnectionInterface $con = null) Return the ChildWebsiteCulture by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteCulture requireOne(ConnectionInterface $con = null) Return the first ChildWebsiteCulture matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteCulture requireOneById(int $id) Return the first ChildWebsiteCulture filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteCulture requireOneByWebsiteId(int $website_id) Return the first ChildWebsiteCulture filtered by the website_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteCulture requireOneByCultureId(int $culture_id) Return the first ChildWebsiteCulture filtered by the culture_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteCulture requireOneByDefault(boolean $default) Return the first ChildWebsiteCulture filtered by the default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteCulture requireOneByEnable(boolean $enable) Return the first ChildWebsiteCulture filtered by the enable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteCulture requireOneByRank(int $rank) Return the first ChildWebsiteCulture filtered by the rank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteCulture[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsiteCulture objects based on current ModelCriteria
 * @method     ChildWebsiteCulture[]|ObjectCollection findById(int $id) Return ChildWebsiteCulture objects filtered by the id column
 * @method     ChildWebsiteCulture[]|ObjectCollection findByWebsiteId(int $website_id) Return ChildWebsiteCulture objects filtered by the website_id column
 * @method     ChildWebsiteCulture[]|ObjectCollection findByCultureId(int $culture_id) Return ChildWebsiteCulture objects filtered by the culture_id column
 * @method     ChildWebsiteCulture[]|ObjectCollection findByDefault(boolean $default) Return ChildWebsiteCulture objects filtered by the default column
 * @method     ChildWebsiteCulture[]|ObjectCollection findByEnable(boolean $enable) Return ChildWebsiteCulture objects filtered by the enable column
 * @method     ChildWebsiteCulture[]|ObjectCollection findByRank(int $rank) Return ChildWebsiteCulture objects filtered by the rank column
 * @method     ChildWebsiteCulture[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteCultureQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteCultureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\WebsiteCulture', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteCultureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteCultureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteCultureQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteCultureQuery();
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
     * @return ChildWebsiteCulture|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteCultureTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteCultureTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWebsiteCulture A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `website_id`, `culture_id`, `default`, `enable`, `rank` FROM `website_culture` WHERE `id` = :p0';
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
            /** @var ChildWebsiteCulture $obj */
            $obj = new ChildWebsiteCulture();
            $obj->hydrate($row);
            WebsiteCultureTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWebsiteCulture|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByWebsiteId($websiteId = null, $comparison = null)
    {
        if (is_array($websiteId)) {
            $useMinMax = false;
            if (isset($websiteId['min'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_WEBSITE_ID, $websiteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteId['max'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_WEBSITE_ID, $websiteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_WEBSITE_ID, $websiteId, $comparison);
    }

    /**
     * Filter the query on the culture_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCultureId(1234); // WHERE culture_id = 1234
     * $query->filterByCultureId(array(12, 34)); // WHERE culture_id IN (12, 34)
     * $query->filterByCultureId(array('min' => 12)); // WHERE culture_id > 12
     * </code>
     *
     * @see       filterByCulture()
     *
     * @param     mixed $cultureId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByCultureId($cultureId = null, $comparison = null)
    {
        if (is_array($cultureId)) {
            $useMinMax = false;
            if (isset($cultureId['min'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_CULTURE_ID, $cultureId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cultureId['max'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_CULTURE_ID, $cultureId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_CULTURE_ID, $cultureId, $comparison);
    }

    /**
     * Filter the query on the default column
     *
     * Example usage:
     * <code>
     * $query->filterByDefault(true); // WHERE default = true
     * $query->filterByDefault('yes'); // WHERE default = true
     * </code>
     *
     * @param     boolean|string $default The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByDefault($default = null, $comparison = null)
    {
        if (is_string($default)) {
            $default = in_array(strtolower($default), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_DEFAULT, $default, $comparison);
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
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByEnable($enable = null, $comparison = null)
    {
        if (is_string($enable)) {
            $enable = in_array(strtolower($enable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_ENABLE, $enable, $comparison);
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
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByRank($rank = null, $comparison = null)
    {
        if (is_array($rank)) {
            $useMinMax = false;
            if (isset($rank['min'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_RANK, $rank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rank['max'])) {
                $this->addUsingAlias(WebsiteCultureTableMap::COL_RANK, $rank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteCultureTableMap::COL_RANK, $rank, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\Website object
     *
     * @param \CE\Model\Website|ObjectCollection $website The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByWebsite($website, $comparison = null)
    {
        if ($website instanceof \CE\Model\Website) {
            return $this
                ->addUsingAlias(WebsiteCultureTableMap::COL_WEBSITE_ID, $website->getId(), $comparison);
        } elseif ($website instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteCultureTableMap::COL_WEBSITE_ID, $website->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function joinWebsite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useWebsiteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Website', '\CE\Model\WebsiteQuery');
    }

    /**
     * Filter the query by a related \CE\Model\Culture object
     *
     * @param \CE\Model\Culture|ObjectCollection $culture The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function filterByCulture($culture, $comparison = null)
    {
        if ($culture instanceof \CE\Model\Culture) {
            return $this
                ->addUsingAlias(WebsiteCultureTableMap::COL_CULTURE_ID, $culture->getId(), $comparison);
        } elseif ($culture instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteCultureTableMap::COL_CULTURE_ID, $culture->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCulture() only accepts arguments of type \CE\Model\Culture or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Culture relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function joinCulture($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Culture');

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
            $this->addJoinObject($join, 'Culture');
        }

        return $this;
    }

    /**
     * Use the Culture relation Culture object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\CultureQuery A secondary query class using the current class as primary query
     */
    public function useCultureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCulture($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Culture', '\CE\Model\CultureQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWebsiteCulture $websiteCulture Object to remove from the list of results
     *
     * @return $this|ChildWebsiteCultureQuery The current query, for fluid interface
     */
    public function prune($websiteCulture = null)
    {
        if ($websiteCulture) {
            $this->addUsingAlias(WebsiteCultureTableMap::COL_ID, $websiteCulture->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website_culture table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteCultureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteCultureTableMap::clearInstancePool();
            WebsiteCultureTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteCultureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteCultureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteCultureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteCultureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WebsiteCultureQuery
