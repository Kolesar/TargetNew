<?php

namespace Kanboard\Plugin\TargetNew\Schema;

use PDO;
const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec("ALTER TABLE users ADD COLUMN base_target VARCHAR(255)");
}
