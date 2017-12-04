$(document).ready(function () {
    $(".alert")
        .delay(3000)
        .slideUp(500);

    $("#falshMessage")
        .delay(3000)
        .slideUp(500);
});

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
    console.log("Popup: "+url);
    return window.open(url, title, options);
}


// Ziskani dat
function getSelectedData(site, ids, showPocet, idProData) {

    var showPocetVal = '0';
    if (showPocet) {
        showPocetVal = '1';
        if (showPocet == 'false') {
            showPocetVal = '0';
        }
    }

    console.log(getBasePath()+'/'+site+'/selecteditems?show='+ids+'&showPocet='+showPocetVal);

    var data = httpGet(getBasePath()+'/'+site+'/selecteditems?show='+ids+'&showPocet='+showPocetVal);

    var vystup = $('#'+idProData);
    vystup.hide();

    vystup.html(data);
    var selectedItems = vystup.find('#selectedItems');
    vystup.html('').append(selectedItems);
    vystup.find("a").each(function() {
        this.setAttribute('href', '');
    });
    vystup.find('script').remove();

    vystup.show();
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
    var item = document.getElementById('numberOfItems'+id);
    if (item) {
        return item.value;
    }
    return "";
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

function sendDataToParent(site, showPocet, inc) {
    var dataToSend = getIdsFromArray(selectedIds);
    window.opener.selectSetDataFromChild(dataToSend, site, showPocet, inc);
    window.close();
}


// callback function from parent
function selectSetDataFromChild(data, site, showPocet, incIds) {

    incIds = typeof incIds !== 'undefined' ? incIds : false;

    if (idForDataFromSelect == 'NO_ID') {
        console.warn("No ID setted for data from select.");
        return;
    }

    clearPoleIds();

    // prevedeme data do tvaru na odeslani
    var index;
    var dataForSlect = [];
    for (index = 0; index < data.length; ++index) {
        dataForSlect.push(data[index][0]+':'+data[index][1]);
        addValueForId(data[index][0],data[index][1]);
    }

    if (incIds) {

        console.log("Puvodni: "+$('#'+idForDataFromSelect).val());
        console.log("Add: "+data);
        console.log("Add in: "+getAllIds());
        addIds($('#'+idForDataFromSelect).val());

        dataForSlect = getAllIds();
        console.log("Increment: "+dataForSlect);
    }
    document.getElementById(idForDataFromSelect).value = dataForSlect;
    console.log('Val change...');

    if (idForDataFromSelectDatagrid == 'NO_ID') {
        console.warn("No ID setted for data from select.");
        return;
    }
    getSelectedData(site, dataForSlect, showPocet, idForDataFromSelectDatagrid);
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

function openWindowForSelect(site, incIds) {

    incIds = typeof incIds !== 'undefined' ? incIds : false;

    if (incIds) {
        popup(getBasePath()+'/'+site+'/select?one=false&inc=true', '', 800, 600);
    }
    else {
        popup(getBasePath()+'/'+site+'/select?one=false&inc=false', '', 800, 600);
    }

}
function openWindowForSelectOne(site, incIds) {

    incIds = typeof incIds !== 'undefined' ? incIds : false;

    if (incIds) {
        popup(getBasePath()+'/'+site+'/select?one=true&inc=true', '', 800, 600);
    }
    else {
        popup(getBasePath()+'/'+site+'/select?one=true&inc=false', '', 800, 600);
    }
}

function openWindowForSelectWhere(site, incIds, columnname, value) {

    incIds = typeof incIds !== 'undefined' ? incIds : false;

    if (incIds) {
        popup(getBasePath()+'/'+site+'/select?one=false&inc=true&columnNameForWhere='+columnname+'&valueForWhere='+value+'', '', 800, 600);
    }
    else {
        popup(getBasePath()+'/'+site+'/select?one=false&inc=false&columnNameForWhere='+columnname+'&valueForWhere='+value+'', '', 800, 600);
    }

}
function openWindowForSelectOneWhere(site, incIds, columnname, value) {

    incIds = typeof incIds !== 'undefined' ? incIds : false;

    if (incIds) {
        popup(getBasePath()+'/'+site+'/select?one=true&inc=true&columnNameForWhere='+columnname+'&valueForWhere='+value+'', '', 800, 600);
    }
    else {
        popup(getBasePath()+'/'+site+'/select?one=true&inc=false&columnNameForWhere='+columnname+'&valueForWhere='+value+'', '', 800, 600);
    }
}



function getSelectedItemsFor(inputId, site, showPocet, idForGrid) {

    console.log(inputId, site, showPocet, idForGrid);
    if ($('#' + inputId).val().length != 0) {
        getSelectedData(site, $('#' + inputId).val(), showPocet, idForGrid);
    }
};

function setSelectMore(state) {
    canSelectMoreTrue = state;
}

function clearSelectedItems(idElentuKdeJsouIds) {
    $('#'+idElentuKdeJsouIds).val('');
}

function getPutValueInt(fromId, toName) {
    if ($('#'+fromId+'').val().length > 0) {
        $('input[name='+toName+']').val($('#'+fromId+'').val());
    } else {
        $('input[name='+toName+']').val(null);
    }
}


function clearPoleIds() {
    nejakePole = [];
}

var nejakePole = [];
// prida ids do nejakeho pole a pak tam pridava dalsi
function addIds(ids) {
    // id ve tvaru
    // 12:2,123:3,123:1
    // nebo
    // 21:
    if (!ids) {
        return;
    }
    if (ids.length < 1) {
        return;
    }

    console.log("ADD: "+ids);

    var idsAr = ids.split(',');

    var index;
    for (index = 0; index < idsAr.length; ++index) {
        idsArItem = idsAr[index].split(':');
        if (idsArItem.length < 2) {
            addValueForId(idsArItem[0], 1);
        }
        else {
            addValueForId(idsArItem[0], idsArItem[1]);
        }
    }
}

function addValueForId(id, val) {

    var found = false;
    var index;
    for (index = 0; index < nejakePole.length; ++index) {
        if (nejakePole[index][0] == id) {
            console.log("Found: "+id +","+ val+ "  original:"+ nejakePole[index][0], nejakePole[index][1]);
            nejakePole[index][1] = Number(val)+Number(nejakePole[index][1]);
            found = true;
        }
    }
    if (!found) {
        console.log("Not found: "+id,val);
        nejakePole.push([id, val]);
    }
}

function getAllIds() {
    var index;
    var ret = "";
    for (index = 0; index < nejakePole.length; ++index) {
        if (index > 0) {
            ret += ",";
        }
        ret += nejakePole[index][0]+":"+nejakePole[index][1];
    }

    return ret;
}



function getLekyIdForRezervace(rezervaceID) {

    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    console.log("GET from: "+getBasePath()+"/rezervace/getleky?rezervaceID="+rezervaceID);
    xmlHttp.open("GET", getBasePath()+"/rezervace/getleky?rezervaceID="+rezervaceID, false);
    xmlHttp.send( null );
    var answer= xmlHttp.responseText;
    var obj = JSON.parse(answer);

    clearPoleIds();

    for (var x in obj){
        console.log(obj[x],obj[x][0], obj[x][1] );
        addValueForId(obj[x][0], obj[x][1]);
    }
}