	//Intialise variable
	var x = window.matchMedia("(max-width: 767px)")
	myFunction(x) // Call listener function at run time
	x.addListener(myFunction)

	function myFunction(x) {
		if (x.matches) { // If media query matches
			// jQuery element variables
			var $hamburgerMenuBtn,
				$slideNav,
				$closeBtn,
				$main;

			// focus management variables
			var $focusableInNav,
				$firstFocusableElement,
				$lastFocusableElement;

			jQuery(document).ready(function() {
				$hamburgerMenuBtn = jQuery("#hamburger-menu"),
				$slideNav = jQuery("#slide-nav"),
				$closeBtn = jQuery("#close"),
				$main = jQuery("main"),
				$focusableInNav = jQuery('#slide-nav button, #slide-nav [href], #slide-nav input, #slide-nav select, #slide-nav textarea, #slide-nav [tabindex]:not([tabindex="-1"])');
				if ($focusableInNav.length) {
					$firstFocusableElement = $focusableInNav.first();
					$lastFocusableElement = $focusableInNav.last();
				}
				addEventListeners();
			});

			function addEventListeners() {
			  $hamburgerMenuBtn.click(openNav);
			  $closeBtn.click(closeNav);
			  $slideNav.on("keyup", closeNav);
			  $firstFocusableElement.on("keydown", moveFocusToBottom);
			  $lastFocusableElement.on("keydown", moveFocusToTop);
			}

			function openNav() {
			  $slideNav.addClass("visible active");
			  setTimeout(function() {
				$firstFocusableElement.focus()
			  }, 1);
			  $main.attr("aria-hidden", "true");
			  $hamburgerMenuBtn.attr("aria-hidden", "true");
			}

			function closeNav(e) {
				if (e.type === "keyup" && e.key !== "Escape") {
				return;
				}

				$slideNav.removeClass("active");
				$main.removeAttr("aria-hidden");
				$hamburgerMenuBtn.removeAttr("aria-hidden");
				setTimeout(function() {
				$hamburgerMenuBtn.focus()
				}, 1);
				setTimeout(function() {
				$slideNav.removeClass("visible")
				}, 501);
			}

			function moveFocusToTop(e) {
				if (e.key === "Tab" && !e.shiftKey) {
				e.preventDefault();
				$firstFocusableElement.focus();
				}
			}

			function moveFocusToBottom(e) {
				if (e.key === "Tab" && e.shiftKey) {
				e.preventDefault();
				$lastFocusableElement.focus()
				}
			}
		}
	}
