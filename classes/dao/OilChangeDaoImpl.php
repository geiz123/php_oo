<?php
namespace Dao;

Use PDO;

class OilChangeDaoImpl extends DbConnection implements OilChangeDao 
{
  private $QRY_GETALLMAXMILEAGE = "SELECT OC.*
    FROM OIL_CHANGE OC
    INNER JOIN
    (SELECT
    MAKE, MODEL, MYEAR, COLOR, MAX(MILEAGE) AS MAX_MILEAGE
    FROM OIL_CHANGE
    GROUP BY MAKE, MODEL, MYEAR, COLOR) OC2
    ON OC2.MAKE = OC.MAKE
      AND OC2.MODEL = OC.MODEL
      AND OC2.MYEAR = OC.MYEAR
      AND OC2.COLOR = OC.COLOR
      AND OC2.MAX_MILEAGE = OC.MILEAGE";
  
  private $QRY_INSERTUPDATE = "INSERT OR REPLACE 
    INTO OIL_CHANGE(MAKE, MODEL, MYEAR, COLOR, MILEAGE, OIL_CHANGE_DT, DESCRIPTION)
    VALUES(:make, :model, :myear, :color, :mileage, :oil_change_dt, :description);";

  private $QRY_GETOILCHANGEBYID = "";

  public function getLastOilChange() {
    $pdos = $this->connect()->prepare($this->QRY_GETALLMAXMILEAGE);

    $pdos->execute();

    $oc = $pdos->fetchAll(PDO::FETCH_CLASS, "\bean\OilChange");

    return $oc;
  }

  /**
   * Insert / update oil change bean
   */
  public function saveOilChange($oilChange) {
    if ($oilChange !== NULL) {
      $pdos = $this->connect()->prepare($this->QRY_INSERTUPDATE);
      $pdos->execute([
        'make' => $oilChange->getMake(),
        'model' => $oilChange->getModel(),
        'myear' => $oilChange->getMyear(),
        'color' => $oilChange->getColor(),
        'mileage' => $oilChange->getMileage(),
        'oil_change_dt' => $oilChange->getOil_change_dt(),
        'description' => $oilChange->getDescription()
      ]);

      return $pdos->rowCount();
    } else {
      return -1;
    }
  }
}

?>