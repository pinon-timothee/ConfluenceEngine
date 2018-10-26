<?php

namespace CE\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use CE\Model\Meta as ChildMeta;
use CE\Model\MetaQuery as ChildMetaQuery;
use CE\Model\Website as ChildWebsite;
use CE\Model\WebsiteModule as ChildWebsiteModule;
use CE\Model\WebsiteModuleLocation as ChildWebsiteModuleLocation;
use CE\Model\WebsiteModuleLocationQuery as ChildWebsiteModuleLocationQuery;
use CE\Model\WebsiteModuleQuery as ChildWebsiteModuleQuery;
use CE\Model\WebsiteQuery as ChildWebsiteQuery;
use CE\Model\WebsiteRedirection as ChildWebsiteRedirection;
use CE\Model\WebsiteRedirectionQuery as ChildWebsiteRedirectionQuery;
use CE\Model\WebsiteRouting as ChildWebsiteRouting;
use CE\Model\WebsiteRoutingI18n as ChildWebsiteRoutingI18n;
use CE\Model\WebsiteRoutingI18nQuery as ChildWebsiteRoutingI18nQuery;
use CE\Model\WebsiteRoutingParameter as ChildWebsiteRoutingParameter;
use CE\Model\WebsiteRoutingParameterQuery as ChildWebsiteRoutingParameterQuery;
use CE\Model\WebsiteRoutingPath as ChildWebsiteRoutingPath;
use CE\Model\WebsiteRoutingPathQuery as ChildWebsiteRoutingPathQuery;
use CE\Model\WebsiteRoutingQuery as ChildWebsiteRoutingQuery;
use CE\Model\WebsiteZone as ChildWebsiteZone;
use CE\Model\WebsiteZoneQuery as ChildWebsiteZoneQuery;
use CE\Model\Map\MetaTableMap;
use CE\Model\Map\WebsiteModuleLocationTableMap;
use CE\Model\Map\WebsiteRedirectionTableMap;
use CE\Model\Map\WebsiteRoutingI18nTableMap;
use CE\Model\Map\WebsiteRoutingParameterTableMap;
use CE\Model\Map\WebsiteRoutingPathTableMap;
use CE\Model\Map\WebsiteRoutingTableMap;
use CE\Model\Map\WebsiteZoneTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Collection\ObjectCombinationCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'website_routing' table.
 *
 *
 *
 * @package    propel.generator.src.CE.Model.Base
 */
abstract class WebsiteRouting implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CE\\Model\\Map\\WebsiteRoutingTableMap';


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
     * The value for the website_id field.
     *
     * @var        int
     */
    protected $website_id;

    /**
     * The value for the comment field.
     *
     * @var        string
     */
    protected $comment;

    /**
     * The value for the tags field.
     *
     * @var        string
     */
    protected $tags;

    /**
     * The value for the enable field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $enable;

    /**
     * The value for the page field.
     *
     * @var        string
     */
    protected $page;

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
     * The value for the controller field.
     *
     * @var        string
     */
    protected $controller;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * @var        ChildWebsite
     */
    protected $aWebsite;

    /**
     * @var        ObjectCollection|ChildMeta[] Collection to store aggregation of ChildMeta objects.
     */
    protected $collMetas;
    protected $collMetasPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteRedirection[] Collection to store aggregation of ChildWebsiteRedirection objects.
     */
    protected $collWebsiteRedirections;
    protected $collWebsiteRedirectionsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteRoutingI18n[] Collection to store aggregation of ChildWebsiteRoutingI18n objects.
     */
    protected $collWebsiteRoutingI18ns;
    protected $collWebsiteRoutingI18nsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteRoutingPath[] Collection to store aggregation of ChildWebsiteRoutingPath objects.
     */
    protected $collWebsiteRoutingPaths;
    protected $collWebsiteRoutingPathsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteRoutingParameter[] Collection to store aggregation of ChildWebsiteRoutingParameter objects.
     */
    protected $collWebsiteRoutingParameters;
    protected $collWebsiteRoutingParametersPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteModuleLocation[] Collection to store aggregation of ChildWebsiteModuleLocation objects.
     */
    protected $collWebsiteModuleLocations;
    protected $collWebsiteModuleLocationsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteZone[] Collection to store aggregation of ChildWebsiteZone objects.
     */
    protected $collWebsiteZones;
    protected $collWebsiteZonesPartial;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildWebsiteModule combinations.
     */
    protected $combinationCollWebsiteModuleIds;

    /**
     * @var bool
     */
    protected $combinationCollWebsiteModuleIdsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteModule[] Cross Collection to store aggregation of ChildWebsiteModule objects.
     */
    protected $collWebsiteModules;

    /**
     * @var bool
     */
    protected $collWebsiteModulesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildWebsiteRoutingI18n]
     */
    protected $currentTranslations;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildWebsiteModule combinations.
     */
    protected $combinationCollWebsiteModuleIdsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMeta[]
     */
    protected $metasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteRedirection[]
     */
    protected $websiteRedirectionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteRoutingI18n[]
     */
    protected $websiteRoutingI18nsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteRoutingPath[]
     */
    protected $websiteRoutingPathsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteRoutingParameter[]
     */
    protected $websiteRoutingParametersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteModuleLocation[]
     */
    protected $websiteModuleLocationsScheduledForDeletion = null;

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
        $this->enable = true;
    }

    /**
     * Initializes internal state of CE\Model\Base\WebsiteRouting object.
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
     * Compares this with another <code>WebsiteRouting</code> instance.  If
     * <code>obj</code> is an instance of <code>WebsiteRouting</code>, delegates to
     * <code>equals(WebsiteRouting)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|WebsiteRouting The current object, for fluid interface
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
     * Get the [website_id] column value.
     *
     * @return int
     */
    public function getWebsiteId()
    {
        return $this->website_id;
    }

    /**
     * Get the [comment] column value.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the [tags] column value.
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get the [enable] column value.
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Get the [enable] column value.
     *
     * @return boolean
     */
    public function isEnable()
    {
        return $this->getEnable();
    }

    /**
     * Get the [page] column value.
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
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
     * Get the [controller] column value.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [website_id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->website_id !== $v) {
            $this->website_id = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_WEBSITE_ID] = true;
        }

        if ($this->aWebsite !== null && $this->aWebsite->getId() !== $v) {
            $this->aWebsite = null;
        }

        return $this;
    } // setWebsiteId()

    /**
     * Set the value of [comment] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_COMMENT] = true;
        }

        return $this;
    } // setComment()

    /**
     * Set the value of [tags] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_TAGS] = true;
        }

        return $this;
    } // setTags()

    /**
     * Sets the value of the [enable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setEnable($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->enable !== $v) {
            $this->enable = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_ENABLE] = true;
        }

        return $this;
    } // setEnable()

    /**
     * Set the value of [page] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setPage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->page !== $v) {
            $this->page = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_PAGE] = true;
        }

        return $this;
    } // setPage()

    /**
     * Set the value of [javascript] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setJavascript($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->javascript !== $v) {
            $this->javascript = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_JAVASCRIPT] = true;
        }

        return $this;
    } // setJavascript()

    /**
     * Set the value of [stylesheet] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setStylesheet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stylesheet !== $v) {
            $this->stylesheet = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_STYLESHEET] = true;
        }

        return $this;
    } // setStylesheet()

    /**
     * Set the value of [controller] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setController($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->controller !== $v) {
            $this->controller = $v;
            $this->modifiedColumns[WebsiteRoutingTableMap::COL_CONTROLLER] = true;
        }

        return $this;
    } // setController()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WebsiteRoutingTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WebsiteRoutingTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

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
            if ($this->enable !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WebsiteRoutingTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WebsiteRoutingTableMap::translateFieldName('WebsiteId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->website_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WebsiteRoutingTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WebsiteRoutingTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WebsiteRoutingTableMap::translateFieldName('Enable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WebsiteRoutingTableMap::translateFieldName('Page', TableMap::TYPE_PHPNAME, $indexType)];
            $this->page = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WebsiteRoutingTableMap::translateFieldName('Javascript', TableMap::TYPE_PHPNAME, $indexType)];
            $this->javascript = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WebsiteRoutingTableMap::translateFieldName('Stylesheet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stylesheet = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WebsiteRoutingTableMap::translateFieldName('Controller', TableMap::TYPE_PHPNAME, $indexType)];
            $this->controller = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WebsiteRoutingTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WebsiteRoutingTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = WebsiteRoutingTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CE\\Model\\WebsiteRouting'), 0, $e);
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
        if ($this->aWebsite !== null && $this->website_id !== $this->aWebsite->getId()) {
            $this->aWebsite = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWebsiteRoutingQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aWebsite = null;
            $this->collMetas = null;

            $this->collWebsiteRedirections = null;

            $this->collWebsiteRoutingI18ns = null;

            $this->collWebsiteRoutingPaths = null;

            $this->collWebsiteRoutingParameters = null;

            $this->collWebsiteModuleLocations = null;

            $this->collWebsiteZones = null;

            $this->collWebsiteModuleIds = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see WebsiteRouting::setDeleted()
     * @see WebsiteRouting::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWebsiteRoutingQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteRoutingTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(WebsiteRoutingTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(WebsiteRoutingTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(WebsiteRoutingTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                WebsiteRoutingTableMap::addInstanceToPool($this);
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

            if ($this->aWebsite !== null) {
                if ($this->aWebsite->isModified() || $this->aWebsite->isNew()) {
                    $affectedRows += $this->aWebsite->save($con);
                }
                $this->setWebsite($this->aWebsite);
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

            if ($this->combinationCollWebsiteModuleIdsScheduledForDeletion !== null) {
                if (!$this->combinationCollWebsiteModuleIdsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->combinationCollWebsiteModuleIdsScheduledForDeletion as $combination) {
                        $entryPk = [];

                        $entryPk[] = $this->getId();
                        $entryPk[1] = $combination[0]->getId();
                        //$combination[1] = Id;
                        $entryPk[0] = $combination[1];

                        $pks[] = $entryPk;
                    }

                    \CE\Model\WebsiteModuleLocationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->combinationCollWebsiteModuleIdsScheduledForDeletion = null;
                }

            }

            if (null !== $this->combinationCollWebsiteModuleIds) {
                foreach ($this->combinationCollWebsiteModuleIds as $combination) {

                    //$combination[0] = WebsiteModule (website_module_location_fk_2316eb)
                    if (!$combination[0]->isDeleted() && ($combination[0]->isNew() || $combination[0]->isModified())) {
                        $combination[0]->save($con);
                    }

                    //$combination[1] = Id; Nothing to save.
                }
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

            if ($this->websiteRoutingI18nsScheduledForDeletion !== null) {
                if (!$this->websiteRoutingI18nsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteRoutingI18nQuery::create()
                        ->filterByPrimaryKeys($this->websiteRoutingI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteRoutingI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteRoutingI18ns !== null) {
                foreach ($this->collWebsiteRoutingI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteRoutingPathsScheduledForDeletion !== null) {
                if (!$this->websiteRoutingPathsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteRoutingPathQuery::create()
                        ->filterByPrimaryKeys($this->websiteRoutingPathsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteRoutingPathsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteRoutingPaths !== null) {
                foreach ($this->collWebsiteRoutingPaths as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteRoutingParametersScheduledForDeletion !== null) {
                if (!$this->websiteRoutingParametersScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteRoutingParameterQuery::create()
                        ->filterByPrimaryKeys($this->websiteRoutingParametersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteRoutingParametersScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteRoutingParameters !== null) {
                foreach ($this->collWebsiteRoutingParameters as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websiteModuleLocationsScheduledForDeletion !== null) {
                if (!$this->websiteModuleLocationsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteModuleLocationQuery::create()
                        ->filterByPrimaryKeys($this->websiteModuleLocationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteModuleLocationsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteModuleLocations !== null) {
                foreach ($this->collWebsiteModuleLocations as $referrerFK) {
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

        $this->modifiedColumns[WebsiteRoutingTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WebsiteRoutingTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_WEBSITE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`website_id`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = '`comment`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_TAGS)) {
            $modifiedColumns[':p' . $index++]  = '`tags`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_ENABLE)) {
            $modifiedColumns[':p' . $index++]  = '`enable`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_PAGE)) {
            $modifiedColumns[':p' . $index++]  = '`page`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_JAVASCRIPT)) {
            $modifiedColumns[':p' . $index++]  = '`javascript`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_STYLESHEET)) {
            $modifiedColumns[':p' . $index++]  = '`stylesheet`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_CONTROLLER)) {
            $modifiedColumns[':p' . $index++]  = '`controller`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `website_routing` (%s) VALUES (%s)',
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
                    case '`website_id`':
                        $stmt->bindValue($identifier, $this->website_id, PDO::PARAM_INT);
                        break;
                    case '`comment`':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);
                        break;
                    case '`tags`':
                        $stmt->bindValue($identifier, $this->tags, PDO::PARAM_STR);
                        break;
                    case '`enable`':
                        $stmt->bindValue($identifier, (int) $this->enable, PDO::PARAM_INT);
                        break;
                    case '`page`':
                        $stmt->bindValue($identifier, $this->page, PDO::PARAM_STR);
                        break;
                    case '`javascript`':
                        $stmt->bindValue($identifier, $this->javascript, PDO::PARAM_STR);
                        break;
                    case '`stylesheet`':
                        $stmt->bindValue($identifier, $this->stylesheet, PDO::PARAM_STR);
                        break;
                    case '`controller`':
                        $stmt->bindValue($identifier, $this->controller, PDO::PARAM_STR);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $pos = WebsiteRoutingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getWebsiteId();
                break;
            case 2:
                return $this->getComment();
                break;
            case 3:
                return $this->getTags();
                break;
            case 4:
                return $this->getEnable();
                break;
            case 5:
                return $this->getPage();
                break;
            case 6:
                return $this->getJavascript();
                break;
            case 7:
                return $this->getStylesheet();
                break;
            case 8:
                return $this->getController();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
                return $this->getUpdatedAt();
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

        if (isset($alreadyDumpedObjects['WebsiteRouting'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['WebsiteRouting'][$this->hashCode()] = true;
        $keys = WebsiteRoutingTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getWebsiteId(),
            $keys[2] => $this->getComment(),
            $keys[3] => $this->getTags(),
            $keys[4] => $this->getEnable(),
            $keys[5] => $this->getPage(),
            $keys[6] => $this->getJavascript(),
            $keys[7] => $this->getStylesheet(),
            $keys[8] => $this->getController(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aWebsite) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'website';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website';
                        break;
                    default:
                        $key = 'Website';
                }

                $result[$key] = $this->aWebsite->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collWebsiteRoutingI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteRoutingI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_routing_i18ns';
                        break;
                    default:
                        $key = 'WebsiteRoutingI18ns';
                }

                $result[$key] = $this->collWebsiteRoutingI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteRoutingPaths) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteRoutingPaths';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_routing_paths';
                        break;
                    default:
                        $key = 'WebsiteRoutingPaths';
                }

                $result[$key] = $this->collWebsiteRoutingPaths->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteRoutingParameters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteRoutingParameters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_routing_parameters';
                        break;
                    default:
                        $key = 'WebsiteRoutingParameters';
                }

                $result[$key] = $this->collWebsiteRoutingParameters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsiteModuleLocations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteModuleLocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_module_locations';
                        break;
                    default:
                        $key = 'WebsiteModuleLocations';
                }

                $result[$key] = $this->collWebsiteModuleLocations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\CE\Model\WebsiteRouting
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WebsiteRoutingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CE\Model\WebsiteRouting
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setWebsiteId($value);
                break;
            case 2:
                $this->setComment($value);
                break;
            case 3:
                $this->setTags($value);
                break;
            case 4:
                $this->setEnable($value);
                break;
            case 5:
                $this->setPage($value);
                break;
            case 6:
                $this->setJavascript($value);
                break;
            case 7:
                $this->setStylesheet($value);
                break;
            case 8:
                $this->setController($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
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
        $keys = WebsiteRoutingTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWebsiteId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setComment($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTags($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEnable($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPage($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setJavascript($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStylesheet($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setController($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
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
     * @return $this|\CE\Model\WebsiteRouting The current object, for fluid interface
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
        $criteria = new Criteria(WebsiteRoutingTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_ID)) {
            $criteria->add(WebsiteRoutingTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_WEBSITE_ID)) {
            $criteria->add(WebsiteRoutingTableMap::COL_WEBSITE_ID, $this->website_id);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_COMMENT)) {
            $criteria->add(WebsiteRoutingTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_TAGS)) {
            $criteria->add(WebsiteRoutingTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_ENABLE)) {
            $criteria->add(WebsiteRoutingTableMap::COL_ENABLE, $this->enable);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_PAGE)) {
            $criteria->add(WebsiteRoutingTableMap::COL_PAGE, $this->page);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_JAVASCRIPT)) {
            $criteria->add(WebsiteRoutingTableMap::COL_JAVASCRIPT, $this->javascript);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_STYLESHEET)) {
            $criteria->add(WebsiteRoutingTableMap::COL_STYLESHEET, $this->stylesheet);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_CONTROLLER)) {
            $criteria->add(WebsiteRoutingTableMap::COL_CONTROLLER, $this->controller);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_CREATED_AT)) {
            $criteria->add(WebsiteRoutingTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(WebsiteRoutingTableMap::COL_UPDATED_AT)) {
            $criteria->add(WebsiteRoutingTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildWebsiteRoutingQuery::create();
        $criteria->add(WebsiteRoutingTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \CE\Model\WebsiteRouting (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setWebsiteId($this->getWebsiteId());
        $copyObj->setComment($this->getComment());
        $copyObj->setTags($this->getTags());
        $copyObj->setEnable($this->getEnable());
        $copyObj->setPage($this->getPage());
        $copyObj->setJavascript($this->getJavascript());
        $copyObj->setStylesheet($this->getStylesheet());
        $copyObj->setController($this->getController());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMetas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMeta($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteRedirections() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteRedirection($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteRoutingI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteRoutingI18n($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteRoutingPaths() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteRoutingPath($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteRoutingParameters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteRoutingParameter($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteModuleLocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteModuleLocation($relObj->copy($deepCopy));
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
     * @return \CE\Model\WebsiteRouting Clone of current object.
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
     * Declares an association between this object and a ChildWebsite object.
     *
     * @param  ChildWebsite $v
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     * @throws PropelException
     */
    public function setWebsite(ChildWebsite $v = null)
    {
        if ($v === null) {
            $this->setWebsiteId(NULL);
        } else {
            $this->setWebsiteId($v->getId());
        }

        $this->aWebsite = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWebsite object, it will not be re-added.
        if ($v !== null) {
            $v->addWebsiteRouting($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWebsite object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildWebsite The associated ChildWebsite object.
     * @throws PropelException
     */
    public function getWebsite(ConnectionInterface $con = null)
    {
        if ($this->aWebsite === null && ($this->website_id != 0)) {
            $this->aWebsite = ChildWebsiteQuery::create()->findPk($this->website_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWebsite->addWebsiteRoutings($this);
             */
        }

        return $this->aWebsite;
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
        if ('WebsiteRedirection' == $relationName) {
            $this->initWebsiteRedirections();
            return;
        }
        if ('WebsiteRoutingI18n' == $relationName) {
            $this->initWebsiteRoutingI18ns();
            return;
        }
        if ('WebsiteRoutingPath' == $relationName) {
            $this->initWebsiteRoutingPaths();
            return;
        }
        if ('WebsiteRoutingParameter' == $relationName) {
            $this->initWebsiteRoutingParameters();
            return;
        }
        if ('WebsiteModuleLocation' == $relationName) {
            $this->initWebsiteModuleLocations();
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
     * If this ChildWebsiteRouting is new, it will return
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
                    ->filterByWebsiteRouting($this)
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
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setMetas(Collection $metas, ConnectionInterface $con = null)
    {
        /** @var ChildMeta[] $metasToDelete */
        $metasToDelete = $this->getMetas(new Criteria(), $con)->diff($metas);


        $this->metasScheduledForDeletion = $metasToDelete;

        foreach ($metasToDelete as $metaRemoved) {
            $metaRemoved->setWebsiteRouting(null);
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
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collMetas);
    }

    /**
     * Method called to associate a ChildMeta object to this object
     * through the ChildMeta foreign key attribute.
     *
     * @param  ChildMeta $l ChildMeta
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
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
        $meta->setWebsiteRouting($this);
    }

    /**
     * @param  ChildMeta $meta The ChildMeta object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
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
            $meta->setWebsiteRouting(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WebsiteRouting is new, it will return
     * an empty collection; or if this WebsiteRouting has previously
     * been saved, it will retrieve related Metas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WebsiteRouting.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMeta[] List of ChildMeta objects
     */
    public function getMetasJoinWebsite(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMetaQuery::create(null, $criteria);
        $query->joinWith('Website', $joinBehavior);

        return $this->getMetas($query, $con);
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
     * If this ChildWebsiteRouting is new, it will return
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
                    ->filterByWebsiteRouting($this)
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
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteRedirections(Collection $websiteRedirections, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteRedirection[] $websiteRedirectionsToDelete */
        $websiteRedirectionsToDelete = $this->getWebsiteRedirections(new Criteria(), $con)->diff($websiteRedirections);


        $this->websiteRedirectionsScheduledForDeletion = $websiteRedirectionsToDelete;

        foreach ($websiteRedirectionsToDelete as $websiteRedirectionRemoved) {
            $websiteRedirectionRemoved->setWebsiteRouting(null);
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
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collWebsiteRedirections);
    }

    /**
     * Method called to associate a ChildWebsiteRedirection object to this object
     * through the ChildWebsiteRedirection foreign key attribute.
     *
     * @param  ChildWebsiteRedirection $l ChildWebsiteRedirection
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
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
        $websiteRedirection->setWebsiteRouting($this);
    }

    /**
     * @param  ChildWebsiteRedirection $websiteRedirection The ChildWebsiteRedirection object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
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
            $websiteRedirection->setWebsiteRouting(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WebsiteRouting is new, it will return
     * an empty collection; or if this WebsiteRouting has previously
     * been saved, it will retrieve related WebsiteRedirections from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WebsiteRouting.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteRedirection[] List of ChildWebsiteRedirection objects
     */
    public function getWebsiteRedirectionsJoinWebsite(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteRedirectionQuery::create(null, $criteria);
        $query->joinWith('Website', $joinBehavior);

        return $this->getWebsiteRedirections($query, $con);
    }

    /**
     * Clears out the collWebsiteRoutingI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteRoutingI18ns()
     */
    public function clearWebsiteRoutingI18ns()
    {
        $this->collWebsiteRoutingI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteRoutingI18ns collection loaded partially.
     */
    public function resetPartialWebsiteRoutingI18ns($v = true)
    {
        $this->collWebsiteRoutingI18nsPartial = $v;
    }

    /**
     * Initializes the collWebsiteRoutingI18ns collection.
     *
     * By default this just sets the collWebsiteRoutingI18ns collection to an empty array (like clearcollWebsiteRoutingI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteRoutingI18ns($overrideExisting = true)
    {
        if (null !== $this->collWebsiteRoutingI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteRoutingI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteRoutingI18ns = new $collectionClassName;
        $this->collWebsiteRoutingI18ns->setModel('\CE\Model\WebsiteRoutingI18n');
    }

    /**
     * Gets an array of ChildWebsiteRoutingI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteRouting is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteRoutingI18n[] List of ChildWebsiteRoutingI18n objects
     * @throws PropelException
     */
    public function getWebsiteRoutingI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingI18nsPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutingI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutingI18ns) {
                // return empty collection
                $this->initWebsiteRoutingI18ns();
            } else {
                $collWebsiteRoutingI18ns = ChildWebsiteRoutingI18nQuery::create(null, $criteria)
                    ->filterByWebsiteRouting($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteRoutingI18nsPartial && count($collWebsiteRoutingI18ns)) {
                        $this->initWebsiteRoutingI18ns(false);

                        foreach ($collWebsiteRoutingI18ns as $obj) {
                            if (false == $this->collWebsiteRoutingI18ns->contains($obj)) {
                                $this->collWebsiteRoutingI18ns->append($obj);
                            }
                        }

                        $this->collWebsiteRoutingI18nsPartial = true;
                    }

                    return $collWebsiteRoutingI18ns;
                }

                if ($partial && $this->collWebsiteRoutingI18ns) {
                    foreach ($this->collWebsiteRoutingI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteRoutingI18ns[] = $obj;
                        }
                    }
                }

                $this->collWebsiteRoutingI18ns = $collWebsiteRoutingI18ns;
                $this->collWebsiteRoutingI18nsPartial = false;
            }
        }

        return $this->collWebsiteRoutingI18ns;
    }

    /**
     * Sets a collection of ChildWebsiteRoutingI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteRoutingI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteRoutingI18ns(Collection $websiteRoutingI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteRoutingI18n[] $websiteRoutingI18nsToDelete */
        $websiteRoutingI18nsToDelete = $this->getWebsiteRoutingI18ns(new Criteria(), $con)->diff($websiteRoutingI18ns);


        $this->websiteRoutingI18nsScheduledForDeletion = $websiteRoutingI18nsToDelete;

        foreach ($websiteRoutingI18nsToDelete as $websiteRoutingI18nRemoved) {
            $websiteRoutingI18nRemoved->setWebsiteRouting(null);
        }

        $this->collWebsiteRoutingI18ns = null;
        foreach ($websiteRoutingI18ns as $websiteRoutingI18n) {
            $this->addWebsiteRoutingI18n($websiteRoutingI18n);
        }

        $this->collWebsiteRoutingI18ns = $websiteRoutingI18ns;
        $this->collWebsiteRoutingI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteRoutingI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteRoutingI18n objects.
     * @throws PropelException
     */
    public function countWebsiteRoutingI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingI18nsPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutingI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutingI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteRoutingI18ns());
            }

            $query = ChildWebsiteRoutingI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collWebsiteRoutingI18ns);
    }

    /**
     * Method called to associate a ChildWebsiteRoutingI18n object to this object
     * through the ChildWebsiteRoutingI18n foreign key attribute.
     *
     * @param  ChildWebsiteRoutingI18n $l ChildWebsiteRoutingI18n
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function addWebsiteRoutingI18n(ChildWebsiteRoutingI18n $l)
    {
        if ($l && $locale = $l->getCulture()) {
            $this->setCulture($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collWebsiteRoutingI18ns === null) {
            $this->initWebsiteRoutingI18ns();
            $this->collWebsiteRoutingI18nsPartial = true;
        }

        if (!$this->collWebsiteRoutingI18ns->contains($l)) {
            $this->doAddWebsiteRoutingI18n($l);

            if ($this->websiteRoutingI18nsScheduledForDeletion and $this->websiteRoutingI18nsScheduledForDeletion->contains($l)) {
                $this->websiteRoutingI18nsScheduledForDeletion->remove($this->websiteRoutingI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteRoutingI18n $websiteRoutingI18n The ChildWebsiteRoutingI18n object to add.
     */
    protected function doAddWebsiteRoutingI18n(ChildWebsiteRoutingI18n $websiteRoutingI18n)
    {
        $this->collWebsiteRoutingI18ns[]= $websiteRoutingI18n;
        $websiteRoutingI18n->setWebsiteRouting($this);
    }

    /**
     * @param  ChildWebsiteRoutingI18n $websiteRoutingI18n The ChildWebsiteRoutingI18n object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function removeWebsiteRoutingI18n(ChildWebsiteRoutingI18n $websiteRoutingI18n)
    {
        if ($this->getWebsiteRoutingI18ns()->contains($websiteRoutingI18n)) {
            $pos = $this->collWebsiteRoutingI18ns->search($websiteRoutingI18n);
            $this->collWebsiteRoutingI18ns->remove($pos);
            if (null === $this->websiteRoutingI18nsScheduledForDeletion) {
                $this->websiteRoutingI18nsScheduledForDeletion = clone $this->collWebsiteRoutingI18ns;
                $this->websiteRoutingI18nsScheduledForDeletion->clear();
            }
            $this->websiteRoutingI18nsScheduledForDeletion[]= clone $websiteRoutingI18n;
            $websiteRoutingI18n->setWebsiteRouting(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteRoutingPaths collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteRoutingPaths()
     */
    public function clearWebsiteRoutingPaths()
    {
        $this->collWebsiteRoutingPaths = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteRoutingPaths collection loaded partially.
     */
    public function resetPartialWebsiteRoutingPaths($v = true)
    {
        $this->collWebsiteRoutingPathsPartial = $v;
    }

    /**
     * Initializes the collWebsiteRoutingPaths collection.
     *
     * By default this just sets the collWebsiteRoutingPaths collection to an empty array (like clearcollWebsiteRoutingPaths());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteRoutingPaths($overrideExisting = true)
    {
        if (null !== $this->collWebsiteRoutingPaths && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteRoutingPathTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteRoutingPaths = new $collectionClassName;
        $this->collWebsiteRoutingPaths->setModel('\CE\Model\WebsiteRoutingPath');
    }

    /**
     * Gets an array of ChildWebsiteRoutingPath objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteRouting is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteRoutingPath[] List of ChildWebsiteRoutingPath objects
     * @throws PropelException
     */
    public function getWebsiteRoutingPaths(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingPathsPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutingPaths || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutingPaths) {
                // return empty collection
                $this->initWebsiteRoutingPaths();
            } else {
                $collWebsiteRoutingPaths = ChildWebsiteRoutingPathQuery::create(null, $criteria)
                    ->filterByWebsiteRouting($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteRoutingPathsPartial && count($collWebsiteRoutingPaths)) {
                        $this->initWebsiteRoutingPaths(false);

                        foreach ($collWebsiteRoutingPaths as $obj) {
                            if (false == $this->collWebsiteRoutingPaths->contains($obj)) {
                                $this->collWebsiteRoutingPaths->append($obj);
                            }
                        }

                        $this->collWebsiteRoutingPathsPartial = true;
                    }

                    return $collWebsiteRoutingPaths;
                }

                if ($partial && $this->collWebsiteRoutingPaths) {
                    foreach ($this->collWebsiteRoutingPaths as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteRoutingPaths[] = $obj;
                        }
                    }
                }

                $this->collWebsiteRoutingPaths = $collWebsiteRoutingPaths;
                $this->collWebsiteRoutingPathsPartial = false;
            }
        }

        return $this->collWebsiteRoutingPaths;
    }

    /**
     * Sets a collection of ChildWebsiteRoutingPath objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteRoutingPaths A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteRoutingPaths(Collection $websiteRoutingPaths, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteRoutingPath[] $websiteRoutingPathsToDelete */
        $websiteRoutingPathsToDelete = $this->getWebsiteRoutingPaths(new Criteria(), $con)->diff($websiteRoutingPaths);


        $this->websiteRoutingPathsScheduledForDeletion = $websiteRoutingPathsToDelete;

        foreach ($websiteRoutingPathsToDelete as $websiteRoutingPathRemoved) {
            $websiteRoutingPathRemoved->setWebsiteRouting(null);
        }

        $this->collWebsiteRoutingPaths = null;
        foreach ($websiteRoutingPaths as $websiteRoutingPath) {
            $this->addWebsiteRoutingPath($websiteRoutingPath);
        }

        $this->collWebsiteRoutingPaths = $websiteRoutingPaths;
        $this->collWebsiteRoutingPathsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteRoutingPath objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteRoutingPath objects.
     * @throws PropelException
     */
    public function countWebsiteRoutingPaths(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingPathsPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutingPaths || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutingPaths) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteRoutingPaths());
            }

            $query = ChildWebsiteRoutingPathQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collWebsiteRoutingPaths);
    }

    /**
     * Method called to associate a ChildWebsiteRoutingPath object to this object
     * through the ChildWebsiteRoutingPath foreign key attribute.
     *
     * @param  ChildWebsiteRoutingPath $l ChildWebsiteRoutingPath
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function addWebsiteRoutingPath(ChildWebsiteRoutingPath $l)
    {
        if ($this->collWebsiteRoutingPaths === null) {
            $this->initWebsiteRoutingPaths();
            $this->collWebsiteRoutingPathsPartial = true;
        }

        if (!$this->collWebsiteRoutingPaths->contains($l)) {
            $this->doAddWebsiteRoutingPath($l);

            if ($this->websiteRoutingPathsScheduledForDeletion and $this->websiteRoutingPathsScheduledForDeletion->contains($l)) {
                $this->websiteRoutingPathsScheduledForDeletion->remove($this->websiteRoutingPathsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteRoutingPath $websiteRoutingPath The ChildWebsiteRoutingPath object to add.
     */
    protected function doAddWebsiteRoutingPath(ChildWebsiteRoutingPath $websiteRoutingPath)
    {
        $this->collWebsiteRoutingPaths[]= $websiteRoutingPath;
        $websiteRoutingPath->setWebsiteRouting($this);
    }

    /**
     * @param  ChildWebsiteRoutingPath $websiteRoutingPath The ChildWebsiteRoutingPath object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function removeWebsiteRoutingPath(ChildWebsiteRoutingPath $websiteRoutingPath)
    {
        if ($this->getWebsiteRoutingPaths()->contains($websiteRoutingPath)) {
            $pos = $this->collWebsiteRoutingPaths->search($websiteRoutingPath);
            $this->collWebsiteRoutingPaths->remove($pos);
            if (null === $this->websiteRoutingPathsScheduledForDeletion) {
                $this->websiteRoutingPathsScheduledForDeletion = clone $this->collWebsiteRoutingPaths;
                $this->websiteRoutingPathsScheduledForDeletion->clear();
            }
            $this->websiteRoutingPathsScheduledForDeletion[]= clone $websiteRoutingPath;
            $websiteRoutingPath->setWebsiteRouting(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteRoutingParameters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteRoutingParameters()
     */
    public function clearWebsiteRoutingParameters()
    {
        $this->collWebsiteRoutingParameters = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteRoutingParameters collection loaded partially.
     */
    public function resetPartialWebsiteRoutingParameters($v = true)
    {
        $this->collWebsiteRoutingParametersPartial = $v;
    }

    /**
     * Initializes the collWebsiteRoutingParameters collection.
     *
     * By default this just sets the collWebsiteRoutingParameters collection to an empty array (like clearcollWebsiteRoutingParameters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteRoutingParameters($overrideExisting = true)
    {
        if (null !== $this->collWebsiteRoutingParameters && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteRoutingParameterTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteRoutingParameters = new $collectionClassName;
        $this->collWebsiteRoutingParameters->setModel('\CE\Model\WebsiteRoutingParameter');
    }

    /**
     * Gets an array of ChildWebsiteRoutingParameter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteRouting is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteRoutingParameter[] List of ChildWebsiteRoutingParameter objects
     * @throws PropelException
     */
    public function getWebsiteRoutingParameters(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingParametersPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutingParameters || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutingParameters) {
                // return empty collection
                $this->initWebsiteRoutingParameters();
            } else {
                $collWebsiteRoutingParameters = ChildWebsiteRoutingParameterQuery::create(null, $criteria)
                    ->filterByWebsiteRouting($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteRoutingParametersPartial && count($collWebsiteRoutingParameters)) {
                        $this->initWebsiteRoutingParameters(false);

                        foreach ($collWebsiteRoutingParameters as $obj) {
                            if (false == $this->collWebsiteRoutingParameters->contains($obj)) {
                                $this->collWebsiteRoutingParameters->append($obj);
                            }
                        }

                        $this->collWebsiteRoutingParametersPartial = true;
                    }

                    return $collWebsiteRoutingParameters;
                }

                if ($partial && $this->collWebsiteRoutingParameters) {
                    foreach ($this->collWebsiteRoutingParameters as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteRoutingParameters[] = $obj;
                        }
                    }
                }

                $this->collWebsiteRoutingParameters = $collWebsiteRoutingParameters;
                $this->collWebsiteRoutingParametersPartial = false;
            }
        }

        return $this->collWebsiteRoutingParameters;
    }

    /**
     * Sets a collection of ChildWebsiteRoutingParameter objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteRoutingParameters A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteRoutingParameters(Collection $websiteRoutingParameters, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteRoutingParameter[] $websiteRoutingParametersToDelete */
        $websiteRoutingParametersToDelete = $this->getWebsiteRoutingParameters(new Criteria(), $con)->diff($websiteRoutingParameters);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->websiteRoutingParametersScheduledForDeletion = clone $websiteRoutingParametersToDelete;

        foreach ($websiteRoutingParametersToDelete as $websiteRoutingParameterRemoved) {
            $websiteRoutingParameterRemoved->setWebsiteRouting(null);
        }

        $this->collWebsiteRoutingParameters = null;
        foreach ($websiteRoutingParameters as $websiteRoutingParameter) {
            $this->addWebsiteRoutingParameter($websiteRoutingParameter);
        }

        $this->collWebsiteRoutingParameters = $websiteRoutingParameters;
        $this->collWebsiteRoutingParametersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteRoutingParameter objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteRoutingParameter objects.
     * @throws PropelException
     */
    public function countWebsiteRoutingParameters(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteRoutingParametersPartial && !$this->isNew();
        if (null === $this->collWebsiteRoutingParameters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteRoutingParameters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteRoutingParameters());
            }

            $query = ChildWebsiteRoutingParameterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collWebsiteRoutingParameters);
    }

    /**
     * Method called to associate a ChildWebsiteRoutingParameter object to this object
     * through the ChildWebsiteRoutingParameter foreign key attribute.
     *
     * @param  ChildWebsiteRoutingParameter $l ChildWebsiteRoutingParameter
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function addWebsiteRoutingParameter(ChildWebsiteRoutingParameter $l)
    {
        if ($this->collWebsiteRoutingParameters === null) {
            $this->initWebsiteRoutingParameters();
            $this->collWebsiteRoutingParametersPartial = true;
        }

        if (!$this->collWebsiteRoutingParameters->contains($l)) {
            $this->doAddWebsiteRoutingParameter($l);

            if ($this->websiteRoutingParametersScheduledForDeletion and $this->websiteRoutingParametersScheduledForDeletion->contains($l)) {
                $this->websiteRoutingParametersScheduledForDeletion->remove($this->websiteRoutingParametersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteRoutingParameter $websiteRoutingParameter The ChildWebsiteRoutingParameter object to add.
     */
    protected function doAddWebsiteRoutingParameter(ChildWebsiteRoutingParameter $websiteRoutingParameter)
    {
        $this->collWebsiteRoutingParameters[]= $websiteRoutingParameter;
        $websiteRoutingParameter->setWebsiteRouting($this);
    }

    /**
     * @param  ChildWebsiteRoutingParameter $websiteRoutingParameter The ChildWebsiteRoutingParameter object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function removeWebsiteRoutingParameter(ChildWebsiteRoutingParameter $websiteRoutingParameter)
    {
        if ($this->getWebsiteRoutingParameters()->contains($websiteRoutingParameter)) {
            $pos = $this->collWebsiteRoutingParameters->search($websiteRoutingParameter);
            $this->collWebsiteRoutingParameters->remove($pos);
            if (null === $this->websiteRoutingParametersScheduledForDeletion) {
                $this->websiteRoutingParametersScheduledForDeletion = clone $this->collWebsiteRoutingParameters;
                $this->websiteRoutingParametersScheduledForDeletion->clear();
            }
            $this->websiteRoutingParametersScheduledForDeletion[]= clone $websiteRoutingParameter;
            $websiteRoutingParameter->setWebsiteRouting(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsiteModuleLocations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteModuleLocations()
     */
    public function clearWebsiteModuleLocations()
    {
        $this->collWebsiteModuleLocations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteModuleLocations collection loaded partially.
     */
    public function resetPartialWebsiteModuleLocations($v = true)
    {
        $this->collWebsiteModuleLocationsPartial = $v;
    }

    /**
     * Initializes the collWebsiteModuleLocations collection.
     *
     * By default this just sets the collWebsiteModuleLocations collection to an empty array (like clearcollWebsiteModuleLocations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteModuleLocations($overrideExisting = true)
    {
        if (null !== $this->collWebsiteModuleLocations && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteModuleLocationTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteModuleLocations = new $collectionClassName;
        $this->collWebsiteModuleLocations->setModel('\CE\Model\WebsiteModuleLocation');
    }

    /**
     * Gets an array of ChildWebsiteModuleLocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteRouting is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteModuleLocation[] List of ChildWebsiteModuleLocation objects
     * @throws PropelException
     */
    public function getWebsiteModuleLocations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModuleLocationsPartial && !$this->isNew();
        if (null === $this->collWebsiteModuleLocations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModuleLocations) {
                // return empty collection
                $this->initWebsiteModuleLocations();
            } else {
                $collWebsiteModuleLocations = ChildWebsiteModuleLocationQuery::create(null, $criteria)
                    ->filterByWebsiteRouting($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteModuleLocationsPartial && count($collWebsiteModuleLocations)) {
                        $this->initWebsiteModuleLocations(false);

                        foreach ($collWebsiteModuleLocations as $obj) {
                            if (false == $this->collWebsiteModuleLocations->contains($obj)) {
                                $this->collWebsiteModuleLocations->append($obj);
                            }
                        }

                        $this->collWebsiteModuleLocationsPartial = true;
                    }

                    return $collWebsiteModuleLocations;
                }

                if ($partial && $this->collWebsiteModuleLocations) {
                    foreach ($this->collWebsiteModuleLocations as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteModuleLocations[] = $obj;
                        }
                    }
                }

                $this->collWebsiteModuleLocations = $collWebsiteModuleLocations;
                $this->collWebsiteModuleLocationsPartial = false;
            }
        }

        return $this->collWebsiteModuleLocations;
    }

    /**
     * Sets a collection of ChildWebsiteModuleLocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteModuleLocations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteModuleLocations(Collection $websiteModuleLocations, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteModuleLocation[] $websiteModuleLocationsToDelete */
        $websiteModuleLocationsToDelete = $this->getWebsiteModuleLocations(new Criteria(), $con)->diff($websiteModuleLocations);


        $this->websiteModuleLocationsScheduledForDeletion = $websiteModuleLocationsToDelete;

        foreach ($websiteModuleLocationsToDelete as $websiteModuleLocationRemoved) {
            $websiteModuleLocationRemoved->setWebsiteRouting(null);
        }

        $this->collWebsiteModuleLocations = null;
        foreach ($websiteModuleLocations as $websiteModuleLocation) {
            $this->addWebsiteModuleLocation($websiteModuleLocation);
        }

        $this->collWebsiteModuleLocations = $websiteModuleLocations;
        $this->collWebsiteModuleLocationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteModuleLocation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteModuleLocation objects.
     * @throws PropelException
     */
    public function countWebsiteModuleLocations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModuleLocationsPartial && !$this->isNew();
        if (null === $this->collWebsiteModuleLocations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModuleLocations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteModuleLocations());
            }

            $query = ChildWebsiteModuleLocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collWebsiteModuleLocations);
    }

    /**
     * Method called to associate a ChildWebsiteModuleLocation object to this object
     * through the ChildWebsiteModuleLocation foreign key attribute.
     *
     * @param  ChildWebsiteModuleLocation $l ChildWebsiteModuleLocation
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
     */
    public function addWebsiteModuleLocation(ChildWebsiteModuleLocation $l)
    {
        if ($this->collWebsiteModuleLocations === null) {
            $this->initWebsiteModuleLocations();
            $this->collWebsiteModuleLocationsPartial = true;
        }

        if (!$this->collWebsiteModuleLocations->contains($l)) {
            $this->doAddWebsiteModuleLocation($l);

            if ($this->websiteModuleLocationsScheduledForDeletion and $this->websiteModuleLocationsScheduledForDeletion->contains($l)) {
                $this->websiteModuleLocationsScheduledForDeletion->remove($this->websiteModuleLocationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteModuleLocation $websiteModuleLocation The ChildWebsiteModuleLocation object to add.
     */
    protected function doAddWebsiteModuleLocation(ChildWebsiteModuleLocation $websiteModuleLocation)
    {
        $this->collWebsiteModuleLocations[]= $websiteModuleLocation;
        $websiteModuleLocation->setWebsiteRouting($this);
    }

    /**
     * @param  ChildWebsiteModuleLocation $websiteModuleLocation The ChildWebsiteModuleLocation object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function removeWebsiteModuleLocation(ChildWebsiteModuleLocation $websiteModuleLocation)
    {
        if ($this->getWebsiteModuleLocations()->contains($websiteModuleLocation)) {
            $pos = $this->collWebsiteModuleLocations->search($websiteModuleLocation);
            $this->collWebsiteModuleLocations->remove($pos);
            if (null === $this->websiteModuleLocationsScheduledForDeletion) {
                $this->websiteModuleLocationsScheduledForDeletion = clone $this->collWebsiteModuleLocations;
                $this->websiteModuleLocationsScheduledForDeletion->clear();
            }
            $this->websiteModuleLocationsScheduledForDeletion[]= $websiteModuleLocation;
            $websiteModuleLocation->setWebsiteRouting(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WebsiteRouting is new, it will return
     * an empty collection; or if this WebsiteRouting has previously
     * been saved, it will retrieve related WebsiteModuleLocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WebsiteRouting.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteModuleLocation[] List of ChildWebsiteModuleLocation objects
     */
    public function getWebsiteModuleLocationsJoinWebsiteModule(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteModuleLocationQuery::create(null, $criteria);
        $query->joinWith('WebsiteModule', $joinBehavior);

        return $this->getWebsiteModuleLocations($query, $con);
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
     * If this ChildWebsiteRouting is new, it will return
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
                    ->filterByWebsiteRouting($this)
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
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteZones(Collection $websiteZones, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteZone[] $websiteZonesToDelete */
        $websiteZonesToDelete = $this->getWebsiteZones(new Criteria(), $con)->diff($websiteZones);


        $this->websiteZonesScheduledForDeletion = $websiteZonesToDelete;

        foreach ($websiteZonesToDelete as $websiteZoneRemoved) {
            $websiteZoneRemoved->setWebsiteRouting(null);
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
                ->filterByWebsiteRouting($this)
                ->count($con);
        }

        return count($this->collWebsiteZones);
    }

    /**
     * Method called to associate a ChildWebsiteZone object to this object
     * through the ChildWebsiteZone foreign key attribute.
     *
     * @param  ChildWebsiteZone $l ChildWebsiteZone
     * @return $this|\CE\Model\WebsiteRouting The current object (for fluent API support)
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
        $websiteZone->setWebsiteRouting($this);
    }

    /**
     * @param  ChildWebsiteZone $websiteZone The ChildWebsiteZone object to remove.
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
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
            $this->websiteZonesScheduledForDeletion[]= $websiteZone;
            $websiteZone->setWebsiteRouting(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WebsiteRouting is new, it will return
     * an empty collection; or if this WebsiteRouting has previously
     * been saved, it will retrieve related WebsiteZones from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WebsiteRouting.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteZone[] List of ChildWebsiteZone objects
     */
    public function getWebsiteZonesJoinWebsite(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteZoneQuery::create(null, $criteria);
        $query->joinWith('Website', $joinBehavior);

        return $this->getWebsiteZones($query, $con);
    }

    /**
     * Clears out the collWebsiteModuleIds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteModuleIds()
     */
    public function clearWebsiteModuleIds()
    {
        $this->collWebsiteModuleIds = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the combinationCollWebsiteModuleIds crossRef collection.
     *
     * By default this just sets the combinationCollWebsiteModuleIds collection to an empty collection (like clearWebsiteModuleIds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initWebsiteModuleIds()
    {
        $this->combinationCollWebsiteModuleIds = new ObjectCombinationCollection;
        $this->combinationCollWebsiteModuleIdsPartial = true;
    }

    /**
     * Checks if the combinationCollWebsiteModuleIds collection is loaded.
     *
     * @return bool
     */
    public function isWebsiteModuleIdsLoaded()
    {
        return null !== $this->combinationCollWebsiteModuleIds;
    }

    /**
     * Returns a new query object pre configured with filters from current object and given arguments to query the database.
     *
     * @param int $id
     * @param Criteria $criteria
     *
     * @return ChildWebsiteModuleQuery
     */
    public function createWebsiteModulesQuery($id = null, Criteria $criteria = null)
    {
        $criteria = ChildWebsiteModuleQuery::create($criteria)
            ->filterByWebsiteRouting($this);

        $websiteModuleLocationQuery = $criteria->useWebsiteModuleLocationQuery();

        if (null !== $id) {
            $websiteModuleLocationQuery->filterById($id);
        }

        $websiteModuleLocationQuery->endUse();

        return $criteria;
    }

    /**
     * Gets a combined collection of ChildWebsiteModule objects related by a many-to-many relationship
     * to the current object by way of the website_module_location cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteRouting is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCombinationCollection Combination list of ChildWebsiteModule objects
     */
    public function getWebsiteModuleIds($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollWebsiteModuleIdsPartial && !$this->isNew();
        if (null === $this->combinationCollWebsiteModuleIds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->combinationCollWebsiteModuleIds) {
                    $this->initWebsiteModuleIds();
                }
            } else {

                $query = ChildWebsiteModuleLocationQuery::create(null, $criteria)
                    ->filterByWebsiteRouting($this)
                    ->joinWebsiteModule()
                ;

                $items = $query->find($con);
                $combinationCollWebsiteModuleIds = new ObjectCombinationCollection();
                foreach ($items as $item) {
                    $combination = [];

                    $combination[] = $item->getWebsiteModule();
                    $combination[] = $item->getId();
                    $combinationCollWebsiteModuleIds[] = $combination;
                }

                if (null !== $criteria) {
                    return $combinationCollWebsiteModuleIds;
                }

                if ($partial && $this->combinationCollWebsiteModuleIds) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->combinationCollWebsiteModuleIds as $obj) {
                        if (!call_user_func_array([$combinationCollWebsiteModuleIds, 'contains'], $obj)) {
                            $combinationCollWebsiteModuleIds[] = $obj;
                        }
                    }
                }

                $this->combinationCollWebsiteModuleIds = $combinationCollWebsiteModuleIds;
                $this->combinationCollWebsiteModuleIdsPartial = false;
            }
        }

        return $this->combinationCollWebsiteModuleIds;
    }

    /**
     * Returns a not cached ObjectCollection of ChildWebsiteModule objects. This will hit always the databases.
     * If you have attached new ChildWebsiteModule object to this object you need to call `save` first to get
     * the correct return value. Use getWebsiteModuleIds() to get the current internal state.
     *
     * @param int $id
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return ChildWebsiteModule[]|ObjectCollection
     */
    public function getWebsiteModules($id = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        return $this->createWebsiteModulesQuery($id, $criteria)->find($con);
    }

    /**
     * Sets a collection of ChildWebsiteModule objects related by a many-to-many relationship
     * to the current object by way of the website_module_location cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $websiteModuleIds A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setWebsiteModuleIds(Collection $websiteModuleIds, ConnectionInterface $con = null)
    {
        $this->clearWebsiteModuleIds();
        $currentWebsiteModuleIds = $this->getWebsiteModuleIds();

        $combinationCollWebsiteModuleIdsScheduledForDeletion = $currentWebsiteModuleIds->diff($websiteModuleIds);

        foreach ($combinationCollWebsiteModuleIdsScheduledForDeletion as $toDelete) {
            call_user_func_array([$this, 'removeWebsiteModuleId'], $toDelete);
        }

        foreach ($websiteModuleIds as $websiteModuleId) {
            if (!call_user_func_array([$currentWebsiteModuleIds, 'contains'], $websiteModuleId)) {
                call_user_func_array([$this, 'doAddWebsiteModuleId'], $websiteModuleId);
            }
        }

        $this->combinationCollWebsiteModuleIdsPartial = false;
        $this->combinationCollWebsiteModuleIds = $websiteModuleIds;

        return $this;
    }

    /**
     * Gets the number of ChildWebsiteModule objects related by a many-to-many relationship
     * to the current object by way of the website_module_location cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related ChildWebsiteModule objects
     */
    public function countWebsiteModuleIds(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollWebsiteModuleIdsPartial && !$this->isNew();
        if (null === $this->combinationCollWebsiteModuleIds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->combinationCollWebsiteModuleIds) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getWebsiteModuleIds());
                }

                $query = ChildWebsiteModuleLocationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByWebsiteRouting($this)
                    ->count($con);
            }
        } else {
            return count($this->combinationCollWebsiteModuleIds);
        }
    }

    /**
     * Returns the not cached count of ChildWebsiteModule objects. This will hit always the databases.
     * If you have attached new ChildWebsiteModule object to this object you need to call `save` first to get
     * the correct return value. Use getWebsiteModuleIds() to get the current internal state.
     *
     * @param int $id
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return integer
     */
    public function countWebsiteModules($id = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        return $this->createWebsiteModulesQuery($id, $criteria)->count($con);
    }

    /**
     * Associate a ChildWebsiteModule to this object
     * through the website_module_location cross reference table.
     *
     * @param ChildWebsiteModule $websiteModule,
     * @param int $id
     * @return ChildWebsiteRouting The current object (for fluent API support)
     */
    public function addWebsiteModule(ChildWebsiteModule $websiteModule, $id)
    {
        if ($this->combinationCollWebsiteModuleIds === null) {
            $this->initWebsiteModuleIds();
        }

        if (!$this->getWebsiteModuleIds()->contains($websiteModule, $id)) {
            // only add it if the **same** object is not already associated
            $this->combinationCollWebsiteModuleIds->push($websiteModule, $id);
            $this->doAddWebsiteModuleId($websiteModule, $id);
        }

        return $this;
    }

    /**
     *
     * @param ChildWebsiteModule $websiteModule,
     * @param int $id
     */
    protected function doAddWebsiteModuleId(ChildWebsiteModule $websiteModule, $id)
    {
        $websiteModuleLocation = new ChildWebsiteModuleLocation();

        $websiteModuleLocation->setWebsiteModule($websiteModule);
        $websiteModuleLocation->setId($id);


        $websiteModuleLocation->setWebsiteRouting($this);

        $this->addWebsiteModuleLocation($websiteModuleLocation);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if ($websiteModule->isWebsiteRoutingIdsLoaded()) {
            $websiteModule->initWebsiteRoutingIds();
            $websiteModule->getWebsiteRoutingIds()->push($this, $id);
        } elseif (!$websiteModule->getWebsiteRoutingIds()->contains($this, $id)) {
            $websiteModule->getWebsiteRoutingIds()->push($this, $id);
        }

    }

    /**
     * Remove websiteModule, id of this object
     * through the website_module_location cross reference table.
     *
     * @param ChildWebsiteModule $websiteModule,
     * @param int $id
     * @return ChildWebsiteRouting The current object (for fluent API support)
     */
    public function removeWebsiteModuleId(ChildWebsiteModule $websiteModule, $id)
    {
        if ($this->getWebsiteModuleIds()->contains($websiteModule, $id)) {
            $websiteModuleLocation = new ChildWebsiteModuleLocation();
            $websiteModuleLocation->setWebsiteModule($websiteModule);
            if ($websiteModule->isWebsiteRoutingIdsLoaded()) {
                //remove the back reference if available
                $websiteModule->getWebsiteRoutingIds()->removeObject($this, $id);
            }

            $websiteModuleLocation->setId($id);
            $websiteModuleLocation->setWebsiteRouting($this);
            $this->removeWebsiteModuleLocation(clone $websiteModuleLocation);
            $websiteModuleLocation->clear();

            $this->combinationCollWebsiteModuleIds->remove($this->combinationCollWebsiteModuleIds->search($websiteModule, $id));

            if (null === $this->combinationCollWebsiteModuleIdsScheduledForDeletion) {
                $this->combinationCollWebsiteModuleIdsScheduledForDeletion = clone $this->combinationCollWebsiteModuleIds;
                $this->combinationCollWebsiteModuleIdsScheduledForDeletion->clear();
            }

            $this->combinationCollWebsiteModuleIdsScheduledForDeletion->push($websiteModule, $id);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aWebsite) {
            $this->aWebsite->removeWebsiteRouting($this);
        }
        $this->id = null;
        $this->website_id = null;
        $this->comment = null;
        $this->tags = null;
        $this->enable = null;
        $this->page = null;
        $this->javascript = null;
        $this->stylesheet = null;
        $this->controller = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collWebsiteRedirections) {
                foreach ($this->collWebsiteRedirections as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteRoutingI18ns) {
                foreach ($this->collWebsiteRoutingI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteRoutingPaths) {
                foreach ($this->collWebsiteRoutingPaths as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteRoutingParameters) {
                foreach ($this->collWebsiteRoutingParameters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteModuleLocations) {
                foreach ($this->collWebsiteModuleLocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteZones) {
                foreach ($this->collWebsiteZones as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->combinationCollWebsiteModuleIds) {
                foreach ($this->combinationCollWebsiteModuleIds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collMetas = null;
        $this->collWebsiteRedirections = null;
        $this->collWebsiteRoutingI18ns = null;
        $this->collWebsiteRoutingPaths = null;
        $this->collWebsiteRoutingParameters = null;
        $this->collWebsiteModuleLocations = null;
        $this->collWebsiteZones = null;
        $this->combinationCollWebsiteModuleIds = null;
        $this->aWebsite = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WebsiteRoutingTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function setCulture($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getCulture()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildWebsiteRoutingI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collWebsiteRoutingI18ns) {
                foreach ($this->collWebsiteRoutingI18ns as $translation) {
                    if ($translation->getCulture() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildWebsiteRoutingI18n();
                $translation->setCulture($locale);
            } else {
                $translation = ChildWebsiteRoutingI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addWebsiteRoutingI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildWebsiteRoutingI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collWebsiteRoutingI18ns as $key => $translation) {
            if ($translation->getCulture() == $locale) {
                unset($this->collWebsiteRoutingI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildWebsiteRoutingI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getCulture(), $con);
    }


        /**
         * Get the [name] column value.
         *
         * @return string
         */
        public function getName()
        {
        return $this->getCurrentTranslation()->getName();
    }


        /**
         * Set the value of [name] column.
         *
         * @param string $v new value
         * @return $this|\CE\Model\WebsiteRoutingI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [title] column value.
         *
         * @return string
         */
        public function getTitle()
        {
        return $this->getCurrentTranslation()->getTitle();
    }


        /**
         * Set the value of [title] column.
         *
         * @param string $v new value
         * @return $this|\CE\Model\WebsiteRoutingI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }


        /**
         * Get the [description] column value.
         *
         * @return string
         */
        public function getDescription()
        {
        return $this->getCurrentTranslation()->getDescription();
    }


        /**
         * Set the value of [description] column.
         *
         * @param string $v new value
         * @return $this|\CE\Model\WebsiteRoutingI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildWebsiteRouting The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[WebsiteRoutingTableMap::COL_UPDATED_AT] = true;

        return $this;
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
