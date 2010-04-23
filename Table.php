<?php

class Table
{
  protected $hand;
  protected $players = array();
  protected $dealer;
  protected $littleBlind;
  protected $bigBlind;
  protected $pot;

  public function addDealer(Dealer $dealer)
  {
    $this->dealer = $dealer;
  }
  
  public function addPlayer(Player $player)
  {
    if(count($players) >= 10) {
      throw new Exception('Sorry, all the seats are taken at this Table');
    }

    array_push($this->players, $player);
  }

  public function removePlayer($key)
  {
    if(isset($this->players[$key])) {
      return $this->players[$key];
      unset($this->players[$key]);
    }
  }

  public function beginHand()
  {

  }

  public function determineWinner()
  {}

  public function endHand()
  {
    $this->littleBlind = false;
    $this->bigBlind = false;
    $this->pot = 0;
    $this->visibleCards = array();
  }

  // Function that handles betting, asks the dealer to do the dealer's job,
  // and maintains state.
  public function processRound()
  {}
}