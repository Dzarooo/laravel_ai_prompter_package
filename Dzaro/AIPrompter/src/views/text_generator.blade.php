@extends('views::layouts.main')

@section('AIPrompterStyle')
<style>
    #mainContainer {
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

    #mainContainer > h2 {
        width:70%;
        text-align: center;
        height:100px;
        transition: all 0.3 ease-in-out;
        font-size: clamp(20px, 30px, 1.5vw);
    }

    #mainContainer > #inputContainer {
        width:100%;
        display:flex;
        justify-content:center;
        align-items: start;
    }

    #mainContainer > #inputContainer > textarea {
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

    #mainContainer > #inputContainer > i {
        font-size:30px;
        transform:translateY(-8px);
        background-image: radial-gradient(
            circle at center,
            var(--myColor1) 0,
            transparent 60%
        );
        transition: --myColor1 0.1s;
    }
    
    #mainContainer > #inputContainer > i:hover {
        cursor:pointer;
        animation:jump 0.5s;
        --myColor1: rgb(213, 213, 213);
    }

    #responseDiv {
        min-height:100px;
        height:100px;
        width:calc(70% + 37px);
        transition:height 0.3s ease-in-out;
    }

    @property --myColor1 {
        syntax: '<color>';
        initial-value: transparent;
        inherits: false;
    }

    @keyframes jump {
        0% { transform: translate(0px, -8px); }
        50% { transform: translate(3px, -8px); }
        100% { transform: translate(0px, -8px); }
    }

    @media (max-width: 1600px) {
        #mainContainer {
            width:80vw !important;
        }
    }
    
</style>
@endsection

@section('AIPrompterContent')

    <div id="mainContainer"> <!-- main div -->
        <div id="gridWrapper">
        <h2>Take your imagination to another level and write unlimited resources!</h2>
        </div>
        <div id="inputContainer"> <!-- div for aligning textarea and arrow horizontally -->
            <div></div> <!-- invisible div for making flex items position correctly -->
            <textarea id="promptInput" placeholder="Type something and watch magic happens..." oninput='if(this.scrollHeight < 300) {this.style.height = "";this.style.height = this.scrollHeight - 4 + "px"}'></textarea>
            <i onclick="askAI()" class="bi bi-arrow-right-short"></i>
        </div>
        <div id="responseDiv"><p id="responseParagraph"></p></div> <!-- invisible div for making flex items position correctly, after asking AI it becomes container for AI response -->
    </div>

    <script>
        const messages = [];

        function listenForEnter(event) {
            if(event.keyCode === 13) {
                event.preventDefault();
                askAI();
            }
        }

        function askAI() {
            responseDiv.style.height = "100%";
            responseParagraph.textContent = "Asking AI...";
            messages.push({
                "content": promptInput.value,
                "role": "user"
            })
            console.log(messages);
            $.ajax({
                type:'POST',
                url:"{{ route('AIPrompter_generate_text') }}",
                data:{prompt:promptInput.value, messages:messages},
                success:function(data){
                    console.log(data.success);
                    messages.push({
                        "content": data.success.content,
                        "role": "assistant"
                    })
                    responseParagraph.textContent = data.success.content;
                }
            });
        }

        
        (function() {
            const promptInput = document.getElementById('promptInput');
            promptInput.addEventListener('keypress', listenForEnter);
            const responseDiv = document.getElementById('responseDiv');
            const responseParagraph = document.getElementById('responseParagraph');
        })();

        </script>

@endsection