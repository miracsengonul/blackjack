<?php

require 'vendor/autoload.php';

use Blackjack\Dealer;
use Blackjack\Player;
use Blackjack\Controller;

$dealer = new Dealer();
$player = new Player();
$controller = new Controller();

if (isset($_GET['hit'])) {
    $player->getCard(); //Oyuncu kartı çekiliyor.
} elseif (isset($_GET['stay'])) {
    $dealer->getCard(); //Dağıtıcı, kart çekiyor
    $controller->control(); //Kazanan sonuca göre belli oluyor.
} elseif (isset($_GET['newGame'])) {
    $controller->deleteSession(); //Oyun yeniden başlıyor.
}

if (isset($_SESSION['status'])) {
    //Oyuncu kaybettiyse veya Dağıtıcı Kazandıysa
    if ($_SESSION['status'] == 'PlayerBust' or $_SESSION['status'] == 'DealerBlackjack') {
        echo "<script>alert('Bust ☹ Your Score: " . $player->getTotal() . "')</script>";
        header("Refresh:3; url=index.php?newGame");
    } //Oyuncu kazandıysa veya Dağıtıcı kaybettiyse
    elseif ($_SESSION['status'] == 'PlayerBlackjack' or $_SESSION['status'] == 'DealerBust') {
        echo "<script>alert('💥 🔥  You Won! 🌟 ✨ Your Score: " . $player->getTotal() . "! and Dealer Score :".$dealer->getTotal()." ')</script>";
        header("Refresh:3; url=index.php?newGame");
    }
    elseif($_SESSION['status'] == 'Draw')
    {
        echo "<script>alert('😕💥 Draw')</script>";
        header("Refresh:3; url=index.php?newGame");
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="text-align: center;">
    <hr>
    <!-- Navbar Section !-->
    <div class="row" style="width: 100%;position: fixed;top: 0;background-color: white;z-index:1;">
        <div class="col-md-4 col-sm-4 col-xs-4">
            <h1>Dealer (<?= $dealer->getTotal(); ?>)</h1>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top: 15px;">
            <a href="index.php?hit" class="btn btn-success btn-lg">⊕ Hit</a>
            <a href="index.php?stay" class="btn btn-primary btn-lg">✋ Stay</a>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: left">
            <h1>Your (<?= $player->getTotal(); ?>)</h1>
        </div>
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['status'])) { ?>
                <h2> Redirecting after 3 seconds...</h2>
            <? } ?>
        </div>
    </div>
    <!-- /Navbar Section !-->
    <hr style="margin-top: 85px">
    <!-- Dealer Section !-->
    <div class="col-lg-6">
        <div class="row">
            <?php
            foreach ($dealer->assignedCard() as $key => $card) {
                if ($key == 0 and !isset($_SESSION['status'])) {
                    $card['value_symbol'] = '';
                    $card['suit_color'] = 'black';
                    $card['suit_symbol'] = '❓';
                    $card['value_symbol'] = '?';
                    $card['value_tinyint'] = 'unknown';
                }
                ?>
                <div class="col-lg-5">
                    <div class="panel panel-default" style="box-shadow: 1px 2px 2px black">
                        <div class="panel-heading" style="background-color: white"><b><?= $card['value_tinyint']; ?>
                                point</b></div>
                        <div class="panel-body">
                            <h2 style="text-align: left;color:<?= $card['suit_color']; ?>">
                                <b><?php echo $card['value_symbol']; ?></b></h2>
                            <h3 style="text-align:left;color:<?= $card['suit_color']; ?>"><?php echo $card['suit_symbol']; ?></h3>
                            <h1 style="font-size:88px;color:<?= $card['suit_color']; ?>"><?php echo $card['suit_symbol']; ?></h1>
                            <h3 style="text-align:right;color:<?= $card['suit_color']; ?>"><?php echo $card['suit_symbol']; ?></h3>
                            <h2 style="text-align: right;color:<?= $card['suit_color']; ?>">
                                <b><?php echo $card['value_symbol']; ?></b></h2>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- /Dealer Section !-->
    <!-- Player Section !-->
    <div class="col-lg-6">
        <div class="row">
            <?php
            foreach ($player->assignedCard() as $key => $card) {
                ?>
                <div class="col-lg-5">
                    <div class="panel panel-warning" style="box-shadow: 1px 2px 2px yellow">
                        <div class="panel-heading" style="background-color: white"><b><?= $card['value_tinyint']; ?>
                                point</b></div>
                        <div class="panel-body">
                            <h2 style="text-align: left;color:<?= $card['suit_color']; ?>">
                                <b><?php echo $card['value_symbol']; ?></b></h2>
                            <h3 style="text-align:left;color:<?= $card['suit_color']; ?>"><?php echo $card['suit_symbol']; ?></h3>
                            <h1 style="font-size:88px;color:<?= $card['suit_color']; ?>"><?php echo $card['suit_symbol']; ?></h1>
                            <h3 style="text-align:right;color:<?= $card['suit_color']; ?>"><?php echo $card['suit_symbol']; ?></h3>
                            <h2 style="text-align: right;color:<?= $card['suit_color']; ?>">
                                <b><?php echo $card['value_symbol']; ?></b></h2>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- /Player Section !-->
</div>
<script>
    window.scrollTo(0, document.body.scrollHeight);
</script>
</body>
</html>






