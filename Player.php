<?php

class Player
{
  protected $human = false;
  protected $bank = 0;
  protected $table;
  protected $holeCards = array();

  public function __construct(Table $table, $bank = 0, $human = false)
  {
    $this->human = $human;
    $this->bank = $bank;
    $this->table = $table;
  }

  public function check()
  {}

  public function bet($amount)
  {}

  public function fold()
  {}

  public function call()
  {}

  public function payBlind($amount)
  {
    $this->subtractFromBank($amount);
    return $amount;
  }

  public function makeDecision($round)
  {
    if($this->human) {
      throw new Exception('Human players make their own decisions');
    }
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