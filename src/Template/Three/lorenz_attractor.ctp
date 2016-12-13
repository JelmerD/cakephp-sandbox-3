<?php
/**
 * @var $this App\view\AppView
 */
$this->assign('title', 'Lorenz Attractor');
echo $this->Html->script('//cdn.rawgit.com/mrdoob/three.js/master/build/three.min.js', ['once' => true]);
echo $this->Html->script('//cdn.rawgit.com/mrdoob/three.js/dev/examples/js/controls/OrbitControls.js', ['once' => true]);
echo $this->Html->script('three/lorenz-attractor');
?>
<div class="row">
    <div class="col-sm-12">
        <nav class="nav nav-inline">
            <?php
            echo $this->Html->link('Github', 'https://github.com/JelmerD/cakephp-sandbox-3/blob/master/webroot/js/three/lorenz-attractor.js', ['class' => 'nav-link']);
            echo $this->Html->link('Wikipedia: Lorenz Attractor', 'https://en.wikipedia.org/wiki/Lorenz_system', ['class' => 'nav-link']);
            ?>
        </nav>
    </div>
</div>
<div class="space"></div>
<div class="row">
    <div class="col-sm-12">
        <div id="three-container"></div>
    </div>
</div>
<div class="space"></div>
<div class="row">
    <div class="col-md-3">
        Omega: <span class="val-o"></span>
    </div>
    <div class="col-md-9">
        <input id="set-o" type="range" min="0" max="40" step="0.1" oninput="setVariable('o')" class="slider-wide"/>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        Rho: <span class="val-r"></span>
    </div>
    <div class="col-md-9">
        <input id="set-r" type="range" min="0" max="40" step="0.1" oninput="setVariable('r')" class="slider-wide"/>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        Beta: <span class="val-b"></span>
    </div>
    <div class="col-md-9">
        <input id="set-b" type="range" min="0" max="40" step="0.1" oninput="setVariable('b')" class="slider-wide"/>
    </div>
</div>
<div class="space"></div>
<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-primary" onclick="clearCanvas()">Clear canvas</button>
    </div>
</div>
