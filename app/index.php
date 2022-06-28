<?php

require_once 'autoload.php';

$commitMessage = "[add] [feature] @core #123456
		* Export objednávek cronem co hodinu.
		* Export probíhá v dávkách.
		* ...
		BC: Refaktorovaný BaseImporter.
		BC: ...
		Feature: Nový logger.
		TODO: Refactoring autoemail modulu.";

$commitMessageParser = new \classes\CommitMessageParser();
var_dump($commitMessageParser->parse($commitMessage));
