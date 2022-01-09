function markAsSeen() {
    const o = {};
    o.type = 'seen';
    const a = [];
    qsa('[data-pubid]').forEach(function (e) {a.push(e.dataset.pubid);});
    o.a = a;
    kwjss.sobf('../srv/server.php', o);
    return;
}

