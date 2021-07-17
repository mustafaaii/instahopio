/**
 * Creating a sidebar enables you to:
 - create an ordered group of docs
 - render a sidebar for each doc of that group
 - provide next/previous navigation

 The sidebars can be generated from the filesystem, or explicitly defined here.

 Create as many sidebars as you want.
 */

module.exports = {
  sidebar: {
    'Getting started': [
      {
        type: 'autogenerated',
        dirName: 'getting-started'
      }
    ],
    'Components': [
      {
        type: 'autogenerated',
        dirName: 'components'
      }
    ],
    'Contracts': [
      {
        type: 'autogenerated',
        dirName: 'contracts'
      }
    ],
    'Gateways': [
      {
        type: 'autogenerated',
        dirName: 'gateways'
      }
    ],
    'Models': [
      'models/customer',
      {
        'type': 'category',
        'label': 'Payment Methods',
        'items': [
          {
            type: 'autogenerated',
            dirName: 'models/payment-methods'
          }
        ]
      },
      {
        'type': 'category',
        'label': 'Transactions',
        'items': [
          {
            type: 'autogenerated',
            dirName: 'models/transactions'
          }
        ]
      },
    ],
    'Providers': [
      {
        type: 'autogenerated',
        dirName: 'providers'
      }
    ],
    'Traits': [
      {
        type: 'autogenerated',
        dirName: 'traits'
      }
    ],
  },
};
