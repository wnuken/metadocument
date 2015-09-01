<?php

namespace Base;

use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Exception;
use \PDO;
use Map\UserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method     ChildUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUserQuery orderByRut($order = Criteria::ASC) Order by the rut column
 * @method     ChildUserQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildUserQuery orderByEMail($order = Criteria::ASC) Order by the e_mail column
 * @method     ChildUserQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildUserQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildUserQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUserQuery orderByIdCity($order = Criteria::ASC) Order by the id_city column
 * @method     ChildUserQuery orderByIdLocation($order = Criteria::ASC) Order by the id_location column
 * @method     ChildUserQuery orderByIdCountry($order = Criteria::ASC) Order by the id_country column
 * @method     ChildUserQuery orderByIdNationality($order = Criteria::ASC) Order by the id_nationality column
 * @method     ChildUserQuery orderByIdType($order = Criteria::ASC) Order by the id_type column
 * @method     ChildUserQuery orderByIdUser($order = Criteria::ASC) Order by the id_admin column
 *
 * @method     ChildUserQuery groupById() Group by the id column
 * @method     ChildUserQuery groupByName() Group by the name column
 * @method     ChildUserQuery groupByRut() Group by the rut column
 * @method     ChildUserQuery groupByCode() Group by the code column
 * @method     ChildUserQuery groupByEMail() Group by the e_mail column
 * @method     ChildUserQuery groupByAddress() Group by the address column
 * @method     ChildUserQuery groupByGender() Group by the gender column
 * @method     ChildUserQuery groupByPhone() Group by the phone column
 * @method     ChildUserQuery groupByIdCity() Group by the id_city column
 * @method     ChildUserQuery groupByIdLocation() Group by the id_location column
 * @method     ChildUserQuery groupByIdCountry() Group by the id_country column
 * @method     ChildUserQuery groupByIdNationality() Group by the id_nationality column
 * @method     ChildUserQuery groupByIdType() Group by the id_type column
 * @method     ChildUserQuery groupByIdUser() Group by the id_admin column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneById(int $id) Return the first ChildUser filtered by the id column
 * @method     ChildUser findOneByName(string $name) Return the first ChildUser filtered by the name column
 * @method     ChildUser findOneByRut(string $rut) Return the first ChildUser filtered by the rut column
 * @method     ChildUser findOneByCode(string $code) Return the first ChildUser filtered by the code column
 * @method     ChildUser findOneByEMail(string $e_mail) Return the first ChildUser filtered by the e_mail column
 * @method     ChildUser findOneByAddress(string $address) Return the first ChildUser filtered by the address column
 * @method     ChildUser findOneByGender(string $gender) Return the first ChildUser filtered by the gender column
 * @method     ChildUser findOneByPhone(string $phone) Return the first ChildUser filtered by the phone column
 * @method     ChildUser findOneByIdCity(int $id_city) Return the first ChildUser filtered by the id_city column
 * @method     ChildUser findOneByIdLocation(int $id_location) Return the first ChildUser filtered by the id_location column
 * @method     ChildUser findOneByIdCountry(int $id_country) Return the first ChildUser filtered by the id_country column
 * @method     ChildUser findOneByIdNationality(int $id_nationality) Return the first ChildUser filtered by the id_nationality column
 * @method     ChildUser findOneByIdType(int $id_type) Return the first ChildUser filtered by the id_type column
 * @method     ChildUser findOneByIdUser(int $id_admin) Return the first ChildUser filtered by the id_admin column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneById(int $id) Return the first ChildUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByName(string $name) Return the first ChildUser filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByRut(string $rut) Return the first ChildUser filtered by the rut column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCode(string $code) Return the first ChildUser filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEMail(string $e_mail) Return the first ChildUser filtered by the e_mail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByAddress(string $address) Return the first ChildUser filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByGender(string $gender) Return the first ChildUser filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPhone(string $phone) Return the first ChildUser filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIdCity(int $id_city) Return the first ChildUser filtered by the id_city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIdLocation(int $id_location) Return the first ChildUser filtered by the id_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIdCountry(int $id_country) Return the first ChildUser filtered by the id_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIdNationality(int $id_nationality) Return the first ChildUser filtered by the id_nationality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIdType(int $id_type) Return the first ChildUser filtered by the id_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIdUser(int $id_admin) Return the first ChildUser filtered by the id_admin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findById(int $id) Return ChildUser objects filtered by the id column
 * @method     ChildUser[]|ObjectCollection findByName(string $name) Return ChildUser objects filtered by the name column
 * @method     ChildUser[]|ObjectCollection findByRut(string $rut) Return ChildUser objects filtered by the rut column
 * @method     ChildUser[]|ObjectCollection findByCode(string $code) Return ChildUser objects filtered by the code column
 * @method     ChildUser[]|ObjectCollection findByEMail(string $e_mail) Return ChildUser objects filtered by the e_mail column
 * @method     ChildUser[]|ObjectCollection findByAddress(string $address) Return ChildUser objects filtered by the address column
 * @method     ChildUser[]|ObjectCollection findByGender(string $gender) Return ChildUser objects filtered by the gender column
 * @method     ChildUser[]|ObjectCollection findByPhone(string $phone) Return ChildUser objects filtered by the phone column
 * @method     ChildUser[]|ObjectCollection findByIdCity(int $id_city) Return ChildUser objects filtered by the id_city column
 * @method     ChildUser[]|ObjectCollection findByIdLocation(int $id_location) Return ChildUser objects filtered by the id_location column
 * @method     ChildUser[]|ObjectCollection findByIdCountry(int $id_country) Return ChildUser objects filtered by the id_country column
 * @method     ChildUser[]|ObjectCollection findByIdNationality(int $id_nationality) Return ChildUser objects filtered by the id_nationality column
 * @method     ChildUser[]|ObjectCollection findByIdType(int $id_type) Return ChildUser objects filtered by the id_type column
 * @method     ChildUser[]|ObjectCollection findByIdUser(int $id_admin) Return ChildUser objects filtered by the id_admin column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'metadocument', $modelName = '\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, rut, code, e_mail, address, gender, phone, id_city, id_location, id_country, id_nationality, id_type, id_admin FROM user WHERE id = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the rut column
     *
     * Example usage:
     * <code>
     * $query->filterByRut('fooValue');   // WHERE rut = 'fooValue'
     * $query->filterByRut('%fooValue%'); // WHERE rut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByRut($rut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rut)) {
                $rut = str_replace('*', '%', $rut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_RUT, $rut, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the e_mail column
     *
     * Example usage:
     * <code>
     * $query->filterByEMail('fooValue');   // WHERE e_mail = 'fooValue'
     * $query->filterByEMail('%fooValue%'); // WHERE e_mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eMail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByEMail($eMail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eMail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eMail)) {
                $eMail = str_replace('*', '%', $eMail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_E_MAIL, $eMail, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%'); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gender)) {
                $gender = str_replace('*', '%', $gender);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the id_city column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCity(1234); // WHERE id_city = 1234
     * $query->filterByIdCity(array(12, 34)); // WHERE id_city IN (12, 34)
     * $query->filterByIdCity(array('min' => 12)); // WHERE id_city > 12
     * </code>
     *
     * @param     mixed $idCity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdCity($idCity = null, $comparison = null)
    {
        if (is_array($idCity)) {
            $useMinMax = false;
            if (isset($idCity['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_CITY, $idCity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCity['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_CITY, $idCity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_CITY, $idCity, $comparison);
    }

    /**
     * Filter the query on the id_location column
     *
     * Example usage:
     * <code>
     * $query->filterByIdLocation(1234); // WHERE id_location = 1234
     * $query->filterByIdLocation(array(12, 34)); // WHERE id_location IN (12, 34)
     * $query->filterByIdLocation(array('min' => 12)); // WHERE id_location > 12
     * </code>
     *
     * @param     mixed $idLocation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdLocation($idLocation = null, $comparison = null)
    {
        if (is_array($idLocation)) {
            $useMinMax = false;
            if (isset($idLocation['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_LOCATION, $idLocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocation['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_LOCATION, $idLocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_LOCATION, $idLocation, $comparison);
    }

    /**
     * Filter the query on the id_country column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCountry(1234); // WHERE id_country = 1234
     * $query->filterByIdCountry(array(12, 34)); // WHERE id_country IN (12, 34)
     * $query->filterByIdCountry(array('min' => 12)); // WHERE id_country > 12
     * </code>
     *
     * @param     mixed $idCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdCountry($idCountry = null, $comparison = null)
    {
        if (is_array($idCountry)) {
            $useMinMax = false;
            if (isset($idCountry['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_COUNTRY, $idCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCountry['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_COUNTRY, $idCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_COUNTRY, $idCountry, $comparison);
    }

    /**
     * Filter the query on the id_nationality column
     *
     * Example usage:
     * <code>
     * $query->filterByIdNationality(1234); // WHERE id_nationality = 1234
     * $query->filterByIdNationality(array(12, 34)); // WHERE id_nationality IN (12, 34)
     * $query->filterByIdNationality(array('min' => 12)); // WHERE id_nationality > 12
     * </code>
     *
     * @param     mixed $idNationality The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdNationality($idNationality = null, $comparison = null)
    {
        if (is_array($idNationality)) {
            $useMinMax = false;
            if (isset($idNationality['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_NATIONALITY, $idNationality['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idNationality['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_NATIONALITY, $idNationality['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_NATIONALITY, $idNationality, $comparison);
    }

    /**
     * Filter the query on the id_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdType(1234); // WHERE id_type = 1234
     * $query->filterByIdType(array(12, 34)); // WHERE id_type IN (12, 34)
     * $query->filterByIdType(array('min' => 12)); // WHERE id_type > 12
     * </code>
     *
     * @param     mixed $idType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdType($idType = null, $comparison = null)
    {
        if (is_array($idType)) {
            $useMinMax = false;
            if (isset($idType['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_TYPE, $idType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idType['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_TYPE, $idType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_TYPE, $idType, $comparison);
    }

    /**
     * Filter the query on the id_admin column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_admin = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_admin IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_admin > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_ADMIN, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_ADMIN, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_ADMIN, $idUser, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserQuery
