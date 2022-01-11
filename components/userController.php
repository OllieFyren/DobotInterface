<h2>Program</h2>
<div class="gripContainer">
    <div class="grip">
        <button class="addToProgram add btn btn-success" data-type="0"><p>Gem position</p></button>
        <button class="gripButton add gButton btn btn-success" data-type="1"><p>Luk gripper</p></button>
        <button class="releaseButton add gButton btn btn-success" data-type="2"><p>Åbn gripper</p></button>
    </div>
</div>
</div>
</div>
</div>
    <div class="program">
        <div class="innerDiv">
            <div class="toggle"><i class="fas fa-sort-up"></i></div>
            <div id="count"></div>
            <div id="programContainer"></div>
            <div id="programControl">
                <button class="controlButton startProgram btn btn-primary">Kør program</button>
                <br>
                <button class="controlButton saveProgram btn btn-primary">Gem program</button>
                <button class="controlButton loadProgram btn btn-primary">Load program</button>
            </div>
        </div>
    </div>
<div class="popupContainer">
    <div class="namePopup">
        <h4>Navngiv programmet</h4>
        <input type="text" placeholder="Indtast navn" class="nameInput form-control">
        <button class="submitName btn btn-primary">Gem</button>
        <button class="cancelName btn btn-warning">Annuller</button>
    </div>
    <div class="loadPopup">
        <h4>Vælg program</h4>
        <div id="programList"></div>
        <div id="buttonContainer"></div>
    </div>
</div>

