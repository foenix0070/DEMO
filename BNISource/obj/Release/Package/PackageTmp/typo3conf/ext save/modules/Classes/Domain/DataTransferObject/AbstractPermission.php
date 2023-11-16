<?php

namespace CodingMs\Modules\Domain\DataTransferObject;

use ArrayAccess;
use Countable;

/**
 * DTO: Permission access Backend User Groups
 *
 * @implements ArrayAccess<string,array|string>
 * @usage $GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions'][class::KEY]
 * @see \TYPO3\CMS\Backend\Form\FormDataProvider\AbstractItemProvider::addItemsFromSpecial
 */
abstract class AbstractPermission implements ArrayAccess, Countable
{
    /** @var array */
    protected array $data;

    abstract protected function populateData(): void;

    /**
     * Constructor: Abstract invoke of function
     */
    public function __construct()
    {
        $this->populateData();
    }

    /**
     * Whether an offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param  mixed  $offset
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param  mixed  $offset
     * @param  mixed  $value
     */
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param  mixed  $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * Count elements of an object
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
    }
}
