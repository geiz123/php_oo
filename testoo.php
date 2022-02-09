<?php
include 'includes/AutoLoader.php';

try
{
	$oilChangeDao = new Dao\OilChangeDaoImpl();

	$listOfCars = $oilChangeDao->getLastOilChange();

	foreach ($listOfCars as $car) {
		print($car->getMake() . '<br>');
	}

	$oilChange = new Bean\OilChange();
	$oilChange->setMake("Ford");
	$oilChange->setModel("Escort");
	$oilChange->setColor("red");
	$oilChange->setMyear("2020");
	$oilChange->setMileage(22222);
	$oilChange->setOil_change_dt('2020-01-01');
	$oilChange->setDescription("hellow world");

	print_r($oilChangeDao->saveOilChange($oilChange));

	echo "Done";
}
catch (Exception $e) {
	echo $e->getMessage(), "\n";
}
?>