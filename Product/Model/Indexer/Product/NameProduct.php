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
