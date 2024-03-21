<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Cat;

use ZincsearchEs\Common\Exceptions\RuntimeException;
use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class Snapshots
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Cat
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Snapshots extends AbstractEndpoint
{
    private $repository;

    /**
     * @param string $repository
     *
     * @return $this
     */
    public function setRepository($repository)
    {
        if (isset($repository) !== true) {
            return $this;
        }

        $this->repository = $repository;

        return $this;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        $repository = $this->repository;
        if (isset($this->repository) === true) {
            return "/_cat/snapshots/$repository/";
        }

        return "/_cat/snapshots/";
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'local',
            'master_timeout',
            'h',
            'help',
            'v',
            's',
            'format',
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'GET';
    }
}
