<?php

include_once 'vendor/autoload.php';

define('SRC_ROOT', __DIR__ . '/src');
define('DS', DIRECTORY_SEPARATOR);

if (ltrim($_SERVER['REQUEST_URI'], '/') === 'product') {
    $controller = new \Balance\UiComponents\Controller\Product();
}
?>
<script>
    var require = {
        'baseUrl': 'http://ui.components/src'
    };
</script>
<script src="/src/lib/require.js"></script>
<script src="/src/lib/underscore.js"></script>
<script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
<div id="ui-component-base" style="display: none">
    <?= $controller->execute(); ?>
</div>
<script>
    require(['lib/app'], (app) => {new app()})
</script>