/*
	<a class="anyclass" href="#" data-toggler=".menu|active-menu animated-menu, self|active-button">Menu</a>

	data-toggler="css-selector|class another-class, another-selector|class"

	Use keywords "self" or "this" to apply classes to itself
*/
(function() {

var clickToggle = document.querySelectorAll('[data-toggler]');

if(clickToggle.length > 0) {

	for(var i=0; i<clickToggle.length; i++) {

		if(clickToggle[i].getAttribute('data-toggler') != "") {

			clickToggle[i].addEventListener('click', function(e) {
				e.preventDefault();

				var targets = this.getAttribute('data-toggler');

				targets = targets.split(',');

				for(var n=0; n<targets.length; n++) {

					targets[n] = targets[n].trim();

					var item = targets[n].split('|');
					if(item) {
						var target = item[0];
						var classes = item[1];

						classes = classes.split(' ');

						if(target === "this" || target === "self") var elem = [this];
						else var elem = document.querySelectorAll(target);

						if(elem) {
							for(var j=0; j<elem.length; j++) {
								for(var k=0; k<classes.length; k++) {
									
									classes[k] = classes[k].trim();
									if(classes[k] != "") elem[j].classList.toggle(classes[k]);
								}
							}
						}
					}
				}
			});
		}
	}
} 

})();