<?php

/**
 * @category    LCB
 * @package     LCB_SHA1
 * @author      Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_SHA1_Model_Hash extends Mage_Core_Model_Encryption {

    /**
     * Override Mage_Core_Model_Encryption->hash()
     *
     * @param string $data
     * @return string
     */
    public function hash($data)
    {
        if (!Mage::app()->getStore()->isAdmin()) {
            return hash('sha1', $data);
        }

        return parent::hash($data);
    }

}
