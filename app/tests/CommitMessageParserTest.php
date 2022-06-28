<?php
namespace tests;

require_once dirname(__FILE__, 2) . '/autoload.php';

use classes\CommitMessageParser;
use PHPUnit\Framework\TestCase;

final class CommitMessageParserTest extends TestCase {
	public function testParseVol1() {
		$commitMessage = "[add] [feature] @core #123456 Integrovat Premier: export objednávek
		* Export objednávek cronem co hodinu.
		* Export probíhá v dávkách.
		* ...
		BC: Refaktorovaný BaseImporter.
		BC: ...
		Feature: Nový logger.
		TODO: Refactoring autoemail modulu.
		TODO: Refactoring hlavního modulu.";
		
		$commitMessageParser = new CommitMessageParser();
		$commitMessageParsed = $commitMessageParser->parse($commitMessage);
		
		$this->assertSame(['add', 'feature'], $commitMessageParsed->getTags());
		$this->assertSame(123456, $commitMessageParsed->getTaskId());
		$this->assertSame('Integrovat Premier: export objednávek', $commitMessageParsed->getTitle());
		$this->assertSame('Export objednávek cronem co hodinu.', $commitMessageParsed->getDetails()[0]);
		$this->assertSame('Export probíhá v dávkách.', $commitMessageParsed->getDetails()[1]);
		$this->assertSame('Refaktorovaný BaseImporter.', $commitMessageParsed->getBCBreaks()[0]);
		$this->assertSame('Refactoring autoemail modulu.', $commitMessageParsed->getTodos()[0]);
		$this->assertSame('Refactoring hlavního modulu.', $commitMessageParsed->getTodos()[1]);
	}
	
	public function testParseVol2() {
		$commitMessage = "[add] [feature] @core #123456
		* Export objednávek cronem co hodinu.
		* Export probíhá v dávkách.
		* ...
		BC: Refaktorovaný BaseImporter.
		BC: ...
		Feature: Nový logger.
		TODO: Refactoring autoemail modulu.
		TODO: Refactoring hlavního modulu.";
		
		$this->expectExceptionMessage('First line does not match the pattern!');
		
		$commitMessageParser = new CommitMessageParser();
		$commitMessageParsed = $commitMessageParser->parse($commitMessage);
	}
}
