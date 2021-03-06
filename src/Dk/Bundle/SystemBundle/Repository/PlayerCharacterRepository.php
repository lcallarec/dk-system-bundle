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
    
    /**
     * 
     * @param Player $player    The owner
     * @param int    $id        PlayerCharacter id
     * @return mixed
     */
    public function findOneWithRelationships(Player $player, $id)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT pc, c, rs, char, pcchar, rsskill, rsasset, pcasset FROM DkSystemBundle:PlayerCharacter pc
                LEFT JOIN pc.campaign c
                LEFT JOIN c.ruleset rs
                LEFT JOIN rs.skills rsskill
                LEFT JOIN rs.assets rsasset
                LEFT JOIN pc.assets pcasset
                LEFT JOIN rs.characteristics char
                LEFT JOIN pc.characteristics pcchar
                WHERE pc.player = :player
                AND pc.id = :id
                ORDER BY pcchar.id'
            )
            ->setParameter(':player', $player)
            ->setParameter(':id', $id)
        ;

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
