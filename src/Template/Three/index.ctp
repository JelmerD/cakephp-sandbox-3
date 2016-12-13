<?php
/**
 * @var $this App\view\AppView
 */
$this->assign('title', 'Three.js');
?>
<div class="row">
    <div class="col-sm-12">
        <?php
        echo $this->Html->link('Lorenz Attractor', ['action' => 'lorenzAttractor'], ['class' => 'btn btn-primary btn-lg btn-block']);
        ?>
    </div>
</div>
