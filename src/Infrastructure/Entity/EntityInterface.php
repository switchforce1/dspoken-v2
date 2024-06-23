<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 19/02/2020
 * Time: 02:23
 */

namespace App\Entity;

/**
 * Interface EntityInterface
 * @package App\Entity
 */
interface EntityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * Get array without nested ArrayCollection and Entity object
     * Avoid cyclic redundancies
     *
     * @return mixed
     */
    public function toTinnyArray();
}
