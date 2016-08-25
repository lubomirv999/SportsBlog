<?php
function pagination($totalItems, $actionURL,  $perPage = 5){
    $pages = ceil($totalItems/$perPage);

    for ($i = 1; $i <= $pages; $i++) {
        echo '<a href="' . $actionURL . '?page=' . $i . '">' . $i . '</a>';
    }
}