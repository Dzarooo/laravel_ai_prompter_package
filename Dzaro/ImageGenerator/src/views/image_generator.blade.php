<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Generator</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            width:100%;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background-color:#fAfAfA;
            position:relative;
        }
        body > div {
            width:40vw;
            min-width:200px;
            aspect-ratio:16/9;
            min-height:125px;
            border-radius: 0.75rem;
            padding:20px;
            box-shadow: 0px 1px 3px 0px rgba(50,50,50,0.5);
            -webkit-box-shadow: 0px 1px 3px 0px rgba(50,50,50,0.5);
            -moz-box-shadow: 0px 1px 3px 0px rgba(50,50,50,0.5);
            display:flex;
            flex-direction: column;
            align-items: center;
            height:100%;
            justify-content: center;
            gap:10%;
            border-width: 3px;
            border-style: solid;
            border-image:
            linear-gradient(
                transparent 0%,
                rgb(177, 41, 255) 50%,
                transparent 100%
            ) 1 100%;
        }

        body > div > h2 {
            width:70%;
            text-align: center;
            height:100px;
            transition: all 0.3 ease-in-out;
            font-size: clamp(20px, 30px, 1.5vw);
        }

        body > div > textarea {
            appearance: none;
            background-color: transparent;
            width:70%;
            border:solid;
            border-color:transparent;
            border-bottom-color:grey;
            border-bottom-width:1px;
            min-height:30px;
            font-size: clamp(10px, 15px, 1vw);
            outline:none;
            font-weight:300;
            resize: none;
        }

        body > div > div {
            height:100px;
        }

        @media (max-width: 1600px) {
            body > div {
                width:80vw !important;
            }
        }

    </style>
</head>

<body> <!--has flex and center main div to the middle -->
    <div> <!-- main div -->
        <h2>Take your imagination to another level and get this prompt rolling!</h2>
        <textarea id="promptInput" placeholder="Type something and watch magic happens..." oninput='if(this.scrollHeight < 300) {this.style.height = "";this.style.height = this.scrollHeight - 4 + "px"}'></textarea>
        <div></div> <!-- invisible div for making flex items position correctly -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            //console.log(test);
        });

        function listenForEnter(event) {
            if(event.keyCode === 13) {
                event.preventDefault();
                console.log("enter");
                //main(givenPrompt);
            }
        }

        // async function main(givenPrompt) {
        //     const image = await client.images.generate({prompt: givenPrompt})
        //     console.log(image);
        // }

        (function() {
            document.getElementById('promptInput').addEventListener('keypress', listenForEnter);
        })();
    </script>
</body>
</html>