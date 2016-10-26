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
        <br><br>

        <span class = "formSection">Layout</span>

        <br><br>
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

        <br><br>

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
        <br><br>

        <span class = "formLabel"><strong>Custom Layout</strong> (Select column type and input column and rows)</span>
        <br><br>
        <input type="radio" name="layout" value="single" checked><span class = "formLabel">Single Columns</span>
        <input type="radio" name="layout" value="double"><span class = "formLabel">Double Columns</span>
        <br><br>
        <span class = "formLabel">Columns: </span><input type = "text" name = "numColumns">&nbsp;
        <span class = "formLabel">Rows: </span><input type = "text" name = "numRows">
        <br><br><br>
        <span class = "formSection">Gender Pattern</span>
        <br><br>
        <div class = "genderGroup">
            <div class = "genderBox">
                <div class = "gender"><img alt="no gender" src="images/nogender.png"></div><br>
                <span class = "genderSelection">No Restriction</span><br>
                <input type="radio" name="gender" value="nogender" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="girls-boys" src="images/girl boy.png"></div><br>
                <span class = "genderSelection">Girls - Boys</span><br>
                <input type="radio" name="gender" value="girlsboys" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="boys-girls" src="images/boygirl.png"></div><br>
                <span class = "genderSelection">Boys - Girls</span><br>
                <input type="radio" name="gender" value="boysgirls" checked>
            </div>
            <div class = "genderBox">
                <div class = "gender"><img alt="alternated" src="images/everyother.png"></div><br>
                <span class = "genderSelection">Alternated</span><br>
                <input type="radio" name="gender" value="alternated" checked>
            </div>
        </div>
        <br>
        <span class = "formSection">Order</span>
        <br><br>
        <div class = "orderGroup">
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/alphabeticalhorizontal.png"></div><br>
                <span class = "genderSelection">Alphabetical Order (Horizontal)</span><br>
                <input type="radio" name="order" value="alphabetical" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical vertical" src="images/alphabeticalvertical.png"></div><br>
                <span class = "genderSelection">Alphabetical Order (Vertical)</span><br>
                <input type="radio" name="order" value="alphabetical" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="id horizontal" src="images/idhorizontal.png"></div><br>
                <span class = "genderSelection">ID Order (Horizontal)</span><br>
                <input type="radio" name="order" value="byid" checked>
            </div>
        </div>
        <br><br>
        <div class = "ordergroup">
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/idvertical.png"></div><br>
                <span class = "genderSelection">ID Order<br>(Vertical)</span><br>
                <input type="radio" name="order" value="byid" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/random.png"></div><br>
                <span class = "genderSelection">Random Order</span><br>
                <input type="radio" name="order" value="random" checked>
            </div>
            <div class="orderBox">
                <div class = "order"><img alt="alphabetical horizontal" src="images/manual.png"></div><br>
                <span class = "genderSelection">Manual Order</span><br>
                <input type="radio" name="order" value="manual" checked>
            </div>
            <br><br>
            <input class = "submitButton" type="submit" value="Generate Chart">
        </div>
    </form>
</body>
<?php
require "footer.php";
?>
