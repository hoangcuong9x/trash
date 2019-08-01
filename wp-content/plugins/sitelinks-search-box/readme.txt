=== Sitelinks Search Box ===
Contributors: apasionados, netconsulting
Donate link: http://apasionados.es/
Tags: search engines, sitelinks search box, google, google sitelinks search box, google sitelinks, schema.org, JSON-LD
Requires at least: 3.0.1
Tested up to: 5.2
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the JSON-LD schema.org markup for the "Google Sitelinks Search Box" on the homepage.


== Description ==

This plugin adds the JSON-LD schema.org markup for the "Google Sitelinks Search Box" on the homepage.

This new feature of the Google Search Engine was presented on the [Official Google Webmaster Central Blog](http://googlewebmastercentral.blogspot.com.es/2014/09/improved-sitelinks-search-box.html "Official Google Webmaster Central Blog") (05 Sep 2014 07:44 AM PDT). There is more info on the [Google Developers Website](https://developers.google.com/webmasters/richsnippets/sitelinkssearch "Google Developers Website").

With Google sitelinks search box, people can reach your content more quickly from search results. Search users sometimes use navigational queries -typing in the brand name or URL of a known site- only to do a more detailed query once on that site. For example, suppose someone wants to find that video about the guilty dog on YouTube. They type YouTube, or you-tube, or youtube.com into Google Search, follow the link to YouTube, and then actually search for the dog video. 

The sitelinks search box removes that extra step: a query for youtube displays a site search box in the sitelinks section, letting the user immediately search for that guilty dog video without having to click through to the site first.

> If you use **WordPress SEO by Yoast version 1.6 or newer**, you don't need to use this plugin, as this feature has been included in the version 1.6 update. There is more information in the [FAQ section](https://es.wordpress.org/plugins/sitelinks-search-box/faq/) of the plugin.

= What can I do with this plugin? =
This plugin adds the schema.org JSON-JD markup for the "Google Sitelinks Search Box" on the homepage.

After activating the plugin you only have to "Wait for Google Search algorithms to identify your site as a candidate for the new sitelinks search box".

= SITELINK SEARCH BOX in your Language! =
This first release is avaliable in English and Spanish. In the languages folder we have included the necessary files to translate this plugin.

If you would like the plugin in your language and you're good at translating, please drop us a line at [Contact us](http://apasionados.es/contacto/index.php?desde=wordpress-org-sitelinksearchbox-home).

* Translation to es_ES by [Divulga.Media](http://divulga.media).
* Translation to ar_SA by Majed Atwi: [سيو بالعربي](http://www.seo-ar.net).
* Translation to tr_TR by Ersin Tezcan: [Ersin Tezcan](http://www.seondex.com).
* Translation to de_DE by Ben.
* Translation to fr_FR by bijiguen: [التقني](http://www.th3technician.com).
* Translation to ru_RU by Alexey of [dGlance](http://ru.dglance.com/).

= Further Reading =
You can access the description of the plugin in Spanish at: [Sitelinks Search Box en castellano](http://apasionados.es/blog/marcado-google-sitelinks-search-box-wordpress-plugin-2873/).

== Installation ==

1. Upload the `sitelinks-search-box` folder to the `/wp-content/plugins/` directory (or to the directory where your WordPress plugins are located)
1. Activate the SITELINK SEARCH BOX plugin through the 'Plugins' menu in WordPress.
1. Plugin doesn't need any configuration.

Please use with *WordPress MultiSite* at your own risk, as it has not been tested.

If you use *WordPress SEO by Yoast* version 1.6 or newer (presented on September, 11th 2014), you don't need this plugin. More info on our [Frequently Asked Questions page](https://wordpress.org/plugins/sitelinks-search-box/faq/).

== Frequently Asked Questions ==

= What is SITELINK SEARCH BOX good for? =
This plugin adds the schema.org JSON-JD markup for the "Google Sitelinks Search Box" on the homepage.

= Does SITELINK SEARCH BOX make changes to the database? =
No.

= How can I check out if the plugin works for me? =
Install and activate. Empty cache (if any cache plugin installed) and have a look at the source code of the homepage. At the end there should be the JSON-LD markup.
You can also check with the [Structured Data Linter](http://linter.structured-data.org/) that the JSON-LD markup is correctly implemented.

= How can I remove SITELINK SEARCH BOX? =
You can simply activate, deactivate or delete it in your plugin management section.

= Are there any known incompatibilities? =
Please don't use it with *WordPress MultiSite*, as it has not been tested.

If you use [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/) version 1.6 or newer, you don't need to use this plugin, as this feature has been included in the version 1.6 update. There is more info here: [Yoast Changelog](https://wordpress.org/plugins/wordpress-seo/changelog/).

= Do you make use of SITELINK SEARCH BOX yourself? = 
Of course we do. ;-)

== Screenshots ==

1. Sitelink Search Box YouTube search example
2. Homepage source code example

== Changelog ==

= 1.3 =
* Updated get_site_url() to get_home_url() to match guideline "url - This property specifies the URL of your website. It must match the canonical URL of your domain's homepage". Thanks to hennell for pointing this out.

= 1.2 =
* Do not insert markup if YOAST SEO plugin is active as it adds the same information.

= 1.1 =
* Changed get_site_url() to get_home_url() for support of WordPress installations in subfolders. Thanks to Diego Betto for pointing this out.

= 1.0.1 =
* Updated readme.txt file with info about "WordPress SEO by Yoast" including the Sitelink Search Box markup in their plugin from version 1.6 on. If you use WordPress SEO by Yoast version 1.6 or newer, you don't need this plugin any more.

= 1.0 =
* First stable release.

= 0.5 =
* Beta release.

== Upgrade Notice ==

= 1.3 =
Updated get_site_url() to get_home_url() to match guideline "url - This property specifies the URL of your website. It must match the canonical URL of your domain's homepage".

== Contact ==

For further information please send us an [email](http://apasionados.es/contacto/index.php?desde=wordpress-org-sitelinksearchbox-contact).

== Translating WordPress Plugins ==

The steps involved in translating a plugin are:

1. Run a tool over the code to produce a POT file (Portable Object Template), simply a list of all localizable text. Our plugins allready havae this POT file in the /languages/ folder.
1. Use a plain text editor or a special localization tool to generate a translation for each piece of text. This produces a PO file (Portable Object). The only difference between a POT and PO file is that the PO file contains translations.
1. Compile the PO file to produce a MO file (Machine Object), which can then be used in the theme or plugin.

In order to translate a plugin you will need a special software tool like [poEdit](http://www.poedit.net/), which is a cross-platform graphical tool that is available for Windows, Linux, and Mac OS X.

The naming of your PO and MO files is very important and must match the desired locale. The naming convention is: `language_COUNTRY.po` and plugins have an additional naming convention whereby the plugin name is added to the filename: `pluginname-fr_FR.po`

That is, the plugin name name must be the language code followed by an underscore, followed by a code for the country (in uppercase). If the encoding of the file is not UTF-8 then the encoding must be specified. 

For example:

* en_US – US English
* en_UK – UK English
* es_ES – Spanish from Spain
* fr_FR – French from France
* zh_CN – Simplified Chinese

A list of language codes can be found [here](http://en.wikipedia.org/wiki/ISO_639), and country codes can be found [here](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2). A full list of encoding names can also be found at [IANA](http://www.iana.org/assignments/character-sets).
