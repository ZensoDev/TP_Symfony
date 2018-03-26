<?php

namespace MediaRemoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media", uniqueConstraints={@ORM\UniqueConstraint(name="media_name", columns={"media_name"})})
 * @ORM\Entity
 */
class Media
{
    /**
     * @var string
     *
     * @ORM\Column(name="media_name", type="string", length=255, nullable=false)
     */
    private $mediaName;

    /**
     * @var string
     *
     * @ORM\Column(name="media_descr", type="string", length=255, nullable=false)
     */
    private $mediaDescr;

    /**
     * @var integer
     *
     * @ORM\Column(name="media_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mediaId;



    /**
     * Set mediaName
     *
     * @param string $mediaName
     *
     * @return Media
     */
    public function setMediaName($mediaName)
    {
        $this->mediaName = $mediaName;

        return $this;
    }

    /**
     * Get mediaName
     *
     * @return string
     */
    public function getMediaName()
    {
        return $this->mediaName;
    }

    /**
     * Set mediaDescr
     *
     * @param string $mediaDescr
     *
     * @return Media
     */
    public function setMediaDescr($mediaDescr)
    {
        $this->mediaDescr = $mediaDescr;

        return $this;
    }

    /**
     * Get mediaDescr
     *
     * @return string
     */
    public function getMediaDescr()
    {
        return $this->mediaDescr;
    }

    /**
     * Get mediaId
     *
     * @return integer
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }
}
