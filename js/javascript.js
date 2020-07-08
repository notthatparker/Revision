function loadArtists(artists, selectedId) {
    var x = "";
    for (var i = 0; i < artists.length; ++i) {
        var artist = artists[i];
        x += '<div class="style-item ' + (selectedId === artist.id ? "selected" : "") + '" value="' + artist.id + '" onclick="onArtistSelect(' + artist.id + ')">\
                <div class="style-item-img" style="background-image: url(' + artist.pict_url + ');"></div>\
                <div class="style-item-title">' + artist.name + '</div>\
            </div>';
    }
    $('.styles-list').html(x);
}

function onArtistSelect(artistId) {
    if (+$(".style-item.selected").attr("value") === artistId) {
        return;
    }
    $(".style-item.selected").removeClass("selected");
    $(".style-item[value=" + artistId + "]").addClass("selected");
    checkAndUpload();
}

function getSelectedArtistId() {
    var selectedId = $(".style-item.selected").attr("value");
    if (!selectedId || !(+selectedId)) {
        return null;
    }
    return +selectedId;
}

function checkAndUpload() {
    if (!lastFile) {
        return;
    }

    //var selectedArtistId = getSelectedArtistId();
    //if (!selectedArtistId) return;

    /*var selectedModel = null;
    for (var i = 0; i < models.length; ++i) {
        if (models[i].artist_id === selectedArtistId) {
            selectedModel = models[i];
            break;
        }
    }
    */

    //if (!selectedModel) return;

    /*
    const alreadyStylizedImageUrl = getStylizedImageUrl(lastFile, selectedModel.path);
    if (alreadyStylizedImageUrl) {
        showStylizedImage(alreadyStylizedImageUrl);
        return;
    }
    */
    
    selectedModel = '';
    
    uploadFile(lastFile, selectedModel);
}

function uploadFile(file, selectedModel) {
    if (!file) return;

    SITE_BACKEND_URL = 'https://altvisionapp.com:5000';

    var formData = new FormData();
    formData.append('file', file);
    formData.append("checkpoint_path", selectedModel.path);
    addLoading();
    $.ajax({
        url: SITE_BACKEND_URL + '/upload-file',
        type: 'POST',
        data: formData,
        contentType: false,
        crossDomain: true,
        headers: { 'Access-Control-Allow-Origin': '*' },
        processData: false,
        // Ajax events
        success: function (data) {
            loadStylizedImage(data.task_id, file, selectedModel);
        },
        error: function () {
            alert("დაფიქსირდა შეცდომა");
            removeLoading();
        }
    });
}

function loadStylizedImage(taskId, file, selectedModel) {
    var trialTimeout = 1000;
    /* setTimeout(() => {
        const imgUrl = "result_test/51ln0ypQeTL._SX679__stylized.jpg";
        showStylizedImage(imgUrl);
        storeStylizedImageUrl(imgUrl, file, selectedModel.path);
        removeLoading();
    }, 500);
    return; */
    SITE_BACKEND_URL = 'https://altvisionapp.com:5000';

    $.ajax({
        url: SITE_BACKEND_URL + '/status/' + taskId,
        type: 'GET',
        contentType: false,
        dataType: 'json',
        crossDomain: true,
        headers: { 'Access-Control-Allow-Origin': '*' },
        processData: false,
        success: function (data) {
            // update UI
            if (data['state'] == 'SUCCESS') {
                
                if (data['result']) {
                    // show result
                    showStylizedImage(data['result']);
                    storeStylizedImageUrl(data['result'], file, selectedModel.path);
                    removeLoading();
                } else {
                    alert("დაფიქსირდა შეცდომა");
                    removeLoading();
                }
            } else if (data['state'] == 'FAILURE') {
                alert("დაფიქსირდა შეცდომა");
                removeLoading();
            } else {
                setTimeout(function () {
                    loadStylizedImage(taskId, file, selectedModel);
                }, trialTimeout);
            }
        },
        error: function () {
            alert("დაფიქსირდა შეცდომა");
            removeLoading();
        }
    });
    
    //showStylizedImage('result_images/unnamed.jpg');
    //storeStylizedImageUrl(data['result'], file, selectedModel.path);
    //removeLoading();
    
}

function showStylizedImage(imgUrl) {
    
    var image = document.getElementById('main-image');
    if (!image) {
        return;
    }
    image.src = imgUrl;
    $("#downloadLinkUrl").attr("href", imgUrl);
    /* var webUrl = SITE_URL + "/?photoUrl=" + imgUrl;
    $('.share-button-container').html('<div class="fb-share-button" data-href="'+webUrl+'" data-layout="button" data-size="large"><a target="_blank" href="'+getFBShareLink(webUrl)+'" class="fb-xfbml-parse-ignore">Share</a></div>');
    setTimeout(function () {
        FB.XFBML.parse();
    }, 1000); */
}

function getFBShareLink(url) {
    return 'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url)+'&src=sdkpreparse';
}

function getFileHashKey(file) {
    return file.name + file.lastModified;
}

function storeStylizedImageUrl(stylizedImageUrl, uploadedFile, modelPath) {
    var fileHashKey = getFileHashKey(uploadedFile);
    if (!alreadyStylizedImages[fileHashKey]) {
        alreadyStylizedImages[fileHashKey] = {};
    }
    alreadyStylizedImages[fileHashKey][modelPath] = stylizedImageUrl;
}

function getStylizedImageUrl(uploadedFile, modelPath) {
    var fileHashKey = getFileHashKey(uploadedFile);
    return (alreadyStylizedImages[fileHashKey] && alreadyStylizedImages[fileHashKey][modelPath]) || null;
}

function addLoading() {
    $('body').append('<div class="black-popup"><div class="loader-container"><div class="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div>');
}

function removeLoading() {
    $('.black-popup').remove();
}
