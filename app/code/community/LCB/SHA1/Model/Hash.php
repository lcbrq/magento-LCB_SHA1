<?php

/**
 * @category    LCB
 * @package     LCB_SHA1
 * @author      Tomasz Gregorczyk <tom@leftcurlybracket.com>
 */
class LCB_SHA1_Model_Hash extends Mage_Core_Model_Encryption {

    const FRONTEND_ONLY = true;

    /**
     * Override Mage_Core_Model_Encryption->hash()
     *
     * @param string $data
     * @return string
     */
    public function hash($data)
    {

        if (!self::FRONTEND_ONLY) {
            return hash('sha1', $data);
        }

        if (!Mage::app()->getStore()->isAdmin()) {
            return hash('sha1', $data);
        } else {
            if (Mage::app()->getRequest()->getControllerName() == "customer" && Mage::app()->getRequest()->getActionName() == "save") {
                if (debug_backtrace()[3]['function'] != "validateCurrentPassword") {
                    return hash('sha1', $data);
                }
            }
        }

        return parent::hash($data);
    }

}
