<?php
/**
 * @var $this App\View\AppView
 */
if (!isset($element)) {
    throw new BadFunctionCallException('Define the `element` in the $options array. (ie. TableHelper/simple)');
}
if (!isset($render) || !is_bool($render)) {
    $render = true;
}

echo $this->Html->scriptBlock('hljs.initHighlightingOnLoad();', ['block' => 'script']);

# get the contents of the demo file
$text = file_get_contents(APP . 'Template' . DS . 'Element' . DS . 'Demo' . DS . $element . '.ctp');
# remove the comment stuff
$text = preg_replace('~\s?/\*.*?\*/\s?~s', '', $text);
?>

<div class="demo-sample">
    <pre>
        <?= $this->Html->tag('code', $text, ['class' => 'php', 'escape' => true]) ?>
    </pre>
    <?php
    if ($render) {
        echo $this->element('Demo/' . $element);
    }
    ?>
</div>