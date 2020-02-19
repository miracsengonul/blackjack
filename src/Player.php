<?php

namespace Blackjack;

use PDO;
use PDOException;

class Player
{
    public function __construct()
    {
        if (isset($_SESSION['assignedCardPlayer']) and $this->getTotal() >= 11) {
            for ($i = 0; $i < count($_SESSION['assignedCardPlayer']); $i++) {
                if (array_search("ace", $_SESSION['assignedCardPlayer'][$i])) {
                    $_SESSION['assignedCardPlayer'][$i]['value_tinyint'] = 1;
                }
            }
        }
        $this->setController();
    }

    public function databaseConnect()
    {
        try {
            $database = new PDO("mysql:host=localhost;dbname=blackjack;charset=utf8", "root", "");
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return $database;
    }

    public function assignedCard()
    {
        //Daha önce hiç kart çekilmedi ise
        if (empty($_SESSION['IdsForPlayer'])) {
            $db = $this->databaseConnect();
            //Rastgele iki adet kart çekiyoruz.
            $allCards = $db->query("SELECT * FROM playcards ORDER BY RAND() LIMIT 2", PDO::FETCH_ASSOC);
            $cards = [];
            foreach ($allCards as $allCard) {
                $cards[] = $allCard;
            }
            //Hangi kartların çekildiğini bilmek için ID değerlerini saklıyoruz.
            $_SESSION['IdsForPlayer'] = [$cards[0]['id'], $cards[1]['id']];
            //Tüm kartları dizi olarak saklıyoruz.
            $_SESSION['assignedCardPlayer'] = $cards;
        }
        return $_SESSION['assignedCardPlayer'];
    }

    public function getTotal()
    {
        $sumValue = 0;
        foreach ($this->assignedCard() as $key => $card) {
            $sumValue += $card['value_tinyint'];
        }
        $_SESSION['playerTotalPoint'] = $sumValue;
        //Çekilen kartların oluşturduğu toplam miktarı alıyoruz.
        return $sumValue;
    }

    public function getCard()
    {
        $db = $this->databaseConnect();
        $getCard = $db->query("SELECT * FROM playcards ORDER BY RAND() LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        //Yeni çekilecek kartın daha önce çekilmemiş olması şartını koşuyoruz.
        if (!array_search($getCard['id'], $_SESSION['IdsForPlayer'])) {
            array_push($_SESSION['assignedCardPlayer'], $getCard);
            array_push($_SESSION['IdsForPlayer'], $getCard['id']);
        } else {
            $this->getCard();
        }
        header("location: //" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "");
    }

    public function setController()
    {
        if ($this->getTotal() == 21) { //Oyuncu toplam puanı 21 olunca kazanıyor
            $_SESSION['status'] = 'PlayerBlackjack';
        } elseif ($this->getTotal() > 21) { //Oyuncu toplam puanı 21'den fazla olunca kaybediyor
            $_SESSION['status'] = 'PlayerBust';
        }
    }
}