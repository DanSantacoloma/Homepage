<!DOCTYPE html>
<HTML>

<HEAD>
    <title>Startpage</title>
    <meta name="viewport" content="width=device-width, initial-scale">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="View/Styles/styles.css">

</HEAD>

<BODY>

    <div id="Header">
        <h1>Hello, Daniel.</h1>
    </div>
    <div id="Content">
        <div id="LeftC">
            <div id="Work">
                <div id="Wheader">
                    <H2 id="WorkHeader">Work & Study</H2>
                </div>
                <div id="Wcontainer">
                    <ul id="Wlist_1">
                        <li><a href="https://outlook.office.com/mail/">Outlook</a></li>
                        <li><a href="https://www.usc.edu.co/">College</a></li>
                        <li><a href="https://www.udemy.com/">Udemy</a></li>
                    </ul>
                    <ul id="Wlist_2">
                        <li><a href="https://www.hackerrank.com/">HackerRank</a></li>
                        <li><a href="https://chatgpt.com/?oai-dm=1">ChatGPT</a></li>
                        <li><a href="https://www.linkedin.com/in/daniel-santacoloma-naranjo-470863174/">LinkedIn</a></li>
                    </ul>
                    <ul id="Wlist_3">
                        <li><a href="https://aulas.generaciontic.gov.co/login/index.php">MINTIC</a></li>
                        <li><a href="https://github.com/DanSantacoloma">GITHUB</a></li>
                    </ul>
                </div>
            </div>
            <div id="Chill">
                <div id="Ch">
                    <h2>Chill</h2>
                </div>
                <div id="Ccont">
                    <ul id="Clist1">
                        <li><a href="https://4chan.org/">4chan</a></li>
                        <li><a href="https://www.amazon.com/">Amazon</a></li>
                        <li><a href="https://www.youtube.com/">Youtube</a></li>
                    </ul>
                    <ul id="Clist2">
                        <li><a href="https://www.primevideo.com/-/es/offers/nonprimehomepage/ref=atv_dp_mv_c_9zZ8D2_hom?language=es">Prime</a></li>
                        <li><a href="https://www.netflix.com/co/">Netflix</a></li>
                        <li><a href="https://www3.animeflv.net/">AnimeFLV</a></li>
                    </ul>
                </div>
            </div>
            <div id="SN">
                <div id="SH">
                    <h2>Social Networks</h2>
                </div>
                <div id="Scont">
                    <ul id="Slist1">
                        <li><a href="https://www.facebook.com/">Facebook</a></li>
                        <li><a href="https://web.whatsapp.com/">Whatsapp</a></li>
                        <li><a href="https://www.Reddit.com/">Reddit</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="CenterC">
            <div id="Date">

                <div id="TopDate">
                    <h2 id="Day">
                    </h2>
                    <h3 id="DateTime">
                    </h3>
                </div>
                <div id="BotDate">
                    <ul>

                        <li><img src="Startpage/images/col.png" alt="Startpage\images\col.png">
                            <h5 id="Time"></h5>
                        </li>
                        <li><img id="chileFlag" src="Startpage/images/Chile.png" alt="Startpage\images\Chile.png">
                            <h5 id="TimeChile"></h5>
                        </li>
                        <li><img src="Startpage/images/Israel.png" alt="Startpage\images\Israel.png">
                            <h5 id="TimeIsrael"></h5>
                        </li>
                    </ul>

                </div>
            </div>
            <div id="empty">
                <iframe WIDTH="100%" HEIGHT="100%" src="https://www.youtube.com/embed/videoseries?si=laXQH0lZ0Jz13x_e&amp;list=PL4WlxAYJ91DuoxL3LVU4BN1KDAt-BAsXK" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        <div id="RightC">
            <div id="Search">
                <img src="Startpage/images/google.png" alt="google" id="Google">
                <input type="text" placeholder="Search..." id="search-input">

            </div>
            <div id="List">
                <div id="inputBar">

                    <button type="button" id="NewTaskButton">Add New Task</button>

                    <!-- <img src="Startpage\images\floppy-disk.png" alt="Save" id="Save"> -->

                </div>
                <div id="UList" class="custom-scroll">
                    <div class="list-group">
                        <?php
                        // Correct relative paths from the root directory
                        include_once('Controller/dbconnection.php');
                        include_once('Model/activity.php');

                        $tasks = new Activity($conn);
                        $existingTasks = $tasks->fetchAll();


                        if ($existingTasks) {
                            foreach ($existingTasks as $task) {
                                $activityId = htmlspecialchars($task['ID']);
                                echo '<a href="View/editActivity.php?id=' . $activityId . '" class="list-group-item list-group-item-action flex-column align-items-start editTaskLink" id="editTask" >';
                                echo '<div class="row w-100">';
                                echo '<div class="col-8">'; // Left side column
                                echo '<h6 class="mb-1" style="font-size: 15px;">' . htmlspecialchars($task['Title']) . '</h6>';
                                echo '<p class="mb-1" style="font-size: 10px;">' . htmlspecialchars($task['Customer']) . '</p>';
                                echo '<small class="text-muted" style="font-size: 8px;">Additional info here</small>';
                                echo '</div>';
                                echo '<div class="col-4 text-right d-flex flex-column justify-content-between align-items-end">'; // Right side column
                                echo '<small class="text-muted" style="font-size: 10px;">' . htmlspecialchars($task['DueDate']) . '</small>';
                                echo '<button class="btn btn-dark mark-done" data-task-id="' . $activityId . '" style="width: 7vh; height: 3vh; display: flex; justify-content: center; align-items: center; font-size: 10px;" onclick="event.stopPropagation();">Done</button>'; // Button at the bottom right corner
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                            }
                        } else {
                            echo '<p>No tasks found. Hurray!</p>';
                        }
                        ?>



                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="Scripts/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</BODY>

</HTML>