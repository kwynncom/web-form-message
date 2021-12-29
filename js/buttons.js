function onmsgDone() {
    byid('pageid').value = '';
    byid('msg'   ).style.visibility = 'hidden';
}

class onnew {
    
    config() {
        this.surl = 'srv/server.php';
    }
    
    static pageid() {
        const pid = byid('pageid').value;
        return pid;
    }
    
    constructor() {
        this.config();
        onnew.do10(false);
        this.do20();
    }
    
    do20() {
        const ob = {};
        ob.action = 'getpageid';
        sendcl.sobf(this.surl, ob, this.dor30);
    }
    
    dor30(a) {
        kwas(a['pageidact'] === 'OK', 'did not get proper pageid');
        byid('pageid').value = a['pageid'];
        onnew.do10(true);
    }
    
    static do10(isup) {
        byid('msg').readonly = byid('msg').disabled = !isup;
        if (!isup) {
            byid('pageid').value = byid('msg').value = '';
            byid('kwjsioResponseEle').innerHTML = 'getting new id...';
            byid('savedCh').innerHTML = 0;
        }
        else {
            new kwior_messages();
            byid('msg'   ).style.visibility = 'visible';
        }
    }
}