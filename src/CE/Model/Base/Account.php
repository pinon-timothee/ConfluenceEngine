<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\Account as ChildAccount;
use CE\Model\AccountQuery as ChildAccountQuery;
use CE\Model\User as ChildUser;
use CE\Model\UserQuery as ChildUserQuery;
use CE\Model\Website as ChildWebsite;
use CE\Model\WebsiteQuery as ChildWebsiteQuery;
use CE\Model\Map\AccountTableMap;
use CE\Model\Map\UserTableMap;
use CE\Model\Map\WebsiteTableMap;
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
 * Base class that represents a row from the 'account' table.
 *
 *
 *
 * @package    propel.generator.src.CE.Model.Base
 */
abstract class Account implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CE\\Model\\Map\\AccountTableMap';


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
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the display_name field.
     *
     * @var        string
     */
    protected $display_name;

    /**
     * The value for the url field.
     *
     * @var        string
     */
    protected $url;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the zipcode field.
     *
     * @var        string
     */
    protected $zipcode;

    /**
     * The value for the city field.
     *
     * @var        string
     */
    protected $city;

    /**
     * The value for the country field.
     *
     * @var        string
     */
    protected $country;

    /**
     * The value for the legal field.
     *
     * @var        string
     */
    protected $legal;

    /**
     * The value for the logo field.
     *
     * @var        string
     */
    protected $logo;

    /**
     * The value for the credits_logo field.
     *
     * @var        string
     */
    protected $credits_logo;

    /**
     * The value for the fqdn field.
     *
     * @var        string
     */
    protected $fqdn;

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
     * The value for the cultures field.
     *
     * @var        string
     */
    protected $cultures;

    /**
     * The value for the currencies field.
     *
     * @var        string
     */
    protected $currencies;

    /**
     * @var        ObjectCollection|ChildUser[] Collection to store aggregation of ChildUser objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

    /**
     * @var        ObjectCollection|ChildWebsite[] Collection to store aggregation of ChildWebsite objects.
     */
    protected $collWebsites;
    protected $collWebsitesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWebsite[]
     */
    protected $websitesScheduledForDeletion = null;

    /**
     * Initializes internal state of CE\Model\Base\Account object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>Account</code> instance.  If
     * <code>obj</code> is an instance of <code>Account</code>, delegates to
     * <code>equals(Account)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Account The current object, for fluid interface
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [display_name] column value.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Get the [url] column value.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [zipcode] column value.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [legal] column value.
     *
     * @return string
     */
    public function getLegal()
    {
        return $this->legal;
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
     * Get the [credits_logo] column value.
     *
     * @return string
     */
    public function getCreditsLogo()
    {
        return $this->credits_logo;
    }

    /**
     * Get the [fqdn] column value.
     *
     * @return string
     */
    public function getFqdn()
    {
        return $this->fqdn;
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
     * Get the [cultures] column value.
     *
     * @return string
     */
    public function getCultures()
    {
        return $this->cultures;
    }

    /**
     * Get the [currencies] column value.
     *
     * @return string
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[AccountTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[AccountTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [display_name] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setDisplayName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->display_name !== $v) {
            $this->display_name = $v;
            $this->modifiedColumns[AccountTableMap::COL_DISPLAY_NAME] = true;
        }

        return $this;
    } // setDisplayName()

    /**
     * Set the value of [url] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[AccountTableMap::COL_URL] = true;
        }

        return $this;
    } // setUrl()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[AccountTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[AccountTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[AccountTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [zipcode] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setZipcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zipcode !== $v) {
            $this->zipcode = $v;
            $this->modifiedColumns[AccountTableMap::COL_ZIPCODE] = true;
        }

        return $this;
    } // setZipcode()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[AccountTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[AccountTableMap::COL_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Set the value of [legal] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setLegal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->legal !== $v) {
            $this->legal = $v;
            $this->modifiedColumns[AccountTableMap::COL_LEGAL] = true;
        }

        return $this;
    } // setLegal()

    /**
     * Set the value of [logo] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setLogo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->logo !== $v) {
            $this->logo = $v;
            $this->modifiedColumns[AccountTableMap::COL_LOGO] = true;
        }

        return $this;
    } // setLogo()

    /**
     * Set the value of [credits_logo] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setCreditsLogo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->credits_logo !== $v) {
            $this->credits_logo = $v;
            $this->modifiedColumns[AccountTableMap::COL_CREDITS_LOGO] = true;
        }

        return $this;
    } // setCreditsLogo()

    /**
     * Set the value of [fqdn] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setFqdn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fqdn !== $v) {
            $this->fqdn = $v;
            $this->modifiedColumns[AccountTableMap::COL_FQDN] = true;
        }

        return $this;
    } // setFqdn()

    /**
     * Set the value of [wrapper] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setWrapper($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wrapper !== $v) {
            $this->wrapper = $v;
            $this->modifiedColumns[AccountTableMap::COL_WRAPPER] = true;
        }

        return $this;
    } // setWrapper()

    /**
     * Set the value of [wrapper_params] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setWrapperParams($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wrapper_params !== $v) {
            $this->wrapper_params = $v;
            $this->modifiedColumns[AccountTableMap::COL_WRAPPER_PARAMS] = true;
        }

        return $this;
    } // setWrapperParams()

    /**
     * Set the value of [cultures] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setCultures($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cultures !== $v) {
            $this->cultures = $v;
            $this->modifiedColumns[AccountTableMap::COL_CULTURES] = true;
        }

        return $this;
    } // setCultures()

    /**
     * Set the value of [currencies] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function setCurrencies($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->currencies !== $v) {
            $this->currencies = $v;
            $this->modifiedColumns[AccountTableMap::COL_CURRENCIES] = true;
        }

        return $this;
    } // setCurrencies()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AccountTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AccountTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AccountTableMap::translateFieldName('DisplayName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->display_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AccountTableMap::translateFieldName('Url', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AccountTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AccountTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AccountTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AccountTableMap::translateFieldName('Zipcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zipcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AccountTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AccountTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AccountTableMap::translateFieldName('Legal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->legal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AccountTableMap::translateFieldName('Logo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->logo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : AccountTableMap::translateFieldName('CreditsLogo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->credits_logo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : AccountTableMap::translateFieldName('Fqdn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fqdn = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : AccountTableMap::translateFieldName('Wrapper', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wrapper = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : AccountTableMap::translateFieldName('WrapperParams', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wrapper_params = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : AccountTableMap::translateFieldName('Cultures', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cultures = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : AccountTableMap::translateFieldName('Currencies', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currencies = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = AccountTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CE\\Model\\Account'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(AccountTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAccountQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collUsers = null;

            $this->collWebsites = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Account::setDeleted()
     * @see Account::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAccountQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
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
                AccountTableMap::addInstanceToPool($this);
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

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersScheduledForDeletion as $user) {
                        // need to save related object because we set the relation to null
                        $user->save($con);
                    }
                    $this->usersScheduledForDeletion = null;
                }
            }

            if ($this->collUsers !== null) {
                foreach ($this->collUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->websitesScheduledForDeletion !== null) {
                if (!$this->websitesScheduledForDeletion->isEmpty()) {
                    foreach ($this->websitesScheduledForDeletion as $website) {
                        // need to save related object because we set the relation to null
                        $website->save($con);
                    }
                    $this->websitesScheduledForDeletion = null;
                }
            }

            if ($this->collWebsites !== null) {
                foreach ($this->collWebsites as $referrerFK) {
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

        $this->modifiedColumns[AccountTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AccountTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AccountTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_DISPLAY_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`display_name`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_URL)) {
            $modifiedColumns[':p' . $index++]  = '`url`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`phone`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`address`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_ZIPCODE)) {
            $modifiedColumns[':p' . $index++]  = '`zipcode`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = '`city`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`country`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_LEGAL)) {
            $modifiedColumns[':p' . $index++]  = '`legal`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_LOGO)) {
            $modifiedColumns[':p' . $index++]  = '`logo`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_CREDITS_LOGO)) {
            $modifiedColumns[':p' . $index++]  = '`credits_logo`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_FQDN)) {
            $modifiedColumns[':p' . $index++]  = '`fqdn`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_WRAPPER)) {
            $modifiedColumns[':p' . $index++]  = '`wrapper`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_WRAPPER_PARAMS)) {
            $modifiedColumns[':p' . $index++]  = '`wrapper_params`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_CULTURES)) {
            $modifiedColumns[':p' . $index++]  = '`cultures`';
        }
        if ($this->isColumnModified(AccountTableMap::COL_CURRENCIES)) {
            $modifiedColumns[':p' . $index++]  = '`currencies`';
        }

        $sql = sprintf(
            'INSERT INTO `account` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`display_name`':
                        $stmt->bindValue($identifier, $this->display_name, PDO::PARAM_STR);
                        break;
                    case '`url`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case '`phone`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`address`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`zipcode`':
                        $stmt->bindValue($identifier, $this->zipcode, PDO::PARAM_STR);
                        break;
                    case '`city`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`country`':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case '`legal`':
                        $stmt->bindValue($identifier, $this->legal, PDO::PARAM_STR);
                        break;
                    case '`logo`':
                        $stmt->bindValue($identifier, $this->logo, PDO::PARAM_STR);
                        break;
                    case '`credits_logo`':
                        $stmt->bindValue($identifier, $this->credits_logo, PDO::PARAM_STR);
                        break;
                    case '`fqdn`':
                        $stmt->bindValue($identifier, $this->fqdn, PDO::PARAM_STR);
                        break;
                    case '`wrapper`':
                        $stmt->bindValue($identifier, $this->wrapper, PDO::PARAM_STR);
                        break;
                    case '`wrapper_params`':
                        $stmt->bindValue($identifier, $this->wrapper_params, PDO::PARAM_STR);
                        break;
                    case '`cultures`':
                        $stmt->bindValue($identifier, $this->cultures, PDO::PARAM_STR);
                        break;
                    case '`currencies`':
                        $stmt->bindValue($identifier, $this->currencies, PDO::PARAM_STR);
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
        $pos = AccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getDisplayName();
                break;
            case 3:
                return $this->getUrl();
                break;
            case 4:
                return $this->getPhone();
                break;
            case 5:
                return $this->getEmail();
                break;
            case 6:
                return $this->getAddress();
                break;
            case 7:
                return $this->getZipcode();
                break;
            case 8:
                return $this->getCity();
                break;
            case 9:
                return $this->getCountry();
                break;
            case 10:
                return $this->getLegal();
                break;
            case 11:
                return $this->getLogo();
                break;
            case 12:
                return $this->getCreditsLogo();
                break;
            case 13:
                return $this->getFqdn();
                break;
            case 14:
                return $this->getWrapper();
                break;
            case 15:
                return $this->getWrapperParams();
                break;
            case 16:
                return $this->getCultures();
                break;
            case 17:
                return $this->getCurrencies();
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

        if (isset($alreadyDumpedObjects['Account'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Account'][$this->hashCode()] = true;
        $keys = AccountTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDisplayName(),
            $keys[3] => $this->getUrl(),
            $keys[4] => $this->getPhone(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getAddress(),
            $keys[7] => $this->getZipcode(),
            $keys[8] => $this->getCity(),
            $keys[9] => $this->getCountry(),
            $keys[10] => $this->getLegal(),
            $keys[11] => $this->getLogo(),
            $keys[12] => $this->getCreditsLogo(),
            $keys[13] => $this->getFqdn(),
            $keys[14] => $this->getWrapper(),
            $keys[15] => $this->getWrapperParams(),
            $keys[16] => $this->getCultures(),
            $keys[17] => $this->getCurrencies(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->collUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWebsites) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websites';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'websites';
                        break;
                    default:
                        $key = 'Websites';
                }

                $result[$key] = $this->collWebsites->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\CE\Model\Account
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CE\Model\Account
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setDisplayName($value);
                break;
            case 3:
                $this->setUrl($value);
                break;
            case 4:
                $this->setPhone($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setAddress($value);
                break;
            case 7:
                $this->setZipcode($value);
                break;
            case 8:
                $this->setCity($value);
                break;
            case 9:
                $this->setCountry($value);
                break;
            case 10:
                $this->setLegal($value);
                break;
            case 11:
                $this->setLogo($value);
                break;
            case 12:
                $this->setCreditsLogo($value);
                break;
            case 13:
                $this->setFqdn($value);
                break;
            case 14:
                $this->setWrapper($value);
                break;
            case 15:
                $this->setWrapperParams($value);
                break;
            case 16:
                $this->setCultures($value);
                break;
            case 17:
                $this->setCurrencies($value);
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
        $keys = AccountTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDisplayName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUrl($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPhone($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddress($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setZipcode($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCity($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCountry($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLegal($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLogo($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreditsLogo($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setFqdn($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setWrapper($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setWrapperParams($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCultures($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCurrencies($arr[$keys[17]]);
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
     * @return $this|\CE\Model\Account The current object, for fluid interface
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
        $criteria = new Criteria(AccountTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AccountTableMap::COL_ID)) {
            $criteria->add(AccountTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(AccountTableMap::COL_NAME)) {
            $criteria->add(AccountTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(AccountTableMap::COL_DISPLAY_NAME)) {
            $criteria->add(AccountTableMap::COL_DISPLAY_NAME, $this->display_name);
        }
        if ($this->isColumnModified(AccountTableMap::COL_URL)) {
            $criteria->add(AccountTableMap::COL_URL, $this->url);
        }
        if ($this->isColumnModified(AccountTableMap::COL_PHONE)) {
            $criteria->add(AccountTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(AccountTableMap::COL_EMAIL)) {
            $criteria->add(AccountTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ADDRESS)) {
            $criteria->add(AccountTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(AccountTableMap::COL_ZIPCODE)) {
            $criteria->add(AccountTableMap::COL_ZIPCODE, $this->zipcode);
        }
        if ($this->isColumnModified(AccountTableMap::COL_CITY)) {
            $criteria->add(AccountTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(AccountTableMap::COL_COUNTRY)) {
            $criteria->add(AccountTableMap::COL_COUNTRY, $this->country);
        }
        if ($this->isColumnModified(AccountTableMap::COL_LEGAL)) {
            $criteria->add(AccountTableMap::COL_LEGAL, $this->legal);
        }
        if ($this->isColumnModified(AccountTableMap::COL_LOGO)) {
            $criteria->add(AccountTableMap::COL_LOGO, $this->logo);
        }
        if ($this->isColumnModified(AccountTableMap::COL_CREDITS_LOGO)) {
            $criteria->add(AccountTableMap::COL_CREDITS_LOGO, $this->credits_logo);
        }
        if ($this->isColumnModified(AccountTableMap::COL_FQDN)) {
            $criteria->add(AccountTableMap::COL_FQDN, $this->fqdn);
        }
        if ($this->isColumnModified(AccountTableMap::COL_WRAPPER)) {
            $criteria->add(AccountTableMap::COL_WRAPPER, $this->wrapper);
        }
        if ($this->isColumnModified(AccountTableMap::COL_WRAPPER_PARAMS)) {
            $criteria->add(AccountTableMap::COL_WRAPPER_PARAMS, $this->wrapper_params);
        }
        if ($this->isColumnModified(AccountTableMap::COL_CULTURES)) {
            $criteria->add(AccountTableMap::COL_CULTURES, $this->cultures);
        }
        if ($this->isColumnModified(AccountTableMap::COL_CURRENCIES)) {
            $criteria->add(AccountTableMap::COL_CURRENCIES, $this->currencies);
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
        $criteria = ChildAccountQuery::create();
        $criteria->add(AccountTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \CE\Model\Account (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDisplayName($this->getDisplayName());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setZipcode($this->getZipcode());
        $copyObj->setCity($this->getCity());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setLegal($this->getLegal());
        $copyObj->setLogo($this->getLogo());
        $copyObj->setCreditsLogo($this->getCreditsLogo());
        $copyObj->setFqdn($this->getFqdn());
        $copyObj->setWrapper($this->getWrapper());
        $copyObj->setWrapperParams($this->getWrapperParams());
        $copyObj->setCultures($this->getCultures());
        $copyObj->setCurrencies($this->getCurrencies());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWebsites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWebsite($relObj->copy($deepCopy));
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
     * @return \CE\Model\Account Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('User' == $relationName) {
            $this->initUsers();
            return;
        }
        if ('Website' == $relationName) {
            $this->initWebsites();
            return;
        }
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsers collection loaded partially.
     */
    public function resetPartialUsers($v = true)
    {
        $this->collUsersPartial = $v;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty array (like clearcollUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsers($overrideExisting = true)
    {
        if (null !== $this->collUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserTableMap::getTableMap()->getCollectionClassName();

        $this->collUsers = new $collectionClassName;
        $this->collUsers->setModel('\CE\Model\User');
    }

    /**
     * Gets an array of ChildUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     * @throws PropelException
     */
    public function getUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = ChildUserQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsersPartial && count($collUsers)) {
                        $this->initUsers(false);

                        foreach ($collUsers as $obj) {
                            if (false == $this->collUsers->contains($obj)) {
                                $this->collUsers->append($obj);
                            }
                        }

                        $this->collUsersPartial = true;
                    }

                    return $collUsers;
                }

                if ($partial && $this->collUsers) {
                    foreach ($this->collUsers as $obj) {
                        if ($obj->isNew()) {
                            $collUsers[] = $obj;
                        }
                    }
                }

                $this->collUsers = $collUsers;
                $this->collUsersPartial = false;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of ChildUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $users A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setUsers(Collection $users, ConnectionInterface $con = null)
    {
        /** @var ChildUser[] $usersToDelete */
        $usersToDelete = $this->getUsers(new Criteria(), $con)->diff($users);


        $this->usersScheduledForDeletion = $usersToDelete;

        foreach ($usersToDelete as $userRemoved) {
            $userRemoved->setAccount(null);
        }

        $this->collUsers = null;
        foreach ($users as $user) {
            $this->addUser($user);
        }

        $this->collUsers = $users;
        $this->collUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsers());
            }

            $query = ChildUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collUsers);
    }

    /**
     * Method called to associate a ChildUser object to this object
     * through the ChildUser foreign key attribute.
     *
     * @param  ChildUser $l ChildUser
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function addUser(ChildUser $l)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
            $this->collUsersPartial = true;
        }

        if (!$this->collUsers->contains($l)) {
            $this->doAddUser($l);

            if ($this->usersScheduledForDeletion and $this->usersScheduledForDeletion->contains($l)) {
                $this->usersScheduledForDeletion->remove($this->usersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUser $user The ChildUser object to add.
     */
    protected function doAddUser(ChildUser $user)
    {
        $this->collUsers[]= $user;
        $user->setAccount($this);
    }

    /**
     * @param  ChildUser $user The ChildUser object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeUser(ChildUser $user)
    {
        if ($this->getUsers()->contains($user)) {
            $pos = $this->collUsers->search($user);
            $this->collUsers->remove($pos);
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= $user;
            $user->setAccount(null);
        }

        return $this;
    }

    /**
     * Clears out the collWebsites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWebsites()
     */
    public function clearWebsites()
    {
        $this->collWebsites = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWebsites collection loaded partially.
     */
    public function resetPartialWebsites($v = true)
    {
        $this->collWebsitesPartial = $v;
    }

    /**
     * Initializes the collWebsites collection.
     *
     * By default this just sets the collWebsites collection to an empty array (like clearcollWebsites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWebsites($overrideExisting = true)
    {
        if (null !== $this->collWebsites && !$overrideExisting) {
            return;
        }

        $collectionClassName = WebsiteTableMap::getTableMap()->getCollectionClassName();

        $this->collWebsites = new $collectionClassName;
        $this->collWebsites->setModel('\CE\Model\Website');
    }

    /**
     * Gets an array of ChildWebsite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWebsite[] List of ChildWebsite objects
     * @throws PropelException
     */
    public function getWebsites(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsitesPartial && !$this->isNew();
        if (null === $this->collWebsites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collWebsites) {
                // return empty collection
                $this->initWebsites();
            } else {
                $collWebsites = ChildWebsiteQuery::create(null, $criteria)
                    ->filterByAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWebsitesPartial && count($collWebsites)) {
                        $this->initWebsites(false);

                        foreach ($collWebsites as $obj) {
                            if (false == $this->collWebsites->contains($obj)) {
                                $this->collWebsites->append($obj);
                            }
                        }

                        $this->collWebsitesPartial = true;
                    }

                    return $collWebsites;
                }

                if ($partial && $this->collWebsites) {
                    foreach ($this->collWebsites as $obj) {
                        if ($obj->isNew()) {
                            $collWebsites[] = $obj;
                        }
                    }
                }

                $this->collWebsites = $collWebsites;
                $this->collWebsitesPartial = false;
            }
        }

        return $this->collWebsites;
    }

    /**
     * Sets a collection of ChildWebsite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $websites A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function setWebsites(Collection $websites, ConnectionInterface $con = null)
    {
        /** @var ChildWebsite[] $websitesToDelete */
        $websitesToDelete = $this->getWebsites(new Criteria(), $con)->diff($websites);


        $this->websitesScheduledForDeletion = $websitesToDelete;

        foreach ($websitesToDelete as $websiteRemoved) {
            $websiteRemoved->setAccount(null);
        }

        $this->collWebsites = null;
        foreach ($websites as $website) {
            $this->addWebsite($website);
        }

        $this->collWebsites = $websites;
        $this->collWebsitesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Website objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Website objects.
     * @throws PropelException
     */
    public function countWebsites(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWebsitesPartial && !$this->isNew();
        if (null === $this->collWebsites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWebsites) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWebsites());
            }

            $query = ChildWebsiteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAccount($this)
                ->count($con);
        }

        return count($this->collWebsites);
    }

    /**
     * Method called to associate a ChildWebsite object to this object
     * through the ChildWebsite foreign key attribute.
     *
     * @param  ChildWebsite $l ChildWebsite
     * @return $this|\CE\Model\Account The current object (for fluent API support)
     */
    public function addWebsite(ChildWebsite $l)
    {
        if ($this->collWebsites === null) {
            $this->initWebsites();
            $this->collWebsitesPartial = true;
        }

        if (!$this->collWebsites->contains($l)) {
            $this->doAddWebsite($l);

            if ($this->websitesScheduledForDeletion and $this->websitesScheduledForDeletion->contains($l)) {
                $this->websitesScheduledForDeletion->remove($this->websitesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWebsite $website The ChildWebsite object to add.
     */
    protected function doAddWebsite(ChildWebsite $website)
    {
        $this->collWebsites[]= $website;
        $website->setAccount($this);
    }

    /**
     * @param  ChildWebsite $website The ChildWebsite object to remove.
     * @return $this|ChildAccount The current object (for fluent API support)
     */
    public function removeWebsite(ChildWebsite $website)
    {
        if ($this->getWebsites()->contains($website)) {
            $pos = $this->collWebsites->search($website);
            $this->collWebsites->remove($pos);
            if (null === $this->websitesScheduledForDeletion) {
                $this->websitesScheduledForDeletion = clone $this->collWebsites;
                $this->websitesScheduledForDeletion->clear();
            }
            $this->websitesScheduledForDeletion[]= $website;
            $website->setAccount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Account is new, it will return
     * an empty collection; or if this Account has previously
     * been saved, it will retrieve related Websites from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Account.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWebsite[] List of ChildWebsite objects
     */
    public function getWebsitesJoinStep(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWebsiteQuery::create(null, $criteria);
        $query->joinWith('Step', $joinBehavior);

        return $this->getWebsites($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->display_name = null;
        $this->url = null;
        $this->phone = null;
        $this->email = null;
        $this->address = null;
        $this->zipcode = null;
        $this->city = null;
        $this->country = null;
        $this->legal = null;
        $this->logo = null;
        $this->credits_logo = null;
        $this->fqdn = null;
        $this->wrapper = null;
        $this->wrapper_params = null;
        $this->cultures = null;
        $this->currencies = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWebsites) {
                foreach ($this->collWebsites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUsers = null;
        $this->collWebsites = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AccountTableMap::DEFAULT_STRING_FORMAT);
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
