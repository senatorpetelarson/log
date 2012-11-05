<?php
//checkout class
class checkout
{	
    var $giftWrapAmount=null;
	var $billingName=null;
	var $address1=null;
	var $address2=null;
	var $city=null;
	var $ZIP=null;
	var $state=null;
	var $phone=null;
	var $addrnum=null;
	var $cardNumber=null;
	var $cardSecurityCode=null;
	var $expMonth=null;
	var $expYear=null;
		
    function checkout() {
		//constructor function
		require_once('database.php');
		$this->database = new database(CONST_HOST,CONST_USER,CONST_DB_PASSWORD,CONST_DB_NAME);
		
		//get Gift Wrap Amount
		$strQuery = "SELECT giftWrap FROM settings WHERE id=1";
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		$this->giftWrapAmount = $result[0]->giftWrap;
    }
	
	function getAddrnum($address) {
		//need to get just the number part of the address for billing verification
		$pattern = '/\d+/';
		preg_match($pattern, $address, $matches);
		return $matches[0];
	}
	
	function setBillingInfo($billingName,$address1,$address2,$city,$ZIP,$state,$phone,$cardNumber,$cardSecurityCode,$expMonth,$expYear) {
		$this->billingName=$billingName;
		$this->address1=$address1;
		$this->address2=$address2;
		$this->city=$city;
		$this->ZIP=$ZIP;
		$this->state=$state;
		$this->phone=$phone;
		$this->addrnum=$this->getAddrnum($address1);
		$this->cardNumber=$cardNumber;
		$this->cardSecurityCode=$cardSecurityCode;
		$this->expMonth=$expMonth;
		$this->expYear=$expYear;
	}
	
	function getShipmentTotals(&$shipment,$state) {
		require_once('tax.php');
		$subtotal=$shipment->getCartSubtotal();
		$shipping=$shipment->shippingAmount;
		$giftWrap=$shipment->giftWrap;
		$tax = new tax();
		$taxRate = $tax->getTaxForState($state);
		$taxAmount = ($subtotal + $shipping) * $taxRate;
		$total = $subtotal + $shipping + $taxAmount + $giftWrap;
		$shipment->taxAmount = $taxAmount;
		$shipment->total = $total;
	}
	
	function getPossibleShippingRates($ZIP,$shipment) {
		$shippingRate = new shippingRate();
		//$weight=$shipment->getCartWeight();
		/*
		if($weight>0 && strlen($ZIP)) {
			if($weight<150) {
				$shipmentPossibleShippingRate[1]=$shippingRate->getRate($weight,$ZIP,1);
				$shipmentPossibleShippingRate[2]=$shippingRate->getRate($weight,$ZIP,2);
				$shipmentPossibleShippingRate[3]=$shippingRate->getRate($weight,$ZIP,3);
			} else { //if the package is over 150lbs, split the calculation up by 150's
				$count = floor($weight / 150);
				for($i = 1; $i <= $count; $i++) {
					$shipmentPossibleShippingRate[1]=$shipmentPossibleShippingRate[1] + $shippingRate->getRate($weight,$ZIP,1);
					$shipmentPossibleShippingRate[2]=$shipmentPossibleShippingRate[2] + $shippingRate->getRate($weight,$ZIP,2);
					$shipmentPossibleShippingRate[3]=$shipmentPossibleShippingRate[3] + $shippingRate->getRate($weight,$ZIP,3);
					$weight=$weight-150;
				}
				//get shipping rates for the remainder
				$shipmentPossibleShippingRate[1]=$shipmentPossibleShippingRate[1] + $shippingRate->getRate($weight,$ZIP,1);
				$shipmentPossibleShippingRate[2]=$shipmentPossibleShippingRate[2] + $shippingRate->getRate($weight,$ZIP,2);
				$shipmentPossibleShippingRate[3]=$shipmentPossibleShippingRate[3] + $shippingRate->getRate($weight,$ZIP,3);
			}
		}
		*/
		$shipmentPossibleShippingRate[1] = 0;
		$shipmentPossibleShippingRate[2] = 0;
		$shipmentPossibleShippingRate[3] = 0;
		
		//First pull out the cases and calculate them individually
		$caseWeights = $shipment->getCaseWeights();
		if(count($caseWeights) > 0) {
			for($i=0;$i<count($caseWeights);$i++) {
				$shipmentPossibleShippingRate[1] = $shipmentPossibleShippingRate[1] + $shippingRate->getRate($caseWeights[$i],$ZIP,1);
				$shipmentPossibleShippingRate[2] = $shipmentPossibleShippingRate[2] + $shippingRate->getRate($caseWeights[$i],$ZIP,2);
				$shipmentPossibleShippingRate[3] = $shipmentPossibleShippingRate[3] + $shippingRate->getRate($caseWeights[$i],$ZIP,3);
			}
		}
		
		//Now calculate the rest of the items
		$weight=$shipment->getNonCaseWeight();
		$shipmentPossibleShippingRate[1]=$shipmentPossibleShippingRate[1] + $shippingRate->getRate($weight,$ZIP,1);
		$shipmentPossibleShippingRate[2]=$shipmentPossibleShippingRate[2] + $shippingRate->getRate($weight,$ZIP,2);
		$shipmentPossibleShippingRate[3]=$shipmentPossibleShippingRate[3] + $shippingRate->getRate($weight,$ZIP,3);
		
		if($shipmentPossibleShippingRate[1] < 9) $shipmentPossibleShippingRate[1] = 9;
		if($shipmentPossibleShippingRate[2] < 9) $shipmentPossibleShippingRate[2] = 9;
		if($shipmentPossibleShippingRate[3] < 9) $shipmentPossibleShippingRate[3] = 9; 
		
		//if($debug) { var_dump($shipmentPossibleShippingRate); }
		return $shipmentPossibleShippingRate;
	}

	function getShipments($shipmentID=0) {
		if($shipmentID > 0) {
			$strQuery = "SELECT shipments.id, shipments.addressID, shipments.shippingMethodID, "
		            	. "shipments.statusID, shipments.trackingNumber FROM shipments "
						. "WHERE shipments.id = " . $shipmentID;
		}
		else {
			$strQuery = "SELECT shipments.id, shipments.addressID, shipments.shippingMethodID, "
		            	. "shipments.statusID, shipments.trackingNumber FROM shipments";
		}
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		if($shipmentID > 0) {
			return $result[0];
		}
		else {
			return $result;
		}
	}

	function getShippingMethods($shippingMethodID=0) {
		if($shippingMethodID > 0) {
			$strQuery = "SELECT shippingMethods.provider, shippingMethods.method, "
		          	  . "shippingMethods.code FROM shippingMethods "
					  . "WHERE shippingMethods.id = " . $shippingMethodID;
		}
		else {
			$strQuery = "SELECT shippingMethods.id, shippingMethods.provider, shippingMethods.method, "
		          	  . "shippingMethods.code FROM shippingMethods ORDER BY shippingMethods.code";
		}
		$this->database->setQuery($strQuery);
		$this->database->query();
		return $this->database->getObjectList();
	}
	
	function checkProductShippingRules(&$shipments,$shipmentKey) {
		$needs2Day = false;
		if($shipments[$shipmentKey]->shippingMethodCode<2) {
			$cartObj = $shipments[$shipmentKey]->shoppingCart;
			$newShipment = array();
			$normalShipment = array();
			foreach($cartObj as $key => $product) {
				if($product['needs2Day']=="1") {
					$newShipment[$key] = $product;
				}
				else {
					$normalShipment[$key] = $product;
				}
			}
			//split out the product into multiple shipments
			if(count($newShipment)>0) {
				$newShipmentKey = $shipmentKey + 1;
				$shipments[$newShipmentKey] = new cart();
				$shipments[$newShipmentKey]->shoppingCart = $newShipment;
				$needs2Day = true;
			}
			$shipments[$shipmentKey]->shoppingCart = $normalShipment;
		}
		return $needs2Day;
	}
	
	function getAddress($addressID) {
		$strQuery = "SELECT addresses.id, addresses.name, addresses.address1, addresses.address2, "
		            . "addresses.city, addresses.state, addresses.ZIP, addresses.ZIPextension, "
					. "addresses.phone FROM addresses "
					. "WHERE addresses.id = " . $addressID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		return $result[0];
	}
	
	function getAddressesForUser($userID) {
		$strQuery = "SELECT addresses.id, CONCAT(SUBSTRING(addresses.address1,1,20),'...') AS identifier, "
					. "addresses.name, addresses.address1, addresses.address2,"
		            . "addresses.city,addresses.state,addresses.ZIP,addresses.ZIPextension,"
					. "addresses.phone FROM addresses,addressesTOusers"
					. " WHERE addresses.id=addressesTOusers.addressID"
					. " AND addressesTOusers.userID=".$userID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		return $result;
	}
	
	function getAddress1($addressID) {
		$strQuery = "SELECT addresses.id, CONCAT(SUBSTRING(addresses.address1,1,15),'...') AS identifier, addresses.address1"
					." FROM addresses"
					. " WHERE addresses.id=".$addressID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		return $result[0];
	}
	
	function getAddressForShipment($shipmentID) {
		$strQuery = "SELECT addresses.id, addresses.address1, addresses.address2,"
		            . "addresses.city,addresses.state,addresses.ZIP,addresses.ZIPextension,"
					. "addresses.phone FROM addresses, shipments"
					. " WHERE addresses.id=shipments.addressID"
					. " AND shipments.id=".$shipmentID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		return $result[0];
	}
	
	function getBillingAddress($transactionID) {
		$strQuery = "SELECT addresses.id, addresses.address1, addresses.address2,"
		            . "addresses.city,addresses.state,addresses.ZIP,addresses.ZIPextension,"
					. "addresses.phone FROM addresses, transactions"
					. " WHERE addresses.id=transactions.addressID"
					. " AND transactions.id=".$transactionID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		return $result[0];
	}
	
	function getRefNumber($transactionID) {
		$strQuery = "SELECT transactions.refNumber FROM transactions"
					. " WHERE transactions.id=".$transactionID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		return $this->database->loadResult();
	}
	
	function getCardTypes($cardTypeID=0) {
		if($cardTypeID > 0) {
			$strQuery = "SELECT cardTypes.id, cardTypes.name "
		          	  . "FROM cardTypes "
					  . "WHERE cardTypes.id = " . $cardTypeID;
		}
		else {
			$strQuery = "SELECT cardTypes.id, cardTypes.name "
		          	  . "FROM cardTypes";
		}
		$this->database->setQuery($strQuery);
		$this->database->query();
		return $this->database->getObjectList();
	}
	
	//Returns the shipment for a given userID
	function getShipmentForUser($userID) {
		$strQuery = "SELECT shipments.id FROM shipments "
		             . "WHERE shipments.userID = " . $userID;
		$this->database->setQuery($strQuery);
		$this->database->query();
		$result = $this->database->getObjectList();
		$shipmentResult = $result[0];
		$shipment = null;
		if ($shipmentResult->id != null){
			$shipment = $this->getShipments($shipmentResult->id);
		}
		return $shipment;
	}
		
	function my_array_search($needle, $haystack) { 
   		$match = false; 
   		foreach ($haystack as $key => $value) { 
       		if ($value == $needle) { 
          		 $match = $key; 
       		} 
   		} 
   		return $match; 
	}
	
	function createShipment($userID, $addressID, $transactionID, $shippingMethodID, $giftWrap, $giftNote, $statusID, $shipment, $orderID) {
		//Insert Shipment into DB
		$strQuery = "INSERT INTO shipments(userID, addressID, transactionID, shippingMethodID, giftWrap, note, statusID) "
		             . "VALUES(" . $userID .",". $addressID .",". $transactionID .",". $shippingMethodID .",". $giftWrap . ",'" . $giftNote . "'," . $statusID .")";
		$this->database->setQuery($strQuery);
        $shipmentID = $this->database->insertQuery();
		
		//Insert entry into ordersTOshipments
		$strQuery =   "INSERT INTO ordersTOshipments(orderID,shipmentID) "
					. "VALUES(".$orderID.",".$shipmentID.")";
		$this->database->setQuery($strQuery);
        $this->database->query();
		
		//Insert entries into shipmentsTOproducts
		foreach($shipment->shoppingCart as $product) {
			$strQuery =   "INSERT INTO shipmentsTOproducts(shipmentID,productID,quantity,caseQuantity) "
						. "VALUES(".$shipmentID.",".$product['productID'].",".$product['quantity'].",".$product['caseQuantity'].")";
			$this->database->setQuery($strQuery);
			$this->database->query();
		}
		
		return $shipmentID;
	}
	
	function updateShippingMethod($shipment,$method,$shipmentPossibleShippingRate) {
		$shipping = $shipmentPossibleShippingRate[$method];
		$shipment->shippingAmount = $shipping;
	}
	
	function updateShippingAmount($shipment,$amount) {
		$shipment->shippingAmount = $amount;
	}

	function updateShipmentStatus($shipmentID, $statusID) {
		$strQuery = "UPDATE shipments SET statusID=".$statusID
					 . " WHERE id=".$shipmentID;
		$this->database->setQuery($strQuery);
		return $this->database->query();
	}	
	
	function updateShipmentTrackingNumber($shipmentID, $trackingNumber) {
		$strQuery = "UPDATE shipments SET trackingNumber='" . $trackingNumber
					 . "' WHERE id=" . $shipmentID;
		$this->database->setQuery($strQuery);
		return $this->database->query();
	}	
	
	function createAddress($name, $address1, $address2, $city, $state, $zip, $zipExtension, $phone) {
		//Insert Address into DB
		$strQuery = "INSERT INTO addresses(name, address1, address2, city, state, ZIP, ZIPextension, phone) "
		             . "VALUES('" . $name ."','". $address1 ."','". $address2 ."','". $city ."','". $state
					 . "','". $zip ."','". $zipExtension ."','". $phone ."')";
		$this->database->setQuery($strQuery);
        $result  = $this->database->insertQuery();
		return $result;
	}
	
	function updateAddress($addressID, $name, $address1, $address2, $city, $state, $zip, $zipExtension, $phone) {
		//Update Address in DB
		$strQuery = "UPDATE addresses SET ";
		if(strlen(trim($name))>0) {
			$strQuery=$strQuery."name='".$name."',";
		}
		if(strlen(trim($address1))>0) {
			$strQuery=$strQuery."address1='".$address1."',";
		}
		if(strlen(trim($address2))>0) {
			$strQuery=$strQuery."address2='".$address2."',";
		}
		if(strlen(trim($city))>0) {
			$strQuery=$strQuery."city='".$city."',";
		}
		if(strlen(trim($state))>0) {
			$strQuery=$strQuery."state='".$state."',";
		}
		if(strlen(trim($zip))>0) {
			$strQuery=$strQuery."ZIP='".$zip."',";
		}
		if(strlen(trim($zipExtension))>0) {
			$strQuery=$strQuery."ZIPextension='".$zipExtension."',";
		}
		if(strlen(trim($phone))>0) {
			$strQuery=$strQuery."phone='".$phone."'";
		}
		if(strrpos($strQuery, ",")==(strlen($strQuery)-1)) {
			$strQuery=substr($strQuery,1,strlen($strQuery)-2);
		}
		$strQuery=$strQuery." WHERE id=".$addressID;
		$this->database->setQuery($strQuery);
		return $this->database->query();
	}
	
	function createTransaction($cardholdersName,$address1,$ZIP,$phone,$orderNumber,$type,$amount=0,$approved,$errors,$placed,$shippingAmount=0,$taxAmount=0,$giftWrapAmount=0) {
		//Insert Transaction into DB
		$strQuery = "INSERT INTO transactions(cardHolder,address1,ZIP,phone,refNumber,transactionType,amount,approved,errorMessage,placed,shippingAmount,giftWrapAmount,taxAmount) "
		             . " VALUES('" . $cardholdersName ."','". $address1 . "','" . $ZIP . "','" . $phone . "','" . $orderNumber . "', '" . $type . "', '" . $amount . "', '" . $approved . "', '" . $errors . "', '" . $placed . "','".$shippingAmount."','".$giftWrapAmount."','".$taxAmount."')";
		$this->database->setQuery($strQuery);
        $result  = $this->database->insertQuery();
		return $result;
	}
	
	function createTransactionError($transactionID) {
		//Insert Error into DB
		$serShipments = serialize($_SESSION['shipments']);
		$strQuery = "INSERT INTO transactionErrors(transaction_id,cvm,expMonth,expYear,addrnum,zip,shipments) "
		             . " VALUES(" . $transactionID .",'". $this->cardSecurityCode . "','" . $this->expMonth . "','" . $this->expYear . "','" . $this->addrnum . "', '" . $this->ZIP . "', '".$serShipments."')";
		$this->database->setQuery($strQuery);
        $result  = $this->database->insertQuery();
		return $result;
	}
	
	function createOrder($userID, $notes) {
		//Insert Order into DB
		$strQuery = "INSERT INTO orders(userID, notes) "
		             . "VALUES(".$userID.",'".$notes ."')";
		$this->database->setQuery($strQuery);
        $result  = $this->database->insertQuery();
		return $result;
	}
	
	function createOrdersTOProducts($shoppingCart, $orderID) {
		foreach($shoppingCart as $cartProduct) {
			$strQuery = "INSERT INTO ordersTOproducts(orderID, productID, quantity, caseQuantity) VALUES("
			            . $orderID .",". $cartProduct['productID'] .",". $cartProduct['quantity']
						.",". $cartProduct['caseQuantity'].")";
			$this->database->setQuery($strQuery);
        	$this->database->insertQuery();	
		}
	}
		
}
?>




