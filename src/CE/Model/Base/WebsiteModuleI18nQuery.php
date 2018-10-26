<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteModuleI18n as ChildWebsiteModuleI18n;
use CE\Model\WebsiteModuleI18nQuery as ChildWebsiteModuleI18nQuery;
use CE\Model\Map\WebsiteModuleI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website_module_i18n' table.
 *
 *
 *
 * @method     ChildWebsiteModuleI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteModuleI18nQuery orderByCulture($order = Criteria::ASC) Order by the culture column
 * @method     ChildWebsiteModuleI18nQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildWebsiteModuleI18nQuery orderByContent($order = Criteria::ASC) Order by the content column
 *
 * @method     ChildWebsiteModuleI18nQuery groupById() Group by the id column
 * @method     ChildWebsiteModuleI18nQuery groupByCulture() Group by the culture column
 * @method     ChildWebsiteModuleI18nQuery groupByTitle() Group by the title column
 * @method     ChildWebsiteModuleI18nQuery groupByContent() Group by the content column
 *
 * @method     ChildWebsiteModuleI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteModuleI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteModuleI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteModuleI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteModuleI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteModuleI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteModuleI18nQuery leftJoinWebsiteModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleI18nQuery rightJoinWebsiteModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleI18nQuery innerJoinWebsiteModule($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleI18nQuery joinWithWebsiteModule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteModuleI18nQuery leftJoinWithWebsiteModule() Adds a LEFT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleI18nQuery rightJoinWithWebsiteModule() Adds a RIGHT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteModuleI18nQuery innerJoinWithWebsiteModule() Adds a INNER JOIN clause and with to the query using the WebsiteModule relation
 *
 * @method     \CE\Model\WebsiteModuleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsiteModuleI18n findOne(ConnectionInterface $con = null) Return the first ChildWebsiteModuleI18n matching the query
 * @method     ChildWebsiteModuleI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsiteModuleI18n matching the query, or a new ChildWebsiteModuleI18n object populated from the query conditions when no match is found
 *
 * @method     ChildWebsiteModuleI18n findOneById(int $id) Return the first ChildWebsiteModuleI18n filtered by the id column
 * @method     ChildWebsiteModuleI18n findOneByCulture(string $culture) Return the first ChildWebsiteModuleI18n filtered by the culture column
 * @method     ChildWebsiteModuleI18n findOneByTitle(string $title) Return the first ChildWebsiteModuleI18n filtered by the title column
 * @method     ChildWebsiteModuleI18n findOneByContent(string $content) Return the first ChildWebsiteModuleI18n filtered by the content column *

 * @method     ChildWebsiteModuleI18n requirePk($key, ConnectionInterface $con = null) Return the ChildWebsiteModuleI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleI18n requireOne(ConnectionInterface $con = null) Return the first ChildWebsiteModuleI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModuleI18n requireOneById(int $id) Return the first ChildWebsiteModuleI18n filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleI18n requireOneByCulture(string $culture) Return the first ChildWebsiteModuleI18n filtered by the culture column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleI18n requireOneByTitle(string $title) Return the first ChildWebsiteModuleI18n filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModuleI18n requireOneByContent(string $content) Return the first ChildWebsiteModuleI18n filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModuleI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsiteModuleI18n objects based on current ModelCriteria
 * @method     ChildWebsiteModuleI18n[]|ObjectCollection findById(int $id) Return ChildWebsiteModuleI18n objects filtered by the id column
 * @method     ChildWebsiteModuleI18n[]|ObjectCollection findByCulture(string $culture) Return ChildWebsiteModuleI18n objects filtered by the culture column
 * @method     ChildWebsiteModuleI18n[]|ObjectCollection findByTitle(string $title) Return ChildWebsiteModuleI18n objects filtered by the title column
 * @method     ChildWebsiteModuleI18n[]|ObjectCollection findByContent(string $content) Return ChildWebsiteModuleI18n objects filtered by the content column
 * @method     ChildWebsiteModuleI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteModuleI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteModuleI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\WebsiteModuleI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteModuleI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteModuleI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteModuleI18nQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteModuleI18nQuery();
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
     * @param array[$id, $culture] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWebsiteModuleI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteModuleI18nTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteModuleI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildWebsiteModuleI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `culture`, `title`, `content` FROM `website_module_i18n` WHERE `id` = :p0 AND `culture` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWebsiteModuleI18n $obj */
            $obj = new ChildWebsiteModuleI18n();
            $obj->hydrate($row);
            WebsiteModuleI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWebsiteModuleI18n|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_CULTURE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WebsiteModuleI18nTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WebsiteModuleI18nTableMap::COL_CULTURE, $key[1], Criteria::EQUAL);
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
     * @see       filterByWebsiteModule()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterByCulture($culture = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($culture)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_CULTURE, $culture, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%', Criteria::LIKE); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleI18nTableMap::COL_CONTENT, $content, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModule object
     *
     * @param \CE\Model\WebsiteModule|ObjectCollection $websiteModule The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function filterByWebsiteModule($websiteModule, $comparison = null)
    {
        if ($websiteModule instanceof \CE\Model\WebsiteModule) {
            return $this
                ->addUsingAlias(WebsiteModuleI18nTableMap::COL_ID, $websiteModule->getId(), $comparison);
        } elseif ($websiteModule instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteModuleI18nTableMap::COL_ID, $websiteModule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function joinWebsiteModule($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function useWebsiteModuleQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinWebsiteModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModule', '\CE\Model\WebsiteModuleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWebsiteModuleI18n $websiteModuleI18n Object to remove from the list of results
     *
     * @return $this|ChildWebsiteModuleI18nQuery The current query, for fluid interface
     */
    public function prune($websiteModuleI18n = null)
    {
        if ($websiteModuleI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WebsiteModuleI18nTableMap::COL_ID), $websiteModuleI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WebsiteModuleI18nTableMap::COL_CULTURE), $websiteModuleI18n->getCulture(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website_module_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteModuleI18nTableMap::clearInstancePool();
            WebsiteModuleI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteModuleI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteModuleI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteModuleI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WebsiteModuleI18nQuery
