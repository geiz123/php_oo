<?php
namespace Dao;

// Declare the interface 'OilChangeDao'
interface OilChangeDao
{
    public function getLastOilChange();
    public function saveOilChange($oilChange);
}

?>