<?php

namespace GoDaddy\WordPress\MWC\Dashboard\API\Controllers;

use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use WP_Error;
use WP_REST_Response;

defined('ABSPATH') or exit;

/**
 * Account controller class.
 */
class Account extends AbstractController
{
    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->route = 'account';
    }

    /**
     * Registers the API routes for the endpoints provided by the controller.
     */
    public function registerRoutes()
    {
        register_rest_route(
            $this->namespace, "/{$this->route}", [
                [
                    'methods'             => 'GET', // \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'getItem'],
                    'permission_callback' => [$this, 'getItemsPermissionsCheck'],
                ],
                'schema' => [$this, 'getItemSchema'],
            ]
        );
    }

    /**
     * Gets the account information.
     *
     * @internal
     *
     * @return WP_REST_Response|WP_Error
     */
    public function getItem()
    {
        return rest_ensure_response([
            'account' => [
                'privateLabelId'      => (int) ManagedWooCommerceRepository::getResellerId() ?: null,
                'isVersioningManual'  => (bool) Configuration::get('features.extensions.versionSelect'),
                'isOnResellerAccount' => (bool) ManagedWooCommerceRepository::isReseller(),
                'permissions'         => $this->getAccountPermissions(),
            ],
        ]);
    }

    /**
     * Gets the account permissions information.
     *
     * @return array
     */
    private function getAccountPermissions()
    {
        return [
            'INSTALL_PLUGINS' => current_user_can('install_plugins') && current_user_can('activate_plugins'),
        ];
    }

    /**
     * Returns the schema for REST items provided by the controller.
     *
     * @return array
     */
    public function getItemSchema() : array
    {
        return [
            '$schema'    => 'http://json-schema.org/draft-04/schema#',
            'title'      => 'account',
            'type'       => 'object',
            'properties' => [
                'privateLabelId' => [
                    'description' => __('The reseller private label ID (1 means GoDaddy, so not a reseller).', 'mwc-dashboard'),
                    'type'        => 'int',
                    'context'     => ['view', 'edit'],
                    'readonly'    => true,
                ],
                'isVersioningManual' => [
                    'description' => __('Whether the account can manually switch between extension versions.', 'mwc-dashboard'),
                    'type'        => 'bool',
                    'context'     => ['view', 'edit'],
                    'readonly'    => true,
                ],
                'isOnResellerAccount' => [
                    'description' => __('Whether or not the site is sold by a reseller.', 'mwc-dashboard'),
                    'type'        => 'bool',
                    'context'     => ['view', 'edit'],
                    'readonly'    => true,
                ],
                'permissions' => [
                    'type'        => 'object',
                    'properties'  => [
                        'INSTALL_PLUGINS' => [
                            'description' => __('Whether the account can install and activate plugins.', 'mwc-dashboard'),
                            'type'        => 'bool',
                            'context'     => ['view', 'edit'],
                            'readonly'    => true,
                        ],
                    ],
                ],
            ],
        ];
    }
}
