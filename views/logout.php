<?php
session_destroy();
Header('Location:' . HTML_ROOT . '/');
die();