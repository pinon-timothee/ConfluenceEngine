<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteModuleParameter as ChildWebsiteModuleParameter;
use CE\Model\WebsiteModuleParameterQuery as ChildWebsiteModuleParameterQuery;
use CE\Model\Map\WebsiteModuleParameterTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website_module_parameter' table.
 *
 *
 *
 * @method     ChildWebsiteModuleParameterQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteModuleParameterQuery orderByWebsiteModuleId($order = Criteria::ASC) Order by the website_module_id column
 * @method     ChildWebsiteModuleParameterQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildWebsiteModuleParameterQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildWebsiteModuleParameterQuery groupById() Group by the id column
 * @method     ChildWebsiteModuleParameterQuery groupByWebsiteModuleId() Group by the website_module_id column
 * @method     ChildWebsiteModuleParameterQuery groupByKey() Group by the key column
 * @method     ChildWebsiteModuleParameterQuery groupByValue() Group by the value column
 *
 * @method     ChildWebsiteModuleParameterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteModuleParameterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteModuleParameterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteModuleParameterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteModuleParameterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteModuleParameterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteModuleParameterQuery leftJoinWebsiteModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleParameterQuery rightJoinWebsiteModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleParameterQuery innerJoinWebsiteModule($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleParameterQuery joinWithWebsiteModule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleParameterQuery leftJoinWithWebsiteModule() Adds a LEFT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleParameterQuery rightJoinWithWebsiteModule() Adds a RIGHT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleParameterQuery innerJoinWithWebsiteModule() Adds a INNER JOIN clause and with to the query using the WebsiteModule relation
 *
 * @method     \CE\Model\WebsiteModuleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsiteModuleParameter findOne(ConnectionInterface $con = null) Return the first ChildWebsiteModuleParameter matching the query
 * @method     ChildWebsiteModuleParameter findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsiteModuleParameter matching the query, or a new ChildWebsiteModuleParameter object populated from the query conditions when no match is found
 *
 * @method     ChildWebsiteModuleParameter findOneById(int $id) Return the first ChildWebsiteModuleParameter filtered by the id column
 * @method     ChildWebsiteModuleParameter findOneByWebsiteModuleId(int $website_module_id) Return the first ChildWebsiteModuleParameter filtered by the website_module_id column
 * @method     ChildWebsiteModuleParameter findOneByKey(string $key) Return the first ChildWebsiteModuleParameter filtered by the key column
 * @method     ChildWebsiteModuleParameter findOneByValue(string $value) Return the first ChildWebsiteModuleParameter filtered by the value column *

 * @method     ChildWebsiteModuleParameter requirePk($key, ConnectionInterface $con = null) Return the ChildWebsiteModuleParameter by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleParameter requireOne(ConnectionInterface $con = null) Return the first ChildWebsiteModuleParameter matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModuleParameter requireOneById(int $id) Return the first ChildWebsiteModuleParameter filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleParameter requireOneByWebsiteModuleId(int $website_module_id) Return the first ChildWebsiteModuleParameter filtered by the website_module_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleParameter requireOneByKey(string $key) Return the first ChildWebsiteModuleParameter filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleParameter requireOneByValue(string $value) Return the first ChildWebsiteModuleParameter filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModuleParameter[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsiteModuleParameter objects based on current ModelCriteria
 * @method     ChildWebsiteModuleParameter[]|ObjectCollection findById(int $id) Return ChildWebsiteModuleParameter objects filtered by the id column
 * @method     ChildWebsiteModuleParameter[]|ObjectCollection findByWebsiteModuleId(int $website_module_id) Return ChildWebsiteModuleParameter objects filtered by the website_module_id column
 * @method     ChildWebsiteModuleParameter[]|ObjectCollection findByKey(string $key) Return ChildWebsiteModuleParameter objects filtered by the key column
 * @method     ChildWebsiteModuleParameter[]|ObjectCollection findByValue(string $value) Return ChildWebsiteModuleParameter objects filtered by the value column
 * @method     ChildWebsiteModuleParameter[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteModuleParameterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteModuleParameterQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\WebsiteModuleParameter', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteModuleParameterQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteModuleParameterQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteModuleParameterQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteModuleParameterQuery();
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
     * @return ChildWebsiteModuleParameter|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteModuleParameterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteModuleParameterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWebsiteModuleParameter A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `website_module_id`, `key`, `value` FROM `website_module_parameter` WHERE `id` = :p0';
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
            /** @var ChildWebsiteModuleParameter $obj */
            $obj = new ChildWebsiteModuleParameter();
            $obj->hydrate($row);
            WebsiteModuleParameterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWebsiteModuleParameter|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterByWebsiteModuleId($websiteModuleId = null, $comparison = null)
    {
        if (is_array($websiteModuleId)) {
            $useMinMax = false;
            if (isset($websiteModuleId['min'])) {
                $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_WEBSITE_MODULE_ID, $websiteModuleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteModuleId['max'])) {
                $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_WEBSITE_MODULE_ID, $websiteModuleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_WEBSITE_MODULE_ID, $websiteModuleId, $comparison);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $key The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterByKey($key = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($key)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_KEY, $key, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModule object
     *
     * @param \CE\Model\WebsiteModule|ObjectCollection $websiteModule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function filterByWebsiteModule($websiteModule, $comparison = null)
    {
        if ($websiteModule instanceof \CE\Model\WebsiteModule) {
            return $this
                ->addUsingAlias(WebsiteModuleParameterTableMap::COL_WEBSITE_MODULE_ID, $websiteModule->getId(), $comparison);
        } elseif ($websiteModule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteModuleParameterTableMap::COL_WEBSITE_MODULE_ID, $websiteModule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildWebsiteModuleParameter $websiteModuleParameter Object to remove from the list of results
     *
     * @return $this|ChildWebsiteModuleParameterQuery The current query, for fluid interface
     */
    public function prune($websiteModuleParameter = null)
    {
        if ($websiteModuleParameter) {
            $this->addUsingAlias(WebsiteModuleParameterTableMap::COL_ID, $websiteModuleParameter->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website_module_parameter table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleParameterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteModuleParameterTableMap::clearInstancePool();
            WebsiteModuleParameterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleParameterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteModuleParameterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteModuleParameterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteModuleParameterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WebsiteModuleParameterQuery
