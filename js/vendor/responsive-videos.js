/* Responsive video embed */
HTMLElement.prototype.wrap = function (elms) {
    if (!elms.length) elms = [elms];
    for (var i = elms.length - 1; i >= 0; i--) {
        var child = (i > 0) ? this.cloneNode(true) : this;
        var el = elms[i];
        var parent = el.parentNode;
        var sibling = el.nextSibling;
        
        child.appendChild(el);
        if (sibling) parent.insertBefore(child, sibling);
        else parent.appendChild(child);
    }
};
	
(function() {
	var videos = document.querySelectorAll('iframe[src*="youtube.com"], iframe[src*="player.vimeo.com"]');
	if(videos.length > 0) {

		var newWrapper = document.createElement('div');
		newWrapper.classList.add('embed-container');
		newWrapper.wrap(videos);

		var css = '.embed-container { position: relative; padding-bottom: 56.25%;height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }';
		var style = document.createElement('style');
		style.type = 'text/css';

		if (style.styleSheet) style.styleSheet.cssText = css;
		else style.appendChild(document.createTextNode(css));

		document.querySelector('body').appendChild(style);
	}
})();