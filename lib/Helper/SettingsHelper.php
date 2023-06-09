<?php

declare(strict_types=1);

namespace Aleks\Adfs\Helper;

use Bitrix\Main\Config\Option;

/**
 * Метод для работы с настройками SAML
 */
class SettingsHelper
{
    /** @var string Название модуля для получения настроек */
    public const MODULE_ID = 'aleks.adfs';

    /**
     * Возвращаем настройки запросов
     *
     * @return array
     */
    public static function getSettings(): array
    {
        return [
            'debug' => true,
            'sp' => [
                'entityId' => UrlHelper::getUrlHost() .'/adfs/',
                'assertionConsumerService' => [
                    'url' => UrlHelper::getUrlHost() .'/local/adfs/?acs',
                ],
                'singleLogoutService' => [
                    'url' => UrlHelper::getUrlHost() .'/local/adfs/?sls',
                ],
                'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',
            ],
            'idp' => [
                'entityId' => Option::get(self::MODULE_ID, 'adfs_entity_id'),
                'singleSignOnService' => [
                    'url' => Option::get(self::MODULE_ID, 'adfs_point_entry'),
                ],
                'singleLogoutService' => [
                    'url' => '',
                    'responseUrl' => '',
                ],
                'x509cert' => Option::get(self::MODULE_ID, 'adfs_cert'),
            ],
            'security' => [
                'requestedAuthnContext' => false,
            ],
        ];
    }
}