<?php

namespace GdprExtensionsCom\GdprExtensionsComGrh\Controller;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class GdprCookieWidgetController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * ContentObject
     *
     * @var ContentObject
     */
    protected $contentObject = null;

    /**
     * Action initialize
     */
    protected function initializeAction()
    {
        $this->contentObject = $this->configurationManager->getContentObject();

        // intialize the content object
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_gdprextensionscomyoutube_domain_model_gdprmanager');

        $queryBuilder
            ->select('*')
            ->from('tx_gdprextensionscomyoutube_domain_model_cookiewidget');

        $result = $queryBuilder->execute()->fetchAssociative();
        if ($result["cookie_widget_image"] && strpos($result["cookie_widget_image"], '/') !== 0) {
            $result["cookie_widget_image"] = '/' . $result["cookie_widget_image"];
        }


        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_gdprextensionscomyoutube_domain_model_gdprmanager');
        $gdprSettingGoogleReviewslider = $queryBuilder
            ->select('*')
            ->from('tx_gdprextensionscomyoutube_domain_model_gdprmanager')->where(
                $queryBuilder->expr()->like('extension_title', $queryBuilder->createNamedParameter('%' . (string)'google_reviewslider' . '%'))
            );
        $settings =  $gdprSettingGoogleReviewslider->execute()->fetchAssociative();

        $this->view->assign('cookieWidgetData', $result);
        $this->view->assign('GoogleReviewsliderData', $this->contentObject->data);
        $this->view->assign('GoogleReviewsliderSettings', $settings);
        return $this->htmlResponse();

    }


}
