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
class Name implements IndexerActionInterface, MviewActionInterface
{
    const INDEXER_ID = 'catalog_product_index_name';

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
        $this->logger->debug('execute construct', ['ddd']);
    }

    public function executeFull()
    {
        // TODO: Implement executeFull() method.
        $this->logger->debug('executeFull', []);

    }

    public function executeList(array $ids)
    {
        // TODO: Implement executeList() method.
        $this->logger->debug('executeList', $ids);

    }

    public function executeRow($id)
    {
        // TODO: Implement executeRow() method.
//        $this->doExecuteRow($id);
        $this->logger->debug('executeRow', $id);
    }

    public function execute($ids)
    {
        // TODO: Implement execute() method.
        $this->logger->debug('execute', $ids);
    }

    /**
     * Execute action for single entity or list of entities
     *
     * @param int[] $ids
     * @return $this
     */
    protected function executeAction($ids)
    {
        $ids = array_unique($ids);
        $indexer = $this->indexerRegistry->get(static::INDEXER_ID);

        if ($indexer->isScheduled()) {

        } else {

        }

        return $this;
    }
}
