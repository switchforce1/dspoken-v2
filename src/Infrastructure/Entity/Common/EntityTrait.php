<?php
declare(strict_types=1);

namespace App\Entity\Common;


use App\Util\Constances;
use App\Util\StringUtil;

/**
 * Trait EntityTrait
 * @package App\Entity\Common
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
                $arrayData[$attribute] = $value->format(Constances::DEFAULT_DATE_FORMAT);
            } else {
                continue;
            }
        }

        return $arrayData;
    }
}
