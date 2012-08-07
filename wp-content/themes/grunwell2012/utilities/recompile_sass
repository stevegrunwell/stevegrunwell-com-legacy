#!/bin/bash

# Make sure that the 'sass' command exists (see http://stackoverflow.com/a/677212/329911)
command -v sass >/dev/null 2>&1 || {
  echo >&2 "SASS does not appear to be available. Unable to re-compile stylesheets";
  exit 1;
}

# Define our paths and stylesheets
echo "Re-compiling stylesheets..."
cd wp-content/themes/grunwell2012/css/

sass style.scss style.css --style compressed
echo "style.scss -> style.css (compressed)"

sass ie8.scss ie8.css --style compressed
echo "ie8.scss -> ie8.css (compressed)"

echo "Sassification is complete"
exit 0