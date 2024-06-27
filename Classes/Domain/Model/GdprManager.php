<?php

declare(strict_types=1);

namespace GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model;


/**
 * This file is part of the "gdpr-extensions-com-google_reviewslider" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * GdprManager
 */
class GdprManager extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * heading
     *
     * @var string
     */
    protected $heading = '';

    /**
     * content
     *
     * @var string
     */
    protected $content = '';

    /**
     * buttonText
     *
     * @var string
     */
    protected $buttonText = '';

    /**
     * enableBackgroundImage
     *
     * @var int
     */
    protected $enableBackgroundImage = 0;


    /**
     * backgroundImage
     *
     * @var string
     */
    protected $backgroundImage = '';

    /**
     * backgroundImageColor
     *
     * @var string
     */
    protected $backgroundImageColor = '';

    /**
     * buttonColor
     *
     * @var string
     */
    protected $buttonColor = '';

    /**
     * textColor
     *
     * @var string
     */
    protected $textColor = '';

    /**
     * buttonTextColor
     *
     * @var string
     */
    protected $buttonTextColor = '';



    /**
     * buttonShape
     *
     * @var string
     */
    protected $buttonShape = '';



    /**
     * extensionTitle
     *
     * @var string
     */
    protected $extensionTitle = '';

    /**
     * extensionKey
     *
     * @var string
     */
    protected $extensionKey = '';

    /**
     * @return string
     */

    /**
     * locations
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\MapLocation>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $locations = null;

        /**
     * mapApi
     *
     * @var string
     */
    protected $mapApi = '';

    /**
     * @return string
     */
    public function getMapApi(): string
    {
        return $this->mapApi;
    }

    /**
     * @param string $mapApi
     */
    public function setMapApi(string $mapApi): void
    {
        $this->mapApi = $mapApi;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage|null
     */
    public function getLocations(): ?\TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->locations;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage|null $locations
     */
    public function setLocations(?\TYPO3\CMS\Extbase\Persistence\ObjectStorage $locations): void
    {
        $this->locations = $locations;
    }

    /**
     * Adds a MapLocation
     *
     * @param \GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\MapLocation $location
     * @return void
     */
    public function addLocation(\GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\MapLocation $location)
    {
        $this->locations->attach($location);
    }

    /**
     * Removes a MapLocation
     *
     * @param \GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\MapLocation $locationToRemove The MapLocation to be removed
     * @return void
     */
    public function removeLocation(\GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\MapLocation $locationToRemove)
    {
        $this->locations->detach($locationToRemove);
    }
    public function getExtensionTitle(): string
    {
        return $this->extensionTitle;
    }

    /**
     * @param string $extensionTitle
     */
    public function setExtensionTitle(string $extensionTitle): void
    {
        $this->extensionTitle = $extensionTitle;
    }
    /**
     * @param string $extensionKey
     */
    public function getExtensionKey(): string
    {
        return $this->extensionKey;
    }

    /**
     * @param string $extensionKey
     */
    public function setExtensionKey(string $extensionKey): void
    {
        $this->extensionKey = $extensionKey;
    }

    /**
     * Returns the heading
     *
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Sets the heading
     *
     * @param string $heading
     * @return void
     */
    public function setHeading(string $heading)
    {
        $this->heading = $heading;
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * Returns the buttonText
     *
     * @return string
     */
    public function getButtonText()
    {
        return $this->buttonText;
    }

    /**
     * Sets the buttonText
     *
     * @param string $buttonText
     * @return void
     */
    public function setButtonText(string $buttonText)
    {
        $this->buttonText = $buttonText;
    }

    /**
     * Returns the enableBackgroundImage
     *
     * @return int
     */
    public function getEnableBackgroundImage()
    {
        return $this->enableBackgroundImage;
    }

    /**
     * Sets the enableBackgroundImage
     *
     * @param int $enableBackgroundImage
     * @return void
     */
    public function setEnableBackgroundImage(int $enableBackgroundImage)
    {
        $this->enableBackgroundImage = $enableBackgroundImage;
    }

    /**
     * Returns the backgroundImageColor
     *
     * @return string
     */
    public function getBackgroundImageColor()
    {
        return $this->backgroundImageColor;
    }

    /**
     * Sets the backgroundImageColor
     *
     * @param string $backgroundImageColor
     * @return void
     */
    public function setBackgroundImageColor(string $backgroundImageColor)
    {
        $this->backgroundImageColor = $backgroundImageColor;
    }



    /**
     * Returns the buttonColor
     *
     * @return string
     */
    public function getButtonColor()
    {
        return $this->buttonColor;
    }

    /**
     * Sets the buttonColor
     *
     * @param string $buttonColor
     * @return void
     */
    public function setButtonColor(string $buttonColor)
    {
        $this->buttonColor = $buttonColor;
    }

    /**
     * Returns the textColor
     *
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Sets the textColor
     *
     * @param string $textColor
     * @return void
     */
    public function setTextColor(string $textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * Returns the buttonShape
     *
     * @return string
     */
    public function getButtonShape()
    {
        return $this->buttonShape;
    }

    /**
     * Sets the buttonShape
     *
     * @param string $buttonShape
     * @return void
     */
    public function setButtonShape(string $buttonShape)
    {
        $this->buttonShape = $buttonShape;
    }

    /**
     * Returns the backgroundImage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference backgroundImage
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * Sets the backgroundImage
     *
     * @param string $backgroundImage
     * @return void
     */
    public function setBackgroundImage(string $backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @return string
     */
    public function getButtonTextColor(): string
    {
        return $this->buttonTextColor;
    }

    /**
     * @param string $buttonTextColor
     */
    public function setButtonTextColor(string $buttonTextColor): void
    {
        $this->buttonTextColor = $buttonTextColor;
    }

    public function clearLocations()
    {
        $this->locations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }


}
