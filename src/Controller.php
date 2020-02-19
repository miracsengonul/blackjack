<?php

namespace Blackjack;

class Controller
{
    public $dealerTotalPoint;
    public $playerTotalPoint;

    public function control()
    {
        //Dağıtıcının ve oyuncunun toplam puanları çekiliyor
        $this->dealerTotalPoint = $_SESSION['dealerTotalPoint'];
        $this->playerTotalPoint = $_SESSION['playerTotalPoint'];
        //Puan durumuna göre kazanan belli oluyor.
        if ($this->playerTotalPoint == $this->dealerTotalPoint) {
            $_SESSION['status'] = 'Draw';
        } elseif ($this->playerTotalPoint > $this->dealerTotalPoint) {
            $_SESSION['status'] = 'PlayerBlackjack';
        } else {
            $_SESSION['status'] = 'DealerBlackjack';
        }
    }

    public function deleteSession()
    {
        unset($_SESSION['assignedCardPlayer']);
        unset($_SESSION['IdsForPlayer']);
        unset($_SESSION['status']);
        session_destroy();
        header("location: //" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "");
    }
}