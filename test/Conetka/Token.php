<?php

class Conekta_TokenTest extends UnitTestCase
{
  public function testUrls()
  {
    $this->assertEqual(Conekta_Token::classUrl('Conekta_Token'), '/v1/tokens');
    $token = new Conekta_Token('abcd/efgh');
    $this->assertEqual($token->instanceUrl(), '/v1/tokens/abcd%2Fefgh');
  }
}