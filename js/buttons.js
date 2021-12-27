function onmsgDone() {
    byid('pageid').value = '';
    byid('msg'   ).style.visibility = 'hidden';
}

class onnew {
    
    static pageid() {
        const pid = byid('pageid').value;
        return pid;
    }
    
    constructor() {
        this.do10();
        this.do20();
    }
    
    do20() {
        const ob = {};
        ob.action = 'getpageid';
        sendcl.sobf(ob, this.dor30);
    }
    
    dor30(din) {
        return;
    }
    
    do10() {
        byid('msg').readonly = byid('msg').disabled = true;
        byid('pageid').value = byid('msg').value = '';
        byid('kwjsioResponseEle').innerHTML = 'getting new id...';
        byid('savedCh').innerHTML = 0;
    }
}