/* Load more */
var loadmore = document.querySelectorAll('.loadmore');
if(loadmore) for(var i=0; i<loadmore.length; i++) loadmore[i].addEventListener('click', function(e){
	e.preventDefault();

	var target = this.getAttribute('data-target');
	var offset = parseInt(this.getAttribute('data-posts-offset'));
	var term = this.getAttribute('data-term');
	var parent = this.getAttribute('data-parent');
	var search = this.getAttribute('data-search');
	var load = this.getAttribute('data-load');
	var author = this.getAttribute('data-author');

	if(load != '' && load != null) load = parseInt(load);
	else load = 12;

	var params = ''

	if(term != '' && term != null) term = '&term='+term;
	else term = '';

	if(parent != '' && parent != null) parent = '&parent='+parent;
	else parent = '';

	if(search != '' && search != null) search = '&search='+search;
	else search = '';

	if(author != '' && author != null) author = '&author='+author;
	else author = '';

	params = term+parent+search+author

	var obj = this;
	var feed = document.querySelector('#main-feed');

	xhr = new XMLHttpRequest();
	xhr.open('GET', '//aroundart.org/wp-admin/admin-ajax.php?action=load_more_posts_ajax&offset='+offset+'&load='+load+params);

	xhr.onreadystatechange = function () {
	    if(xhr.readyState == 4 && xhr.status == 200) {
	    	//good
			//use xhr.responseText
			if(xhr.responseText == '""') return;

			if(target) {
				document.querySelector(target).innerHTML += JSON.parse(xhr.responseText);

				offset += load;
			} else {
				feed.innerHTML += JSON.parse(xhr.responseText);

				offset += load;
			}

			obj.setAttribute('data-posts-offset', offset);
	    }
	    if(xhr.readyState == 4 && xhr.status != 200) {
	    	//bad
	    }
	}
	xhr.send();
});

/* Textmode */
var mode = localStorage.getItem('mode');
if(mode && mode != 'null') {
	document.querySelector('body').classList.add('textmode');
	document.querySelector('a.textmode').classList.add('active');
}

var textmode = document.querySelector('a.textmode');
if(textmode) textmode.addEventListener('click', function(e){
	e.preventDefault();

	this.classList.toggle('active');

	var body = document.querySelector('body');
	body.classList.toggle('textmode');

	if(body.classList.contains('textmode')) localStorage.setItem('mode', 'true');
	else localStorage.setItem('mode', 'null');
});

function filterChain(selectedItems, inputs, data, val) {

	if(!selectedItems) return; if(!inputs) return; if(!data) return;

	for(j=0; j<inputs.length; j++) if(inputs[j].value != '') if(val != '') inputs[j].parentNode.classList.add('hide-item'); else inputs[j].parentNode.classList.remove('hide-item');

	for(var i=0; i<selectedItems.length; i++) {

		for(j=0; j<inputs.length; j++) {

			if(selectedItems[i].getAttribute(data).trim() == inputs[j].value.trim()) {
				inputs[j].parentNode.classList.remove('hide-item');
			}
		}
	}
}

/* Wiki */
if(document.querySelector('.wiki')) {

	var wikiOptions = {
		valueNames: [ 'name' ]
	};

	if(document.querySelector('ul#artist') != null) var artistsList = new List('artists', wikiOptions);
	if(document.querySelector('ul#person') != null) var personsList = new List('persons', wikiOptions);
	if(document.querySelector('ul#inst') != null) var instsList = new List('insts', wikiOptions);
	if(document.querySelector('ul#city') != null) var citiesList = new List('cities', wikiOptions);
	if(document.querySelector('ul#concept') != null) var conceptsList = new List('concepts', wikiOptions);

	// var filters = document.querySelectorAll('.wiki select');

	// if(filters) for(var i=0; i<filters.length; i++) filters[i].addEventListener('change', function(){
	// 	if(document.querySelector('ul#artist') != null) updateList('ul#artist');
	// 	if(document.querySelector('ul#person') != null) updateList('ul#person');
	// 	if(document.querySelector('ul#inst') != null) updateList('ul#inst');
	// });
	var togglers = document.querySelectorAll('#main-feed [data-toggler]');
	for(var i=0; i<togglers.length; i++) togglers[i].addEventListener('click', function(){
		document.querySelector('.fuckingbullshit').classList.remove('insane');
	});

	var filters = document.querySelectorAll('.wiki .dropdown input[type=radio]');



	if(filters) for(var i=0; i<filters.length; i++) filters[i].addEventListener('click', function(){

		var parent = this.parentNode.parentNode.parentNode;
		var id = parent.getAttribute('id');

		var link = document.querySelectorAll('.'+id+'-current');
		link[1].innerHTML = this.nextSibling.innerHTML;

		parent.classList.remove('active');
		link[1].classList.remove('active');

		document.querySelector('.fuckingbullshit').classList.add('insane');

		if(document.querySelector('ul#artist') != null) updateList('ul#artist');
		if(document.querySelector('ul#person') != null) updateList('ul#person');
		if(document.querySelector('ul#inst') != null) updateList('ul#inst');
	});

	// var pluses = document.querySelectorAll('a.current');
	// if(pluses) for(var i=0; i<pluses.length; i++) pluses[i].addEventListener('click', function(e){
	// 	e.preventDefault();
	// 	if(document.querySelector('ul#artist') != null) updateList('ul#artist');
	// 	if(document.querySelector('ul#person') != null) updateList('ul#person');
	// 	if(document.querySelector('ul#inst') != null) updateList('ul#inst');
	// });

	function generateSelector() {

		var filtered = document.querySelectorAll('.wiki .dropdown input[type=radio]:checked');

		var selector = '';

		// for(var i=0; i<filters.length; i++) if(filters[i].options[filters[i].selectedIndex].value != '') selector += '[data-'+filters[i].getAttribute('id')+'*="'+filters[i].options[filters[i].selectedIndex].value+'"]';

		for(var i=0; i<filtered.length; i++) if(filtered[i].value != '') selector += '[data-'+filtered[i].parentNode.parentNode.parentNode.getAttribute('id')+'*="'+filtered[i].value+'"]';

		return selector;
	}

	var firstFilter = false;

	function updateList(listSelector) {

		if(!listSelector) return;

		var selector = generateSelector();
		var lis = document.querySelectorAll(listSelector+' li');
		var selected = document.querySelectorAll(listSelector+' '+selector);

		if(selector != '') {

			for(var i=0; i<lis.length; i++) lis[i].classList.add('hide-item');
			for(var i=0; i<selected.length; i++) selected[i].classList.remove('hide-item');
		} else {

			for(var i=0; i<lis.length; i++) lis[i].classList.remove('hide-item');
		}

		var checkedInst = document.querySelector('#inst input[type=radio]:checked');
		var checkedCity = document.querySelector('#city input[type=radio]:checked');
		var checkedConcept = document.querySelector('#concept input[type=radio]:checked');

		var activeFilters = [];
		var inactiveFilters = [];


		if(checkedInst) {
			if(checkedInst.value == '') inactiveFilters.push(checkedInst.parentNode.parentNode.parentNode.getAttribute('id'));
			else activeFilters.push(checkedInst.parentNode.parentNode.parentNode.getAttribute('id'));
		}
		if(checkedCity) {
			if(checkedCity.value == '') inactiveFilters.push(checkedCity.parentNode.parentNode.parentNode.getAttribute('id'));
			else activeFilters.push(checkedCity.parentNode.parentNode.parentNode.getAttribute('id'));
		}
		if(checkedConcept) {
			if(checkedConcept.value == '') inactiveFilters.push(checkedConcept.parentNode.parentNode.parentNode.getAttribute('id'));
			else activeFilters.push(checkedConcept.parentNode.parentNode.parentNode.getAttribute('id'));
		}

		// if(checkedInst.value != '' && checkedCity.value == '' && checkedConcept.value == '') {
		// 	if(!firstFilter) firstFilter = 'inst';
		// 	var inputs = document.querySelectorAll('#city input[type=radio]');
		// 	filterChain(selected, inputs, 'data-city', 1);
		// 	inputs = document.querySelectorAll('#concept input[type=radio]');
		// 	filterChain(selected, inputs, 'data-concept', 1);
		// }
		if(checkedInst) if(checkedInst.value != '') {
			if(!firstFilter) firstFilter = 'inst';
			var inputs = document.querySelectorAll('#city input[type=radio]');
			filterChain(selected, inputs, 'data-city', 1);
			inputs = document.querySelectorAll('#concept input[type=radio]');
			filterChain(selected, inputs, 'data-concept', 1);
		}
		// if(checkedInst.value != '' && checkedCity.value != '' && checkedConcept.value == '') {
		// 	// var inputs = document.querySelectorAll('#city input[type=radio]');
		// 	// filterChain(selected, inputs, 'data-city', checkedInst.value);
		// 	var inputs = document.querySelectorAll('#concept input[type=radio]');
		// 	filterChain(selected, inputs, 'data-concept', 1);
		// }
		// if(checkedInst.value == '' && checkedCity.value != '' && checkedConcept.value == '') {
		// 	if(!firstFilter) firstFilter = 'city';
		// 	var inputs = document.querySelectorAll('#inst input[type=radio]');
		// 	filterChain(selected, inputs, 'data-inst', 1);
		// 	inputs = document.querySelectorAll('#concept input[type=radio]');
		// 	filterChain(selected, inputs, 'data-concept', 1);
		// }
		if(checkedCity) if(checkedCity.value != '') {
			if(!firstFilter) firstFilter = 'city';
			var inputs = document.querySelectorAll('#inst input[type=radio]');
			filterChain(selected, inputs, 'data-inst', 1);
			inputs = document.querySelectorAll('#concept input[type=radio]');
			filterChain(selected, inputs, 'data-concept', 1);
		}
		// if(checkedInst.value == '' && checkedCity.value != '' && checkedConcept.value != '') {
		// 	var inputs = document.querySelectorAll('#inst input[type=radio]');
		// 	filterChain(selected, inputs, 'data-inst', 1);
		// 	// var inputs = document.querySelectorAll('#concept input[type=radio]');
		// 	// filterChain(selected, inputs, 'data-concept', checkedInst.value);
		// }
		// if(checkedInst.value == '' && checkedCity.value == '' && checkedConcept.value != '') {
		// 	if(!firstFilter) firstFilter = 'concept';
		// 	var inputs = document.querySelectorAll('#inst input[type=radio]');
		// 	filterChain(selected, inputs, 'data-inst', 1);
		// 	inputs = document.querySelectorAll('#city input[type=radio]');
		// 	filterChain(selected, inputs, 'data-city', 1);
		// }
		if(checkedConcept.value != '') {
			if(!firstFilter) firstFilter = 'concept';
			var inputs = document.querySelectorAll('#inst input[type=radio]');
			filterChain(selected, inputs, 'data-inst', 1);
			inputs = document.querySelectorAll('#city input[type=radio]');
			filterChain(selected, inputs, 'data-city', 1);
		}
		// if(checkedInst.value != '' && checkedCity.value == '' && checkedConcept.value != '') {
		// 	var inputs = document.querySelectorAll('#city input[type=radio]');
		// 	filterChain(selected, inputs, 'data-city', 1);
		// 	// var inputs = document.querySelectorAll('#concept input[type=radio]');
		// 	// filterChain(selected, inputs, 'data-concept', checkedInst.value);
		// }
		if(checkedInst && checkedCity && checkedConcept) if(checkedInst.value == '' && checkedCity.value == '' && checkedConcept.value == '') {
			if(firstFilter) firstFilter = false;
			var inputs = document.querySelectorAll('.wiki input[type=radio]');
			for(var i=0; i<inputs.length; i++) inputs[i].parentNode.classList.remove('hide-item');
		}

		if(!checkedInst && checkedCity && checkedConcept) if(checkedCity.value == '' && checkedConcept.value == '') {
			if(firstFilter) firstFilter = false;
			var inputs = document.querySelectorAll('.wiki input[type=radio]');
			for(var i=0; i<inputs.length; i++) inputs[i].parentNode.classList.remove('hide-item');
		}

		// if(selector != '') {
		// 	if(inactiveFilters.length < 3 && inactiveFilters.length > 0) {

		// 		if(activeFilters.length > 0) {

		// 			for(var i=0; i<activeFilters.length; i++) for(var j=0; j<inactiveFilters.length; j++) {

		// 				var inputs = document.querySelectorAll('#'+inactiveFilters[j]+' input[type=radio]');
		// 				filterChain(selected, inputs, 'data-'+inactiveFilters[j], document.querySelector('#'+activeFilters[i]+' input[type=radio]:checked').value);
		// 			}
		// 		}
		// 		// } else {
		// 		// 	var inputs = document.querySelectorAll('.wiki input[type=radio]');
		// 		// 	for(var i=0; i<inputs.length; i++) inputs[i].parentNode.classList.remove('hide-item');
		// 		// }
		// 	}
		// } else {
		// 	var inputs = document.querySelectorAll('.wiki input[type=radio]');
		// 	for(var i=0; i<inputs.length; i++) inputs[i].parentNode.classList.remove('hide-item');
		// }
	}
}

/* Calendar */
if(document.querySelector('.calendar-filters')) {

	jQuery("#startdate").datepicker({
		altField: "#altstartdate",
		altFormat: "yymmdd",
		dateFormat: "dd.mm.yy",
		onSelect: function() {
			checkAll();
		}
	});

	jQuery("#enddate").datepicker({
		altField: "#altenddate",
		altFormat: "yymmdd",
		dateFormat: "dd.mm.yy",
		onSelect: function() {
			checkAll();
		}
	});

	var startdate = document.querySelector('#startdate');
	var altstartdate = document.querySelector('#altstartdate');
	var enddate = document.querySelector('#enddate');
	var altenddate = document.querySelector('#altenddate');

	document.querySelector('.clear-range').addEventListener('click', function(e){
		e.preventDefault();
		startdate.value = '';
		altstartdate.value = '';
		enddate.value = '';
		altenddate.value = '';
		document.querySelector('.range-inputs').classList.add('hide-item');
		document.querySelector('.range-label').classList.remove('dn');
		document.querySelector('.soon-label').innerHTML = '+';
		checkAll();
	});

	var allItems = document.querySelectorAll('.item.calendar');
	var allRadio = document.querySelectorAll('.calendar-filters input[type=radio]');

	if(allRadio) for(var i=0; i<allRadio.length; i++) allRadio[i].addEventListener('click', function(e){

		var parent = this.parentNode.parentNode.parentNode;
		var id = parent.getAttribute('id');

		var link = document.querySelector('.'+id+'-current');
		link.innerHTML = this.nextSibling.innerHTML;

		parent.classList.toggle('active');
		link.classList.toggle('active');

		var selected = checkAll();
	});

	function strToMoment(str) {
		if(!str) return false;
		return moment(parseInt(str), "YYYYMMDD");
	}

	function checkAll(obj) {

		var selector = '';
		var selectedCity = document.querySelector('#event-city input[type=radio]:checked');
		var selectedType = document.querySelector('#event-type input[type=radio]:checked');
		var selectedWords = document.querySelector('#event-words input[type=radio]:checked');

		var filterrange = null;
		var selectedItems = [];

		if(obj) {
			var parent = obj.parentNode.parentNode.parentNode;
			var id = parent.getAttribute('id');

			var link = document.querySelector('.'+id+'-current');
			link.innerHTML = obj.nextSibling.innerHTML;
		}

		if(altstartdate.value && altenddate.value) {
			var filterstart = strToMoment(altstartdate.value); //parseInt(altstartdate.value);
			var filterend = strToMoment(altenddate.value); //parseInt(altstartdate.value);

			filterrange = moment.range(filterstart, filterend);
		}

		if(altstartdate.value || altenddate.value) {
			document.querySelector('.words-filter').classList.add('invis');
		} else {
			document.querySelector('.words-filter').classList.remove('invis');
		}

		for(var i=0; i<allItems.length; i++) allItems[i].classList.remove('hide-item');

		for(var i=0; i<allItems.length; i++) {

			var range = null;

			var showrange = true;
			var showcity = true;
			var showtype = true;
			var showword = true;

			if(allItems[i].getAttribute('data-start') && allItems[i].getAttribute('data-end')) {

				var start = strToMoment(allItems[i].getAttribute('data-start'));
				var end = strToMoment(allItems[i].getAttribute('data-end'));

				range = moment.range(start, end);
			}

			if(selectedWords != null) {

				if(selectedWords.value != 'none') document.querySelector('.range-filter').classList.add('invis');
				else document.querySelector('.range-filter').classList.remove('invis');

				if(selectedWords.value == 'today') {
					var data = selectedWords.getAttribute('data-alt-date');
					if(data >= allItems[i].getAttribute('data-start') && data <= allItems[i].getAttribute('data-end')) {} else showword = false; //allItems[i].classList.add('hide-item');
				}

				if(selectedWords.value == 'tomorrow') {
					var data = selectedWords.getAttribute('data-alt-date');
					if(data >= allItems[i].getAttribute('data-start') && data <= allItems[i].getAttribute('data-end')) {} else showword = false; //allItems[i].classList.add('hide-item');
				}

				if(selectedWords.value == 'closing') {
					var data = parseInt(selectedWords.getAttribute('data-alt-date'));
					var dataEnd = parseInt(allItems[i].getAttribute('data-end'));
					var end = strToMoment(dataEnd).subtract(7, 'days').format('YYYYMMDD');
					if(data >= end && data <= dataEnd) {} else showword = false;
					// if(allItems[i].getAttribute('data-end') != data) showword = false; //allItems[i].classList.add('hide-item');
				}

				if(selectedWords.value == 'done') {
					var data = moment().format('YYYYMMDD'); //now
					if(data > allItems[i].getAttribute('data-end')) {} else showword = false; //allItems[i].classList.add('hide-item');
					// IF CURRENT > DATA-END
				}
			} else document.querySelector('.range-filter').classList.remove('invis');

			if(range != null && filterrange != null) {

				if(!range.overlaps(filterrange)) showrange = false;
			}

			if(selectedCity != null) {

				if(selectedCity.value == allItems[i].getAttribute('data-city')) showcity = true;
				else if(selectedCity.value == '') showcity = true;
				else showcity = false;
			}

			if(selectedType != null) {

				if(selectedType.value == allItems[i].getAttribute('data-type')) showtype = true;
				else if(selectedType.value == '') showtype = true;
				else showtype = false;
			}

			if(!showrange || !showcity || !showtype || !showword) allItems[i].classList.add('hide-item');
			else selectedItems.push(allItems[i]);
		}

		if(selectedItems && selectedCity && selectedType.value == '') {
			var inputs = document.querySelectorAll('#event-type input[type=radio]');
			filterChain(selectedItems, inputs, 'data-type', selectedCity.value);
		}
		if(selectedItems && selectedType && selectedCity.value == '') {
			var inputs = document.querySelectorAll('#event-city input[type=radio]');
			filterChain(selectedItems, inputs, 'data-city', selectedType.value);
		}

		return selectedItems;
	}

	checkAll(document.querySelector('#today'));
}

jQuery.extend(jQuery.easing, {
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	}
});

(function($) {

	$(document).ready(function() {

		if($('a.cut').length > 0) {

			$('a.cut').on('click', function(e){
				e.preventDefault();
				$(this).prev().slideToggle();
			});
		}

		if($('.post-contents').length > 0) {}

		$('.post-contents a').on('click', function() {

		    var target = $($(this).attr('href'));

		    if (target.length) {
		        $('html,body').animate({
		            scrollTop: target.offset().top
		        }, 1000);
		        return false;
		    }
		});

		$('.the-content p a').attr('target', '_blank');

		var insertPalce = $('#contents-list');
		if(insertPalce.length > 0) insertPalce = '#contents-list';
		else insertPalce = '.post-section';

		/* List of contents */
		if($('.post-section').length > 0) {
		// set up and create progress bar in DOM
			$(insertPalce).eq(0).before('<div class="contents"><div class="wrap"><div class="progressbar static"></div></div></div>'); //<span>Оглавление: </span>
			var container = $('.progressbar');
			// container.append('<div class="shim"></div>');
			// var shim = $('.progressbar .shim');
			container.append('<div class="holder clearfix"></div>');
			var holder = $('.progressbar .holder');
			holder.append('<div class="bar"></div>');
			var bar = $('.progressbar .bar');
			bar.append('<div class="indicator"></div>');
			var indicator = $('.progressbar .indicator');
			holder.append('<div class="labels"></div>');
			var labels = $('.progressbar .labels');
			var counter = 1;
			$('.post-section').each(function(){
				var code = '<a href="#'+$(this).attr('id')+'"><i data-label="'+counter+'."><span class="counter">'+counter+'.</span> <span class="text">'+$(this).text()+'</span></i></a>';
				counter++;
				labels.append(code);
			});
			var points = labels.find('i');
			points.css('width', 100/$('.post-section').length+'%');

			var waypoint = new Waypoint({
				element: document.querySelector('.contents'),
				handler: function(direction) {
					var el = document.querySelector('.contents');
					var pr = document.querySelector('.progressbar');

					if(direction == 'down') el.classList.add('fixed');
					else el.classList.remove('fixed');

					if(direction == 'down') {
						pr.classList.remove('static');
						pr.classList.add('isfixed');
					} else {
						pr.classList.remove('isfixed');
						pr.classList.add('static');
					}
				}
			});

			// match height of shim
			// stop layout jumping when progress bar fixes to / unfixes
			// from top of viewport
			// function setShimHeight(){
			// 	shim.css('height', container.height()+'px');
			// }
			// setShimHeight();
			// $(window).resize(function(){ setShimHeight(); });

			// position indicator bar so it starts at first dot
			function setIndicatorX(){
				var point = points.eq(0);
				var xpos = point.offset().left + (point.width() / 2);
				// indicator.css('left', xpos+'px');
				// indicator.css('left', labels.find('i').width()/2+'px');
			}
			setIndicatorX();
			$(window).resize(function(){ setIndicatorX(); });

			// fix/unfix progress bar to top of viewport
			// function fixPosition(){
			// 	if(container.is(':visible')) {
			// 		if(!container.hasClass('isfixed')) {
			// 			if(holder.offset().top <= $(window).scrollTop()) {
			// 				container.addClass('isfixed');
			// 				container.removeClass('static');
			// 			}
			// 		}
			// 		else {
			// 			if(shim.offset().top > $(window).scrollTop()) {
			// 				container.removeClass('isfixed');
			// 				container.addClass('static');
			// 			}
			// 		}
			// 		var barleft = $((labels.find('i'))[0]).width();
			// 		indicator.css('left', barleft/2+'px');
			// 	}
			// }
			// fixPosition();
			// $(window).scroll(function(){ fixPosition() });
			// $(window).resize(function(){ fixPosition(); });

			// set trigger point
			// i.e. how far down viewport is the "eye line"
			var triggerPoint = 0;
			function setTriggerPoint(){
				triggerPoint = $(window).height() * .18;
			}
			setTriggerPoint();
			$(window).resize(function(){ setTriggerPoint(); });

			// update progress bar
			function setPosition(){
				if(container.is(':visible')) {
					var section = false;
					var sectionIndex = 0;
					var currentPosition = $(window).scrollTop() + triggerPoint;
					// dots
					// if before first section
					if(currentPosition < $('.post-section').eq(0).offset().top) {
						points.removeClass('reading read');
						section = -1;
					}
					// if after first section
					else {
						$('.post-section').each(function(){
							var sectionTop = $(this).offset().top;
							if(currentPosition >= sectionTop) {
								points.removeClass('reading');
								points.eq(sectionIndex).addClass('reading');
								points.eq(sectionIndex).addClass('read');
								section = sectionIndex;
							}
							else {
								points.eq(sectionIndex).removeClass('read');
							}
							sectionIndex++;
						});
					}
					// bar
					var barWidth = 0;
					// if before start
					if(section == -1) {
						var point = points.eq(0);
						barWidth = point.offset().left + (point.width() / 2);
					}
					// if after end
					else if(section >= (points.length - 1)) {
						var point = points.eq((points.length - 1));
						barWidth = point.offset().left + (point.width() / 2);
					}
					// if within document
					else {
						var startPoint = points.eq(section);
						var startPointX = startPoint.offset().left;
						var startPointWidth = startPoint.width();
						var startSection = $('.post-section').eq(section);
						var endSection = $('.post-section').eq(section+1);
						var startSectionY = startSection.offset().top;
						var endSectionY = endSection.offset().top;
						var sectionLength = endSectionY - startSectionY;
						var scrollY = currentPosition - startSectionY;
						var sectionProgress = scrollY / sectionLength;
						barWidth = startPointX + (startPointWidth / 2) + (startPointWidth * sectionProgress);
					}
					barWidth -= indicator.offset().left;
					indicator.css('width', barWidth+'px');
				}
			}
			setPosition();
			$(window).scroll(function(){ setPosition(); });
			$(window).resize(function(){ setPosition(); });

			// on click, scroll to target section
			points.click(function(){
				var sectionIndex = points.index($(this));
				var targetY = $('.post-section').eq(sectionIndex).offset().top - (triggerPoint * .92);
				$('html, body').animate({scrollTop:targetY}, 600, 'easeInOutCubic');
			});
		}

	});
})(jQuery);

/* Main city */
if(document.querySelector('#global-city')) {
	document.querySelector('#global-city').addEventListener('change', function(){
		// document.querySelector('.loadmore').setAttribute('data-term', this.options[this.selectedIndex].value);
		if(this.options[this.selectedIndex].value != "") window.location.href = "http://aroundart.org/?city="+this.options[this.selectedIndex].value;
		else window.location.href = "http://aroundart.org/"
	});
}

/* Single */

// baguetteBox.run('.this-is-baguette', { captions: function(a) {
// 	var next = a.nextSibling;
// 	if(next && next.classList.contains('wp-caption-text')) return next.innerHTML;
// }, overlayBackgroundColor: '#ffffff' });

// baguetteBox.run('.gallery', { captions: function(a) {
// 	var next = a.parentNode.nextElementSibling;
// 	if(next && next.classList.contains('wp-caption-text')) return next.innerHTML;
// }, overlayBackgroundColor: '#ffffff' });

baguetteBox.run('.the-content', { captions: function(a) {
	var next = a.parentNode.nextElementSibling;
	if(next && next.classList.contains('wp-caption-text')) return next.innerHTML;
}, overlayBackgroundColor: '#ffffff' })

/* Waypoints */

var mql = window.matchMedia("screen and (max-width: 736px)");
if (mql.matches) {
	var waypoint = new Waypoint({
		element: document.querySelector('.bottom-deck'),
		handler: function(direction) {
			var el = document.querySelector('a.logo');

			if(direction == 'down') el.classList.add('fixed');
			else el.classList.remove('fixed');
		}
	});
} else {
	var waypoint = new Waypoint({
		element: document.querySelector('.bottom-deck'),
		handler: function(direction) {
			var el = document.querySelector('.bottom-deck');
			var s = document.querySelector('.search-block');

			if(direction == 'down') el.classList.add('fixed');
			else el.classList.remove('fixed');

			if(direction == 'down') s.classList.add('fixed');
			else s.classList.remove('fixed');
		}
	});
}
