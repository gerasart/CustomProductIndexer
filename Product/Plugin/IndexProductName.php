<?php

namespace CustomProductIndexer\Product\Plugin;

use CustomProductIndexer\Product\Model\Indexer\Product\IndexBuilder;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\Request\Http;

class IndexProductName
{
    /**
     * @var IndexBuilder
     */
    protected $indexBuilder;

    protected $_request;

    /**
     * @param IndexBuilder $indexBuilder
     * @param Http $request
     */
    public function __construct(
        IndexBuilder $indexBuilder,
        Http $request
    ) {
        $this->indexBuilder = $indexBuilder;
        $this->_request = $request;
    }

    /**
     * Apply catalog rules after product save
     *
     */
    public function afterExecute(\Magento\Catalog\Controller\Adminhtml\Product\Save $subject, $result)
    {
        $product_id = $this->_request->getParam('id');
        $this->indexBuilder->reindexByProductIds([$product_id]);

        return $result;
    }
}
