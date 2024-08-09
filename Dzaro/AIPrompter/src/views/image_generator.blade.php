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
        transition: all 0.3s ease-out;
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
        font-size: clamp(20px, 30px, 1.5vw);
        transition: opacity 0.2s ease-in-out, transform 0.5s ease-in-out;
    }

    #mainContainer > #inputMainContainer {
        width:100%;
        display:flex;
        align-items:center;
        flex-direction: column;
    }

    #mainContainer > #inputMainContainer > #inputContainer {
        width:70%;
        display:flex;
        justify-content:center;
        align-items: start;
    }

    #mainContainer > #inputMainContainer > #inputContainer > textarea {
        appearance: none;
        background-color: transparent;
        width:100%;
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

    #mainContainer > #inputMainContainer > #inputContainer > i {
        font-size:30px;
        transform:translateY(-8px);
        background-image: radial-gradient(
            circle at center,
            var(--myColor1) 0,
            transparent 60%
        );
        transition: --myColor1 0.1s;
    }
    
    #mainContainer > #inputMainContainer > #inputContainer > i:hover {
        cursor:pointer;
        animation:slideRight 0.5s;
        --myColor1: rgb(213, 213, 213);
    }

    #mainContainer > #inputMainContainer > #inputOptions {
        width:70%;
        display:flex;
        gap:20px;
    }

    #mainContainer > #inputMainContainer > #inputOptions > div {
        display:flex;
        align-items:center;
        gap:5px;
    }

    #mainContainer > #inputMainContainer > #inputOptions > div p {
        margin:0;
        padding:0;
        font-size:12px;
    }

    #mainContainer > #inputMainContainer > #inputOptions > div:nth-child(1) > input {
        font-family: 'Poppins', sans-serif;
        width:20px;
        height:20px;
        border:none;
        text-align:center;
        border-radius:1000000px;
        background-color:rgb(224, 224, 224);
        outline:none;
        box-shadow:inset 0px 0px 2px 0px rgba(0, 0, 0, 0.2);
        font-weight:300;
    }

    #mainContainer > #inputMainContainer > #inputOptions > div:nth-child(2) > div {
        font-family: 'Poppins', sans-serif;
        height:20px;
        border:none;
        text-align:center;
        border-radius:1000000px;
        background-color:rgb(224, 224, 224);
        outline:none;
        box-shadow:inset 0px 0px 2px 0px rgba(0, 0, 0, 0.2);
        font-weight:300;
        padding:1px 5px 1px 5px;
        display:flex;
        align-items:center;
        justify-content: center;
        gap:3px;
        user-select:none;
    }

    #mainContainer > #inputMainContainer > #inputOptions > div:nth-child(2) > div > div {
        width:40px;
        height:16px;
        border-radius:100000px;
        cursor:pointer;
        font-weight:300;
        font-size:12px;
        transition: background-color 0.1s ease-in-out;
    }

    #responseDiv { /* TODO style scrollbar */
        min-height:100px;
        height:100px;
        overflow-y:auto;
        width:70%;
        transition:height 0.3s ease-in-out;
        display:flex;
        flex-direction: column;
        align-items:center;
        gap:50px;
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

    #responseDiv #responseDivSaveImages {
        width:100%;
        display:none;
        gap:10px;
        align-items:center;
    }

    #responseDiv #responseDivSaveImages p {
        margin:0;
        padding:0;
        text-wrap:none;
        white-space:nowrap;
    }

    #responseDiv #responseDivSaveImages #saveInputContainer {
        display:flex;
        align-items:center;
        width:100%;
        gap:10px;
    }

    #responseDiv #responseDivSaveImages #saveInputContainer input {
        appearance:none;
        -webkit-appearance: none;
        -moz-appearance: none;
        font-family:monospace;
        background-color: transparent;
        width:100%;
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

    #responseDiv #responseDivSaveImages #saveInputContainer i {
        font-size:20px;
        -webkit-text-stroke:0.4px;
        background-image: radial-gradient(
            circle at center,
            var(--myColor1) 0,
            transparent 60%
        );
        transition: --myColor1 0.1s;
    }

    #responseDiv #responseDivSaveImages #saveInputContainer i:hover {
        cursor:pointer;
        animation: jump 0.5s;
        --myColor1: rgb(213, 213, 213);
    }

    #responseDiv #responseDivImages {
        width:100%;
        display:flex;
        justify-content: center;
        gap:20px;
        flex-wrap:wrap;
    }

    .activeImageSize {
        background-color:white;
    }

    /* remove arrows from input type number */
    /* Chrome, Safari, Edge, Opera */
    input:is(#mainContainer > #inputMainContainer > #inputOptions > div:nth-child(1) > input)::-webkit-outer-spin-button,
    input:is(#mainContainer > #inputMainContainer > #inputOptions > div:nth-child(1) > input)::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input:is(#mainContainer > #inputMainContainer > #inputOptions > div:nth-child(1) > input)[type=number] {
        appearance: textfield;
        -moz-appearance: textfield;
    }

    @property --myColor1 {
        syntax: '<color>';
        initial-value: transparent;
        inherits: false;
    }

    @keyframes jump {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-3px); }
        100% { transform: translateY(0px); }
    }

    @keyframes slideRight {
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
                <h2>Take your imagination to another level and get this prompt rolling!</h2>
            </div>
        </div>
        <div id="inputMainContainer"> <!-- div for aligning prompt input and options vertically -->
            <div id="inputContainer"> <!-- div for aligning textarea and arrow horizontally -->
                <div></div> <!-- invisible div for making flex items position correctly -->
                <textarea id="promptInput" placeholder="Type something and watch magic happens..." oninput='if(this.scrollHeight < 300) {this.style.height = "";this.style.height = this.scrollHeight - 4 + "px"}'></textarea>
                <i onclick="askAI()" class="bi bi-arrow-right-short"></i>
            </div>
            <div id="inputOptions"> <!-- container for options: image size and images amount -->
                <div>
                    <p>How many:</p>
                    <input id="imagesAmount" type="number" value="1" min="1" max="10">
                </div>
                <div>
                    <p>Size:</p>
                    <div>
                        <div class="sizeOption activeImageSize">256</div>
                        <div class="sizeOption">512</div>
                        <div class="sizeOption">1024</div>
                    </div>
                    <p>px</p>
                </div>
            </div>
        </div>
        <div id="responseDiv"> <!-- invisible div for making flex items position correctly, after asking AI it becomes container for AI response -->
            <div id="loadingContainer">
                <div class="loadingDot"></div>
                <div class="loadingDot"></div>
                <div class="loadingDot"></div>
            </div>
            <div id="responseDivSaveImages">
                <p>Save images to storage: </p>
                <div id="saveInputContainer">
                    <input id="saveInput" type="text" placeholder="Path to folder where images will be saved">
                    <i onclick="saveImages()" class="bi bi-download"></i>
                </div>
            </div>
            <div id="responseDivImages"></div>
        </div> 
    </div>

    <script>

        /* all variables in script */
        const titleWrapper = document.getElementById('titleWrapper');
        const title = document.querySelector('#titleWrapper h2');

        const promptInput = document.getElementById('promptInput');
        const loadingContainer = document.getElementById('loadingContainer');
        const sizeOptions = document.getElementsByClassName('sizeOption');
        const imagesAmountInput = document.getElementById('imagesAmount');

        const responseDiv = document.getElementById('responseDiv');
        const responseDivImages = document.getElementById('responseDivImages');
        const responseDivSaveImages = document.getElementById('responseDivSaveImages');
        const responseDivSaveImagesInput = document.getElementById('saveInput');

        let isStyled = false;
        let imageSize = 256;
        let imagesAmount = 1;
        let images = [];

        /* add event listeners */
        promptInput.addEventListener('keypress', listenForEnter);
        Array.from(sizeOptions).forEach(option => option.addEventListener('click', setNewSize));
        imagesAmountInput.addEventListener('input', updateImagesAmount);
        imagesAmountInput.addEventListener('focusout', checkImagesAmount);

        /* listening for enter in textarea */
        function listenForEnter(event) {
            if(event.keyCode === 13) {
                event.preventDefault();
                askAI();
            }
        }

        /* set new amount of images if user types in images amount input */
        function updateImagesAmount() {
            imagesAmount = parseInt(imagesAmountInput.value);
        }

        /* when user leaves images amount input validate the new value */
        function checkImagesAmount() {
            if(isNaN(imagesAmount) || imagesAmount < 1) {
                imagesAmountInput.value = 1;
            }
            else if(imagesAmount > 10) {
                imagesAmountInput.value = 10;
            }
        }

        /* set new Size of images on click of any size option */
        function setNewSize(e) {
            imageSize = parseInt(e.target.innerHTML);
            Array.from(sizeOptions).forEach(option => option.classList.remove('activeImageSize'));
            e.target.classList.add('activeImageSize');
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

        function saveImages() {
            const storagePath = saveInput.value;

            $.ajax({
                type:'POST',
                url:'{{ route("AIPrompter_save_images") }}',
                data:{storagePath:storagePath,images:images},
                success:function(data) {
                    if(data.success) {
                        console.info("Images saved to: ", data);
                    }
                    else {
                        console.error("Error saving images: ", data);
                    }
                },
                error:function(error) {
                    console.error("Error saving images: ", error);
                }
            });
        }
        
        /* send ajax with user prompt to laravel route and return AI response */
        function askAI() {
            /* check if input is empty */
            if(promptInput.value === "") {
                console.warn("Input for prompt cannot be empty!");
                return;
            }

            /* clear prompt after sending message */
            let prompt = promptInput.value;
            promptInput.value = "";

            /* some style... */
            if(!isStyled) {
                styleContainer()
            }
            responseDivImages.style.display = "none";
            loadingContainer.style.display = "flex";

            /* the ajax itself */
            $.ajax({ /* TODO make ajax get error response */
                type:'POST',
                url:"{{ route('AIPrompter_generate_images') }}",
                data:{prompt:prompt, imageSize:imageSize, imagesAmount:imagesAmount},
                success:function(data){
                    /* displaying response data */
                    console.log(data)
                    console.info("images successfully obtained: ", data.success.data.data);
                    console.info("path to save images: ", data.success.storagePath);

                    /* putting storage path into saveInput */
                    responseDivSaveImagesInput.value = data.success.storagePath;

                    /* displaying ai answer */
                    loadingContainer.style.display = "none";
                    responseDivImages.innerHTML = "";
                    responseDivImages.style.display = "flex";
                    responseDivSaveImages.style.display = "flex";
                    
                    let response = data.success.data.data;
                    Array.from(response).forEach((image) => {
                        responseDivImages.innerHTML += `<img src="${image.url}" alt="AI generated image" style="width:256px;height:256px;">`;
                        images.push(image.url);
                    })

                }
            });
        }

        </script>

@endsection