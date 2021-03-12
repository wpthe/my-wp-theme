import 'jquery';
import 'bootstrap/js/dist/util';
import initPage, { onFlippedPage } from './main/page';
import initAnchor from './main/anchor';
import initCards from './main/cards';
import initImg from './main/img';
import initMovebar from './main/movebar';
import initNotify from './main/notify';
import initSearch from './main/search';

$( document ).on( 'ready', function() {
	initPage();
	onFlippedPage();
	initAnchor();
	initCards();
	initImg();
	initMovebar();
	initNotify();
	initSearch();
});
