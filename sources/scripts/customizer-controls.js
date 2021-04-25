import 'jquery';
import toggleControls from './customizer-controls/toggle-controls';
import controlNumber from './customizer-controls/control-number';
import './customizer-controls/vendors/alpha-color-picker';

$( document ).on( 'ready', function() {
    toggleControls();
	controlNumber();
});
