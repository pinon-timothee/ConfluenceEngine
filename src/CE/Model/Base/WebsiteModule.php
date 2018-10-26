<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Website as ChildWebsite;
use CE\Model\WebsiteModule as ChildWebsiteModule;
use CE\Model\WebsiteModuleI18n as ChildWebsiteModuleI18n;
use CE\Model\WebsiteModuleI18nQuery as ChildWebsiteModuleI18nQuery;
use CE\Model\WebsiteModuleLocation as ChildWebsiteModuleLocation;
use CE\Model\WebsiteModuleLocationQuery as ChildWebsiteModuleLocationQuery;
use CE\Model\WebsiteModuleParameter as ChildWebsiteModuleParameter;
use CE\Model\WebsiteModuleParameterQuery as ChildWebsiteModuleParameterQuery;
use CE\Model\WebsiteModuleQuery as ChildWebsiteModuleQuery;
use CE\Model\WebsiteQuery as ChildWebsiteQuery;
use CE\Model\Map\WebsiteModuleI18nTableMap;
use CE\Model\Map\WebsiteModuleLocationTableMap;
use CE\Model\Map\WebsiteModuleParameterTableMap;
use CE\Model\Map\WebsiteModuleTableMap;
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
 * Base class that represents a row from the 'website_module' table.
 *
 *
 *
 * @package    propel.generator.src.CE.Model.Base
 */
abstract class WebsiteModule implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CE\\Model\\Map\\WebsiteModuleTableMap';


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
     * The value for the module_name field.
     *
     * @var        string
     */
    protected $module_name;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the css field.
     *
     * @var        string
     */
    protected $css;

    /**
     * The value for the class field.
     *
     * @var        string
     */
    protected $class;

    /**
     * The value for the block field.
     *
     * @var        string
     */
    protected $block;

    /**
     * The value for the twig field.
     *
     * @var        string
     */
    protected $twig;

    /**
     * The value for the javascript field.
     *
     * @var        string
     */
    protected $javascript;

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
     * The value for the title_tag field.
     *
     * Note: this column has a database default value of: 'h2'
     * @var        string
     */
    protected $title_tag;

    /**
     * @var        ChildWebsite
     */
    protected $aWebsite;

    /**
     * @var        ObjectCollection|ChildWebsiteModuleParameter[] Collection to store aggregation of ChildWebsiteModuleParameter objects.
     */
    protected $collWebsiteModuleParameters;
    protected $collWebsiteModuleParametersPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteModuleLocation[] Collection to store aggregation of ChildWebsiteModuleLocation objects.
     */
    protected $collWebsiteModuleLocations;
    protected $collWebsiteModuleLocationsPartial;

    /**
     * @var        ObjectCollection|ChildWebsiteModuleI18n[] Collection to store aggregation of ChildWebsiteModuleI18n objects.
     */
    protected $collWebsiteModuleI18ns;
    protected $collWebsiteModuleI18nsPartial;

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
     * @var        array[ChildWebsiteModuleI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteModuleParameter[]
     */
    protected $websiteModuleParametersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteModuleLocation[]
     */
    protected $websiteModuleLocationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsiteModuleI18n[]
     */
    protected $websiteModuleI18nsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->enable = true;
        $this->title_tag = 'h2';
    }

    /**
     * Initializes internal state of CE\Model\Base\WebsiteModule object.
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
     * Compares this with another <code>WebsiteModule</code> instance.  If
     * <code>obj</code> is an instance of <code>WebsiteModule</code>, delegates to
     * <code>equals(WebsiteModule)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|WebsiteModule The current object, for fluid interface
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
     * Get the [module_name] column value.
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->module_name;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [css] column value.
     *
     * @return string
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * Get the [class] column value.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get the [block] column value.
     *
     * @return string
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Get the [twig] column value.
     *
     * @return string
     */
    public function getTwig()
    {
        return $this->twig;
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
     * Get the [title_tag] column value.
     *
     * @return string
     */
    public function getTitleTag()
    {
        return $this->title_tag;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [website_id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setWebsiteId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->website_id !== $v) {
            $this->website_id = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_WEBSITE_ID] = true;
        }

        if ($this->aWebsite !== null && $this->aWebsite->getId() !== $v) {
            $this->aWebsite = null;
        }

        return $this;
    } // setWebsiteId()

    /**
     * Set the value of [module_name] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setModuleName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->module_name !== $v) {
            $this->module_name = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_MODULE_NAME] = true;
        }

        return $this;
    } // setModuleName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [css] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setCss($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->css !== $v) {
            $this->css = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_CSS] = true;
        }

        return $this;
    } // setCss()

    /**
     * Set the value of [class] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setClass($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->class !== $v) {
            $this->class = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_CLASS] = true;
        }

        return $this;
    } // setClass()

    /**
     * Set the value of [block] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setBlock($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->block !== $v) {
            $this->block = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_BLOCK] = true;
        }

        return $this;
    } // setBlock()

    /**
     * Set the value of [twig] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setTwig($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->twig !== $v) {
            $this->twig = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_TWIG] = true;
        }

        return $this;
    } // setTwig()

    /**
     * Set the value of [javascript] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setJavascript($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->javascript !== $v) {
            $this->javascript = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_JAVASCRIPT] = true;
        }

        return $this;
    } // setJavascript()

    /**
     * Set the value of [tags] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_TAGS] = true;
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
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
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
            $this->modifiedColumns[WebsiteModuleTableMap::COL_ENABLE] = true;
        }

        return $this;
    } // setEnable()

    /**
     * Set the value of [title_tag] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function setTitleTag($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title_tag !== $v) {
            $this->title_tag = $v;
            $this->modifiedColumns[WebsiteModuleTableMap::COL_TITLE_TAG] = true;
        }

        return $this;
    } // setTitleTag()

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

            if ($this->title_tag !== 'h2') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WebsiteModuleTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WebsiteModuleTableMap::translateFieldName('WebsiteId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->website_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WebsiteModuleTableMap::translateFieldName('ModuleName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->module_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WebsiteModuleTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WebsiteModuleTableMap::translateFieldName('Css', TableMap::TYPE_PHPNAME, $indexType)];
            $this->css = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WebsiteModuleTableMap::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)];
            $this->class = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WebsiteModuleTableMap::translateFieldName('Block', TableMap::TYPE_PHPNAME, $indexType)];
            $this->block = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WebsiteModuleTableMap::translateFieldName('Twig', TableMap::TYPE_PHPNAME, $indexType)];
            $this->twig = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WebsiteModuleTableMap::translateFieldName('Javascript', TableMap::TYPE_PHPNAME, $indexType)];
            $this->javascript = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WebsiteModuleTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WebsiteModuleTableMap::translateFieldName('Enable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WebsiteModuleTableMap::translateFieldName('TitleTag', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title_tag = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = WebsiteModuleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CE\\Model\\WebsiteModule'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWebsiteModuleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aWebsite = null;
            $this->collWebsiteModuleParameters = null;

            $this->collWebsiteModuleLocations = null;

            $this->collWebsiteModuleI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see WebsiteModule::setDeleted()
     * @see WebsiteModule::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWebsiteModuleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleTableMap::DATABASE_NAME);
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
                WebsiteModuleTableMap::addInstanceToPool($this);
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

            if ($this->websiteModuleParametersScheduledForDeletion !== null) {
                if (!$this->websiteModuleParametersScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteModuleParameterQuery::create()
                        ->filterByPrimaryKeys($this->websiteModuleParametersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteModuleParametersScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteModuleParameters !== null) {
                foreach ($this->collWebsiteModuleParameters as $referrerFK) {
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

            if ($this->websiteModuleI18nsScheduledForDeletion !== null) {
                if (!$this->websiteModuleI18nsScheduledForDeletion->isEmpty()) {
                    \CE\Model\WebsiteModuleI18nQuery::create()
                        ->filterByPrimaryKeys($this->websiteModuleI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->websiteModuleI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collWebsiteModuleI18ns !== null) {
                foreach ($this->collWebsiteModuleI18ns as $referrerFK) {
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

        $this->modifiedColumns[WebsiteModuleTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WebsiteModuleTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_WEBSITE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`website_id`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_MODULE_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`module_name`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_CSS)) {
            $modifiedColumns[':p' . $index++]  = '`css`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_CLASS)) {
            $modifiedColumns[':p' . $index++]  = '`class`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_BLOCK)) {
            $modifiedColumns[':p' . $index++]  = '`block`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_TWIG)) {
            $modifiedColumns[':p' . $index++]  = '`twig`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_JAVASCRIPT)) {
            $modifiedColumns[':p' . $index++]  = '`javascript`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_TAGS)) {
            $modifiedColumns[':p' . $index++]  = '`tags`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_ENABLE)) {
            $modifiedColumns[':p' . $index++]  = '`enable`';
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_TITLE_TAG)) {
            $modifiedColumns[':p' . $index++]  = '`title_tag`';
        }

        $sql = sprintf(
            'INSERT INTO `website_module` (%s) VALUES (%s)',
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
                    case '`module_name`':
                        $stmt->bindValue($identifier, $this->module_name, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`css`':
                        $stmt->bindValue($identifier, $this->css, PDO::PARAM_STR);
                        break;
                    case '`class`':
                        $stmt->bindValue($identifier, $this->class, PDO::PARAM_STR);
                        break;
                    case '`block`':
                        $stmt->bindValue($identifier, $this->block, PDO::PARAM_STR);
                        break;
                    case '`twig`':
                        $stmt->bindValue($identifier, $this->twig, PDO::PARAM_STR);
                        break;
                    case '`javascript`':
                        $stmt->bindValue($identifier, $this->javascript, PDO::PARAM_STR);
                        break;
                    case '`tags`':
                        $stmt->bindValue($identifier, $this->tags, PDO::PARAM_STR);
                        break;
                    case '`enable`':
                        $stmt->bindValue($identifier, (int) $this->enable, PDO::PARAM_INT);
                        break;
                    case '`title_tag`':
                        $stmt->bindValue($identifier, $this->title_tag, PDO::PARAM_STR);
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
        $pos = WebsiteModuleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getModuleName();
                break;
            case 3:
                return $this->getDescription();
                break;
            case 4:
                return $this->getCss();
                break;
            case 5:
                return $this->getClass();
                break;
            case 6:
                return $this->getBlock();
                break;
            case 7:
                return $this->getTwig();
                break;
            case 8:
                return $this->getJavascript();
                break;
            case 9:
                return $this->getTags();
                break;
            case 10:
                return $this->getEnable();
                break;
            case 11:
                return $this->getTitleTag();
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

        if (isset($alreadyDumpedObjects['WebsiteModule'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['WebsiteModule'][$this->hashCode()] = true;
        $keys = WebsiteModuleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getWebsiteId(),
            $keys[2] => $this->getModuleName(),
            $keys[3] => $this->getDescription(),
            $keys[4] => $this->getCss(),
            $keys[5] => $this->getClass(),
            $keys[6] => $this->getBlock(),
            $keys[7] => $this->getTwig(),
            $keys[8] => $this->getJavascript(),
            $keys[9] => $this->getTags(),
            $keys[10] => $this->getEnable(),
            $keys[11] => $this->getTitleTag(),
        );
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
            if (null !== $this->collWebsiteModuleParameters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteModuleParameters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_module_parameters';
                        break;
                    default:
                        $key = 'WebsiteModuleParameters';
                }

                $result[$key] = $this->collWebsiteModuleParameters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collWebsiteModuleI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteModuleI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_module_i18ns';
                        break;
                    default:
                        $key = 'WebsiteModuleI18ns';
                }

                $result[$key] = $this->collWebsiteModuleI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\CE\Model\WebsiteModule
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WebsiteModuleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CE\Model\WebsiteModule
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
                $this->setModuleName($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
            case 4:
                $this->setCss($value);
                break;
            case 5:
                $this->setClass($value);
                break;
            case 6:
                $this->setBlock($value);
                break;
            case 7:
                $this->setTwig($value);
                break;
            case 8:
                $this->setJavascript($value);
                break;
            case 9:
                $this->setTags($value);
                break;
            case 10:
                $this->setEnable($value);
                break;
            case 11:
                $this->setTitleTag($value);
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
        $keys = WebsiteModuleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWebsiteId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setModuleName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCss($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setClass($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBlock($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTwig($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setJavascript($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTags($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEnable($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTitleTag($arr[$keys[11]]);
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
     * @return $this|\CE\Model\WebsiteModule The current object, for fluid interface
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
        $criteria = new Criteria(WebsiteModuleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WebsiteModuleTableMap::COL_ID)) {
            $criteria->add(WebsiteModuleTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_WEBSITE_ID)) {
            $criteria->add(WebsiteModuleTableMap::COL_WEBSITE_ID, $this->website_id);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_MODULE_NAME)) {
            $criteria->add(WebsiteModuleTableMap::COL_MODULE_NAME, $this->module_name);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_DESCRIPTION)) {
            $criteria->add(WebsiteModuleTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_CSS)) {
            $criteria->add(WebsiteModuleTableMap::COL_CSS, $this->css);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_CLASS)) {
            $criteria->add(WebsiteModuleTableMap::COL_CLASS, $this->class);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_BLOCK)) {
            $criteria->add(WebsiteModuleTableMap::COL_BLOCK, $this->block);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_TWIG)) {
            $criteria->add(WebsiteModuleTableMap::COL_TWIG, $this->twig);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_JAVASCRIPT)) {
            $criteria->add(WebsiteModuleTableMap::COL_JAVASCRIPT, $this->javascript);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_TAGS)) {
            $criteria->add(WebsiteModuleTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_ENABLE)) {
            $criteria->add(WebsiteModuleTableMap::COL_ENABLE, $this->enable);
        }
        if ($this->isColumnModified(WebsiteModuleTableMap::COL_TITLE_TAG)) {
            $criteria->add(WebsiteModuleTableMap::COL_TITLE_TAG, $this->title_tag);
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
        $criteria = ChildWebsiteModuleQuery::create();
        $criteria->add(WebsiteModuleTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \CE\Model\WebsiteModule (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setWebsiteId($this->getWebsiteId());
        $copyObj->setModuleName($this->getModuleName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setCss($this->getCss());
        $copyObj->setClass($this->getClass());
        $copyObj->setBlock($this->getBlock());
        $copyObj->setTwig($this->getTwig());
        $copyObj->setJavascript($this->getJavascript());
        $copyObj->setTags($this->getTags());
        $copyObj->setEnable($this->getEnable());
        $copyObj->setTitleTag($this->getTitleTag());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getWebsiteModuleParameters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteModuleParameter($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteModuleLocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteModuleLocation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsiteModuleI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsiteModuleI18n($relObj->copy($deepCopy));
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
     * @return \CE\Model\WebsiteModule Clone of current object.
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
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
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
            $v->addWebsiteModule($this);
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
                $this->aWebsite->addWebsiteModules($this);
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
        if ('WebsiteModuleParameter' == $relationName) {
            $this->initWebsiteModuleParameters();
            return;
        }
        if ('WebsiteModuleLocation' == $relationName) {
            $this->initWebsiteModuleLocations();
            return;
        }
        if ('WebsiteModuleI18n' == $relationName) {
            $this->initWebsiteModuleI18ns();
            return;
        }
    }

    /**
     * Clears out the collWebsiteModuleParameters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteModuleParameters()
     */
    public function clearWebsiteModuleParameters()
    {
        $this->collWebsiteModuleParameters = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteModuleParameters collection loaded partially.
     */
    public function resetPartialWebsiteModuleParameters($v = true)
    {
        $this->collWebsiteModuleParametersPartial = $v;
    }

    /**
     * Initializes the collWebsiteModuleParameters collection.
     *
     * By default this just sets the collWebsiteModuleParameters collection to an empty array (like clearcollWebsiteModuleParameters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteModuleParameters($overrideExisting = true)
    {
        if (null !== $this->collWebsiteModuleParameters && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteModuleParameterTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteModuleParameters = new $collectionClassName;
        $this->collWebsiteModuleParameters->setModel('\CE\Model\WebsiteModuleParameter');
    }

    /**
     * Gets an array of ChildWebsiteModuleParameter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteModule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteModuleParameter[] List of ChildWebsiteModuleParameter objects
     * @throws PropelException
     */
    public function getWebsiteModuleParameters(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModuleParametersPartial && !$this->isNew();
        if (null === $this->collWebsiteModuleParameters || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModuleParameters) {
                // return empty collection
                $this->initWebsiteModuleParameters();
            } else {
                $collWebsiteModuleParameters = ChildWebsiteModuleParameterQuery::create(null, $criteria)
                    ->filterByWebsiteModule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteModuleParametersPartial && count($collWebsiteModuleParameters)) {
                        $this->initWebsiteModuleParameters(false);

                        foreach ($collWebsiteModuleParameters as $obj) {
                            if (false == $this->collWebsiteModuleParameters->contains($obj)) {
                                $this->collWebsiteModuleParameters->append($obj);
                            }
                        }

                        $this->collWebsiteModuleParametersPartial = true;
                    }

                    return $collWebsiteModuleParameters;
                }

                if ($partial && $this->collWebsiteModuleParameters) {
                    foreach ($this->collWebsiteModuleParameters as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteModuleParameters[] = $obj;
                        }
                    }
                }

                $this->collWebsiteModuleParameters = $collWebsiteModuleParameters;
                $this->collWebsiteModuleParametersPartial = false;
            }
        }

        return $this->collWebsiteModuleParameters;
    }

    /**
     * Sets a collection of ChildWebsiteModuleParameter objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteModuleParameters A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteModule The current object (for fluent API support)
     */
    public function setWebsiteModuleParameters(Collection $websiteModuleParameters, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteModuleParameter[] $websiteModuleParametersToDelete */
        $websiteModuleParametersToDelete = $this->getWebsiteModuleParameters(new Criteria(), $con)->diff($websiteModuleParameters);


        $this->websiteModuleParametersScheduledForDeletion = $websiteModuleParametersToDelete;

        foreach ($websiteModuleParametersToDelete as $websiteModuleParameterRemoved) {
            $websiteModuleParameterRemoved->setWebsiteModule(null);
        }

        $this->collWebsiteModuleParameters = null;
        foreach ($websiteModuleParameters as $websiteModuleParameter) {
            $this->addWebsiteModuleParameter($websiteModuleParameter);
        }

        $this->collWebsiteModuleParameters = $websiteModuleParameters;
        $this->collWebsiteModuleParametersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteModuleParameter objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteModuleParameter objects.
     * @throws PropelException
     */
    public function countWebsiteModuleParameters(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModuleParametersPartial && !$this->isNew();
        if (null === $this->collWebsiteModuleParameters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModuleParameters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteModuleParameters());
            }

            $query = ChildWebsiteModuleParameterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsiteModule($this)
                ->count($con);
        }

        return count($this->collWebsiteModuleParameters);
    }

    /**
     * Method called to associate a ChildWebsiteModuleParameter object to this object
     * through the ChildWebsiteModuleParameter foreign key attribute.
     *
     * @param  ChildWebsiteModuleParameter $l ChildWebsiteModuleParameter
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function addWebsiteModuleParameter(ChildWebsiteModuleParameter $l)
    {
        if ($this->collWebsiteModuleParameters === null) {
            $this->initWebsiteModuleParameters();
            $this->collWebsiteModuleParametersPartial = true;
        }

        if (!$this->collWebsiteModuleParameters->contains($l)) {
            $this->doAddWebsiteModuleParameter($l);

            if ($this->websiteModuleParametersScheduledForDeletion and $this->websiteModuleParametersScheduledForDeletion->contains($l)) {
                $this->websiteModuleParametersScheduledForDeletion->remove($this->websiteModuleParametersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteModuleParameter $websiteModuleParameter The ChildWebsiteModuleParameter object to add.
     */
    protected function doAddWebsiteModuleParameter(ChildWebsiteModuleParameter $websiteModuleParameter)
    {
        $this->collWebsiteModuleParameters[]= $websiteModuleParameter;
        $websiteModuleParameter->setWebsiteModule($this);
    }

    /**
     * @param  ChildWebsiteModuleParameter $websiteModuleParameter The ChildWebsiteModuleParameter object to remove.
     * @return $this|ChildWebsiteModule The current object (for fluent API support)
     */
    public function removeWebsiteModuleParameter(ChildWebsiteModuleParameter $websiteModuleParameter)
    {
        if ($this->getWebsiteModuleParameters()->contains($websiteModuleParameter)) {
            $pos = $this->collWebsiteModuleParameters->search($websiteModuleParameter);
            $this->collWebsiteModuleParameters->remove($pos);
            if (null === $this->websiteModuleParametersScheduledForDeletion) {
                $this->websiteModuleParametersScheduledForDeletion = clone $this->collWebsiteModuleParameters;
                $this->websiteModuleParametersScheduledForDeletion->clear();
            }
            $this->websiteModuleParametersScheduledForDeletion[]= clone $websiteModuleParameter;
            $websiteModuleParameter->setWebsiteModule(null);
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
     * If this ChildWebsiteModule is new, it will return
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
                    ->filterByWebsiteModule($this)
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
     * @return $this|ChildWebsiteModule The current object (for fluent API support)
     */
    public function setWebsiteModuleLocations(Collection $websiteModuleLocations, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteModuleLocation[] $websiteModuleLocationsToDelete */
        $websiteModuleLocationsToDelete = $this->getWebsiteModuleLocations(new Criteria(), $con)->diff($websiteModuleLocations);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->websiteModuleLocationsScheduledForDeletion = clone $websiteModuleLocationsToDelete;

        foreach ($websiteModuleLocationsToDelete as $websiteModuleLocationRemoved) {
            $websiteModuleLocationRemoved->setWebsiteModule(null);
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
                ->filterByWebsiteModule($this)
                ->count($con);
        }

        return count($this->collWebsiteModuleLocations);
    }

    /**
     * Method called to associate a ChildWebsiteModuleLocation object to this object
     * through the ChildWebsiteModuleLocation foreign key attribute.
     *
     * @param  ChildWebsiteModuleLocation $l ChildWebsiteModuleLocation
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
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
        $websiteModuleLocation->setWebsiteModule($this);
    }

    /**
     * @param  ChildWebsiteModuleLocation $websiteModuleLocation The ChildWebsiteModuleLocation object to remove.
     * @return $this|ChildWebsiteModule The current object (for fluent API support)
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
            $this->websiteModuleLocationsScheduledForDeletion[]= clone $websiteModuleLocation;
            $websiteModuleLocation->setWebsiteModule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WebsiteModule is new, it will return
     * an empty collection; or if this WebsiteModule has previously
     * been saved, it will retrieve related WebsiteModuleLocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WebsiteModule.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsiteModuleLocation[] List of ChildWebsiteModuleLocation objects
     */
    public function getWebsiteModuleLocationsJoinWebsiteRouting(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteModuleLocationQuery::create(null, $criteria);
        $query->joinWith('WebsiteRouting', $joinBehavior);

        return $this->getWebsiteModuleLocations($query, $con);
    }

    /**
     * Clears out the collWebsiteModuleI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsiteModuleI18ns()
     */
    public function clearWebsiteModuleI18ns()
    {
        $this->collWebsiteModuleI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsiteModuleI18ns collection loaded partially.
     */
    public function resetPartialWebsiteModuleI18ns($v = true)
    {
        $this->collWebsiteModuleI18nsPartial = $v;
    }

    /**
     * Initializes the collWebsiteModuleI18ns collection.
     *
     * By default this just sets the collWebsiteModuleI18ns collection to an empty array (like clearcollWebsiteModuleI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsiteModuleI18ns($overrideExisting = true)
    {
        if (null !== $this->collWebsiteModuleI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteModuleI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsiteModuleI18ns = new $collectionClassName;
        $this->collWebsiteModuleI18ns->setModel('\CE\Model\WebsiteModuleI18n');
    }

    /**
     * Gets an array of ChildWebsiteModuleI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWebsiteModule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsiteModuleI18n[] List of ChildWebsiteModuleI18n objects
     * @throws PropelException
     */
    public function getWebsiteModuleI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModuleI18nsPartial && !$this->isNew();
        if (null === $this->collWebsiteModuleI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModuleI18ns) {
                // return empty collection
                $this->initWebsiteModuleI18ns();
            } else {
                $collWebsiteModuleI18ns = ChildWebsiteModuleI18nQuery::create(null, $criteria)
                    ->filterByWebsiteModule($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsiteModuleI18nsPartial && count($collWebsiteModuleI18ns)) {
                        $this->initWebsiteModuleI18ns(false);

                        foreach ($collWebsiteModuleI18ns as $obj) {
                            if (false == $this->collWebsiteModuleI18ns->contains($obj)) {
                                $this->collWebsiteModuleI18ns->append($obj);
                            }
                        }

                        $this->collWebsiteModuleI18nsPartial = true;
                    }

                    return $collWebsiteModuleI18ns;
                }

                if ($partial && $this->collWebsiteModuleI18ns) {
                    foreach ($this->collWebsiteModuleI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collWebsiteModuleI18ns[] = $obj;
                        }
                    }
                }

                $this->collWebsiteModuleI18ns = $collWebsiteModuleI18ns;
                $this->collWebsiteModuleI18nsPartial = false;
            }
        }

        return $this->collWebsiteModuleI18ns;
    }

    /**
     * Sets a collection of ChildWebsiteModuleI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websiteModuleI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildWebsiteModule The current object (for fluent API support)
     */
    public function setWebsiteModuleI18ns(Collection $websiteModuleI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildWebsiteModuleI18n[] $websiteModuleI18nsToDelete */
        $websiteModuleI18nsToDelete = $this->getWebsiteModuleI18ns(new Criteria(), $con)->diff($websiteModuleI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->websiteModuleI18nsScheduledForDeletion = clone $websiteModuleI18nsToDelete;

        foreach ($websiteModuleI18nsToDelete as $websiteModuleI18nRemoved) {
            $websiteModuleI18nRemoved->setWebsiteModule(null);
        }

        $this->collWebsiteModuleI18ns = null;
        foreach ($websiteModuleI18ns as $websiteModuleI18n) {
            $this->addWebsiteModuleI18n($websiteModuleI18n);
        }

        $this->collWebsiteModuleI18ns = $websiteModuleI18ns;
        $this->collWebsiteModuleI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WebsiteModuleI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WebsiteModuleI18n objects.
     * @throws PropelException
     */
    public function countWebsiteModuleI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsiteModuleI18nsPartial && !$this->isNew();
        if (null === $this->collWebsiteModuleI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsiteModuleI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsiteModuleI18ns());
            }

            $query = ChildWebsiteModuleI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWebsiteModule($this)
                ->count($con);
        }

        return count($this->collWebsiteModuleI18ns);
    }

    /**
     * Method called to associate a ChildWebsiteModuleI18n object to this object
     * through the ChildWebsiteModuleI18n foreign key attribute.
     *
     * @param  ChildWebsiteModuleI18n $l ChildWebsiteModuleI18n
     * @return $this|\CE\Model\WebsiteModule The current object (for fluent API support)
     */
    public function addWebsiteModuleI18n(ChildWebsiteModuleI18n $l)
    {
        if ($l && $locale = $l->getCulture()) {
            $this->setCulture($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collWebsiteModuleI18ns === null) {
            $this->initWebsiteModuleI18ns();
            $this->collWebsiteModuleI18nsPartial = true;
        }

        if (!$this->collWebsiteModuleI18ns->contains($l)) {
            $this->doAddWebsiteModuleI18n($l);

            if ($this->websiteModuleI18nsScheduledForDeletion and $this->websiteModuleI18nsScheduledForDeletion->contains($l)) {
                $this->websiteModuleI18nsScheduledForDeletion->remove($this->websiteModuleI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsiteModuleI18n $websiteModuleI18n The ChildWebsiteModuleI18n object to add.
     */
    protected function doAddWebsiteModuleI18n(ChildWebsiteModuleI18n $websiteModuleI18n)
    {
        $this->collWebsiteModuleI18ns[]= $websiteModuleI18n;
        $websiteModuleI18n->setWebsiteModule($this);
    }

    /**
     * @param  ChildWebsiteModuleI18n $websiteModuleI18n The ChildWebsiteModuleI18n object to remove.
     * @return $this|ChildWebsiteModule The current object (for fluent API support)
     */
    public function removeWebsiteModuleI18n(ChildWebsiteModuleI18n $websiteModuleI18n)
    {
        if ($this->getWebsiteModuleI18ns()->contains($websiteModuleI18n)) {
            $pos = $this->collWebsiteModuleI18ns->search($websiteModuleI18n);
            $this->collWebsiteModuleI18ns->remove($pos);
            if (null === $this->websiteModuleI18nsScheduledForDeletion) {
                $this->websiteModuleI18nsScheduledForDeletion = clone $this->collWebsiteModuleI18ns;
                $this->websiteModuleI18nsScheduledForDeletion->clear();
            }
            $this->websiteModuleI18nsScheduledForDeletion[]= clone $websiteModuleI18n;
            $websiteModuleI18n->setWebsiteModule(null);
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
            $this->aWebsite->removeWebsiteModule($this);
        }
        $this->id = null;
        $this->website_id = null;
        $this->module_name = null;
        $this->description = null;
        $this->css = null;
        $this->class = null;
        $this->block = null;
        $this->twig = null;
        $this->javascript = null;
        $this->tags = null;
        $this->enable = null;
        $this->title_tag = null;
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
            if ($this->collWebsiteModuleParameters) {
                foreach ($this->collWebsiteModuleParameters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteModuleLocations) {
                foreach ($this->collWebsiteModuleLocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsiteModuleI18ns) {
                foreach ($this->collWebsiteModuleI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collWebsiteModuleParameters = null;
        $this->collWebsiteModuleLocations = null;
        $this->collWebsiteModuleI18ns = null;
        $this->aWebsite = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WebsiteModuleTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildWebsiteModule The current object (for fluent API support)
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
     * @return ChildWebsiteModuleI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collWebsiteModuleI18ns) {
                foreach ($this->collWebsiteModuleI18ns as $translation) {
                    if ($translation->getCulture() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildWebsiteModuleI18n();
                $translation->setCulture($locale);
            } else {
                $translation = ChildWebsiteModuleI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addWebsiteModuleI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildWebsiteModule The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildWebsiteModuleI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collWebsiteModuleI18ns as $key => $translation) {
            if ($translation->getCulture() == $locale) {
                unset($this->collWebsiteModuleI18ns[$key]);
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
     * @return ChildWebsiteModuleI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getCulture(), $con);
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
         * @return $this|\CE\Model\WebsiteModuleI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }


        /**
         * Get the [content] column value.
         *
         * @return string
         */
        public function getContent()
        {
        return $this->getCurrentTranslation()->getContent();
    }


        /**
         * Set the value of [content] column.
         *
         * @param string $v new value
         * @return $this|\CE\Model\WebsiteModuleI18n The current object (for fluent API support)
         */
        public function setContent($v)
        {    $this->getCurrentTranslation()->setContent($v);

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
