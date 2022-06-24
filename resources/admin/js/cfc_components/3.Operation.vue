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
                    <th>Total Emission</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><button type="button" class="disabled-button" onclick="$('#3_patrolling_navigation_tab').trigger('click')">3.1 Patrolling</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#3_staff_commuting_navigation_tab').trigger('click')">3.2 Building Operation</button></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><input disabled></li>
                            <li><button type="button" class="disabled-button" onclick="$('#3_staff_commuting_navigation_tab').trigger('click')">3.2.1 Staff Commuting</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#3_fleet_vehicle_navigation_tab').trigger('click')">3.2.2 Fleet Vehicle</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#3_electrical_navigation_tab').trigger('click')" style="min-width: 200px">3.2.3 Electrical Consumption</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#3_water_navigation_tab').trigger('click')">3.2.4 Water Consumption</button></li>
                            <!--<li><button type="button" class="disabled-button" onclick="$('#3_waste_navigation_tab').trigger('click')">3.2.5 Waste / Materials</button></li>-->
                            <!--<li><button type="button" class="disabled-button" onclick="$('#3_paper_navigation_tab').trigger('click')">3.2.6 Paper Used</button></li>-->
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(total, index) in totals" :key="index">
                                <input type="text" :value="convert_to_short(totals[index])" disabled v-if="index < 5">
                                <input type="hidden" :value=" convert_to_short(totals[index])" disabled v-else>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-for="(item, index) in totals" :key="index">
                                <input type="text" :value="'t CO2e per '+report_period+' year'" disabled v-if="index < 5">
                                <input type="hidden" :value="'t CO2e per '+report_period+' year'" disabled v-else>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printVerifyButton(3,1)"></li>
                            <li v-html="printVerifyButton(3,2,1)"></li>
                            <li v-html="printVerifyButton(3,2,2)"></li>
                            <li v-html="printVerifyButton(3,2,3)"></li>
                            <li v-html="printVerifyButton(3,2,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printDownloadPdf(3,1)"></li>
                            <li v-html="printDownloadPdf(3,2,1)"></li>
                            <li v-html="printDownloadPdf(3,2,2)"></li>
                            <li v-html="printDownloadPdf(3,2,3)"></li>
                            <li v-html="printDownloadPdf(3,2,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="getStatusOpt(3,1)"></li>
                            <li v-html="getStatusOpt(3,2,1)"></li>
                            <li v-html="getStatusOpt(3,2,2)"></li>
                            <li v-html="getStatusOpt(3,2,3)"></li>
                            <li v-html="getStatusOpt(3,2,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="getCommentBox(3,1)"></li>
                            <li v-html="getCommentBox(3,2,1)"></li>
                            <li v-html="getCommentBox(3,2,2)"></li>
                            <li v-html="getCommentBox(3,2,3)"></li>
                            <li v-html="getCommentBox(3,2,4)"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">Total Emission Construction</td>
                    <td><input type="text" :value="grandTotal" disabled></td>
                    <td><input type="text" :value="'t CO2e per '+report_period+' year'" disabled></td>
                </tr>
            </table>

            <div class="tabs tabs-primary card p-3" id="operation_navigation">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item" id="criteria-navigation-3-1">
                        <a data-toggle="tab" href="#31patrolling" role="tab" class="nav-link active show"
                           aria-selected="true" id="3_patrolling_navigation_tab">
                            3.1 Patrolling
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#321staff-commuting" role="tab" class="nav-link"
                           aria-selected="true" id="3_staff_commuting_navigation_tab">
                            3.2.1 Staff Commuting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#322fleet" role="tab" class="nav-link" aria-selected="false" id="3_fleet_vehicle_navigation_tab">
                            3.2.2 Fleet Vehicle
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#323electric" role="tab" class="nav-link" aria-selected="false" id="3_electrical_navigation_tab">
                            3.2.3 Electrical Consumption
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#324water" role="tab" class="nav-link" aria-selected="false" id="3_water_navigation_tab">
                            3.2.4 Water Consumption
                        </a>
                    </li>
                    <li class="nav-item" v-if="patrollingOption">
                        <a data-toggle="tab" href="#325waste" role="tab" class="nav-link"
                                            aria-selected="false" id="3_waste_navigation_tab">
                            3.2.5 Waste / Materials
                        </a>
                    </li>
                    <li class="nav-item" v-if="patrollingOption">
                        <a data-toggle="tab" href="#326paper" role="tab" class="nav-link"
                                            aria-selected="false" id="3_paper_navigation_tab">
                            3.2.6 Paper Used
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="31patrolling" role="tabpanel" class="tab-pane active show">
                        <fleet-vehicle
                                table-id="3.1"
                                id="31patrol"
                                print-header
                                v-model="totals[0]"
                                template-data-model="patrolling"
                                print-scope-one
                        >
                        </fleet-vehicle>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="321staff-commuting" role="tabpanel" class="tab-pane">
                        <staff-commuting
                                table-id="3.2.1"
                                template-data-model="staff_commuting"
                                id="321staff"
                                print-header
                                v-model="totals[1]"
                                class="w-100"
                        >
                        </staff-commuting>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="322fleet" role="tabpanel" class="tab-pane">
                        <fleet-vehicle
                                table-id="3.2.2"
                                id="322fleet"
                                print-header
                                v-model="totals[2]"
                        >
                        </fleet-vehicle>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="323electric" role="tabpanel" class="tab-pane">
                        <electric-consumption
                                table-id="3.2.3"
                                id="323electric"
                                print-header
                                v-model="totals[3]"
                                class="w-100"
                        >
                        </electric-consumption>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="324water" role="tabpanel" class="tab-pane">
                        <electric-consumption
                                table-id="3.2.4"
                                id="324water"
                                print-header
                                first-measure-name="Water (m3)"
                                second-measure-name="Water (m3)"
                                first-template-model="old_water_consumption"
                                second-template-model="new_water_consumption"
                                v-model="totals[4]"
                                class="w-100"
                        >
                        </electric-consumption>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                        :special-forward-effect-tabs="patrollingOption ? '' : 'main-navigation-3,criteria-navigation-4-1,subcriteria-navigation-4-1-1'"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="325waste" role="tabpanel" class="tab-pane">
                        <electric-consumption
                                table-id="3.2.5"
                                id="325waste"
                                print-header
                                first-type-name="Category"
                                first-measure-name="Quantity (Tonnes)"
                                second-type-name="Transport"
                                second-measure-name="Distance (km)"
                                first-template-model="waste_categories"
                                second-template-model="waste_transportation"
                                v-model="totals[5]"
                                class="w-100"
                        >
                        </electric-consumption>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="326paper" role="tabpanel" class="tab-pane">
                        <paper-used
                                table-id="3.2.6"
                                id="326paper"
                                print-header
                                v-model="totals[6]"
                                class="w-100"
                        >
                        </paper-used>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="operation_navigation"
                                        :special-forward-effect-tabs="patrollingOption ? 'main-navigation-3,criteria-navigation-4-1,subcriteria-navigation-4-1-1' : ''"
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
          patrollingOption:false,
        totals: [0,0,0,0,0,0,0],
        report_period,
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
        convert_to_short(val){
            return val.toFixed(4);
        },

      updateTemplateData () {
        this.optionItems = template_data['data'][this.$props.templateDataModel]

        if(!this.$props.printHeader) {
          return;
        }
        var tablePathIds = this.$props.tableId.split(".");
        var stages = template_data['stages']
        if(tablePathIds.length >= 1) {
          this.stageTitle = stages[tablePathIds[0]]['title']
        }
        if(tablePathIds.length >= 2) {
          this.criteriaTitle = stages[tablePathIds[0]]['stages'][tablePathIds[1]]['title']
        }
        if(tablePathIds.length >= 3) {
          this.subCriteriaTitle = stages[tablePathIds[0]]['stages'][tablePathIds[1]]['stages'][tablePathIds[2]]['title']
        }
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
      },
      saveProject() {
        axios.post('/admin/projects/' + project_data.id, { // <== use axios.post
          data: project_data,
          _method: 'patch'                   // <== add this field
        })
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    created () {
      this.report_period = project_data['report_period']
      this.updateTemplateData()
    },
    computed: {
      grandTotal() {
        stages_totals[currentYearActive][3].transportation = this.totals[1]
        stages_totals[currentYearActive][3].machineries = this.totals[2] + this.totals[0]
        stages_totals[currentYearActive][3].electricity = this.totals[3]
        stages_totals[currentYearActive][3].water =  this.totals[4]
        stages_totals[currentYearActive][3].material =  this.totals[5]
        stages_totals[currentYearActive][3].paper = this.totals[6]
        needDataUpdate = true

        var totals = 0;
        for(var i=0; i < this.totals.length; i++) {
          totals += this.totals[i];
        }

        return this. convert_to_short(totals);
      }
    }
  }
</script>
