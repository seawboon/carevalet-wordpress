jQuery(document).ready(function(){
	//For Menu Drop-down Focus (sub-menu)
	const topLevelLinks = document.querySelectorAll('.dropdown-toggle');
	console.log(topLevelLinks);

	topLevelLinks.forEach(link => {
	  if (link.nextElementSibling) {
		link.addEventListener('focus', function() {
		  this.parentElement.classList.add('focus');
		});

		const subMenu = link.nextElementSibling;
		const subMenuLinks = subMenu.querySelectorAll('a');
		const lastLinkIndex = subMenuLinks.length - 1;
		const lastLink = subMenuLinks[lastLinkIndex];

		lastLink.addEventListener('blur', function() {
		  link.parentElement.classList.remove('focus');
		});
	  }
	});
});