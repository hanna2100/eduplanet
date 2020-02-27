<?php

$total_star = 4.9;

for($i=1; $i<=5 ; $i++){

    if($i<=round($total_star)){
        print_r("★");

    }else{
        print_r("☆");

    }
}

?>