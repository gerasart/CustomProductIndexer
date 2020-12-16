<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace CustomProductIndexer\Product\Model\Indexer\Product;

use Magento\Framework\Indexer\ActionInterface as IndexerActionInterface;
use Magento\Framework\Mview\ActionInterface as MviewActionInterface;

/**
 * Price indexer
 */
class Indexer implements IndexerActionInterface, MviewActionInterface
{

    /**
     * @var IndexBuilder
     */
    private $indexBuilder;

    /**
     * Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(
        IndexBuilder $indexBuilder,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->indexBuilder = $indexBuilder;
        $this->logger = $logger;
        $this->logger->debug('construct', ['name __construct']);
    }

    public function executeFull()
    {
        $this->logger->debug('executeFull', []);
        $this->indexBuilder->reindexFull();
    }

    public function executeList(array $ids)
    {
        $this->logger->debug('executeList', $ids);
        if ($ids) {
            $this->doExecuteList($ids);
        }
    }

    public function executeRow($id)
    {
        $this->logger->debug('executeRow', [$id]);

        if ($id) {
            $this->doExecuteRow($id);
        }
    }

    public function execute($ids)
    {
        $this->logger->debug('execute', $ids);
        $this->executeList($ids);
    }


    protected function doExecuteList($ids)
    {
        $this->indexBuilder->reindexByProductIds($ids);

    }

    protected function doExecuteRow($id)
    {
        $this->indexBuilder->reindexByProductIds([$id]);
    }
}
