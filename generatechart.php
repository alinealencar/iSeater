<?php
$title = "iSeater - Generate Chart";
$user = "Aline";
require "head.php";
?>
    <body>
    <?php require "menu.php"; ?>
    <form id = "generateChartForm" action = "chartform.php" method = "post">
        <span class = "formLabel">Select a class: </span>
        <select name="class">
            <option value="1">1st grade</option>
            <option value="2">2nd grade</option>
            <option value="3">3rd grade</option>
        </select>
        <br><br><br><br>
        <span class = "formSection">Gender Pattern</span>
        <br><br>
        <div class = "genderGroup">
            <div class = "genderBox">
                <div class = "gender"><img alt="no gender" src="images/nogenderf.png"></div><br>
                <span class = "genderSelection">No Restriction</span><br>
                <input type="radio" name="gender" value="nogender" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="Girls - Boys" src="images/girlboyf.png"></div><br>
                <span class = "genderSelection">Girls - Boys</span><br>
                <input type="radio" name="gender" value="girlsboys" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="Boys - Girls" src="images/boygirlf.png"></div><br>
                <span class = "genderSelection">Boys - Girls</span><br>
                <input type="radio" name="gender" value="boysgirls" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="alternated" src="images/everyotherf.png"></div><br>
                <span class = "genderSelection">Alternated</span><br>
                <input type="radio" name="gender" value="alternated" checked>
            </div>
        </div>
        <br><br><br><br><br>
        <span class = "formSection">Order</span>
        <br><br>
        <div class = "orderGroup">
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/alphabeticalhorizontalf.png"></div><br>
                <span class = "genderSelection">Alphabetical Order<br>(Horizontal)</span><br>
                <input type="radio" name="order" value="alphabetical" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical vertical" src="images/alphabeticalverticalf.png"></div><br>
                <span class = "genderSelection">Alphabetical Order<br>(Vertical)</span><br>
                <input type="radio" name="order" value="alphabetical" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="id horizontal" src="images/idhorizontalf.png"></div><br>
                <span class = "genderSelection">ID Order<br>(Horizontal)</span><br>
                <input type="radio" name="order" value="byid" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/idverticalf.png"></div><br>
                <span class = "genderSelection">ID Order<br>(Vertical)</span><br>
                <input type="radio" name="order" value="byid" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/randomf.png"></div><br>
                <span class = "genderSelection">Random Order<br></span><br>
                <input type="radio" name="order" value="random" checked>
            </div>

            <!--<br><br>
            <div class = "ordergroup">-->

        </div>   <!--<div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/manualf.png"></div><br>
                <span class = "genderSelection">Manual Order<br></span><br>
                <input type="radio" name="order" value="manual" checked>
            </div>*/-->

        <br><br><br><br><br>

        <input class = "submitButton" type="submit" value="Generate Chart">
        <!--</div>-->
    </form>
    </body>
<?php
require "footer.php";
?>