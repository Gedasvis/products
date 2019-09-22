<?php

// Headers
echo "id; name; price; description; photo; modified; created; \n";

// Iteration
foreach($data as $row)
{
    echo $row['id'] . ";";
    echo $row['name'] . ";";
    echo $row['price'] . ";";
    echo $row['description'] . ";";
    echo $row['photo'] . ";";
    echo $row['modified'] . ";";
    echo $row['created'] . ";";
    echo "\n";
}