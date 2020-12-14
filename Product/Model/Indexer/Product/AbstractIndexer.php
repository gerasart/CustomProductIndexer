<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace CustomProductIndexer\Product\Model\Indexer\Product;

use Magento\Framework\Indexer\ActionInterface as IndexerActionInterface;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\Mview\ActionInterface as MviewActionInterface;

/**
 * Price indexer
 */
class AbstractIndexer implements IndexerActionInterface, MviewActionInterface
{
    /**
     * Url persist
     *
     * @var \Magento\UrlRewrite\Model\UrlPersistInterface
     */
    private $urlPersist;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;

    public function __construct(
        IndexerRegistry $indexerRegistry,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->indexerRegistry = $indexerRegistry;
        $this->logger = $logger;
        $this->logger->debug('construct', ['name __construct']);
    }

    public function executeFull()
    {
        $this->logger->debug('executeFull', []);
        $this->execute([]);
    }

    public function executeList(array $ids)
    {
        $this->logger->debug('executeList', $ids);
        $this->execute($ids);
    }

    public function executeRow($id)
    {
        $this->logger->debug('executeRow', [$id]);
        $this->execute([$id]);
    }

    public function execute($ids)
    {
        $this->logger->debug('execute', $ids);
    }

//    /**
//     * @param array $ids
//     * @return $this
//     */
//    protected function executeAction(array $ids)
//    {
////        $connection = $this->getConnection();
//        $ids = array_unique($ids);
//        $indexer = $this->indexerRegistry->get(static::INDEXER_ID);
//        $this->logger->debug('$indexer execute', [$indexer]);
//
////        if ($indexer->isScheduled()) {
////
////        }
//
//        return $this;
//    }
}
