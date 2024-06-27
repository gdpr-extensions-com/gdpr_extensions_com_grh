<?php

namespace GdprExtensionsCom\GdprExtensionsComGrh\Utility;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Log\Logger;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use Exception;

class SyncReviews
{
    public function run(Helper $helper, ConnectionPool $connectionPool, Logger $logManager)
    {
        $multilocationQB = $connectionPool->getQueryBuilderForTable('gdpr_multilocations');
        $reviewHeaderQB = $connectionPool->getQueryBuilderForTable('tx_gdprextensionscomgooglereview_domain_model_header');
        $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        $sysTempQB = $connectionPool->getQueryBuilderForTable('sys_template');
        $multilocationQBResult = $multilocationQB
            ->select('*')
            ->from('gdpr_multilocations')
            ->executeQuery()
            ->fetchAllAssociative();

        foreach ($multilocationQBResult as $location) {
             try {

                $apiKey = $location['dashboard_api_key'] ?? null;

                $SiteConfiguration = $sysTempQB->select('constants')
                    ->from('sys_template')
                    ->where(
                        $sysTempQB->expr()->eq('pid', $sysTempQB->createNamedParameter($location['root_pid'])),
                    )
                    ->setMaxResults(1)
                    ->executeQuery()
                    ->fetchAssociative();
                $sysTempQB->resetQueryParts();
                $constantsArray = $this->extractSecretKey($SiteConfiguration['constants']);
                $BaseURL = isset($constantsArray['plugin.tx_gdprextensionscomgooglemaps_gdprgooglemaps.settings.dashboardBaseUrl']) ? $constantsArray['plugin.tx_gdprextensionscomgooglemaps_gdprgooglemaps.settings.dashboardBaseUrl']: null ;

                if ($apiKey) {

                    $reviewsToolUrl = (is_null($BaseURL) ? 'https://dashboard.gdpr-extensions.com/': $BaseURL).'review/api/'.$location['dashboard_api_key'].'/current-website.json';

                    $params = [
                        'verify' => false,
                    ];

                    $response = $requestFactory->request($reviewsToolUrl, 'GET', $params);

                    if($response && $response->getStatusCode() == 200) {

                        $jsonResponse = json_decode($response
                            ->getBody()
                            ->getContents());

                        $reviewHeader = $reviewHeaderQB->select('*')
                        ->from('tx_gdprextensionscomgooglereview_domain_model_header')
                        ->where(
                            $reviewHeaderQB->expr()->eq('dashboard_api_key', $reviewHeaderQB->createNamedParameter($location['dashboard_api_key'])),
                        )
                        ->setMaxResults(1)
                        ->executeQuery()
                        ->fetchAssociative();
                        $reviewHeaderQB->resetQueryParts();
                        if($reviewHeader){
                            $reviewHeaderQB
                                            ->update('tx_gdprextensionscomgooglereview_domain_model_header')
                                            ->where(
                                                $reviewHeaderQB->expr()->eq('dashboard_api_key', $reviewHeaderQB->createNamedParameter($reviewHeader['dashboard_api_key'])),
                                            )
                                            ->set('filtered_reviews', $jsonResponse->filteredReviews)
                                            ->set('total_reviews', $jsonResponse->totalReviews)
                                            ->set('average_rating_filtered_reviews',$jsonResponse->averageRatingFilteredReviews)
                                            ->set('average_rating_total_reviews', $jsonResponse->averageRatingTotalReviews)
                                            ->executeStatement();
                        }
                        else{

                            $reviewHeaderQB
                                        ->insert('tx_gdprextensionscomgooglereview_domain_model_header')
                                        ->values([
                                            'filtered_reviews' =>  $jsonResponse->filteredReviews,
                                            'total_reviews' => $jsonResponse->totalReviews,
                                            'average_rating_filtered_reviews' => $jsonResponse->averageRatingFilteredReviews,
                                            'average_rating_total_reviews' => $jsonResponse->averageRatingTotalReviews,
                                            'dashboard_api_key' => $location['dashboard_api_key'],
                                            'root_pid' =>  $location['root_pid']
                                        ])
                                        ->executeStatement();
                                    }
                                    $reviewHeaderQB->resetQueryParts();

                    }
                }
            } catch (\Exception $exception) {
                $logManager->error(
                    $exception->getMessage(),
                    [
                        'code' => $exception->getCode(),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace' => $exception->getTrace(),
                    ]
                );
            }
        }

    }


    protected function extractSecretKey($constantsString)
    {
        $configLines = explode("\n", $constantsString);
        $configArray = [];

        foreach ($configLines as $line) {
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $configArray[trim($key)] = trim($value);
            }
        }
        return $configArray;
    }
}
