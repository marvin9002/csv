<?php
/**
* This file is part of the League.csv library
*
* @license http://opensource.org/licenses/MIT
* @link https://github.com/thephpleague/csv/
* @version 9.0.0
* @package League.csv
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
declare(strict_types=1);

namespace League\Csv;

use Iterator;
use IteratorIterator;

/**
 *  A simple MapIterator
 *
 * @package  League.csv
 * @since    3.3.0
 * @author   Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @internal used internally to modify CSV content
 *
 */
class MapIterator extends IteratorIterator
{
    /**
     * The function to be apply on all InnerIterator element
     *
     * @var callable
     */
    private $callable;

    /**
     * The Constructor
     *
     * @param Iterator $iterator
     * @param callable $callable
     */
    public function __construct(Iterator $iterator, callable $callable)
    {
        parent::__construct($iterator);
        $this->callable = $callable;
    }

    /**
     * Get the value of the current element
     */
    public function current()
    {
        $iterator = $this->getInnerIterator();

        return ($this->callable)($iterator->current(), $iterator->key(), $iterator);
    }
}