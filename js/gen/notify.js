var KW_G_EMN_2021_1 = false;

function kwNotifyOK(din) { 
    if (!din || din.len < 1) return;
    if (KW_G_EMN_2021_1 && time() > 1640771869000) return;
    kwjss.sobf('notify.php');
    KW_G_EMN_2021_1 = true;
}