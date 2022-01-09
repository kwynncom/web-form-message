class markAsSeenJScl {
    
    constructor() { this.send();  }
    
    send() {
        const o = {};
        o.type = 'seen';
        const a = [];
        qsa('[data-pubid]').forEach(function (e) {a.push(e.dataset.pubid);});
        o.a = a;
        kwjss.sobf('../srv/server.php', o, this.receive);
        return;      
    }
    
    receive(o) {
        const sre = byid('seenRes')
        let t = 'unknown result';
        if (!o || !o.status || o.status !== 'OK') t = 'failure';
        else t = o.mat + ' matched, ' + o.mod + ' modified / marked seen';
        byid('seenBtn').style.visibility = 'hidden';
        sre.innerHTML = t;
       
        return;
    }
}

