<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\UserWebsite as ChildUserWebsite;
use CE\Model\UserWebsiteQuery as ChildUserWebsiteQuery;
use CE\Model\Map\UserWebsiteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_website' table.
 *
 *
 *
 * @method     ChildUserWebsiteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserWebsiteQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserWebsiteQuery orderByWebsiteId($order = Criteria::ASC) Order by the website_id column
 *
 * @method     ChildUserWebsiteQuery groupById() Group by the id column
 * @method     ChildUserWebsiteQuery groupByUserId() Group by the user_id column
 * @method     ChildUserWebsiteQuery groupByWebsiteId() Group by the website_id column
 *
 * @method     ChildUserWebsiteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserWebsiteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserWebsiteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserWebsiteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserWebsiteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserWebsiteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserWebsiteQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserWebsiteQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserWebsiteQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserWebsiteQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserWebsiteQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserWebsiteQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserWebsiteQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildUserWebsiteQuery leftJoinWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Website relation
 * @method     ChildUserWebsiteQuery rightJoinWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Website relation
 * @method     ChildUserWebsiteQuery innerJoinWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the Website relation
 *
 * @method     ChildUserWebsiteQuery joinWithWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Website relation
 *
 * @method     ChildUserWebsiteQuery leftJoinWithWebsite() Adds a LEFT JOIN clause and with to the query using the Website relation
 * @method     ChildUserWebsiteQuery rightJoinWithWebsite() Adds a RIGHT JOIN clause and with to the query using the Website relation
 * @method     ChildUserWebsiteQuery innerJoinWithWebsite() Adds a INNER JOIN clause and with to the query using the Website relation
 *
 * @method     \CE\Model\UserQuery|\CE\Model\WebsiteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserWebsite findOne(ConnectionInterface $con = null) Return the first ChildUserWebsite matching the query
 * @method     ChildUserWebsite findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserWebsite matching the query, or a new ChildUserWebsite object populated from the query conditions when no match is found
 *
 * @method     ChildUserWebsite findOneById(int $id) Return the first ChildUserWebsite filtered by the id column
 * @method     ChildUserWebsite findOneByUserId(int $user_id) Return the first ChildUserWebsite filtered by the user_id column
 * @method     ChildUserWebsite findOneByWebsiteId(int $website_id) Return the first ChildUserWebsite filtered by the website_id column *

 * @method     ChildUserWebsite requirePk($key, ConnectionInterface $con = null) Return the ChildUserWebsite by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWebsite requireOne(ConnectionInterface $con = null) Return the first ChildUserWebsite matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWebsite requireOneById(int $id) Return the first ChildUserWebsite filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWebsite requireOneByUserId(int $user_id) Return the first ChildUserWebsite filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWebsite requireOneByWebsiteId(int $website_id) Return the first ChildUserWebsite filtered by the website_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWebsite[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserWebsite objects based on current ModelCriteria
 * @method     ChildUserWebsite[]|ObjectCollection findById(int $id) Return ChildUserWebsite objects filtered by the id column
 * @method     ChildUserWebsite[]|ObjectCollection findByUserId(int $user_id) Return ChildUserWebsite objects filtered by the user_id column
 * @method     ChildUserWebsite[]|ObjectCollection findByWebsiteId(int $website_id) Return ChildUserWebsite objects filtered by the website_id column
 * @method     ChildUserWebsite[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserWebsiteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\UserWebsiteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\UserWebsite', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserWebsiteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserWebsiteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserWebsiteQuery) {
            return $criteria;
        }
        $query = new ChildUserWebsiteQuery();
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
     * @return ChildUserWebsite|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserWebsiteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserWebsiteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserWebsite A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `user_id`, `website_id` FROM `user_website` WHERE `id` = :p0';
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
            /** @var ChildUserWebsite $obj */
            $obj = new ChildUserWebsite();
            $obj->hydrate($row);
            UserWebsiteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserWebsite|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserWebsiteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserWebsiteTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserWebsiteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserWebsiteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWebsiteTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserWebsiteTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserWebsiteTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWebsiteTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteId($websiteId = null, $comparison = null)
    {
        if (is_array($websiteId)) {
            $useMinMax = false;
            if (isset($websiteId['min'])) {
                $this->addUsingAlias(UserWebsiteTableMap::COL_WEBSITE_ID, $websiteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteId['max'])) {
                $this->addUsingAlias(UserWebsiteTableMap::COL_WEBSITE_ID, $websiteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWebsiteTableMap::COL_WEBSITE_ID, $websiteId, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\User object
     *
     * @param \CE\Model\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \CE\Model\User) {
            return $this
                ->addUsingAlias(UserWebsiteTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserWebsiteTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\CE\Model\UserQuery');
    }

    /**
     * Filter the query by a related \CE\Model\Website object
     *
     * @param \CE\Model\Website|ObjectCollection $website The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsite($website, $comparison = null)
    {
        if ($website instanceof \CE\Model\Website) {
            return $this
                ->addUsingAlias(UserWebsiteTableMap::COL_WEBSITE_ID, $website->getId(), $comparison);
        } elseif ($website instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserWebsiteTableMap::COL_WEBSITE_ID, $website->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildUserWebsite $userWebsite Object to remove from the list of results
     *
     * @return $this|ChildUserWebsiteQuery The current query, for fluid interface
     */
    public function prune($userWebsite = null)
    {
        if ($userWebsite) {
            $this->addUsingAlias(UserWebsiteTableMap::COL_ID, $userWebsite->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_website table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserWebsiteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserWebsiteTableMap::clearInstancePool();
            UserWebsiteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserWebsiteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserWebsiteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserWebsiteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserWebsiteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserWebsiteQuery
