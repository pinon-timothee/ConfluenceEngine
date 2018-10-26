<?php

namespace CE\Model\Base;

use \Exception;
use \PDO;
use CE\Model\WebsiteModule as ChildWebsiteModule;
use CE\Model\WebsiteModuleLocationQuery as ChildWebsiteModuleLocationQuery;
use CE\Model\WebsiteModuleQuery as ChildWebsiteModuleQuery;
use CE\Model\WebsiteRouting as ChildWebsiteRouting;
use CE\Model\WebsiteRoutingQuery as ChildWebsiteRoutingQuery;
use CE\Model\Map\WebsiteModuleLocationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'website_module_location' table.
 *
 *
 *
 * @package    propel.generator.src.CE.Model.Base
 */
abstract class WebsiteModuleLocation implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CE\\Model\\Map\\WebsiteModuleLocationTableMap';


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
     * The value for the website_module_id field.
     *
     * @var        int
     */
    protected $website_module_id;

    /**
     * The value for the website_routing_id field.
     *
     * @var        int
     */
    protected $website_routing_id;

    /**
     * The value for the zone field.
     *
     * @var        string
     */
    protected $zone;

    /**
     * The value for the rank field.
     *
     * @var        int
     */
    protected $rank;

    /**
     * The value for the enable field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $enable;

    /**
     * @var        ChildWebsiteModule
     */
    protected $aWebsiteModule;

    /**
     * @var        ChildWebsiteRouting
     */
    protected $aWebsiteRouting;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

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
     * Initializes internal state of CE\Model\Base\WebsiteModuleLocation object.
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
     * Compares this with another <code>WebsiteModuleLocation</code> instance.  If
     * <code>obj</code> is an instance of <code>WebsiteModuleLocation</code>, delegates to
     * <code>equals(WebsiteModuleLocation)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|WebsiteModuleLocation The current object, for fluid interface
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
     * Get the [website_module_id] column value.
     *
     * @return int
     */
    public function getWebsiteModuleId()
    {
        return $this->website_module_id;
    }

    /**
     * Get the [website_routing_id] column value.
     *
     * @return int
     */
    public function getWebsiteRoutingId()
    {
        return $this->website_routing_id;
    }

    /**
     * Get the [zone] column value.
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Get the [rank] column value.
     *
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [website_module_id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     */
    public function setWebsiteModuleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->website_module_id !== $v) {
            $this->website_module_id = $v;
            $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID] = true;
        }

        if ($this->aWebsiteModule !== null && $this->aWebsiteModule->getId() !== $v) {
            $this->aWebsiteModule = null;
        }

        return $this;
    } // setWebsiteModuleId()

    /**
     * Set the value of [website_routing_id] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     */
    public function setWebsiteRoutingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->website_routing_id !== $v) {
            $this->website_routing_id = $v;
            $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID] = true;
        }

        if ($this->aWebsiteRouting !== null && $this->aWebsiteRouting->getId() !== $v) {
            $this->aWebsiteRouting = null;
        }

        return $this;
    } // setWebsiteRoutingId()

    /**
     * Set the value of [zone] column.
     *
     * @param string $v new value
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     */
    public function setZone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zone !== $v) {
            $this->zone = $v;
            $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_ZONE] = true;
        }

        return $this;
    } // setZone()

    /**
     * Set the value of [rank] column.
     *
     * @param int $v new value
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     */
    public function setRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rank !== $v) {
            $this->rank = $v;
            $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_RANK] = true;
        }

        return $this;
    } // setRank()

    /**
     * Sets the value of the [enable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
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
            $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_ENABLE] = true;
        }

        return $this;
    } // setEnable()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WebsiteModuleLocationTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WebsiteModuleLocationTableMap::translateFieldName('WebsiteModuleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->website_module_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WebsiteModuleLocationTableMap::translateFieldName('WebsiteRoutingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->website_routing_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WebsiteModuleLocationTableMap::translateFieldName('Zone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WebsiteModuleLocationTableMap::translateFieldName('Rank', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rank = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WebsiteModuleLocationTableMap::translateFieldName('Enable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enable = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = WebsiteModuleLocationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CE\\Model\\WebsiteModuleLocation'), 0, $e);
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
        if ($this->aWebsiteModule !== null && $this->website_module_id !== $this->aWebsiteModule->getId()) {
            $this->aWebsiteModule = null;
        }
        if ($this->aWebsiteRouting !== null && $this->website_routing_id !== $this->aWebsiteRouting->getId()) {
            $this->aWebsiteRouting = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(WebsiteModuleLocationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWebsiteModuleLocationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aWebsiteModule = null;
            $this->aWebsiteRouting = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see WebsiteModuleLocation::setDeleted()
     * @see WebsiteModuleLocation::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleLocationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWebsiteModuleLocationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WebsiteModuleLocationTableMap::DATABASE_NAME);
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
                WebsiteModuleLocationTableMap::addInstanceToPool($this);
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

            if ($this->aWebsiteModule !== null) {
                if ($this->aWebsiteModule->isModified() || $this->aWebsiteModule->isNew()) {
                    $affectedRows += $this->aWebsiteModule->save($con);
                }
                $this->setWebsiteModule($this->aWebsiteModule);
            }

            if ($this->aWebsiteRouting !== null) {
                if ($this->aWebsiteRouting->isModified() || $this->aWebsiteRouting->isNew()) {
                    $affectedRows += $this->aWebsiteRouting->save($con);
                }
                $this->setWebsiteRouting($this->aWebsiteRouting);
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

        $this->modifiedColumns[WebsiteModuleLocationTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WebsiteModuleLocationTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`website_module_id`';
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID)) {
            $modifiedColumns[':p' . $index++]  = '`website_routing_id`';
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_ZONE)) {
            $modifiedColumns[':p' . $index++]  = '`zone`';
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_RANK)) {
            $modifiedColumns[':p' . $index++]  = '`rank`';
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_ENABLE)) {
            $modifiedColumns[':p' . $index++]  = '`enable`';
        }

        $sql = sprintf(
            'INSERT INTO `website_module_location` (%s) VALUES (%s)',
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
                    case '`website_module_id`':
                        $stmt->bindValue($identifier, $this->website_module_id, PDO::PARAM_INT);
                        break;
                    case '`website_routing_id`':
                        $stmt->bindValue($identifier, $this->website_routing_id, PDO::PARAM_INT);
                        break;
                    case '`zone`':
                        $stmt->bindValue($identifier, $this->zone, PDO::PARAM_STR);
                        break;
                    case '`rank`':
                        $stmt->bindValue($identifier, $this->rank, PDO::PARAM_INT);
                        break;
                    case '`enable`':
                        $stmt->bindValue($identifier, (int) $this->enable, PDO::PARAM_INT);
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
        $pos = WebsiteModuleLocationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getWebsiteModuleId();
                break;
            case 2:
                return $this->getWebsiteRoutingId();
                break;
            case 3:
                return $this->getZone();
                break;
            case 4:
                return $this->getRank();
                break;
            case 5:
                return $this->getEnable();
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

        if (isset($alreadyDumpedObjects['WebsiteModuleLocation'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['WebsiteModuleLocation'][$this->hashCode()] = true;
        $keys = WebsiteModuleLocationTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getWebsiteModuleId(),
            $keys[2] => $this->getWebsiteRoutingId(),
            $keys[3] => $this->getZone(),
            $keys[4] => $this->getRank(),
            $keys[5] => $this->getEnable(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aWebsiteModule) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteModule';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_module';
                        break;
                    default:
                        $key = 'WebsiteModule';
                }

                $result[$key] = $this->aWebsiteModule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aWebsiteRouting) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'websiteRouting';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'website_routing';
                        break;
                    default:
                        $key = 'WebsiteRouting';
                }

                $result[$key] = $this->aWebsiteRouting->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\CE\Model\WebsiteModuleLocation
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WebsiteModuleLocationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CE\Model\WebsiteModuleLocation
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setWebsiteModuleId($value);
                break;
            case 2:
                $this->setWebsiteRoutingId($value);
                break;
            case 3:
                $this->setZone($value);
                break;
            case 4:
                $this->setRank($value);
                break;
            case 5:
                $this->setEnable($value);
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
        $keys = WebsiteModuleLocationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWebsiteModuleId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setWebsiteRoutingId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setZone($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRank($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEnable($arr[$keys[5]]);
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
     * @return $this|\CE\Model\WebsiteModuleLocation The current object, for fluid interface
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
        $criteria = new Criteria(WebsiteModuleLocationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_ID)) {
            $criteria->add(WebsiteModuleLocationTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID)) {
            $criteria->add(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $this->website_module_id);
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID)) {
            $criteria->add(WebsiteModuleLocationTableMap::COL_WEBSITE_ROUTING_ID, $this->website_routing_id);
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_ZONE)) {
            $criteria->add(WebsiteModuleLocationTableMap::COL_ZONE, $this->zone);
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_RANK)) {
            $criteria->add(WebsiteModuleLocationTableMap::COL_RANK, $this->rank);
        }
        if ($this->isColumnModified(WebsiteModuleLocationTableMap::COL_ENABLE)) {
            $criteria->add(WebsiteModuleLocationTableMap::COL_ENABLE, $this->enable);
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
        $criteria = ChildWebsiteModuleLocationQuery::create();
        $criteria->add(WebsiteModuleLocationTableMap::COL_ID, $this->id);
        $criteria->add(WebsiteModuleLocationTableMap::COL_WEBSITE_MODULE_ID, $this->website_module_id);

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
        $validPk = null !== $this->getId() &&
            null !== $this->getWebsiteModuleId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation website_module_location_fk_2316eb to table website_module
        if ($this->aWebsiteModule && $hash = spl_object_hash($this->aWebsiteModule)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getWebsiteModuleId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setWebsiteModuleId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getWebsiteModuleId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CE\Model\WebsiteModuleLocation (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setWebsiteModuleId($this->getWebsiteModuleId());
        $copyObj->setWebsiteRoutingId($this->getWebsiteRoutingId());
        $copyObj->setZone($this->getZone());
        $copyObj->setRank($this->getRank());
        $copyObj->setEnable($this->getEnable());
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
     * @return \CE\Model\WebsiteModuleLocation Clone of current object.
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
     * Declares an association between this object and a ChildWebsiteModule object.
     *
     * @param  ChildWebsiteModule $v
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setWebsiteModule(ChildWebsiteModule $v = null)
    {
        if ($v === null) {
            $this->setWebsiteModuleId(NULL);
        } else {
            $this->setWebsiteModuleId($v->getId());
        }

        $this->aWebsiteModule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWebsiteModule object, it will not be re-added.
        if ($v !== null) {
            $v->addWebsiteModuleLocation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWebsiteModule object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildWebsiteModule The associated ChildWebsiteModule object.
     * @throws PropelException
     */
    public function getWebsiteModule(ConnectionInterface $con = null)
    {
        if ($this->aWebsiteModule === null && ($this->website_module_id != 0)) {
            $this->aWebsiteModule = ChildWebsiteModuleQuery::create()->findPk($this->website_module_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWebsiteModule->addWebsiteModuleLocations($this);
             */
        }

        return $this->aWebsiteModule;
    }

    /**
     * Declares an association between this object and a ChildWebsiteRouting object.
     *
     * @param  ChildWebsiteRouting $v
     * @return $this|\CE\Model\WebsiteModuleLocation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setWebsiteRouting(ChildWebsiteRouting $v = null)
    {
        if ($v === null) {
            $this->setWebsiteRoutingId(NULL);
        } else {
            $this->setWebsiteRoutingId($v->getId());
        }

        $this->aWebsiteRouting = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWebsiteRouting object, it will not be re-added.
        if ($v !== null) {
            $v->addWebsiteModuleLocation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWebsiteRouting object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildWebsiteRouting The associated ChildWebsiteRouting object.
     * @throws PropelException
     */
    public function getWebsiteRouting(ConnectionInterface $con = null)
    {
        if ($this->aWebsiteRouting === null && ($this->website_routing_id != 0)) {
            $this->aWebsiteRouting = ChildWebsiteRoutingQuery::create()->findPk($this->website_routing_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWebsiteRouting->addWebsiteModuleLocations($this);
             */
        }

        return $this->aWebsiteRouting;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aWebsiteModule) {
            $this->aWebsiteModule->removeWebsiteModuleLocation($this);
        }
        if (null !== $this->aWebsiteRouting) {
            $this->aWebsiteRouting->removeWebsiteModuleLocation($this);
        }
        $this->id = null;
        $this->website_module_id = null;
        $this->website_routing_id = null;
        $this->zone = null;
        $this->rank = null;
        $this->enable = null;
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
        } // if ($deep)

        $this->aWebsiteModule = null;
        $this->aWebsiteRouting = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WebsiteModuleLocationTableMap::DEFAULT_STRING_FORMAT);
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
