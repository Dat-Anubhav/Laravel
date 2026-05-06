<?php

// def :- Composer is a tool for PHP that installs the libraries your project needs.
// It also helps PHP load those libraries automatically.

// composer.json says: “I need these libraries.”
// composer.lock says: “These exact versions are installed.”
// vendor/ is the physical folder that actually contains the downloaded code of those libraries.

require __DIR__ . '/vendor/autoload.php';
use Cocur\Slugify\Slugify;

$s=new Slugify();
echo $s->slugify("The sky is blue, and the grass is green");
?>