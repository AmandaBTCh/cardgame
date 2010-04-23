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
    foreach($players as $player)
    {
      $cards = $this->dealCards(2);
      $player->acceptHoleCards($cards);
      if($player->isHuman()) {
        $card1 = $cards[0]['suite'] . $cards[0]['value'];
        $card2 = $cards[1]['suite'] . $cards[1]['value'];
        giveInformation('Your hole cards are ' . $card1 . ' and ' . $card2);
      }
    }
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
      $result[] = array_shift($this->deck);
    }

    return $result;
  }

  public function doTheFlop()
  {}

  public function doTheTurn()
  {}

  public function doTheRiver()
  {}
}