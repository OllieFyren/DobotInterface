$(document).ready(function(){
    let $counter = 0;
    let $program = [];
    document.getElementById('count').innerHTML = '<p>' + $counter + '</p>';

    function buildProgramList() {
        $counter = $program.length;
        document.getElementById('programContainer').innerHTML = '';
        document.getElementById('count').innerHTML = '<p>' + $counter + '</p>';
        $program.forEach((element, index) => {
            if(element[0] === 1){
                return document.getElementById('programContainer').innerHTML +=
                    "<div class='waypoint'><p>Bevægelse til gemt position.</p>" +
                    "<button class='moveTo btn btn-info' data-index='" + index + "'>Udfør</button>" +
                    "<button class='waypointRemove btn btn-danger' data-index='" + index + "'>Fjern</button>" +
                    "</div>";
            }else if(element[0] === 0 && element[1] === 0) {
                return document.getElementById('programContainer').innerHTML +=
                    "<div class='waypoint'><p>Luk gripper</p><button class='moveTo btn btn-info' data-index='" + index + "'>Udfør</button><button class='waypointRemove btn btn-danger' data-index='" + index + "'>Fjern</button></div>";
            }else if(element[0] === 0 && element[1] === 1) {
                return document.getElementById('programContainer').innerHTML +=
                    "<div class='waypoint'><p>Åbn gripper</p><button class='moveTo btn btn-info' data-index='" + index + "'>Udfør</button><button class='waypointRemove btn btn-danger' data-index='" + index + "'>Fjern</button></div>";
            }
        })
    }

    //Function to add step to the program
    $('.add').click(async function() {
        let $temp = '';
        function getPosition(){
            return new Promise(resolve => {
                dobot.GetPose(function(pos) {
                    resolve($temp = [1, pos[0].toFixed(0), pos[1].toFixed(0), pos[2].toFixed(0)])
                })
            })
        }
        if($(this).hasClass('addToProgram')) {
            await getPosition();
        } else if($(this).hasClass('gripButton')) {
            $temp = [0, 0];
        } else if($(this).hasClass('releaseButton')) {
            $temp = [0, 1];
        }
        $program.push($temp);
        $('#count').effect('highlight', {color: '#39FF14'});
        document.getElementById('count').innerHTML = '<p>' + $counter + '</p>';
        buildProgramList()
    })

    //Function to remove step from the program
    $(document.body).on('click', '.waypointRemove', function(event){
        let index = event.target.dataset.index;
        $program.splice(index, 1);
        $('#count').effect('highlight', {color: '#FF2400'});
        buildProgramList()
    })

    //Function to toggle the program interface
    $('.toggle').click(function(){
        $('.program').toggleClass('enlarge');
        $(this).toggleClass('flipped');
    })

    //Prevent context menu on hold
    document.oncontextmenu = function() {
        return false;
    };

    //Function to execute single step in the program
    $(document.body).on('click', '.moveTo', function(event){
        let index = event.target.dataset.index;
        let step = $program[parseInt(index)];
        if(step[0] === 1){
            dobot.SetPTPCmd(1, parseInt(step[1]), parseInt(step[2]), parseInt(step[3]), 0, 0);
        } else if(step[0] === 0 && step[1] === 0) {
            dobot.SetEndEffectorGripper(1, 1, 0);
            setTimeout(function() {
                dobot.SetEndEffectorGripper(0, 1, 0);
            }, 1000);
        } else if(step[0] === 0 && step[1] === 1) {
            dobot.SetEndEffectorGripper(1, 0, 0);
            setTimeout(function() {
                dobot.SetEndEffectorGripper(0, 1, 0);
            }, 1000);
        }
    })

    //Function to toggle the program naming screen
    $('.saveProgram, .cancelName, .submitName').click(function() {
        $('.popupContainer, .namePopup').toggleClass("show");
    })

    //Function to toggle the load program screen and load programs
    $('.loadProgram').click(function() {
        $('.popupContainer, .loadPopup').toggleClass("show");
        $.ajax({
            url:"./components/loadProgram.php",
            success:function(data){
                document.getElementById('programList').innerHTML = '';
                document.getElementById('buttonContainer').innerHTML = '';
                if (!$.trim(data)) {
                    $('#programList').append('<p>Ingen gemte programmer fundet</p><button class="closeProgramLoad btn btn-primary">Luk</button>');
                    console.log('hello');
                } else {
                    let programList = JSON.parse(data);
                    for(const program of programList) {
                        $('#programList').append(
                            '<div class="programListItem"><h5 class="programListName">' + program.name + '</h5><button class="btn btn-primary selectProgram" data-id="' + program.id + '">Vælg</button></div>'
                        );
                    }
                    $('#buttonContainer').append(
                        '<button class="btn btn-warning closeProgramLoad">Annuller</button>'
                    )
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    //Function to load selected program
    $(document.body).on('click', '.selectProgram', function(event){
        let programId = event.target.dataset.id;
        $.ajax({
            type:"POST",
            url:"./components/loadProgramSteps.php",
            data: { id: programId },
            success:function(data){
                let tempArray = JSON.parse(data);
                $program = [];
                for(const item of tempArray) {
                    if (item['type'] === "1") {
                        let progArray = [parseInt(item['type']), item['x_coordinate'], item['y_coordinate'], item['z_coordinate']];
                        $program.push(progArray);
                    } else if (item['grip_status'] === "0"){
                        let progArray = [0, 0];
                        $program.push(progArray);
                    } else {
                        let progArray = [0, 1];
                        $program.push(progArray);
                    }
                }
                buildProgramList()
                $('.popupContainer, .loadPopup').toggleClass("show");
            },
            error: function(err) {
                console.log(err);
                $('.popupContainer, .loadPopup').toggleClass("show");
            }
        })
    });

    //Function to close load program screen
    $(document.body).on('click', '.closeProgramLoad', function(){
        $('.popupContainer, .loadPopup').toggleClass("show");
    });

    //Function calling php script to save current program
    $('.submitName').click(function() {
        let programData = $program;
        let name = $('.nameInput').val();
        $.ajax({
            type:"POST",
            url:"./components/saveProgram.php",
            data: {'dataArray' : programData, 'name': name },
            success:function(message){
                console.log(message);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    //Function to run current program
    $('.startProgram').click(async function() {
        for(const element of $program) {
            if(element[0] === 1) {
                dobot.SetPTPCmd(1, parseInt(element[1]), parseInt(element[2]), parseInt(element[3]), 0, 1);
                dobot.SetWAITCmd(1000, 1);
            } else if(element[0] === 0 && element[1] === 0){
                dobot.SetEndEffectorGripper(1, 1, 1);
                dobot.SetWAITCmd(1000, 1);
                dobot.SetEndEffectorGripper(0, 1, 1);
                dobot.SetWAITCmd(1000, 1);
            } else if(element[0] === 0 && element[1] === 1) {
                dobot.SetEndEffectorGripper(1, 0, 1);
                dobot.SetWAITCmd(1000, 1);
                dobot.SetEndEffectorGripper(0, 1, 1);
                dobot.SetWAITCmd(1000, 1);
            }
        }
    })
})
