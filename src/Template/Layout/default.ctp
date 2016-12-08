<?php
/**
 * @var $this App\View\AppView
 */
?>
<?= $this->Html->docType() ?>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    echo $this->Html->tag('title', sprintf('Sandbox: %s', $this->fetch('title')));

    echo $this->Html->meta('icon');

    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css', [
        'integrity' => '',
        'crossorigin' => ''
    ]);
    echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/styles/default.min.css');
    echo $this->Html->css('style');

    echo $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js');
    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', [
        'integrity' => 'sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7',
        'crossorigin' => 'anonymous'
    ]);
    echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js', [
        'integrity' => 'sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8',
        'crossorigin' => 'anonymous'
    ]);
    echo $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js', [
        'integrity' => 'sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK',
        'crossorigin' => 'anonymous'
    ]);
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="navbar navbar-dark bg-inverse navbar-fixed-top navbar-full">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <?= $this->Html->link('Home', '/', ['class' => 'nav-link']); ?>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://sandbox.jelmerdroge.nl" id="navbarDropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Plugins
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?= $this->Html->link('JelmerD/TableHelper', ['controller' => 'Plugins', 'action' => 'tableHelper'], ['class' => 'dropdown-item']) ?>
                <?= $this->Html->link('JelmerD/LogWatcher', ['controller' => 'Plugins', 'action' => 'logWatcher'], ['class' => 'dropdown-item']) ?>
            </div>
        </li>
    </ul>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?= $this->Html->tag('h1', $this->fetch('title')) ?>
        </div>
    </div>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
</body>
</html>
