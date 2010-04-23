<?php

function __autoload($name)
{
  require $name . '.php';
}

function getStdin()
{
  $value = fgets(STDIN);
  return rtrim(ltrim($value));
}

function getPlayerCount()
{
  echo "\nHow many players (excluding yourself) would you like to have participate? ";

  $players = getStdin();

  if(!is_numeric($players)) {
    echo "\nYou entered an invalid value for the number of players. Please try again.\n";
    return getPlayerCount();
  }

  if($players > 10) {
    echo "\nUnfortuantely, " . $players . " is too many. Please enter a number less than 10.\n";
    return getPlayerCount();
  }

  return $players;
}

function getPlayerBank()
{
  echo "\nEach player needs to start with some money. How much money would you like them to have? (eg. 150): ";

  $bank = getStdin();

  if($bank <= 0 || !is_numeric($bank)) {
    echo "\nI'm sorry, the value you entered was either not numeric or could not be understood. Please enter a whole number (e.g. 150).\n";
    return getPlayerBank();
  }

  return $bank;
}

function setupTable()
{
  $dealer = new Dealer();
  $table = new Table();
  $table->addDealer($dealer);
  return $table;
}

function setupPlayers(Table $table, $players, $bank)
{
  $human = new Player($table, $bank, true);
  $table->addPlayer($human);

  for($players; $players > 0; $players--)
  {
    $player = new Player($table, $bank);
    $table->addPlayer($player);
  }
}

function playHand(Table $table)
{
  $table->playHand();
}

function askForInformation($request)
{
  echo $request . ' ';
  return getStdin();
}

function giveInformation($information)
{
  echo $information . "\n";
}