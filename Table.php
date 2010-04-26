<?php

class Table
{
  protected $hand;
  protected $players = array();
  protected $dealer;
  protected $littleBlind;
  protected $bigBlind;
  protected $pot = 0;
  protected $visibleCards = array();
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

  public function addToPot($amount)
  {
    if(!is_numeric($amount) || $amount < 0) {
      throw new Exception('You cannot add a non-numeric/negative amount to the pot');
    }

    $this->pot += $amount;
  }

  public function startHand()
  {
    // Blinds
    // Hole cards dealt
    // First round of betting, starting with third player
    // Compare that bets are even; if not, redo betting until even.
  }

  public function bettingRound($order)
  {
    foreach($order as $player) {
      $decision = $player->makeDecision($this->pot);
      if(is_numeric($decision)) {
        $this->addToPot($amount);
      } elseif (is_array($decision)) {
        $this->dealer->acceptReturnedCards($decision);
      } else {
        throw new Exception('Unable to determine what this player did.');
      }
    }
  }

  public function getVisibleCards()
  {
    return $this->visibleCards;
  }
}