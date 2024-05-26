<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Revision.php';

use RentACar\Revision;

$revisions = Revision::search([], 'revision');