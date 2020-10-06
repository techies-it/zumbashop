<?php
/**
 * ducdevphp@gmail.com
 */

namespace Rokanthemes\Testimonials\Ui\Component\Listing\Column;

abstract class AbstractColumn extends \Magento\Ui\Component\Listing\Columns\Column
{
   
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $this->_prepareItem($item);
            }
        }

        return $dataSource;
    }

    abstract protected function _prepareItem(array & $item);
}
