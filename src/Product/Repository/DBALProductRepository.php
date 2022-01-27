<?php

namespace App\Product\Repository;

use App\Product\DTO\Product;
use App\Product\DTO\ProductCollection;
use App\Product\Factory\ProductCollectionFactory;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Log\LoggerInterface;
use Throwable;

class DBALProductRepository implements ProductRepository
{
    private Connection $connection;

    private LoggerInterface $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function addProduct(Product $product): void
    {
        try {
            $this->connection->beginTransaction();

            $query = $this->connection->createQueryBuilder()
                ->insert('products')
                ->values(array(
                    'indeks' => '?',
                    'name' => '?'
                ))
                ->setParameter(0, $product->getIndex())
                ->setparameter(1, $product->getName());
            $query->executeQuery();

            $this->connection->commit();
        } catch (UniqueConstraintViolationException $e) {
            $this->logger->info('Duplicate entry during import: ' . $e->getMessage());
            $this->connection->rollBack();
        } catch (Throwable $th) {
            throw new $th;
            $this->connection->rollBack();
        }
    }
    
    public function getAllProducts(): ProductCollection
    {
        $query = $this->connection->createQueryBuilder()
            ->select('
               indeks,
               name
            ')
            ->from('products', 'p');
        $query->executeQuery();
        $rawResult = $query->fetchAllAssociative();
        
        return ProductCollectionFactory::createCollection($rawResult);
    }
}
