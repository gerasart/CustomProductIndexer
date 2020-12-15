<?php

namespace CustomProductIndexer\Product\Plugin;

use CustomProductIndexer\Product\Model\Indexer\Product\IndexBuilder;
use Magento\Catalog\Model\Product;

class IndexProductName
{
    /**
     * @var IndexBuilder
     */
    protected $indexBuilder;

    /**
     * @param IndexBuilder $indexBuilder
     */
    public function __construct(IndexBuilder $indexBuilder)
    {
        $this->indexBuilder = $indexBuilder;
    }

    /**
     * Apply catalog rules after product save
     *
     * @param Product $subject
     * @param Product $result
     * @return Product
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSave(
        Product $subject,
        Product $result
    ) {
        if (!$result->getIsMassupdate()) {
            $this->indexBuilder->reindexByProductIds([$result->getId()]);
        }
        return $result;
    }
}
