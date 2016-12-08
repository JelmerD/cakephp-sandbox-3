<?php
/**
 * @var $this App\View\AppView
 */
// create a new table
echo $this->Table->create();

// create a new thead section with a row
echo $this->Table->head([
    'ID',
    'Name',
    'Country'
]);

// create a new tbody section with a row
echo $this->Table->body([
    1,
    'Nedim Avtandil',
    'Portugal',
]);

// append two more rows to the already opened tbody section
echo $this->Table->body([
    2,
    'Sieger Anit',
    'Brazil'
]);
echo $this->Table->body([
    3,
    'Eko Krzysztof',
    'Switzerland'
]);

// Close the tbody and table tag
echo $this->Table->end();