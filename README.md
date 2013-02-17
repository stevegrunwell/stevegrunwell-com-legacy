# SteveGrunwell.com

This repository contains the current site files for http://stevegrunwell.com, the blog/portfolio site of developer Steve Grunwell.

**Included in this repository:**

* WordPress core files
* Plugin files
* "grunwell2012" WordPress theme

**What's *not* included:**

* Database dump
* Uploaded media (/wp-content/uploads/)

## Cloning this repository

If you wish to run your own version of this WordPress installation you'll need to take a few extra steps beyond "clone and deploy":

1. Clone the git repo: `git clone https://stevegrunwell@github.com/stevegrunwell/stevegrunwell-com.git [directory]`
2. Initiate the Simple Twitter Timeline git submodule:

    cd [directory]
    git submodule init
    git submodule update

3. Try to visit your new WordPress installation. Since wp-config.php is missing, you should be shown the standard WordPress installation screen (as usual, if your system won't let WordPress create a wp-config file you'll need to copy wp-config-sample.php @cp wp-config-sample.php wp-config.php@ and edit the file manually).
4. Once WordPress is setup, you'll need to activate the plugins and start creating your post/page structure. If you plan on using the Advanced Custom Fields repeater, you'll need to purchase a key from http://www.advancedcustomfields.com/add-ons/repeater-field/

## Roadmap

There are a ton of things left to do on the site, but it's being treated as a work in progress (a nice way of saying "moving target").

* Better organization of styles
* Enhanced commenting
* Better responsiveness
* Cache as much as possible
* Move things like the Google Analytics profile ID to a site options page
* Dedicated page template for code demonstrations/proofs of concept
* Replace Contact Form 7 with Gravity Forms
* Do away with the Custom Permalinks plugin