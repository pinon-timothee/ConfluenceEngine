<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteModule as ChildWebsiteModule;
use CE\Model\WebsiteModuleI18nQuery as ChildWebsiteModuleI18nQuery;
use CE\Model\WebsiteModuleQuery as ChildWebsiteModuleQuery;
use CE\Model\Map\WebsiteModuleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website_module' table.
 *
 *
 *
 * @method     ChildWebsiteModuleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteModuleQuery orderByWebsiteId($order = Criteria::ASC) Order by the website_id column
 * @method     ChildWebsiteModuleQuery orderByModuleName($order = Criteria::ASC) Order by the module_name column
 * @method     ChildWebsiteModuleQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildWebsiteModuleQuery orderByCss($order = Criteria::ASC) Order by the css column
 * @method     ChildWebsiteModuleQuery orderByClass($order = Criteria::ASC) Order by the class column
 * @method     ChildWebsiteModuleQuery orderByBlock($order = Criteria::ASC) Order by the block column
 * @method     ChildWebsiteModuleQuery orderByTwig($order = Criteria::ASC) Order by the twig column
 * @method     ChildWebsiteModuleQuery orderByJavascript($order = Criteria::ASC) Order by the javascript column
 * @method     ChildWebsiteModuleQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildWebsiteModuleQuery orderByEnable($order = Criteria::ASC) Order by the enable column
 * @method     ChildWebsiteModuleQuery orderByTitleTag($order = Criteria::ASC) Order by the title_tag column
 *
 * @method     ChildWebsiteModuleQuery groupById() Group by the id column
 * @method     ChildWebsiteModuleQuery groupByWebsiteId() Group by the website_id column
 * @method     ChildWebsiteModuleQuery groupByModuleName() Group by the module_name column
 * @method     ChildWebsiteModuleQuery groupByDescription() Group by the description column
 * @method     ChildWebsiteModuleQuery groupByCss() Group by the css column
 * @method     ChildWebsiteModuleQuery groupByClass() Group by the class column
 * @method     ChildWebsiteModuleQuery groupByBlock() Group by the block column
 * @method     ChildWebsiteModuleQuery groupByTwig() Group by the twig column
 * @method     ChildWebsiteModuleQuery groupByJavascript() Group by the javascript column
 * @method     ChildWebsiteModuleQuery groupByTags() Group by the tags column
 * @method     ChildWebsiteModuleQuery groupByEnable() Group by the enable column
 * @method     ChildWebsiteModuleQuery groupByTitleTag() Group by the title_tag column
 *
 * @method     ChildWebsiteModuleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteModuleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteModuleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteModuleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteModuleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteModuleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteModuleQuery leftJoinWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Website relation
 * @method     ChildWebsiteModuleQuery rightJoinWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Website relation
 * @method     ChildWebsiteModuleQuery innerJoinWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the Website relation
 *
 * @method     ChildWebsiteModuleQuery joinWithWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Website relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWithWebsite() Adds a LEFT JOIN clause and with to the query using the Website relation
 * @method     ChildWebsiteModuleQuery rightJoinWithWebsite() Adds a RIGHT JOIN clause and with to the query using the Website relation
 * @method     ChildWebsiteModuleQuery innerJoinWithWebsite() Adds a INNER JOIN clause and with to the query using the Website relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWebsiteModuleParameter($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModuleParameter relation
 * @method     ChildWebsiteModuleQuery rightJoinWebsiteModuleParameter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModuleParameter relation
 * @method     ChildWebsiteModuleQuery innerJoinWebsiteModuleParameter($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModuleParameter relation
 *
 * @method     ChildWebsiteModuleQuery joinWithWebsiteModuleParameter($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModuleParameter relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWithWebsiteModuleParameter() Adds a LEFT JOIN clause and with to the query using the WebsiteModuleParameter relation
 * @method     ChildWebsiteModuleQuery rightJoinWithWebsiteModuleParameter() Adds a RIGHT JOIN clause and with to the query using the WebsiteModuleParameter relation
 * @method     ChildWebsiteModuleQuery innerJoinWithWebsiteModuleParameter() Adds a INNER JOIN clause and with to the query using the WebsiteModuleParameter relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWebsiteModuleLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteModuleQuery rightJoinWebsiteModuleLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteModuleQuery innerJoinWebsiteModuleLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModuleLocation relation
 *
 * @method     ChildWebsiteModuleQuery joinWithWebsiteModuleLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModuleLocation relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWithWebsiteModuleLocation() Adds a LEFT JOIN clause and with to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteModuleQuery rightJoinWithWebsiteModuleLocation() Adds a RIGHT JOIN clause and with to the query using the WebsiteModuleLocation relation
 * @method     ChildWebsiteModuleQuery innerJoinWithWebsiteModuleLocation() Adds a INNER JOIN clause and with to the query using the WebsiteModuleLocation relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWebsiteModuleI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModuleI18n relation
 * @method     ChildWebsiteModuleQuery rightJoinWebsiteModuleI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModuleI18n relation
 * @method     ChildWebsiteModuleQuery innerJoinWebsiteModuleI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModuleI18n relation
 *
 * @method     ChildWebsiteModuleQuery joinWithWebsiteModuleI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModuleI18n relation
 *
 * @method     ChildWebsiteModuleQuery leftJoinWithWebsiteModuleI18n() Adds a LEFT JOIN clause and with to the query using the WebsiteModuleI18n relation
 * @method     ChildWebsiteModuleQuery rightJoinWithWebsiteModuleI18n() Adds a RIGHT JOIN clause and with to the query using the WebsiteModuleI18n relation
 * @method     ChildWebsiteModuleQuery innerJoinWithWebsiteModuleI18n() Adds a INNER JOIN clause and with to the query using the WebsiteModuleI18n relation
 *
 * @method     \CE\Model\WebsiteQuery|\CE\Model\WebsiteModuleParameterQuery|\CE\Model\WebsiteModuleLocationQuery|\CE\Model\WebsiteModuleI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsiteModule findOne(ConnectionInterface $con = null) Return the first ChildWebsiteModule matching the query
 * @method     ChildWebsiteModule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsiteModule matching the query, or a new ChildWebsiteModule object populated from the query conditions when no match is found
 *
 * @method     ChildWebsiteModule findOneById(int $id) Return the first ChildWebsiteModule filtered by the id column
 * @method     ChildWebsiteModule findOneByWebsiteId(int $website_id) Return the first ChildWebsiteModule filtered by the website_id column
 * @method     ChildWebsiteModule findOneByModuleName(string $module_name) Return the first ChildWebsiteModule filtered by the module_name column
 * @method     ChildWebsiteModule findOneByDescription(string $description) Return the first ChildWebsiteModule filtered by the description column
 * @method     ChildWebsiteModule findOneByCss(string $css) Return the first ChildWebsiteModule filtered by the css column
 * @method     ChildWebsiteModule findOneByClass(string $class) Return the first ChildWebsiteModule filtered by the class column
 * @method     ChildWebsiteModule findOneByBlock(string $block) Return the first ChildWebsiteModule filtered by the block column
 * @method     ChildWebsiteModule findOneByTwig(string $twig) Return the first ChildWebsiteModule filtered by the twig column
 * @method     ChildWebsiteModule findOneByJavascript(string $javascript) Return the first ChildWebsiteModule filtered by the javascript column
 * @method     ChildWebsiteModule findOneByTags(string $tags) Return the first ChildWebsiteModule filtered by the tags column
 * @method     ChildWebsiteModule findOneByEnable(boolean $enable) Return the first ChildWebsiteModule filtered by the enable column
 * @method     ChildWebsiteModule findOneByTitleTag(string $title_tag) Return the first ChildWebsiteModule filtered by the title_tag column *

 * @method     ChildWebsiteModule requirePk($key, ConnectionInterface $con = null) Return the ChildWebsiteModule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOne(ConnectionInterface $con = null) Return the first ChildWebsiteModule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModule requireOneById(int $id) Return the first ChildWebsiteModule filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByWebsiteId(int $website_id) Return the first ChildWebsiteModule filtered by the website_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByModuleName(string $module_name) Return the first ChildWebsiteModule filtered by the module_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByDescription(string $description) Return the first ChildWebsiteModule filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByCss(string $css) Return the first ChildWebsiteModule filtered by the css column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByClass(string $class) Return the first ChildWebsiteModule filtered by the class column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByBlock(string $block) Return the first ChildWebsiteModule filtered by the block column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByTwig(string $twig) Return the first ChildWebsiteModule filtered by the twig column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByJavascript(string $javascript) Return the first ChildWebsiteModule filtered by the javascript column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByTags(string $tags) Return the first ChildWebsiteModule filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByEnable(boolean $enable) Return the first ChildWebsiteModule filtered by the enable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsiteModule requireOneByTitleTag(string $title_tag) Return the first ChildWebsiteModule filtered by the title_tag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsiteModule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsiteModule objects based on current ModelCriteria
 * @method     ChildWebsiteModule[]|ObjectCollection findById(int $id) Return ChildWebsiteModule objects filtered by the id column
 * @method     ChildWebsiteModule[]|ObjectCollection findByWebsiteId(int $website_id) Return ChildWebsiteModule objects filtered by the website_id column
 * @method     ChildWebsiteModule[]|ObjectCollection findByModuleName(string $module_name) Return ChildWebsiteModule objects filtered by the module_name column
 * @method     ChildWebsiteModule[]|ObjectCollection findByDescription(string $description) Return ChildWebsiteModule objects filtered by the description column
 * @method     ChildWebsiteModule[]|ObjectCollection findByCss(string $css) Return ChildWebsiteModule objects filtered by the css column
 * @method     ChildWebsiteModule[]|ObjectCollection findByClass(string $class) Return ChildWebsiteModule objects filtered by the class column
 * @method     ChildWebsiteModule[]|ObjectCollection findByBlock(string $block) Return ChildWebsiteModule objects filtered by the block column
 * @method     ChildWebsiteModule[]|ObjectCollection findByTwig(string $twig) Return ChildWebsiteModule objects filtered by the twig column
 * @method     ChildWebsiteModule[]|ObjectCollection findByJavascript(string $javascript) Return ChildWebsiteModule objects filtered by the javascript column
 * @method     ChildWebsiteModule[]|ObjectCollection findByTags(string $tags) Return ChildWebsiteModule objects filtered by the tags column
 * @method     ChildWebsiteModule[]|ObjectCollection findByEnable(boolean $enable) Return ChildWebsiteModule objects filtered by the enable column
 * @method     ChildWebsiteModule[]|ObjectCollection findByTitleTag(string $title_tag) Return ChildWebsiteModule objects filtered by the title_tag column
 * @method     ChildWebsiteModule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteModuleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteModuleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\WebsiteModule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteModuleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteModuleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteModuleQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteModuleQuery();
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
     * @return ChildWebsiteModule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteModuleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWebsiteModule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `website_id`, `module_name`, `description`, `css`, `class`, `block`, `twig`, `javascript`, `tags`, `enable`, `title_tag` FROM `website_module` WHERE `id` = :p0';
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
            /** @var ChildWebsiteModule $obj */
            $obj = new ChildWebsiteModule();
            $obj->hydrate($row);
            WebsiteModuleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWebsiteModule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteModuleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteModuleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByWebsiteId($websiteId = null, $comparison = null)
    {
        if (is_array($websiteId)) {
            $useMinMax = false;
            if (isset($websiteId['min'])) {
                $this->addUsingAlias(WebsiteModuleTableMap::COL_WEBSITE_ID, $websiteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($websiteId['max'])) {
                $this->addUsingAlias(WebsiteModuleTableMap::COL_WEBSITE_ID, $websiteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_WEBSITE_ID, $websiteId, $comparison);
    }

    /**
     * Filter the query on the module_name column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleName('fooValue');   // WHERE module_name = 'fooValue'
     * $query->filterByModuleName('%fooValue%', Criteria::LIKE); // WHERE module_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $moduleName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByModuleName($moduleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moduleName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_MODULE_NAME, $moduleName, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the css column
     *
     * Example usage:
     * <code>
     * $query->filterByCss('fooValue');   // WHERE css = 'fooValue'
     * $query->filterByCss('%fooValue%', Criteria::LIKE); // WHERE css LIKE '%fooValue%'
     * </code>
     *
     * @param     string $css The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByCss($css = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($css)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_CSS, $css, $comparison);
    }

    /**
     * Filter the query on the class column
     *
     * Example usage:
     * <code>
     * $query->filterByClass('fooValue');   // WHERE class = 'fooValue'
     * $query->filterByClass('%fooValue%', Criteria::LIKE); // WHERE class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $class The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByClass($class = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($class)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_CLASS, $class, $comparison);
    }

    /**
     * Filter the query on the block column
     *
     * Example usage:
     * <code>
     * $query->filterByBlock('fooValue');   // WHERE block = 'fooValue'
     * $query->filterByBlock('%fooValue%', Criteria::LIKE); // WHERE block LIKE '%fooValue%'
     * </code>
     *
     * @param     string $block The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByBlock($block = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($block)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_BLOCK, $block, $comparison);
    }

    /**
     * Filter the query on the twig column
     *
     * Example usage:
     * <code>
     * $query->filterByTwig('fooValue');   // WHERE twig = 'fooValue'
     * $query->filterByTwig('%fooValue%', Criteria::LIKE); // WHERE twig LIKE '%fooValue%'
     * </code>
     *
     * @param     string $twig The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByTwig($twig = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($twig)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_TWIG, $twig, $comparison);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByJavascript($javascript = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($javascript)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_JAVASCRIPT, $javascript, $comparison);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByTags($tags = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_TAGS, $tags, $comparison);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByEnable($enable = null, $comparison = null)
    {
        if (is_string($enable)) {
            $enable = in_array(strtolower($enable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_ENABLE, $enable, $comparison);
    }

    /**
     * Filter the query on the title_tag column
     *
     * Example usage:
     * <code>
     * $query->filterByTitleTag('fooValue');   // WHERE title_tag = 'fooValue'
     * $query->filterByTitleTag('%fooValue%', Criteria::LIKE); // WHERE title_tag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titleTag The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByTitleTag($titleTag = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titleTag)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteModuleTableMap::COL_TITLE_TAG, $titleTag, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\Website object
     *
     * @param \CE\Model\Website|ObjectCollection $website The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByWebsite($website, $comparison = null)
    {
        if ($website instanceof \CE\Model\Website) {
            return $this
                ->addUsingAlias(WebsiteModuleTableMap::COL_WEBSITE_ID, $website->getId(), $comparison);
        } elseif ($website instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteModuleTableMap::COL_WEBSITE_ID, $website->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
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
     * Filter the query by a related \CE\Model\WebsiteModuleParameter object
     *
     * @param \CE\Model\WebsiteModuleParameter|ObjectCollection $websiteModuleParameter the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByWebsiteModuleParameter($websiteModuleParameter, $comparison = null)
    {
        if ($websiteModuleParameter instanceof \CE\Model\WebsiteModuleParameter) {
            return $this
                ->addUsingAlias(WebsiteModuleTableMap::COL_ID, $websiteModuleParameter->getWebsiteModuleId(), $comparison);
        } elseif ($websiteModuleParameter instanceof ObjectCollection) {
            return $this
                ->useWebsiteModuleParameterQuery()
                ->filterByPrimaryKeys($websiteModuleParameter->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteModuleParameter() only accepts arguments of type \CE\Model\WebsiteModuleParameter or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteModuleParameter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function joinWebsiteModuleParameter($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteModuleParameter');

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
            $this->addJoinObject($join, 'WebsiteModuleParameter');
        }

        return $this;
    }

    /**
     * Use the WebsiteModuleParameter relation WebsiteModuleParameter object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteModuleParameterQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteModuleParameterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteModuleParameter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModuleParameter', '\CE\Model\WebsiteModuleParameterQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModuleLocation object
     *
     * @param \CE\Model\WebsiteModuleLocation|ObjectCollection $websiteModuleLocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByWebsiteModuleLocation($websiteModuleLocation, $comparison = null)
    {
        if ($websiteModuleLocation instanceof \CE\Model\WebsiteModuleLocation) {
            return $this
                ->addUsingAlias(WebsiteModuleTableMap::COL_ID, $websiteModuleLocation->getWebsiteModuleId(), $comparison);
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
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function joinWebsiteModuleLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useWebsiteModuleLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteModuleLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModuleLocation', '\CE\Model\WebsiteModuleLocationQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModuleI18n object
     *
     * @param \CE\Model\WebsiteModuleI18n|ObjectCollection $websiteModuleI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function filterByWebsiteModuleI18n($websiteModuleI18n, $comparison = null)
    {
        if ($websiteModuleI18n instanceof \CE\Model\WebsiteModuleI18n) {
            return $this
                ->addUsingAlias(WebsiteModuleTableMap::COL_ID, $websiteModuleI18n->getId(), $comparison);
        } elseif ($websiteModuleI18n instanceof ObjectCollection) {
            return $this
                ->useWebsiteModuleI18nQuery()
                ->filterByPrimaryKeys($websiteModuleI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteModuleI18n() only accepts arguments of type \CE\Model\WebsiteModuleI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteModuleI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function joinWebsiteModuleI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteModuleI18n');

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
            $this->addJoinObject($join, 'WebsiteModuleI18n');
        }

        return $this;
    }

    /**
     * Use the WebsiteModuleI18n relation WebsiteModuleI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteModuleI18nQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteModuleI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinWebsiteModuleI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModuleI18n', '\CE\Model\WebsiteModuleI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWebsiteModule $websiteModule Object to remove from the list of results
     *
     * @return $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function prune($websiteModule = null)
    {
        if ($websiteModule) {
            $this->addUsingAlias(WebsiteModuleTableMap::COL_ID, $websiteModule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website_module table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteModuleTableMap::clearInstancePool();
            WebsiteModuleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteModuleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteModuleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteModuleTableMap::clearRelatedInstancePool();

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
     * @return    ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'WebsiteModuleI18n';

        return $this
            ->joinWebsiteModuleI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Culture = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildWebsiteModuleQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('WebsiteModuleI18n');
        $this->with['WebsiteModuleI18n']->setIsWithOneToMany(false);

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
     * @return    ChildWebsiteModuleI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModuleI18n', '\CE\Model\WebsiteModuleI18nQuery');
    }

} // WebsiteModuleQuery
