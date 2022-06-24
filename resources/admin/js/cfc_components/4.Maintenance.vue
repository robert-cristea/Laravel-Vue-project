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
                    <th v-if="authUser.role != 'concessionaire'">Scope 1</th>
                    <th v-if="authUser.role != 'concessionaire'">Scope 2</th>
                    <th v-if="authUser.role != 'concessionaire'">Scope 3</th>
                    <th>Total Emission</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-1')">4.1 Landscape</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2')">4.2 Pavement</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-3')">4.3 Building</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-4')">4.4 Bridge</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-5')">4.5 Tunnel</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6')">4.6 Road Furniture</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-7')">4.7 Slope</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-8')">4.8 Sewage Treatment Plant</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-9')">4.9 Detention Pond</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-10')">4.10 Drainage</button></li>
                            <!--<li><input disabled></li>-->
                            <!--<li><input disabled></li>-->
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-11')">4.11 Vehicle Box Culvert</button></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-1-1')">4.1.1 Carbon Sequestration</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-1-2')">4.1.2 Road Cleaning</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-1-3')">4.1.3 Landscaping</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2')">4.2.1 Mill and Pave</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2')">4.2.2 Patching</button></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-3,tab-4-3-1')">4.3.1 Machinery Work</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-3,tab-4-3-2')">4.3.2 Repainting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-3,tab-4-3-3')">4.3.3 Replacement Utlities</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-4,tab-4-4-1')">4.4.1 Machinery Work</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-4,tab-4-4-2')">4.4.2 Repainting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-4,tab-4-4-3')">4.4.3 Replacement Utilities</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-5,tab-4-5-1')">4.5.1 Repainting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-5,tab-4-5-2')">4.5.2 Replacement of Utilities</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-5,tab-4-5-3')">4.5.3 Miscelleneous Repair Works</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6,tab-4-6-1')">4.6.1 Signboard Cleaning</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6,tab-4-6-2')">4.6.2 Guidepost Cleaning</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6,tab-4-6-3')">4.6.3 Safety Barrier Repair</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6,tab-4-6-4')">4.6.4 Light and Utility Repair</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6,tab-4-6-5')">4.6.5 Boundary Fence</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-6,tab-4-6-6')">4.6.6 Road Marking</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-7')">4.7.1 Slope Protection</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-8')">4.8.1 Miscelleneous Repair</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-9')">4.9.1 Desilting</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-10')">4.10.1 Rubbish Trap</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-11')">4.11.1 Repainting</button></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2,tab-4-2-1,tab-4-2-1-1')">4.2.1.1 Remove Existing Surface </button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2,tab-4-2-1,tab-4-2-1-2')">4.2.1.2 Pavement Resurfacing</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2,tab-4-2-1,tab-4-2-1-3')">4.2.1.3 Road Marking</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2,tab-4-2-2,tab-4-2-2-1')">4.2.2.1 Remove Existing Surface </button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2,tab-4-2-2,tab-4-2-2-2')">4.2.2.2 Pavement Resurfacing</button></li>
                            <li><button type="button" class="disabled-button" onclick="switchTab('tab-4-2,tab-4-2-2,tab-4-2-2-3')">4.2.2.3 Road Marking</button></li>
                        </ul>
                    </td>

                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[3]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[4]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[5]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[6]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[7]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[8]" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                        </ul>
                    </td>

                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(total, index) in childrenTotals">
                                <input type="text" style="background-color: pink" value="0" disabled>
                            </li>
                        </ul>
                    </td>

                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[0]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[1]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[2]" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" value="0" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[9]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[10]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[11]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[12]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[13]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[14]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[15]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[16]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[17]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[18]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[19]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[20]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[21]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[22]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[23]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[24]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[25]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[26]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[27]" disabled></li>
                            <li><input type="text" style="background-color: pink" :value="childrenTotals[28]" disabled></li>
                        </ul>
                    </td>

                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(total, index) in totals">
                                <input type="text" :value="totals[index]" disabled>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(total, index) in totals">
                                <input type="text" :value="'t CO2e per '+report_period+' year'" disabled>
                            </li>
                        </ul>
                    </td>

                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printVerifyButton(4,1,1)"></li>
                            <li v-html="printVerifyButton(4,1,2)"></li>
                            <li v-html="printVerifyButton(4,1,3)"></li>
                            <li v-html="printVerifyButton(4,2,1,1)"></li>
                            <li v-html="printVerifyButton(4,2,1,2)"></li>
                            <li v-html="printVerifyButton(4,2,1,3)"></li>
                            <li v-html="printVerifyButton(4,2,2,1)"></li>
                            <li v-html="printVerifyButton(4,2,2,2)"></li>
                            <li v-html="printVerifyButton(4,2,2,3)"></li>

                            <li v-html="printVerifyButton(4,3,1)"></li>
                            <li v-html="printVerifyButton(4,3,2)"></li>
                            <li v-html="printVerifyButton(4,3,3)"></li>

                            <li v-html="printVerifyButton(4,4,1)"></li>
                            <li v-html="printVerifyButton(4,4,2)"></li>
                            <li v-html="printVerifyButton(4,4,3)"></li>

                            <li v-html="printVerifyButton(4,5,1)"></li>
                            <li v-html="printVerifyButton(4,5,2)"></li>
                            <li v-html="printVerifyButton(4,5,3)"></li>

                            <li v-html="printVerifyButton(4,6,1)"></li>
                            <li v-html="printVerifyButton(4,6,2)"></li>
                            <li v-html="printVerifyButton(4,6,3)"></li>
                            <li v-html="printVerifyButton(4,6,4)"></li>
                            <li v-html="printVerifyButton(4,6,5)"></li>
                            <li v-html="printVerifyButton(4,6,6)"></li>

                            <li v-html="printVerifyButton(4,7,1)"></li>
                            <li v-html="printVerifyButton(4,8,1)"></li>
                            <li v-html="printVerifyButton(4,9,1)"></li>
                            <li v-html="printVerifyButton(4,10,1)"></li>
                            <li v-html="printVerifyButton(4,11,1)"></li>

                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printDownloadPdf(4,1,1)"></li>
                            <li v-html="printDownloadPdf(4,1,2)"></li>
                            <li v-html="printDownloadPdf(4,1,3)"></li>
                            <li v-html="printDownloadPdf(4,2,1,1)"></li>
                            <li v-html="printDownloadPdf(4,2,1,2)"></li>
                            <li v-html="printDownloadPdf(4,2,1,3)"></li>
                            <li v-html="printDownloadPdf(4,2,2,1)"></li>
                            <li v-html="printDownloadPdf(4,2,2,2)"></li>
                            <li v-html="printDownloadPdf(4,2,2,3)"></li>

                            <li v-html="printDownloadPdf(4,3,1)"></li>
                            <li v-html="printDownloadPdf(4,3,2)"></li>
                            <li v-html="printDownloadPdf(4,3,3)"></li>

                            <li v-html="printDownloadPdf(4,4,1)"></li>
                            <li v-html="printDownloadPdf(4,4,2)"></li>
                            <li v-html="printDownloadPdf(4,4,3)"></li>

                            <li v-html="printDownloadPdf(4,5,1)"></li>
                            <li v-html="printDownloadPdf(4,5,2)"></li>
                            <li v-html="printDownloadPdf(4,5,3)"></li>

                            <li v-html="printDownloadPdf(4,6,1)"></li>
                            <li v-html="printDownloadPdf(4,6,2)"></li>
                            <li v-html="printDownloadPdf(4,6,3)"></li>
                            <li v-html="printDownloadPdf(4,6,4)"></li>
                            <li v-html="printDownloadPdf(4,6,5)"></li>
                            <li v-html="printDownloadPdf(4,6,6)"></li>

                            <li v-html="printDownloadPdf(4,7,1)"></li>
                            <li v-html="printDownloadPdf(4,8,1)"></li>
                            <li v-html="printDownloadPdf(4,9,1)"></li>
                            <li v-html="printDownloadPdf(4,10,1)"></li>
                            <li v-html="printDownloadPdf(4,11,1)"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>Scope 1</td>
                    <td>Scope 2</td>
                    <td>Scope 3</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Total Emission Maintenance:</td>
                    <td><input type="text" style="background-color: pink" :value="totalScope1" disabled></td>
                    <td><input type="text" style="background-color: pink" :value="totalScope2" disabled></td>
                    <td><input type="text" style="background-color: pink" :value="totalScope3" disabled></td>
                    <td><input type="text" :value="grandTotal" disabled></td>
                    <td><input type="text" :value="'t CO2e per '+report_period+' year'" disabled></td>
                </tr>
            </table>

            <div class="tabs tabs-primary card p-3" id="maintenance_container">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item" id="criteria-navigation-4-1">
                        <a data-toggle="tab" href="#tab-4-1" role="tab" class="nav-link active show"
                           aria-selected="true">
                            4.1 Landscape
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-2" role="tab" class="nav-link" aria-selected="false">
                            4.2 Pavement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-3" role="tab" class="nav-link" aria-selected="false">
                            4.3 Building
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-4" role="tab" class="nav-link" aria-selected="false">
                            4.4 Bridge
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-5" role="tab" class="nav-link" aria-selected="false">
                            4.5 Tunnel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-6" role="tab" class="nav-link" aria-selected="false">
                            4.6 Road Furniture
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-7" role="tab" class="nav-link" aria-selected="false">
                            4.7 Slope
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-8" role="tab" class="nav-link" aria-selected="false">
                            4.8 Sewage Treatment Plant
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-9" role="tab" class="nav-link" aria-selected="false">
                            4.9 Detention Pond
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-10" role="tab" class="nav-link" aria-selected="false">
                            4.10 Drainage
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-4-11" role="tab" class="nav-link" aria-selected="false">
                            4.11 Vehicle Box Culvert
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-4-1" role="tabpanel" class="tab-pane active show">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item" id="subcriteria-navigation-4-1-1">
                                    <a data-toggle="tab" href="#tab-4-1-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        4.1.1 Carbon Sequestration
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-1-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.1.2 Road Cleaning
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-1-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.1.3 Landscaping
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-4-1-1" role="tabpanel" class="tab-pane active show">
                                <carbon-sequestration
                                        table-id="4.1.1"
                                        template-data-model="tree_carbon_sequestration"
                                        id="411t"
                                        key="411t"
                                        first-column-name="Height Range (m)"
                                        second-column-name="No of Trees"
                                        v-model="childrenTotals[0]"
                                        print-header
                                        class="w-100"
                                ></carbon-sequestration>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-1-2" role="tabpanel" class="tab-pane">
                                <signboard-cleaning
                                        table-id="4.1.2"
                                        id="412t"
                                        key="412t"
                                        v-model="childrenTotals[1]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                            <div id="tab-4-1-3" role="tabpanel" class="tab-pane">
                                <landscaping
                                        table-id="4.1.3"
                                        id="413t"
                                        key="413"
                                        v-model="childrenTotals[2]"
                                        print-header
                                        class="w-100"
                                >
                                </landscaping>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4-2" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-2-1-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        4.2.1.1 Remove Existing Surface
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-2-1-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.2.1.2 Pavement Resurfacing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-2-1-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.2.1.3 Road Marking
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-2-2-1" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.2.2.1 Remove Existing Surface
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-2-2-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.2.2.2 Pavement Resurfacing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-2-2-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.2.2.3 Road Marking
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-4-2-1-1" role="tabpanel" class="tab-pane active show">
                                <remove-existing-surface v-model="childrenTotals[3]"
                                                         table-id="4.2.1.1"
                                                         print-header
                                >
                                </remove-existing-surface>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-2-1-2" role="tabpanel" class="tab-pane">
                                <pavement-resurfacing v-model="childrenTotals[4]"
                                                      table-id="4.2.1.2"
                                                      print-header
                                >
                                </pavement-resurfacing>
                            </div>
                            <div id="tab-4-2-1-3" role="tabpanel" class="tab-pane">
                                <road-marking v-model="childrenTotals[5]"
                                              table-id="4.2.1.3"
                                              print-header
                                >
                                </road-marking>
                            </div>

                            <div id="tab-4-2-2-1" role="tabpanel" class="tab-pane">
                                <remove-existing-surface-with-days v-model="childrenTotals[6]"
                                                                   table-id="4.2.2.1"
                                                                   print-header
                                >
                                </remove-existing-surface-with-days>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-4-2-2-2" role="tabpanel" class="tab-pane">
                                <pavement-resurfacing-with-3-rows-in-scope-3
                                        table-id="4.2.2.2"
                                        print-header
                                        v-model="childrenTotals[7]"
                                >
                                </pavement-resurfacing-with-3-rows-in-scope-3>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-2-2-3" role="tabpanel" class="tab-pane">
                                <pavement-resurfacing-with-3-rows-in-scope-3
                                        table-id="4.2.2.3"
                                        print-header
                                        grand-total-unit="t CO2-eq/m parapet wall"
                                        v-model="childrenTotals[8]"
                                >
                                </pavement-resurfacing-with-3-rows-in-scope-3>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-4-3" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-3-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        4.3.1 Machinery Work
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-3-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.3.2 Repainting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-3-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.3.3 Replacement Utlities
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-4-3-1" role="tabpanel" class="tab-pane active show">
                                <fleet-vehicle
                                        table-id="4.3.1"
                                        id="431t"
                                        key="431t"
                                        print-header
                                        v-model="childrenTotals[9]"
                                        template-data-model="machinery_work"
                                >
                                </fleet-vehicle>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-3-2" role="tabpanel" class="tab-pane">
                                <staff-commuting
                                        table-id="4.3.2"
                                        template-data-model="repainting"
                                        id="432t"
                                        key="432t"
                                        first-column-name="Material"
                                        second-column-name="Consumtpion"
                                        v-model="childrenTotals[10]"
                                        print-header
                                        class="w-100"
                                ></staff-commuting>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-3-3" role="tabpanel" class="tab-pane">
                                <staff-commuting
                                        table-id="4.3.3"
                                        template-data-model="replacement_of_utilities"
                                        id="433t"
                                        key="433t"
                                        first-column-name="Material"
                                        second-column-name="Consumption"
                                        v-model="childrenTotals[11]"
                                        print-header
                                        class="w-100"
                                ></staff-commuting>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-4-4" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-4-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        4.4.1 Repainting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-4-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.4.2 Replacement of Utilities
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-4-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.4.3 Miscelleneous Repair Works
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-4-4-1" role="tabpanel" class="tab-pane active show">
                                <fleet-vehicle
                                        table-id="4.4.1"
                                        id="441t"
                                        key="441t"
                                        print-header
                                        v-model="childrenTotals[12]"
                                        template-data-model="machinery_work"
                                >
                                </fleet-vehicle>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-4-2" role="tabpanel" class="tab-pane">
                                <staff-commuting
                                        table-id="4.4.2"
                                        template-data-model="repainting"
                                        id="442t"
                                        key="442t"
                                        first-column-name="Material"
                                        second-column-name="Consumtpion"
                                        v-model="childrenTotals[13]"
                                        print-header
                                        class="w-100"
                                ></staff-commuting>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-4-3" role="tabpanel" class="tab-pane">
                                <staff-commuting
                                        table-id="4.4.3"
                                        template-data-model="replacement_of_utilities"
                                        id="443t"
                                        key="443t"
                                        first-column-name="Material"
                                        second-column-name="Consumption"
                                        v-model="childrenTotals[14]"
                                        print-header
                                        class="w-100"
                                ></staff-commuting>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-4-5" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-5-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        4.5.1 Repainting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-5-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.5.2 Replacement of Utilities
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-5-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.5.3 Miscelleneous Repair Works
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-4-5-1" role="tabpanel" class="tab-pane active show">
                                <fleet-vehicle
                                        table-id="4.5.1"
                                        id="451t"
                                        key="451t"
                                        print-header
                                        v-model="childrenTotals[15]"
                                        template-data-model="machinery_work"
                                >
                                </fleet-vehicle>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-5-2" role="tabpanel" class="tab-pane">
                                <staff-commuting
                                        table-id="4.5.2"
                                        template-data-model="repainting"
                                        id="452t"
                                        key="452t"
                                        first-column-name="Material"
                                        second-column-name="Consumtpion"
                                        v-model="childrenTotals[16]"
                                        print-header
                                        class="w-100"
                                ></staff-commuting>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4-5-3" role="tabpanel" class="tab-pane">
                                <staff-commuting
                                        table-id="4.5.3"
                                        template-data-model="replacement_of_utilities"
                                        id="453t"
                                        key="453t"
                                        first-column-name="Material"
                                        second-column-name="Consumption"
                                        v-model="childrenTotals[17]"
                                        print-header
                                        class="w-100"
                                ></staff-commuting>
                                <div class="row">
                                    <div class="col-12">
                                        <previous-next-button
                                                navigation-container="maintenance_container"
                                        ></previous-next-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4-6" role="tabpanel" class="tab-pane">
                        <div class="tabs tabs-primary card p-3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-6-1" role="tab" class="nav-link active show"
                                       aria-selected="true">
                                        4.6.1 Signboard Cleaning
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-6-2" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.6.2 Guidepost Cleaning
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-6-3" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.6.3 Safety Barrier Repair
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-6-4" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.6.4 Light and Utility Repair
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-6-5" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.6.5 Boundary Fence
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" href="#tab-4-6-6" role="tab" class="nav-link"
                                       aria-selected="true">
                                        4.6.6 Road Marking
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-4-6-1" role="tabpanel" class="tab-pane active show">
                                <signboard-cleaning
                                        table-id="4.6.1"
                                        id="461t"
                                        key="461t"
                                        v-model="childrenTotals[18]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                            <div id="tab-4-6-2" role="tabpanel" class="tab-pane">
                                <signboard-cleaning
                                        table-id="4.6.2"
                                        id="462t"
                                        key="462t"
                                        v-model="childrenTotals[19]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                            <div id="tab-4-6-3" role="tabpanel" class="tab-pane">
                                <signboard-cleaning
                                        table-id="4.6.3"
                                        id="463t"
                                        key="463t"
                                        v-model="childrenTotals[20]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                            <div id="tab-4-6-4" role="tabpanel" class="tab-pane">
                                <signboard-cleaning
                                        table-id="4.6.4"
                                        id="464t"
                                        key="464t"
                                        v-model="childrenTotals[21]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                            <div id="tab-4-6-5" role="tabpanel" class="tab-pane">
                                <signboard-cleaning
                                        table-id="4.6.5"
                                        id="465t"
                                        key="465t"
                                        v-model="childrenTotals[22]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                            <div id="tab-4-6-6" role="tabpanel" class="tab-pane">
                                <signboard-cleaning
                                        table-id="4.6.6"
                                        id="466t"
                                        key="466t"
                                        v-model="childrenTotals[23]"
                                        print-header
                                        class="w-100"
                                >
                                </signboard-cleaning>
                            </div>
                        </div>
                    </div>

                    <div id="tab-4-7" role="tabpanel" class="tab-pane">
                        <signboard-cleaning
                                table-id="4.7.1"
                                id="471t"
                                key="471t"
                                v-model="childrenTotals[24]"
                                print-header
                                class="w-100"
                        >
                        </signboard-cleaning>
                    </div>
                    <div id="tab-4-8" role="tabpanel" class="tab-pane">
                        <signboard-cleaning
                                table-id="4.8.1"
                                id="481t"
                                key="481t"
                                v-model="childrenTotals[25]"
                                print-header
                                class="w-100"
                        >
                        </signboard-cleaning>
                    </div>
                    <div id="tab-4-9" role="tabpanel" class="tab-pane">
                        <signboard-cleaning
                                table-id="4.9.1"
                                id="491t"
                                key="491t"
                                v-model="childrenTotals[26]"
                                print-header
                                class="w-100"
                        >
                        </signboard-cleaning>
                    </div>
                    <div id="tab-4-10" role="tabpanel" class="tab-pane">
                        <signboard-cleaning
                                table-id="4.10.1"
                                id="4101t"
                                key="4101t"
                                v-model="childrenTotals[27]"
                                print-header
                                class="w-100"
                        >
                        </signboard-cleaning>
                    </div>
                    <div id="tab-4-11" role="tabpanel" class="tab-pane">
                        <staff-commuting
                                table-id="4.11.1"
                                template-data-model="repainting"
                                id="4111t"
                                key="4111t"
                                first-column-name="Material"
                                second-column-name="Consumtpion"
                                v-model="childrenTotals[28]"
                                print-header
                                class="w-100"
                        ></staff-commuting>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="maintenance_container"
                                        special-forward-effect-tabs="main-navigation-5"
                                ></previous-next-button>
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
        totals: [],
        childrenTotals: [],
        report_period: 1,
        totalScope1: 0,
        totalScope2: 0,
        totalScope3: 0,
        authUser: authUser,
      }
    },
    methods: {
      updateDistanceValue () {
        this.totalDistance = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var temp_distance = parseInt(this.rowData[i].distance);
          if (temp_distance !== 'undefined' && Number.isInteger(temp_distance)) {
            this.totalDistance += temp_distance
          }
        }
        this.updateCarbonEmission()
      },
      updateCarbonEmission () {
        this.totalCarbonEmission = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var emission_factor = this.rowData[i]['emission_factor']
          var distance = this.rowData[i]['distance']
          if (emission_factor !== 0 && distance !== 0) {
            var carbon_emission = distance * emission_factor
            this.rowData[i].carbon_emission = carbon_emission
            this.totalCarbonEmission += carbon_emission
          }
        }
      }
    },
    created () {
      for(var i=0; i<29; i++) {
        this.childrenTotals[i] = 0;
        this.totals[i] = 0;
      }
      this.report_period = project_data['report_period']
      this.updateTemplateData()
    },
    watch: {
      childrenTotals () {
        var rowTotal = 0;
        this.totalScope3 = 0;
        this.totalScope1 = 0;
        for(var i=0; i<this.childrenTotals.length; i++) {
          rowTotal = this.childrenTotals[i];
          this.totals[i] = rowTotal;
          if(i > 2 && i < 9) {
            this.totalScope1 += rowTotal;
          }
          else {
            this.totalScope3 += rowTotal;
          }
        }
      }
    },
    computed: {
      grandTotal() {
        stages_totals[currentYearActive][4].machineries = this.totals[3] + this.totals[4] + this.totals[5] + this.totals[6]
          + this.totals[7]
        stages_totals[currentYearActive][4].material = this.totals[1] + this.totals[2] + this.totals[4]
          + this.totals[8] + this.totals[9] + this.totals[10] + this.totals[11] + this.totals[12]
          + this.totals[13] + this.totals[14] + this.totals[15] + this.totals[16] + this.totals[17]
          + this.totals[18] + this.totals[19] + this.totals[20] + this.totals[21] + this.totals[22]
          + this.totals[23] + this.totals[24] + this.totals[25] + this.totals[26] + this.totals[27]
          + this.totals[28]
        needDataUpdate = true

        var totals = 0;
        for(var i=0; i < this.totals.length; i++) {
          totals += this.totals[i];
        }
        return totals;
      }
    }
  }
</script>
