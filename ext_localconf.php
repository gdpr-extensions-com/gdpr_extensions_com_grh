<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComGrh',
        'gdprgoogle_reviewheader',
        [
            \GdprExtensionsCom\GdprExtensionsComGrh\Controller\GdprGoogleReviewheaderController::class => 'index'
        ],
        // non-cacheable actions
        [
            \GdprExtensionsCom\GdprExtensionsComGrh\Controller\GdprGoogleReviewheaderController::class => '',
            \GdprExtensionsCom\GdprExtensionsComGrh\Controller\GdprManagerController::class => 'create, update, delete'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // register plugin for cookie widget
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComGrh',
        'gdprcookiewidget',
        [
            \GdprExtensionsCom\GdprExtensionsComGrh\Controller\GdprCookieWidgetController::class => 'index'
        ],
        // non-cacheable actions
        [],
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    gdprcookiewidget {
                        iconIdentifier = gdpr_extensions_com_grh-plugin-gdprgoogle_reviewslider
                        title = cookie
                        description = LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_grh_gdprgoogle_reviewslider.description
                        tt_content_defValues {
                            CType = list
                            list_type = GdprExtensionsComGrh_gdprcookiewidget
                        }
                    }
                }
                show = *
            }
       }'
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod.wizards.newContentElement.wizardItems {
               gdpr.header = LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang_db.xlf:gdpr_extensions_com_grh.name.tab
        }'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.gdpr {
                elements {
                    gdprgoogle_reviewheader {
                        iconIdentifier = gdpr_extensions_com_grh-plugin-gdprgoogle_reviewheader_dark
                        title = LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_grh_gdprgoogle_reviewslider.name
                        description = LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_grh_gdprgoogle_reviewslider.description
                        tt_content_defValues {
                            CType = gdprextensionscomgrh_gdprgoogle_reviewheader
                        }
                    }
                }
                show = *
            }
       }'
    );
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\GdprExtensionsCom\GdprExtensionsComGrh\Commands\SyncReviewsTask::class] = [
            'extension' => 'gdpr_extensions_com_grh',
            'title' => 'LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang.xlf:schedular_title',
            'description' => 'LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang.xlf:schedular_desc',
            'additionalFields' => \GdprExtensionsCom\GdprExtensionsComGrh\Commands\SyncReviewsTask::class,
        ];
})();
