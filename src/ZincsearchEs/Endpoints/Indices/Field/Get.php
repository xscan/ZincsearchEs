<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Indices\Field;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Get
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Indices\Field
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Get extends AbstractEndpoint
{
    /**
     * A comma-separated list of fields
     *
     * @var string
     */
    private $field;

    /**
     * @param string $field
     *
     * @return $this
     */
    public function setField($field)
    {
        if (isset($field) !== true) {
            return $this;
        }

        $this->field = $field;

        return $this;
    }

    /**
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        if (isset($this->field) !== true) {
            throw new Exceptions\RuntimeException(
                'field is required for Get'
            );
        }
        $index = $this->index;
        $type = $this->type;
        $field = $this->field;
        $uri   = "/_mapping/field/$field";

        if (isset($index) === true && isset($type) === true && isset($field) === true) {
            $uri = "/$index/_mapping/$type/field/$field";
        } elseif (isset($type) === true && isset($field) === true) {
            $uri = "/_mapping/$type/field/$field";
        } elseif (isset($index) === true && isset($field) === true) {
            $uri = "/$index/_mapping/field/$field";
        } elseif (isset($field) === true) {
            $uri = "/_mapping/field/$field";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'include_defaults',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'local'
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
