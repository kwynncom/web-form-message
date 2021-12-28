class sendcl {
    
    static responseTextParse(t) {
	let o = false;
	try { o = JSON.parse(t); } catch(ex) {  }
	if (!o) o = { 'kwdbss' : 'ERROR', 'msg' : t };
	return o;
    }
    
    static sendEle(ein, cb, pageid) {
        const sob = {};
        sob.eid		= ein.id;
        if (Object.keys(ein.dataset).length) 
        sob.dataset = ein.dataset;
        sob.v       = ein.value;
        sob.pageid = pageid;
        sendcl.sobf(sob, cb);
    }
    
    static sobf(sob, cb, prt) {
        let burl = 'srv/server.php';

        if (1) burl += '?XDEBUG_SESSION_START=netbeans-xdebug';
        const XHR = new XMLHttpRequest(); 
        XHR.open('POST', burl);
        XHR.onloadend = function() { 
            const rt = this.responseText;
            if (prt === false) return cb(rt);
            cb(sendcl.responseTextParse(rt)); 
        }

        const formData = new FormData();
        formData.append('POSTob', JSON.stringify(sob)); 
        XHR.send(formData);        
        
    }
}
