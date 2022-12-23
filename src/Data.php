<?php

namespace Walshdev\LaravelHelpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class Data
{
	/**
	 * @var array
	 */
	private array $data;

	/**
	 * Undocumented function
	 *
	 * @param [type] $name
	 * @return void
	 */
	public function __get($name)
	{
		$data = $this->get($name);

        if (is_array($data) && Arr::isAssoc($data)) {
            return new self($data);
        }

        return $data;
	}

	/**
	 * Create New Instance
	 *
	 * @param array|null $data
	 */
    public function __construct(?array $data)
    {
        $this->data = $data;
    }

	/**
	 * Set data
	 *
	 * @param array $data
	 * @return $this
	 */
	public function set(array $data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Set item
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return $this
	 */
	public function setItem(string $key, mixed $value)
	{
		$this->data[$key] = $value;

		return $this;
	}

	/**
	 * Get data by key
	 *
	 * @param ?string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get(?string $key = null, mixed $default = null): mixed
	{
		if ($key) {
			return data_get($this->data, $key, null) ?? $default;
		}

		return $this->data;
	}

	/**
	 * Get hash
	 *
	 * @param ?string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function hash(?string $key = null, mixed $default = null): mixed
	{
		return Hash::make(data_get($this->data, $key, $default));
	}

	/**
	 * Collect
	 *
	 * @param string $key
	 * @return \Illuminate\Support\Collection
	 */
	public function collect(?string $key = null): \Illuminate\Support\Collection
	{
		return collect($this->get($key));
	}

	/**
	 * Except items
	 *
	 * @param array $items
	 * @return $this
	 */
	public function except(array $items)
	{
		foreach ($items as $item) {
			unset($this->data[$item]);
		}

		return $this;
	}

	/**
	 * Get Hash
	 *
	 * @param string $key
	 * @param array $options
	 * @return string
	 */
    public function getHash(string $key, array $options = []): string
    {
        return Hash::make($this->get($key), $options);
    }

    public function toArray()
    {
        return $this->get();
    }
}
