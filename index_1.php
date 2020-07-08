<?php
    require("./api/functions.php");
    $loc = "./";

    $artists = getArtists();
    $models = getModels();

    $stylizedPictUrl = isset($_GET["photoUrl"]) ? strval($_GET["photoUrl"]) : "";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="altlogo.png">
    <title>Alt-Style</title>
    <?php echo getHTMLHead(); ?>
    <script type="text/javascript">
        var artists = <?php echo json_encode($artists); ?>;
        var models = <?php echo json_encode($models); ?>;
    </script>

    <meta property="og:type" content="website" />
    <meta property="og:title" content="Alt-Style" />
    <meta property="og:description" content="გააცოცხლე ქართველი მხატვარი" />
    <meta property="fb:app_id" content="2157660194337781" />
    <?php
        if ($stylizedPictUrl) {
            echo '<meta property="og:image" content="'.$SITE_URL.$stylizedPictUrl.'" />';
        } else {
            echo '<meta property="og:image" content="photos/fisherman.jpg" />';
        }
    ?>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=2157660194337781&autoLogAppEvents=1"></script>

    <div class="left-header-container">
        <div class="main main2">
            <div class="logo">
                <img src="./styles/imgs/logo.png">
            </div>
        </div>
    </div>
    <?php echo getHeader(); ?>
    <div class="header-placeholder"></div>

    <div class="main main2">

        <h1 class="main-title">გააცოცხლე მხატვრის სტილი შენს ფოტოში!</h1>

        <div class="main-area">
            <div class="photo-area">
                <div class="upload-container">
                    <input type="file" id="file-uploader" name="file" accept="image/jpeg, image/png" />
                    <img src="./styles/icons/cloud.png"/>
                    <br/>
                    ჩააგდეთ ფოტო
                    <br/>
                    ან
                    <br/>
                    დააჭირეთ აქ
                </div>
            </div>

            <div class="styles-area-container">
                <div class="styles-area">
                    <div class="stick"></div>
                    <div class="title">მხატვრები</div>
                    <div class="styles-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        loadArtists(artists, artists.length > 0 ? artists[0].id : undefined);
        var lastFile;

        var downloadLinkUrl = {};
        var alreadyStylizedImages = {};

        function onUpload() {
            if (!this.files || !(this.files.length >= 0)) {
                lastFile = undefined;
                return;
            }
            var fileName = $(this).val();
            lastFile = this.files[0];
            fileType = lastFile.type;
            loadImage(
                this.files[0],
                function(image, data) {
                    //console.log(image);
                    showFile(image.toDataURL(fileType), fileName);
                    checkAndUpload();
                },
                {
                    canvas: true,
                    pixelRatio: window.devicePixelRatio,
                    orientation: true
                }
            );
        }

        $('#file-uploader').bind('change', onUpload);

        function showFile(imageSrc, fileName) {
            remakePhotoArea(imageSrc);
            var image = document.getElementById('main-image');
            if (!image) {
                $('.main-image-container').append('<img src="" id="main-image" />');
                image = document.getElementById('main-image');
            }
            //console.log(image, imageSrc);
            if (!image) {
                return;
            }
            image.src = imageSrc;
            $("#downloadLinkUrl").attr("href", imageSrc);
            $("#downloadLinkUrl").attr("download", fileName.split("\\").pop());
        }

        var hasAlreadyShown = false;

        function remakePhotoArea(imageSrc) {
            if (hasAlreadyShown) {
                return;
            }
            hasAlreadyShown = true;
            $('.photo-area').html('\
                <div class="main-image-container"><div class="original-image-view-icon"></div></div>\
                <div class="main-image-support-buttons">\
                    <a href="" id="downloadLinkUrl" download="">\
                        <span class="download-button">\
                            <span class="download-icon"></span><span>გადმოწერა</span></span>\
                        </span>\
                    </a>\
                    <div class="minmized-upload-container">\
                        <input type="file" id="minimized-file-uploader" name="file" accept="image/jpeg, image/png" />\
                        <img src="./styles/icons/cloud.png"/>\
                        <br/>\
                        ატვირთეთ ახალი ფოტო\
                    </div>\
                </div>\
            ');
            
            $('#minimized-file-uploader').bind('change', onUpload);

            $(".original-image-view-icon").mouseleave(function() {
                $("#supporter-image").hide();
            });

            var lastCalledFile = null;

            $(".original-image-view-icon").mouseenter(function() {
                if (lastCalledFile !== lastFile) {
                    clearSupportetImageSrc();
                    lastCalledFile = lastFile;
                    updateSupporterImage(lastFile, imageSrc);
                }
                if (document.getElementById('supporter-image')) {
                    $("#supporter-image").show();
                    return;
                }
                $('.main-image-container').append('<img src="" id="supporter-image" />');
            });
        }

        function clearSupportetImageSrc() {
            var image = document.getElementById('supporter-image');
            if (image) {
                image.src = "";
            }
        }

        function updateSupporterImage(file, imageSrc) {
            var reader = new FileReader();
            reader.onload = function() {
                image = document.getElementById('supporter-image');
                image.src = imageSrc;
            };
            reader.readAsDataURL(file);
        }

    </script>

</body>
</html>
