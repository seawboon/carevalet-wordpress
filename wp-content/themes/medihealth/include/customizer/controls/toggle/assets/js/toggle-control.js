wp.customize.controlConstructor['medihealth-toggle'] = wp.customize.Control.extend({

	ready: function() {
		'use strict';

		var control = this,
			button = control.container.find( '.medihealth-btn-toggle' ),
			checkbox = control.container.find( '.medihealth-toggle-checkbox' );

		button[0].onclick = function() {
			checkbox[0].checked = !checkbox[0].checked;
			control.setting.set( checkbox[0].checked );
		};
	}

});