<?php

class Dealer
{
  protected $deck = array();
  protected $discarded = array();

  public function __construct()
  {
    $this->deck = require('Cards.php');
    shuffle($this->deck);
  }

  public function beginHand(array $players)
  {

  }

  public function burnACard()
  {
    $burned = array_shift($this->deck);
    array_push($this->discarded, $burned);
  }

  public function dealCards($num)
  {
    //Sanity check
    if($num <= 0) {
      throw new Exception('You cannot request a number of cards that is equal to or less than zero');
    }

    $result = array();
    for($num; $num > 0; $num--)
    {

    }
  }

  public function doTheFlop()
  {}

  public function doTheTurn()
  {}

  public function doTheRiver()
  {}
}