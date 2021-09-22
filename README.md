Razorpay Payment Button Plugin
==============


Start accepting payments on Drupal via credit/debit cards, UPI, wallets and more in less than five minutes. One-time and recurring payments. List multiple products, or allow customers to choose the amount they want to pay

Description
===========

This plugin allows inserting Payment Button using embed code or just the button.

= Razorpay Payment Button Plugin for Drupal =

**Start accepting payments on Drupal site in less than five minutes!**

Razorpay Payment Button plugin is an easy-to-use tool that instantly adds a payment checkout function on Drupal. It requires zero coding and minimal technical expertise.

With this Drupal payment gateway plugin, you can place a Donate Now, Pay Now, Buy Now, or Subscribe Now button on your Drupal website/blog by yourself in less than 5 minutes. 


Start accepting one time and recurring payments on your website. Set up one or multiple payment plans according to your business model. Offer your customers 100+ payment modes(UPI, NEFT, Cards, Wallets, and more) via a single Drupal payment gateway plugin

Razorpay Payment Button Plugin is a plugin for Drupal that makes it easier to place the payment button widget anywhere on your website. It offers an integrated checkout experience that allows visitors to make payments directly on the same page without any redirections.It’s a free Drupal payment plugin. 

Razorpay payment button helps you to start accepting payments on your Drupal website:

- In less than 5 minutes. It’s that quick
- Zero integration is needed. It’s that easy 
- No set-up costs are involved. It’s a free plugin

What can Razorpay Payment Button Plugins for Drupal do for you?

- **No coding required**:  Add a payment checkout to your website with no set-up cost and zero integration
- **Pre-made templates**: Add Donate Now, Buy Now, Support Now and more customizable buttons with pre-made templates to your website
- **Checkout experience**: Build a seamless checkout experience for your customers with no redirections
- **All-in-one plugin**: Let your customers pay the way they want with 100+ payment modes including Credit/Debit card, Net-banking, UPI, Wallets etc.
- **Set payment plans your way**: Accept one-time on Drupal via a single Drupal payment gateway plugin.
- **Automated Receipts**: Send automated payment receipts and 80G receipts to your customers
- **Powerful Dashboard**: Make data-driven business decisions using insights from reports available on our easy-to-understand dashboard
- **Create it your way**: Customize your payment buttons to reflect your brand colours and design
- **Database that can be recorded on Razorpay Dashboard:**: Collect information important to your business by adding and modifying fields on the checkout
- **Pricing fields options**: List multiple products, or allow customers to choose the amount they want to pay
- **Post payment experience**: Allow customers to redirect to the new landing page post successful payment
- **Customized message**: Share love with your supporters in your own words with customized thank you messages
- **Plug and Play with multiple buttons**: Add multiple buttons on Drupal built pages with a plug and play ease
- **Sync your Drupal and Razorpay account**:Track and record payments for all your buttons on both Drupal and Razorpay account with Razorpay Payment Button Plugin



Installation
============
1. Download the plugin from https://www.drupal.org/project/payment_button_drupal_plugin
2. To install plugin Go to Extend from Drupal admin menu.
3. Enable Razorpay Payment Button Plugin module in the Drupal admin.
4. Configure your WYSIWYG toolbar to include the button.

Each filter format will now have a config tab for this plugin.

Reference folder structure:
.
|-- autoload.php
|-- core
|-- libraries
|-- modules
|   `-- contrib
|       |-- payment_button_drupal_plugin
|       |   |-- payment_button_drupal_plugin.info.yml
|       |   |-- ...
|       |   `-- src
|-- profiles
|-- robots.txt
|-- sites
|-- themes
|-- update.php
`-- web.config

Dependencies
============
This module requires:

* CKEditor (core)
* composer require razorpay/razorpay:2.* // Please check the latest [release](https://github.com/razorpay/razorpay-php) and  Command to be run in the main folder of Drupal site.
* Make sure your Razorpay key and secret key are added from the setting page.
* Uncheck the "Limit allowed HTML tags and correct faulty HTML" filter in text format setting.
    * Configuration → Content authoring → Text formats and editors → Configure (Basic or Full HTML) → Enable or uncheck (Limit allowed HTML tags and correct faulty HTML) → Save Configuration

Prerequisites to get started faster with Plugins:
================================================

1. Sign up to create a Razorpay account
2. Log into your Razorpay account and generate API keys in the test mode. -Download and save API Keys
3. Create a Payment Button on Razorpay Dashboard

After Activation Flow:
=====================

**Log in to your Razorpay Account**
    1. On your Razorpay Dashboard
      - Settings → API Keys → Copy API Keys
    2. On your Drupal Admin Dashboard: 
      - Configuration → Razorpay Payment Button Plugin  → Payment Button Settings → Add API Secret Keys and details
    3. Create a Payment Button on Razorpay dashboard - [Quick guide](https://razorpay.com/docs/payment-button/).


Usage
=====
Go to the Text formats and editors settings (/admin/config/content/formats) and
add the Payment Button to any CKEditor-enabled text format you want.



Uninstallation
==============
1. Uninstall the module from 'Admin Menu >> Extend'.

Frequently Asked Questions
==========================

= What is Razorpay? =

[Razorpay](https://www.google.com/url?q=https://razorpay.com/&sa=D&source=editors&ust=1631093740507000&usg=AOvVaw3WZuPD9GhfOU4tCIapZ2E_) is a full-stack payments solution that enables thousands of online and offline businesses to accept, process and disburse payments on the web and mobile apps.


= What is a payment button? =

A payment button on your website provides your customers with the experience of a payment gateway at the touch of a button. No set-up cost and zero integration.

= Do I need a Razorpay account for using plugins? = 

Yes, you will have to sign-up for a Razorpay account. Here’s a [quick guide](https://www.google.com/url?q=https://razorpay.com/docs/payments/sign-up/%23sign-up&sa=D&source=editors&ust=1631093740508000&usg=AOvVaw1-oHjFX4SOLgPUF869QBoR) for you.

= Can I accept international payments? =

Yes, you can accept international payments with Razorpay Payment Button. Here’s a [quick guide](https://www.google.com/url?q=https://razorpay.com/accept-international-payments/&sa=D&source=editors&ust=1631093740507000&usg=AOvVaw3cBdqSRLf9KhiT8e_J7FQl) for you.
 
= Is it safe to collect payments from Razorpay? = 

Safe money movement with our 100% secure ecosystem guarded with PCI DSS compliance.

= What is the platform fee for using Razorpay to accept payments? =

We offer a simple, transparent pricing of 2% fee per transaction amount. However, if you’d like a customised plan for your business, you can read more [here](https://razorpay.com/pricing).  

= Where can I find a report and analysis of all transactions? =

You can download all of your transactions with the details of your customers from your Razorpay dashboard.

= What all is required for the seamless functioning of the Razorpay Payment Button Plugin? =
    - Log in to your Razorpay account
    - Make sure you have created a Payment Button on your Razorpay dashboard. Here’s a [quick guide](https://razorpay.com/payment-buttons/) for you.
    - Copy Key ID and API secret keys from your Razorpay account
    - Add API secret keys details on Drupal Admin Dashboard
    - Drag and drop the button widget

= Can I change the label of a Payment Button? =

Yes, you can customize the text and colour of the button as per your brand style on Razorpay Dashboard

Changelog
=========

= 1.0 =
* Initial Changes
* Tested upto Drupal 9.2.6

Support
=======
[Visit](https://razorpay.com) for support requests or email contact@razorpay.com.

Credits
=======
Initial development and maintenance by Razorpay.

LICENSE
=======
See the [LICENSE](https://github.com/razorpay/payment_button_drupal_plugin/tree/master/LICENSE.txt) file for the complete LICENSE text.
