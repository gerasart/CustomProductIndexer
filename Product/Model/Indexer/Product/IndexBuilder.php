<?php

namespace CustomProductIndexer\Product\Model\Indexer\Product;

use Magento\Catalog\Model\Product;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\State;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Store\Model\StoreManagerInterface;

class IndexBuilder
{
    const INDEXER_ID = 'catalog_product_index_name';

    /**
     * Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

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
        \Psr\Log\LoggerInterface $logger,
        AttributeRepositoryInterface $attributeRepository,
        EventManager $eventManager
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->resource = $resource;
        $this->logger = $logger;
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
        $storeId = $this->storeManager->getStore()->getStoreId();
        $this->saveIndex($ids, $storeId);
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
     * @param $storeId
     */
    public function saveIndex($ids, $storeId)
    {
        $objectManager = ObjectManager::getInstance();
        $data = [];
        foreach ($ids as $id) {
            $product = $objectManager
                ->create('\Magento\Catalog\Model\ProductRepository')
                ->getById($id);
            $data[] = [
                'value' => $product->getName(),
                'product_id' => $product->getId(),
                'store_id' => $storeId,
                'attribute_id' => $this->getAttributeId('name')
            ];

            $this->logger->debug('saveIndex data', $data);
        }

        if (!empty($data)) {
            $this->resource->getConnection()->insertOnDuplicate($this->getIndexTable(), $data, ['value']);
        }
    }

    public function getAttributeId($code)
    {
        $attribute = $this->attributeRepository->get(Product::ENTITY, $code);
        return $attribute->getAttributeId();
    }
}
