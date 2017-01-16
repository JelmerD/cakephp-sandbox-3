<?php
/**
 * @var $this App\View\AppView
 */
?>
<div id="map"></div>
<div id="debug">
    <div class="usersinfo"></div>
    <div class="updated">Updated: <span>-</span></div>
</div>
<?php
echo $this->Html->css('WhereAreYou.style.css');
echo $this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCG1DKAgBstKJFo5q9XaPAVo4mAGaat1zw');
echo $this->Html->script('jscookie');
echo $this->Html->scriptBlock(sprintf('var global = \'%s\';', json_encode($jsData)));
echo $this->Html->script('WhereAreYou.script.js');
