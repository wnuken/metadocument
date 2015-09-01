<?php

namespace Map;

use \User;
use \UserQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'metadocument';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\User';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'User';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id field
     */
    const COL_ID = 'user.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'user.name';

    /**
     * the column name for the rut field
     */
    const COL_RUT = 'user.rut';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'user.code';

    /**
     * the column name for the e_mail field
     */
    const COL_E_MAIL = 'user.e_mail';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'user.address';

    /**
     * the column name for the gender field
     */
    const COL_GENDER = 'user.gender';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'user.phone';

    /**
     * the column name for the id_city field
     */
    const COL_ID_CITY = 'user.id_city';

    /**
     * the column name for the id_location field
     */
    const COL_ID_LOCATION = 'user.id_location';

    /**
     * the column name for the id_country field
     */
    const COL_ID_COUNTRY = 'user.id_country';

    /**
     * the column name for the id_nationality field
     */
    const COL_ID_NATIONALITY = 'user.id_nationality';

    /**
     * the column name for the id_type field
     */
    const COL_ID_TYPE = 'user.id_type';

    /**
     * the column name for the id_admin field
     */
    const COL_ID_ADMIN = 'user.id_admin';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Rut', 'Code', 'EMail', 'Address', 'Gender', 'Phone', 'IdCity', 'IdLocation', 'IdCountry', 'IdNationality', 'IdType', 'IdUser', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'rut', 'code', 'eMail', 'address', 'gender', 'phone', 'idCity', 'idLocation', 'idCountry', 'idNationality', 'idType', 'idUser', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_ID, UserTableMap::COL_NAME, UserTableMap::COL_RUT, UserTableMap::COL_CODE, UserTableMap::COL_E_MAIL, UserTableMap::COL_ADDRESS, UserTableMap::COL_GENDER, UserTableMap::COL_PHONE, UserTableMap::COL_ID_CITY, UserTableMap::COL_ID_LOCATION, UserTableMap::COL_ID_COUNTRY, UserTableMap::COL_ID_NATIONALITY, UserTableMap::COL_ID_TYPE, UserTableMap::COL_ID_ADMIN, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'rut', 'code', 'e_mail', 'address', 'gender', 'phone', 'id_city', 'id_location', 'id_country', 'id_nationality', 'id_type', 'id_admin', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Rut' => 2, 'Code' => 3, 'EMail' => 4, 'Address' => 5, 'Gender' => 6, 'Phone' => 7, 'IdCity' => 8, 'IdLocation' => 9, 'IdCountry' => 10, 'IdNationality' => 11, 'IdType' => 12, 'IdUser' => 13, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'rut' => 2, 'code' => 3, 'eMail' => 4, 'address' => 5, 'gender' => 6, 'phone' => 7, 'idCity' => 8, 'idLocation' => 9, 'idCountry' => 10, 'idNationality' => 11, 'idType' => 12, 'idUser' => 13, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_ID => 0, UserTableMap::COL_NAME => 1, UserTableMap::COL_RUT => 2, UserTableMap::COL_CODE => 3, UserTableMap::COL_E_MAIL => 4, UserTableMap::COL_ADDRESS => 5, UserTableMap::COL_GENDER => 6, UserTableMap::COL_PHONE => 7, UserTableMap::COL_ID_CITY => 8, UserTableMap::COL_ID_LOCATION => 9, UserTableMap::COL_ID_COUNTRY => 10, UserTableMap::COL_ID_NATIONALITY => 11, UserTableMap::COL_ID_TYPE => 12, UserTableMap::COL_ID_ADMIN => 13, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'rut' => 2, 'code' => 3, 'e_mail' => 4, 'address' => 5, 'gender' => 6, 'phone' => 7, 'id_city' => 8, 'id_location' => 9, 'id_country' => 10, 'id_nationality' => 11, 'id_type' => 12, 'id_admin' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\User');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 50, null);
        $this->addColumn('rut', 'Rut', 'VARCHAR', false, 50, null);
        $this->addColumn('code', 'Code', 'VARCHAR', false, 50, null);
        $this->addColumn('e_mail', 'EMail', 'VARCHAR', false, 256, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 256, null);
        $this->addColumn('gender', 'Gender', 'VARCHAR', false, 5, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 30, null);
        $this->addColumn('id_city', 'IdCity', 'INTEGER', false, null, null);
        $this->addColumn('id_location', 'IdLocation', 'INTEGER', false, null, null);
        $this->addColumn('id_country', 'IdCountry', 'INTEGER', false, null, null);
        $this->addColumn('id_nationality', 'IdNationality', 'INTEGER', false, null, null);
        $this->addColumn('id_type', 'IdType', 'INTEGER', false, null, null);
        $this->addColumn('id_admin', 'IdUser', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (User object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserTableMap::COL_ID);
            $criteria->addSelectColumn(UserTableMap::COL_NAME);
            $criteria->addSelectColumn(UserTableMap::COL_RUT);
            $criteria->addSelectColumn(UserTableMap::COL_CODE);
            $criteria->addSelectColumn(UserTableMap::COL_E_MAIL);
            $criteria->addSelectColumn(UserTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(UserTableMap::COL_GENDER);
            $criteria->addSelectColumn(UserTableMap::COL_PHONE);
            $criteria->addSelectColumn(UserTableMap::COL_ID_CITY);
            $criteria->addSelectColumn(UserTableMap::COL_ID_LOCATION);
            $criteria->addSelectColumn(UserTableMap::COL_ID_COUNTRY);
            $criteria->addSelectColumn(UserTableMap::COL_ID_NATIONALITY);
            $criteria->addSelectColumn(UserTableMap::COL_ID_TYPE);
            $criteria->addSelectColumn(UserTableMap::COL_ID_ADMIN);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.rut');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.e_mail');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.id_city');
            $criteria->addSelectColumn($alias . '.id_location');
            $criteria->addSelectColumn($alias . '.id_country');
            $criteria->addSelectColumn($alias . '.id_nationality');
            $criteria->addSelectColumn($alias . '.id_type');
            $criteria->addSelectColumn($alias . '.id_admin');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or User object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed               $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserTableMap::COL_ID) && $criteria->keyContainsValue(UserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserTableMap::buildTableMap();
