<?php
require 'init.php';

unset($_SESSION['userId']);
header('Location: index.php');