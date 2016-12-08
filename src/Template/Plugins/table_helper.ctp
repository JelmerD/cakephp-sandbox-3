<?php
/**
 * @var $this App\View\AppView
 */
$this->assign('title', 'JelmerD/TableHelper');
?>
<div class="row">
    <div class="col-sm-12">
        <nav class="nav nav-inline">
            <?php
            echo $this->Html->link($this->Html->image('https://travis-ci.org/JelmerD/TableHelper.svg?branch=master'), 'https://travis-ci.org/JelmerD/TableHelper', ['class' => 'nav-link', 'escape' => false]);
            echo $this->Html->link('Github', 'https://github.com/JelmerD/TableHelper', ['class' => 'nav-link']);
            echo $this->Html->link('Support', 'https://github.com/JelmerD/TableHelper/issues', ['class' => 'nav-link']);
            ?>
        </nav>
    </div>
</div>
<div class="space"></div>
<div class="row">
    <div class="col-sm-12">
        <?php
        echo $this->Html->tag('h2', 'Installation');
        echo 'to be added';

        echo $this->Html->tag('h2', 'Configuration');
        echo 'to be added';

        echo $this->Html->tag('h2', 'Examples');
        echo $this->Html->tag('h3', 'Basic');
        echo $this->element('Demo/block', ['element' => 'TableHelper/basic']);
        ?>
    </div>
</div>
