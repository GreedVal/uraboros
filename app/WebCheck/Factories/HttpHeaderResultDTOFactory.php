<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\HttpHeaderResultDTO;


class HttpHeaderResultDTOFactory
{
    public static function createFromArray(array $headers): array
    {
        $result = [];

        foreach ($headers as $name => $value) {
            if (is_int($name)) {
                $result[] = new HttpHeaderResultDTO(name: 'Status', values: [$value]);
                continue;
            }

            $values = is_array($value) ? $value : [$value];

            $result[] = new HttpHeaderResultDTO(
                name: $name,
                values: $values
            );
        }

        return $result;
    }
}
