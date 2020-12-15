<?php

namespace CustomProductIndexer\Product\Model\Indexer\Product;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\State;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Store\Model\StoreManagerInterface;

class IndexBuilder
{
    const SOURCE_TABLE = 'catalog_product_entity_varchar';
    const INDEXER_ID = 'catalog_product_index_name';
    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var State
     */
    private $appState;

    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        ResourceConnection $resource,
        StoreManagerInterface $storeManager,
        State $appState,
        EventManager $eventManager
    ) {
        $this->resource = $resource;
        $this->storeManager = $storeManager;
        $this->appState = $appState;
        $this->eventManager = $eventManager;
    }

    /**
     * @return void
     */
    public function reindexFull()
    {
        $this->resource->getConnection()->truncateTable($this->getIndexTable());
        $this->doReindex([]);
    }

    /**
     * @param array $ids
     */
    public function reindexByProductIds(array $ids)
    {
        $this->doReindex($ids);
    }

    /**
     * @param array $ids
     */
    private function doReindex(array $ids)
    {
        $stores = $this->storeManager->getStores();
        foreach ($stores as $store) {
            $this->saveIndex($ids, $store);
        }
    }

    /**
     * @return string
     */
    private function getIndexTable()
    {
        return $this->resource->getTableName(self::INDEXER_ID);
    }

    /**
     * @param $ids
     * @param $store_id
     */
    public function saveIndex($ids, $store_id)
    {

    }
}
