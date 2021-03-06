<?php

namespace Dk\Bundle\ImportBundle\Import;

use Closure;
use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Dk\Bundle\SystemBundle\Entity\RulesetAsset;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class SkillImporter
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class AssetImporter extends Importer
{
    /** @var string */
    protected static $namespace = 'assets';

    /**
     * Import characteristics for the given ruleset
     *
     * @param Ruleset $ruleset
     *
     * @return Ruleset
     */
    public function import(Ruleset $ruleset)
    {
        $groups = new ArrayCollection();

        $this->recursiveItemManager(
            $this->data,
            null,
            $this->getGroupClosure($ruleset, $groups, 'Dk\Bundle\SystemBundle\Entity\RulesetAssetGroup'),
            $this->getAssetClosure($ruleset, $groups)
        );

    }

    /**
     * @param Ruleset         $ruleset
     * @param ArrayCollection $groups
     *
     * @return Closure
     */
    protected function getAssetClosure(Ruleset $ruleset, ArrayCollection $groups)
    {
        return function($name, $data, $group) use ($groups, $ruleset) {

            $description = isset($data['desc']) ? $data['desc'] : $data;

            $use = isset($data['use']) ? $data['use'] : null;

            $asset = new RulesetAsset();
            $asset
                ->setName($name)
                ->setDescription($description)
                ->getUseLimitation($use)
            ;

            $asset->setGroup($groups->get($group));

            $ruleset->addAsset($asset);
        };
    }

} 