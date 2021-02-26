<?php
// filter for input
function filterInput($content)
{
    $content = trim($content);
    $content = stripslashes($content);

    return $content;
}