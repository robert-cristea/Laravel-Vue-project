<template>
    <div class="row">
        <h2>{{ criteriaTitle }}</h2>
        <h2>{{ subCriteriaTitle }}</h2>
        <h3>{{ superSubCriteriaTitle }}</h3>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>

        <div class="col-12">
            <table class="table table-sm">
                <tr>
                    <th>Criteria</th>
                    <th>Sub-criteria</th>
                    <th>Super sub-criteria</th>
                    <th colspan="2">Work done</th>
                    <th colspan="2" v-if="authUser.role != 'concessionaire'">Scope 1</th>
                    <th v-if="authUser.role != 'concessionaire'">Scope 2</th>
                    <th colspan="4" v-if="authUser.role != 'concessionaire'">Scope 3</th>
                    <th colspan="2">Emission per activity</th>
                    <th colspan="4">Total Emission</th>
                </tr>
                <tr>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><button type="button" onclick="switchTab('tab-2-1')" class="disabled-button">2.1 Site Office</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-2')" class="disabled-button">2.2 Site Clearing</button></li>
                            <li><button type="button" onclick="switchTab('tab-2-3')" class="disabled-button">2.3 Earthwork</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-4')" class="disabled-button">2.4 Erosion Protection and Retaining Structures</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-5')" class="disabled-button">2.5 Ground Improvement</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-6')" class="disabled-button">2.6 Drainage</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-7')" class="disabled-button">2.7 Passage Way Culvert</button></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-8')" class="disabled-button">2.8 Construction of Bridge Works</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-9')" class="disabled-button">2.9 Road Construction</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-10')" class="disabled-button">2.10 Road Furniture Installation</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-11')" class="disabled-button">2.11 M&E Installations</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" onclick="switchTab('tab-2-12')" class="disabled-button">2.12 Tunnel</button></li>
                            <li><button type="button" onclick="switchTab('tab-2-13')" class="disabled-button">2.13 Building</button></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-1,tab-2-1-1')">2.1.1 Staff Commuting </button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-1,tab-2-1-2')">2.1.2 Electrical Consumption</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-1,tab-2-1-3')">2.1.3 Water Consumption</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-2,tab-2-2-1')">2.2.1 Remove Surcharge</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-3,tab-2-3-1')">2.3.1 Rock Blasting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-3,tab-2-3-2')">2.3.2 Earth Cutting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-3,tab-2-3-3')">2.3.3 Earth Filling</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-4,tab-2-4-1')">2.4.1 Slope</button></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-4,tab-2-4-2')">2.4.2 Gabion</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-4,tab-2-4-3')">2.4.3 Retaining Wall</button></li>

                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-5,tab-2-5-1')">2.5.1 PVD</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-5,tab-2-5-2')">2.5.2 Remove and Replace</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-5,tab-2-5-3')">2.5.3 Stone Column</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-5,tab-2-5-4')">2.5.4 Sand Column</button></li>

                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-1')">2.6.1 Excavation Temporary Earth Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-2')">2.6.2 Bench Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-3')">2.6.3 Toe Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-4')">2.6.4 Subsoil Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-5')">2.6.5 Roadside Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-6')">2.6.6 Berm Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-7')">2.6.7 Cascade Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-8')">2.6.8 Median Drain</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-9')">2.6.9 Culvert</button></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-10')">2.6.10 Typical U-Drain</button></li>

                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-7,tab-2-7-1')">2.7.1 In-Situ Culvert</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-7,tab-2-7-2')">2.7.2 Precast Culvert</button></li>

                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-1')">2.8.1 Pile</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-2')">2.8.2 Pile Cap</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-3')">2.8.3 Pier Column</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-4')">2.8.4 Crosshead Beam</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-5')">2.8.5 Bridge Beam</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-6')">2.8.6 Slab Deck</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-7')">2.8.7 Parapet Wall</button></li>

                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-1')">2.9.1 Sub-Base</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-2')">2.9.2 Crushed Aggregate RoadBase</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-3')">2.9.3 Wet-Mix Roadbase</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-4')">2.9.4 DBM @ ACBC Roadbase</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-5')">2.9.5 Binder Course (ACBC)</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-6')">2.9.6 Wearing Course</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-7')">2.9.7 Rigid Pavement</button></li>
                            <li><input value="" disabled></li>

                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-10,tab-2-10-1')">2.10.1 Guardrail</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-10,tab-2-10-2')">2.10.2 Fencing</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-10,tab-2-10-3')">2.10.3 Traffic Signs</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-10,tab-2-10-4')">2.10.4 NJB</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-10,tab-2-10-5')">2.10.5 Noise Barrier</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-10,tab-2-10-6')">2.10.6 Road Marking</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-1')">2.11.1 TCS</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-2')">2.11.2 TCSS</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-3')">2.11.3 Lighting</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-4')">2.11.4 Building</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-5')">2.11.5 Tunnel Mechanical & Electrical</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-13,tab-2-13-1')">2.13.1 Rest & Service Area (RSA)</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-13,tab-2-13-2')">2.13.2 Lay By</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-13,tab-2-13-3')">2.13.3 Toll Plaza</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-13,tab-2-13-4')">2.13.4 Adminstration Building</button></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-4,tab-2-4-1-1')">2.4.1.1 Earth Slope</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-4,tab-2-4-1,tab-2-4-1-2')">2.4.1.2 Rock Slope</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-9,tab-2-6-9-1')">2.6.9.1 Precast Box Culvert</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-6,tab-2-6-9,tab-2-6-9-2')">2.6.9.2 RCP Culvert</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-1,tab-2-8-1-1')">2.8.1.1 Bored Pile</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-1,tab-2-8-1-2')">2.8.1.2 Spun Pile</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-1,tab-2-8-1-3')">2.8.1.3 RC Pile</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-1,tab-2-8-1-4')">2.8.1.4 Caisson Pile</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-8,tab-2-8-1,tab-2-8-1-5')">2.8.1.5 Micropiles</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-6,tab-2-9-6-1')">2.9.6.1 ACWC</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-6,tab-2-9-6-2')">2.9.6.2 Porous Asphalt</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-6,tab-2-9-6-3')">2.9.6.3 Stone Mastic Asphalt (SMA)</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-6,tab-2-9-6-4')">2.9.6.4 Gap Graded Asphalt</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-6,tab-2-9-6-5')">2.9.6.5 Coloured Surfacing</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-7,tab-2-9-7-1')">2.9.7.1 Concrete Pavement</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-9,tab-2-9-7,tab-2-9-7-2')">2.9.7.2 Interlocking Pav.</button></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><input value="" disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-1,tab-2-11-1-1')">2.11.1.1 Transport</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-2,tab-2-11-2-1')">2.11.2.1 CCTV</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-2,tab-2-11-2-2')">2.11.2.2 VMS</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-2,tab-2-11-2-3')">2.11.2.3 DRS</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-2,tab-2-11-2-4')">2.11.2.4 VIDS</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-3,tab-2-11-3-1')">2.11.3.1 Street Lighting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-3,tab-2-11-3-2')">2.11.3.2 Compound LIghting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-3,tab-2-11-3-3')">2.11.3.3 Canopy</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-3,tab-2-11-3-3')">2.11.3.3 High Mast</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-4,tab-2-11-4-1')">2.11.4.1 Transportation</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-5,tab-2-11-5-1')">2.11.5.1 Exhaust Fan</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-2-11,tab-2-11-5,tab-2-11-5-2')">2.11.5.2 Water Consumption</button></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(item, key) in work" :key="key">
                                <input v-if="key != 1 && key != 2" type="text" v-model.number="work[key].value" v-on:change="recalculateRowTotal()">
                                <input v-else disabled>
                            </li>
                        </ul>
                    </td>
                    <td style="width: 60px">
                        <ul class="p-0" style="list-style: none; width: 60px">
                            <li><input type="text" value="staff" style="width: 50px"></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m" style="width: 50px"></li>
                            <li><input type="text" value="m" style="width: 50px"></li>
                            <li><input type="text" value="m" style="width: 50px"></li>
                            <li><input type="text" value="m" style="width: 50px"></li>
                            <li><input type="text" value="point" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="span" style="width: 50px"></li>
                            <li><input type="text" value="span" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="nos" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="km" style="width: 50px"></li>
                            <li><input type="text" value="unit" style="width: 50px"></li>
                            <li><input type="text" value="unit" style="width: 50px"></li>
                            <li><input type="text" value="m" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                            <li><input type="text" value="m3" style="width: 50px"></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_1_machinery.toFixed(4)" disabled></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_1_sc.toFixed(4)" disabled></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_2_elec.toFixed(4)" disabled></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_3_water.toFixed(4)" disabled></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_3_paper" disabled></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_3_material" disabled></li>
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: pink" type="text" v-model="item.scope_3_transportation" disabled></li>
                        </ul>
                    </td>

                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(item, key) in childrenTotals">
                                <input v-if="key != 1 && key != 2" style="background-color: yellow" type="text" v-model="item.emission.toFixed(4)" disabled>
                                <input v-else disabled>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in childrenTotals"><input style="background-color: purple; color: white" type="text" v-model="item.unit" disabled></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(item, key) in totals">
                                <input style="background-color: yellow" type="text" :value="item.toFixed(4)" disabled>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="item in totals"><input type="text" :value="'t CO2e per '+report_period+' year'" disabled></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printVerifyButton(2,1,1)"></li>
                            <li v-html="printVerifyButton(2,1,2)"></li>
                            <li v-html="printVerifyButton(2,1,3)"></li>
                            <li v-html="printVerifyButton(2,2,1)"></li>
                            <li v-html="printVerifyButton(2,3,1)"></li>
                            <li v-html="printVerifyButton(2,3,2)"></li>
                            <li v-html="printVerifyButton(2,3,3)"></li>
                            <li v-html="printVerifyButton(2,4,1,1)"></li>
                            <li v-html="printVerifyButton(2,4,1,2)"></li>
                            <li v-html="printVerifyButton(2,4,2)"></li>
                            <li v-html="printVerifyButton(2,4,3)"></li>
                            <li v-html="printVerifyButton(2,5,1)"></li>
                            <li v-html="printVerifyButton(2,5,2)"></li>
                            <li v-html="printVerifyButton(2,5,3)"></li>
                            <li v-html="printVerifyButton(2,5,4)"></li>

                            <li v-html="printVerifyButton(2,6,1)"></li>
                            <li v-html="printVerifyButton(2,6,2)"></li>
                            <li v-html="printVerifyButton(2,6,3)"></li>
                            <li v-html="printVerifyButton(2,6,4)"></li>
                            <li v-html="printVerifyButton(2,6,5)"></li>
                            <li v-html="printVerifyButton(2,6,6)"></li>
                            <li v-html="printVerifyButton(2,6,7)"></li>
                            <li v-html="printVerifyButton(2,6,8)"></li>
                            <li v-html="printVerifyButton(2,6,9,1)"></li>
                            <li v-html="printVerifyButton(2,6,9,2)"></li>
                            <li v-html="printVerifyButton(2,6,10)"></li>

                            <li v-html="printVerifyButton(2,7,1)"></li>
                            <li v-html="printVerifyButton(2,7,2)"></li>

                            <li v-html="printVerifyButton(2,8,1,1)"></li>
                            <li v-html="printVerifyButton(2,8,1,2)"></li>
                            <li v-html="printVerifyButton(2,8,1,3)"></li>
                            <li v-html="printVerifyButton(2,8,1,4)"></li>
                            <li v-html="printVerifyButton(2,8,1,5)"></li>

                            <li v-html="printVerifyButton(2,8,2)"></li>
                            <li v-html="printVerifyButton(2,8,3)"></li>
                            <li v-html="printVerifyButton(2,8,4)"></li>
                            <li v-html="printVerifyButton(2,8,5)"></li>
                            <li v-html="printVerifyButton(2,8,6)"></li>
                            <li v-html="printVerifyButton(2,8,7)"></li>

                            <li v-html="printVerifyButton(2,9,1)"></li>
                            <li v-html="printVerifyButton(2,9,2)"></li>
                            <li v-html="printVerifyButton(2,9,3)"></li>
                            <li v-html="printVerifyButton(2,9,4)"></li>
                            <li v-html="printVerifyButton(2,9,5)"></li>
                            <li v-html="printVerifyButton(2,9,6,1)"></li>
                            <li v-html="printVerifyButton(2,9,6,2)"></li>
                            <li v-html="printVerifyButton(2,9,6,3)"></li>
                            <li v-html="printVerifyButton(2,9,6,4)"></li>
                            <li v-html="printVerifyButton(2,9,6,5)"></li>
                            <li v-html="printVerifyButton(2,9,7,1)"></li>
                            <li v-html="printVerifyButton(2,9,7,2)"></li>

                            <li v-html="printVerifyButton(2,10,1)"></li>
                            <li v-html="printVerifyButton(2,10,2)"></li>
                            <li v-html="printVerifyButton(2,10,3)"></li>
                            <li v-html="printVerifyButton(2,10,4)"></li>
                            <li v-html="printVerifyButton(2,10,5)"></li>
                            <li v-html="printVerifyButton(2,10,6)"></li>

                            <li v-html="printVerifyButton(2,11,1,1)"></li>
                            <li v-html="printVerifyButton(2,11,2,1)"></li>
                            <li v-html="printVerifyButton(2,11,2,2)"></li>
                            <li v-html="printVerifyButton(2,11,2,3)"></li>
                            <li v-html="printVerifyButton(2,11,2,4)"></li>
                            <li v-html="printVerifyButton(2,11,3,1)"></li>
                            <li v-html="printVerifyButton(2,11,3,2)"></li>
                            <li v-html="printVerifyButton(2,11,3,3)"></li>
                            <li v-html="printVerifyButton(2,11,4,1)"></li>
                            <li v-html="printVerifyButton(2,11,5,1)"></li>
                            <li v-html="printVerifyButton(2,11,5,2)"></li>
                            <li v-html="printVerifyButton(2,11,5,3)"></li>
                            <li v-html="printVerifyButton(2,12,1)"></li>

                            <li v-html="printVerifyButton(2,13,1)"></li>
                            <li v-html="printVerifyButton(2,13,2)"></li>
                            <li v-html="printVerifyButton(2,13,3)"></li>
                            <li v-html="printVerifyButton(2,13,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printDownloadPdf(2,1,1)"></li>
                            <li v-html="printDownloadPdf(2,1,2)"></li>
                            <li v-html="printDownloadPdf(2,1,3)"></li>
                            <li v-html="printDownloadPdf(2,2,1)"></li>
                            <li v-html="printDownloadPdf(2,3,1)"></li>
                            <li v-html="printDownloadPdf(2,3,2)"></li>
                            <li v-html="printDownloadPdf(2,3,3)"></li>
                            <li v-html="printDownloadPdf(2,4,1,1)"></li>
                            <li v-html="printDownloadPdf(2,4,1,2)"></li>
                            <li v-html="printDownloadPdf(2,4,2)"></li>
                            <li v-html="printDownloadPdf(2,4,3)"></li>
                            <li v-html="printDownloadPdf(2,5,1)"></li>
                            <li v-html="printDownloadPdf(2,5,2)"></li>
                            <li v-html="printDownloadPdf(2,5,3)"></li>
                            <li v-html="printDownloadPdf(2,5,4)"></li>
    
                            <li v-html="printDownloadPdf(2,6,1)"></li>
                            <li v-html="printDownloadPdf(2,6,2)"></li>
                            <li v-html="printDownloadPdf(2,6,3)"></li>
                            <li v-html="printDownloadPdf(2,6,4)"></li>
                            <li v-html="printDownloadPdf(2,6,5)"></li>
                            <li v-html="printDownloadPdf(2,6,6)"></li>
                            <li v-html="printDownloadPdf(2,6,7)"></li>
                            <li v-html="printDownloadPdf(2,6,8)"></li>
                            <li v-html="printDownloadPdf(2,6,9,1)"></li>
                            <li v-html="printDownloadPdf(2,6,9,2)"></li>
                            <li v-html="printDownloadPdf(2,6,10)"></li>
    
                            <li v-html="printDownloadPdf(2,7,1)"></li>
                            <li v-html="printDownloadPdf(2,7,2)"></li>
    
                            <li v-html="printDownloadPdf(2,8,1,1)"></li>
                            <li v-html="printDownloadPdf(2,8,1,2)"></li>
                            <li v-html="printDownloadPdf(2,8,1,3)"></li>
                            <li v-html="printDownloadPdf(2,8,1,4)"></li>
                            <li v-html="printDownloadPdf(2,8,1,5)"></li>
    
                            <li v-html="printDownloadPdf(2,8,2)"></li>
                            <li v-html="printDownloadPdf(2,8,3)"></li>
                            <li v-html="printDownloadPdf(2,8,4)"></li>
                            <li v-html="printDownloadPdf(2,8,5)"></li>
                            <li v-html="printDownloadPdf(2,8,6)"></li>
                            <li v-html="printDownloadPdf(2,8,7)"></li>
    
                            <li v-html="printDownloadPdf(2,9,1)"></li>
                            <li v-html="printDownloadPdf(2,9,2)"></li>
                            <li v-html="printDownloadPdf(2,9,3)"></li>
                            <li v-html="printDownloadPdf(2,9,4)"></li>
                            <li v-html="printDownloadPdf(2,9,5)"></li>
                            <li v-html="printDownloadPdf(2,9,6,1)"></li>
                            <li v-html="printDownloadPdf(2,9,6,2)"></li>
                            <li v-html="printDownloadPdf(2,9,6,3)"></li>
                            <li v-html="printDownloadPdf(2,9,6,4)"></li>
                            <li v-html="printDownloadPdf(2,9,6,5)"></li>
                            <li v-html="printDownloadPdf(2,9,7,1)"></li>
                            <li v-html="printDownloadPdf(2,9,7,2)"></li>
    
                            <li v-html="printDownloadPdf(2,10,1)"></li>
                            <li v-html="printDownloadPdf(2,10,2)"></li>
                            <li v-html="printDownloadPdf(2,10,3)"></li>
                            <li v-html="printDownloadPdf(2,10,4)"></li>
                            <li v-html="printDownloadPdf(2,10,5)"></li>
                            <li v-html="printDownloadPdf(2,10,6)"></li>
    
                            <li v-html="printDownloadPdf(2,11,1,1)"></li>
                            <li v-html="printDownloadPdf(2,11,2,1)"></li>
                            <li v-html="printDownloadPdf(2,11,2,2)"></li>
                            <li v-html="printDownloadPdf(2,11,2,3)"></li>
                            <li v-html="printDownloadPdf(2,11,2,4)"></li>
                            <li v-html="printDownloadPdf(2,11,3,1)"></li>
                            <li v-html="printDownloadPdf(2,11,3,2)"></li>
                            <li v-html="printDownloadPdf(2,11,3,3)"></li>
                            <li v-html="printDownloadPdf(2,11,4,1)"></li>
                            <li v-html="printDownloadPdf(2,11,5,1)"></li>
                            <li v-html="printDownloadPdf(2,11,5,2)"></li>
                            <li v-html="printDownloadPdf(2,11,5,3)"></li>
                            <li v-html="printDownloadPdf(2,12,1)"></li>
    
                            <li v-html="printDownloadPdf(2,13,1)"></li>
                            <li v-html="printDownloadPdf(2,13,2)"></li>
                            <li v-html="printDownloadPdf(2,13,3)"></li>
                            <li v-html="printDownloadPdf(2,13,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="getStatusOpt(2,1,1)"></li>
                            <li v-html="getStatusOpt(2,1,2)"></li>
                            <li v-html="getStatusOpt(2,1,3)"></li>
                            <li v-html="getStatusOpt(2,2,1)"></li>
                            <li v-html="getStatusOpt(2,3,1)"></li>
                            <li v-html="getStatusOpt(2,3,2)"></li>
                            <li v-html="getStatusOpt(2,3,3)"></li>
                            <li v-html="getStatusOpt(2,4,1,1)"></li>
                            <li v-html="getStatusOpt(2,4,1,2)"></li>
                            <li v-html="getStatusOpt(2,4,2)"></li>
                            <li v-html="getStatusOpt(2,4,3)"></li>
                            <li v-html="getStatusOpt(2,5,1)"></li>
                            <li v-html="getStatusOpt(2,5,2)"></li>
                            <li v-html="getStatusOpt(2,5,3)"></li>
                            <li v-html="getStatusOpt(2,5,4)"></li>

                            <li v-html="getStatusOpt(2,6,1)"></li>
                            <li v-html="getStatusOpt(2,6,2)"></li>
                            <li v-html="getStatusOpt(2,6,3)"></li>
                            <li v-html="getStatusOpt(2,6,4)"></li>
                            <li v-html="getStatusOpt(2,6,5)"></li>
                            <li v-html="getStatusOpt(2,6,6)"></li>
                            <li v-html="getStatusOpt(2,6,7)"></li>
                            <li v-html="getStatusOpt(2,6,8)"></li>
                            <li v-html="getStatusOpt(2,6,9,1)"></li>
                            <li v-html="getStatusOpt(2,6,9,2)"></li>
                            <li v-html="getStatusOpt(2,6,10)"></li>

                            <li v-html="getStatusOpt(2,7,1)"></li>
                            <li v-html="getStatusOpt(2,7,2)"></li>

                            <li v-html="getStatusOpt(2,8,1,1)"></li>
                            <li v-html="getStatusOpt(2,8,1,2)"></li>
                            <li v-html="getStatusOpt(2,8,1,3)"></li>
                            <li v-html="getStatusOpt(2,8,1,4)"></li>
                            <li v-html="getStatusOpt(2,8,1,5)"></li>

                            <li v-html="getStatusOpt(2,8,2)"></li>
                            <li v-html="getStatusOpt(2,8,3)"></li>
                            <li v-html="getStatusOpt(2,8,4)"></li>
                            <li v-html="getStatusOpt(2,8,5)"></li>
                            <li v-html="getStatusOpt(2,8,6)"></li>
                            <li v-html="getStatusOpt(2,8,7)"></li>

                            <li v-html="getStatusOpt(2,9,1)"></li>
                            <li v-html="getStatusOpt(2,9,2)"></li>
                            <li v-html="getStatusOpt(2,9,3)"></li>
                            <li v-html="getStatusOpt(2,9,4)"></li>
                            <li v-html="getStatusOpt(2,9,5)"></li>
                            <li v-html="getStatusOpt(2,9,6,1)"></li>
                            <li v-html="getStatusOpt(2,9,6,2)"></li>
                            <li v-html="getStatusOpt(2,9,6,3)"></li>
                            <li v-html="getStatusOpt(2,9,6,4)"></li>
                            <li v-html="getStatusOpt(2,9,6,5)"></li>
                            <li v-html="getStatusOpt(2,9,7,1)"></li>
                            <li v-html="getStatusOpt(2,9,7,2)"></li>

                            <li v-html="getStatusOpt(2,10,1)"></li>
                            <li v-html="getStatusOpt(2,10,2)"></li>
                            <li v-html="getStatusOpt(2,10,3)"></li>
                            <li v-html="getStatusOpt(2,10,4)"></li>
                            <li v-html="getStatusOpt(2,10,5)"></li>
                            <li v-html="getStatusOpt(2,10,6)"></li>

                            <li v-html="getStatusOpt(2,11,1,1)"></li>
                            <li v-html="getStatusOpt(2,11,2,1)"></li>
                            <li v-html="getStatusOpt(2,11,2,2)"></li>
                            <li v-html="getStatusOpt(2,11,2,3)"></li>
                            <li v-html="getStatusOpt(2,11,2,4)"></li>
                            <li v-html="getStatusOpt(2,11,3,1)"></li>
                            <li v-html="getStatusOpt(2,11,3,2)"></li>
                            <li v-html="getStatusOpt(2,11,3,3)"></li>
                            <li v-html="getStatusOpt(2,11,4,1)"></li>
                            <li v-html="getStatusOpt(2,11,5,1)"></li>
                            <li v-html="getStatusOpt(2,11,5,2)"></li>
                            <li v-html="getStatusOpt(2,11,5,3)"></li>
                            <li v-html="getStatusOpt(2,12,1)"></li>

                            <li v-html="getStatusOpt(2,13,1)"></li>
                            <li v-html="getStatusOpt(2,13,2)"></li>
                            <li v-html="getStatusOpt(2,13,3)"></li>
                            <li v-html="getStatusOpt(2,13,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="getCommentBox(2,1,1)"></li>
                            <li v-html="getCommentBox(2,1,2)"></li>
                            <li v-html="getCommentBox(2,1,3)"></li>
                            <li v-html="getCommentBox(2,2,1)"></li>
                            <li v-html="getCommentBox(2,3,1)"></li>
                            <li v-html="getCommentBox(2,3,2)"></li>
                            <li v-html="getCommentBox(2,3,3)"></li>
                            <li v-html="getCommentBox(2,4,1,1)"></li>
                            <li v-html="getCommentBox(2,4,1,2)"></li>
                            <li v-html="getCommentBox(2,4,2)"></li>
                            <li v-html="getCommentBox(2,4,3)"></li>
                            <li v-html="getCommentBox(2,5,1)"></li>
                            <li v-html="getCommentBox(2,5,2)"></li>
                            <li v-html="getCommentBox(2,5,3)"></li>
                            <li v-html="getCommentBox(2,5,4)"></li>

                            <li v-html="getCommentBox(2,6,1)"></li>
                            <li v-html="getCommentBox(2,6,2)"></li>
                            <li v-html="getCommentBox(2,6,3)"></li>
                            <li v-html="getCommentBox(2,6,4)"></li>
                            <li v-html="getCommentBox(2,6,5)"></li>
                            <li v-html="getCommentBox(2,6,6)"></li>
                            <li v-html="getCommentBox(2,6,7)"></li>
                            <li v-html="getCommentBox(2,6,8)"></li>
                            <li v-html="getCommentBox(2,6,9,1)"></li>
                            <li v-html="getCommentBox(2,6,9,2)"></li>
                            <li v-html="getCommentBox(2,6,10)"></li>

                            <li v-html="getCommentBox(2,7,1)"></li>
                            <li v-html="getCommentBox(2,7,2)"></li>

                            <li v-html="getCommentBox(2,8,1,1)"></li>
                            <li v-html="getCommentBox(2,8,1,2)"></li>
                            <li v-html="getCommentBox(2,8,1,3)"></li>
                            <li v-html="getCommentBox(2,8,1,4)"></li>
                            <li v-html="getCommentBox(2,8,1,5)"></li>

                            <li v-html="getCommentBox(2,8,2)"></li>
                            <li v-html="getCommentBox(2,8,3)"></li>
                            <li v-html="getCommentBox(2,8,4)"></li>
                            <li v-html="getCommentBox(2,8,5)"></li>
                            <li v-html="getCommentBox(2,8,6)"></li>
                            <li v-html="getCommentBox(2,8,7)"></li>

                            <li v-html="getCommentBox(2,9,1)"></li>
                            <li v-html="getCommentBox(2,9,2)"></li>
                            <li v-html="getCommentBox(2,9,3)"></li>
                            <li v-html="getCommentBox(2,9,4)"></li>
                            <li v-html="getCommentBox(2,9,5)"></li>
                            <li v-html="getCommentBox(2,9,6,1)"></li>
                            <li v-html="getCommentBox(2,9,6,2)"></li>
                            <li v-html="getCommentBox(2,9,6,3)"></li>
                            <li v-html="getCommentBox(2,9,6,4)"></li>
                            <li v-html="getCommentBox(2,9,6,5)"></li>
                            <li v-html="getCommentBox(2,9,7,1)"></li>
                            <li v-html="getCommentBox(2,9,7,2)"></li>

                            <li v-html="getCommentBox(2,10,1)"></li>
                            <li v-html="getCommentBox(2,10,2)"></li>
                            <li v-html="getCommentBox(2,10,3)"></li>
                            <li v-html="getCommentBox(2,10,4)"></li>
                            <li v-html="getCommentBox(2,10,5)"></li>
                            <li v-html="getCommentBox(2,10,6)"></li>

                            <li v-html="getCommentBox(2,11,1,1)"></li>
                            <li v-html="getCommentBox(2,11,2,1)"></li>
                            <li v-html="getCommentBox(2,11,2,2)"></li>
                            <li v-html="getCommentBox(2,11,2,3)"></li>
                            <li v-html="getCommentBox(2,11,2,4)"></li>
                            <li v-html="getCommentBox(2,11,3,1)"></li>
                            <li v-html="getCommentBox(2,11,3,2)"></li>
                            <li v-html="getCommentBox(2,11,3,3)"></li>
                            <li v-html="getCommentBox(2,11,4,1)"></li>
                            <li v-html="getCommentBox(2,11,5,1)"></li>
                            <li v-html="getCommentBox(2,11,5,2)"></li>
                            <li v-html="getCommentBox(2,11,5,3)"></li>
                            <li v-html="getCommentBox(2,12,1)"></li>

                            <li v-html="getCommentBox(2,13,1)"></li>
                            <li v-html="getCommentBox(2,13,2)"></li>
                            <li v-html="getCommentBox(2,13,3)"></li>
                            <li v-html="getCommentBox(2,13,4)"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td :colspan="authUser.role == 'concessionaire' ? 7 : 3" align="right">Total Emission Maintenance</td>
                    <td><input type="text" :value="grandTotal" disabled></td>
                    <td><input type="text" :value="'t CO2e per '+report_period+' year'" disabled></td>
                </tr>
            </table>

            <div class="tabs tabs-primary card p-3" id="construction_navigation">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item" id="criteria-navigation-2-1">
                        <a data-toggle="tab" href="#tab-2-1" role="tab" class="nav-link active show"
                           aria-selected="true">
                            2.1 Site Office
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-2" role="tab" class="nav-link" aria-selected="false">
                            2.2 Site Clearing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-3" role="tab" class="nav-link" aria-selected="false">
                            2.3 Earthwork
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-4" role="tab" class="nav-link" aria-selected="false">
                            2.4 Erosion Protection and Retaining Structures
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-5" role="tab" class="nav-link" aria-selected="false">
                            2.5 Ground Improvement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-6" role="tab" class="nav-link" aria-selected="false">
                            2.6 Drainage
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-7" role="tab" class="nav-link" aria-selected="false">
                            2.7 Passage Way Culvert
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-8" role="tab" class="nav-link" aria-selected="false">
                            2.8 Construction of Bridge Works
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-9" role="tab" class="nav-link" aria-selected="false">
                            2.9 Road Construction
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-10" role="tab" class="nav-link" aria-selected="false">
                            2.10 Road Furniture Installation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-11" role="tab" class="nav-link" aria-selected="false">
                            2.11 M&E Installations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-12" role="tab" class="nav-link" aria-selected="false">
                            2.12 Tunnel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-2-13" role="tab" class="nav-link" aria-selected="false">
                            2.13 Building
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="tab-2-1" role="tabpanel" class="tab-pane active show">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item" id="subcriteria-navigation-2-1-1">
                                    <a data-toggle="tab" href="#tab-2-1-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.1.1 Staff Commuting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-1-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.1.2 Electrical Consumption
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-1-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.1.3 Water Consumption
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-1-1" role="tabpanel" class="tab-pane active show">
                                <construction-staff-commuting
                                        table-id="2.1.1"
                                        id="211t"
                                        v-model="childrenTotals[0]"
                                        total-unit="t CO2e/ staff/ year"
                                        print-header
                                >
                                </construction-staff-commuting>
                            </div>
                            <div id="tab-2-1-2" role="tabpanel" class="tab-pane">
                                <electrical-consumption
                                        table-id="2.1.2"
                                        id="212t"
                                        v-model="childrenTotals[1]"
                                        total-unit="t CO2e per 1 year"
                                        print-header
                                >
                                </electrical-consumption>
                            </div>
                            <div id="tab-2-1-3" role="tabpanel" class="tab-pane">
                                <electrical-consumption
                                        table-id="2.1.3"
                                        id="212t"
                                        v-model="childrenTotals[2]"
                                        total-unit="t CO2e per 1 year"
                                        print-header
                                >
                                </electrical-consumption>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2-2" role="tabpanel" class="tab-pane">
                        <remove-surcharge
                                table-id="2.2.1"
                                id="221t"
                                v-model="childrenTotals[3]"
                                print-header
                        ></remove-surcharge>
                    </div>

                    <div id="tab-2-3" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-3-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.3.1 Rock Blasting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-3-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.3.2 Earth Cutting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-3-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.3.3 Earth Filling
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-3-1" role="tabpanel" class="tab-pane active show">
                                <remove-surcharge
                                        table-id="2.3.1"
                                        id="231t"
                                        v-model="childrenTotals[4]"
                                        print-header
                                ></remove-surcharge>
                            </div>
                            <div id="tab-2-3-2" role="tabpanel" class="tab-pane">
                                <remove-surcharge
                                        table-id="2.3.2"
                                        id="232t"
                                        v-model="childrenTotals[5]"
                                        print-header
                                ></remove-surcharge>
                            </div>
                            <div id="tab-2-3-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.3.3"
                                        id="233t"
                                        key="233t"
                                        v-model="childrenTotals[6]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/m3"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>

                    <div id="tab-2-4" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-4-1-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.4.1.1 Earth Slope
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-4-1-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.4.1.2 Rock Slope
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-4-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.4.2 Gabion
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-4-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.4.3 Retaining Wall
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-4-1-1" role="tabpanel" class="tab-pane active show">
                                <remove-surcharge
                                        table-id="2.4.1.1"
                                        id="2411t"
                                        v-model="childrenTotals[7]"
                                        print-header
                                        total-unit="t CO2e/km"
                                        productivity-unit="km"
                                ></remove-surcharge>
                            </div>
                            <div id="tab-2-4-1-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.4.1.2"
                                        id="2412t"
                                        key="2412t"
                                        v-model="childrenTotals[8]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/km"
                                        productivity-unit="km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-4-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.4.2"
                                        id="242t"
                                        key="242t"
                                        v-model="childrenTotals[8]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/km"
                                        productivity-unit="km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-4-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.4.3"
                                        id="243t"
                                        key="243t"
                                        v-model="childrenTotals[9]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/km"
                                        productivity-unit="km"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>

                    <div id="tab-2-5" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2.5.1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.5.1 PVD
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-5-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.5.2 Remove and Replace
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-5-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.5.3 Stone Column
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-5-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.5.4 Sand Column
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2.5.1" role="tabpanel" class="tab-pane active show">
                                <bored-pile
                                        table-id="2.5.1"
                                        id="251t"
                                        key="251t"
                                        v-model="childrenTotals[11]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-5-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.5.2"
                                        id="252t"
                                        key="252t"
                                        v-model="childrenTotals[12]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/m3"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-5-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.5.3"
                                        id="253t"
                                        key="253t"
                                        v-model="childrenTotals[13]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/m3"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-5-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.5.4"
                                        id="254t"
                                        key="254t"
                                        v-model="childrenTotals[14]"
                                        print-header
                                        class="w-100"
                                        total-unit="t CO2e/m3"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>

                    <div id="tab-2-6" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.6.1 Excavation Temporary Earth Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.2 Bench Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.3 Toe Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.4 Subsoil Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.5 Roadside Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-6" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.6 Berm Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-7" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.7 Cascade Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-8" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.8 Median Drain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-9-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.9.1 Precast Box Culvert
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-6-9-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.6.9.2 RCP Culvert
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-6-1" role="tabpanel" class="tab-pane active show">
                                <excavation-temporary-earth-drain
                                        table-id="2.6.1"
                                        id="261t"
                                        key="261t"
                                        v-model="childrenTotals[15]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                >
                                </excavation-temporary-earth-drain>
                            </div>
                            <div id="tab-2-6-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.2"
                                        id="262t"
                                        key="262t"
                                        v-model="childrenTotals[16]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.3"
                                        id="263t"
                                        key="263t"
                                        v-model="childrenTotals[17]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.4"
                                        id="264t"
                                        key="264t"
                                        v-model="childrenTotals[18]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-5" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.5"
                                        id="265t"
                                        key="265t"
                                        v-model="childrenTotals[19]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-6" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.6"
                                        id="266t"
                                        key="266t"
                                        v-model="childrenTotals[20]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-7" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.7"
                                        id="267t"
                                        key="267t"
                                        v-model="childrenTotals[21]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-8" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.8"
                                        id="268t"
                                        key="268t"
                                        v-model="childrenTotals[22]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-9-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.9.1"
                                        id="2691t"
                                        key="2691t"
                                        v-model="childrenTotals[23]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-9-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.9.2"
                                        id="2692t"
                                        key="2692t"
                                        v-model="childrenTotals[24]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-6-10" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.6.10"
                                        id="2610t"
                                        key="2610t"
                                        v-model="childrenTotals[25]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>

                    <div id="tab-2-7" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-7-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.7.1 In-Situ Culvert
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-7-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.7.2 Precast Culvert
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-7-1" role="tabpanel" class="tab-pane active show">
                                <bored-pile
                                        table-id="2.7.1"
                                        id="271t"
                                        key="271t"
                                        v-model="childrenTotals[26]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-7-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.7.2"
                                        id="272t"
                                        key="272t"
                                        v-model="childrenTotals[27]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2-8" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-1-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.8.1.1 Bored Pile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-1-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.1.2 Spun Pile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-1-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.1.3 RC Pile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-1-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.1.4 Caisson Pile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-1-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.1.5 Micropiles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.2 Pile Cap
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.3 Pier Column
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.4 Crosshead Beam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.5 Bridge Beam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-6" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.6 Slab Deck
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-8-7" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.8.7 Parapet Wall
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-8-1-1" role="tabpanel" class="tab-pane active show">
                                <bored-pile
                                        table-id="2.8.1.1"
                                        id="2811t"
                                        key="2811t"
                                        v-model="childrenTotals[28]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-1-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.1.2"
                                        id="2812t"
                                        key="2812t"
                                        v-model="childrenTotals[29]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-1-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.1.3"
                                        id="2813t"
                                        key="2813t"
                                        v-model="childrenTotals[30]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-1-4" role="tabpanel" class="tab-pane">
                                <caisson-pile
                                        table-id="2.8.1.4"
                                        id="2814t"
                                        key="2814t"
                                        v-model="childrenTotals[31]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </caisson-pile>
                            </div>
                            <div id="tab-2-8-1-5" role="tabpanel" class="tab-pane">
                                <caisson-pile
                                        table-id="2.8.1.5"
                                        id="2815t"
                                        key="2815t"
                                        v-model="childrenTotals[32]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </caisson-pile>
                            </div>
                            <div id="tab-2-8-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.2"
                                        id="282t"
                                        key="282t"
                                        v-model="childrenTotals[33]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.3"
                                        id="283t"
                                        key="283t"
                                        v-model="childrenTotals[34]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.4"
                                        id="284t"
                                        key="284t"
                                        v-model="childrenTotals[35]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="point"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-5" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.5"
                                        id="285t"
                                        key="285t"
                                        v-model="childrenTotals[36]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="nos"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-6" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.6"
                                        id="286t"
                                        key="286t"
                                        v-model="childrenTotals[37]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-8-7" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.8.7"
                                        id="287t"
                                        key="287t"
                                        v-model="childrenTotals[38]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2-9" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.9.1 Sub-Base
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.2 Crushed Aggregate RoadBase
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.3 Wet-Mix Roadbase
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.4 DBM @ ACBC Roadbase
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.5 Binder Course (ACBC)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-6-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.6.1 ACWC
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-6-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.6.2 Porous Asphalt
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-6-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.6.3 Stone Mastic Asphalt (SMA)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-6-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.6.4 Gap Graded Asphalt
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-6-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.6.5 Coloured Surfacing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-7-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.7.1 Concrete Pavement
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-9-7-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.9.7.2 Interlocking Pav.
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-9-1" role="tabpanel" class="tab-pane active show">
                                <bored-pile
                                        table-id="2.9.1"
                                        id="291t"
                                        key="291t"
                                        v-model="childrenTotals[39]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.2"
                                        id="292t"
                                        key="292t"
                                        v-model="childrenTotals[40]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.3"
                                        id="293t"
                                        key="293t"
                                        v-model="childrenTotals[41]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-4" role="tabpanel" class="tab-pane">
                                <caisson-pile
                                        table-id="2.9.4"
                                        id="294t"
                                        key="294t"
                                        v-model="childrenTotals[42]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </caisson-pile>
                            </div>
                            <div id="tab-2-9-5" role="tabpanel" class="tab-pane">
                                <caisson-pile
                                        table-id="2.9.5"
                                        id="295t"
                                        key="295t"
                                        v-model="childrenTotals[43]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </caisson-pile>
                            </div>
                            <div id="tab-2-9-6-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.6.1"
                                        id="2961t"
                                        key="2961t"
                                        v-model="childrenTotals[44]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-6-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.6.2"
                                        id="2962t"
                                        key="2962t"
                                        v-model="childrenTotals[45]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-6-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.6.3"
                                        id="2963t"
                                        key="2963t"
                                        v-model="childrenTotals[46]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-6-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.6.4"
                                        id="2964t"
                                        key="2964t"
                                        v-model="childrenTotals[47]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-6-5" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.6.5"
                                        id="2965t"
                                        key="2965t"
                                        v-model="childrenTotals[48]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-7-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.7.1"
                                        id="2971t"
                                        key="2971t"
                                        v-model="childrenTotals[49]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-9-7-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.9.7.2"
                                        id="2972t"
                                        key="2972t"
                                        v-model="childrenTotals[50]"
                                        print-header
                                        class="w-100"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2-10" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-10-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.10.1 Guardrail
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-10-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.10.2 Fencing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-10-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.10.3 Traffic Signs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-10-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.10.4 NJB
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-10-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.10.5 Noise Barrier
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-10-6" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.10.6 Road Marking
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-10-1" role="tabpanel" class="tab-pane active show">
                                <bored-pile
                                        table-id="2.10.1"
                                        id="2101t"
                                        key="2101t"
                                        v-model="childrenTotals[51]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-10-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.10.2"
                                        id="2102t"
                                        key="2102t"
                                        v-model="childrenTotals[52]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-10-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.10.3"
                                        id="2103t"
                                        key="2103t"
                                        v-model="childrenTotals[53]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-10-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.10.4"
                                        id="2104t"
                                        key="2104t"
                                        v-model="childrenTotals[54]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-10-5" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.10.5"
                                        id="2105t"
                                        key="2105t"
                                        v-model="childrenTotals[55]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-10-6" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.10.6"
                                        id="2106t"
                                        key="2106t"
                                        v-model="childrenTotals[56]"
                                        productivity-unit="km"
                                        total-unit="t CO2e/km"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2-11" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-1-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.11.1.1 Transpport (TCS)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-2-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.2.1 CCTV
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-2-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.2.2 VMS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-2-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.2.3 DRS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-2-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.2.4 VIDS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-3-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.3.1 SL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-3-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.3.2 CL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-3-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.3.3 Canopy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-3-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.3.4 HM
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-4-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.4.1 Transport (B)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-5-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.5.1 Exhaust Fan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-11-5-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.11.5.2 Water Jet
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-11-1-1" role="tabpanel" class="tab-pane active show">
                                <bored-pile
                                        table-id="2.11.1.1"
                                        id="21111t"
                                        key="21111t"
                                        v-model="childrenTotals[57]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-2-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.2.1"
                                        id="21121t"
                                        key="21121t"
                                        v-model="childrenTotals[58]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-2-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.2.2"
                                        id="21122t"
                                        key="21122t"
                                        v-model="childrenTotals[59]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-2-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.2.3"
                                        id="21123t"
                                        key="21123t"
                                        v-model="childrenTotals[60]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-2-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.2.4"
                                        id="21124t"
                                        key="21124t"
                                        v-model="childrenTotals[61]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-3-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.3.1"
                                        id="21131t"
                                        key="21131t"
                                        v-model="childrenTotals[62]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-3-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.3.2"
                                        id="21132t"
                                        key="21132t"
                                        v-model="childrenTotals[62]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-3-3" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.3.3"
                                        id="21133t"
                                        key="21133t"
                                        v-model="childrenTotals[63]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-3-4" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.3.4"
                                        id="21134t"
                                        key="21134t"
                                        v-model="childrenTotals[64]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-4-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.4.1"
                                        id="21141t"
                                        key="21141t"
                                        v-model="childrenTotals[65]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-5-1" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.5.1"
                                        id="21151t"
                                        key="21151t"
                                        v-model="childrenTotals[66]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                            <div id="tab-2-11-5-2" role="tabpanel" class="tab-pane">
                                <bored-pile
                                        table-id="2.11.5.2"
                                        id="21152t"
                                        key="21152t"
                                        v-model="childrenTotals[67]"
                                        productivity-unit="Unit"
                                        total-unit="t CO2e/unit"
                                        print-header
                                        class="w-100"
                                >
                                </bored-pile>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2-12" role="tabpanel" class="tab-pane">
                        <tunnel
                                table-id="2.12"
                                id="212t"
                                key="212"
                                v-model="childrenTotals[68]"
                                productivity-unit="m"
                                total-productivity-unit="m"
                                print-header
                                class="w-100"
                        >
                        </tunnel>
                    </div>
                    <div id="tab-2-13" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-13-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        2.13.1 Rest & Service Area (RSA)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-13-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.13.2 Lay By
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-13-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.13.3 Toll Plaza
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-2-13-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        2.13.4 Adminstration Building
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-2-13-1" role="tabpanel" class="tab-pane active show">
                                <tunnel
                                        table-id="2.13.1"
                                        id="2131t"
                                        key="2132t"
                                        v-model="childrenTotals[69]"
                                        productivity-unit="m3 of concrete"
                                        total-unit="t CO2e/m3"
                                        print-header
                                        class="w-100"
                                >
                                </tunnel>
                            </div>
                            <div id="tab-2-13-2" role="tabpanel" class="tab-pane">
                                <tunnel
                                        table-id="2.13.2"
                                        id="2132t"
                                        key="2132t"
                                        v-model="childrenTotals[70]"
                                        productivity-unit="m3 of concrete"
                                        total-unit="t CO2e/m3"
                                        print-header
                                        class="w-100"
                                >
                                </tunnel>
                            </div>
                            <div id="tab-2-13-3" role="tabpanel" class="tab-pane">
                                <tunnel
                                        table-id="2.13.3"
                                        id="2133t"
                                        key="2133t"
                                        v-model="childrenTotals[71]"
                                        productivity-unit="m3 of concrete"
                                        total-unit="t CO2e/m3"
                                        print-header
                                        class="w-100"
                                >
                                </tunnel>
                            </div>
                            <div id="tab-2-13-4" role="tabpanel" class="tab-pane">
                                <tunnel
                                        table-id="2.13.4"
                                        id="2134t"
                                        key="2134t"
                                        v-model="childrenTotals[72]"
                                        productivity-unit="m3 of concrete"
                                        total-unit="t CO2e/m3"
                                        print-header
                                        class="w-100"
                                >
                                </tunnel>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import CfcMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [CfcMixins],
    props: {
      'templateDataModel': {
        type: String,
        default: 'staff_commuting'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      }
    },
    data () {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        work: [],
        childrenTotals: [],
        totals: [],
        grandTotal: 0,
        report_period: 1,
        authUser: authUser,
      }
    },
    methods: {
      recalculateRowTotal() {
        var total = 0
        var newStageTotals = {
          electricity: 0,
          water: 0,
          transportation: 0,
          material: 0,
          machineries: 0,
          paper: 0,
          waste: 0
        }
        for(var i=0; i<this.work.length;i++) {
          if(this.work[i] != null && this.childrenTotals != null) {
            var child = this.childrenTotals[i]
            if(i == 1 || i == 2) {
              // special case in excel
              this.totals[i] = child.emission
            }
            else {
              this.totals[i] = this.work[i].value * child.emission
            }
            total += this.totals[i]
            newStageTotals.machineries += child.scope_1_machinery
            newStageTotals.transportation += child.scope_1_sc
            newStageTotals.electricity += child.scope_2_elec
            newStageTotals.material += child.scope_3_material
            newStageTotals.paper += child.scope_3_paper
            newStageTotals.water += child.scope_3_paper
            newStageTotals.waste += child.scope_3_transportation
          }
        }
        this.grandTotal = total
        stages_totals[currentYearActive][2]= newStageTotals
        needDataUpdate = true
        project_data['construction_work_values'] = this.work
      }
    },
    watch: {
      childrenTotals() {
        this.recalculateRowTotal()
      },
      work() {
        this.recalculateRowTotal()
      }
    },
    created () {
      var createWorkArray = true;
      if (project_data['construction_work_values'] != null && project_data['construction_work_values'].length == 74) {
        this.work = project_data['construction_work_values'];
        createWorkArray = false
      }
      for(var i=0; i<74; i++) {
        if(createWorkArray) {
          this.work[i] = {
            value: 0
          }
        }
        this.childrenTotals[i] = {
          work: 0,
          scope_1_machinery: 0,
          scope_1_sc: 0,
          scope_2_elec: 0,
          scope_3_water: 0,
          scope_3_paper: 0,
          scope_3_material: 0,
          scope_3_transportation: 0,
          emission: 0,
          emission_unit: '',
          total: 0
        }
        this.totals[i] = 0
      }
      this.report_period = project_data['report_period']
      this.updateTemplateData()
      // fix for removed sections without deleting them in project_navigation.php
      project_data['section_verification'][currentYearActive][2][11][3][4] = true;
    }
  }
</script>
