// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2011 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// Html tags
// http://en.wikipedia.org/wiki/html
// ----------------------------------------------------------------------------
// Basic set. Feel free to add more tags
// ----------------------------------------------------------------------------
var mySettings = {
	onShiftEnter:  	{keepDefault:false, replaceWith:'<br />\n'},
	onCtrlEnter:  	{keepDefault:false, openWith:'\n<p>', closeWith:'</p>'},
	onTab:    		{keepDefault:false, replaceWith:'    '},
	markupSet:  [
		{name:'Bold', key:'B', openWith:'[b]', closeWith:'[/b]' },
		{name:'Italic', key:'I', openWith:'[i]', closeWith:'[/i]'  },
		{name:'Stroke through', key:'S', openWith:'[s]', closeWith:'[/s]' },
		{separator:'---------------' },
		{name:'Bulleted List', openWith:'    [li]', closeWith:'[/li]', multiline:true, openBlockWith:'[ul]\n', closeBlockWith:'\n[/ul]'},
		{name:'Numeric List', openWith:'    [li]', closeWith:'[/li]', multiline:true, openBlockWith:'[ol]\n', closeBlockWith:'\n[/ol]'},

	]
}
