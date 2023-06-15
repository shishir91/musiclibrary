<head>
    <style>
        h2 {
            color: gray;
            font-weight: bold;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            max-width: 960px;
            margin: 0 auto;
        }

        .card {
            width: 190px;
            height: 254px;
            /* background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%); */
            border-radius: 20px;
            transition: all .3s;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card2 {
            width: 190px;
            height: 254px;
            background-color: #1a1a1a;
            border-radius: 0px;
            transition: all .2s;
            position: relative;
        }

        .card2 img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }




        .card2:hover,
        img:hover {
            /* transform: scale(0.98); */
            border-radius: 20px;

        }

        .card:hover {
            box-shadow: 0px 0px 30px 1px rgba(0, 255, 117, 0.30);
        }


        .card2 audio {
            width: 100%;
            height: 100%;
        }

        .card2 audio::-webkit-media-controls-panel {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
        }

        .card2 audio::-webkit-media-controls-volume-slider {
            height: 5px;
        }

        .card2 audio::-webkit-media-controls-timeline {
            position: relative;
            top: -15px;
            left: -85px;
            height: 5px;
            width: 100px;
        }

        .card2 audio::-webkit-media-controls-current-time-display,
        .card2 audio::-webkit-media-controls-time-remaining-display {
            position: relative;
            left: 13px;
        }

        .card2 audio::-webkit-media-controls-play-button,
        .card2 audio::-webkit-media-controls-current-time-display,
        .card2 audio::-webkit-media-controls-time-remaining-display,
        .card2 audio::-webkit-media-controls-volume-slider {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<h2>NOW TRENDING</h2>
<div class="card-container">
    <div class="card">
        <div class="card2">
            <img src="https://i.pinimg.com/originals/54/16/61/5416615fc37cfcf889c945478909129f.jpg" alt="" width="100%">
            <audio controls>
                <source src="./media/System_Of_A_Down_-_B.Y.O.B._(Video).mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <h3>System_Of_A_Down</h3>
            <p>B.Y.O.B.</p>
        </div>
    </div>
    <div class="card">
        <div class="card2">
            <img src="https://upload.wikimedia.org/wikipedia/en/e/eb/Iron_Maiden_-_Fear_Of_The_Dark.jpg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/Iron_Maiden_-_Fear_Of_The_Dark_Lyrics_(HD).mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
    <div class="card">
        <div class="card2">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/ACDC_Back_in_Black_cover.svg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/AC_DC_-_Back_In_Black__Official_Music_Video_.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>

    <div class="card">
        <div class="card2">
            <img src="https://i.pinimg.com/originals/54/16/61/5416615fc37cfcf889c945478909129f.jpg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/System_Of_A_Down_-_Chop_Suey!.m4a" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
    <div class="card">
        <div class="card2">
            <img src="https://upload.wikimedia.org/wikipedia/en/e/eb/Iron_Maiden_-_Fear_Of_The_Dark.jpg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/Iron_Maiden_-_Blood_Brothers.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
    <div class="card">
        <div class="card2">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/ACDC_Back_in_Black_cover.svg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/AC_DC_-_Highway_to_Hell_Lyrics_HQ.m4a" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>

    <div class="card">
        <div class="card2">
        <img src="https://i.pinimg.com/originals/54/16/61/5416615fc37cfcf889c945478909129f.jpg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/System_of_a_Down_-_I-E-A-I-A-I-O_Lyrics.m4a" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
    <div class="card">
        <div class="card2">
        <img src="https://upload.wikimedia.org/wikipedia/en/e/eb/Iron_Maiden_-_Fear_Of_The_Dark.jpg" alt="Description of image" width="100%">
            <audio controls>
                <source src="./media/IRON_MAIDEN_-_Hallowed_Be_Thy_Name_[Lyrics].mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</div>

<script>
    const audioElements = document.querySelectorAll("audio");

    audioElements.forEach((audioElement) => {
        audioElement.addEventListener("play", () => {
            audioElements.forEach((otherAudioElement) => {
                if (otherAudioElement !== audioElement) {
                    otherAudioElement.pause();
                }
            });
        });
    });
</script>