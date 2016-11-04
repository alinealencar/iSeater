<?php
$title = "iSeater - Generate Chart";
$username = "Aline";
require "head.php";
require "menu.php";
?>
    <body>
    <form id = "generateChartForm" action = "chartform.php" method = "post">
        <span class = "formLabel">Select a class: </span>
        <select name="class">
            <option value="1">1st grade</option>
            <option value="2">2nd grade</option>
            <option value="3">3rd grade</option>
        </select>
        <br><br><br><br>

        <span class = "formSection">Layout</span>

        <br><br><br>
        <span class = "formLabel"><strong>Single Column</strong> (columns x rows (max seats))</span>
        <br><br>
        <div class = "layoutGroup">
            <div class = "layoutBox">
                <div class = "layout">5 x 6 (30)</div><br>
                <input type="radio" name="layout" value="fivesix" checked>
            </div>
            <div class = "layoutBox">
                <div class = "layout">5 x 7 (35)</div><br>
                <input type="radio" name="layout" value="fiveseven" checked>
            </div>
            <div class = "layoutBox">
                <div class = "layout">5 x 8 (40)</div><br>
                <input type="radio" name="layout" value="fiveeight" checked>
            </div>
        </div>
        <br>
        <div class = "layoutGroup">
            <div class = "layoutBox">
                <div class = "layout">6 x 5 (30)</div><br>
                <input type="radio" name="layout" value="sixfive" checked>
            </div>
            <div class = "layoutBox">
                <div class = "layout">6 x 6 (36)</div><br>
                <input type="radio" name="layout" value="sixsix" checked>
            </div>
            <div class = "layoutBox">
                <div class = "layout">6 x 7 (42)</div><br>
                <input type="radio" name="layout" value="sixseven" checked>
            </div>
        </div>

        <br><br><br>

        <span class = "formLabel"><strong>Double Column</strong> (columns x rows (max seats))</span>
        <br><br>
        <div class = "layoutGroup">
            <div class = "layoutBox">
                <div class = "layout">3 x 6 (18)</div><br>
                <input type="radio" name="layout" value="threesix" checked>
            </div>
            <div class = "layoutBox">
                <div class = "layout">4 x 4 (32)</div><br>
                <input type="radio" name="layout" value="fourfour" checked>
            </div>
            <div class = "layoutBox">
                <div class = "layout">4 x 5 (40)</div><br>
                <input type="radio" name="layout" value="fourfive" checked>
            </div>
        </div>
        <br><br><br>

        <span class = "formLabel"><strong>Custom Layout</strong> (Select column type and input column and rows)</span>
        <br><br>
        <input type="radio" name="layout" value="single" checked><span class = "formLabel">Single Columns</span>
        <input type="radio" name="layout" value="double"><span class = "formLabel">Double Columns</span>
        <br><br>
        <span class = "formLabel">Columns: </span>
        <select>
            <option value="0">-</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
        </select>
        <span class = "formLabel">Rows: </span>
        <select>
            <option value="0">-</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
        </select>
        <br><br><br>
        <span class = "formSection">Gender Pattern</span>
        <br><br>
        <div class = "genderGroup">
            <div class = "genderBox">
                <div class = "gender"><img alt="no gender" src="images/nogenderf.png"></div><br>
                <span class = "genderSelection">No Restriction</span><br>
                <input type="radio" name="gender" value="nogender" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="girlboy" src="images/girlboy.png"></div><br>
                <span class = "genderSelection">Girls - Boys</span><br>
                <input type="radio" name="gender" value="girlsboys" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="boygirl" src="images/boygirl.png"></div><br>
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
                <div class = "order"><img alt="alphabetical horizontal" src="images/randomf.png"></div><br>
                <span class = "genderSelection">Random Order<br></span><br>
                <input type="radio" name="order" value="random" checked>
            </div>
        </div>
        <br><br>
        <div class = "ordergroup">
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
                <div class = "order"><img alt="alphabetical horizontal" src="images/manualf.png"></div><br>
                <span class = "genderSelection">Manual Order<br></span><br>
                <input type="radio" name="order" value="manual" checked>
            </div>

            <br><br><br><br><br>

            <input class = "submitButton" type="submit" value="Generate Chart">
        </div>
    </form>
    </body>
<?php
require "footer.php";
?>
