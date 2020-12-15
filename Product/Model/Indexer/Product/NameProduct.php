<?php


namespace CustomProductIndexer\Product\Model\Indexer\Product;


use Magento\Framework\Exception\LocalizedException;

class NameProduct extends AbstractIndexer
{

    protected function doExecuteList($ids)
    {
        // TODO: Implement doExecuteList() method.
        $this->getIndexBuilder()->reindexByProductIds($ids);

    }

    protected function doExecuteRow($id)
    {
        // TODO: Implement doExecuteRow() method.
        $this->getIndexBuilder()->reindexByProductIds([$id]);

    }
}
