module.exports = {
  sidebar: {
    'Getting Started': [
      'overview',
      'installation',
      'structure',
      'contributing'
    ],
    Communication: [
      {
        'type': 'category',
        'label': 'Data Sources',
        'items': [
          'communication/data-sources/adapters',
        ]
      },
      'communication/redirect',
      'communication/godaddy-request',
      'communication/request',
      'communication/response',
    ],
    Components: [
      'components/cache',
      'components/configuration',
      'components/enqueue',
      'components/extension',
      'components/logger',
      'components/page',
      'components/register',
    ],
    Contracts: [
      'contracts/fulfillment-status',
    ],
    Events : [
        'events/errors',
        'events/events',
    ],
    Helpers: [
      'helpers/array',
      'helpers/comparison',
      'helpers/deprecation',
      'helpers/object',
      'helpers/string',
    ],
    Models: [
      'models/address',
      'models/currency-amount',
      'models/dimensions',
      'models/weight',
      {
        Orders: [
          'models/orders/order',
          'models/orders/abstract-order-item',
          'models/orders/fee-item',
          'models/orders/line-item',
          'models/orders/shipping-item',
          'models/orders/tax-item',
        ]
      }
    ],
    Providers: [
        'providers/abstract-provider',
        'providers/provider-contract',
    ],
    Repositories: [
      'repositories/managed-extensions',
      'repositories/managed-woocommerce',
      'repositories/page',
      'repositories/plugins',
      {
        WooCommerce: [
          'repositories/woocommerce',
          'repositories/woocommerceCoupons',
          'repositories/woocommerceOrders',
          'repositories/woocommerceProducts'
        ]
      },
      'repositories/wordpress',
    ],
    Testing: [
      'testing/http',
      'testing/wp-test-case',
    ],
    Traits: [
      'traits/can-bulk-assign-properties',
      'traits/can-convert-to-array-trait',
      'traits/fulfillable',
      'traits/has-dimensions',
      'traits/has-label',
      'traits/has-unit-of-measurement',
      'traits/has-user-meta',
      'traits/has-weight',
      'traits/has-woocommerce-meta',
      'traits/is-event-bridge-event',
      'traits/is-single-page-application',
      'traits/is-singleton',
      'traits/payable',
      'traits/has-providers',
    ],
    WordPress: [
      'wordpress/plugin',
    ],
  },
};
