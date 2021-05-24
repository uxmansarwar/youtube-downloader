<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favi.png">

    <title>Download YouTube video</title>

    <!-- Bootstrap -->
    <link href="third-party/css/bootstrap.min.css" rel="stylesheet">
    <script src="third-party/js/bootstrap.min.js"></script>
    <script src="third-party/jquery-3.5.1.min.js"></script>
    <script src="main.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            max-width: 700px;
            margin: 0px auto;
        }
    </style>
</head>

<body>


    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="m-4">

                    <a href="https://www.youtube.com/c/MUSGroupOfIT" target=".blank"><img src="yt-header.png" width="250px" height="100px" class="rounded mx-auto d-block" alt="icons8-youtube.gif"></a>
                </div>
            </div>
            <div class="col-12">
                <div class="m-2 h1 text-center">
                    <i style="color:#d9534f;" class="fa  fa-2x fa-youtube" aria-hidden="true"></i> Downloader
                </div>
            </div>
            <div class="col-12">
                <div class="m-2 h5 text-center">
                    Convert YouTube Video to MP3!
                </div>
            </div>
            <div class="col-12">
                <div class="m-2 h5 text-center">
                    <div class="input-group mb-3 text-center">
                        <input value="" type="text" class="form-control" placeholder="Insert Video Link Like ...https://www.youtube.com/watch?v=2247yoXJeCc" aria-describedby="search_vid" id="user_url">
                        <div class="input-group-append">
                            <button class="input-group-text btn-danger text-white" id="search_vid">YouTube</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="loader" class="row d-none">
            <div class="col-12 text-center">
                <div class="spinner-border text-danger h2 mt-5" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>


        <div id="results" class="row d-none">
            <div id="video_title" class="col-12 h4 p-4">
            </div>
            <div class="col-12">
                <div class="m-2 text-center">
                    <a href="" class="h2 btn btn-success text-white stretched-link" download="true">START DOWNLOADING MP3</a href="">
                </div>
            </div>
            <div class="col-12">
                <div class="m-2 h5 text-center ">
                    <iframe class="mt-5" width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>









    </div>

</body>

</html>