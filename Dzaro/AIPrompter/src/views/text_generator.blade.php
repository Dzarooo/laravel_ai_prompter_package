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
        justify-content: space-between;
        gap:1%;
        border-width: 3px;
        border-style: solid;
        border-image:
        linear-gradient(
            transparent 0%,
            rgb(177, 41, 255) 50%,
            transparent 100%
        ) 1 100%;
    }

    #mainContainer > #titleWrapper {
        display: grid;
        grid-template-rows: 1fr;
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
    }

    #mainContainer > #titleWrapper > div {
        display: flex;
        justify-content: center;
        overflow-x: scroll; 
        scrollbar-width: none; 
        -ms-overflow-style: none; 
        scroll-behavior: smooth;
    }

    #mainContainer > #titleWrapper h2 {
        width:70%;
        text-align: center;
        height:100px;
        transition: all 0.3 ease-in-out;
        font-size: clamp(20px, 30px, 1.5vw);
        transition: opacity 0.2s, transform 0.5s;
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
        display:flex;
        justify-items:center;
    }

    #responseDiv > p {
        width:100%;
        display:none;
    }

    #responseDiv #loadingContainer {
        display:none;
        justify-content: center;
        align-items: center;
        gap:7px;
        width:100%;
        height:100%;
    }

    #responseDiv #loadingContainer .loadingDot {
        width:20px;
        height:20px;
        background-color:rgb(191, 191, 191);
        border-radius: 50%;
        opacity:0;
        scale:50%;
    }

    #responseDiv #loadingContainer .loadingDot:nth-child(1) {
        animation: loadingDot 1s ease-in-out infinite;
        animation-delay: 0s;
    }

    #responseDiv #loadingContainer .loadingDot:nth-child(2) {
        animation: loadingDot 1s ease-in-out infinite;
        animation-delay: 0.25s;
    }

    #responseDiv #loadingContainer .loadingDot:nth-child(3) {
        animation: loadingDot 1s ease-in-out infinite;
        animation-delay: 0.5s;
    }

    pre:has(code) {
        background-color:rgb(224, 224, 224);
        box-shadow:inset 0px 0px 2px 0px rgba(0, 0, 0, 0.2);
        border-radius:5px;
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

    @keyframes loadingDot {
        0% { opacity:0; scale:50% }
        25% { opacity:1; scale:100% }
        75% { opacity:0; scale:50% }
        100% { opacity:0; scale:50% }
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
        <div id="titleWrapper">
            <div>
                <h2>Take your imagination to another level and write unlimited resources!</h2>
            </div>
        </div>
        <div id="inputContainer"> <!-- div for aligning textarea and arrow horizontally -->
            <div></div> <!-- invisible div for making flex items position correctly -->
            <textarea id="promptInput" placeholder="Type something and watch magic happens..." oninput='if(this.scrollHeight < 300) {this.style.height = "";this.style.height = this.scrollHeight - 4 + "px"}'></textarea>
            <i onclick="askAI()" class="bi bi-arrow-right-short"></i>
        </div>
        <div id="responseDiv"> <!-- invisible div for making flex items position correctly, after asking AI it becomes container for AI response -->
            <div id="loadingContainer">
                <div class="loadingDot"></div>
                <div class="loadingDot"></div>
                <div class="loadingDot"></div>
            </div>
            <div id="responseParagraph"></div>
        </div> 
    </div>

    <script>
        /* all variables in script */
        const messages = [];
        const responseDiv = document.getElementById('responseDiv');
        const responseParagraph = document.getElementById('responseParagraph');
        const promptInput = document.getElementById('promptInput');
        const titleWrapper = document.getElementById('titleWrapper')
        const title = document.querySelector('#titleWrapper h2');
        const loadingContainer = document.getElementById('loadingContainer');
        let isStyled = false;
        promptInput.addEventListener('keypress', listenForEnter);

        /* listening for enter in textarea */
        function listenForEnter(event) {
            if(event.keyCode === 13) {
                event.preventDefault();
                askAI();
            }
        }

        /* style container (remove title) when user give prompt the first time */
        function styleContainer() {
            titleWrapper.style.gridTemplateRows = "0fr";
            title.style.opacity = 0;
            title.style.transform = "translateY(-100px)";
            responseDiv.style.height = "100%";

            /* prevent askAI function to going into this function all over again */
            isStyled = true;
        }
        
        /* send ajax with user prompt to laravel route and return AI response */
        function askAI() {
            /* clear prompt after sending message */
            let prompt = promptInput.value;
            promptInput.value = "";

            /* some style... */
            if(!isStyled) {
                styleContainer()
            }
            responseParagraph.style.display = "none";
            loadingContainer.style.display = "flex";

            /* updating messages table */
            messages.push({
                "content": prompt,
                "role": "user"
            })
            console.log(messages);

            /* the ajax itself */
            $.ajax({
                type:'POST',
                url:"{{ route('AIPrompter_generate_text') }}",
                data:{prompt:prompt, messages:messages},
                success:function(data){
                    console.log(data.success);
                    /* updating messages table */
                    messages.push({
                        "content": data.success.content,
                        "role": "assistant"
                    })
                    /* display AI response */
                    loadingContainer.style.display = "none";
                    responseParagraph.style.display = "block";
                    responseParagraph.innerHTML = data.success.content; /*  TODO format AI response for \n, ###, ** etc. */
                }
            });
        }

        </script>

@endsection