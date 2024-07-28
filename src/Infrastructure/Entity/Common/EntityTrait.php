<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity\Common;


use App\Application\Util\DateUtil;

/**
 * Trait EntityTrait
 * @package App\Infrastructure\Entity\Common
 */
trait EntityTrait
{
    /**
     * @return array
     */
    public function toTinnyArray()
    {
        $arrayData = [];
        foreach ($this as $attribute => $value) {
            if (!is_object($value)) {
                $arrayData[$attribute] = $value;
            } elseif ($value instanceof \DateTime) {
                $arrayData[$attribute] = $value->format(DateUtil::DEFAULT_DATE_FORMAT);
            } else {
                continue;
            }
        }

        return $arrayData;
    }
}
