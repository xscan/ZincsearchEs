<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Indices;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Shrink.
 *
 * @category ZincsearchEs
 *
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 *
 * @link     http://elastic.co
 */
class Shrink extends AbstractEndpoint
{
    /**
     * The name of the target index to shrink into
     *
     * @var string
     */
    private $target;

    /**
     * @param array $body
     *
     * @throws \ZincsearchEs\Common\Exceptions\InvalidArgumentException
     *
     * @return $this
     */
    public function setBody($body)
    {
        if (isset($body) !== true) {
            return $this;
        }

        $this->body = $body;

        return $this;
    }

    /**
     * @param string $target
     *
     * @return $this
     */
    public function setTarget($target)
    {
        if (isset($target) !== true) {
            return $this;
        }
        $this->target = $target;

        return $this;
    }

    /**
     * @throws \ZincsearchEs\Common\Exceptions\BadMethodCallException
     *
     * @return string
     */
    public function getURI()
    {
        if (isset($this->index) !== true) {
            throw new Exceptions\RuntimeException(
                'index is required for Shrink'
            );
        }
        if (isset($this->target) !== true) {
            throw new Exceptions\RuntimeException(
                'target is required for Shrink'
            );
        }
        $index = $this->index;
        $target = $this->target;
        $uri = "/$index/_shrink/$target";
        if (isset($index) === true && isset($target) === true) {
            $uri = "/$index/_shrink/$target";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'timeout',
            'master_timeout',
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        //TODO Fix Me!
        return 'PUT';
    }
}
