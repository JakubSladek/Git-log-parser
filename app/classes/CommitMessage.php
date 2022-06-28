<?php
namespace classes;

use ErrorException;
use interfaces\CommitMessageInterface;

class CommitMessage implements CommitMessageInterface {
	public function __construct(
		private string $title,
		private ?int $taskId,
		private array $tags,
		private array $details,
		private array $bcBreaks,
		private array $todos,
	) {}
	
	public function getTitle(): string {
		return $this->title;
	}
	
	public function setTitle(string $title): void {
		$this->title = $title;
	}
	
	public function getTaskId(): ?int {
		return $this->taskId;
	}
	
	public function setTaskId(int $taskId): void {
		$this->taskId = $taskId;
	}
	
	public function getTags(): array {
		return $this->tags;
	}
	
	public function setTags(array $tags): void {
		$this->tags = $tags;
	}
	
	public function getDetails(): array {
		return $this->details;
	}
	
	public function setDetails(array $details): void {
		$this->details = $details;
	}
	
	public function getBCBreaks(): array {
		return $this->bcBreaks;
	}
	
	public function setBCBreaks(array $bcBreaks): void {
		$this->bcBreaks = $bcBreaks;
	}
	
	public function getTodos(): array {
		return $this->todos;
	}
	
	public function setTodos(array $todos): void {
		$this->todos = $todos;
	}
}
