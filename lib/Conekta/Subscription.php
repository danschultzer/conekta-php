<?php

class Conekta_Subscription extends Conekta_ApiResource
{

  public $customer;
     
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public function instanceUrl()
  {
    $customer = $this->customer;
    $class = get_class($this);
    $customer = Conekta_ApiRequestor::utf8($customer);
    $base = self::classUrl('Conekta_Customer');
    $customerExtn = urlencode($customer->id);
    return "$base/$customerExtn/subscription";
  }
  
  public function update($params=null)
  {
    $class = get_class();
    return self:: _scopedUpdate($class, $params);
  }

  public function cancel($params=null)
  {
    $class = get_class();
    return self::_scopedModifyMember($class, 'customer', $params, 'cancel', 'post');
  }
  
  public function pause($params=null)
  {
    $class = get_class();
    return self::_scopedModifyMember($class, 'customer', $params, 'pause', 'post');
  }
  
  public function resume($params=null)
  {
    $class = get_class();
    return self::_scopedModifyMember($class, 'customer', $params, 'resume', 'post');
  }
  

  public function save()
  {
    $class = get_class();
    return self::_scopedSave($class);
  }
}
