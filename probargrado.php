<!doctype html>

<html lang="es">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Subir Target</title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <script

            src="https://code.jquery.com/jquery-2.2.4.min.js"

            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="

            crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/plupload.full.min.js"></script>


    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <link rel="stylesheet" href="css/main.css">

    <!-- Latest compiled and minified JavaScript -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>

<body>

<div class="container">

    <div>

        <h1>Subir Target</h1>

    </div>

</div>

<div class="container">
    <form id="form_nuevoInmueble" action="grado.php" method="post">

        <div class="form-group">
            <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
            <br />

            <div id="container">

                <a id="pickfiles" href="javascript:" class="btn btn-lg btn-primary btn-block">

                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>

                    Subir Imagen Target <span class="badge" id="porcentaje"></span></a>

            </div>

            <br />

            <pre id="console"></pre>

            <div id="preview"></div>

            <script type="text/javascript">

                // Custom example logic



                var uploader = new plupload.Uploader({

                    runtimes : 'html5,flash,silverlight,html4',

                    browse_button : 'pickfiles', // you can pass an id...

                    container: document.getElementById('container'), // ... or DOM Element itself

                    url : 'uploadimage.php',

                    flash_swf_url : 'js/Moxie.swf',

                    silverlight_xap_url : 'js/Moxie.xap',



                    filters : {

                        max_file_size : '5mb',

                        mime_types: [

                            {title : "Image files", extensions : "jpg,gif,png"},

                            {title : "Zip files", extensions : "zip"}

                        ]

                    },



                    init: {

                        PostInit: function() {

                            document.getElementById('filelist').innerHTML = '';

                        },

                        UploadProgress: function(up, file) {

                            document.getElementById('porcentaje').innerHTML = file.percent + "%";

                        },



                        Error: function(up, err) {

                            document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));

                        }

                    }

                });



                uploader.init();

                uploader.bind('FileUploaded', function(up, file, info) {

                    var obj = JSON.parse(info.response);

                    $('#form_nuevoInmueble').append('<input type="hidden" name="imgurl" value="' + obj.result.cleanFileName + '" />');

                });

                uploader.bind('FilesAdded', function(up, files) {

                    $.each(files, function(){



                        var img = new mOxie.Image();



                        img.onload = function() {

                            this.embed($('#preview').get(0), {

                                width: 100,

                                height: 100,

                                crop: true

                            });

                        };



                        img.onembedded = function() {

                            this.destroy();

                        };



                        img.onerror = function() {

                            this.destroy();

                        };



                        img.load(this.getSource());



                    });

                    uploader.start();

                });

            </script>
        </div>

        <br />

        <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-floppy-open"></span> Guardar</button>



    </form>

</div>

</body>

</html>

