<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Revision.php';

use RentACar\Revision;

$revisionId = $_GET['id'];

$revision = Revision::find($revisionId, 'revision');