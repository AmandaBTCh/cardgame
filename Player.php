<?php

class Player
{
  protected $human = false;
  protected $bank = 0;
  protected $table;
  protected $holeCards = array();
  protected $currentBet;

  public function __construct(Table $table, $bank = 0, $human = true)
  {
    $this->human = $human;
    $this->bank = $bank;
    $this->table = $table;
  }

  public function check($tableBet)
  {}

  public function makeDecision($tableBet)
  {
    $this->getCards();
    giveInformation("This is a betting round. You can 'bet', 'check' or 'fold'.");
    giveInformation("Your bank is currently $" . $this->bank);
    $action = askForInformation("What would you like to do?");
    switch($action)
    {
      case 'check': return $this->check($tableBet); break;
      case 'bet': return $this->bet($tableBet); break;
      case 'fold': return $this->fold(); break;
      default:
        giveInformation('The selection you made was not valid. Please try again.');
        return $this->makeDecision($tableBet);
        break;
    }

  }

  public function getCards()
  {
      $hole = false;
      $table = false;
      
      foreach($holeCards as $card) {
          $hole .= implode('', $card) . ' ';
      }

      foreach($table->getVisibleCards() as $card) {
          $table .= implode('', $card) . ' ';
      }

      giveInformation("Your private hole cards are $hole");
      if(!empty($table)) {
        giveInformation("The table cards are $table");
      }
  }

  public function bet($tableBet)
  {
    $amount = askForInformation("How much would you like to wager?");
    if($amount < 0 || !is_numeric($amount)) {
      giveInformation('The bet you provided was invalid.');
      $this->makeDecision($tableBet);
      return;
    }

    if(($amount+$currentBet) < $tableBet) {
      giveInformation("Your bet was too small to meet the current table bet. Please increase your bet.");
      return $this->bet($tableBet);
    }

    $this->currentBet = $tableBet;
    $this->subtractFromBank($amount);
    return $amount;
  }

  public function fold()
  {
    $cards = $this->holeCards;
    $this->holeCards = false;
    return $cards;
  }

  public function call()
  {}

  public function payBlind($amount)
  {
    $this->subtractFromBank($amount);
    return $amount;
  }


  protected function addToBank($amount)
  {
    if($amount < 0 || !is_numeric($amount)) {
      return;
    }

    $this->bank += $amount;
  }

  protected function subtractFromBank($amount)
  {
    if($amount < 0 || !is_numeric($amount)) {
      return;
    }

    $bank = $this->bank;
    $bank -= $amount;
    if($bank < 0) {
      throw new Exception('Your bank cannot fall below 0; you are out of the game!');
    }

    $this->bank = $bank;
  }

  public function __get($name)
  {
    return $this->{$name};
  }

  public function acceptHoleCards(array $cards)
  {
    if(count($cards) < 2) {
      throw new Exception('You gave me too few cards');
    }

    if(count($cards) > 2) {
      throw new Exception('I have too many cards');
    }

    $this->holeCards = $cards;
  }

  public function isHuman()
  {
    return $this->human;
  }

}