<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteRouting as ChildWebsiteRouting;
use CE\Model\WebsiteRoutingI18nQuery as ChildWebsiteRoutingI18nQuery;
use CE\Model\WebsiteRoutingQuery as ChildWebsiteRoutingQuery;
use CE\Model\Map\WebsiteRoutingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website_routing' table.
 *
 *
 *
 * @method     ChildWebsiteRoutingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteRoutingQuery orderByWebsiteId($order = Criteria::ASC) Order by the website_id column
 * @method     ChildWebsiteRoutingQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildWebsiteRoutingQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildWebsiteRoutingQuery orderByEnable($order = Criteria::ASC) Order by the enable column
 * @method     ChildWebsiteRoutingQuery orderByPage($order = Criteria::ASC) Order by the page column
 * @method     ChildWebsiteRoutingQuery orderByJavascript($order = Criteria::ASC) Order by the javascript column
 * @method     ChildWebsiteRoutingQuery orderByStylesheet($order = Criteria::ASC) Order by the stylesheet column
 * @method     ChildWebsiteRoutingQuery orderByController($order = Criteria::ASC) Order by the controller column
 * @method     ChildWebsiteRoutingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWebsiteRoutingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildWebsiteRoutingQuery groupById() Group by the id column
 * @method     ChildWebsiteRoutingQuery groupByWebsiteId() Group by the website_id column
 * @method     ChildWebsiteRoutingQuery groupByComment() Group by the comment column
 * @method     ChildWebsiteRoutingQuery groupByTags() Group by the tags column
 * @method     ChildWebsiteRoutingQuery groupByEnable() Group by the enable column
 * @method     ChildWebsiteRoutingQuery groupByPage() Group by the page column
 * @method     ChildWebsiteRoutingQuery groupByJavascript() Group by the javascript column
 * @method     ChildWebsiteRoutingQuery groupByStylesheet() Group by the stylesheet column
 * @method     ChildWebsiteRoutingQuery groupByController() Group by the controller column
 * @method     ChildWebsiteRoutingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWebsiteRoutingQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildWebsiteRoutingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteRoutingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteRoutingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteRoutingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteRoutingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Website relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Website relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the Website relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Website relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsite() Adds a LEFT JOIN clause and with to the query using the Website relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsite() Adds a RIGHT JOIN clause and with to the query using the Website relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsite() Adds a INNER JOIN clause and with to the query using the Website relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinMeta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Meta relation
 * @method     ChildWebsiteRoutingQuery rightJoinMeta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Meta relation
 * @method     ChildWebsiteRoutingQuery innerJoinMeta($relationAlias = null) Adds a INNER JOIN clause to the query using the Meta relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithMeta($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Meta relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithMeta() Adds a LEFT JOIN clause and with to the query using the Meta relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithMeta() Adds a RIGHT JOIN clause and with to the query using the Meta relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithMeta() Adds a INNER JOIN clause and with to the query using the Meta relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsiteRedirection($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsiteRedirection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsiteRedirection($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRedirection relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsiteRedirection($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRedirection relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsiteRedirection() Adds a LEFT JOIN clause and with to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsiteRedirection() Adds a RIGHT JOIN clause and with to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsiteRedirection() Adds a INNER JOIN clause and with to the query using the WebsiteRedirection relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsiteRoutingI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRoutingI18n relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsiteRoutingI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRoutingI18n relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsiteRoutingI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRoutingI18n relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsiteRoutingI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRoutingI18n relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsiteRoutingI18n() Adds a LEFT JOIN clause and with to the query using the WebsiteRoutingI18n relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsiteRoutingI18n() Adds a RIGHT JOIN clause and with to the query using the WebsiteRoutingI18n relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsiteRoutingI18n() Adds a INNER JOIN clause and with to the query using the WebsiteRoutingI18n relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsiteRoutingPath($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRoutingPath relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsiteRoutingPath($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRoutingPath relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsiteRoutingPath($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRoutingPath relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsiteRoutingPath($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRoutingPath relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsiteRoutingPath() Adds a LEFT JOIN clause and with to the query using the WebsiteRoutingPath relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsiteRoutingPath() Adds a RIGHT JOIN clause and with to the query using the WebsiteRoutingPath relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsiteRoutingPath() Adds a INNER JOIN clause and with to the query using the WebsiteRoutingPath relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsiteRoutingParameter($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRoutingParameter relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsiteRoutingParameter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRoutingParameter relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsiteRoutingParameter($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRoutingParameter relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsiteRoutingParameter($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRoutingParameter relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsiteRoutingParameter() Adds a LEFT JOIN clause and with to the query using the WebsiteRoutingParameter relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsiteRoutingParameter() Adds a RIGHT JOIN clause and with to the query using the WebsiteRoutingParameter relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsiteRoutingParameter() Adds a INNER JOIN clause and with to the query using the WebsiteRoutingParameter relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsiteModuleLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsiteModuleLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsiteModuleLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModuleLocation relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsiteModuleLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModuleLocation relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsiteModuleLocation() Adds a LEFT JOIN clause and with to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsiteModuleLocation() Adds a RIGHT JOIN clause and with to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsiteModuleLocation() Adds a INNER JOIN clause and with to the query using the WebsiteModuleLocation relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWebsiteZone($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteZone relation
 * @method     ChildWebsiteRoutingQuery rightJoinWebsiteZone($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteZone relation
 * @method     ChildWebsiteRoutingQuery innerJoinWebsiteZone($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteZone relation
 *
 * @method     ChildWebsiteRoutingQuery joinWithWebsiteZone($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteZone relation
 *
 * @method     ChildWebsiteRoutingQuery leftJoinWithWebsiteZone() Adds a LEFT JOIN clause and with to the query using the WebsiteZone relation
 * @method     ChildWebsiteRoutingQuery rightJoinWithWebsiteZone() Adds a RIGHT JOIN clause and with to the query using the WebsiteZone relation
 * @method     ChildWebsiteRoutingQuery innerJoinWithWebsiteZone() Adds a INNER JOIN clause and with to the query using the WebsiteZone relation
 *
 * @method     \CE\Model\WebsiteQuery|\CE\Model\MetaQuery|\CE\Model\WebsiteRedirectionQuery|\CE\Model\WebsiteRoutingI18nQuery|\CE\Model\WebsiteRoutingPathQuery|\CE\Model\WebsiteRoutingParameterQuery|\CE\Model\WebsiteModuleLocationQuery|\CE\Model\WebsiteZoneQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsiteRouting findOne(ConnectionInterface $con = null) Return the first ChildWebsiteRouting matching the query
 * @method     ChildWebsiteRouting findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsiteRouting matching the query, or a new ChildWebsiteRouting object populated from the query conditions when no match is found
 *
 * @method     ChildWebsiteRouting findOneById(int $id) Return the first ChildWebsiteRouting filtered by the id column
 * @method     ChildWebsiteRouting findOneByWebsiteId(int $website_id) Return the first ChildWebsiteRouting filtered by the website_id column
 * @method     ChildWebsiteRouting findOneByComment(string $comment) Return the first ChildWebsiteRouting filtered by the comment column
 * @method     ChildWebsiteRouting findOneByTags(string $tags) Return the first ChildWebsiteRouting filtered by the tags column
 * @method     ChildWebsiteRouting findOneByEnable(boolean $enable) Return the first ChildWebsiteRouting filtered by the enable column
 * @method     ChildWebsiteRouting findOneByPage(string $page) Return the first ChildWebsiteRouting filtered by the page column
 * @method     ChildWebsiteRouting findOneByJavascript(string $javascript) Return the first ChildWebsiteRouting filtered by the javascript column
 * @method     ChildWebsiteRouting findOneByStylesheet(string $stylesheet) Return the first ChildWebsiteRouting filtered by the stylesheet column
 * @method     ChildWebsiteRouting findOneByController(string $controller) Return the first ChildWebsiteRouting filtered by the controller column
 * @method     ChildWebsiteRouting findOneByCreatedAt(string $created_at) Return the first ChildWebsiteRouting filtered by the created_at column
 * @method     ChildWebsiteRouting findOneByUpdatedAt(string $updated_at) Return the first ChildWebsiteRouting filtered by the updated_at column *

 * @method     ChildWebsiteRouting requirePk($key, ConnectionInterface $con = null) Return the ChildWebsiteRouting by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOne(ConnectionInterface $con = null) Return the first ChildWebsiteRouting matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteRouting requireOneById(int $id) Return the first ChildWebsiteRouting filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByWebsiteId(int $website_id) Return the first ChildWebsiteRouting filtered by the website_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByComment(string $comment) Return the first ChildWebsiteRouting filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByTags(string $tags) Return the first ChildWebsiteRouting filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByEnable(boolean $enable) Return the first ChildWebsiteRouting filtered by the enable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByPage(string $page) Return the first ChildWebsiteRouting filtered by the page column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByJavascript(string $javascript) Return the first ChildWebsiteRouting filtered by the javascript column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByStylesheet(string $stylesheet) Return the first ChildWebsiteRouting filtered by the stylesheet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByController(string $controller) Return the first ChildWebsiteRouting filtered by the controller column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByCreatedAt(string $created_at) Return the first ChildWebsiteRouting filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteRouting requireOneByUpdatedAt(string $updated_at) Return the first ChildWebsiteRouting filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteRouting[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsiteRouting objects based on current ModelCriteria
 * @method     ChildWebsiteRouting[]|ObjectCollection findById(int $id) Return ChildWebsiteRouting objects filtered by the id column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByWebsiteId(int $website_id) Return ChildWebsiteRouting objects filtered by the website_id column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByComment(string $comment) Return ChildWebsiteRouting objects filtered by the comment column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByTags(string $tags) Return ChildWebsiteRouting objects filtered by the tags column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByEnable(boolean $enable) Return ChildWebsiteRouting objects filtered by the enable column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByPage(string $page) Return ChildWebsiteRouting objects filtered by the page column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByJavascript(string $javascript) Return ChildWebsiteRouting objects filtered by the javascript column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByStylesheet(string $stylesheet) Return ChildWebsiteRouting objects filtered by the stylesheet column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByController(string $controller) Return ChildWebsiteRouting objects filtered by the controller column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildWebsiteRouting objects filtered by the created_at column
 * @method     ChildWebsiteRouting[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildWebsiteRouting objects filtered by the updated_at column
 * @method     ChildWebsiteRouting[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteRoutingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteRoutingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\WebsiteRouting', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteRoutingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteRoutingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteRoutingQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteRoutingQuery();
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
     * @return ChildWebsiteRouting|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteRoutingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWebsiteRouting A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `website_id`, `comment`, `tags`, `enable`, `page`, `javascript`, `stylesheet`, `controller`, `created_at`, `updated_at` FROM `website_routing` WHERE `id` = :p0';
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
            /** @var ChildWebsiteRouting $obj */
            $obj = new ChildWebsiteRouting();
            $obj->hydrate($row);
            WebsiteRoutingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWebsiteRouting|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteId($websiteId = null, $comparison = null)
    {
        if (is_array($websiteId)) {
            $useMinMax = false;
            if (isset($websiteId['min'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_WEBSITE_ID, $websiteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteId['max'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_WEBSITE_ID, $websiteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_WEBSITE_ID, $websiteId, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_COMMENT, $comment, $comparison);
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags('fooValue');   // WHERE tags = 'fooValue'
     * $query->filterByTags('%fooValue%', Criteria::LIKE); // WHERE tags LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tags The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByTags($tags = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_TAGS, $tags, $comparison);
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
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByEnable($enable = null, $comparison = null)
    {
        if (is_string($enable)) {
            $enable = in_array(strtolower($enable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_ENABLE, $enable, $comparison);
    }

    /**
     * Filter the query on the page column
     *
     * Example usage:
     * <code>
     * $query->filterByPage('fooValue');   // WHERE page = 'fooValue'
     * $query->filterByPage('%fooValue%', Criteria::LIKE); // WHERE page LIKE '%fooValue%'
     * </code>
     *
     * @param     string $page The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByPage($page = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($page)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_PAGE, $page, $comparison);
    }

    /**
     * Filter the query on the javascript column
     *
     * Example usage:
     * <code>
     * $query->filterByJavascript('fooValue');   // WHERE javascript = 'fooValue'
     * $query->filterByJavascript('%fooValue%', Criteria::LIKE); // WHERE javascript LIKE '%fooValue%'
     * </code>
     *
     * @param     string $javascript The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByJavascript($javascript = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($javascript)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_JAVASCRIPT, $javascript, $comparison);
    }

    /**
     * Filter the query on the stylesheet column
     *
     * Example usage:
     * <code>
     * $query->filterByStylesheet('fooValue');   // WHERE stylesheet = 'fooValue'
     * $query->filterByStylesheet('%fooValue%', Criteria::LIKE); // WHERE stylesheet LIKE '%fooValue%'
     * </code>
     *
     * @param     string $stylesheet The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByStylesheet($stylesheet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stylesheet)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_STYLESHEET, $stylesheet, $comparison);
    }

    /**
     * Filter the query on the controller column
     *
     * Example usage:
     * <code>
     * $query->filterByController('fooValue');   // WHERE controller = 'fooValue'
     * $query->filterByController('%fooValue%', Criteria::LIKE); // WHERE controller LIKE '%fooValue%'
     * </code>
     *
     * @param     string $controller The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByController($controller = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($controller)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_CONTROLLER, $controller, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WebsiteRoutingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\Website object
     *
     * @param \CE\Model\Website|ObjectCollection $website The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsite($website, $comparison = null)
    {
        if ($website instanceof \CE\Model\Website) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_WEBSITE_ID, $website->getId(), $comparison);
        } elseif ($website instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_WEBSITE_ID, $website->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
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
     * Filter the query by a related \CE\Model\Meta object
     *
     * @param \CE\Model\Meta|ObjectCollection $meta the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByMeta($meta, $comparison = null)
    {
        if ($meta instanceof \CE\Model\Meta) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $meta->getWebsiteRoutingId(), $comparison);
        } elseif ($meta instanceof ObjectCollection) {
            return $this
                ->useMetaQuery()
                ->filterByPrimaryKeys($meta->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMeta() only accepts arguments of type \CE\Model\Meta or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Meta relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinMeta($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Meta');

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
            $this->addJoinObject($join, 'Meta');
        }

        return $this;
    }

    /**
     * Use the Meta relation Meta object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\MetaQuery A secondary query class using the current class as primary query
     */
    public function useMetaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMeta($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Meta', '\CE\Model\MetaQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRedirection object
     *
     * @param \CE\Model\WebsiteRedirection|ObjectCollection $websiteRedirection the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteRedirection($websiteRedirection, $comparison = null)
    {
        if ($websiteRedirection instanceof \CE\Model\WebsiteRedirection) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteRedirection->getWebsiteRoutingId(), $comparison);
        } elseif ($websiteRedirection instanceof ObjectCollection) {
            return $this
                ->useWebsiteRedirectionQuery()
                ->filterByPrimaryKeys($websiteRedirection->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteRedirection() only accepts arguments of type \CE\Model\WebsiteRedirection or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteRedirection relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWebsiteRedirection($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteRedirection');

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
            $this->addJoinObject($join, 'WebsiteRedirection');
        }

        return $this;
    }

    /**
     * Use the WebsiteRedirection relation WebsiteRedirection object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteRedirectionQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteRedirectionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteRedirection($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRedirection', '\CE\Model\WebsiteRedirectionQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRoutingI18n object
     *
     * @param \CE\Model\WebsiteRoutingI18n|ObjectCollection $websiteRoutingI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteRoutingI18n($websiteRoutingI18n, $comparison = null)
    {
        if ($websiteRoutingI18n instanceof \CE\Model\WebsiteRoutingI18n) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteRoutingI18n->getWebsiteRoutingId(), $comparison);
        } elseif ($websiteRoutingI18n instanceof ObjectCollection) {
            return $this
                ->useWebsiteRoutingI18nQuery()
                ->filterByPrimaryKeys($websiteRoutingI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteRoutingI18n() only accepts arguments of type \CE\Model\WebsiteRoutingI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteRoutingI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWebsiteRoutingI18n($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteRoutingI18n');

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
            $this->addJoinObject($join, 'WebsiteRoutingI18n');
        }

        return $this;
    }

    /**
     * Use the WebsiteRoutingI18n relation WebsiteRoutingI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteRoutingI18nQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteRoutingI18nQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteRoutingI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRoutingI18n', '\CE\Model\WebsiteRoutingI18nQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRoutingPath object
     *
     * @param \CE\Model\WebsiteRoutingPath|ObjectCollection $websiteRoutingPath the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteRoutingPath($websiteRoutingPath, $comparison = null)
    {
        if ($websiteRoutingPath instanceof \CE\Model\WebsiteRoutingPath) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteRoutingPath->getWebsiteRoutingId(), $comparison);
        } elseif ($websiteRoutingPath instanceof ObjectCollection) {
            return $this
                ->useWebsiteRoutingPathQuery()
                ->filterByPrimaryKeys($websiteRoutingPath->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteRoutingPath() only accepts arguments of type \CE\Model\WebsiteRoutingPath or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteRoutingPath relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWebsiteRoutingPath($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteRoutingPath');

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
            $this->addJoinObject($join, 'WebsiteRoutingPath');
        }

        return $this;
    }

    /**
     * Use the WebsiteRoutingPath relation WebsiteRoutingPath object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteRoutingPathQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteRoutingPathQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteRoutingPath($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRoutingPath', '\CE\Model\WebsiteRoutingPathQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRoutingParameter object
     *
     * @param \CE\Model\WebsiteRoutingParameter|ObjectCollection $websiteRoutingParameter the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteRoutingParameter($websiteRoutingParameter, $comparison = null)
    {
        if ($websiteRoutingParameter instanceof \CE\Model\WebsiteRoutingParameter) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteRoutingParameter->getWebsiteRoutingId(), $comparison);
        } elseif ($websiteRoutingParameter instanceof ObjectCollection) {
            return $this
                ->useWebsiteRoutingParameterQuery()
                ->filterByPrimaryKeys($websiteRoutingParameter->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteRoutingParameter() only accepts arguments of type \CE\Model\WebsiteRoutingParameter or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteRoutingParameter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWebsiteRoutingParameter($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteRoutingParameter');

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
            $this->addJoinObject($join, 'WebsiteRoutingParameter');
        }

        return $this;
    }

    /**
     * Use the WebsiteRoutingParameter relation WebsiteRoutingParameter object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteRoutingParameterQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteRoutingParameterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteRoutingParameter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRoutingParameter', '\CE\Model\WebsiteRoutingParameterQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModuleLocation object
     *
     * @param \CE\Model\WebsiteModuleLocation|ObjectCollection $websiteModuleLocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteModuleLocation($websiteModuleLocation, $comparison = null)
    {
        if ($websiteModuleLocation instanceof \CE\Model\WebsiteModuleLocation) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteModuleLocation->getWebsiteRoutingId(), $comparison);
        } elseif ($websiteModuleLocation instanceof ObjectCollection) {
            return $this
                ->useWebsiteModuleLocationQuery()
                ->filterByPrimaryKeys($websiteModuleLocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteModuleLocation() only accepts arguments of type \CE\Model\WebsiteModuleLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteModuleLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWebsiteModuleLocation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteModuleLocation');

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
            $this->addJoinObject($join, 'WebsiteModuleLocation');
        }

        return $this;
    }

    /**
     * Use the WebsiteModuleLocation relation WebsiteModuleLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteModuleLocationQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteModuleLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWebsiteModuleLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModuleLocation', '\CE\Model\WebsiteModuleLocationQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteZone object
     *
     * @param \CE\Model\WebsiteZone|ObjectCollection $websiteZone the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteZone($websiteZone, $comparison = null)
    {
        if ($websiteZone instanceof \CE\Model\WebsiteZone) {
            return $this
                ->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteZone->getWebsiteRoutingId(), $comparison);
        } elseif ($websiteZone instanceof ObjectCollection) {
            return $this
                ->useWebsiteZoneQuery()
                ->filterByPrimaryKeys($websiteZone->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteZone() only accepts arguments of type \CE\Model\WebsiteZone or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteZone relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWebsiteZone($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteZone');

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
            $this->addJoinObject($join, 'WebsiteZone');
        }

        return $this;
    }

    /**
     * Use the WebsiteZone relation WebsiteZone object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteZoneQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteZoneQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWebsiteZone($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteZone', '\CE\Model\WebsiteZoneQuery');
    }

    /**
     * Filter the query by a related WebsiteModule object
     * using the website_module_location table as cross reference
     *
     * @param WebsiteModule $websiteModule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function filterByWebsiteModule($websiteModule, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useWebsiteModuleLocationQuery()
            ->filterByWebsiteModule($websiteModule, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWebsiteRouting $websiteRouting Object to remove from the list of results
     *
     * @return $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function prune($websiteRouting = null)
    {
        if ($websiteRouting) {
            $this->addUsingAlias(WebsiteRoutingTableMap::COL_ID, $websiteRouting->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website_routing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteRoutingTableMap::clearInstancePool();
            WebsiteRoutingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteRoutingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteRoutingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteRoutingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'WebsiteRoutingI18n';

        return $this
            ->joinWebsiteRoutingI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Culture = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('WebsiteRoutingI18n');
        $this->with['WebsiteRoutingI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildWebsiteRoutingI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRoutingI18n', '\CE\Model\WebsiteRoutingI18nQuery');
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(WebsiteRoutingTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(WebsiteRoutingTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(WebsiteRoutingTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(WebsiteRoutingTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildWebsiteRoutingQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(WebsiteRoutingTableMap::COL_CREATED_AT);
    }

} // WebsiteRoutingQuery
