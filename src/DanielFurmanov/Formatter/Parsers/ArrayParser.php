<?php namespace DanielFurmanov\Formatter\Parsers;

use InvalidArgumentException;
use Illuminate\Contracts\Support\Arrayable;

class ArrayParser extends Parser {

	private $array;

	public function __construct($data) {
		if (is_string($data)) {
			$data = unserialize($data);
		}

		if (is_array($data) || is_object($data)) {
			if ($data instanceof Arrayable) {
				$this->array = $data->toArray();
			} else {
				$this->array = $data;
			}
		} else {
			throw new InvalidArgumentException(
				'ArrayParser only accepts (optionally serialized) [object, array] for $data.'
			);
		}
	}

	public function toArray() {
		return $this->array;
	}
}
