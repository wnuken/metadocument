<?php

namespace Map;

use \Cities;
use \CitiesQuery;
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
 * This class defines the structure of the 'cities' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CitiesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CitiesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'metadocument';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'cities';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Cities';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Cities';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'cities.id';

    /**
     * the column name for the city_name field
     */
    const COL_CITY_NAME = 'cities.city_name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'cities.description';

    /**
     * the column name for the iso_code field
     */
    const COL_ISO_CODE = 'cities.iso_code';

    /**
     * the column name for the id_location field
     */
    const COL_ID_LOCATION = 'cities.id_location';

    /**
     * the column name for the id_country field
     */
    const COL_ID_COUNTRY = 'cities.id_country';

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
        self::TYPE_PHPNAME       => array('Id', 'CityName', 'Description', 'IsoCode', 'IdLocation', 'IdCountry', ),
        self::TYPE_CAMELNAME     => array('id', 'cityName', 'description', 'isoCode', 'idLocation', 'idCountry', ),
        self::TYPE_COLNAME       => array(CitiesTableMap::COL_ID, CitiesTableMap::COL_CITY_NAME, CitiesTableMap::COL_DESCRIPTION, CitiesTableMap::COL_ISO_CODE, CitiesTableMap::COL_ID_LOCATION, CitiesTableMap::COL_ID_COUNTRY, ),
        self::TYPE_FIELDNAME     => array('id', 'city_name', 'description', 'iso_code', 'id_location', 'id_country', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CityName' => 1, 'Description' => 2, 'IsoCode' => 3, 'IdLocation' => 4, 'IdCountry' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'cityName' => 1, 'description' => 2, 'isoCode' => 3, 'idLocation' => 4, 'idCountry' => 5, ),
        self::TYPE_COLNAME       => array(CitiesTableMap::COL_ID => 0, CitiesTableMap::COL_CITY_NAME => 1, CitiesTableMap::COL_DESCRIPTION => 2, CitiesTableMap::COL_ISO_CODE => 3, CitiesTableMap::COL_ID_LOCATION => 4, CitiesTableMap::COL_ID_COUNTRY => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'city_name' => 1, 'description' => 2, 'iso_code' => 3, 'id_location' => 4, 'id_country' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('cities');
        $this->setPhpName('Cities');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Cities');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('city_name', 'CityName', 'VARCHAR', false, 50, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 256, null);
        $this->addColumn('iso_code', 'IsoCode', 'VARCHAR', false, 10, null);
        $this->addColumn('id_location', 'IdLocation', 'INTEGER', false, null, null);
        $this->addColumn('id_country', 'IdCountry', 'INTEGER', false, null, null);
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
        return $withPrefix ? CitiesTableMap::CLASS_DEFAULT : CitiesTableMap::OM_CLASS;
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
     * @return array           (Cities object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CitiesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CitiesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CitiesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CitiesTableMap::OM_CLASS;
            /** @var Cities $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CitiesTableMap::addInstanceToPool($obj, $key);
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
            $key = CitiesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CitiesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cities $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CitiesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CitiesTableMap::COL_ID);
            $criteria->addSelectColumn(CitiesTableMap::COL_CITY_NAME);
            $criteria->addSelectColumn(CitiesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CitiesTableMap::COL_ISO_CODE);
            $criteria->addSelectColumn(CitiesTableMap::COL_ID_LOCATION);
            $criteria->addSelectColumn(CitiesTableMap::COL_ID_COUNTRY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.city_name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.iso_code');
            $criteria->addSelectColumn($alias . '.id_location');
            $criteria->addSelectColumn($alias . '.id_country');
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
        return Propel::getServiceContainer()->getDatabaseMap(CitiesTableMap::DATABASE_NAME)->getTable(CitiesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CitiesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CitiesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CitiesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Cities or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Cities object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CitiesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Cities) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CitiesTableMap::DATABASE_NAME);
            $criteria->add(CitiesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CitiesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CitiesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CitiesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CitiesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cities or Criteria object.
     *
     * @param mixed               $criteria Criteria or Cities object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CitiesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cities object
        }

        if ($criteria->containsKey(CitiesTableMap::COL_ID) && $criteria->keyContainsValue(CitiesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CitiesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CitiesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CitiesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CitiesTableMap::buildTableMap();
