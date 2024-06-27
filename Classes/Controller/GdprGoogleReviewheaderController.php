<?php

declare(strict_types=1);

namespace GdprExtensionsCom\GdprExtensionsComGrh\Controller;


use GdprExtensionsCom\GdprExtensionsComGrh\Utility\Helper;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "gdpr-extensions-com-google_reviewslider" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * gdprgoogle_reviewsliderController
 */
class GdprGoogleReviewheaderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{


    /**
     * gdprManagerRepository
     *
     * @var \GdprExtensionsCom\GdprExtensionsComGrh\Domain\Repository\GdprManagerRepository
     */

    protected $gdprManagerRepository = null;

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
     * @param \GdprExtensionsCom\GdprExtensionsComGrh\Domain\Repository\GdprManagerRepository $gdprManagerRepository
     */
    public function injectGdprManagerRepository(\GdprExtensionsCom\GdprExtensionsComGrh\Domain\Repository\GdprManagerRepository $gdprManagerRepository)
    {
        $this->gdprManagerRepository = $gdprManagerRepository;
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);

        // .................................................................


        $helper = GeneralUtility::makeInstance(Helper::class);
        $rootpid = $helper->getRootPage($this->contentObject->data['pid']);

        $selectedLocations = explode(",", $this->contentObject->data['gdpr_business_locations_header']);

//        if (!empty($this->contentObject->data['gdpr_business_locations_header'])) {
            $reviewsQB = $connectionPool->getQueryBuilderForTable('tx_gdprclientreviews_domain_model_reviews');
            $locationsreviewsQB = $connectionPool->getQueryBuilderForTable('gdpr_multilocations');
            $locationNamesList = [];
//            foreach ($selectedLocations as $uid) {
                $locationResult = $locationsreviewsQB->select('dashboard_api_key')
                    ->from('gdpr_multilocations')
                    ->where(
                        $locationsreviewsQB->expr()
                            ->eq('root_pid', $locationsreviewsQB->createNamedParameter($rootpid))
                    )
                    ->executeQuery();
                $locationName = $locationResult->fetchOne();
                $locationNamesList[] = $locationName;
//            }
            $filtered_rating = [];
            $total_rating = [];
            if ($locationNamesList) {
                $reviewsHearder = [];
                foreach ($locationNamesList as $location) {
                    $reviewsResult = $reviewsQB->select('*')
                        ->from('tx_gdprextensionscomgooglereview_domain_model_header')
                        ->where(
                            $reviewsQB->expr()
                                ->eq('dashboard_api_key', $reviewsQB->createNamedParameter($location)),
                        )
                        ->executeQuery();

                    $reviewsHeaderData = $reviewsResult->fetchAssociative();

                    $filtered_rating['filtered_reviews'] = isset($filtered_rating['filtered_reviews']) ? $filtered_rating['filtered_reviews'] + $reviewsHeaderData['average_rating_filtered_reviews']: $reviewsHeaderData['average_rating_filtered_reviews'] ;
                    $total_rating ['total_reviews'] = isset($filtered_rating['total_reviews']) ? $filtered_rating['total_reviews'] + $reviewsHeaderData['average_rating_total_reviews']: $reviewsHeaderData['average_rating_total_reviews'];
                    $reviewsHearder['filtered_reviews'] = isset($reviewsHearder['filtered_reviews']) ? $reviewsHearder['filtered_reviews'] + $reviewsHeaderData['filtered_reviews']: $reviewsHeaderData['filtered_reviews'];
                    $reviewsHearder['total_reviews'] = isset($reviewsHearder['total_reviews']) ? $reviewsHearder['total_reviews'] + $reviewsHeaderData['total_reviews']: $reviewsHeaderData['total_reviews'];

                }

            if(count($locationNamesList)>=1){
                $reviewsHearder['average_rating_filtered_reviews']  = round($filtered_rating['filtered_reviews'] / count($locationNamesList) , 1);
                $reviewsHearder['average_rating_total_reviews']  = round($total_rating ['total_reviews'] / count($locationNamesList) , 1);
            }
            }

//        }

        $ratingType = [
            1 =>'POOR',
            2=>'AVERAGE',
            3=>'GOOD',
            4=>'VERY GOOD',
            5=>'EXCELLENT'
        ];
        $this->view->assign('ratingTotalType', $ratingType[$reviewsHearder['average_rating_total_reviews']]);
        $this->view->assign('ratingFilteredType', $ratingType[$reviewsHearder['average_rating_filtered_reviews']]);
        $this->view->assign('reviewsHearder', $reviewsHearder);
        $this->view->assign('ratingType', $ratingType);
        $this->view->assign('data', $this->contentObject->data);
        $this->view->assign('rootPid', $GLOBALS['TSFE']->site->getRootPageId());
        return $this->htmlResponse();
    }
}
