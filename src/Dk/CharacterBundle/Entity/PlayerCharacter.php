<?php

namespace Dk\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dk\PlayerBundle\Entity\Player;
use Dk\CampaignBundle\Entity\Campaign;

/**
 * PlayerCharacter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\CharacterBundle\Repository\PlayerCharacterRepository")
 */
class PlayerCharacter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Dk\PlayerBundle\Entity\Player", inversedBy="characters")
     */
    private $player;
    
    /**
     * @var Campaign
     * @ORM\ManyToOne(targetEntity="Dk\CampaignBundle\Entity\Campaign", inversedBy="playerCharacters")
     */
    private $campaign;
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    public function __construct(Player $player)
    {
        $this->setPlayer($player);
    }

    /**
     * Get the string representation of a PlayerCharacter object
     * @return string
     */
    public function __toString()
    {
        $s = $this->firstname;
        
        if($this->lastname) {
            $s .= sprintf(' %s', $this->lastname);
        }
        
        return $s;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the campaign where this caracter is playing
     * 
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
    
    /**
     * Set the campaign where this caracter is playing 
     * @param \Dk\CampaignBundle\Entity\Campaign $campaign
     * @return self
     */
    public function setCampaign(Campaign $campaign = null)
    {
        $this->campaign = $campaign;
        
        return $this;
    }
    
    /**
     * Set firstname
     *
     * @param string $firstname
     * @return PlayerCharacter
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return PlayerCharacter
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * Get the player who own this character
     * 
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
    
    /**
     * Associate a player to this character
     * 
     * @param \Dk\PlayerBundle\Entity\Player $player
     * @return \Dk\CharacterBundle\Entity\PlayerCharacter
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
        
        return $this;
    }

}
