<?php

declare(strict_types = 1);

namespace ZincsearchEs\Serializers;

use ZincsearchEs\Common\Exceptions\RuntimeException;

/**
 * Class JSONSerializer
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Serializers\JSONSerializer
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class ArrayToJSONSerializer implements SerializerInterface
{
    /**
     * Serialize assoc array into JSON string
     *
     * @param string|array $data Assoc array to encode into JSON
     *
     * @return string
     */
    public function serialize($data)
    {
        if (is_string($data) === true) {
            return $data;
        } else {
            $data = json_encode($data, JSON_PRESERVE_ZERO_FRACTION);
            if ($data === false) {
                throw new RuntimeException("Failed to JSON encode: ".json_last_error());
            }
            if ($data === '[]') {
                return '{}';
            } else {
                return $data;
            }
        }
    }

    /**
     * Deserialize JSON into an assoc array
     *
     * @param string $data JSON encoded string
     * @param array  $headers Response Headers
     *
     * @return array
     */
    public function deserialize($data, $headers)
    {
        return json_decode($data, true);
    }
}
