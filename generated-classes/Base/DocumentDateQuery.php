<?php

namespace Base;

use \DocumentDate as ChildDocumentDate;
use \DocumentDateQuery as ChildDocumentDateQuery;
use \Exception;
use \PDO;
use Map\DocumentDateTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'document_date' table.
 *
 *
 *
 * @method     ChildDocumentDateQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDocumentDateQuery orderByDocumentId($order = Criteria::ASC) Order by the document_id column
 * @method     ChildDocumentDateQuery orderByMetadataId($order = Criteria::ASC) Order by the metadata_id column
 * @method     ChildDocumentDateQuery orderByMetadataDate($order = Criteria::ASC) Order by the metadata_date column
 *
 * @method     ChildDocumentDateQuery groupById() Group by the id column
 * @method     ChildDocumentDateQuery groupByDocumentId() Group by the document_id column
 * @method     ChildDocumentDateQuery groupByMetadataId() Group by the metadata_id column
 * @method     ChildDocumentDateQuery groupByMetadataDate() Group by the metadata_date column
 *
 * @method     ChildDocumentDateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDocumentDateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDocumentDateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDocumentDate findOne(ConnectionInterface $con = null) Return the first ChildDocumentDate matching the query
 * @method     ChildDocumentDate findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDocumentDate matching the query, or a new ChildDocumentDate object populated from the query conditions when no match is found
 *
 * @method     ChildDocumentDate findOneById(int $id) Return the first ChildDocumentDate filtered by the id column
 * @method     ChildDocumentDate findOneByDocumentId(string $document_id) Return the first ChildDocumentDate filtered by the document_id column
 * @method     ChildDocumentDate findOneByMetadataId(string $metadata_id) Return the first ChildDocumentDate filtered by the metadata_id column
 * @method     ChildDocumentDate findOneByMetadataDate(string $metadata_date) Return the first ChildDocumentDate filtered by the metadata_date column *

 * @method     ChildDocumentDate requirePk($key, ConnectionInterface $con = null) Return the ChildDocumentDate by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDocumentDate requireOne(ConnectionInterface $con = null) Return the first ChildDocumentDate matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDocumentDate requireOneById(int $id) Return the first ChildDocumentDate filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDocumentDate requireOneByDocumentId(string $document_id) Return the first ChildDocumentDate filtered by the document_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDocumentDate requireOneByMetadataId(string $metadata_id) Return the first ChildDocumentDate filtered by the metadata_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDocumentDate requireOneByMetadataDate(string $metadata_date) Return the first ChildDocumentDate filtered by the metadata_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDocumentDate[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDocumentDate objects based on current ModelCriteria
 * @method     ChildDocumentDate[]|ObjectCollection findById(int $id) Return ChildDocumentDate objects filtered by the id column
 * @method     ChildDocumentDate[]|ObjectCollection findByDocumentId(string $document_id) Return ChildDocumentDate objects filtered by the document_id column
 * @method     ChildDocumentDate[]|ObjectCollection findByMetadataId(string $metadata_id) Return ChildDocumentDate objects filtered by the metadata_id column
 * @method     ChildDocumentDate[]|ObjectCollection findByMetadataDate(string $metadata_date) Return ChildDocumentDate objects filtered by the metadata_date column
 * @method     ChildDocumentDate[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DocumentDateQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DocumentDateQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'metadocument', $modelName = '\\DocumentDate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDocumentDateQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDocumentDateQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDocumentDateQuery) {
            return $criteria;
        }
        $query = new ChildDocumentDateQuery();
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
     * @return ChildDocumentDate|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DocumentDateTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DocumentDateTableMap::DATABASE_NAME);
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
     * @return ChildDocumentDate A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, document_id, metadata_id, metadata_date FROM document_date WHERE id = :p0';
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
            /** @var ChildDocumentDate $obj */
            $obj = new ChildDocumentDate();
            $obj->hydrate($row);
            DocumentDateTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDocumentDate|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DocumentDateTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DocumentDateTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DocumentDateTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DocumentDateTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DocumentDateTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the document_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentId('fooValue');   // WHERE document_id = 'fooValue'
     * $query->filterByDocumentId('%fooValue%'); // WHERE document_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $documentId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function filterByDocumentId($documentId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documentId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $documentId)) {
                $documentId = str_replace('*', '%', $documentId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DocumentDateTableMap::COL_DOCUMENT_ID, $documentId, $comparison);
    }

    /**
     * Filter the query on the metadata_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMetadataId('fooValue');   // WHERE metadata_id = 'fooValue'
     * $query->filterByMetadataId('%fooValue%'); // WHERE metadata_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $metadataId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function filterByMetadataId($metadataId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($metadataId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $metadataId)) {
                $metadataId = str_replace('*', '%', $metadataId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DocumentDateTableMap::COL_METADATA_ID, $metadataId, $comparison);
    }

    /**
     * Filter the query on the metadata_date column
     *
     * Example usage:
     * <code>
     * $query->filterByMetadataDate('2011-03-14'); // WHERE metadata_date = '2011-03-14'
     * $query->filterByMetadataDate('now'); // WHERE metadata_date = '2011-03-14'
     * $query->filterByMetadataDate(array('max' => 'yesterday')); // WHERE metadata_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $metadataDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function filterByMetadataDate($metadataDate = null, $comparison = null)
    {
        if (is_array($metadataDate)) {
            $useMinMax = false;
            if (isset($metadataDate['min'])) {
                $this->addUsingAlias(DocumentDateTableMap::COL_METADATA_DATE, $metadataDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($metadataDate['max'])) {
                $this->addUsingAlias(DocumentDateTableMap::COL_METADATA_DATE, $metadataDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DocumentDateTableMap::COL_METADATA_DATE, $metadataDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDocumentDate $documentDate Object to remove from the list of results
     *
     * @return $this|ChildDocumentDateQuery The current query, for fluid interface
     */
    public function prune($documentDate = null)
    {
        if ($documentDate) {
            $this->addUsingAlias(DocumentDateTableMap::COL_ID, $documentDate->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the document_date table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DocumentDateTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DocumentDateTableMap::clearInstancePool();
            DocumentDateTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DocumentDateTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DocumentDateTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DocumentDateTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DocumentDateTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DocumentDateQuery
