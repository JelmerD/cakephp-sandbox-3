<?php
/**
 * @var $this App\View\AppView
 */

# start table
echo $this->Table->create('Big test table');

# add a head group
echo $this->Table->head();
echo $this->Table->cell('H1');
echo $this->Table->cell('H2');
echo $this->Table->cell('H3');

# add another head group
echo $this->Table->head([
    'HH1',
    'HH2',
    'HH3'
]);

echo $this->Table->row(['HHH 1', 'HHH 2']);
echo $this->Table->cell('HHH 3');

# start the body
echo $this->Table->body();
echo $this->Table->cell('A1');
echo $this->Table->cell('A2');
echo $this->Table->cell('A3', ['class' => 'success']);

# add another row to the body
echo $this->Table->body([
    'B1',
    'B2',
    ['B3', ['class' => 'success']]
]);

echo $this->Table->row(['C1', 'C2']);
echo $this->Table->cell('<strong>C3</strong>', ['escape' => false]);

echo $this->Table->foot(['f1', 'f2', 'f3']);

echo $this->Table->end();
debug($this->Table->count());



echo $this->Table->create('Test body and cell count');
echo $this->Table->body(['A1', 'A2']);
echo $this->Table->cell('hello world');
echo $this->Table->end();
debug($this->Table->count());



echo $this->Table->create('Fallback');
echo $this->Table->head(['Name', 'Place']);
echo $this->Table->fallback('Empty');
echo $this->Table->end();
debug($this->Table->count());
