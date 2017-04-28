<?php
 

$times = array(
    'TIME A',
    'TIME B',
    'TIME C',
    'TIME D',
    'TIME E',
    'TIME F'
);


include "roundRobin.class.php";

$RoundRobin = new roundRobin;

$rounds = $RoundRobin->execute($times);

foreach ($rounds as $key => $round) {
    echo '<b>Rodada '.$key.'</b>';
    echo '<br>';
    foreach ($round as $key => $match) {
       echo $match[0].' x '.$match[1];
       echo '<br>';
    }
    echo '<br>';
}
