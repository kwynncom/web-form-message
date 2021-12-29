class sendcl {
    
    static responseTextParse(t) {
	let o = false;
	try { o = JSON.parse(t); } catch(ex) {  }
	if (!o) o = { 'kwdbss' : 'ERROR', 'msg' : t };
	return o;
    }
    
    static sendEle(url, ein, cb, pageid) {
        const sob = {};
        sob.eid		= ein.id;
        if (Object.keys(ein.dataset).length) 
        sob.dataset = ein.dataset;
        sob.v       = ein.value;
        sob.pageid = pageid;
        sendcl.sobf(url, sob, cb);
    }
    
    static sobf(url, sob, cb, prt) {
        if (1) url += '?XDEBUG_SESSION_START=netbeans-xdebug';
        const XHR = new XMLHttpRequest(); 
        XHR.open('POST', url);
        XHR.onloadend = function() { 
            const rt = this.responseText;
            if (prt === false) return cb(rt);
            if (typeof cb === 'function') cb(sendcl.responseTextParse(rt)); 
        }

        const formData = new FormData();
        if (sob) formData.append('POSTob', JSON.stringify(sob));
        XHR.send(formData);        
        
    }
}
