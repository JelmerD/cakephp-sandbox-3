<?php
/**
 * @var $this App\view\AppView
 */
$this->assign('title', 'Plugins');
?>
<div class="row">
    <div class="col-sm-12">
        <?php
        echo $this->Html->link('JelmerD/TableHelper', ['action' => 'tableHelper'], ['class' => 'btn btn-primary btn-lg btn-block']);
        echo $this->Html->link('JelmerD/LogWatcher', ['action' => 'logWatcher'], ['class' => 'btn btn-primary btn-lg btn-block']);
        ?>
    </div>
</div>
