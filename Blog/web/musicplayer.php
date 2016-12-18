<?php
     
    
    function renderPlayer($tune){
        
        if(empty($tune)){
            exit;
        }
        
        $genres = explode(', ', $tune['genre']);
        
        echo "<div class=\"player-container\">";
            echo "<div class=\"player\">";
                echo "<div class=\"player-control\">";
                    echo "<div class=\"primary-control\">";
                        echo "<a id=\"play-button-" . $tune['id'] . "\" title=\"Play button\" class=\"play-button\"></a>";
                    echo "</div>";

                        echo  "<div class=\"secondary-control\">;

                               <div onclick=\"wavesurfer.pause()\" class=\"stop-button\">

                                </div>

                                <div onclick=\"wavesurfer.stop()\" class=\"pause-button\">

                                </div>

                            </div>
                        </div>
                        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js\"></script>
                        <div class=\"main-control\">
                            <div class=\"track-info\">" 
                                . $tune['artist'] . " - " . $tune['title'] .
                            "</div>
                            <progress id=\"progress\" class=\"progress\" value=\"100\" max=\"100\"></progress>
                            <div id=\"waveform-" . $tune['id'] . "\" class=\"wavesurfer\">
                            </div>
                        </div>
                    </div>
                    <div class=\"player-bottom\">
                        <div class=\"genre-tags-container\">
                            <ul class=\"genre\">";

                            foreach($genres as $genre){
                             echo "<li><a class=\"genreTag\" href=\"#\">" . $genre . "</a></li>";
                            }
                    echo "</ul>";
                    echo "</div>
                        <div class=\"tune-control\">
                            <a id=\"delete-tune\" class=\"button-delete-tune\"><span></span></a>
                            <a id=\"add-to-playlist\" class=\"button-add-to-playlist\"><span id=\"add-to-playlist-span\" class=\"" . $tune['id'] ."\"></span></a>
                            <a id=\"listen\" class=\"button-listen\"><span></span></a>
                        </div>
                    </div>
                </div>
                <script>
                    var wavesurfer" . $tune['id'] . " = WaveSurfer.create({
                        container: " . "'#waveform-" . $tune['id'] . "'" . ",
                        waveColor: '#E8E8E8',
                        height: '100',
                        progressColor: '#40D4A2',
                        backend: 'MediaElement',
                        barWidth: 3,

                    });

                    wavesurfer" . $tune['id'] . ".load(\"" . $tune['path'] . "\");

                    wavesurfer" . $tune['id'] . ".on('loading', function(percents) {
                        document.getElementById('progress').value = percents;
                    });

                    $(\"#play-button-" . $tune['id'] . "\"" . ").on(\"click\", function() {
                        wavesurfer" . $tune['id'] . ".play();
                    });
    
                    
                    $('." . $tune['id'] . "').click(function(){
                        $.ajax({
                        
                        type: \"POST\",
                        url: 'add-to-playlist.php',
                        data: tuneID =" . $tune['id'] . ",
                        success: function() {
                            $('.". $tune['id'] ."').toggleClass('added');
                        },
                        error: function() {
                        window.alert('Our service is not available at the moment. Please, try a few minutes later');
                        }
            
                        });
                    });

                </script>";
    }