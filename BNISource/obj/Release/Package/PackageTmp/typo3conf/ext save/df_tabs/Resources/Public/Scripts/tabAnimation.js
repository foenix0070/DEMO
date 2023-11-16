/**
 * Smooth Image Transition effect
 *
 * @author Stefan Galinski <stefan.galinski@gmail.com>
 */
var dfTabsSmoothImageTransition = {
	/**
	 * Preparation for the animation effects
	 *
	 * @param {TabBar} tabBar
	 * @return {void}
	 */
	beforeInitialize: function(tabBar) {
		if (jQuery) {
			$.each(tabBar.elementMap, function(index, element) {
				if (!element.contentItem.hasClass(tabBar.options.classPrefix + 'tabContentSelected')) {
					element.contentItem.css('display', 'none');
				}
			});
		} else {
			tabBar.elementMap.each(function(element) {
				element.contentItem.set('tween', {
					duration: tabBar.options.animationSpeed
				});

				if (!element.contentItem.hasClass(tabBar.options.classPrefix + 'tabContentSelected')) {
					element.contentItem.fade('hide');
				}
			});
		}
	},

	/**
	 * Animates the transition between two tabs
	 *
	 * @param {int} nextTabIndex
	 * @return {void}
	 */
	tabChange: function(nextTabIndex) {
		if (this.previousTab < 0) {
			return;
		}

		var selectedClass = '';
		if (jQuery) {
			this.elementMap[this.previousTab].contentItem.fadeOut(this.options.animationSpeed);
			this.elementMap[nextTabIndex].contentItem.fadeIn(this.options.animationSpeed);

			selectedClass = this.options.classPrefix + 'tabMenuEntrySelected';
			$.each(this.elementMap, function(index, element) {
				element.menuItem.removeClass(selectedClass);
			});
		} else {
			this.elementMap[this.previousTab].contentItem.fade('out');
			this.elementMap[nextTabIndex].contentItem.fade('in');

			selectedClass = this.options.classPrefix + 'tabMenuEntrySelected';
			this.elementMap.each(function(element) {
				element.menuItem.removeClass(selectedClass);
			});
		}

		this.elementMap[nextTabIndex].menuItem.addClass(selectedClass);
		this.previousTab = nextTabIndex;
	}
};

var dfTabsSlideTransition = {
	/**
	 * Preparation for the animation effects
	 *
	 * @param {TabBar} tabBar
	 * @return {void}
	 */
	beforeInitialize: function(tabBar) {
		var startIndex = tabBar.options.startIndex,
			nextIndex = startIndex + 1,
			prevIndex = startIndex -1;
		if (tabBar.elementMap.length > startIndex) {
			tabBar.elementMap[startIndex].contentItem.css({
				display: 'block'
			});
			tabBar.elementMap[startIndex].contentItem.addClass('current');
		}
		if (tabBar.elementMap.length > nextIndex) {
			var bannerElement = tabBar.elementMap[nextIndex].contentItem.find('.grid-bannerElement');
			tabBar.elementMap[nextIndex].contentItem.css({
				display: 'block'
			});
			dfTabsSlideTransition.setTransformation(bannerElement, 50, this.options.forceUsageOfLeft);
			tabBar.elementMap[nextIndex].contentItem.addClass('next');
		}
		if (prevIndex >= 0) {
			var bannerElement = tabBar.elementMap[prevIndex].contentItem.find('.grid-bannerElement');
			tabBar.elementMap[prevIndex].contentItem.css({
				display: 'block'
			});
			dfTabsSlideTransition.setTransformation(bannerElement, -50, this.options.forceUsageOfLeft);
			tabBar.elementMap[prevIndex].contentItem.addClass('prev');
		}
	},

	/**
	 * Animates the transition between two tabs
	 *
	 * @param {int} nextTabIndex
	 * @return {void}
	 */
	tabChange: function(nextTabIndex) {
		if (this.previousTab < 0) {
			return;
		}

		var selectedClass = '',
			elementMap = this.elementMap,
			direction = nextTabIndex - this.previousTab,
			options = this.options;

		// reset all slides
		$(this.elementMap).each(function() {
			this.contentItem.removeClass('prev current next');
			this.contentItem.css({
				visibility: 'hidden'
			});
		});

		if (direction > 0) {
			setPrev(nextTabIndex - 1);
			setCurrent(nextTabIndex);
			setNext(nextTabIndex + 1);
		} else {
			setPrev(nextTabIndex - 1);
			setCurrent(nextTabIndex);
			setNext(nextTabIndex + 1);
		}

		function setPrev(index) {
			if (index >= 0) {
				var bannerElement = elementMap[index].contentItem.find('.grid-bannerElement');
				elementMap[index].contentItem.addClass('prev');
				elementMap[index].contentItem.css({
					visibility: 'visible'
				});
				$({left: direction > 0 ? 0 : -100}).animate({left: -50}, {
					step: function(value) {
						dfTabsSlideTransition.setTransformation(bannerElement, value, options.forceUsageOfLeft);
					}
				});
			}
		}

		function setCurrent(index) {
			var bannerElement = elementMap[index].contentItem.find('.grid-bannerElement');
			elementMap[index].contentItem.addClass('current');
			elementMap[index].contentItem.css({
				visibility: 'visible'
			});
			$({left: direction > 0 ? 50 : -50}).animate({left: 0}, {
				step: function(value) {
					dfTabsSlideTransition.setTransformation(bannerElement, value, options.forceUsageOfLeft);
				}
			});
		}

		function setNext(index) {
			if (index < elementMap.length) {
				var bannerElement = elementMap[index].contentItem.find('.grid-bannerElement');
				elementMap[index].contentItem.addClass('next');
				elementMap[index].contentItem.css({
					visibility: 'visible'
				});
				$({left: direction > 0 ? 100 : 0}).animate({left: 50}, {
					step: function(value) {
						dfTabsSlideTransition.setTransformation(bannerElement, value, options.forceUsageOfLeft);
					}
				});
			}
		}

		selectedClass = this.options.classPrefix + 'tabMenuEntrySelected';
		$.each(this.elementMap, function(index, element) {
			element.menuItem.removeClass(selectedClass);
		});

		this.elementMap[nextTabIndex].menuItem.addClass(selectedClass);
		this.previousTab = nextTabIndex;
	},

	/**
	 * set the transformation style via 'left', or 'transform' if supported
	 * @param element {Object] the dom node to apply the transformation on
	 * @param value {Number} the offset
	 * @param useLeft {Boolean} use left instead of transform
	 */
	setTransformation: function(element, value, useLeft) {
		if ($.support.transition && !useLeft) {
			element.css({
				transform: 'translateX(' + value + '%)'
			});
		} else {
			element.css({
				left: value + '%'
			})
		}
	}
};

$.support.transition = (function(){
	var thisBody = document.body || document.documentElement,
		thisStyle = thisBody.style,
		support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined;
	return support;
})();
