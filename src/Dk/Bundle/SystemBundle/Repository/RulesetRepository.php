<?php

namespace Dk\Bundle\SystemBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Dk\Bundle\SystemBundle\Entity\Player;

/**
 * RulesetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RulesetRepository extends EntityRepository
{
    /**
     * Get rulesets owned by a player
     * @return mixed
     */
    public function findMasterRulesets(Player $owner)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT rs FROM DkSystemBundle:Ruleset rs
                WHERE rs.owner = :owner'
            )->setParameter('owner', $owner);

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * 
     * @param Player $player    The owner
     * @param int    $id        Ruleset id
     * @return mixed
     */
    public function findOneWithSkills(Player $player, $id)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT rs, skill FROM DkSystemBundle:Ruleset rs
                LEFT JOIN rs.skills skill
                WHERE rs.id = :id
                AND rs.owner = :owner
                '
            )
            ->setParameter('owner', $player)
            ->setParameter('id', $id)
        ;

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }      

/**
     * 
     * @param Player $player    The owner
     * @param int    $id        Ruleset id
     * @return mixed
     */
    public function findOneWithPlayableRaces(Player $player, $id)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT rs, race FROM DkSystemBundle:Ruleset rs
                LEFT JOIN rs.playableRaces race
                WHERE rs.id = :id
                AND rs.owner = :owner
                '
            )
            ->setParameter('owner', $player)
            ->setParameter('id', $id)
        ;

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }       
    
    /**
     * 
     * @param Player $player    The owner
     * @param int    $id        Ruleset id
     * @return mixed
     */
    public function findOneWithRelationships(Player $player, $id)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT rs, skill, race, asset  FROM DkSystemBundle:Ruleset rs
                LEFT JOIN rs.skills skill
                LEFT JOIN rs.playableRaces race
                LEFT JOIN rs.assets asset
                WHERE rs.id = :id
                AND rs.owner = :owner
                '
            )
            ->setParameter('owner', $player)
            ->setParameter('id', $id)
        ;

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }    
}
