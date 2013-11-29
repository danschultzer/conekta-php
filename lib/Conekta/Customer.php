<?php

class Conekta_Customer extends Conekta_ApiResource
{
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public static function retrieve($id, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedRetrieve($class, $id, $apiKey);
  }

  public static function all($params=null, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedAll($class, $params, $apiKey);
  }

  public static function create($params=null, $apiKey=null)
  {
    $class = get_class();
    return self::_scopedCreate($class, $params, $apiKey);
  }

  public function save()
  {
    $class = get_class();
    return self::_scopedSave($class);
  }

  public function delete($params=null)
  {
    $class = get_class();
    return self::_scopedDelete($class, $params);
  }

  public function addInvoiceItem($params=null)
  {
    if (!$params)
      $params = array();
    $params['customer'] = $this->id;
    $ii = Conekta_InvoiceItem::create($params, $this->_apiKey);
    return $ii;
  }

  public function invoices($params=null)
  {
    if (!$params)
      $params = array();
    $params['customer'] = $this->id;
    $invoices = Conekta_Invoice::all($params, $this->_apiKey);
    return $invoices;
  }

  public function invoiceItems($params=null)
  {
    if (!$params)
      $params = array();
    $params['customer'] = $this->id;
    $iis = Conekta_InvoiceItem::all($params, $this->_apiKey);
    return $iis;
  }

  public function charges($params=null)
  {
    if (!$params)
      $params = array();
    $params['customer'] = $this->id;
    $charges = Conekta_Charge::all($params, $this->_apiKey);
    return $charges;
  }
  
  public function update($params=null)
  {
    $class = get_class();
    return self:: _scopedUpdate($class);
  }
  
  public function updateSubscription($params=null, $apiKey=null)
  {
	$class = get_class();
    return self:: _scopedModifyMember($class, 'put', 'subscription', null, $params);
  }
  
  public function createSubscription($params=null, $apiKey=null)
  {
	$class = get_class();
    return self:: _scopedModifyMember($class, 'post', 'subscription', null, $params);
  }
  
  public function cancelSubscription($params=null, $apiKey=null)
  {
	$class = get_class();
    return self:: _scopedModifyMember($class, 'post', 'subscription', 'cancel');
  }
  
  public function pauseSubscription($params=null, $apiKey=null)
  {
	$class = get_class();
    return self:: _scopedModifyMember($class, 'post', 'subscription', 'pause');
  }
  
  public function resumeSubscription($params=null, $apiKey=null)
  {
    $class = get_class();
    return self:: _scopedModifyMember($class, 'post', 'subscription', 'resume');
  }

  public function deleteDiscount()
  {
    $requestor = new Conekta_ApiRequestor($this->_apiKey);
    $url = $this->instanceUrl() . '/discount';
    list($response, $apiKey) = $requestor->request('delete', $url);
    $this->refreshFrom(array('discount' => null), $apiKey, true);
  }
}
