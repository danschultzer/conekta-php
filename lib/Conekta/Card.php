<?php

class Conekta_Card extends Conekta_ApiResource
{

  public $customer;
     
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public function instanceUrl()
  {
    $id = $this['id'];
    $customer = $this->customer;//$this['customer'];
    $class = get_class($this);
    if (!$id) {
      throw new Conekta_InvalidRequestError("Could not determine which URL to request: $class instance has invalid ID: $id", null);
    }
    $id = Conekta_ApiRequestor::utf8($id);
    $customer = Conekta_ApiRequestor::utf8($customer);

    $base = self::classUrl('Conekta_Customer');
    $customerExtn = urlencode($customer->id);//urlencode($customer);
    $extn = urlencode($id);
    return "$base/$customerExtn/cards/$extn";
  }
  
  public function update($params=null)
  {
    $class = get_class();
    return self:: _scopedUpdate($class, $params);
  }

  public function delete($params=null)
  {
    $class = get_class();
    $deleted_card = self::_scopedDelete($class, $params);
    $i = 0;
	foreach($this->customer->cards as $card) {
		if (strcmp($deleted_card->id, $card->id)) {
			$this->customer->cards->__unset($i);
			break;
		}
		$i ++;
	}
    return $deleted_card;
  }

  public function save()
  {
    $class = get_class();
    return self::_scopedSave($class);
  }
}
