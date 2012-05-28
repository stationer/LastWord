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

var appPath = '/^LastWord';
var timer = null;
var aList = {};
var aMnem = {'a':'circle_blue.png',       'b':'circle_cyan.png',
			'c':'circle_green.png',       'd':'circle_magenta.png',
			'e':'circle_red.png',         'f':'circle_yellow.png',
			'g':'diamond_blue.png',       'h':'diamond_cyan.png',
			'i':'diamond_green.png',      'j':'diamond_magenta.png',
			'k':'diamond_red.png',        'l':'diamond_yellow.png',
			'm':'square_blue.gif',        'n':'square_cyan.gif',
			'o':'square_green.gif',       'p':'square_magenta.gif',
			'q':'square_red.gif',         'r':'square_yellow.gif',
			's':'triangle_down_blue.png', 't':'triangle_down_cyan.png',
			'u':'triangle_down_green.png','v':'triangle_down_magenta.png',
			'w':'triangle_down_red.png',  'x':'triangle_down_yellow.png',
			'y':'xiao_blue.gif',          'z':'xiao_cyan.gif',
			'A':'xiao_green.gif',         'B':'xiao_magenta.gif',
			'C':'xiao_red.gif',           'D':'xiao_yellow.gif',
			'E':'dollar_blue.gif',        'F':'dollar_cyan.gif',
			'G':'dollar_green.gif',       'H':'dollar_magenta.gif',
			'I':'dollar_red.gif',         'J':'dollar_yellow.gif',
			'K':'x_blue.gif',             'L':'x_cyan.gif',
			'M':'x_green.gif',            'N':'x_magenta.gif',
			'O':'x_red.gif',              'P':'x_yellow.gif',
			'Q':'guo_blue.gif',           'R':'guo_cyan.gif',
			'S':'guo_green.gif',          'T':'guo_magenta.gif',
			'U':'guo_red.gif',            'V':'guo_yellow.gif',
			'W':'triangle_down_blue.png', 'X':'triangle_down_cyan.png',
			'Y':'triangle_down_green.png','Z':'triangle_down_magenta.png',
			'0':'triangle_down_red.png',  '1':'triangle_down_yellow.png',
			'2':'yen_blue.gif',           '3':'yen_cyan.gif',   
			'4':'yen_green.gif',          '5':'yen_magenta.gif',
			'6':'yen_red.gif',            '7':'yen_yellow.gif', 
			'8':'ai_blue.gif',            '9':'ai_cyan.gif',   
			'+':'ai_green.gif',           '/':'ai_magenta.gif'};

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
