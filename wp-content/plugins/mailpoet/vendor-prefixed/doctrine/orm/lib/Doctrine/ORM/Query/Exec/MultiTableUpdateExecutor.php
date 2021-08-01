<?php
 namespace MailPoetVendor\Doctrine\ORM\Query\Exec; if (!defined('ABSPATH')) exit; use MailPoetVendor\Doctrine\DBAL\Connection; use MailPoetVendor\Doctrine\DBAL\Types\Type; use MailPoetVendor\Doctrine\ORM\Query\AST; use MailPoetVendor\Doctrine\ORM\Query\AST\UpdateStatement; use MailPoetVendor\Doctrine\ORM\Query\ParameterTypeInferer; use MailPoetVendor\Doctrine\ORM\Query\SqlWalker; use MailPoetVendor\Doctrine\ORM\Utility\PersisterHelper; use Throwable; use function array_merge; use function array_reverse; use function array_slice; use function implode; class MultiTableUpdateExecutor extends \MailPoetVendor\Doctrine\ORM\Query\Exec\AbstractSqlExecutor { private $_createTempTableSql; private $_dropTempTableSql; private $_insertSql; private $_sqlParameters = []; private $_numParametersInUpdateClause = 0; public function __construct(\MailPoetVendor\Doctrine\ORM\Query\AST\Node $AST, $sqlWalker) { $em = $sqlWalker->getEntityManager(); $conn = $em->getConnection(); $platform = $conn->getDatabasePlatform(); $quoteStrategy = $em->getConfiguration()->getQuoteStrategy(); $updateClause = $AST->updateClause; $primaryClass = $sqlWalker->getEntityManager()->getClassMetadata($updateClause->abstractSchemaName); $rootClass = $em->getClassMetadata($primaryClass->rootEntityName); $updateItems = $updateClause->updateItems; $tempTable = $platform->getTemporaryTableName($rootClass->getTemporaryIdTableName()); $idColumnNames = $rootClass->getIdentifierColumnNames(); $idColumnList = \implode(', ', $idColumnNames); $sqlWalker->setSQLTableAlias($primaryClass->getTableName(), 't0', $updateClause->aliasIdentificationVariable); $this->_insertSql = 'INSERT INTO ' . $tempTable . ' (' . $idColumnList . ')' . ' SELECT t0.' . \implode(', t0.', $idColumnNames); $rangeDecl = new \MailPoetVendor\Doctrine\ORM\Query\AST\RangeVariableDeclaration($primaryClass->name, $updateClause->aliasIdentificationVariable); $fromClause = new \MailPoetVendor\Doctrine\ORM\Query\AST\FromClause([new \MailPoetVendor\Doctrine\ORM\Query\AST\IdentificationVariableDeclaration($rangeDecl, null, [])]); $this->_insertSql .= $sqlWalker->walkFromClause($fromClause); $idSubselect = 'SELECT ' . $idColumnList . ' FROM ' . $tempTable; $classNames = \array_merge($primaryClass->parentClasses, [$primaryClass->name], $primaryClass->subClasses); $i = -1; foreach (\array_reverse($classNames) as $className) { $affected = \false; $class = $em->getClassMetadata($className); $updateSql = 'UPDATE ' . $quoteStrategy->getTableName($class, $platform) . ' SET '; foreach ($updateItems as $updateItem) { $field = $updateItem->pathExpression->field; if (isset($class->fieldMappings[$field]) && !isset($class->fieldMappings[$field]['inherited']) || isset($class->associationMappings[$field]) && !isset($class->associationMappings[$field]['inherited'])) { $newValue = $updateItem->newValue; if (!$affected) { $affected = \true; ++$i; } else { $updateSql .= ', '; } $updateSql .= $sqlWalker->walkUpdateItem($updateItem); if ($newValue instanceof \MailPoetVendor\Doctrine\ORM\Query\AST\InputParameter) { $this->_sqlParameters[$i][] = $newValue->name; ++$this->_numParametersInUpdateClause; } } } if ($affected) { $this->_sqlStatements[$i] = $updateSql . ' WHERE (' . $idColumnList . ') IN (' . $idSubselect . ')'; } } if ($AST->whereClause) { $this->_insertSql .= $sqlWalker->walkWhereClause($AST->whereClause); } $columnDefinitions = []; foreach ($idColumnNames as $idColumnName) { $columnDefinitions[$idColumnName] = ['notnull' => \true, 'type' => \MailPoetVendor\Doctrine\DBAL\Types\Type::getType(\MailPoetVendor\Doctrine\ORM\Utility\PersisterHelper::getTypeOfColumn($idColumnName, $rootClass, $em))]; } $this->_createTempTableSql = $platform->getCreateTemporaryTableSnippetSQL() . ' ' . $tempTable . ' (' . $platform->getColumnDeclarationListSQL($columnDefinitions) . ')'; $this->_dropTempTableSql = $platform->getDropTemporaryTableSQL($tempTable); } public function execute(\MailPoetVendor\Doctrine\DBAL\Connection $conn, array $params, array $types) { $conn->executeUpdate($this->_createTempTableSql); try { $numUpdated = $conn->executeUpdate($this->_insertSql, \array_slice($params, $this->_numParametersInUpdateClause), \array_slice($types, $this->_numParametersInUpdateClause)); foreach ($this->_sqlStatements as $key => $statement) { $paramValues = []; $paramTypes = []; if (isset($this->_sqlParameters[$key])) { foreach ($this->_sqlParameters[$key] as $parameterKey => $parameterName) { $paramValues[] = $params[$parameterKey]; $paramTypes[] = $types[$parameterKey] ?? \MailPoetVendor\Doctrine\ORM\Query\ParameterTypeInferer::inferType($params[$parameterKey]); } } $conn->executeUpdate($statement, $paramValues, $paramTypes); } } catch (\Throwable $exception) { $conn->executeUpdate($this->_dropTempTableSql); throw $exception; } $conn->executeUpdate($this->_dropTempTableSql); return $numUpdated; } } 