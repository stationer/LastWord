/*****************************************************************************
 * Project     : LastWord
 *                Deterministic Password Generator
 * Created By  : LoneFry
 *                dev@lonefry.com
 * License     : CC BY-NC-SA
 *                Creative Commons Attribution-NonCommercial-ShareAlike
 *                http://creativecommons.org/licenses/by-nc-sa/3.0/
 * File        : /^LastWord/js/lastword.js
 *                Scripts specific to LastWord application
 ****************************************************************************/

var appPath = 'vendor/stationer/lastword/src/';
var timer = null;
var aList = {};
var aMnem = {
    'a': 'bell.svg',
    'b': 'bold.svg',
    'c': 'check.svg',
    'd': 'broadcast.svg',
    'e': 'law.svg',
    'f': 'light-bulb.svg',
    'g': 'bug.svg',
    'h': 'clock.svg',
    'i': 'code.svg',
    'j': 'dash.svg',
    'k': 'key.svg',
    'l': 'lock.svg',
    'm': 'location.svg',
    'n': 'pencil.svg',
    'o': 'mail.svg',
    'p': 'person.svg',
    'q': 'markdown.svg',
    'r': 'pin.svg',
    's': 'hubot.svg',
    't': 'plug.svg',
    'u': 'mention.svg',
    'v': 'plus.svg',
    'w': 'milestone.svg',
    'x': 'pulse.svg',
    'y': 'mirror.svg',
    'z': 'jersey.svg',
    'A': 'note.svg',
    'B': 'mute.svg',
    'C': 'fold.svg',
    'D': 'gear.svg',
    'E': 'heart.svg',
    'F': 'globe.svg',
    'G': 'history.svg',
    'H': 'home.svg',
    'I': 'server.svg',
    'J': 'question.svg',
    'K': 'search.svg',
    'L': 'quote.svg',
    'M': 'smiley.svg',
    'N': 'reply.svg',
    'O': 'tag.svg',
    'P': 'report.svg',
    'Q': 'stop.svg',
    'R': 'repo.svg',
    'S': 'star.svg',
    'T': 'shield.svg',
    'U': 'thumbsdown.svg',
    'V': 'tools.svg',
    'W': 'trashcan.svg',
    'X': 'tasklist.svg',
    'Y': 'squirrel.svg',
    'Z': 'thumbsup.svg',
    '0': 'eye.svg',
    '1': 'file.svg',
    '2': 'triangle-up.svg',
    '3': 'unfold.svg',
    '4': 'x.svg',
    '5': 'watch.svg',
    '6': 'italic.svg',
    '7': 'zap.svg',
    '8': 'inbox.svg',
    '9': 'megaphone.svg',
    '+': 'grabber.svg',
    '/': 'octoface.svg'
};

function preload() {
    for (f in aMnem) {
        var o = document.createElement('img');
        o.src = appPath+'/images/mnemonics/'+aMnem[f];
    }
}
function generatePassHash(sMaster, sService, sUser, iSeed) {
    //return b64_sha1(sMaster+sService+sUser+iSeed);
    //more hashing makes brute-forcing the masterkey from one known result take longer
    return b64_sha1(sMaster+b64_sha1(sService+b64_sha1(sUser+b64_sha1(''+iSeed))));
}
function update_() {
    if (timer) {
        clearTimeout(timer);
    }
    timer = window.setTimeout('update()', 100);
    updateVis();
}
function update() {
    var oTbody = document.getElementById('lastword_passwordList');
    for (i in aList) {
        setPassword(i);
    }
}
function setPassword(i) {
    var s = document.getElementById('lastword_masterKey').value;
    if ('' == s) {
        document.getElementById('lw'+i+'_p3').innerHTML = 'Enter Key';
    } else {
        var sHash = generatePassHash(s, aList[i]['service'],
                                     aList[i]['username'], aList[i]['resetCount']);
        document.getElementById('lw'+i+'_p3').innerHTML = sHash.substr(0, aList[i]['passLen']);
    }
}
function updateVis(){
    var s = document.getElementById('lastword_masterKey').value;
    document.getElementById('lastword_keyVisual').innerHTML = '';
    for (var i=0; i<7; i++) {
        if (aMnem[b64_sha1(s).substr(i,1)] != '') {
            document.getElementById('lastword_keyVisual').innerHTML +=
                '<img width="16" height="16" src="'+appPath+'/images/mnemonics/'+aMnem[b64_sha1(s).substr(i, 1)]+'">';
        }
    }
}
function resetPass(o, i) {
    document.getElementById('lw'+o+'_r').innerHTML =
        aList[o]['resetCount'] = aList[o]['resetCount'] * 1 + i;
    setPassword(o);
    document.getElementById('lw'+o+'_m').innerHTML = 'saving...';

    var oForm = ajas.http.oBlankForm;
    oForm.action = '/LastWord/json?callback=resetPass_&i=' + o;
    oForm.sData = 'lwr_id=' + aList[o]['lwr_id'] + '&resetCount=' + aList[o]['resetCount'];
    ajas.http.submitForm(oForm);
}
function resetPass_(oXML, aParams) {
    if (oXML.responseText == '') {
        return;
    }
    try {
        eval('aData=' + oXML.responseText);
    } catch (e) {
        return;
    }
    if (!aData['success']) {
        var i = aParams['i'];
        document.getElementById('lw'+i+'_m').innerHTML = 'not saved';
        return;
    }
    if (aData['alert']) {
        alert(aData['alert']);
    }
    var i = aParams['i'];
    document.getElementById('lw'+i+'_m').innerHTML = 'saved';
}
function remoteLogin(i, sPass) {
    document.getElementById('lwlogin').action = aList[i]['loginURI'];
    document.getElementById('lwlogin').target = '_blank';
    document.getElementById('lwloginUser').value = aList[i]['username'];
    document.getElementById('lwloginPass').value = sPass;
    document.getElementById('lwloginUser').name = aList[i]['userField'];
    document.getElementById('lwloginPass').name = aList[i]['passField'];
    document.getElementById('lwlogin').submit();
    return false;
}
function validateAddForm() {
    var sErr = '';
    if (document.getElementById('nl').value == '') {
        sErr += 'Enter a Service Name.\n';
    }
    if (document.getElementById('nu').value == '') {
        sErr += 'Enter a UserName.\n';
    }
    if ('' != sErr) {
        alert(sErr);
        return false;
    }
    return true;
}
function setLoginDetails(i) {
    if (aLoginDetails[i]) {
        document.getElementById('loginURI').value  = aLoginDetails[i].loginURI;
        document.getElementById('userField').value = aLoginDetails[i].userField;
        document.getElementById('passField').value = aLoginDetails[i].passField;
        if (document.getElementById('lww_id')) {
            document.getElementById('lww_id').value = aLoginDetails[i].lww_id;
            document.getElementById('label').value = aLoginDetails[i].label;
        }
    } else {
        document.getElementById('loginURI').value  = '';
        document.getElementById('userField').value = '';
        document.getElementById('passField').value = '';
        if (document.getElementById('lww_id')) {
            document.getElementById('lww_id').value = '';
            document.getElementById('label').value  = '';
        }
    }
}

if (typeof window.onload != 'function') {
    window.onload = preload;
} else {
    window.onload = function() {
        if (oldonload) {
            oldonload();
        }
        preload();
    }
}
