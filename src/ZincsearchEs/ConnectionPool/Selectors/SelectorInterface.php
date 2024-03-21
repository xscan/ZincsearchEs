<?php

declare(strict_types = 1);

namespace ZincsearchEs\ConnectionPool\Selectors;

/**
 * Class RandomSelector
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Connections\Selectors
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
interface SelectorInterface
{
    /**
     * Perform logic to select a single ConnectionInterface instance from the array provided
     *
     * @param \ZincsearchEs\Connections\ConnectionInterface[] $connections an array of ConnectionInterface instances to choose from
     *
     * @return \ZincsearchEs\Connections\ConnectionInterface
     */
    public function select($connections);
}
