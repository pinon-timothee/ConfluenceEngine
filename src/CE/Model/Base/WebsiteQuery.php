<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Website as ChildWebsite;
use CE\Model\WebsiteQuery as ChildWebsiteQuery;
use CE\Model\Map\WebsiteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'website' table.
 *
 *
 *
 * @method     ChildWebsiteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWebsiteQuery orderByAccountId($order = Criteria::ASC) Order by the account_id column
 * @method     ChildWebsiteQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildWebsiteQuery orderByStepId($order = Criteria::ASC) Order by the step_id column
 * @method     ChildWebsiteQuery orderByTemplate($order = Criteria::ASC) Order by the template column
 * @method     ChildWebsiteQuery orderByLogo($order = Criteria::ASC) Order by the logo column
 * @method     ChildWebsiteQuery orderByFavicon($order = Criteria::ASC) Order by the favicon column
 * @method     ChildWebsiteQuery orderByJavascript($order = Criteria::ASC) Order by the javascript column
 * @method     ChildWebsiteQuery orderByStylesheet($order = Criteria::ASC) Order by the stylesheet column
 * @method     ChildWebsiteQuery orderByMaxUpload($order = Criteria::ASC) Order by the max_upload column
 * @method     ChildWebsiteQuery orderByCurrency($order = Criteria::ASC) Order by the currency column
 * @method     ChildWebsiteQuery orderByMetaAuto($order = Criteria::ASC) Order by the meta_auto column
 * @method     ChildWebsiteQuery orderBySsl($order = Criteria::ASC) Order by the ssl column
 * @method     ChildWebsiteQuery orderByDuplicable($order = Criteria::ASC) Order by the duplicable column
 * @method     ChildWebsiteQuery orderByWrapper($order = Criteria::ASC) Order by the wrapper column
 * @method     ChildWebsiteQuery orderByWrapperParams($order = Criteria::ASC) Order by the wrapper_params column
 *
 * @method     ChildWebsiteQuery groupById() Group by the id column
 * @method     ChildWebsiteQuery groupByAccountId() Group by the account_id column
 * @method     ChildWebsiteQuery groupByName() Group by the name column
 * @method     ChildWebsiteQuery groupByStepId() Group by the step_id column
 * @method     ChildWebsiteQuery groupByTemplate() Group by the template column
 * @method     ChildWebsiteQuery groupByLogo() Group by the logo column
 * @method     ChildWebsiteQuery groupByFavicon() Group by the favicon column
 * @method     ChildWebsiteQuery groupByJavascript() Group by the javascript column
 * @method     ChildWebsiteQuery groupByStylesheet() Group by the stylesheet column
 * @method     ChildWebsiteQuery groupByMaxUpload() Group by the max_upload column
 * @method     ChildWebsiteQuery groupByCurrency() Group by the currency column
 * @method     ChildWebsiteQuery groupByMetaAuto() Group by the meta_auto column
 * @method     ChildWebsiteQuery groupBySsl() Group by the ssl column
 * @method     ChildWebsiteQuery groupByDuplicable() Group by the duplicable column
 * @method     ChildWebsiteQuery groupByWrapper() Group by the wrapper column
 * @method     ChildWebsiteQuery groupByWrapperParams() Group by the wrapper_params column
 *
 * @method     ChildWebsiteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWebsiteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWebsiteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWebsiteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWebsiteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWebsiteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWebsiteQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildWebsiteQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildWebsiteQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildWebsiteQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildWebsiteQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildWebsiteQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildWebsiteQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildWebsiteQuery leftJoinStep($relationAlias = null) Adds a LEFT JOIN clause to the query using the Step relation
 * @method     ChildWebsiteQuery rightJoinStep($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Step relation
 * @method     ChildWebsiteQuery innerJoinStep($relationAlias = null) Adds a INNER JOIN clause to the query using the Step relation
 *
 * @method     ChildWebsiteQuery joinWithStep($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Step relation
 *
 * @method     ChildWebsiteQuery leftJoinWithStep() Adds a LEFT JOIN clause and with to the query using the Step relation
 * @method     ChildWebsiteQuery rightJoinWithStep() Adds a RIGHT JOIN clause and with to the query using the Step relation
 * @method     ChildWebsiteQuery innerJoinWithStep() Adds a INNER JOIN clause and with to the query using the Step relation
 *
 * @method     ChildWebsiteQuery leftJoinMeta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Meta relation
 * @method     ChildWebsiteQuery rightJoinMeta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Meta relation
 * @method     ChildWebsiteQuery innerJoinMeta($relationAlias = null) Adds a INNER JOIN clause to the query using the Meta relation
 *
 * @method     ChildWebsiteQuery joinWithMeta($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Meta relation
 *
 * @method     ChildWebsiteQuery leftJoinWithMeta() Adds a LEFT JOIN clause and with to the query using the Meta relation
 * @method     ChildWebsiteQuery rightJoinWithMeta() Adds a RIGHT JOIN clause and with to the query using the Meta relation
 * @method     ChildWebsiteQuery innerJoinWithMeta() Adds a INNER JOIN clause and with to the query using the Meta relation
 *
 * @method     ChildWebsiteQuery leftJoinModuleAuthorization($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleAuthorization relation
 * @method     ChildWebsiteQuery rightJoinModuleAuthorization($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleAuthorization relation
 * @method     ChildWebsiteQuery innerJoinModuleAuthorization($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleAuthorization relation
 *
 * @method     ChildWebsiteQuery joinWithModuleAuthorization($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ModuleAuthorization relation
 *
 * @method     ChildWebsiteQuery leftJoinWithModuleAuthorization() Adds a LEFT JOIN clause and with to the query using the ModuleAuthorization relation
 * @method     ChildWebsiteQuery rightJoinWithModuleAuthorization() Adds a RIGHT JOIN clause and with to the query using the ModuleAuthorization relation
 * @method     ChildWebsiteQuery innerJoinWithModuleAuthorization() Adds a INNER JOIN clause and with to the query using the ModuleAuthorization relation
 *
 * @method     ChildWebsiteQuery leftJoinUserWebsite($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserWebsite relation
 * @method     ChildWebsiteQuery rightJoinUserWebsite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserWebsite relation
 * @method     ChildWebsiteQuery innerJoinUserWebsite($relationAlias = null) Adds a INNER JOIN clause to the query using the UserWebsite relation
 *
 * @method     ChildWebsiteQuery joinWithUserWebsite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserWebsite relation
 *
 * @method     ChildWebsiteQuery leftJoinWithUserWebsite() Adds a LEFT JOIN clause and with to the query using the UserWebsite relation
 * @method     ChildWebsiteQuery rightJoinWithUserWebsite() Adds a RIGHT JOIN clause and with to the query using the UserWebsite relation
 * @method     ChildWebsiteQuery innerJoinWithUserWebsite() Adds a INNER JOIN clause and with to the query using the UserWebsite relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteRedirection($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteQuery rightJoinWebsiteRedirection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteQuery innerJoinWebsiteRedirection($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRedirection relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteRedirection($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRedirection relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteRedirection() Adds a LEFT JOIN clause and with to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteRedirection() Adds a RIGHT JOIN clause and with to the query using the WebsiteRedirection relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteRedirection() Adds a INNER JOIN clause and with to the query using the WebsiteRedirection relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteCulture($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteCulture relation
 * @method     ChildWebsiteQuery rightJoinWebsiteCulture($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteCulture relation
 * @method     ChildWebsiteQuery innerJoinWebsiteCulture($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteCulture relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteCulture($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteCulture relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteCulture() Adds a LEFT JOIN clause and with to the query using the WebsiteCulture relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteCulture() Adds a RIGHT JOIN clause and with to the query using the WebsiteCulture relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteCulture() Adds a INNER JOIN clause and with to the query using the WebsiteCulture relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteDomain($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteDomain relation
 * @method     ChildWebsiteQuery rightJoinWebsiteDomain($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteDomain relation
 * @method     ChildWebsiteQuery innerJoinWebsiteDomain($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteDomain relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteDomain($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteDomain relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteDomain() Adds a LEFT JOIN clause and with to the query using the WebsiteDomain relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteDomain() Adds a RIGHT JOIN clause and with to the query using the WebsiteDomain relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteDomain() Adds a INNER JOIN clause and with to the query using the WebsiteDomain relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteParameter($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteParameter relation
 * @method     ChildWebsiteQuery rightJoinWebsiteParameter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteParameter relation
 * @method     ChildWebsiteQuery innerJoinWebsiteParameter($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteParameter relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteParameter($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteParameter relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteParameter() Adds a LEFT JOIN clause and with to the query using the WebsiteParameter relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteParameter() Adds a RIGHT JOIN clause and with to the query using the WebsiteParameter relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteParameter() Adds a INNER JOIN clause and with to the query using the WebsiteParameter relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteRouting($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteRouting relation
 * @method     ChildWebsiteQuery rightJoinWebsiteRouting($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteRouting relation
 * @method     ChildWebsiteQuery innerJoinWebsiteRouting($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteRouting relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteRouting($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteRouting relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteRouting() Adds a LEFT JOIN clause and with to the query using the WebsiteRouting relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteRouting() Adds a RIGHT JOIN clause and with to the query using the WebsiteRouting relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteRouting() Adds a INNER JOIN clause and with to the query using the WebsiteRouting relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteQuery rightJoinWebsiteModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteModule relation
 * @method     ChildWebsiteQuery innerJoinWebsiteModule($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteModule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteModule() Adds a LEFT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteModule() Adds a RIGHT JOIN clause and with to the query using the WebsiteModule relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteModule() Adds a INNER JOIN clause and with to the query using the WebsiteModule relation
 *
 * @method     ChildWebsiteQuery leftJoinWebsiteZone($relationAlias = null) Adds a LEFT JOIN clause to the query using the WebsiteZone relation
 * @method     ChildWebsiteQuery rightJoinWebsiteZone($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WebsiteZone relation
 * @method     ChildWebsiteQuery innerJoinWebsiteZone($relationAlias = null) Adds a INNER JOIN clause to the query using the WebsiteZone relation
 *
 * @method     ChildWebsiteQuery joinWithWebsiteZone($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WebsiteZone relation
 *
 * @method     ChildWebsiteQuery leftJoinWithWebsiteZone() Adds a LEFT JOIN clause and with to the query using the WebsiteZone relation
 * @method     ChildWebsiteQuery rightJoinWithWebsiteZone() Adds a RIGHT JOIN clause and with to the query using the WebsiteZone relation
 * @method     ChildWebsiteQuery innerJoinWithWebsiteZone() Adds a INNER JOIN clause and with to the query using the WebsiteZone relation
 *
 * @method     \CE\Model\AccountQuery|\CE\Model\StepQuery|\CE\Model\MetaQuery|\CE\Model\ModuleAuthorizationQuery|\CE\Model\UserWebsiteQuery|\CE\Model\WebsiteRedirectionQuery|\CE\Model\WebsiteCultureQuery|\CE\Model\WebsiteDomainQuery|\CE\Model\WebsiteParameterQuery|\CE\Model\WebsiteRoutingQuery|\CE\Model\WebsiteModuleQuery|\CE\Model\WebsiteZoneQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWebsite findOne(ConnectionInterface $con = null) Return the first ChildWebsite matching the query
 * @method     ChildWebsite findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWebsite matching the query, or a new ChildWebsite object populated from the query conditions when no match is found
 *
 * @method     ChildWebsite findOneById(int $id) Return the first ChildWebsite filtered by the id column
 * @method     ChildWebsite findOneByAccountId(int $account_id) Return the first ChildWebsite filtered by the account_id column
 * @method     ChildWebsite findOneByName(string $name) Return the first ChildWebsite filtered by the name column
 * @method     ChildWebsite findOneByStepId(int $step_id) Return the first ChildWebsite filtered by the step_id column
 * @method     ChildWebsite findOneByTemplate(string $template) Return the first ChildWebsite filtered by the template column
 * @method     ChildWebsite findOneByLogo(string $logo) Return the first ChildWebsite filtered by the logo column
 * @method     ChildWebsite findOneByFavicon(string $favicon) Return the first ChildWebsite filtered by the favicon column
 * @method     ChildWebsite findOneByJavascript(string $javascript) Return the first ChildWebsite filtered by the javascript column
 * @method     ChildWebsite findOneByStylesheet(string $stylesheet) Return the first ChildWebsite filtered by the stylesheet column
 * @method     ChildWebsite findOneByMaxUpload(int $max_upload) Return the first ChildWebsite filtered by the max_upload column
 * @method     ChildWebsite findOneByCurrency(string $currency) Return the first ChildWebsite filtered by the currency column
 * @method     ChildWebsite findOneByMetaAuto(boolean $meta_auto) Return the first ChildWebsite filtered by the meta_auto column
 * @method     ChildWebsite findOneBySsl(boolean $ssl) Return the first ChildWebsite filtered by the ssl column
 * @method     ChildWebsite findOneByDuplicable(boolean $duplicable) Return the first ChildWebsite filtered by the duplicable column
 * @method     ChildWebsite findOneByWrapper(string $wrapper) Return the first ChildWebsite filtered by the wrapper column
 * @method     ChildWebsite findOneByWrapperParams(string $wrapper_params) Return the first ChildWebsite filtered by the wrapper_params column *

 * @method     ChildWebsite requirePk($key, ConnectionInterface $con = null) Return the ChildWebsite by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOne(ConnectionInterface $con = null) Return the first ChildWebsite matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsite requireOneById(int $id) Return the first ChildWebsite filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByAccountId(int $account_id) Return the first ChildWebsite filtered by the account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByName(string $name) Return the first ChildWebsite filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByStepId(int $step_id) Return the first ChildWebsite filtered by the step_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByTemplate(string $template) Return the first ChildWebsite filtered by the template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByLogo(string $logo) Return the first ChildWebsite filtered by the logo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByFavicon(string $favicon) Return the first ChildWebsite filtered by the favicon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByJavascript(string $javascript) Return the first ChildWebsite filtered by the javascript column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByStylesheet(string $stylesheet) Return the first ChildWebsite filtered by the stylesheet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByMaxUpload(int $max_upload) Return the first ChildWebsite filtered by the max_upload column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByCurrency(string $currency) Return the first ChildWebsite filtered by the currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByMetaAuto(boolean $meta_auto) Return the first ChildWebsite filtered by the meta_auto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneBySsl(boolean $ssl) Return the first ChildWebsite filtered by the ssl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByDuplicable(boolean $duplicable) Return the first ChildWebsite filtered by the duplicable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByWrapper(string $wrapper) Return the first ChildWebsite filtered by the wrapper column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWebsite requireOneByWrapperParams(string $wrapper_params) Return the first ChildWebsite filtered by the wrapper_params column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWebsite[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWebsite objects based on current ModelCriteria
 * @method     ChildWebsite[]|ObjectCollection findById(int $id) Return ChildWebsite objects filtered by the id column
 * @method     ChildWebsite[]|ObjectCollection findByAccountId(int $account_id) Return ChildWebsite objects filtered by the account_id column
 * @method     ChildWebsite[]|ObjectCollection findByName(string $name) Return ChildWebsite objects filtered by the name column
 * @method     ChildWebsite[]|ObjectCollection findByStepId(int $step_id) Return ChildWebsite objects filtered by the step_id column
 * @method     ChildWebsite[]|ObjectCollection findByTemplate(string $template) Return ChildWebsite objects filtered by the template column
 * @method     ChildWebsite[]|ObjectCollection findByLogo(string $logo) Return ChildWebsite objects filtered by the logo column
 * @method     ChildWebsite[]|ObjectCollection findByFavicon(string $favicon) Return ChildWebsite objects filtered by the favicon column
 * @method     ChildWebsite[]|ObjectCollection findByJavascript(string $javascript) Return ChildWebsite objects filtered by the javascript column
 * @method     ChildWebsite[]|ObjectCollection findByStylesheet(string $stylesheet) Return ChildWebsite objects filtered by the stylesheet column
 * @method     ChildWebsite[]|ObjectCollection findByMaxUpload(int $max_upload) Return ChildWebsite objects filtered by the max_upload column
 * @method     ChildWebsite[]|ObjectCollection findByCurrency(string $currency) Return ChildWebsite objects filtered by the currency column
 * @method     ChildWebsite[]|ObjectCollection findByMetaAuto(boolean $meta_auto) Return ChildWebsite objects filtered by the meta_auto column
 * @method     ChildWebsite[]|ObjectCollection findBySsl(boolean $ssl) Return ChildWebsite objects filtered by the ssl column
 * @method     ChildWebsite[]|ObjectCollection findByDuplicable(boolean $duplicable) Return ChildWebsite objects filtered by the duplicable column
 * @method     ChildWebsite[]|ObjectCollection findByWrapper(string $wrapper) Return ChildWebsite objects filtered by the wrapper column
 * @method     ChildWebsite[]|ObjectCollection findByWrapperParams(string $wrapper_params) Return ChildWebsite objects filtered by the wrapper_params column
 * @method     ChildWebsite[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WebsiteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CE\Model\Base\WebsiteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CE\\Model\\Website', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWebsiteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWebsiteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWebsiteQuery) {
            return $criteria;
        }
        $query = new ChildWebsiteQuery();
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
     * @return ChildWebsite|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WebsiteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWebsite A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `account_id`, `name`, `step_id`, `template`, `logo`, `favicon`, `javascript`, `stylesheet`, `max_upload`, `currency`, `meta_auto`, `ssl`, `duplicable`, `wrapper`, `wrapper_params` FROM `website` WHERE `id` = :p0';
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
            /** @var ChildWebsite $obj */
            $obj = new ChildWebsite();
            $obj->hydrate($row);
            WebsiteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWebsite|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WebsiteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WebsiteTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the account_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountId(1234); // WHERE account_id = 1234
     * $query->filterByAccountId(array(12, 34)); // WHERE account_id IN (12, 34)
     * $query->filterByAccountId(array('min' => 12)); // WHERE account_id > 12
     * </code>
     *
     * @see       filterByAccount()
     *
     * @param     mixed $accountId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByAccountId($accountId = null, $comparison = null)
    {
        if (is_array($accountId)) {
            $useMinMax = false;
            if (isset($accountId['min'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_ACCOUNT_ID, $accountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountId['max'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_ACCOUNT_ID, $accountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_ACCOUNT_ID, $accountId, $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the step_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStepId(1234); // WHERE step_id = 1234
     * $query->filterByStepId(array(12, 34)); // WHERE step_id IN (12, 34)
     * $query->filterByStepId(array('min' => 12)); // WHERE step_id > 12
     * </code>
     *
     * @see       filterByStep()
     *
     * @param     mixed $stepId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByStepId($stepId = null, $comparison = null)
    {
        if (is_array($stepId)) {
            $useMinMax = false;
            if (isset($stepId['min'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_STEP_ID, $stepId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stepId['max'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_STEP_ID, $stepId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_STEP_ID, $stepId, $comparison);
    }

    /**
     * Filter the query on the template column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplate('fooValue');   // WHERE template = 'fooValue'
     * $query->filterByTemplate('%fooValue%', Criteria::LIKE); // WHERE template LIKE '%fooValue%'
     * </code>
     *
     * @param     string $template The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByTemplate($template = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($template)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_TEMPLATE, $template, $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByLogo($logo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_LOGO, $logo, $comparison);
    }

    /**
     * Filter the query on the favicon column
     *
     * Example usage:
     * <code>
     * $query->filterByFavicon('fooValue');   // WHERE favicon = 'fooValue'
     * $query->filterByFavicon('%fooValue%', Criteria::LIKE); // WHERE favicon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $favicon The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByFavicon($favicon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($favicon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_FAVICON, $favicon, $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByJavascript($javascript = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($javascript)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_JAVASCRIPT, $javascript, $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByStylesheet($stylesheet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stylesheet)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_STYLESHEET, $stylesheet, $comparison);
    }

    /**
     * Filter the query on the max_upload column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxUpload(1234); // WHERE max_upload = 1234
     * $query->filterByMaxUpload(array(12, 34)); // WHERE max_upload IN (12, 34)
     * $query->filterByMaxUpload(array('min' => 12)); // WHERE max_upload > 12
     * </code>
     *
     * @param     mixed $maxUpload The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByMaxUpload($maxUpload = null, $comparison = null)
    {
        if (is_array($maxUpload)) {
            $useMinMax = false;
            if (isset($maxUpload['min'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_MAX_UPLOAD, $maxUpload['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxUpload['max'])) {
                $this->addUsingAlias(WebsiteTableMap::COL_MAX_UPLOAD, $maxUpload['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_MAX_UPLOAD, $maxUpload, $comparison);
    }

    /**
     * Filter the query on the currency column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrency('fooValue');   // WHERE currency = 'fooValue'
     * $query->filterByCurrency('%fooValue%', Criteria::LIKE); // WHERE currency LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currency The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currency)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_CURRENCY, $currency, $comparison);
    }

    /**
     * Filter the query on the meta_auto column
     *
     * Example usage:
     * <code>
     * $query->filterByMetaAuto(true); // WHERE meta_auto = true
     * $query->filterByMetaAuto('yes'); // WHERE meta_auto = true
     * </code>
     *
     * @param     boolean|string $metaAuto The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByMetaAuto($metaAuto = null, $comparison = null)
    {
        if (is_string($metaAuto)) {
            $metaAuto = in_array(strtolower($metaAuto), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_META_AUTO, $metaAuto, $comparison);
    }

    /**
     * Filter the query on the ssl column
     *
     * Example usage:
     * <code>
     * $query->filterBySsl(true); // WHERE ssl = true
     * $query->filterBySsl('yes'); // WHERE ssl = true
     * </code>
     *
     * @param     boolean|string $ssl The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterBySsl($ssl = null, $comparison = null)
    {
        if (is_string($ssl)) {
            $ssl = in_array(strtolower($ssl), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_SSL, $ssl, $comparison);
    }

    /**
     * Filter the query on the duplicable column
     *
     * Example usage:
     * <code>
     * $query->filterByDuplicable(true); // WHERE duplicable = true
     * $query->filterByDuplicable('yes'); // WHERE duplicable = true
     * </code>
     *
     * @param     boolean|string $duplicable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByDuplicable($duplicable = null, $comparison = null)
    {
        if (is_string($duplicable)) {
            $duplicable = in_array(strtolower($duplicable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_DUPLICABLE, $duplicable, $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWrapper($wrapper = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wrapper)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_WRAPPER, $wrapper, $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWrapperParams($wrapperParams = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wrapperParams)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WebsiteTableMap::COL_WRAPPER_PARAMS, $wrapperParams, $comparison);
    }

    /**
     * Filter the query by a related \CE\Model\Account object
     *
     * @param \CE\Model\Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \CE\Model\Account) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ACCOUNT_ID, $account->getId(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ACCOUNT_ID, $account->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAccount() only accepts arguments of type \CE\Model\Account or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Account relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinAccount($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Account');

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
            $this->addJoinObject($join, 'Account');
        }

        return $this;
    }

    /**
     * Use the Account relation Account object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\AccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Account', '\CE\Model\AccountQuery');
    }

    /**
     * Filter the query by a related \CE\Model\Step object
     *
     * @param \CE\Model\Step|ObjectCollection $step The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByStep($step, $comparison = null)
    {
        if ($step instanceof \CE\Model\Step) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_STEP_ID, $step->getId(), $comparison);
        } elseif ($step instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WebsiteTableMap::COL_STEP_ID, $step->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStep() only accepts arguments of type \CE\Model\Step or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Step relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinStep($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Step');

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
            $this->addJoinObject($join, 'Step');
        }

        return $this;
    }

    /**
     * Use the Step relation Step object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\StepQuery A secondary query class using the current class as primary query
     */
    public function useStepQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStep($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Step', '\CE\Model\StepQuery');
    }

    /**
     * Filter the query by a related \CE\Model\Meta object
     *
     * @param \CE\Model\Meta|ObjectCollection $meta the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByMeta($meta, $comparison = null)
    {
        if ($meta instanceof \CE\Model\Meta) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $meta->getWebsiteId(), $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
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
     * Filter the query by a related \CE\Model\ModuleAuthorization object
     *
     * @param \CE\Model\ModuleAuthorization|ObjectCollection $moduleAuthorization the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByModuleAuthorization($moduleAuthorization, $comparison = null)
    {
        if ($moduleAuthorization instanceof \CE\Model\ModuleAuthorization) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $moduleAuthorization->getWebsiteId(), $comparison);
        } elseif ($moduleAuthorization instanceof ObjectCollection) {
            return $this
                ->useModuleAuthorizationQuery()
                ->filterByPrimaryKeys($moduleAuthorization->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByModuleAuthorization() only accepts arguments of type \CE\Model\ModuleAuthorization or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleAuthorization relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinModuleAuthorization($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleAuthorization');

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
            $this->addJoinObject($join, 'ModuleAuthorization');
        }

        return $this;
    }

    /**
     * Use the ModuleAuthorization relation ModuleAuthorization object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\ModuleAuthorizationQuery A secondary query class using the current class as primary query
     */
    public function useModuleAuthorizationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleAuthorization($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleAuthorization', '\CE\Model\ModuleAuthorizationQuery');
    }

    /**
     * Filter the query by a related \CE\Model\UserWebsite object
     *
     * @param \CE\Model\UserWebsite|ObjectCollection $userWebsite the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByUserWebsite($userWebsite, $comparison = null)
    {
        if ($userWebsite instanceof \CE\Model\UserWebsite) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $userWebsite->getWebsiteId(), $comparison);
        } elseif ($userWebsite instanceof ObjectCollection) {
            return $this
                ->useUserWebsiteQuery()
                ->filterByPrimaryKeys($userWebsite->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserWebsite() only accepts arguments of type \CE\Model\UserWebsite or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserWebsite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinUserWebsite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserWebsite');

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
            $this->addJoinObject($join, 'UserWebsite');
        }

        return $this;
    }

    /**
     * Use the UserWebsite relation UserWebsite object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\UserWebsiteQuery A secondary query class using the current class as primary query
     */
    public function useUserWebsiteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserWebsite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserWebsite', '\CE\Model\UserWebsiteQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRedirection object
     *
     * @param \CE\Model\WebsiteRedirection|ObjectCollection $websiteRedirection the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteRedirection($websiteRedirection, $comparison = null)
    {
        if ($websiteRedirection instanceof \CE\Model\WebsiteRedirection) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteRedirection->getWebsiteId(), $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
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
     * Filter the query by a related \CE\Model\WebsiteCulture object
     *
     * @param \CE\Model\WebsiteCulture|ObjectCollection $websiteCulture the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteCulture($websiteCulture, $comparison = null)
    {
        if ($websiteCulture instanceof \CE\Model\WebsiteCulture) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteCulture->getWebsiteId(), $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
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
     * Filter the query by a related \CE\Model\WebsiteDomain object
     *
     * @param \CE\Model\WebsiteDomain|ObjectCollection $websiteDomain the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteDomain($websiteDomain, $comparison = null)
    {
        if ($websiteDomain instanceof \CE\Model\WebsiteDomain) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteDomain->getWebsiteId(), $comparison);
        } elseif ($websiteDomain instanceof ObjectCollection) {
            return $this
                ->useWebsiteDomainQuery()
                ->filterByPrimaryKeys($websiteDomain->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteDomain() only accepts arguments of type \CE\Model\WebsiteDomain or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteDomain relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinWebsiteDomain($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteDomain');

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
            $this->addJoinObject($join, 'WebsiteDomain');
        }

        return $this;
    }

    /**
     * Use the WebsiteDomain relation WebsiteDomain object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteDomainQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteDomainQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteDomain($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteDomain', '\CE\Model\WebsiteDomainQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteParameter object
     *
     * @param \CE\Model\WebsiteParameter|ObjectCollection $websiteParameter the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteParameter($websiteParameter, $comparison = null)
    {
        if ($websiteParameter instanceof \CE\Model\WebsiteParameter) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteParameter->getWebsiteId(), $comparison);
        } elseif ($websiteParameter instanceof ObjectCollection) {
            return $this
                ->useWebsiteParameterQuery()
                ->filterByPrimaryKeys($websiteParameter->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWebsiteParameter() only accepts arguments of type \CE\Model\WebsiteParameter or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WebsiteParameter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinWebsiteParameter($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WebsiteParameter');

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
            $this->addJoinObject($join, 'WebsiteParameter');
        }

        return $this;
    }

    /**
     * Use the WebsiteParameter relation WebsiteParameter object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CE\Model\WebsiteParameterQuery A secondary query class using the current class as primary query
     */
    public function useWebsiteParameterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteParameter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteParameter', '\CE\Model\WebsiteParameterQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteRouting object
     *
     * @param \CE\Model\WebsiteRouting|ObjectCollection $websiteRouting the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteRouting($websiteRouting, $comparison = null)
    {
        if ($websiteRouting instanceof \CE\Model\WebsiteRouting) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteRouting->getWebsiteId(), $comparison);
        } elseif ($websiteRouting instanceof ObjectCollection) {
            return $this
                ->useWebsiteRoutingQuery()
                ->filterByPrimaryKeys($websiteRouting->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinWebsiteRouting($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useWebsiteRoutingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteRouting($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteRouting', '\CE\Model\WebsiteRoutingQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteModule object
     *
     * @param \CE\Model\WebsiteModule|ObjectCollection $websiteModule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteModule($websiteModule, $comparison = null)
    {
        if ($websiteModule instanceof \CE\Model\WebsiteModule) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteModule->getWebsiteId(), $comparison);
        } elseif ($websiteModule instanceof ObjectCollection) {
            return $this
                ->useWebsiteModuleQuery()
                ->filterByPrimaryKeys($websiteModule->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinWebsiteModule($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useWebsiteModuleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWebsiteModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteModule', '\CE\Model\WebsiteModuleQuery');
    }

    /**
     * Filter the query by a related \CE\Model\WebsiteZone object
     *
     * @param \CE\Model\WebsiteZone|ObjectCollection $websiteZone the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWebsiteQuery The current query, for fluid interface
     */
    public function filterByWebsiteZone($websiteZone, $comparison = null)
    {
        if ($websiteZone instanceof \CE\Model\WebsiteZone) {
            return $this
                ->addUsingAlias(WebsiteTableMap::COL_ID, $websiteZone->getWebsiteId(), $comparison);
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
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function joinWebsiteZone($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useWebsiteZoneQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWebsiteZone($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WebsiteZone', '\CE\Model\WebsiteZoneQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWebsite $website Object to remove from the list of results
     *
     * @return $this|ChildWebsiteQuery The current query, for fluid interface
     */
    public function prune($website = null)
    {
        if ($website) {
            $this->addUsingAlias(WebsiteTableMap::COL_ID, $website->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the website table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WebsiteTableMap::clearInstancePool();
            WebsiteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WebsiteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WebsiteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WebsiteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WebsiteQuery
