<?php

namespace classes;

use interfaces\CommitMessageParserInterface;

class CommitMessageParser implements CommitMessageParserInterface {
	/**
	 * @throws \ErrorException
	 */
	public function parse(string $message): CommitMessage {
		$messageLines = collect(explode(PHP_EOL, $message))->map(fn(string $line) => trim($line));
		$firstLineStr = $messageLines->shift();
		
		if (!preg_match_all('/(\[\w*])\s(@\w+)\s(#\d{6})\s(\w*)/u', $firstLineStr)) {
			throw new \ErrorException('First line does not match the pattern!');
		}
		
		$firstLine = collect(explode(" ", $firstLineStr));
		
		$title = $firstLine->filter(function (string $text) {
			return !(str_starts_with($text, "[") || str_starts_with($text, '#') || str_starts_with($text, '@'));
		})->join(' ');
		
		$taskId = trim($firstLine->filter(fn(string $text) => str_starts_with($text, '#'))->first(), '#');
		
		$tags = $firstLine
			->filter(fn(string $text) => (str_starts_with($text, "[") && str_ends_with($text, "]")))
			->map(fn(string $tag) => trim($tag, '[]'))
			->values()
			->toArray();
		
		$details = $messageLines
			->filter(fn(string $line) => str_starts_with($line, '*') && preg_match('/\b(\w+)\b/u', $line))
			->map(fn(string $line) => trim($line, '* '))
			->values()
			->toArray();
		
		$bcBreaks = $messageLines
			->filter(fn(string $line) => str_starts_with($line, 'BC: ') && preg_match('/\b(\w+)\b/u', str_replace('BC: ', '', $line)))
			->map(fn(string $line) => str_replace('BC: ', '', $line))
			->values()
			->toArray();
		
		$todos = $messageLines
			->filter(fn(string $line) => str_starts_with($line, 'TODO: '))
			->map(fn(string $line) => str_replace('TODO: ', '', $line))
			->values()
			->toArray();
		
		return new CommitMessage($title, $taskId, $tags, $details, $bcBreaks, $todos);
	}
}
