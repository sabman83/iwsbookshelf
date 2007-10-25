/*
Script: PBBDatePicker.js
	Contains <PBBDatePicker>

Author:
	Pokemon_JOJO, <http://www.mibhouse.org/pokemon_jojo>

License:
	MIT-style license.

*/

/*
Class: PBBDatePicker
	A powerfull DatePicker with many, many options and fonctionnality :D

Arguments:
	options - see Options below

Options:
	showDelay - the delay the onShow method is called. (defaults to 100 ms)
	hideDelay - the delay the onHide method is called. (defaults to 100 ms)
	offsets - the distance of your datepicker from the input. an Object with x/y properties.
	readOnly - is the input have readonly status ? (defaults to true)
	className - name for your DatePicker classNames. defaults to 'PBBDatePicker'.
	weekFirstDay - integer, first day of the week. 0 (for Sunday) through 6 (for Saturday)  
	dateFormat - the return format of selected date like php function date. (defaults to d/m/Y)
		d -> Day of the month, 2 digits with leading zeros
		D -> A textual representation of a day, three letters
		j -> Day of the month without leading zero
		l -> (lowercase 'L') A full textual representation of the day of the week
		N -> ISO-8601 numeric representation of the day of the week. 1 (for Monday) through 7 (for Sunday)
		w -> Numeric representation of the day of the week
		m -> Numeric representation of a month, with leading zeros
		M -> A short textual representation of a month, three letters
		F -> A full textual representation of a month, such as January or March
		n -> Numeric representation of a month, without leading zeros
		Y -> A full numeric representation of a year, 4 digits
		y -> A two digit representation of a year
		
		Example :
			2/15/2007 -> dateFormat : 'd/m/Y', -> 15/02/2007
			2/15/2007 -> dateFormat : 'M j Y', -> Feb 15 2007
		
	defaultYear - Year by default in the Year select list
	defaultMonth - Month by default in the Year select list
	defaultDay - Day by default selected
	selectMinDate - minimum date you can select
	selectMaxDate - maximum date you can select
	rangeYear - how many year to show in the Year select list ? an Object with min/max properties.
	iconImg - Image you can add to the input 
	monthNames - Array for month name
	dayNames - Array for day name
	todayName - Text to show in the TodayPicker ;)

Events:
	onShow - optionally you can alter the default onShow behaviour with this option (like displaying a fade in effect);
	onHide - optionally you can alter the default onHide behaviour with this option (like displaying a fade out effect);
*/
var PBBDatePicker = new Class({

	options: {
		onShow: function(picker){
			picker.setStyle('visibility', 'visible');
		},
		onHide: function(picker){
			picker.setStyle('visibility', 'hidden');
		},
		showDelay: 100,
		hideDelay: 100,
		offsets: {'x': 0, 'y': 0},
		readOnly: true,
		className: 'PBBDatePicker',
		weekFirstDay : 0,
		dateFormat : 'd/m/Y',
		defaultYear: new Date().getFullYear(),
		defaultMonth: new Date().getMonth(),
		defaultDay: new Date().getDate(),
		selectMinDate: false,
		selectMaxDate: false,
		rangeYear: {'min': new Date().getFullYear(), 'max': new Date().getFullYear() + 5},
		iconImg : null,
		monthNames : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		dayNames : ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		todayName : 'Today'
	},

	initialize: function(input, options){
		var table, thead, tbody, th, tr, td;

		this.setOptions(options);
		// Form input  
		this.input = input;
		
		if(this.options.selectMinDate && new Date(this.options.defaultYear, this.options.defaultMonth, this.options.defaultDay).getTime() < this.options.selectMinDate.getTime()) {
			this.options.defaultYear = this.options.selectMinDate.getFullYear();
			this.options.defaultMonth = this.options.selectMinDate.getMonth();
			this.options.defaultDay = this.options.selectMinDate.getDate();			
		}
		
		if(this.options.selectMinDate && this.options.selectMaxDate && this.options.selectMinDate.getTime() > this.options.selectMaxDate.getTime())
			this.options.selectMaxDate = false;
		
		// Cache de la date selectionnée
		this.OnSelected = false;
		this.selectYear = this.options.defaultYear;
		this.selectMonth = this.options.defaultMonth;
		this.selectDay = this.options.defaultDay;
		this.selectedDate = new Date();
		
		// Div principale qui contient le datePicker
		this.datePicker = new Element('div', {
			'class': this.options.className,
			'styles': {
				'position': 'absolute',
				'top': '0',
				'left': '0',
				'visibility': 'hidden'
			}
		}).inject(document.body);
		// Wrapper
		this.wrapper = new Element('div').inject(this.datePicker);

		// Liste déroulante des mois
		this.monthPicker = new Element('select', {
			'events': {
				'focus': (function(){
					this.OnSelected = true;
				}).bindWithEvent(this),
				'blur': (function(){
					this.OnSelected = false;
				}).bindWithEvent(this),
				'change': (function(){
					this.input.focus();
					this.selectMonth = this.monthPicker.value;
					this.build();
				}).bindWithEvent(this)
			}
		});

		for(var m = 0; m < this.options.monthNames.length; m++) {
			if (this.options.defaultMonth == m)
				new Element('option', {'selected': 'selected', 'value': m}).setHTML(this.options.monthNames[m]).injectInside(this.monthPicker);
			else
				new Element('option', {'value': m}).setHTML(this.options.monthNames[m]).injectInside(this.monthPicker);
		}
		
		// Liste déroulante des années
		this.yearPicker = new Element('select', {
			'events': {
				'focus': (function(){
					this.OnSelected = true;
				}).bindWithEvent(this),
				'blur': (function(){
					this.OnSelected = false;
				}).bindWithEvent(this),
				'change': (function(){
					this.input.focus();
					this.selectYear = this.yearPicker.value;
					this.build();
				}).bindWithEvent(this)
			}
		});

		for(var y = this.options.rangeYear.min; y < (this.options.rangeYear.max); y++) {
			if (this.options.defaultYear == y)
				new Element('option', {'selected': 'selected', 'value': y}).setHTML(y).injectInside(this.yearPicker);
			else
				new Element('option', {'value': y}).setHTML(y).injectInside(this.yearPicker);
		}

		// On ajoute monthPicker et yearPicker
		this.monthPicker.injectInside(this.wrapper);
		this.wrapper.appendText(' ');
		this.yearPicker.injectInside(this.wrapper);

		// Création du tableau des jours
		table = new Element('table',{'cellspacing': '1px'});
		thead = new Element('thead').injectInside(table);

		// 1ère ligne contenant le nom des jours (1ère lettre)
		tr = new Element('tr').injectInside(thead);
		for (i = 0; i < 7; i++)	{ 
			new Element('th').appendText(this.options.dayNames[(this.options.weekFirstDay + i)%7].substr(0, 1)).injectInside(tr);
		}
		// Tbody contenant les jours
		tbody = new Element('tbody').injectInside(table);
		for(r=0;r<6;r++){
			tr = new Element('tr').injectInside(tbody);
			for(c=0;c<7;c++){
				td = new Element('td').setHTML('&nbsp;').injectInside(tr);
			}
		}		
		table.injectInside(this.wrapper);

		this.todayPicker = new Element('div', {
			'class': 'todayPicker',
			'styles': {
				'cursor':'pointer'
			},
			'events': {
				'click': (function(){
					this.selectYear = new Date().getFullYear();
					this.selectMonth = new Date().getMonth();
					this.selectDay = new Date().getDate();
					this.input.value = this.selectDate(this.options.dateFormat);
					this.build();
					this.end();
					return;
				}).bindWithEvent(this),
				'mouseover': (function(){
					this.todayPicker.addClass('todayPickerOver');
				}).bindWithEvent(this),
				'mouseout': (function(){
					this.todayPicker.removeClass('todayPickerOver');
				}).bindWithEvent(this)
			}
		}).setHTML(this.options.todayName).injectInside(this.wrapper);
		
		// Prépare l'input
		if(this.options.readOnly)
			this.input.setProperty('readOnly', 'true');

		this.input.setStyles({
			'background-image':'url(\'' + this.options.iconImg + '\')', 
			'background-repeat':'no-repeat', 
			'background-position':'center right',
			'cursor':'pointer'
		})		
		
		.addEvent('click', function(){
			if(this.activeDatePicker) {
				this.end(); return;
			}
			else if(this.input.focus)
				this.start();
		}.bindWithEvent(this))

		.addEvent('focus', function(){
			this.start();
		}.bindWithEvent(this))
		
		.addEvent('blur', function(){
			(function(){
				if(!this.OnSelected)
					this.end(); return;
			}.bind(this)).delay(150);
		}.bindWithEvent(this))

		.addEvent(window.ie ? 'keydown' : 'keypress', this.onKeyup.bindWithEvent(this));

		// Remplace les cases vide par le chiffre des jours
		this.build();
	},

	start: function(){
		if(this.activeDatePicker)
			return;

		this.position();
		this.timer = this.show.delay(this.options.showDelay, this);
	},
	
	// Remplacement des jours
	build: function(){
		this.selectFirstDay = new Date(this.selectYear, this.selectMonth, this.selectDay);
		
		this.selectFirstDay.setDate(1);
			
		if(this.selectFirstDay.getDay() == this.options.weekFirstDay)
			this.selectFirstDay.setDate(1 - 7 - (7 + this.selectFirstDay.getDay() - this.options.weekFirstDay)%7);	
		else			
			this.selectFirstDay.setDate(1 - (7 + this.selectFirstDay.getDay() - this.options.weekFirstDay)%7);

		var currentDay = new Date(this.selectFirstDay);
		
		$ES("tbody td", this.datePicker).each(function(el){
			
			el.removeClass('datePickerSelectedDay');
			el.removeClass('datePickerMinDate');
			el.removeClass('datePickerMaxDate');
			el.removeEvents();
			
			if (currentDay.getMonth() == new Date(this.selectYear, this.selectMonth).getMonth()) {
				
				if(this.options.selectMinDate && currentDay.getTime() < this.options.selectMinDate.getTime()) {
					el.addClass('datePickerMinDate');
				}
				else if(this.options.selectMaxDate && currentDay.getTime() > this.options.selectMaxDate.getTime()) {
					el.addClass('datePickerMinDate');
				}
				else {
					// Evenement survole
					el.addEvent('mouseover', function(){
						el.addClass('datePickerOver');
					}.bind(this));
		
					el.addEvent('mouseout', function() {
						el.removeClass('datePickerOver');
					}.bind(this));
					
					el.addEvent('click', function(){
						this.selectDay = el.innerHTML;
						this.input.value = this.selectDate(this.options.dateFormat);
						this.build();
						this.end();
						return;
					}.bind(this));
					
					// Ajoute un style a la case du jour sélectionné	
					if(this.selectedDate.getDate() == currentDay.getDate() && this.selectedDate.getMonth() == currentDay.getMonth() && this.selectedDate.getFullYear() == currentDay.getFullYear())
						el.addClass('datePickerSelectedDay');
				}
				el.setHTML(currentDay.getDate());
			}
			else {
				el.setHTML('&nbsp;');
			}
			
			currentDay.setDate(currentDay.getDate() + 1);
		}.bind(this));
	},
	
	onKeyup: function(e){

		if (e.key && !e.shift) switch (e.key) {
			case 'enter':
				e.stop();
				this.input.value = this.selectDate(this.options.dateFormat);
				this.build();
				this.end();
				return;
			case 'right': case 'left': case 'up': case 'down':
				e.stop();
				
				if(e.key == 'right') {
					if(this.options.selectMaxDate && new Date(this.selectYear, this.selectMonth, (this.selectDay + 1)).getTime() > this.options.selectMaxDate.getTime() || this.options.selectMinDate && new Date(this.selectYear, this.selectMonth, (this.selectDay + 1)).getTime() < this.options.selectMinDate.getTime())
						return;
					this.selectDay++;
				}
				else if(e.key == 'left') {
					if(this.options.selectMinDate && new Date(this.selectYear, this.selectMonth, (this.selectDay - 1)).getTime() < this.options.selectMinDate.getTime() || this.options.selectMaxDate && new Date(this.selectYear, this.selectMonth, (this.selectDay - 1)).getTime() > this.options.selectMaxDate.getTime())
						return;
					this.selectDay--;
				}
				else if(e.key == 'up') {
					if(this.options.selectMinDate && new Date(this.selectYear, this.selectMonth, (this.selectDay - 7)).getTime() < this.options.selectMinDate.getTime() || this.options.selectMaxDate && new Date(this.selectYear, this.selectMonth, (this.selectDay - 7)).getTime() > this.options.selectMaxDate.getTime())
						return;
					this.selectDay = this.selectDay - 7;
				}
				else if(e.key == 'down') {
					if(this.options.selectMaxDate && new Date(this.selectYear, this.selectMonth, (this.selectDay + 7)).getTime() > this.options.selectMaxDate.getTime() || this.options.selectMinDate && new Date(this.selectYear, this.selectMonth, (this.selectDay + 7)).getTime() < this.options.selectMinDate.getTime())
						return;
					this.selectDay = this.selectDay + 7;
				}
			
				this.selectedDate = new Date(this.selectYear, this.selectMonth, this.selectDay);
				this.selectYear =  this.selectedDate.getFullYear();
				this.selectMonth =  this.selectedDate.getMonth();
				this.selectDay  = this.selectedDate.getDate();
				
				this.input.value = this.selectDate(this.options.dateFormat);
				this.build();
				return;
			case 'esc':
				this.end(); return;
		}

	},
	
	selectDate: function(returnFormatDate){
		this.selectedDate = new Date(this.selectYear, this.selectMonth, this.selectDay);
		this.monthPicker.value = this.selectMonth;
		this.yearPicker.value = this.selectYear;
		
		if(!returnFormatDate)
			returnDate = this.options.dateFormat;
		else
			returnDate = returnFormatDate;
		
		returnDate = returnDate.replace(/D/g, '[D]').replace(/l/g, '[l]').replace(/F/g, '[F]').replace(/M/g, '[M]');
		
		// [d] Day of the month, 2 digits with leading zeros
		if(this.selectedDate.getDate() < 10)
			returnDate = returnDate.replace(/d/g, '0' + this.selectedDate.getDate());
		else
			returnDate = returnDate.replace(/d/g, this.selectedDate.getDate());
		
		// [j] Day of the month without leading zero
		returnDate = returnDate.replace(/j/g, this.selectedDate.getDate());
		
		// [N] ISO-8601 numeric representation of the day of the week. 1 (for Monday) through 7 (for Sunday)
		if(this.selectedDate.getDay() == 0)
			returnDate = returnDate.replace(/N/g, 7);
		else
			returnDate = returnDate.replace(/N/g, this.selectedDate.getDay());
		
		// [w] Numeric representation of the day of the week
		returnDate = returnDate.replace(/w/g, this.selectedDate.getDay());
			
		// [m] Numeric representation of a month, with leading zeros
		if((this.selectedDate.getMonth() + 1) < 10)
			returnDate = returnDate.replace(/m/g, '0' + (this.selectedDate.getMonth() + 1));
		else
			returnDate = returnDate.replace(/m/g, (this.selectedDate.getMonth() + 1));
			
		// [n] Numeric representation of a month, without leading zeros
		returnDate = returnDate.replace(/n/g, (this.selectedDate.getMonth() + 1));
		
		// [Y] A full numeric representation of a year, 4 digits
		returnDate = returnDate.replace(/Y/g, this.selectedDate.getFullYear());
		
		// [y] A two digit representation of a year
		returnDate = returnDate.replace(/y/g, (this.selectedDate.getFullYear() + '').substr(2, 2) );
		
		// Textual replacement need to be at last ;)
		
		// [D] A textual representation of a day, three letters
		returnDate = returnDate.replace(/\[D\]/g, this.options.dayNames[this.selectedDate.getDay()].substr(0, 3));

		// [l] (lowercase 'L') A full textual representation of the day of the week
		returnDate = returnDate.replace(/\[l\]/g, this.options.dayNames[this.selectedDate.getDay()]);

		// [F] A full textual representation of a month, such as January or March
		returnDate = returnDate.replace(/\[F\]/g, this.options.monthNames[this.selectedDate.getMonth()]);

		// [M] A short textual representation of a month, three letters
		returnDate = returnDate.replace(/\[M\]/g, this.options.monthNames[this.selectedDate.getMonth()].substr(0, 3));
		
		return returnDate;
	},

	end: function(event){
		$clear(this.timer);
		this.timer = this.hide.delay(this.options.hideDelay, this);
	},

	position: function(){
		var pos = this.input.getPosition();
		this.datePicker.setStyles({
			'left': pos.x,
			'top': pos.y			
		});
	},
	
	show: function(){
		this.activeDatePicker = true;
		if (this.options.timeout) this.timer = this.hide.delay(this.options.timeout, this);
		this.fireEvent('onShow', [this.datePicker]);
	},

	hide: function(){
		this.activeDatePicker = false;
		this.fireEvent('onHide', [this.datePicker]);
	}
});

PBBDatePicker.implement(new Events, new Options);