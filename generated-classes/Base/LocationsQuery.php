<?php

namespace Base;

use \Locations as ChildLocations;
use \LocationsQuery as ChildLocationsQuery;
use \Exception;
use \PDO;
use Map\LocationsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'locations' table.
 *
 *
 *
 * @method     ChildLocationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLocationsQuery orderByLocationName($order = Criteria::ASC) Order by the location_name column
 * @method     ChildLocationsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildLocationsQuery orderByIsoCode($order = Criteria::ASC) Order by the iso_code column
 * @method     ChildLocationsQuery orderByIdCountry($order = Criteria::ASC) Order by the id_country column
 *
 * @method     ChildLocationsQuery groupById() Group by the id column
 * @method     ChildLocationsQuery groupByLocationName() Group by the location_name column
 * @method     ChildLocationsQuery groupByDescription() Group by the description column
 * @method     ChildLocationsQuery groupByIsoCode() Group by the iso_code column
 * @method     ChildLocationsQuery groupByIdCountry() Group by the id_country column
 *
 * @method     ChildLocationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLocationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLocationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLocations findOne(ConnectionInterface $con = null) Return the first ChildLocations matching the query
 * @method     ChildLocations findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLocations matching the query, or a new ChildLocations object populated from the query conditions when no match is found
 *
 * @method     ChildLocations findOneById(int $id) Return the first ChildLocations filtered by the id column
 * @method     ChildLocations findOneByLocationName(string $location_name) Return the first ChildLocations filtered by the location_name column
 * @method     ChildLocations findOneByDescription(string $description) Return the first ChildLocations filtered by the description column
 * @method     ChildLocations findOneByIsoCode(string $iso_code) Return the first ChildLocations filtered by the iso_code column
 * @method     ChildLocations findOneByIdCountry(string $id_country) Return the first ChildLocations filtered by the id_country column *

 * @method     ChildLocations requirePk($key, ConnectionInterface $con = null) Return the ChildLocations by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocations requireOne(ConnectionInterface $con = null) Return the first ChildLocations matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLocations requireOneById(int $id) Return the first ChildLocations filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocations requireOneByLocationName(string $location_name) Return the first ChildLocations filtered by the location_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocations requireOneByDescription(string $description) Return the first ChildLocations filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocations requireOneByIsoCode(string $iso_code) Return the first ChildLocations filtered by the iso_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLocations requireOneByIdCountry(string $id_country) Return the first ChildLocations filtered by the id_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLocations[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLocations objects based on current ModelCriteria
 * @method     ChildLocations[]|ObjectCollection findById(int $id) Return ChildLocations objects filtered by the id column
 * @method     ChildLocations[]|ObjectCollection findByLocationName(string $location_name) Return ChildLocations objects filtered by the location_name column
 * @method     ChildLocations[]|ObjectCollection findByDescription(string $description) Return ChildLocations objects filtered by the description column
 * @method     ChildLocations[]|ObjectCollection findByIsoCode(string $iso_code) Return ChildLocations objects filtered by the iso_code column
 * @method     ChildLocations[]|ObjectCollection findByIdCountry(string $id_country) Return ChildLocations objects filtered by the id_country column
 * @method     ChildLocations[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LocationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LocationsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'metadocument', $modelName = '\\Locations', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLocationsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLocationsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLocationsQuery) {
            return $criteria;
        }
        $query = new ChildLocationsQuery();
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
     * @return ChildLocations|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LocationsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LocationsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
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
     * @return ChildLocations A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, location_name, description, iso_code, id_country FROM locations WHERE id = :p0';
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
            /** @var ChildLocations $obj */
            $obj = new ChildLocations();
            $obj->hydrate($row);
            LocationsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLocations|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LocationsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LocationsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LocationsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LocationsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LocationsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the location_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationName('fooValue');   // WHERE location_name = 'fooValue'
     * $query->filterByLocationName('%fooValue%'); // WHERE location_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locationName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterByLocationName($locationName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locationName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locationName)) {
                $locationName = str_replace('*', '%', $locationName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LocationsTableMap::COL_LOCATION_NAME, $locationName, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LocationsTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the iso_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoCode('fooValue');   // WHERE iso_code = 'fooValue'
     * $query->filterByIsoCode('%fooValue%'); // WHERE iso_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isoCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterByIsoCode($isoCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isoCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $isoCode)) {
                $isoCode = str_replace('*', '%', $isoCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LocationsTableMap::COL_ISO_CODE, $isoCode, $comparison);
    }

    /**
     * Filter the query on the id_country column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCountry('fooValue');   // WHERE id_country = 'fooValue'
     * $query->filterByIdCountry('%fooValue%'); // WHERE id_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function filterByIdCountry($idCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $idCountry)) {
                $idCountry = str_replace('*', '%', $idCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LocationsTableMap::COL_ID_COUNTRY, $idCountry, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLocations $locations Object to remove from the list of results
     *
     * @return $this|ChildLocationsQuery The current query, for fluid interface
     */
    public function prune($locations = null)
    {
        if ($locations) {
            $this->addUsingAlias(LocationsTableMap::COL_ID, $locations->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the locations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LocationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LocationsTableMap::clearInstancePool();
            LocationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LocationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LocationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LocationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LocationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LocationsQuery
