#  Ext: df_tabs

<img src="https://www.sgalinski.de/typo3conf/ext/project_theme/Resources/Public/Images/logo.svg" />

License: [GNU GPL, Version 2](https://www.gnu.org/licenses/gpl-2.0.html)

Repository: https://gitlab.sgalinski.de/typo3/df_tabs

Please report bugs here: https://gitlab.sgalinski.de/typo3/df_tabs

## About

This extension adds a new plugin to the content element wizard that provides the user the possibility to define other content elements and pages as tab based content.
Furthermore, you can define an auto-play mechanism with a custom interval to implement an auto-sliding effect.

## Installation
1. Install the extension with the extension manager

2. Add the static template of the extension to your template of your root page, or your extension root templates

3. Download and include the MooTools Core or JQuery (If your project already has MooTools or JQuery included, skip this step)

4. Implement your custom css code and override the include configuration option in the constants of the very same template with the integration of the static template from df_tabs

## Usage

### Configuration

#### Fluid Renderer

The output can be completely controlled from within the Fluid-Template `(EXT:df_tabs/Resources/Private/Templates/Standard/Tabs.html)`.
Just overwrite it to adjust it to your needs.

##### TypoScript Constants

```TypoScript
# The css file that should be used.
css = EXT:df_tabs/Resources/Public/StyleSheets/df_tabs.css

js {
    # Javascript file that implements the back button for tabs
    history = EXT:df_tabs/Resources/Public/Scripts/History/History.js

    # Router Javascript file (see above)
    historyRouting = EXT:df_tabs/Resources/Public/Scripts/History/History.Routing.js

    # Javascript that implements the default tab functionality
    app = EXT:df_tabs/Resources/Public/Scripts/df_tabs.js

    # JQuery specific code
    jqueryApp = EXT:df_tabs/Resources/Public/Scripts/jquery.tabs.js
}

# Enables the usage of the inline javascript that triggers the functionality
enableJavascript = 1

# Default tab title if the given information is empty
defaultTabTitle = Tab

#
classPrefix = tx-dftabs-

# Prefix for classes and ids to prevent html errors and styling problems if multiple plugins are used on the same page
hashName = tab

# Polling interval (in ms) to detect url changes for the history functionality
pollingInterval = 1000

# Animation speed in ms (if a transition effect between the tabs is used)
animationSpeed = 400

# the tab index where the animation should start (starts with 0)
startIndex = 0

#
forceUsageOfLeft = false

# Node type that is used for the tab menu
menuNodeType = li

# Node type that is used for the tab content
contentNodeType = div

# Javascript callback function that is triggered for the tab switches. The default is no animation
animationCallback =

# Remove a substring from all tab-title. Can be either a string, or a regex. This example will remove the string
# 'Foo' if is found at the end of the title.
removeFromTitle = Foo$

# flexform options for the plugin usage with plain typoscript

# Enables the autoplay functionality
enableAutoPlay = 0

# Interval of the autoplay functionality in ms
autoPlayInterval = 7000

# Enables the mouseover event for tab switches instead of simple clicks
enableMouseOver = 0

# Data Provider Mode: tt_content, pages, combined and typoscript
mode = tt_content

# Comma separated list of preferred menu titles
titles =

# Comma-separated list of ids related to the mode; not needed for the typoscript mode; combined mode requires the table name as a prefix of the id (e.g. pages_12,tt_content_14)
data =

# pages mode related configuration settings
pages {

    # Limit of fetched content elements from a page
    limit = 999

    # Order clause for the content elements
    orderBy = colPos,sorting

    # Extra filter for content elements from a page
    additionalWhere = AND colPos >= 0

    # Title field for the tab menu
    titleField = title

    # Link field for links
    linkField = uid
}

# tt_content mode related configuration settings
tt_content {

    # Title field for the tab menu
    titleField = header

    # Link field for links
    linkField = header_link
}
```

#### Output customization
There are various settings in the **setup.txt** TypoScript file, which allow you to customize the output beyond css.

```TypoScript
stdWrap {
    # Tab content title (normally hidden in JS mode)
    tabTitle {
        wrap = <h4 class="###CLASSES###">|</h4>
    }

    # Wrap around all tab content elements
    tabContents {
        wrap = <div class="###CLASSES###" id="###ID###">|</div>
    }

    # Tab content element
    tabContent {
        wrap = <div class="###CLASSES###" id="###ID###">|</div>
    }

    # Wrap around all tab menu entries
    tabMenu {
        wrap = <ul class="###CLASSES###" id="###ID###">|</ul>
    }

    # Tab menu entry (###LINK### can also be used in combination with the linkField property)
    tabMenuEntry {
        wrap = <li id="###ID###" class="###CLASSES###"><a href="###LINK_ANCHOR###">|</a></li>

        # alternative wrap if you want to jump directly to the tab if the location hash changes
        # wrap = <li id="###ID###" class="###CLASSES###"><a href="###LINK_ANCHOR###" id="###LINK_ID###">|</a></li>
    }
}
```

#### Plugin Settings

##### Mode

###### Show Content Elements
Retrieves the tab contents from the tt_content table.

###### Show Pages
Retrieves the tab contents from the pages table.

###### Combined
Use the tt_content and the pages table to retrieve the content

---

##### Pages and content
Here you can select pages or single content elements, that should be displayed in a tab:

<img height="20px" width="20px" src="https://raw.githubusercontent.com/TYPO3/TYPO3.Icons/master/src/apps/apps-pagetree-page-hideinmenu.svg"> Opens the "Select Page" dialog
<br>
<img height="20px" width="20px" src="https://raw.githubusercontent.com/TYPO3/TYPO3.Icons/master/src/content/content-text.svg"> Opens the "Select Page Content" dialog

---

##### Override Tab Titles
Here you can specify a linebreak separated list of preferred menu titles.

---

##### Enable Autoplay
If this setting is enabled, the tabs will automatically be switched through in a given time interval.

---

##### Autoplay Interval
Sets the time interval for the autoplay option. Is ignored if autoplay is disabled.

---

##### Enable MouseOver Navigation
If this setting is enabled, the tab will switch on the mouse over event instead of clicking.

---

##### Hash
Name that is displayed as the prefix of the anchor for the url if a tab was clicked to implement the history and direct linking functionality to the tabs.

## Styles

The new version brings its own styles both as CSS aswell as as SASS. To compile SASS you can use

sass Resources/Public/Sass/df_tabs.scss Resources/Public/StyleSheets/df_tabs.css --style -C --sourcemap=none

## JavaScript

Starting from 8.1.0 there will be a fully functional JavaScript file loaded to the frontend which does **not** require any additional libraries.
The JavaScript file can be disabled by emptying out the typoscript variable ```plugin.tx_dftabs_plugin1.js.dftabs```.
