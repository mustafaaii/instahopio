---
id: installation
sidebar_position: 1
slug: /
title: Installation
---

The Managed WooCommerce Payments package is structured as a standard composer package.  To include this in a project, first add the VCS repositories to your Composer configuration using these two commands:
```
composer config repositories.mwc-common vcs git@github.com:gdcorp-partners/mwc-common.git
composer config repositories.mwc-payments vcs git@github.com:gdcorp-partners/mwc-payments.git
```
Then require the package:
```
composer require godaddy/mwc-payments
```

Once required, you may use the offerings within this package in the normal PHP fashion by importing the desired item by its namespace.  See a specific component within this documentation for specifics on the use of that item.
