<?php

namespace Acme\MovieBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Acme\MovieBundle\Model\ActorHasMovie;
use Acme\MovieBundle\Model\ActorHasMovieQuery;
use Acme\MovieBundle\Model\ActorPeer;
use Acme\MovieBundle\Model\ActorQuery;
use Acme\MovieBundle\Model\Movie;
use Acme\MovieBundle\Model\MovieQuery;

/**
 * Base class that represents a row from the 'actors' table.
 *
 * 
 *
 * @package    propel.generator.src.Acme.MovieBundle.Model.om
 */
abstract class BaseActor extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'Acme\\MovieBundle\\Model\\ActorPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ActorPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * @var        array ActorHasMovie[] Collection to store aggregation of ActorHasMovie objects.
	 */
	protected $collActorHasMovies;

	/**
	 * @var        array Movie[] Collection to store aggregation of Movie objects.
	 */
	protected $collMovies;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $moviesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $actorHasMoviesScheduledForDeletion = null;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ActorPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ActorPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 2; // 2 = ActorPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Actor object", $e);
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
	 * @throws     PropelException
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
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ActorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collActorHasMovies = null;

			$this->collMovies = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ActorQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
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
				ActorPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->moviesScheduledForDeletion !== null) {
				if (!$this->moviesScheduledForDeletion->isEmpty()) {
					ActorHasMovieQuery::create()
						->filterByPrimaryKeys($this->moviesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->moviesScheduledForDeletion = null;
				}

				foreach ($this->getMovies() as $movie) {
					if ($movie->isModified()) {
						$movie->save($con);
					}
				}
			}

			if ($this->actorHasMoviesScheduledForDeletion !== null) {
				if (!$this->actorHasMoviesScheduledForDeletion->isEmpty()) {
					ActorHasMovieQuery::create()
						->filterByPrimaryKeys($this->actorHasMoviesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->actorHasMoviesScheduledForDeletion = null;
				}
			}

			if ($this->collActorHasMovies !== null) {
				foreach ($this->collActorHasMovies as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
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
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = ActorPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ActorPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ActorPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(ActorPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}

		$sql = sprintf(
			'INSERT INTO `actors` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = ActorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collActorHasMovies !== null) {
					foreach ($this->collActorHasMovies as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
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
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Actor'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Actor'][$this->getPrimaryKey()] = true;
		$keys = ActorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collActorHasMovies) {
				$result['ActorHasMovies'] = $this->collActorHasMovies->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
		} // switch()
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
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ActorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ActorPeer::DATABASE_NAME);

		if ($this->isColumnModified(ActorPeer::ID)) $criteria->add(ActorPeer::ID, $this->id);
		if ($this->isColumnModified(ActorPeer::NAME)) $criteria->add(ActorPeer::NAME, $this->name);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ActorPeer::DATABASE_NAME);
		$criteria->add(ActorPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
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
	 * @param      object $copyObj An object of Actor (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setName($this->getName());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getActorHasMovies() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addActorHasMovie($relObj->copy($deepCopy));
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
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Actor Clone of current object.
	 * @throws     PropelException
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
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ActorPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ActorPeer();
		}
		return self::$peer;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('ActorHasMovie' == $relationName) {
			return $this->initActorHasMovies();
		}
	}

	/**
	 * Clears out the collActorHasMovies collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addActorHasMovies()
	 */
	public function clearActorHasMovies()
	{
		$this->collActorHasMovies = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collActorHasMovies collection.
	 *
	 * By default this just sets the collActorHasMovies collection to an empty array (like clearcollActorHasMovies());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initActorHasMovies($overrideExisting = true)
	{
		if (null !== $this->collActorHasMovies && !$overrideExisting) {
			return;
		}
		$this->collActorHasMovies = new PropelObjectCollection();
		$this->collActorHasMovies->setModel('ActorHasMovie');
	}

	/**
	 * Gets an array of ActorHasMovie objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ActorHasMovie[] List of ActorHasMovie objects
	 * @throws     PropelException
	 */
	public function getActorHasMovies($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collActorHasMovies || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorHasMovies) {
				// return empty collection
				$this->initActorHasMovies();
			} else {
				$collActorHasMovies = ActorHasMovieQuery::create(null, $criteria)
					->filterByActor($this)
					->find($con);
				if (null !== $criteria) {
					return $collActorHasMovies;
				}
				$this->collActorHasMovies = $collActorHasMovies;
			}
		}
		return $this->collActorHasMovies;
	}

	/**
	 * Sets a collection of ActorHasMovie objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $actorHasMovies A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setActorHasMovies(PropelCollection $actorHasMovies, PropelPDO $con = null)
	{
		$this->actorHasMoviesScheduledForDeletion = $this->getActorHasMovies(new Criteria(), $con)->diff($actorHasMovies);

		foreach ($actorHasMovies as $actorHasMovie) {
			// Fix issue with collection modified by reference
			if ($actorHasMovie->isNew()) {
				$actorHasMovie->setActor($this);
			}
			$this->addActorHasMovie($actorHasMovie);
		}

		$this->collActorHasMovies = $actorHasMovies;
	}

	/**
	 * Returns the number of related ActorHasMovie objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ActorHasMovie objects.
	 * @throws     PropelException
	 */
	public function countActorHasMovies(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collActorHasMovies || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorHasMovies) {
				return 0;
			} else {
				$query = ActorHasMovieQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActor($this)
					->count($con);
			}
		} else {
			return count($this->collActorHasMovies);
		}
	}

	/**
	 * Method called to associate a ActorHasMovie object to this object
	 * through the ActorHasMovie foreign key attribute.
	 *
	 * @param      ActorHasMovie $l ActorHasMovie
	 * @return     Actor The current object (for fluent API support)
	 */
	public function addActorHasMovie(ActorHasMovie $l)
	{
		if ($this->collActorHasMovies === null) {
			$this->initActorHasMovies();
		}
		if (!$this->collActorHasMovies->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddActorHasMovie($l);
		}

		return $this;
	}

	/**
	 * @param	ActorHasMovie $actorHasMovie The actorHasMovie object to add.
	 */
	protected function doAddActorHasMovie($actorHasMovie)
	{
		$this->collActorHasMovies[]= $actorHasMovie;
		$actorHasMovie->setActor($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related ActorHasMovies from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ActorHasMovie[] List of ActorHasMovie objects
	 */
	public function getActorHasMoviesJoinMovie($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ActorHasMovieQuery::create(null, $criteria);
		$query->joinWith('Movie', $join_behavior);

		return $this->getActorHasMovies($query, $con);
	}

	/**
	 * Clears out the collMovies collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMovies()
	 */
	public function clearMovies()
	{
		$this->collMovies = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMovies collection.
	 *
	 * By default this just sets the collMovies collection to an empty collection (like clearMovies());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initMovies()
	{
		$this->collMovies = new PropelObjectCollection();
		$this->collMovies->setModel('Movie');
	}

	/**
	 * Gets a collection of Movie objects related by a many-to-many relationship
	 * to the current object by way of the actors_movies cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array Movie[] List of Movie objects
	 */
	public function getMovies($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMovies || null !== $criteria) {
			if ($this->isNew() && null === $this->collMovies) {
				// return empty collection
				$this->initMovies();
			} else {
				$collMovies = MovieQuery::create(null, $criteria)
					->filterByActor($this)
					->find($con);
				if (null !== $criteria) {
					return $collMovies;
				}
				$this->collMovies = $collMovies;
			}
		}
		return $this->collMovies;
	}

	/**
	 * Sets a collection of Movie objects related by a many-to-many relationship
	 * to the current object by way of the actors_movies cross-reference table.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $movies A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setMovies(PropelCollection $movies, PropelPDO $con = null)
	{
		$actorHasMovies = ActorHasMovieQuery::create()
			->filterByMovie($movies)
			->filterByActor($this)
			->find($con);

		$this->moviesScheduledForDeletion = $this->getActorHasMovies()->diff($actorHasMovies);
		$this->collActorHasMovies = $actorHasMovies;

		foreach ($movies as $movie) {
			// Fix issue with collection modified by reference
			if ($movie->isNew()) {
				$this->doAddMovie($movie);
			} else {
				$this->addMovie($movie);
			}
		}

		$this->collMovies = $movies;
	}

	/**
	 * Gets the number of Movie objects related by a many-to-many relationship
	 * to the current object by way of the actors_movies cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related Movie objects
	 */
	public function countMovies($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMovies || null !== $criteria) {
			if ($this->isNew() && null === $this->collMovies) {
				return 0;
			} else {
				$query = MovieQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActor($this)
					->count($con);
			}
		} else {
			return count($this->collMovies);
		}
	}

	/**
	 * Associate a Movie object to this object
	 * through the actors_movies cross reference table.
	 *
	 * @param      Movie $movie The ActorHasMovie object to relate
	 * @return     void
	 */
	public function addMovie($movie)
	{
		if ($this->collMovies === null) {
			$this->initMovies();
		}
		if (!$this->collMovies->contains($movie)) { // only add it if the **same** object is not already associated
			$this->doAddMovie($movie);

			$this->collMovies[]= $movie;
		}
	}

	/**
	 * @param	Movie $movie The movie object to add.
	 */
	protected function doAddMovie($movie)
	{
		$actorHasMovie = new ActorHasMovie();
		$actorHasMovie->setMovie($movie);
		$this->addActorHasMovie($actorHasMovie);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collActorHasMovies) {
				foreach ($this->collActorHasMovies as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMovies) {
				foreach ($this->collMovies as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collActorHasMovies instanceof PropelCollection) {
			$this->collActorHasMovies->clearIterator();
		}
		$this->collActorHasMovies = null;
		if ($this->collMovies instanceof PropelCollection) {
			$this->collMovies->clearIterator();
		}
		$this->collMovies = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string The value of the 'name' column
	 */
	public function __toString()
	{
		return (string) $this->getName();
	}

} // BaseActor
