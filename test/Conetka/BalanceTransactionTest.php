<?php

class Conekta_BalanceTransactionTest extends ConektaTestCase
{
  public function testList()
  {
    authorizeFromEnv();
    $d = Conekta_BalanceTransaction::all();
    $this->assertEqual($d->url, '/v1/balance/history');
  }
}
