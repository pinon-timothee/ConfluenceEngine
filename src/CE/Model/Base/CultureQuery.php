<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Culture as ChildCulture;
use CE\Model\CultureQuery as ChildCultureQuery;
use CE\Model\Map\CultureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'culture' table.
 *
 *
 *
 * @method     ChildCultureQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCultureQuery orderByCulture($order = Criteria::ASC) Order by the culture column
 * @method     ChildCultureQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCultureQuery orderByGuess($order = Criteria::ASC) Order by the guess column
 *
 * @method     ChildCultureQuery groupById() Group by the id column
 * @method     ChildCultureQuery groupByCulture() Group by the culture column
 * @method     ChildCultureQuery groupByName() Group by the name column
 * @method     ChildCultureQuery groupByGuess() Group by the guess column
 *
 * @method     ChildCultureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCultureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCultureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCultureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCultureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCultureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCultureQuery leftJoinWebsiteCulture($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteCulture relation
 * @method     ChildCultureQuery rightJoinWebsiteCulture($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteCulture relation
 * @method     ChildCultureQuery innerJoinWebsiteCulture($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteCulture relation
 *
 * @method     ChildCultureQuery joinWithWebsiteCulture($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteCulture relation
 *
 * @method     ChildCultureQuery leftJoinWithWebsiteCulture() Adds a LEFT JOIN clause and with to the query using the WebsiteCulture relation
 * @method     ChildCultureQuery rightJoinWithWebsiteCulture() Adds a RIGHT JOIN clause and with to the query using the WebsiteCulture relation
 * @method     ChildCultureQuery innerJoinWithWebsiteCulture() Adds a INNER JOIN clause and with to the query using the WebsiteCulture relation
 *
 * @method     \CE\Model\WebsiteCultureQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCulture findOne(ConnectionInterface $con = null) Return the first ChildCulture matching the query
 * @method     ChildCulture findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCulture matching the query, or a new ChildCulture object populated from the query conditions when no match is found
 *
 * @method     ChildCulture findOneById(int $id) Return the first ChildCulture filtered by the id column
 * @method     ChildCulture findOneByCulture(string $culture) Return the first ChildCulture filtered by the culture column
 * @method     ChildCulture findOneByName(string $name) Return the first ChildCulture filtered by the name column
 * @method     ChildCulture findOneByGuess(string $guess) Return the first ChildCulture filtered by the guess column *

 * @method     ChildCulture requirePk($key, ConnectionInterface $con = null) Return the ChildCulture by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulture requireOne(ConnectionInterface $con = null) Return the first ChildCulture matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCulture requireOneById(int $id) Return the first ChildCulture filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulture requireOneByCulture(string $culture) Return the first ChildCulture filtered by the culture column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulture requireOneByName(string $name) Return the first ChildCulture filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulture requireOneByGuess(string $guess) Return the first ChildCulture filtered by the guess column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCulture[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCulture objects based on current ModelCriteria
 * @method     ChildCulture[]|ObjectCollection findById(int $id) Return ChildCulture objects filtered by the id column
 * @method     ChildCulture[]|ObjectCollection findByCulture(string $culture) Return ChildCulture objects filtered by the culture column
 * @method     ChildCulture[]|ObjectCollection findByName(string $name) Return ChildCulture objects filtered by the name column
 * @method     ChildCulture[]|ObjectCollection findByGuess(string $guess) Return ChildCulture objects filtered by the guess column
 * @method     ChildCulture[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CultureQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\CultureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\Culture', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCultureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCultureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCultureQuery) {
            return $criteria;
        }
        $query = new ChildCultureQuery();
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
     * @return ChildCulture|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CultureTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CultureTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCulture A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `culture`, `name`, `guess` FROM `culture` WHERE `id` = :p0';
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
            /** @var ChildCulture $obj */
            $obj = new ChildCulture();
            $obj->hydrate($row);
            CultureTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCulture|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CultureTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CultureTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CultureTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CultureTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CultureTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function filterByCulture($culture = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($culture)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CultureTableMap::COL_CULTURE, $culture, $comparison);
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
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CultureTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the guess column
     *
     * Example usage:
     * <code>
     * $query->filterByGuess('fooValue');   // WHERE guess = 'fooValue'
     * $query->filterByGuess('%fooValue%', Criteria::LIKE); // WHERE guess LIKE '%fooValue%'
     * </code>
     *
     * @param     string $guess The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function filterByGuess($guess = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guess)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CultureTableMap::COL_GUESS, $guess, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteCulture object
     *
     * @param \CE\Model\WebsiteCulture|ObjectCollection $websiteCulture the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCultureQuery The current query, for fluid interface
     */
    public function filterByWebsiteCulture($websiteCulture, $comparison = null)
    {
        if ($websiteCulture instanceof \CE\Model\WebsiteCulture) {
            return $this
                ->addUsingAlias(CultureTableMap::COL_ID, $websiteCulture->getCultureId(), $comparison);
        } elseif ($websiteCulture instanceof ObjectCollection) {
            return $this
                ->useWebsiteCultureQuery()
                ->filterByPrimaryKeys($websiteCulture->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteCulture() only accepts arguments of type \CE\Model\WebsiteCulture or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteCulture relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function joinWebsiteCulture($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteCulture');

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
            $this->addJoinObject($join, 'WebsiteCulture');
        }

        return $this;
    }

    /**
     * Use the WebsiteCulture relation WebsiteCulture object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteCultureQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteCultureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteCulture($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteCulture', '\CE\Model\WebsiteCultureQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCulture $culture Object to remove from the list of results
     *
     * @return $this|ChildCultureQuery The current query, for fluid interface
     */
    public function prune($culture = null)
    {
        if ($culture) {
            $this->addUsingAlias(CultureTableMap::COL_ID, $culture->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the culture table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CultureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CultureTableMap::clearInstancePool();
            CultureTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CultureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CultureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CultureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CultureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CultureQuery
