<?php
class Album extends Zend_Db_Table_Abstract {
    protected $_name = 'album';

    public function isConnected() {
        try {
            $this->getAdapter()->getConnection();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}