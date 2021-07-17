const remarkAdmonitions = require('remark-admonitions');

/** @type {import('@docusaurus/types').DocusaurusConfig} */
module.exports = {
  title: 'Managed WooCommerce Payments',
  tagline: 'For payments',
  url: 'https://your-docusaurus-test-site.com',
  baseUrl: '/',
  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',
  favicon: 'img/favicon.ico',
  organizationName: 'gdcorp-partners',
  projectName: 'mwc-payments',
  themeConfig: {
    navbar: {
      title: 'Managed WooCommerce Payments',
      logo: {
        alt: 'My Site Logo',
        src: 'img/logo.svg',
      },
      items: [
        {
          href: 'https://github.com/gdcorp-partners/mwc-payments',
          label: 'GitHub',
          position: 'right',
        },
      ],
    },
    footer: {
      copyright: `Copyright © ${new Date().getFullYear()}`,
    },
  },
  presets: [
    [
      '@docusaurus/preset-classic',
      {
        docs: {
          editUrl:
              'https://github.com/gdcorp-partners/mwc-payments/tree/main/documentation',
          remarkPlugins: [remarkAdmonitions],
          routeBasePath: '/',
          sidebarPath: require.resolve('./sidebars.js'),
        },
        theme: {
          customCss: require.resolve('./src/css/custom.css'),
        },
      },
    ],
  ],
};
