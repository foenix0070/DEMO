/**
 * Wrap everything in a function to prevent naming conflicts
 */
(() => {

	/**
	 * This class handles all tab-elements
	 */
	class Tabs {
		/**
		 * Kick things off
		 *
		 * @param {Node} _element The tab root element
		 */
		constructor(_element) {
			this._element = _element;
			this._tabs = Array.from(this._element.querySelectorAll('.m-tabs__tab'));
			this._panels = Array.from(this._element.querySelectorAll('.m-tabs__panel'));
			this._setupEventListeners();
			this._responsiveTabs = new ResponsiveTabs(this._element);
			this._checkNavigationHash();
			this.fixedTeasers = [];
		}

		/**
		 * Adds all EventListeners
		 */
		_setupEventListeners() {
			this._tabs.forEach((_tab) => {
				_tab.addEventListener('click', this._clickOnTab.bind(this));
			});
			window.addEventListener('hashchange', this._checkNavigationHash.bind(this));
		}

		/**
		 * Handles clicks on a tab-button
		 *
		 * @param {Event} _event
		 */
		_clickOnTab(_event) {
			_event.preventDefault();
			this.openTab(this._tabs.indexOf(_event.currentTarget));
		}

		/**
		 * Search in the clicked tab pane for teasers from sg_teaser extension and trigger click
		 * or change event on navigation elements to rearrange the grid regarding url for one dimensional teasers.
		 * This only needs to be done once per tab.
		 *
		 * @param index
		 * @private
		 */
		_fixTeaser(index) {
			// One dimensional
			let teaserNavigations = this._panels[index].querySelectorAll(
				'.sg-teaser-category-navigation',
			);
			const urlParts = decodeURI(document.location.href).split('#');
			let activeCategory = '';
			if (urlParts.length > 1) {
				const filterParts = urlParts[1].split('-');
				const index2 = filterParts.indexOf('filterby') + 1;
				if (index2 > 0) {
					activeCategory = filterParts[index2];
				}
			}
			teaserNavigations.forEach((navigation) => {
				// Make sure that the parent container has full width
				setTimeout(() => {
					const [first] = navigation.childNodes;
					if (activeCategory === '') {
						first.click();
					} else {
						for (let i = 0; i < navigation.childNodes.length; i++) {
							if (
								navigation.childNodes[i].getAttribute('data-category') ===
								activeCategory
							) {
								navigation.childNodes[i].click();
								break;
							}
						}
					}
				}, 500);
			});
			// Multi dimensional
			teaserNavigations = this._panels[index].querySelectorAll('.sg-teaser-filter-bar');
			teaserNavigations.forEach((navigation) => {
				// Make sure that the parent container has full width
				setTimeout(() => {
					const select = navigation.querySelector('select');
					select.dispatchEvent(new Event('change'));
				}, 500);
			});
		}

		/**
		 * Opens the panel with the given index
		 *
		 * @param {Number} index The index of the panel to open
		 */
		openTab(index) {
			this._tabs.forEach((_tab) => {
				_tab.setAttribute('aria-selected', false);
			});
			this._panels.forEach((_panel) => {
				_panel.classList.add('m-tabs__panel--closed');
			});
			const selectedTab = this._tabs[index];
			const selectedPanel = this._panels[index];

			if (typeof this.fixedTeasers === 'undefined') {
				this.fixedTeasers = [];
			}

			// Once a teaser is rearranged, it is fixed.
			if (this.fixedTeasers.indexOf(index) < 0) {
				this._fixTeaser(index);
				this.fixedTeasers.push(index);
			}

			selectedTab.setAttribute('aria-selected', true);
			selectedPanel.classList.remove('m-tabs__panel--closed');
			window.history.pushState({info: 'tab-navigation'}, '', `#${selectedPanel.id}`);
		}

		/**
		 * Checks the current hash and opens the associated panel if there is one
		 */
		_checkNavigationHash() {
			if (window.location.hash === '') {
				return;
			}
			// Prevents errors thrown when used on the same page as sg_teaser
			// as that uses different hash formats
			const [, id] = decodeURIComponent(window.location.hash).split('#');
			// #! is the hash when sg_teaser isn't filtered
			if (id === '!') {
				return;
			}
			const associatedPanel = document.querySelector(`#${id}`);
			if (associatedPanel) {
				const panelIndex = this._panels.indexOf(associatedPanel);
				if (panelIndex >= 0) {
					this.openTab(panelIndex);
				}
			}
		}
	}

	/**
	 * This module expands a tab-based navigation into a responsive component
	 */
	class ResponsiveTabs {
		/**
		 * Kicks things off
		 */
		constructor(_tabElement) {
			this._tabElement = _tabElement;
			this._tabContainer = this._tabElement.querySelector('[role="tablist"]');
			this._tabs = Array.from(this._tabContainer.querySelectorAll('[role="tab"]'));
			this._moreLabel = this._getMoreLabel();
			this._surplusWidth = 0;
			this._createDropDownToggle();
			if (this._tabs.length) {
				this._checkTabsLength();
			}
			this._setupEventListeners();
		}

		/**
		 * Sets up all EventListeners
		 *
		 * @private
		 */
		_setupEventListeners() {
			window.addEventListener('resize', this._checkTabsLength.bind(this));
			document.addEventListener('keyup', this._keyUp.bind(this));
		}

		/**
		 * Checks the current dimensions and triggers the track setup
		 *
		 * @private
		 */
		_checkTabsLength() {
			this._setupTrack(this._tabs.length);
		}

		/**
		 * Extracts the label for the dropdown
		 *
		 * @return {string}
		 * @private
		 */
		_getMoreLabel() {
			const moreLabel = this._tabElement.getAttribute('data-more-label');
			if (!moreLabel) {
				throw Error('Responsive Tabs: More-label name must be provided via data-attribute');
			}
			return moreLabel;
		}

		/**
		 * Returns the index of the currently active tab
		 *
		 * @return {Number}
		 * @private
		 */
		_getActiveTabIndex() {
			const activeElement = this._tabElement.querySelector('[aria-selected="true"]');
			return this._tabs.indexOf(activeElement);
		}

		/**
		 * Creates the toggle-element for the dropdown
		 *
		 * @private
		 */
		_createDropDownToggle() {
			this._dropDownToggle = document.createElement('button');
			this._dropDownToggle.classList.add('responsive-tab-more');
			this._dropDownToggle.style.position = 'absolute';
			this._dropDownToggle.style.right = '0';
			this._dropDownToggle.style.top = '0';
			this._dropDownToggle.style.display = 'none';
			this._dropDownToggle.innerHTML = this._moreLabel;
			this._dropDownToggle.addEventListener('click', this.toggleDropDown.bind(this));
		}

		/**
		 * Handles the whole track setup
		 *
		 * @param {Number} _numberOfTabs
		 * @private
		 */
		_setupTrack(_numberOfTabs) {
			this._tabElement.classList.add('responsive-tabs-active');
			this._tabElement.style.position = 'relative';
			let numberOfElementsThatFit = this._tabs.length;

			const totalTabsWidth = parseInt(
				this._tabs.reduce(
					(_sum, _currentTab) => _sum + ResponsiveTabs.getItemWidth(_currentTab),
					0,
				),
			);

			const panelWidth = parseInt(this._tabElement.getBoundingClientRect().width);

			if (panelWidth < totalTabsWidth) {
				let totalWidth = totalTabsWidth;
				let counter = this._tabs.length - 1;
				while (totalWidth > panelWidth && counter >= 0) {
					totalWidth -= ResponsiveTabs.getItemWidth(this._tabs[counter]);
					numberOfElementsThatFit -= 1;
					counter -= 1;
				}
			}

			const numberOfLeftOverElements = this._tabs.length - numberOfElementsThatFit;

			if (numberOfLeftOverElements > 0) {
				// activate dropdown
				this._dropDownToggle.style.display = 'block';
				this._tabContainer.appendChild(this._dropDownToggle);
			} else if (this._dropDownToggle.parentNode === this._tabContainer) {
				// remove the toggle if it is not needed anymore
				this._tabContainer.removeChild(this._dropDownToggle);
			}
			if (this._offScreenItems) {
				// remove current offscreen items
				this._offScreenItems.forEach((item) => {
					item.setAttribute('style', '');
					item.classList.remove('responsive-tabs-off-screen');
				});
			}
			this._offScreenItems = [];
			if (numberOfLeftOverElements > 0) {
				// swap elements if the currently active one would be hidden in the dropdown
				const offset = Math.max(numberOfElementsThatFit - 1, 1);
				const activeTabIndex = this._getActiveTabIndex();
				if (!this._swapped && activeTabIndex >= offset) {
					ResponsiveTabs.swapElements(this._tabs[activeTabIndex], this._tabs[0]);
					this._tabs = Array.from(
						this._tabContainer.querySelectorAll('[role="tab"]:not(.responsive-tab-more)'),
					);
					this._swapped = true;
				} else if (this._swapped && activeTabIndex < offset) {
					ResponsiveTabs.swapElements(this._tabs[activeTabIndex], this._tabs[0]);
					this._tabs = Array.from(
						this._tabContainer.querySelectorAll('[role="tab"]:not(.responsive-tab-more)'),
					);
					this._swapped = false;
				}

				// move surplus items to dropdown
				for (let index = offset; index < _numberOfTabs; index++) {
					this._moveItemToDropDown(this._tabs[index], index - numberOfElementsThatFit + 2);
				}
			}
			if (numberOfElementsThatFit <= 1) {
				this._dropDownToggle.style.position = 'relative';
			} else {
				this._dropDownToggle.style.position = 'absolute';
			}
			this.closeDropDown();
		}

		/**
		 * Calculates and caches the width of the given element.
		 * This function will return a cached value after the first call.
		 *
		 * @param {Node} _item The DOMNode to get the width of
		 */
		static getItemWidth(_item) {
			if (!_item.dataset.width) {
				_item.dataset.width = parseInt(_item.getBoundingClientRect().width);
			}
			return parseInt(_item.dataset.width);
		}

		/**
		 * Moves a given _item off screen
		 * _position indicates the vertical position inside the stack
		 *
		 * @param {Node} item
		 * @param {Number} _position
		 * @private
		 */
		_moveItemToDropDown(item, _position) {
			const currentTabWidth = item.getBoundingClientRect().width;
			if (this._surplusWidth < currentTabWidth) {
				this._surplusWidth = currentTabWidth;
				this._offScreenItems.forEach((_item) => {
					_item.style.width = `${this._surplusWidth}px`;
				});
			}
			this._offScreenItems.push(item);
			item.style.width = `${this._surplusWidth}px`;
			item.style.position = 'absolute';
			item.style.right = '0';
			item.style.zIndex = 100;
			item.style.top = `${item.getBoundingClientRect().height * _position}px`;
			item.classList.add('responsive-tabs-off-screen');
		}

		/**
		 * Toggles the dropdown
		 *
		 * @param {Event} _event
		 */
		toggleDropDown(_event) {
			_event.preventDefault();
			if (this._dropDownOpen) {
				this.closeDropDown();
			} else {
				this.openDropDown();
			}
		}

		/**
		 * Opens the dropdown
		 */
		openDropDown() {
			this._offScreenItems.forEach((item) => {
				item.style.display = 'block';
			});
			this._dropDownOpen = true;
			this._clickOutsideHandler = this._checkClickOutside.bind(this);
			document.addEventListener('click', this._clickOutsideHandler);
		}

		/**
		 * Closes the dropdown
		 */
		closeDropDown() {
			this._offScreenItems.forEach((item) => {
				item.style.display = 'none';
			});
			this._dropDownOpen = false;
		}

		/**
		 * Close the DropDown on ESC
		 *
		 * @param {Event} _event
		 * @private
		 */
		_keyUp(_event) {
			if (_event.key === 'Escape') {
				this.closeDropDown();
			}
		}

		/**
		 * Checks if a click occurred outside of the flyout and closes it if so
		 *
		 * @param {Event} _event
		 * @private
		 */
		_checkClickOutside(_event) {
			if (!this._tabElement.contains(_event.target)) {
				this.closeDropDown();
				document.removeEventListener('click', this._clickOutsideHandler);
			}
		}

		/**
		 * Swaps two given DOM Nodes
		 *
		 * @param {Node} node1
		 * @param {Node} node2
		 * @private
		 */
		static swapElements(node1, node2) {
			// create marker element and insert it where node1 is
			const temp = document.createElement('div');
			node1.parentNode.insertBefore(temp, node1);

			// move node1 to right before node2
			node2.parentNode.insertBefore(node1, node2);

			// move node2 to right before where node1 used to be
			temp.parentNode.insertBefore(node2, temp);

			// remove temporary marker node
			temp.parentNode.removeChild(temp);
		}
	}

	document.querySelectorAll('.m-tabs').forEach((tabs) => {
		new Tabs(tabs);
	});
})()
