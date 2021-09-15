=== Privat24 payments for WooCommerce ===
Contributors: Extrawest
Tags: woocommerce, payments, privat, privat24, custom payment gateway, admin, woo, gateway, payment method
Requires at least: 5.0.0
Requires PHP: 7.0
Tested up to: 5.2.3
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: #

This plugin adds ukrainian payment gateway method "Privat24" to Woocommerce.

== Upgrade Notice ==
* Adds ukrainian payment gateway method "Privat24" to Woocommerce.

== Description ==
This plugin integrates an ability to use the most popular Ukrainian banking service Privat24 payment methods to any WooCommerce platform. Why is this plugin so useful for your platform?
By including it to your system, the admins could easily use the most convinient and reliable payment system without any need to spend tones of time with paper work or fulfilling multiply security fields, 
everything you need is already here.

== Installation ==

1. Get "Merchant ID" from privat24.ua
1.1. Log in to the Privat24 account for individuals using the link http://privat24.ua;
1.2. Enter your username and static password;
1.3. Enter the dynamic OTP password received in SMS on your mobile phone;
1.4. Go to the menu section "All Services" -> "Business" -> "Merchant";
1.5. Bind the card to work with the merchant;
1.6. Indicate the IP address of your Internet resource;
If desired, set the flag for participation in the Bonus + program (only for individuals);
1.7. Mark the services you need to work;
1.8. Click "Next"
1.9. Confirm OTP Password
1.10. Registration is over. Merchant is assigned an ID and Password.
2. Insert your API "Merchant ID" and "Password" on plugin settings page for getting access to Privat24 API.
3. Fill in other fields on plugin settings page such as "Waiting Time", "Card Number" (Recipient card number), "Country" (Recipient country), "Title" (Payment Gateway Title), "Description" (Payment Gateway Description).
4. Check "Enable Payment" option.
5. Press "Save" button.

== Frequently Asked Questions ==
Q: Why "Privat24" payment method isn`t available?
A: Please enable Privat24 payment method in plugin settings page.
Q: Why "Privat24" payment method throwing error, that the currency is incorrect?
A: Please set currency to "Ukrainian hryvnia (₴)" in Woocommerce settings (Woocommerce->Settings->General->Currency options->Currency).

== Screenshots ==

1. Settings page.
2. Bank Account Balance
3. Bank Account Report
4. Privat24 Payment Method

== Changelog ==

= 1.0.0 =
* Initial release.