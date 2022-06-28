<?php
namespace interfaces;

interface CommitMessageInterface {
	/** @return string Integrovat Premier: export objednávek */
	public function getTitle(): string;
	
	/** @return int|null 123456 */
	public function getTaskId(): ?int;
	
	/** @return string[] ['add', 'feature'] */
	public function getTags(): array;
	
	/** @return string[] ['Export objednávek cronem co hodinu.', 'Export probíhá v
	 * dávkách.'] */
	public function getDetails(): array;
	
	/** @return string[] */
	public function getBCBreaks(): array;
	
	/** @return string[] */
	public function getTodos(): array;
}
