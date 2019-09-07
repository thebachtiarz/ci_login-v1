
function encLog() {
    var lpass = $('#password').val();
    if (lpass) {
        var md = forge.md.sha512.sha384.create();
        md.update(lpass);
        $('#return_password').val(md.digest().toHex());
    }
}

function encDaf() {
    var pass_a = $('#passwd_a').val();
    var pass_b = $('#passwd_b').val();
    if (pass_a && pass_b) {
        $('#dafHide').val(pass_a);
        let ma = forge.md.sha512.sha384.create();
        let mb = forge.md.sha512.sha384.create();
        ma.update(pass_a);
        mb.update(pass_b);
        let new_pass_enc = ma.digest().toHex();
        let confirm_pass_enc = mb.digest().toHex();
        $('#return_passwd_a').val(new_pass_enc);
        $('#return_passwd_b').val(confirm_pass_enc);
    }
}
