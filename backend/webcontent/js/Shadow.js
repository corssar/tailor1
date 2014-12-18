function shadowClass(i)
{
	this.instance		= i;
	this.opacity		= 70; // percent value
	this.speed			= 1;
	this.divIndex 		= 10;
	this.divClassName	= 'shadow_class';
	this.divId			= 'shadow_id';
	this.visible		= 0;
	
	this.currentOpacity = 0;
	
	this.getPageSize = function()
	{
		var xP, yP;
			
			if (window.innerHeight && window.scrollMaxY) {
				xP = window.innerWidth + window.scrollMaxX;
				yP = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight) {
				xP = document.body.scrollWidth;
				yP = document.body.scrollHeight;
			} else { 
				xP = document.body.offsetWidth;
				yP = document.body.offsetHeight;
			}
		
			var wW, wH;
	
			if (self.innerHeight) {
				if (document.documentElement.clientWidth) wW = document.documentElement.clientWidth; 
				else wW = window.innerWidth;
				if (document.documentElement.clientHeight == (window.innerHeight - 16)) wH = document.documentElement.clientHeight;
				else wH = window.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) {
				wW = document.documentElement.clientWidth;
				wH = document.documentElement.clientHeight;
			} else if (document.body) {
				wW = document.body.clientWidth;
				wH = document.body.clientHeight;
			}	
			
			pW = wW;
		
			if (wH < yP) pH = yP;
			else pH = wH;
	
			var rA = Array(pW, pH, wW, wH);
			return rA;
	}
	
	this.getPageScroll = function()
	{
			var xScroll = 0, yScroll = 0;
	    
			if (typeof(window.pageYOffset) == 'number') {
				xScroll = window.pageYOffset;
				yScroll = window.pageXOffset;
			} else if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
				xScroll = document.body.scrollTop;
				yScroll = document.body.scrollLeft;
			} else if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
				xScroll = document.documentElement.scrollTop;
				yScroll = document.documentElement.scrollLeft;
			}	
			var returnArray = Array(yScroll, xScroll);			
			return returnArray;
	}
	
	this.forbiddenObjects = function(v)
	{
		var s = document.getElementsByTagName('select');
		for (i = 0; i != s.length; i++) {
			s[i].style.visibility = v;
		}
		var o = document.getElementsByTagName('object');
		for (i = 0; i < o.length; i++) {
			o[i].style.visibility = v;
		}
		var e = document.getElementsByTagName('embed');
		for (i = 0; i < e.length; i++) {
			e[i].style.visibility = v;
		}
	}
	
	this.stretchPageDiv = function()
	{
		var d = document.getElementById(this.divId);
		var size	= this.getPageSize();
		var scroll	= this.getPageScroll();
		d.style.width = (size[0] + scroll[0])+ 'px';
		d.style.height = size[1] + 'px';		
		//window.setTimeout(function () { stretchPageDiv() }, 1000);
	}
	
	this.setAlpha = function(a)
	{	 
		var o = document.getElementById(this.divId);
		o.style.filter = 'alpha(opacity: ' + a + ')';
		o.style.MozOpacity = a / 100;
		o.style.KhtmlOpacity = a / 100;
		o.style.opacity = a / 100;	
	}
	
	this.moveToAlpha = function(a, s)
	{
		if (a > this.currentOpacity)
		{
			this.currentOpacity += 20;
			this.setAlpha(this.currentOpacity);
			if (this.currentOpacity != a) setTimeout(this.instance + ".moveToAlpha(" + a + ", " + s + ")",s);
		}
		else if (a < this.currentOpacity)
		{
			this.currentOpacity -= 20;
			this.setAlpha(this.currentOpacity);
			if (this.currentOpacity != a) setTimeout(this.instance + ".moveToAlpha(" + a + ", " + s + ")",s);
		}
	}
	
	this.createPageDiv = function()
	{
		var bgDiv = document.createElement('div');		
			bgDiv.style.position = 'absolute';
			bgDiv.className = this.divClassName;
			bgDiv.setAttribute('id', this.divId);		
			bgDiv.style.zIndex = this.divIndex;
			bgDiv.style.left   = '0px';	
			bgDiv.style.top = '0px';	
			bgDiv.style.width = '0px';	
			bgDiv.style.height = '0px';		
			document.body.appendChild(bgDiv);		
			this.stretchPageDiv();
			this.forbiddenObjects('hidden');			
			this.moveToAlpha(80, this.speed);
			//PhotoSlice.GoToAlpha('PSbackground', backgroundAlpha, 25, 'PhotoSlice.Setup();');
		this.visible = 1;
	}
	
	this.removePageDiv = function()
	{
		this.currentOpacity = 0;
		var d = document.getElementById(this.divId);
		this.visible = 0;
		document.body.removeChild(d);
		this.forbiddenObjects('visible');		
	}
}

var shadow = new shadowClass('shadow');