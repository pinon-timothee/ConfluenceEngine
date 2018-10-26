<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Account as ChildAccount;
use CE\Model\AccountQuery as ChildAccountQuery;
use CE\Model\Meta as ChildMeta;
use CE\Model\MetaQuery as ChildMetaQuery;
use CE\Model\ModuleAuthorization as ChildModuleAuthorization;
use CE\Model\ModuleAuthorizationQuery as ChildModuleAuthorizationQuery;
use CE\Model\Step as ChildStep;
use CE\Model\StepQuery as ChildStepQuery;
use CE\Model\UserWebsite as ChildUserWebsite;
use CE\Model\UserWebsiteQuery as ChildUserWebsiteQuery;
use CE\Model\Website as ChildWebsite;
use CE\Model\WebsiteCulture as ChildWebsiteCulture;
use CE\Model\WebsiteCultureQuery as ChildWebsiteCultureQuery;
use CE\Model\WebsiteDomain as ChildWebsiteDomain;
use CE\Model\WebsiteDomainQuery as ChildWebsiteDomainQuery;
use CE\Model\WebsiteModule as ChildWebsiteModule;
use CE\Model\WebsiteModuleQuery as ChildWebsiteModuleQuery;
use CE\Model\WebsiteParameter as ChildWebsiteParameter;
use CE\Model\WebsiteParameterQuery as ChildWebsiteParameterQuery;
use CE\Model\WebsiteQuery as ChildWebsiteQuery;
use CE\Model\WebsiteRedirection as ChildWebsiteRedirection;
use CE\Model\WebsiteRedirectionQuery as ChildWebsiteRedirectionQuery;
use CE\Model\WebsiteRouting as ChildWebsiteRouting;
use CE\Model\WebsiteRoutingQuery as ChildWebsiteRoutingQuery;
use CE\Model\WebsiteZone as ChildWebsiteZone;
use CE\Model\WebsiteZoneQuery as ChildWebsiteZoneQuery;
use CE\Model\Map\MetaTableMap;
use CE\Model\Map\ModuleAuthorizationTableMap;
use CE\Model\Map\UserWebsiteTableMap;
use CE\Model\Map\WebsiteCultureTableMap;
use CE\Model\Map\WebsiteDomainTableMap;
use CE\Model\Map\WebsiteModuleTableMap;
use CE\Model\Map\WebsiteParameterTableMap;
use CE\Model\Map\WebsiteRedirectionTableMap;
use CE\Model\Map\WebsiteRoutingTableMap;
use CE\Model\Map\WebsiteTableMap;
use CE\Model\Map\WebsiteZoneTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'website' table.
 *
 *
 *
 * @package    propel.generator.src.CE.Model.Base
 */
abstract class Website implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CE\\Model\\Map\\WebsiteTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the account_id field.
     *
     * @var        int
     */
    protected $account_id;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the step_id field.
     *
     * @var        int
     */
    protected $step_id;

    /**
     * The value for the template field.
     *
     * @var        string
     */
    protected $template;

    /**
     * The value for the logo field.
     *
     * @var        string
     */
    protected $logo;

    /**
     * The value for the favicon field.
     *
     * @var        string
     */
    protected $favicon;

    /**
     * The value for the javascript field.
     *
     * @var        string
     */
    protected $javascript;

    /**
     * The value for the stylesheet field.
     *
     * @var        string
     */
    protected $stylesheet;

    /**
     * The value for the max_upload field.
     *
     * @var        int
     */
    protected $max_upload;

    /**
     * The value for the currency field.
     *
     * @var        string
     */
    protected $currency;

    /**
     * The value for the meta_auto field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $meta_auto;

    /**
     * The value for the ssl field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $ssl;

    /**
     * The value for the duplicable field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $duplicable;

    /**
     * The value for the wrapper field.
     *
     * @var        string
     */
    protected $wrapper;

    /**
     * The value for the wrapper_params field.
     *
     * @var        string
     */
    protected $wrapper_params;

    /**
     * @var        ChildAccount
     */
    protected $aAccount;

    /**
     * @var        ChildStep
     */
    protected $aStep;

    /**
     * @var        ObjectCollection|ChildMeta[] Collection to store aggregation of ChildMeta objects.
     */
    protected $collMetas;
    protected $collMetasPartial;

    /**
     * @var        ObjectCollection|ChildModuleAuthorization[] Collection to store aggregation of ChildModuleAuthorization objects.
     */
    protected $collModuleAuthorizations;
    protected $collModuleAuthorizationsPartial;

    /**
     * @var        ObjectCollection|ChildUserWebsite[] Collection to store aggregation of ChildUserWebsite objects.
     */
    protected $collUserWebsites;
    protected $collUserWebsitesPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteRedirection[] Collection to store aggregation of ChildWebsiteRedirection objects.
     */
    protected $collWebsiteRedirections;
    protected $collWebsiteRedirectionsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteCulture[] Collection to store aggregation of ChildWebsiteCulture objects.
     */
    protected $collWebsiteCultures;
    protected $collWebsiteCulturesPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteDomain[] Collection to store aggregation of ChildWebsiteDomain objects.
     */
    protected $collWebsiteDomains;
    protected $collWebsiteDomainsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteParameter[] Collection to store aggregation of ChildWebsiteParameter objects.
     */
    protected $collWebsiteParameters;
    protected $collWebsiteParametersPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteRouting[] Collection to store aggregation of ChildWebsiteRouting objects.
     */
    protected $collWebsiteRoutings;
    protected $collWebsiteRoutingsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteModule[] Collection to store aggregation of ChildWebsiteModule objects.
     */
    protected $collWebsiteModules;
    protected $collWebsiteModulesPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteZone[] Collection to store aggregation of ChildWebsiteZone objects.
     */
    protected $collWebsiteZones;
    protected $collWebsiteZonesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMeta[]
     */
    protected $metasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildModuleAuthorization[]
     */
    protected $moduleAuthorizationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserWebsite[]
     */
    protected $userWebsitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteRedirection[]
     */
    protected $websiteRedirectionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteCulture[]
     */
    protected $websiteCulturesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteDomain[]
     */
    protected $websiteDomainsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteParameter[]
     */
    protected $websiteParametersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteRouting[]
     */
    protected $websiteRoutingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteModule[]
     */
    protected $websiteModulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteZone[]
     */
    protected $websiteZonesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->meta_auto = true;
        $this->ssl = false;
        $this->duplicable = false;
    }

    /**
     * Initializes internal state of CE\Model\Base\Website object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Website</code> instance.  If
     * <code>obj</code> is an instance of <code>Website</code>, delegates to
     * <code>equals(Website)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Website The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [account_id] column value.
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [step_id] column value.
     *
     * @return int
     */
    public function getStepId()
    {
        return $this->step_id;
    }

    /**
     * Get the [template] column value.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Get the [logo] column value.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get the [favicon] column value.
     *
     * @return string
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Get the [javascript] column value.
     *
     * @return string
     */
    public function getJavascript()
    {
        return $this->javascript;
    }

    /**
     * Get the [stylesheet] column value.
     *
     * @return string
     */
    public function getStylesheet()
    {
        return $this->stylesheet;
    }

    /**
     * Get the [max_upload] column value.
     *
     * @return int
     */
    public function getMaxUpload()
    {
        return $this->max_upload;
    }

    /**
     * Get the [currency] column value.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Get the [meta_auto] column value.
     *
     * @return boolean
     */
    public function getMetaAuto()
    {
        return $this->meta_auto;
    }

    /**
     * Get the [meta_auto] column value.
     *
     * @return boolean
     */
    public function isMetaAuto()
    {
        return $this->getMetaAuto();
    }

    /**
     * Get the [ssl] column value.
     *
     * @return boolean
     */
    public function getSsl()
    {
        return $this->ssl;
    }

    /**
     * Get the [ssl] column value.
     *
     * @return boolean
     */
    public function isSsl()
    {
        return $this->getSsl();
    }

    /**
     * Get the [duplicable] column value.
     *
     * @return boolean
     */
    public function getDuplicable()
    {
        return $this->duplicable;
    }

    /**
     * Get the [duplicable] column value.
     *
     * @return boolean
     */
    public function isDuplicable()
    {
        return $this->getDuplicable();
    }

    /**
     * Get the [wrapper] column value.
     *
     * @return string
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Get the [wrapper_params] column value.
     *
     * @return string
     */
    public function getWrapperParams()
    {
        return $this->wrapper_params;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [account_id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setAccountId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->account_id !== $v) {
            $this->account_id = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_ACCOUNT_ID] = true;
        }

        if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
            $this->aAccount = null;
        }

        return $this;
    } // setAccountId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [step_id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setStepId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->step_id !== $v) {
            $this->step_id = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_STEP_ID] = true;
        }

        if ($this->aStep !== null && $this->aStep->getId() !== $v) {
            $this->aStep = null;
        }

        return $this;
    } // setStepId()

    /**
     * Set the value of [template] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setTemplate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->template !== $v) {
            $this->template = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_TEMPLATE] = true;
        }

        return $this;
    } // setTemplate()

    /**
     * Set the value of [logo] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setLogo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->logo !== $v) {
            $this->logo = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_LOGO] = true;
        }

        return $this;
    } // setLogo()

    /**
     * Set the value of [favicon] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setFavicon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->favicon !== $v) {
            $this->favicon = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_FAVICON] = true;
        }

        return $this;
    } // setFavicon()

    /**
     * Set the value of [javascript] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setJavascript($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->javascript !== $v) {
            $this->javascript = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_JAVASCRIPT] = true;
        }

        return $this;
    } // setJavascript()

    /**
     * Set the value of [stylesheet] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setStylesheet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stylesheet !== $v) {
            $this->stylesheet = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_STYLESHEET] = true;
        }

        return $this;
    } // setStylesheet()

    /**
     * Set the value of [max_upload] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setMaxUpload($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->max_upload !== $v) {
            $this->max_upload = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_MAX_UPLOAD] = true;
        }

        return $this;
    } // setMaxUpload()

    /**
     * Set the value of [currency] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setCurrency($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->currency !== $v) {
            $this->currency = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_CURRENCY] = true;
        }

        return $this;
    } // setCurrency()

    /**
     * Sets the value of the [meta_auto] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setMetaAuto($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->meta_auto !== $v) {
            $this->meta_auto = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_META_AUTO] = true;
        }

        return $this;
    } // setMetaAuto()

    /**
     * Sets the value of the [ssl] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setSsl($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->ssl !== $v) {
            $this->ssl = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_SSL] = true;
        }

        return $this;
    } // setSsl()

    /**
     * Sets the value of the [duplicable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setDuplicable($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->duplicable !== $v) {
            $this->duplicable = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_DUPLICABLE] = true;
        }

        return $this;
    } // setDuplicable()

    /**
     * Set the value of [wrapper] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setWrapper($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wrapper !== $v) {
            $this->wrapper = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_WRAPPER] = true;
        }

        return $this;
    } // setWrapper()

    /**
     * Set the value of [wrapper_params] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function setWrapperParams($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wrapper_params !== $v) {
            $this->wrapper_params = $v;
            $this->modifiedColumns[WebsiteTableMap::COL_WRAPPER_PARAMS] = true;
        }

        return $this;
    } // setWrapperParams()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->meta_auto !== true) {
                return false;
            }

            if ($this->ssl !== false) {
                return false;
            }

            if ($this->duplicable !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WebsiteTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WebsiteTableMap::translateFieldName('AccountId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->account_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WebsiteTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WebsiteTableMap::translateFieldName('StepId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->step_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WebsiteTableMap::translateFieldName('Template', TableMap::TYPE_PHPNAME, $indexType)];
            $this->template = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WebsiteTableMap::translateFieldName('Logo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->logo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WebsiteTableMap::translateFieldName('Favicon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->favicon = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WebsiteTableMap::translateFieldName('Javascript', TableMap::TYPE_PHPNAME, $indexType)];
            $this->javascript = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WebsiteTableMap::translateFieldName('Stylesheet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stylesheet = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WebsiteTableMap::translateFieldName('MaxUpload', TableMap::TYPE_PHPNAME, $indexType)];
            $this->max_upload = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WebsiteTableMap::translateFieldName('Currency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WebsiteTableMap::translateFieldName('MetaAuto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->meta_auto = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WebsiteTableMap::translateFieldName('Ssl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ssl = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : WebsiteTableMap::translateFieldName('Duplicable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->duplicable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : WebsiteTableMap::translateFieldName('Wrapper', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wrapper = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : WebsiteTableMap::translateFieldName('WrapperParams', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wrapper_params = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = WebsiteTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CE\\Model\\Website'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aAccount !== null && $this->account_id !== $this->aAccount->getId()) {
            $this->aAccount = null;
        }
        if ($this->aStep !== null && $this->step_id !== $this->aStep->getId()) {
            $this->aStep = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWebsiteQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAccount = null;
            $this->aStep = null;
            $this->collMetas = null;

            $this->collModuleAuthorizations = null;

            $this->collUserWebsites = null;

            $this->collWebsiteRedirections = null;

            $this->collWebsiteCultures = null;

            $this->collWebsiteDomains = null;

            $this->collWebsiteParameters = null;

            $this->collWebsiteRoutings = null;

            $this->collWebsiteModules = null;

            $this->collWebsiteZones = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Website::setDeleted()
     * @see Website::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWebsiteQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                WebsiteTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAccount !== null) {
                if ($this->aAccount->isModified() || $this->aAccount->isNew()) {
                    $affectedRows += $this->aAccount->save($con);
                }
                $this->setAccount($this->aAccount);
            }

            if ($this->aStep !== null) {
                if ($this->aStep->isModified() || $this->aStep->isNew()) {
                    $affectedRows += $this->aStep->save($con);
                }
                $this->setStep($this->aStep);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->metasScheduledForDeletion !== null) {
                if (!$this->metasScheduledForDeletion->isEmpty()) {
                    \CE\Model\MetaQuery::create()
                        ->filterByPrimaryKeys($this->metasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->metasScheduledForDeletion = null;
                }
            }

            if ($this->collMetas !== null) {
                foreach ($this->collMetas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->moduleAuthorizationsScheduledForDeletion !== null) {
                if (!$this->moduleAuthorizationsScheduledForDeletion->isEmpty()) {
                    \CE\Model\ModuleAuthorizationQuery::create()
                        ->filterByPrimaryKeys($this->moduleAuthorizationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->moduleAuthorizationsScheduledForDeletion = null;
                }
            }

            if ($this->collModuleAuthorizations !== null) {
                foreach ($this->collModuleAuthorizations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userWebsitesScheduledForDeletion !== null) {
                if (!$this->userWebsitesScheduledForDeletion->isEmpty()) {
                    \CE\Model\UserWebsiteQuery::create()
                        ->filterByPrimaryKeys($this->userWebsitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userWebsitesScheduledForDeletion = null;
                }
            }

            if ($this->collUserWebsites !== null) {
                foreach ($this->collUserWebsites as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteRedirectionsScheduledForDeletion !== null) {
                if (!$this->websiteRedirectionsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteRedirectionQuery::create()
                        ->filterByPrimaryKeys($this->websiteRedirectionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteRedirectionsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteRedirections !== null) {
                foreach ($this->collWebsiteRedirections as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteCulturesScheduledForDeletion !== null) {
                if (!$this->websiteCulturesScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteCultureQuery::create()
                        ->filterByPrimaryKeys($this->websiteCulturesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteCulturesScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteCultures !== null) {
                foreach ($this->collWebsiteCultures as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteDomainsScheduledForDeletion !== null) {
                if (!$this->websiteDomainsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteDomainQuery::create()
                        ->filterByPrimaryKeys($this->websiteDomainsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteDomainsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteDomains !== null) {
                foreach ($this->collWebsiteDomains as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteParametersScheduledForDeletion !== null) {
                if (!$this->websiteParametersScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteParameterQuery::create()
                        ->filterByPrimaryKeys($this->websiteParametersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteParametersScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteParameters !== null) {
                foreach ($this->collWebsiteParameters as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteRoutingsScheduledForDeletion !== null) {
                if (!$this->websiteRoutingsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteRoutingQuery::create()
                        ->filterByPrimaryKeys($this->websiteRoutingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteRoutingsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteRoutings !== null) {
                foreach ($this->collWebsiteRoutings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteModulesScheduledForDeletion !== null) {
                if (!$this->websiteModulesScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteModuleQuery::create()
                        ->filterByPrimaryKeys($this->websiteModulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteModulesScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteModules !== null) {
                foreach ($this->collWebsiteModules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteZonesScheduledForDeletion !== null) {
                if (!$this->websiteZonesScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteZoneQuery::create()
                        ->filterByPrimaryKeys($this->websiteZonesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteZonesScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteZones !== null) {
                foreach ($this->collWebsiteZones as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[WebsiteTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WebsiteTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WebsiteTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_ACCOUNT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`account_id`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_STEP_ID)) {
            $modifiedColumns[':p' . $index++]  = '`step_id`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = '`template`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_LOGO)) {
            $modifiedColumns[':p' . $index++]  = '`logo`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_FAVICON)) {
            $modifiedColumns[':p' . $index++]  = '`favicon`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_JAVASCRIPT)) {
            $modifiedColumns[':p' . $index++]  = '`javascript`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_STYLESHEET)) {
            $modifiedColumns[':p' . $index++]  = '`stylesheet`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_MAX_UPLOAD)) {
            $modifiedColumns[':p' . $index++]  = '`max_upload`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = '`currency`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_META_AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`meta_auto`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_SSL)) {
            $modifiedColumns[':p' . $index++]  = '`ssl`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_DUPLICABLE)) {
            $modifiedColumns[':p' . $index++]  = '`duplicable`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_WRAPPER)) {
            $modifiedColumns[':p' . $index++]  = '`wrapper`';
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_WRAPPER_PARAMS)) {
            $modifiedColumns[':p' . $index++]  = '`wrapper_params`';
        }

        $sql = sprintf(
            'INSERT INTO `website` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`account_id`':
                        $stmt->bindValue($identifier, $this->account_id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`step_id`':
                        $stmt->bindValue($identifier, $this->step_id, PDO::PARAM_INT);
                        break;
                    case '`template`':
                        $stmt->bindValue($identifier, $this->template, PDO::PARAM_STR);
                        break;
                    case '`logo`':
                        $stmt->bindValue($identifier, $this->logo, PDO::PARAM_STR);
                        break;
                    case '`favicon`':
                        $stmt->bindValue($identifier, $this->favicon, PDO::PARAM_STR);
                        break;
                    case '`javascript`':
                        $stmt->bindValue($identifier, $this->javascript, PDO::PARAM_STR);
                        break;
                    case '`stylesheet`':
                        $stmt->bindValue($identifier, $this->stylesheet, PDO::PARAM_STR);
                        break;
                    case '`max_upload`':
                        $stmt->bindValue($identifier, $this->max_upload, PDO::PARAM_INT);
                        break;
                    case '`currency`':
                        $stmt->bindValue($identifier, $this->currency, PDO::PARAM_STR);
                        break;
                    case '`meta_auto`':
                        $stmt->bindValue($identifier, (int) $this->meta_auto, PDO::PARAM_INT);
                        break;
                    case '`ssl`':
                        $stmt->bindValue($identifier, (int) $this->ssl, PDO::PARAM_INT);
                        break;
                    case '`duplicable`':
                        $stmt->bindValue($identifier, (int) $this->duplicable, PDO::PARAM_INT);
                        break;
                    case '`wrapper`':
                        $stmt->bindValue($identifier, $this->wrapper, PDO::PARAM_STR);
                        break;
                    case '`wrapper_params`':
                        $stmt->bindValue($identifier, $this->wrapper_params, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WebsiteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getAccountId();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getStepId();
                break;
            case 4:
                return $this->getTemplate();
                break;
            case 5:
                return $this->getLogo();
                break;
            case 6:
                return $this->getFavicon();
                break;
            case 7:
                return $this->getJavascript();
                break;
            case 8:
                return $this->getStylesheet();
                break;
            case 9:
                return $this->getMaxUpload();
                break;
            case 10:
                return $this->getCurrency();
                break;
            case 11:
                return $this->getMetaAuto();
                break;
            case 12:
                return $this->getSsl();
                break;
            case 13:
                return $this->getDuplicable();
                break;
            case 14:
                return $this->getWrapper();
                break;
            case 15:
                return $this->getWrapperParams();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Website'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Website'][$this->hashCode()] = true;
        $keys = WebsiteTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAccountId(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getStepId(),
            $keys[4] => $this->getTemplate(),
            $keys[5] => $this->getLogo(),
            $keys[6] => $this->getFavicon(),
            $keys[7] => $this->getJavascript(),
            $keys[8] => $this->getStylesheet(),
            $keys[9] => $this->getMaxUpload(),
            $keys[10] => $this->getCurrency(),
            $keys[11] => $this->getMetaAuto(),
            $keys[12] => $this->getSsl(),
            $keys[13] => $this->getDuplicable(),
            $keys[14] => $this->getWrapper(),
            $keys[15] => $this->getWrapperParams(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAccount) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'account';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'account';
                        break;
                    default:
                        $key = 'Account';
                }

                $result[$key] = $this->aAccount->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStep) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'step';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'step';
                        break;
                    default:
                        $key = 'Step';
                }

                $result[$key] = $this->aStep->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMetas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'metas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'metas';
                        break;
                    default:
                        $key = 'Metas';
                }

                $result[$key] = $this->collMetas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collModuleAuthorizations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'moduleAuthorizations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'module_authorizations';
                        break;
                    default:
                        $key = 'ModuleAuthorizations';
                }

                $result[$key] = $this->collModuleAuthorizations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserWebsites) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userWebsites';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_websites';
                        break;
                    default:
                        $key = 'UserWebsites';
                }

                $result[$key] = $this->collUserWebsites->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteRedirections) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteRedirections';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_redirections';
                        break;
                    default:
                        $key = 'WebsiteRedirections';
                }

                $result[$key] = $this->collWebsiteRedirections->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteCultures) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteCultures';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_cultures';
                        break;
                    default:
                        $key = 'WebsiteCultures';
                }

                $result[$key] = $this->collWebsiteCultures->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteDomains) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteDomains';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_domains';
                        break;
                    default:
                        $key = 'WebsiteDomains';
                }

                $result[$key] = $this->collWebsiteDomains->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteParameters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteParameters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_parameters';
                        break;
                    default:
                        $key = 'WebsiteParameters';
                }

                $result[$key] = $this->collWebsiteParameters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteRoutings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteRoutings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_routings';
                        break;
                    default:
                        $key = 'WebsiteRoutings';
                }

                $result[$key] = $this->collWebsiteRoutings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteModules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteModules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_modules';
                        break;
                    default:
                        $key = 'WebsiteModules';
                }

                $result[$key] = $this->collWebsiteModules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteZones) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteZones';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_zones';
                        break;
                    default:
                        $key = 'WebsiteZones';
                }

                $result[$key] = $this->collWebsiteZones->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\CE\Model\Website
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WebsiteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CE\Model\Website
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAccountId($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setStepId($value);
                break;
            case 4:
                $this->setTemplate($value);
                break;
            case 5:
                $this->setLogo($value);
                break;
            case 6:
                $this->setFavicon($value);
                break;
            case 7:
                $this->setJavascript($value);
                break;
            case 8:
                $this->setStylesheet($value);
                break;
            case 9:
                $this->setMaxUpload($value);
                break;
            case 10:
                $this->setCurrency($value);
                break;
            case 11:
                $this->setMetaAuto($value);
                break;
            case 12:
                $this->setSsl($value);
                break;
            case 13:
                $this->setDuplicable($value);
                break;
            case 14:
                $this->setWrapper($value);
                break;
            case 15:
                $this->setWrapperParams($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = WebsiteTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAccountId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStepId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTemplate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLogo($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFavicon($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setJavascript($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStylesheet($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setMaxUpload($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCurrency($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setMetaAuto($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setSsl($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDuplicable($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setWrapper($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setWrapperParams($arr[$keys[15]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\CE\Model\Website The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(WebsiteTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WebsiteTableMap::COL_ID)) {
            $criteria->add(WebsiteTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_ACCOUNT_ID)) {
            $criteria->add(WebsiteTableMap::COL_ACCOUNT_ID, $this->account_id);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_NAME)) {
            $criteria->add(WebsiteTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_STEP_ID)) {
            $criteria->add(WebsiteTableMap::COL_STEP_ID, $this->step_id);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_TEMPLATE)) {
            $criteria->add(WebsiteTableMap::COL_TEMPLATE, $this->template);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_LOGO)) {
            $criteria->add(WebsiteTableMap::COL_LOGO, $this->logo);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_FAVICON)) {
            $criteria->add(WebsiteTableMap::COL_FAVICON, $this->favicon);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_JAVASCRIPT)) {
            $criteria->add(WebsiteTableMap::COL_JAVASCRIPT, $this->javascript);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_STYLESHEET)) {
            $criteria->add(WebsiteTableMap::COL_STYLESHEET, $this->stylesheet);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_MAX_UPLOAD)) {
            $criteria->add(WebsiteTableMap::COL_MAX_UPLOAD, $this->max_upload);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_CURRENCY)) {
            $criteria->add(WebsiteTableMap::COL_CURRENCY, $this->currency);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_META_AUTO)) {
            $criteria->add(WebsiteTableMap::COL_META_AUTO, $this->meta_auto);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_SSL)) {
            $criteria->add(WebsiteTableMap::COL_SSL, $this->ssl);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_DUPLICABLE)) {
            $criteria->add(WebsiteTableMap::COL_DUPLICABLE, $this->duplicable);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_WRAPPER)) {
            $criteria->add(WebsiteTableMap::COL_WRAPPER, $this->wrapper);
        }
        if ($this->isColumnModified(WebsiteTableMap::COL_WRAPPER_PARAMS)) {
            $criteria->add(WebsiteTableMap::COL_WRAPPER_PARAMS, $this->wrapper_params);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildWebsiteQuery::create();
        $criteria->add(WebsiteTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CE\Model\Website (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAccountId($this->getAccountId());
        $copyObj->setName($this->getName());
        $copyObj->setStepId($this->getStepId());
        $copyObj->setTemplate($this->getTemplate());
        $copyObj->setLogo($this->getLogo());
        $copyObj->setFavicon($this->getFavicon());
        $copyObj->setJavascript($this->getJavascript());
        $copyObj->setStylesheet($this->getStylesheet());
        $copyObj->setMaxUpload($this->getMaxUpload());
        $copyObj->setCurrency($this->getCurrency());
        $copyObj->setMetaAuto($this->getMetaAuto());
        $copyObj->setSsl($this->getSsl());
        $copyObj->setDuplicable($this->getDuplicable());
        $copyObj->setWrapper($this->getWrapper());
        $copyObj->setWrapperParams($this->getWrapperParams());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMetas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMeta($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getModuleAuthorizations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addModuleAuthorization($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserWebsites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserWebsite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteRedirections() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteRedirection($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteCultures() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteCulture($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteDomains() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteDomain($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteParameters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteParameter($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteRoutings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteRouting($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteModules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteModule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteZones() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteZone($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \CE\Model\Website Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildAccount object.
     *
     * @param  ChildAccount $v
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAccount(ChildAccount $v = null)
    {
        if ($v === null) {
            $this->setAccountId(NULL);
        } else {
            $this->setAccountId($v->getId());
        }

        $this->aAccount = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAccount object, it will not be re-added.
        if ($v !== null) {
            $v->addWebsite($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAccount object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAccount The associated ChildAccount object.
     * @throws PropelException
     */
    public function getAccount(ConnectionInterface $con = null)
    {
        if ($this->aAccount === null && ($this->account_id != 0)) {
            $this->aAccount = ChildAccountQuery::create()->findPk($this->account_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAccount->addWebsites($this);
             */
        }

        return $this->aAccount;
    }

    /**
     * Declares an association between this object and a ChildStep object.
     *
     * @param  ChildStep $v
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStep(ChildStep $v = null)
    {
        if ($v === null) {
            $this->setStepId(NULL);
        } else {
            $this->setStepId($v->getId());
        }

        $this->aStep = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStep object, it will not be re-added.
        if ($v !== null) {
            $v->addWebsite($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStep object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStep The associated ChildStep object.
     * @throws PropelException
     */
    public function getStep(ConnectionInterface $con = null)
    {
        if ($this->aStep === null && ($this->step_id != 0)) {
            $this->aStep = ChildStepQuery::create()->findPk($this->step_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStep->addWebsites($this);
             */
        }

        return $this->aStep;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Meta' == $relationName) {
            $this->initMetas();
            return;
        }
        if ('ModuleAuthorization' == $relationName) {
            $this->initModuleAuthorizations();
            return;
        }
        if ('UserWebsite' == $relationName) {
            $this->initUserWebsites();
            return;
        }
        if ('WebsiteRedirection' == $relationName) {
            $this->initWebsiteRedirections();
            return;
        }
        if ('WebsiteCulture' == $relationName) {
            $this->initWebsiteCultures();
            return;
        }
        if ('WebsiteDomain' == $relationName) {
            $this->initWebsiteDomains();
            return;
        }
        if ('WebsiteParameter' == $relationName) {
            $this->initWebsiteParameters();
            return;
        }
        if ('WebsiteRouting' == $relationName) {
            $this->initWebsiteRoutings();
            return;
        }
        if ('WebsiteModule' == $relationName) {
            $this->initWebsiteModules();
            return;
        }
        if ('WebsiteZone' == $relationName) {
            $this->initWebsiteZones();
            return;
        }
    }

    /**
     * Clears out the collMetas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMetas()
     */
    public function clearMetas()
    {
        $this->collMetas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMetas collection loaded partially.
     */
    public function resetPartialMetas($v = true)
    {
        $this->collMetasPartial = $v;
    }

    /**
     * Initializes the collMetas collection.
     *
     * By default this just sets the collMetas collection to an empty array (like clearcollMetas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMetas($overrideExisting = true)
    {
        if (null !== $this->collMetas && !$overrideExisting) {
            return;
        }

        $collectionClassName = MetaTableMap::getTableMap()->getCollectionClassName();

        $this->collMetas = new $collectionClassName;
        $this->collMetas->setModel('\CE\Model\Meta');
    }

    /**
     * Gets an array of ChildMeta objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMeta[] List of ChildMeta objects
     * @throws PropelException
     */
    public function getMetas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMetasPartial && !$this->isNew();
        if (null === $this->collMetas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMetas) {
                // return empty collection
                $this->initMetas();
            } else {
                $collMetas = ChildMetaQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMetasPartial && count($collMetas)) {
                        $this->initMetas(false);

                        foreach ($collMetas as $obj) {
                            if (false == $this->collMetas->contains($obj)) {
                                $this->collMetas->append($obj);
                            }
                        }

                        $this->collMetasPartial = true;
                    }

                    return $collMetas;
                }

                if ($partial && $this->collMetas) {
                    foreach ($this->collMetas as $obj) {
                        if ($obj->isNew()) {
                            $collMetas[] = $obj;
                        }
                    }
                }

                $this->collMetas = $collMetas;
                $this->collMetasPartial = false;
            }
        }

        return $this->collMetas;
    }

    /**
     * Sets a collection of ChildMeta objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $metas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setMetas(Collection $metas, ConnectionInterface $con = null)
    {
        /** @var ChildMeta[] $metasToDelete */
        $metasToDelete = $this->getMetas(new Criteria(), $con)->diff($metas);


        $this->metasScheduledForDeletion = $metasToDelete;

        foreach ($metasToDelete as $metaRemoved) {
            $metaRemoved->setWebsite(null);
        }

        $this->collMetas = null;
        foreach ($metas as $meta) {
            $this->addMeta($meta);
        }

        $this->collMetas = $metas;
        $this->collMetasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Meta objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Meta objects.
     * @throws PropelException
     */
    public function countMetas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMetasPartial && !$this->isNew();
        if (null === $this->collMetas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMetas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMetas());
            }

            $query = ChildMetaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collMetas);
    }

    /**
     * Method called to associate a ChildMeta object to this object
     * through the ChildMeta foreign key attribute.
     *
     * @param  ChildMeta $l ChildMeta
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addMeta(ChildMeta $l)
    {
        if ($this->collMetas === null) {
            $this->initMetas();
            $this->collMetasPartial = true;
        }

        if (!$this->collMetas->contains($l)) {
            $this->doAddMeta($l);

            if ($this->metasScheduledForDeletion and $this->metasScheduledForDeletion->contains($l)) {
                $this->metasScheduledForDeletion->remove($this->metasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMeta $meta The ChildMeta object to add.
     */
    protected function doAddMeta(ChildMeta $meta)
    {
        $this->collMetas[]= $meta;
        $meta->setWebsite($this);
    }

    /**
     * @param  ChildMeta $meta The ChildMeta object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeMeta(ChildMeta $meta)
    {
        if ($this->getMetas()->contains($meta)) {
            $pos = $this->collMetas->search($meta);
            $this->collMetas->remove($pos);
            if (null === $this->metasScheduledForDeletion) {
                $this->metasScheduledForDeletion = clone $this->collMetas;
                $this->metasScheduledForDeletion->clear();
            }
            $this->metasScheduledForDeletion[]= $meta;
            $meta->setWebsite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Website is new, it will return
     * an empty collection; or if this Website has previously
     * been saved, it will retrieve related Metas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Website.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMeta[] List of ChildMeta objects
     */
    public function getMetasJoinWebsiteRouting(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMetaQuery::create(null, $criteria);
        $query->joinWith('WebsiteRouting', $joinBehavior);

        return $this->getMetas($query, $con);
    }

    /**
     * Clears out the collModuleAuthorizations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addModuleAuthorizations()
     */
    public function clearModuleAuthorizations()
    {
        $this->collModuleAuthorizations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collModuleAuthorizations collection loaded partially.
     */
    public function resetPartialModuleAuthorizations($v = true)
    {
        $this->collModuleAuthorizationsPartial = $v;
    }

    /**
     * Initializes the collModuleAuthorizations collection.
     *
     * By default this just sets the collModuleAuthorizations collection to an empty array (like clearcollModuleAuthorizations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initModuleAuthorizations($overrideExisting = true)
    {
        if (null !== $this->collModuleAuthorizations && !$overrideExisting) {
            return;
        }

        $collectionClassName = ModuleAuthorizationTableMap::getTableMap()->getCollectionClassName();

        $this->collModuleAuthorizations = new $collectionClassName;
        $this->collModuleAuthorizations->setModel('\CE\Model\ModuleAuthorization');
    }

    /**
     * Gets an array of ChildModuleAuthorization objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildModuleAuthorization[] List of ChildModuleAuthorization objects
     * @throws PropelException
     */
    public function getModuleAuthorizations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collModuleAuthorizationsPartial && !$this->isNew();
        if (null === $this->collModuleAuthorizations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collModuleAuthorizations) {
                // return empty collection
                $this->initModuleAuthorizations();
            } else {
                $collModuleAuthorizations = ChildModuleAuthorizationQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collModuleAuthorizationsPartial && count($collModuleAuthorizations)) {
                        $this->initModuleAuthorizations(false);

                        foreach ($collModuleAuthorizations as $obj) {
                            if (false == $this->collModuleAuthorizations->contains($obj)) {
                                $this->collModuleAuthorizations->append($obj);
                            }
                        }

                        $this->collModuleAuthorizationsPartial = true;
                    }

                    return $collModuleAuthorizations;
                }

                if ($partial && $this->collModuleAuthorizations) {
                    foreach ($this->collModuleAuthorizations as $obj) {
                        if ($obj->isNew()) {
                            $collModuleAuthorizations[] = $obj;
                        }
                    }
                }

                $this->collModuleAuthorizations = $collModuleAuthorizations;
                $this->collModuleAuthorizationsPartial = false;
            }
        }

        return $this->collModuleAuthorizations;
    }

    /**
     * Sets a collection of ChildModuleAuthorization objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $moduleAuthorizations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setModuleAuthorizations(Collection $moduleAuthorizations, ConnectionInterface $con = null)
    {
        /** @var ChildModuleAuthorization[] $moduleAuthorizationsToDelete */
        $moduleAuthorizationsToDelete = $this->getModuleAuthorizations(new Criteria(), $con)->diff($moduleAuthorizations);


        $this->moduleAuthorizationsScheduledForDeletion = $moduleAuthorizationsToDelete;

        foreach ($moduleAuthorizationsToDelete as $moduleAuthorizationRemoved) {
            $moduleAuthorizationRemoved->setWebsite(null);
        }

        $this->collModuleAuthorizations = null;
        foreach ($moduleAuthorizations as $moduleAuthorization) {
            $this->addModuleAuthorization($moduleAuthorization);
        }

        $this->collModuleAuthorizations = $moduleAuthorizations;
        $this->collModuleAuthorizationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ModuleAuthorization objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ModuleAuthorization objects.
     * @throws PropelException
     */
    public function countModuleAuthorizations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collModuleAuthorizationsPartial && !$this->isNew();
        if (null === $this->collModuleAuthorizations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collModuleAuthorizations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getModuleAuthorizations());
            }

            $query = ChildModuleAuthorizationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collModuleAuthorizations);
    }

    /**
     * Method called to associate a ChildModuleAuthorization object to this object
     * through the ChildModuleAuthorization foreign key attribute.
     *
     * @param  ChildModuleAuthorization $l ChildModuleAuthorization
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addModuleAuthorization(ChildModuleAuthorization $l)
    {
        if ($this->collModuleAuthorizations === null) {
            $this->initModuleAuthorizations();
            $this->collModuleAuthorizationsPartial = true;
        }

        if (!$this->collModuleAuthorizations->contains($l)) {
            $this->doAddModuleAuthorization($l);

            if ($this->moduleAuthorizationsScheduledForDeletion and $this->moduleAuthorizationsScheduledForDeletion->contains($l)) {
                $this->moduleAuthorizationsScheduledForDeletion->remove($this->moduleAuthorizationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildModuleAuthorization $moduleAuthorization The ChildModuleAuthorization object to add.
     */
    protected function doAddModuleAuthorization(ChildModuleAuthorization $moduleAuthorization)
    {
        $this->collModuleAuthorizations[]= $moduleAuthorization;
        $moduleAuthorization->setWebsite($this);
    }

    /**
     * @param  ChildModuleAuthorization $moduleAuthorization The ChildModuleAuthorization object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeModuleAuthorization(ChildModuleAuthorization $moduleAuthorization)
    {
        if ($this->getModuleAuthorizations()->contains($moduleAuthorization)) {
            $pos = $this->collModuleAuthorizations->search($moduleAuthorization);
            $this->collModuleAuthorizations->remove($pos);
            if (null === $this->moduleAuthorizationsScheduledForDeletion) {
                $this->moduleAuthorizationsScheduledForDeletion = clone $this->collModuleAuthorizations;
                $this->moduleAuthorizationsScheduledForDeletion->clear();
            }
            $this->moduleAuthorizationsScheduledForDeletion[]= $moduleAuthorization;
            $moduleAuthorization->setWebsite(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserWebsites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserWebsites()
     */
    public function clearUserWebsites()
    {
        $this->collUserWebsites = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserWebsites collection loaded partially.
     */
    public function resetPartialUserWebsites($v = true)
    {
        $this->collUserWebsitesPartial = $v;
    }

    /**
     * Initializes the collUserWebsites collection.
     *
     * By default this just sets the collUserWebsites collection to an empty array (like clearcollUserWebsites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserWebsites($overrideExisting = true)
    {
        if (null !== $this->collUserWebsites && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserWebsiteTableMap::getTableMap()->getCollectionClassName();

        $this->collUserWebsites = new $collectionClassName;
        $this->collUserWebsites->setModel('\CE\Model\UserWebsite');
    }

    /**
     * Gets an array of ChildUserWebsite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserWebsite[] List of ChildUserWebsite objects
     * @throws PropelException
     */
    public function getUserWebsites(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWebsitesPartial && !$this->isNew();
        if (null === $this->collUserWebsites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserWebsites) {
                // return empty collection
                $this->initUserWebsites();
            } else {
                $collUserWebsites = ChildUserWebsiteQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserWebsitesPartial && count($collUserWebsites)) {
                        $this->initUserWebsites(false);

                        foreach ($collUserWebsites as $obj) {
                            if (false == $this->collUserWebsites->contains($obj)) {
                                $this->collUserWebsites->append($obj);
                            }
                        }

                        $this->collUserWebsitesPartial = true;
                    }

                    return $collUserWebsites;
                }

                if ($partial && $this->collUserWebsites) {
                    foreach ($this->collUserWebsites as $obj) {
                        if ($obj->isNew()) {
                            $collUserWebsites[] = $obj;
                        }
                    }
                }

                $this->collUserWebsites = $collUserWebsites;
                $this->collUserWebsitesPartial = false;
            }
        }

        return $this->collUserWebsites;
    }

    /**
     * Sets a collection of ChildUserWebsite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userWebsites A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setUserWebsites(Collection $userWebsites, ConnectionInterface $con = null)
    {
        /** @var ChildUserWebsite[] $userWebsitesToDelete */
        $userWebsitesToDelete = $this->getUserWebsites(new Criteria(), $con)->diff($userWebsites);


        $this->userWebsitesScheduledForDeletion = $userWebsitesToDelete;

        foreach ($userWebsitesToDelete as $userWebsiteRemoved) {
            $userWebsiteRemoved->setWebsite(null);
        }

        $this->collUserWebsites = null;
        foreach ($userWebsites as $userWebsite) {
            $this->addUserWebsite($userWebsite);
        }

        $this->collUserWebsites = $userWebsites;
        $this->collUserWebsitesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserWebsite objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserWebsite objects.
     * @throws PropelException
     */
    public function countUserWebsites(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWebsitesPartial && !$this->isNew();
        if (null === $this->collUserWebsites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserWebsites) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserWebsites());
            }

            $query = ChildUserWebsiteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collUserWebsites);
    }

    /**
     * Method called to associate a ChildUserWebsite object to this object
     * through the ChildUserWebsite foreign key attribute.
     *
     * @param  ChildUserWebsite $l ChildUserWebsite
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addUserWebsite(ChildUserWebsite $l)
    {
        if ($this->collUserWebsites === null) {
            $this->initUserWebsites();
            $this->collUserWebsitesPartial = true;
        }

        if (!$this->collUserWebsites->contains($l)) {
            $this->doAddUserWebsite($l);

            if ($this->userWebsitesScheduledForDeletion and $this->userWebsitesScheduledForDeletion->contains($l)) {
                $this->userWebsitesScheduledForDeletion->remove($this->userWebsitesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserWebsite $userWebsite The ChildUserWebsite object to add.
     */
    protected function doAddUserWebsite(ChildUserWebsite $userWebsite)
    {
        $this->collUserWebsites[]= $userWebsite;
        $userWebsite->setWebsite($this);
    }

    /**
     * @param  ChildUserWebsite $userWebsite The ChildUserWebsite object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeUserWebsite(ChildUserWebsite $userWebsite)
    {
        if ($this->getUserWebsites()->contains($userWebsite)) {
            $pos = $this->collUserWebsites->search($userWebsite);
            $this->collUserWebsites->remove($pos);
            if (null === $this->userWebsitesScheduledForDeletion) {
                $this->userWebsitesScheduledForDeletion = clone $this->collUserWebsites;
                $this->userWebsitesScheduledForDeletion->clear();
            }
            $this->userWebsitesScheduledForDeletion[]= clone $userWebsite;
            $userWebsite->setWebsite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Website is new, it will return
     * an empty collection; or if this Website has previously
     * been saved, it will retrieve related UserWebsites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Website.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserWebsite[] List of ChildUserWebsite objects
     */
    public function getUserWebsitesJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserWebsiteQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getUserWebsites($query, $con);
    }

    /**
     * Clears out the collWebsiteRedirections collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteRedirections()
     */
    public function clearWebsiteRedirections()
    {
        $this->collWebsiteRedirections = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteRedirections collection loaded partially.
     */
    public function resetPartialWebsiteRedirections($v = true)
    {
        $this->collWebsiteRedirectionsPartial = $v;
    }

    /**
     * Initializes the collWebsiteRedirections collection.
     *
     * By default this just sets the collWebsiteRedirections collection to an empty array (like clearcollWebsiteRedirections());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteRedirections($overrideExisting = true)
    {
        if (null !== $this->collWebsiteRedirections && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteRedirectionTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteRedirections = new $collectionClassName;
        $this->collWebsiteRedirections->setModel('\CE\Model\WebsiteRedirection');
    }

    /**
     * Gets an array of ChildWebsiteRedirection objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteRedirection[] List of ChildWebsiteRedirection objects
     * @throws PropelException
     */
    public function getWebsiteRedirections(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRedirectionsPartial && !$this->isNew();
        if (null === $this->collWebsiteRedirections || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRedirections) {
                // return empty collection
                $this->initWebsiteRedirections();
            } else {
                $collWebsiteRedirections = ChildWebsiteRedirectionQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteRedirectionsPartial && count($collWebsiteRedirections)) {
                        $this->initWebsiteRedirections(false);

                        foreach ($collWebsiteRedirections as $obj) {
                            if (false == $this->collWebsiteRedirections->contains($obj)) {
                                $this->collWebsiteRedirections->append($obj);
                            }
                        }

                        $this->collWebsiteRedirectionsPartial = true;
                    }

                    return $collWebsiteRedirections;
                }

                if ($partial && $this->collWebsiteRedirections) {
                    foreach ($this->collWebsiteRedirections as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteRedirections[] = $obj;
                        }
                    }
                }

                $this->collWebsiteRedirections = $collWebsiteRedirections;
                $this->collWebsiteRedirectionsPartial = false;
            }
        }

        return $this->collWebsiteRedirections;
    }

    /**
     * Sets a collection of ChildWebsiteRedirection objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteRedirections A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteRedirections(Collection $websiteRedirections, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteRedirection[] $websiteRedirectionsToDelete */
        $websiteRedirectionsToDelete = $this->getWebsiteRedirections(new Criteria(), $con)->diff($websiteRedirections);


        $this->websiteRedirectionsScheduledForDeletion = $websiteRedirectionsToDelete;

        foreach ($websiteRedirectionsToDelete as $websiteRedirectionRemoved) {
            $websiteRedirectionRemoved->setWebsite(null);
        }

        $this->collWebsiteRedirections = null;
        foreach ($websiteRedirections as $websiteRedirection) {
            $this->addWebsiteRedirection($websiteRedirection);
        }

        $this->collWebsiteRedirections = $websiteRedirections;
        $this->collWebsiteRedirectionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteRedirection objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteRedirection objects.
     * @throws PropelException
     */
    public function countWebsiteRedirections(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRedirectionsPartial && !$this->isNew();
        if (null === $this->collWebsiteRedirections || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRedirections) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteRedirections());
            }

            $query = ChildWebsiteRedirectionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteRedirections);
    }

    /**
     * Method called to associate a ChildWebsiteRedirection object to this object
     * through the ChildWebsiteRedirection foreign key attribute.
     *
     * @param  ChildWebsiteRedirection $l ChildWebsiteRedirection
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteRedirection(ChildWebsiteRedirection $l)
    {
        if ($this->collWebsiteRedirections === null) {
            $this->initWebsiteRedirections();
            $this->collWebsiteRedirectionsPartial = true;
        }

        if (!$this->collWebsiteRedirections->contains($l)) {
            $this->doAddWebsiteRedirection($l);

            if ($this->websiteRedirectionsScheduledForDeletion and $this->websiteRedirectionsScheduledForDeletion->contains($l)) {
                $this->websiteRedirectionsScheduledForDeletion->remove($this->websiteRedirectionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteRedirection $websiteRedirection The ChildWebsiteRedirection object to add.
     */
    protected function doAddWebsiteRedirection(ChildWebsiteRedirection $websiteRedirection)
    {
        $this->collWebsiteRedirections[]= $websiteRedirection;
        $websiteRedirection->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteRedirection $websiteRedirection The ChildWebsiteRedirection object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteRedirection(ChildWebsiteRedirection $websiteRedirection)
    {
        if ($this->getWebsiteRedirections()->contains($websiteRedirection)) {
            $pos = $this->collWebsiteRedirections->search($websiteRedirection);
            $this->collWebsiteRedirections->remove($pos);
            if (null === $this->websiteRedirectionsScheduledForDeletion) {
                $this->websiteRedirectionsScheduledForDeletion = clone $this->collWebsiteRedirections;
                $this->websiteRedirectionsScheduledForDeletion->clear();
            }
            $this->websiteRedirectionsScheduledForDeletion[]= clone $websiteRedirection;
            $websiteRedirection->setWebsite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Website is new, it will return
     * an empty collection; or if this Website has previously
     * been saved, it will retrieve related WebsiteRedirections from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Website.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteRedirection[] List of ChildWebsiteRedirection objects
     */
    public function getWebsiteRedirectionsJoinWebsiteRouting(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteRedirectionQuery::create(null, $criteria);
        $query->joinWith('WebsiteRouting', $joinBehavior);

        return $this->getWebsiteRedirections($query, $con);
    }

    /**
     * Clears out the collWebsiteCultures collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteCultures()
     */
    public function clearWebsiteCultures()
    {
        $this->collWebsiteCultures = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteCultures collection loaded partially.
     */
    public function resetPartialWebsiteCultures($v = true)
    {
        $this->collWebsiteCulturesPartial = $v;
    }

    /**
     * Initializes the collWebsiteCultures collection.
     *
     * By default this just sets the collWebsiteCultures collection to an empty array (like clearcollWebsiteCultures());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteCultures($overrideExisting = true)
    {
        if (null !== $this->collWebsiteCultures && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteCultureTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteCultures = new $collectionClassName;
        $this->collWebsiteCultures->setModel('\CE\Model\WebsiteCulture');
    }

    /**
     * Gets an array of ChildWebsiteCulture objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteCulture[] List of ChildWebsiteCulture objects
     * @throws PropelException
     */
    public function getWebsiteCultures(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteCulturesPartial && !$this->isNew();
        if (null === $this->collWebsiteCultures || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteCultures) {
                // return empty collection
                $this->initWebsiteCultures();
            } else {
                $collWebsiteCultures = ChildWebsiteCultureQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteCulturesPartial && count($collWebsiteCultures)) {
                        $this->initWebsiteCultures(false);

                        foreach ($collWebsiteCultures as $obj) {
                            if (false == $this->collWebsiteCultures->contains($obj)) {
                                $this->collWebsiteCultures->append($obj);
                            }
                        }

                        $this->collWebsiteCulturesPartial = true;
                    }

                    return $collWebsiteCultures;
                }

                if ($partial && $this->collWebsiteCultures) {
                    foreach ($this->collWebsiteCultures as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteCultures[] = $obj;
                        }
                    }
                }

                $this->collWebsiteCultures = $collWebsiteCultures;
                $this->collWebsiteCulturesPartial = false;
            }
        }

        return $this->collWebsiteCultures;
    }

    /**
     * Sets a collection of ChildWebsiteCulture objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteCultures A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteCultures(Collection $websiteCultures, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteCulture[] $websiteCulturesToDelete */
        $websiteCulturesToDelete = $this->getWebsiteCultures(new Criteria(), $con)->diff($websiteCultures);


        $this->websiteCulturesScheduledForDeletion = $websiteCulturesToDelete;

        foreach ($websiteCulturesToDelete as $websiteCultureRemoved) {
            $websiteCultureRemoved->setWebsite(null);
        }

        $this->collWebsiteCultures = null;
        foreach ($websiteCultures as $websiteCulture) {
            $this->addWebsiteCulture($websiteCulture);
        }

        $this->collWebsiteCultures = $websiteCultures;
        $this->collWebsiteCulturesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteCulture objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteCulture objects.
     * @throws PropelException
     */
    public function countWebsiteCultures(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteCulturesPartial && !$this->isNew();
        if (null === $this->collWebsiteCultures || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteCultures) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteCultures());
            }

            $query = ChildWebsiteCultureQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteCultures);
    }

    /**
     * Method called to associate a ChildWebsiteCulture object to this object
     * through the ChildWebsiteCulture foreign key attribute.
     *
     * @param  ChildWebsiteCulture $l ChildWebsiteCulture
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteCulture(ChildWebsiteCulture $l)
    {
        if ($this->collWebsiteCultures === null) {
            $this->initWebsiteCultures();
            $this->collWebsiteCulturesPartial = true;
        }

        if (!$this->collWebsiteCultures->contains($l)) {
            $this->doAddWebsiteCulture($l);

            if ($this->websiteCulturesScheduledForDeletion and $this->websiteCulturesScheduledForDeletion->contains($l)) {
                $this->websiteCulturesScheduledForDeletion->remove($this->websiteCulturesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteCulture $websiteCulture The ChildWebsiteCulture object to add.
     */
    protected function doAddWebsiteCulture(ChildWebsiteCulture $websiteCulture)
    {
        $this->collWebsiteCultures[]= $websiteCulture;
        $websiteCulture->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteCulture $websiteCulture The ChildWebsiteCulture object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteCulture(ChildWebsiteCulture $websiteCulture)
    {
        if ($this->getWebsiteCultures()->contains($websiteCulture)) {
            $pos = $this->collWebsiteCultures->search($websiteCulture);
            $this->collWebsiteCultures->remove($pos);
            if (null === $this->websiteCulturesScheduledForDeletion) {
                $this->websiteCulturesScheduledForDeletion = clone $this->collWebsiteCultures;
                $this->websiteCulturesScheduledForDeletion->clear();
            }
            $this->websiteCulturesScheduledForDeletion[]= clone $websiteCulture;
            $websiteCulture->setWebsite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Website is new, it will return
     * an empty collection; or if this Website has previously
     * been saved, it will retrieve related WebsiteCultures from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Website.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteCulture[] List of ChildWebsiteCulture objects
     */
    public function getWebsiteCulturesJoinCulture(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteCultureQuery::create(null, $criteria);
        $query->joinWith('Culture', $joinBehavior);

        return $this->getWebsiteCultures($query, $con);
    }

    /**
     * Clears out the collWebsiteDomains collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteDomains()
     */
    public function clearWebsiteDomains()
    {
        $this->collWebsiteDomains = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteDomains collection loaded partially.
     */
    public function resetPartialWebsiteDomains($v = true)
    {
        $this->collWebsiteDomainsPartial = $v;
    }

    /**
     * Initializes the collWebsiteDomains collection.
     *
     * By default this just sets the collWebsiteDomains collection to an empty array (like clearcollWebsiteDomains());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteDomains($overrideExisting = true)
    {
        if (null !== $this->collWebsiteDomains && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteDomainTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteDomains = new $collectionClassName;
        $this->collWebsiteDomains->setModel('\CE\Model\WebsiteDomain');
    }

    /**
     * Gets an array of ChildWebsiteDomain objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteDomain[] List of ChildWebsiteDomain objects
     * @throws PropelException
     */
    public function getWebsiteDomains(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteDomainsPartial && !$this->isNew();
        if (null === $this->collWebsiteDomains || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteDomains) {
                // return empty collection
                $this->initWebsiteDomains();
            } else {
                $collWebsiteDomains = ChildWebsiteDomainQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteDomainsPartial && count($collWebsiteDomains)) {
                        $this->initWebsiteDomains(false);

                        foreach ($collWebsiteDomains as $obj) {
                            if (false == $this->collWebsiteDomains->contains($obj)) {
                                $this->collWebsiteDomains->append($obj);
                            }
                        }

                        $this->collWebsiteDomainsPartial = true;
                    }

                    return $collWebsiteDomains;
                }

                if ($partial && $this->collWebsiteDomains) {
                    foreach ($this->collWebsiteDomains as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteDomains[] = $obj;
                        }
                    }
                }

                $this->collWebsiteDomains = $collWebsiteDomains;
                $this->collWebsiteDomainsPartial = false;
            }
        }

        return $this->collWebsiteDomains;
    }

    /**
     * Sets a collection of ChildWebsiteDomain objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteDomains A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteDomains(Collection $websiteDomains, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteDomain[] $websiteDomainsToDelete */
        $websiteDomainsToDelete = $this->getWebsiteDomains(new Criteria(), $con)->diff($websiteDomains);


        $this->websiteDomainsScheduledForDeletion = $websiteDomainsToDelete;

        foreach ($websiteDomainsToDelete as $websiteDomainRemoved) {
            $websiteDomainRemoved->setWebsite(null);
        }

        $this->collWebsiteDomains = null;
        foreach ($websiteDomains as $websiteDomain) {
            $this->addWebsiteDomain($websiteDomain);
        }

        $this->collWebsiteDomains = $websiteDomains;
        $this->collWebsiteDomainsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteDomain objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteDomain objects.
     * @throws PropelException
     */
    public function countWebsiteDomains(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteDomainsPartial && !$this->isNew();
        if (null === $this->collWebsiteDomains || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteDomains) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteDomains());
            }

            $query = ChildWebsiteDomainQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteDomains);
    }

    /**
     * Method called to associate a ChildWebsiteDomain object to this object
     * through the ChildWebsiteDomain foreign key attribute.
     *
     * @param  ChildWebsiteDomain $l ChildWebsiteDomain
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteDomain(ChildWebsiteDomain $l)
    {
        if ($this->collWebsiteDomains === null) {
            $this->initWebsiteDomains();
            $this->collWebsiteDomainsPartial = true;
        }

        if (!$this->collWebsiteDomains->contains($l)) {
            $this->doAddWebsiteDomain($l);

            if ($this->websiteDomainsScheduledForDeletion and $this->websiteDomainsScheduledForDeletion->contains($l)) {
                $this->websiteDomainsScheduledForDeletion->remove($this->websiteDomainsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteDomain $websiteDomain The ChildWebsiteDomain object to add.
     */
    protected function doAddWebsiteDomain(ChildWebsiteDomain $websiteDomain)
    {
        $this->collWebsiteDomains[]= $websiteDomain;
        $websiteDomain->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteDomain $websiteDomain The ChildWebsiteDomain object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteDomain(ChildWebsiteDomain $websiteDomain)
    {
        if ($this->getWebsiteDomains()->contains($websiteDomain)) {
            $pos = $this->collWebsiteDomains->search($websiteDomain);
            $this->collWebsiteDomains->remove($pos);
            if (null === $this->websiteDomainsScheduledForDeletion) {
                $this->websiteDomainsScheduledForDeletion = clone $this->collWebsiteDomains;
                $this->websiteDomainsScheduledForDeletion->clear();
            }
            $this->websiteDomainsScheduledForDeletion[]= clone $websiteDomain;
            $websiteDomain->setWebsite(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteParameters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteParameters()
     */
    public function clearWebsiteParameters()
    {
        $this->collWebsiteParameters = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteParameters collection loaded partially.
     */
    public function resetPartialWebsiteParameters($v = true)
    {
        $this->collWebsiteParametersPartial = $v;
    }

    /**
     * Initializes the collWebsiteParameters collection.
     *
     * By default this just sets the collWebsiteParameters collection to an empty array (like clearcollWebsiteParameters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteParameters($overrideExisting = true)
    {
        if (null !== $this->collWebsiteParameters && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteParameterTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteParameters = new $collectionClassName;
        $this->collWebsiteParameters->setModel('\CE\Model\WebsiteParameter');
    }

    /**
     * Gets an array of ChildWebsiteParameter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteParameter[] List of ChildWebsiteParameter objects
     * @throws PropelException
     */
    public function getWebsiteParameters(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteParametersPartial && !$this->isNew();
        if (null === $this->collWebsiteParameters || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteParameters) {
                // return empty collection
                $this->initWebsiteParameters();
            } else {
                $collWebsiteParameters = ChildWebsiteParameterQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteParametersPartial && count($collWebsiteParameters)) {
                        $this->initWebsiteParameters(false);

                        foreach ($collWebsiteParameters as $obj) {
                            if (false == $this->collWebsiteParameters->contains($obj)) {
                                $this->collWebsiteParameters->append($obj);
                            }
                        }

                        $this->collWebsiteParametersPartial = true;
                    }

                    return $collWebsiteParameters;
                }

                if ($partial && $this->collWebsiteParameters) {
                    foreach ($this->collWebsiteParameters as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteParameters[] = $obj;
                        }
                    }
                }

                $this->collWebsiteParameters = $collWebsiteParameters;
                $this->collWebsiteParametersPartial = false;
            }
        }

        return $this->collWebsiteParameters;
    }

    /**
     * Sets a collection of ChildWebsiteParameter objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteParameters A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteParameters(Collection $websiteParameters, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteParameter[] $websiteParametersToDelete */
        $websiteParametersToDelete = $this->getWebsiteParameters(new Criteria(), $con)->diff($websiteParameters);


        $this->websiteParametersScheduledForDeletion = $websiteParametersToDelete;

        foreach ($websiteParametersToDelete as $websiteParameterRemoved) {
            $websiteParameterRemoved->setWebsite(null);
        }

        $this->collWebsiteParameters = null;
        foreach ($websiteParameters as $websiteParameter) {
            $this->addWebsiteParameter($websiteParameter);
        }

        $this->collWebsiteParameters = $websiteParameters;
        $this->collWebsiteParametersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteParameter objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteParameter objects.
     * @throws PropelException
     */
    public function countWebsiteParameters(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteParametersPartial && !$this->isNew();
        if (null === $this->collWebsiteParameters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteParameters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteParameters());
            }

            $query = ChildWebsiteParameterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteParameters);
    }

    /**
     * Method called to associate a ChildWebsiteParameter object to this object
     * through the ChildWebsiteParameter foreign key attribute.
     *
     * @param  ChildWebsiteParameter $l ChildWebsiteParameter
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteParameter(ChildWebsiteParameter $l)
    {
        if ($this->collWebsiteParameters === null) {
            $this->initWebsiteParameters();
            $this->collWebsiteParametersPartial = true;
        }

        if (!$this->collWebsiteParameters->contains($l)) {
            $this->doAddWebsiteParameter($l);

            if ($this->websiteParametersScheduledForDeletion and $this->websiteParametersScheduledForDeletion->contains($l)) {
                $this->websiteParametersScheduledForDeletion->remove($this->websiteParametersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteParameter $websiteParameter The ChildWebsiteParameter object to add.
     */
    protected function doAddWebsiteParameter(ChildWebsiteParameter $websiteParameter)
    {
        $this->collWebsiteParameters[]= $websiteParameter;
        $websiteParameter->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteParameter $websiteParameter The ChildWebsiteParameter object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteParameter(ChildWebsiteParameter $websiteParameter)
    {
        if ($this->getWebsiteParameters()->contains($websiteParameter)) {
            $pos = $this->collWebsiteParameters->search($websiteParameter);
            $this->collWebsiteParameters->remove($pos);
            if (null === $this->websiteParametersScheduledForDeletion) {
                $this->websiteParametersScheduledForDeletion = clone $this->collWebsiteParameters;
                $this->websiteParametersScheduledForDeletion->clear();
            }
            $this->websiteParametersScheduledForDeletion[]= clone $websiteParameter;
            $websiteParameter->setWebsite(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteRoutings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteRoutings()
     */
    public function clearWebsiteRoutings()
    {
        $this->collWebsiteRoutings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteRoutings collection loaded partially.
     */
    public function resetPartialWebsiteRoutings($v = true)
    {
        $this->collWebsiteRoutingsPartial = $v;
    }

    /**
     * Initializes the collWebsiteRoutings collection.
     *
     * By default this just sets the collWebsiteRoutings collection to an empty array (like clearcollWebsiteRoutings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteRoutings($overrideExisting = true)
    {
        if (null !== $this->collWebsiteRoutings && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteRoutingTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteRoutings = new $collectionClassName;
        $this->collWebsiteRoutings->setModel('\CE\Model\WebsiteRouting');
    }

    /**
     * Gets an array of ChildWebsiteRouting objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteRouting[] List of ChildWebsiteRouting objects
     * @throws PropelException
     */
    public function getWebsiteRoutings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingsPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutings) {
                // return empty collection
                $this->initWebsiteRoutings();
            } else {
                $collWebsiteRoutings = ChildWebsiteRoutingQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteRoutingsPartial && count($collWebsiteRoutings)) {
                        $this->initWebsiteRoutings(false);

                        foreach ($collWebsiteRoutings as $obj) {
                            if (false == $this->collWebsiteRoutings->contains($obj)) {
                                $this->collWebsiteRoutings->append($obj);
                            }
                        }

                        $this->collWebsiteRoutingsPartial = true;
                    }

                    return $collWebsiteRoutings;
                }

                if ($partial && $this->collWebsiteRoutings) {
                    foreach ($this->collWebsiteRoutings as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteRoutings[] = $obj;
                        }
                    }
                }

                $this->collWebsiteRoutings = $collWebsiteRoutings;
                $this->collWebsiteRoutingsPartial = false;
            }
        }

        return $this->collWebsiteRoutings;
    }

    /**
     * Sets a collection of ChildWebsiteRouting objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteRoutings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteRoutings(Collection $websiteRoutings, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteRouting[] $websiteRoutingsToDelete */
        $websiteRoutingsToDelete = $this->getWebsiteRoutings(new Criteria(), $con)->diff($websiteRoutings);


        $this->websiteRoutingsScheduledForDeletion = $websiteRoutingsToDelete;

        foreach ($websiteRoutingsToDelete as $websiteRoutingRemoved) {
            $websiteRoutingRemoved->setWebsite(null);
        }

        $this->collWebsiteRoutings = null;
        foreach ($websiteRoutings as $websiteRouting) {
            $this->addWebsiteRouting($websiteRouting);
        }

        $this->collWebsiteRoutings = $websiteRoutings;
        $this->collWebsiteRoutingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteRouting objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteRouting objects.
     * @throws PropelException
     */
    public function countWebsiteRoutings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingsPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteRoutings());
            }

            $query = ChildWebsiteRoutingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteRoutings);
    }

    /**
     * Method called to associate a ChildWebsiteRouting object to this object
     * through the ChildWebsiteRouting foreign key attribute.
     *
     * @param  ChildWebsiteRouting $l ChildWebsiteRouting
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteRouting(ChildWebsiteRouting $l)
    {
        if ($this->collWebsiteRoutings === null) {
            $this->initWebsiteRoutings();
            $this->collWebsiteRoutingsPartial = true;
        }

        if (!$this->collWebsiteRoutings->contains($l)) {
            $this->doAddWebsiteRouting($l);

            if ($this->websiteRoutingsScheduledForDeletion and $this->websiteRoutingsScheduledForDeletion->contains($l)) {
                $this->websiteRoutingsScheduledForDeletion->remove($this->websiteRoutingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteRouting $websiteRouting The ChildWebsiteRouting object to add.
     */
    protected function doAddWebsiteRouting(ChildWebsiteRouting $websiteRouting)
    {
        $this->collWebsiteRoutings[]= $websiteRouting;
        $websiteRouting->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteRouting $websiteRouting The ChildWebsiteRouting object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteRouting(ChildWebsiteRouting $websiteRouting)
    {
        if ($this->getWebsiteRoutings()->contains($websiteRouting)) {
            $pos = $this->collWebsiteRoutings->search($websiteRouting);
            $this->collWebsiteRoutings->remove($pos);
            if (null === $this->websiteRoutingsScheduledForDeletion) {
                $this->websiteRoutingsScheduledForDeletion = clone $this->collWebsiteRoutings;
                $this->websiteRoutingsScheduledForDeletion->clear();
            }
            $this->websiteRoutingsScheduledForDeletion[]= clone $websiteRouting;
            $websiteRouting->setWebsite(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteModules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteModules()
     */
    public function clearWebsiteModules()
    {
        $this->collWebsiteModules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteModules collection loaded partially.
     */
    public function resetPartialWebsiteModules($v = true)
    {
        $this->collWebsiteModulesPartial = $v;
    }

    /**
     * Initializes the collWebsiteModules collection.
     *
     * By default this just sets the collWebsiteModules collection to an empty array (like clearcollWebsiteModules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteModules($overrideExisting = true)
    {
        if (null !== $this->collWebsiteModules && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteModuleTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteModules = new $collectionClassName;
        $this->collWebsiteModules->setModel('\CE\Model\WebsiteModule');
    }

    /**
     * Gets an array of ChildWebsiteModule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteModule[] List of ChildWebsiteModule objects
     * @throws PropelException
     */
    public function getWebsiteModules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModulesPartial && !$this->isNew();
        if (null === $this->collWebsiteModules || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModules) {
                // return empty collection
                $this->initWebsiteModules();
            } else {
                $collWebsiteModules = ChildWebsiteModuleQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteModulesPartial && count($collWebsiteModules)) {
                        $this->initWebsiteModules(false);

                        foreach ($collWebsiteModules as $obj) {
                            if (false == $this->collWebsiteModules->contains($obj)) {
                                $this->collWebsiteModules->append($obj);
                            }
                        }

                        $this->collWebsiteModulesPartial = true;
                    }

                    return $collWebsiteModules;
                }

                if ($partial && $this->collWebsiteModules) {
                    foreach ($this->collWebsiteModules as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteModules[] = $obj;
                        }
                    }
                }

                $this->collWebsiteModules = $collWebsiteModules;
                $this->collWebsiteModulesPartial = false;
            }
        }

        return $this->collWebsiteModules;
    }

    /**
     * Sets a collection of ChildWebsiteModule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteModules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteModules(Collection $websiteModules, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteModule[] $websiteModulesToDelete */
        $websiteModulesToDelete = $this->getWebsiteModules(new Criteria(), $con)->diff($websiteModules);


        $this->websiteModulesScheduledForDeletion = $websiteModulesToDelete;

        foreach ($websiteModulesToDelete as $websiteModuleRemoved) {
            $websiteModuleRemoved->setWebsite(null);
        }

        $this->collWebsiteModules = null;
        foreach ($websiteModules as $websiteModule) {
            $this->addWebsiteModule($websiteModule);
        }

        $this->collWebsiteModules = $websiteModules;
        $this->collWebsiteModulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteModule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteModule objects.
     * @throws PropelException
     */
    public function countWebsiteModules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModulesPartial && !$this->isNew();
        if (null === $this->collWebsiteModules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteModules());
            }

            $query = ChildWebsiteModuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteModules);
    }

    /**
     * Method called to associate a ChildWebsiteModule object to this object
     * through the ChildWebsiteModule foreign key attribute.
     *
     * @param  ChildWebsiteModule $l ChildWebsiteModule
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteModule(ChildWebsiteModule $l)
    {
        if ($this->collWebsiteModules === null) {
            $this->initWebsiteModules();
            $this->collWebsiteModulesPartial = true;
        }

        if (!$this->collWebsiteModules->contains($l)) {
            $this->doAddWebsiteModule($l);

            if ($this->websiteModulesScheduledForDeletion and $this->websiteModulesScheduledForDeletion->contains($l)) {
                $this->websiteModulesScheduledForDeletion->remove($this->websiteModulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteModule $websiteModule The ChildWebsiteModule object to add.
     */
    protected function doAddWebsiteModule(ChildWebsiteModule $websiteModule)
    {
        $this->collWebsiteModules[]= $websiteModule;
        $websiteModule->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteModule $websiteModule The ChildWebsiteModule object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteModule(ChildWebsiteModule $websiteModule)
    {
        if ($this->getWebsiteModules()->contains($websiteModule)) {
            $pos = $this->collWebsiteModules->search($websiteModule);
            $this->collWebsiteModules->remove($pos);
            if (null === $this->websiteModulesScheduledForDeletion) {
                $this->websiteModulesScheduledForDeletion = clone $this->collWebsiteModules;
                $this->websiteModulesScheduledForDeletion->clear();
            }
            $this->websiteModulesScheduledForDeletion[]= $websiteModule;
            $websiteModule->setWebsite(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteZones collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteZones()
     */
    public function clearWebsiteZones()
    {
        $this->collWebsiteZones = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteZones collection loaded partially.
     */
    public function resetPartialWebsiteZones($v = true)
    {
        $this->collWebsiteZonesPartial = $v;
    }

    /**
     * Initializes the collWebsiteZones collection.
     *
     * By default this just sets the collWebsiteZones collection to an empty array (like clearcollWebsiteZones());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteZones($overrideExisting = true)
    {
        if (null !== $this->collWebsiteZones && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteZoneTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteZones = new $collectionClassName;
        $this->collWebsiteZones->setModel('\CE\Model\WebsiteZone');
    }

    /**
     * Gets an array of ChildWebsiteZone objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsite is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteZone[] List of ChildWebsiteZone objects
     * @throws PropelException
     */
    public function getWebsiteZones(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteZonesPartial && !$this->isNew();
        if (null === $this->collWebsiteZones || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteZones) {
                // return empty collection
                $this->initWebsiteZones();
            } else {
                $collWebsiteZones = ChildWebsiteZoneQuery::create(null, $criteria)
                    ->filterByWebsite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteZonesPartial && count($collWebsiteZones)) {
                        $this->initWebsiteZones(false);

                        foreach ($collWebsiteZones as $obj) {
                            if (false == $this->collWebsiteZones->contains($obj)) {
                                $this->collWebsiteZones->append($obj);
                            }
                        }

                        $this->collWebsiteZonesPartial = true;
                    }

                    return $collWebsiteZones;
                }

                if ($partial && $this->collWebsiteZones) {
                    foreach ($this->collWebsiteZones as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteZones[] = $obj;
                        }
                    }
                }

                $this->collWebsiteZones = $collWebsiteZones;
                $this->collWebsiteZonesPartial = false;
            }
        }

        return $this->collWebsiteZones;
    }

    /**
     * Sets a collection of ChildWebsiteZone objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteZones A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function setWebsiteZones(Collection $websiteZones, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteZone[] $websiteZonesToDelete */
        $websiteZonesToDelete = $this->getWebsiteZones(new Criteria(), $con)->diff($websiteZones);


        $this->websiteZonesScheduledForDeletion = $websiteZonesToDelete;

        foreach ($websiteZonesToDelete as $websiteZoneRemoved) {
            $websiteZoneRemoved->setWebsite(null);
        }

        $this->collWebsiteZones = null;
        foreach ($websiteZones as $websiteZone) {
            $this->addWebsiteZone($websiteZone);
        }

        $this->collWebsiteZones = $websiteZones;
        $this->collWebsiteZonesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteZone objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteZone objects.
     * @throws PropelException
     */
    public function countWebsiteZones(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteZonesPartial && !$this->isNew();
        if (null === $this->collWebsiteZones || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteZones) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteZones());
            }

            $query = ChildWebsiteZoneQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsite($this)
                ->count($con);
        }

        return count($this->collWebsiteZones);
    }

    /**
     * Method called to associate a ChildWebsiteZone object to this object
     * through the ChildWebsiteZone foreign key attribute.
     *
     * @param  ChildWebsiteZone $l ChildWebsiteZone
     * @return $this|\CE\Model\Website The current object (for fluent API support)
     */
    public function addWebsiteZone(ChildWebsiteZone $l)
    {
        if ($this->collWebsiteZones === null) {
            $this->initWebsiteZones();
            $this->collWebsiteZonesPartial = true;
        }

        if (!$this->collWebsiteZones->contains($l)) {
            $this->doAddWebsiteZone($l);

            if ($this->websiteZonesScheduledForDeletion and $this->websiteZonesScheduledForDeletion->contains($l)) {
                $this->websiteZonesScheduledForDeletion->remove($this->websiteZonesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteZone $websiteZone The ChildWebsiteZone object to add.
     */
    protected function doAddWebsiteZone(ChildWebsiteZone $websiteZone)
    {
        $this->collWebsiteZones[]= $websiteZone;
        $websiteZone->setWebsite($this);
    }

    /**
     * @param  ChildWebsiteZone $websiteZone The ChildWebsiteZone object to remove.
     * @return $this|ChildWebsite The current object (for fluent API support)
     */
    public function removeWebsiteZone(ChildWebsiteZone $websiteZone)
    {
        if ($this->getWebsiteZones()->contains($websiteZone)) {
            $pos = $this->collWebsiteZones->search($websiteZone);
            $this->collWebsiteZones->remove($pos);
            if (null === $this->websiteZonesScheduledForDeletion) {
                $this->websiteZonesScheduledForDeletion = clone $this->collWebsiteZones;
                $this->websiteZonesScheduledForDeletion->clear();
            }
            $this->websiteZonesScheduledForDeletion[]= clone $websiteZone;
            $websiteZone->setWebsite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Website is new, it will return
     * an empty collection; or if this Website has previously
     * been saved, it will retrieve related WebsiteZones from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Website.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteZone[] List of ChildWebsiteZone objects
     */
    public function getWebsiteZonesJoinWebsiteRouting(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteZoneQuery::create(null, $criteria);
        $query->joinWith('WebsiteRouting', $joinBehavior);

        return $this->getWebsiteZones($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aAccount) {
            $this->aAccount->removeWebsite($this);
        }
        if (null !== $this->aStep) {
            $this->aStep->removeWebsite($this);
        }
        $this->id = null;
        $this->account_id = null;
        $this->name = null;
        $this->step_id = null;
        $this->template = null;
        $this->logo = null;
        $this->favicon = null;
        $this->javascript = null;
        $this->stylesheet = null;
        $this->max_upload = null;
        $this->currency = null;
        $this->meta_auto = null;
        $this->ssl = null;
        $this->duplicable = null;
        $this->wrapper = null;
        $this->wrapper_params = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collMetas) {
                foreach ($this->collMetas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collModuleAuthorizations) {
                foreach ($this->collModuleAuthorizations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserWebsites) {
                foreach ($this->collUserWebsites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteRedirections) {
                foreach ($this->collWebsiteRedirections as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteCultures) {
                foreach ($this->collWebsiteCultures as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteDomains) {
                foreach ($this->collWebsiteDomains as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteParameters) {
                foreach ($this->collWebsiteParameters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteRoutings) {
                foreach ($this->collWebsiteRoutings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteModules) {
                foreach ($this->collWebsiteModules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteZones) {
                foreach ($this->collWebsiteZones as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMetas = null;
        $this->collModuleAuthorizations = null;
        $this->collUserWebsites = null;
        $this->collWebsiteRedirections = null;
        $this->collWebsiteCultures = null;
        $this->collWebsiteDomains = null;
        $this->collWebsiteParameters = null;
        $this->collWebsiteRoutings = null;
        $this->collWebsiteModules = null;
        $this->collWebsiteZones = null;
        $this->aAccount = null;
        $this->aStep = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WebsiteTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
