<?php

if ((int)\TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version() >= 12) {
        return[
            'gdpr' => [
                'labels' => 'LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang_mod_web.xlf',
                'iconIdentifier' => 'gdpr_extensions_com_tab',
                'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
            ],

            'grh' => [
                'parent' => 'gdpr',
                'position' => [],
                'access' => 'user,group',
                'iconIdentifier' => 'gdpr_extensions_com_grh-plugin-gdprgoogle_reviewheader',
                'path' => '/module/grh',
                'labels' => 'LLL:EXT:gdpr_extensions_com_grh/Resources/Private/Language/locallang_gdprmanager.xlf',
                'extensionName' => 'GdprExtensionsComGrh',
                'controllerActions' => [
                    \GdprExtensionsCom\GdprExtensionsComGrh\Controller\GdprManagerController::class => [
                        'list',
                        'index',
                        'show',
                        'new',
                        'create',
                        'edit',
                        'update',
                        'delete',
                        'uploadImage',
                        'manageReview'
                    ],
                ],
            ]
        ];


}


