<?php
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . "/students/m1/run8/mnebmnassir/phpcrudsample/" .$class_name . '.php';
});
?>