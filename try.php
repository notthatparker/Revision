<?php

include_once('functions/functions.php');

//header("Access-Control-Allow-Origin: *");

?>

<!doctype html>
<html lang="en">

<head>
    <title>Hue</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>
<header class="site-navbar site-navbar-target" role="banner">

	<div class="container">
		<div class="row align-items-center position-relative">

			<div class="col-3 ">
				<div class="site-logo">
					<a href="/" class="font-weight-bold"><img style="width: 15%" src="icons_new/logo/icon1.png"></a>
				</div>
			</div>
			<div class="col-9  text-right">
				<span class="d-inline-block d-lg-none"><a href="#" class="text-primary site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-primary"></span></a></span>



				<nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
					<ul class="site-menu main-menu js-clone-nav ml-auto ">
						<li class = 'active'><a href="/" class="nav-link">Home</a></li>
						<li><a href="about.html" class="nav-link">Our Story</a></li>
						<li><a href="video.php" class="nav-link">video</a></li>
						<li><a href="try.php" class="nav-link try_beta ">Try Beta</a></li>
					</ul>
				</nav>
			</div>

		</div>
	</div>

</header>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


<div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

</div>
<section>
       <div class="upload">
										 <div class="container" style="margin-top: 15%">
								         <div class="row my-4">
								             <div class="col">
								                 <div type="file" class="jumbotron" id='respdiv'>
								                     <form style="cursor: pointer;" onclick="clicked();" action="/file-upload" class="dropzone dz-clickable" id="my-dropzone">
								                         <div class="dz-message d-flex flex-column" id=" click" type="file">
																					 <div class="upload-container">
																							 <input style="display: none;" type="file" id="file-uploader" name="file" accept="image/jpeg, image/png" />
																					 </div>
								                             <i class="material-icons text-muted">cloud_upload</i>
								                             Drag &amp; Drop here or click
								                         </div>
								                     </form>
								                 </div>
								             </div>
								         </div>
								     </div>
                   </div>
    <!-- <div class="rigt_create_icons">
        <img class="rigt_icons" src="icons/print/Group 5.png"></img>
        <img class="rigt_icons" src="icons/facebook share button/share on fb.png"></img>
        <img class="rigt_icons" src="icons\downlaod\Combined Shape.png"></img>
    </div> -->
</section>
<div class="site-section">
    <div class="container">
        <div class="row mb-4 text-center">
            <div class="col">
                <a href="#"><span class="m-2 icon-facebook"></span></a>
                <a href="#"><span class="m-2 icon-twitter"></span></a>
                <a href="#"><span class="m-2 icon-linkedin"></span></a>
                <a href="#"><span class="m-2 icon-instagram"></span></a>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-7 text-center">
                <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> <b>Alt Mind</b></a>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.0.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/aos.js"></script>

<script src="js/javascript.js"></script>
<script src="js/load-image.js"></script>


<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

        //loadArtists(artists, artists.length > 0 ? artists[0].id : undefined);
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

									var imgCanvas = document.createElement("canvas"),
								    imgContext = imgCanvas.getContext("2d");

								    // Make sure canvas is as big as the picture
								    imgCanvas.width = image.width;
								    imgCanvas.height = image.height;

								    // Draw image into canvas element
								    imgContext.drawImage(image, 0, 0, image.width, image.height);
								    // Save image as a data URL

									showFile(imgCanvas.toDataURL(fileType), fileName);
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
            document.querySelectorAll('.jumbotron')[0].style.backgroundColor = "black";
            remakePhotoArea(imageSrc);
            var image = document.getElementById('main-image');
            if (!image) {
                $('.main-image-container').append('<img src="" id="main-image" />');
                image = document.getElementById('main-image');
            }

            if (!image) {
                return;
            }

            image.src = imageSrc;
            downloadName = fileName.split("\\").pop();
            downloadName = downloadName.substring(0, downloadName.lastIndexOf(".")) + "_colored" + downloadName.substring(downloadName.lastIndexOf("."));

            $("#downloadLinkUrl").attr("href", imageSrc);
            $("#downloadLinkUrl").attr("download", downloadName);
        }

        var hasAlreadyShown = false;

        function remakePhotoArea(imageSrc) {
            if (hasAlreadyShown) {
                return;
            }
            hasAlreadyShown = true;
            $('.jumbotron').html('\
                <div class="main-image-container"><div class="original-image-view-icon"></div></div>\
                <div class="main-image-support-buttons">\
                    <a href="" id="downloadLinkUrl" download="">\
                        <span>\
												<img src="icons_new/downlaod/download.png" height="70" width="70">\
							          </span>\
                    </a>\
                    <div class="minmized-upload-container">\
                            <input style="display: none;" type="file" id="minimized-file-uploader" name="file" accept="image/jpeg, image/png">\
												<i class="material-icons text-muted" style="font-size:80px" onclick="up_ag();">cloud_upload</i>\
                        <br/>\
                        \
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


<script src="js/main.js"></script>

<script>
	function clicked() {
        document.getElementById('upbutt').click();
    }
    function up_ag() {
        document.getElementById('minimized-file-uploader').click();
    }
</script>

</body>

</html>
