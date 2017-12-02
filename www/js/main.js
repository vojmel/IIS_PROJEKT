
/* Number spinner */
$(document).on('click', '.number-spinner button', function () {
    var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0;

    if (btn.attr('data-dir') == 'up') {
        newVal = parseInt(oldValue) + 1;
    } else {
        if (oldValue > 1) {
            newVal = parseInt(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }
    btn.closest('.number-spinner').find('input').val(newVal);
});


/**
 * Select itemu
 */
function popup(url, title, width, height) {
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var options = '';
    options += ',width=' + width;
    options += ',height=' + height;
    options += ',top=' + top;
    options += ',left=' + left;
    return window.open(url, title, options);
}


// Ziskani dat
function getSelectedData(site, ids, showPocet, idProData) {

    var showPocetVal = '0';
    if (showPocet) {
        showPocetVal = '1';
    }
    var data = httpGet(getBasePath()+'/'+site+'/selecteditems?show='+ids+'&showPocet='+showPocetVal);
    document.getElementById(idProData).innerHTML = data;
}


// Get ounly ids
function getIdsFromArray(htmlIds) {
    var index;
    var ret = [];
    for (index = 0; index < htmlIds.length; ++index) {
        var id = htmlIds[index].replace("checkBoxId", "");
        ret.push([id, getNumberOf(id)]);
    }

    return ret;
}
// Mechanika selectovani
var selectedIds = [];
function addSelected(id) {

    // nemuze vybirat vice nez jednu
    if (canSelectOunlyOne()) {
        // odselektujeme a umazeme pokud nejaka uz je
        if (selectedIds.length > 0) {
            document.getElementById(selectedIds[0]).checked = false;
            selectedIds.splice(0, 1);
        }
    }

    if ( ! isSelected(id)) {
        selectedIds.push(id);
    }
}
function isSelected(id) {
    return selectedIds.indexOf(id) > -1;
}
function changeStateOn(id) {
    if (isSelected(id)) {
        var index = selectedIds.indexOf(id);
        if (index >= 0) {
            selectedIds.splice(index, 1);
        }
    }
    else {
        addSelected(id);
    }
}
// Pocet vybranych
function getNumberOf(id) {
    return document.getElementById('numberOfItems'+id).value;
}
function httpGet(theUrl) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

function canSelectOunlyOne() {
    return (!canSelectMoreTrue);
}

function sendDataToParent(site) {
    var dataToSend = getIdsFromArray(selectedIds);
    window.opener.selectSetDataFromChild(dataToSend, site);
    window.close();
}


// callback function from parent
function selectSetDataFromChild(data, site) {

    if (idForDataFromSelect == 'NO_ID') {
        console.warn("No ID setted for data from select.");
        return;
    }

    // prevedeme data do tvaru na odeslani
    var index;
    var dataForSlect = [];
    for (index = 0; index < data.length; ++index) {
        dataForSlect.push(data[index][0]+':'+data[index][1]);
    }

    document.getElementById(idForDataFromSelect).value = dataForSlect;

    if (idForDataFromSelectDatagrid == 'NO_ID') {
        console.warn("No ID setted for data from select.");
        return;
    }
    getSelectedData(site, dataForSlect, true, idForDataFromSelectDatagrid);
}



//
// Kam se budou datavat vybrane hednoty IDs
var idForDataFromSelect = 'NO_ID';
function setIdFroDataFromSelect(id) {
    idForDataFromSelect = id;
}

//
// Kam se budou davat vybrane hodnoty ve forme tabulky
var idForDataFromSelectDatagrid = 'NO_ID';
function setIdFroDataFromSelectDatagrid(id) {
    idForDataFromSelectDatagrid = id;
}

function openWindowForSelect(site) {
    popup(getBasePath()+'/'+site+'/select', '', 800, 600);
}
function openWindowForSelectOne(site) {
    popup(getBasePath()+'/'+site+'/select?one=true', '', 800, 600);
}
