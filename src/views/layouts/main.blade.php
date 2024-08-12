<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Prompter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            margin:0;
            padding:0;
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            width:100%;
            min-height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            align-items:center;
            background-color:#fAfAfA;
            position:relative;
        }

        header {
            height:100px;
            display:flex;
            justify-content:center;
            align-items:center;
            gap:30px;
            border: solid 1px;
            border-image:
            radial-gradient(
                transparent 0%,
                rgb(0, 0, 0) 50%,
                transparent 100%
            ) 1 0%;
            border-top:0;
        }

        header > p {
            padding:0;
            margin:0;
        }
        
        header a {
            color:black;
            text-decoration: none;
        }
        header a:hover {
            text-decoration:underline;
            cursor:pointer;
        }

        footer {
            height:100px;
        }

        .activeSite {
            color:purple !important;
            text-decoration:underline;
            text-decoration-color:purple;
        }

        #test {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

    </style>
    @yield('AIPrompterStyle')
</head>
<body> <!--has flex and center main div to the middle -->
    <header>
        <div id="test">
            <p><a href="{{ route('AIPrompter_image_generator') }}" @class(['activeSite'=> request()->routeIs('AIPrompter_image_generator')])>Image Generator</a></p>
            <p><a href="{{ route('AIPrompter_text_generator') }}" @class(['activeSite'=> request()->routeIs('AIPrompter_text_generator')])>Text Generator</a></p>
        </div>
    </header>
    @yield('AIPrompterContent')
    <footer></footer>
</body>
</html>