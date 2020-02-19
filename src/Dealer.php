<?php

namespace Blackjack;
session_start();

use PDO;
use PDOException;

class Dealer
{
    public $stay = false;

    public function __construct()
    {
        //Dağıtıcının toplam puanı 17'den küçükse ve oyuncu tarafından stay edildi ise 17 puan olana kadar kart dağıtıcı kart çekiyor.
        if ($this->getTotal() < 17 and $this->stay == true) {
            $this->getCard();
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
        if (empty($_SESSION['IdsForDealer'])) {
            $db = $this->databaseConnect();
            //Rastgele iki adet kart çekiyoruz.
            $allCards = $db->query("SELECT * FROM playcards ORDER BY RAND() LIMIT 2", PDO::FETCH_ASSOC);
            $cards = [];
            foreach ($allCards as $key => $allCard) {
                $cards[] = $allCard;
            }
            //Hangi kartların çekildiğini bilmek için ID değerlerini saklıyoruz.
            $_SESSION['IdsForDealer'] = [$cards[0]['id'], $cards[1]['id']];
            //Tüm kartları dizi olarak saklıyoruz.
            $_SESSION['assignedCard'] = $cards;
        }
        return $_SESSION['assignedCard'];
    }

    public function getTotal()
    {
        $sumValue = 0;
        foreach ($this->assignedCard() as $key => $card) {
            //Eğer kazanan veya kaybeden kimse yoksa dağıtıcının ilk kartı her zaman kapalı kalacak.
            //Dolayısıyla ilk kartın değerini toplama yansımaması için sıfırlıyoruz.
            if ($key == 0 and !isset($_SESSION['status'])) {
                $card['value_tinyint'] = 0;
            }
            $sumValue += $card['value_tinyint'];
        }
        $_SESSION['dealerTotalPoint'] = $sumValue;
        //Çekilen kartların oluşturduğu toplam miktarı alıyoruz.
        return $sumValue;
    }

    public function getCard()
    {
        $this->stay = true;
        $db = $this->databaseConnect();
        $getCard = $db->query("SELECT * FROM playcards ORDER BY RAND() LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        //Yeni çekilecek kartın daha önce çekilmemiş olması şartını koşuyoruz.
        if (!array_search($getCard['id'], $_SESSION['IdsForDealer'])) {
            array_push($_SESSION['assignedCard'], $getCard);
            array_push($_SESSION['IdsForDealer'], $getCard['id']);
        } else {
            $this->getCard();
        }

        //Elimizdeki toplam puan 11 ve üzerine çıktı ise var olan herhangi bir As kartın değerini 1 olarak değiştirdik.
        if ($this->getTotal() >= 11) {
            for ($i = 1; $i < count($_SESSION['assignedCard']); $i++) {
                if (array_search("ace", $_SESSION['assignedCard'][$i])) {
                    $_SESSION['assignedCard'][$i]['value_tinyint'] = 1;
                }
            }
        }
        header("location: //" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "");
    }

    public function setController()
    {
        if ($this->getTotal() == 21) { //Dağıtıcı toplam puanı 21 olunca kazanıyor
            $_SESSION['status'] = 'DealerBlackjack';
        } elseif ($this->getTotal() > 21) { //Dağıtıcı toplam puanı 21'den fazla olunca kaybediyor
            $_SESSION['status'] = 'DealerBust';
        }
    }
}