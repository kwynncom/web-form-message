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
        byid('msg').readonly = byid('msg').disabled = true;
        
        byid('pageid').value = byid('msg').value = '';
        byid('kwjsioResponseEle').innerHTML = 'getting new id...';
        byid('savedCh').innerHTML = 0;
        
    }
}