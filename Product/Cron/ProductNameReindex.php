<?php


namespace CustomProductIndexer\Product\Cron;

use Magento\Indexer\Model\Indexer;

class ProductNameReindex
{
    const TABLE_INDEXER = 'catalog_product_index_name';

    /**
     * @var Indexer
     */
    private $indexer;

    public function __construct(
        Indexer $indexer
    ) {
        $this->indexer = $indexer;
    }

    /**
     * @return void
     */
    public function execute()
    {
        try {
            $this->indexer->load(self::TABLE_INDEXER);
            $this->indexer->reindexAll();
        } catch (\Exception $e) {
            //Todo Exception
        }
    }
}
