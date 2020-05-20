<?php


namespace BulletinBoard\CommonModule\Bus\Command;


interface CommandQueryInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}
