<?php

class Table
{
  protected $hand;
  protected $players = array();
  protected $dealer;
  protected $littleBlind;
  protected $bigBlind;
  protected $pot = 0;
  protected $visibleCards;
  protected $roundOrder = array();

  public function addDealer(Dealer $dealer)
  {
    $this->dealer = $dealer;
  }
  
  public function addPlayer(Player $player)
  {
    if(count($this->players) >= 10) {
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

  public function playHand()
  {
    $this->determineBlinds();
    giveInformation("The pot is now $" . $this->pot . ".");
    $this->dealer->beginHand($this->players);
    $this->goAround(true);
  }

  public function determineWinner()
  {}

  // Function that handles betting, asks the dealer to do the dealer's job,
  // and maintains state.
  public function processRound()
  {}

  public function determineBlinds()
  {
    $this->bigBlind = array_shift($this->players);
    $this->littleBlind = array_pop($this->players);
    $bb = $this->bigBlind->payBlind(6);
    $lb = $this->littleBlind->payBlind(3);
    $this->roundOrder[] = $this->littleBlind;
    $this->roundOrder[] = $this->bigBlind;
    array_merge($this->roundOrder, $this->players);
    array_unshift($this->players, $this->bigBlind);
    array_unshift($this->players, $this->littleBlind);
    $this->addToPot($bb + $lb);
  }

  public function addToPot($amount)
  {
    if(!is_numeric($amount) || $amount < 0) {
      throw new Exception('You cannot add a non-numeric/negative amount to the pot');
    }

    $this->pot += $amount;
  }

  public function goAround($firstRound = false)
  {

  }


   public function __get($name)
   {
     return $this->{$name};
   }
}