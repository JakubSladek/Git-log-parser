<?php
namespace interfaces;

interface CommitMessageParserInterface {
	public function parse(string $message): CommitMessageInterface;
}
