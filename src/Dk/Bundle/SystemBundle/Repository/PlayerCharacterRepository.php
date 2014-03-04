<?php

namespace Dk\Bundle\SystemBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Dk\Bundle\SystemBundle\Entity\Player;

/**
 * PlayerCharacterRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerCharacterRepository extends EntityRepository
{
    public function findPlayerCharacters(Player $player)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p, pc, c FROM DkSystemBundle:PlayerCharacter pc
                LEFT JOIN pc.player p
                LEFT JOIN pc.campaign c
                WHERE p = :player
                ORDER BY c.name'
            )
            ->setParameter(':player', $player);

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
