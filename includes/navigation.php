<?php

$isHome = $_SERVER['REQUEST_URI'] == '/' ? 'selected' : '';
$isLoops = $_SERVER['REQUEST_URI'] == '/loops/' ? 'selected' : '';
$isCountdown = $_SERVER['REQUEST_URI'] == '/countdown/' ? 'selected' : '';
$isMagic8Ball = $_SERVER['REQUEST_URI'] == '/magic-8ball/' ? 'selected' : '';
$isMovieList = $_SERVER['REQUEST_URI'] == '/movielist/' ? 'selected' : '';
$isDiceGame = $_SERVER['REQUEST_URI'] == '/dice-game/' ? 'selected' : '';
$isLogin = $_SERVER['REQUEST_URI'] == '/login/' ? 'selected' : '';
$isCustomerList = $_SERVER['REQUEST_URI'] == '/customer-list/' ? 'selected' : '';
?><nav>
    <ul>
        <li class="<?=$isHome?>"><a href="/">Home</a></li>
        <li class="<?=$isLoops?>"><a href="/loops/">Loops</a></li>
        <li class="<?=$isCountdown?>"><a href="/countdown/">Countdown</a></li>
        <li class="<?=$isMagic8Ball?>"><a href="/magic-8ball/">Magic 8 Ball</a></li>
        <li class="<?=$isMovieList?>"><a href="/movielist/">Movie List</a></li>
        <li class="<?=$isDiceGame?>"><a href="/dice-game/">Dice Game</a></li>
        <li class="<?=$isLogin?>"><a href="/login/">Login</a></li>
        <li class="<?=$isCustomerList?>"><a href="/customer-list/">Customer List</a></li>
    </ul>
</nav>
