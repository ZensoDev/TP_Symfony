<?php

namespace MediaRemoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaRemoteFile
 *
 * @ORM\Table(name="media_remote_file", indexes={@ORM\Index(name="remote_id", columns={"remote_id", "media_id"}), @ORM\Index(name="media_id", columns={"media_id"}), @ORM\Index(name="IDX_FE0EE85A2A3E9C94", columns={"remote_id"})})
 * @ORM\Entity
 */
class MediaRemoteFile
{
    /**
     * @var string
     *
     * @ORM\Column(name="media_remote_file_name", type="string", length=255, nullable=false)
     */
    private $mediaRemoteFileName;

    /**
     * @var string
     *
     * @ORM\Column(name="media_remote_file_descr", type="string", length=255, nullable=false)
     */
    private $mediaRemoteFileDescr;

    /**
     * @var string
     *
     * @ORM\Column(name="media_remote_file_basepath", type="string", length=255, nullable=false)
     */
    private $mediaRemoteFileBasepath;

    /**
     * @var string
     *
     * @ORM\Column(name="media_remote_file_path", type="string", length=255, nullable=false)
     */
    private $mediaRemoteFilePath;

    /**
     * @var integer
     *
     * @ORM\Column(name="media_remote_file_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mediaRemoteFileId;

    /**
     * @var \MediaRemoteBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="MediaRemoteBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media_id", referencedColumnName="media_id")
     * })
     */
    private $media;

    /**
     * @var \MediaRemoteBundle\Entity\Remote
     *
     * @ORM\ManyToOne(targetEntity="MediaRemoteBundle\Entity\Remote")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="remote_id", referencedColumnName="remote_id")
     * })
     */
    private $remote;



    /**
     * Set mediaRemoteFileName
     *
     * @param string $mediaRemoteFileName
     *
     * @return MediaRemoteFile
     */
    public function setMediaRemoteFileName($mediaRemoteFileName)
    {
        $this->mediaRemoteFileName = $mediaRemoteFileName;

        return $this;
    }

    /**
     * Get mediaRemoteFileName
     *
     * @return string
     */
    public function getMediaRemoteFileName()
    {
        return $this->mediaRemoteFileName;
    }

    /**
     * Set mediaRemoteFileDescr
     *
     * @param string $mediaRemoteFileDescr
     *
     * @return MediaRemoteFile
     */
    public function setMediaRemoteFileDescr($mediaRemoteFileDescr)
    {
        $this->mediaRemoteFileDescr = $mediaRemoteFileDescr;

        return $this;
    }

    /**
     * Get mediaRemoteFileDescr
     *
     * @return string
     */
    public function getMediaRemoteFileDescr()
    {
        return $this->mediaRemoteFileDescr;
    }

    /**
     * Set mediaRemoteFileBasepath
     *
     * @param string $mediaRemoteFileBasepath
     *
     * @return MediaRemoteFile
     */
    public function setMediaRemoteFileBasepath($mediaRemoteFileBasepath)
    {
        $this->mediaRemoteFileBasepath = $mediaRemoteFileBasepath;

        return $this;
    }

    /**
     * Get mediaRemoteFileBasepath
     *
     * @return string
     */
    public function getMediaRemoteFileBasepath()
    {
        return $this->mediaRemoteFileBasepath;
    }

    /**
     * Set mediaRemoteFilePath
     *
     * @param string $mediaRemoteFilePath
     *
     * @return MediaRemoteFile
     */
    public function setMediaRemoteFilePath($mediaRemoteFilePath)
    {
        $this->mediaRemoteFilePath = $mediaRemoteFilePath;

        return $this;
    }

    /**
     * Get mediaRemoteFilePath
     *
     * @return string
     */
    public function getMediaRemoteFilePath()
    {
        return $this->mediaRemoteFilePath;
    }

    /**
     * Get mediaRemoteFileId
     *
     * @return integer
     */
    public function getMediaRemoteFileId()
    {
        return $this->mediaRemoteFileId;
    }

    /**
     * Set media
     *
     * @param \MediaRemoteBundle\Entity\Media $media
     *
     * @return MediaRemoteFile
     */
    public function setMedia(\MediaRemoteBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \MediaRemoteBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set remote
     *
     * @param \MediaRemoteBundle\Entity\Remote $remote
     *
     * @return MediaRemoteFile
     */
    public function setRemote(\MediaRemoteBundle\Entity\Remote $remote = null)
    {
        $this->remote = $remote;

        return $this;
    }

    /**
     * Get remote
     *
     * @return \MediaRemoteBundle\Entity\Remote
     */
    public function getRemote()
    {
        return $this->remote;
    }
}
