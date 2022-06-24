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
                    <th rowspan="2">Criteria</th>
                    <th rowspan="2">Sub-criteria</th>
                    <th colspan="4">Total Emission</th>
                </tr>
                <tr>
                    <th v-if="authUser.role != 'concessionaire'">Scope 1</th>
                    <th v-if="authUser.role != 'concessionaire'">Scope 2</th>
                    <th v-if="authUser.role != 'concessionaire'">Scope 3</th>
                    <th></th>
                </tr>
                <tr>
                    <td><input value="1.1 Office design" disabled></td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><button type="button" class="disabled-button" onclick="$('#staff_commuting_navigation_tab').trigger('click')">1.1.1 Staff Commuting</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#fleet_vehicle_navigation_tab').trigger('click')">1.1.2 Fleet Vehicle</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#electrical_consumption_navigation_tab').trigger('click')" style="min-width: 200px">1.1.3 Electrical Consumption</button></li>
                            <li><button type="button" class="disabled-button" onclick="$('#water_consumption_navigation_tab').trigger('click')">1.1.4 Water Consumption</button></li>
                        </ul>
                    </td>

                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_a)" disabled></li>
                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_b)" disabled></li>
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <!--<li><input style="background-color: pink" type="text" value="0" disabled></li>-->
                            <!--<li><input style="background-color: pink" type="text" value="0" disabled></li>-->
                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_scope_1)" disabled></li>
                            <!--<li v-for="(item, index) in totals">-->
                            <!--<input type="text" :value="item.total" disabled>-->
                            <!--</li>-->
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>

                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_c)" disabled></li>
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <!--<li><input style="background-color: pink" type="text" value="0" disabled></li>-->
                            <!--<li><input style="background-color: pink" type="text" value="0" disabled></li>-->
                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_scope_2)" disabled></li>
                            <!--<li v-for="(item, index) in totals">-->
                            <!--<input type="text" :value="item.total" disabled>-->
                            <!--</li>-->
                        </ul>
                    </td>
                    <td v-if="authUser.role != 'concessionaire'">
                        <ul class="p-0" style="list-style: none">
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <li><input style="background-color: pink" type="text" value="0.0000" disabled></li>
                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_d)" disabled></li>
                            <!--<li><input style="background-color: pink" type="text" :value="total_e" disabled></li>-->
                            <!--<li><input style="background-color: pink" type="text" :value="total_f" disabled></li>-->
                            <li><input style="background-color: pink" type="text" :value="convert_to_short(total_scope_3)" disabled></li>
                            <!--<li v- style="background-color: pink"for="(item, index) in totals">-->
                            <!--<input type="text" :value="item.total" disabled>-->
                            <!--</li>-->
                        </ul>
                    </td>

                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><input type="text" :value="convert_to_short(total_a)" disabled></li>
                            <li><input type="text" :value="convert_to_short(total_b)" disabled></li>
                            <li><input type="text" :value="convert_to_short(total_c)" disabled></li>
                            <li><input type="text" :value="convert_to_short(total_d)" disabled></li>
                            <!--<li><input type="text" :value="total_e" disabled></li>-->
                            <!--<li><input type="text" :value="total_f" disabled></li>-->
                            <!--<li v-for="(item, index) in totals">-->
                                <!--<input type="text" :value="item.total" disabled>-->
                            <!--</li>-->
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li><input type="text" value="t CO2e per" disabled></li>
                            <li><input type="text" value="t CO2e per" disabled></li>
                            <li><input type="text" value="t CO2e per" disabled></li>
                            <li><input type="text" value="t CO2e per" disabled></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printVerifyButton(1,1,1)"></li>
                            <li v-html="printVerifyButton(1,1,2)"></li>
                            <li v-html="printVerifyButton(1,1,3)"></li>
                            <li v-html="printVerifyButton(1,1,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="printDownloadPdf(1,1,1)"></li>
                            <li v-html="printDownloadPdf(1,1,2)"></li>
                            <li v-html="printDownloadPdf(1,1,3)"></li>
                            <li v-html="printDownloadPdf(1,1,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="getStatusOpt(1,1,1)"></li>
                            <li v-html="getStatusOpt(1,1,2)"></li>
                            <li v-html="getStatusOpt(1,1,3)"></li>
                            <li v-html="getStatusOpt(1,1,4)"></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="p-0" style="list-style: none">
                            <li v-html="getCommentBox(1,1,1)"></li>
                            <li v-html="getCommentBox(1,1,2)"></li>
                            <li v-html="getCommentBox(1,1,3)"></li>
                            <li v-html="getCommentBox(1,1,4)"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td :colspan="authUser.role == 'concessionaire' ? 2 : 5" align="right">Total Emission Construction</td>
                    <td><input type="text" :value="convert_to_short(grandTotal)" disabled></td>
                    <td><input type="text" value="t CO2e per" disabled></td>
                </tr>
            </table>

            <div class="tabs tabs-primary card p-3" id="planning_navigation">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item">
                        <a data-toggle="tab" href="#staff-commuting" role="tab" class="nav-link active show" aria-selected="true" id="staff_commuting_navigation_tab">
                            1.1.1 Staff Commuting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#fleet" role="tab" class="nav-link" aria-selected="false" id="fleet_vehicle_navigation_tab">
                            1.1.2 Fleet Vehicle
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#electric" role="tab" class="nav-link" aria-selected="false" id="electrical_consumption_navigation_tab">
                            1.1.3 Electrical Consumption
                        </a>
                    </li>
                    <li class="nav-item"><a data-toggle="tab" href="#water" role="tab" class="nav-link"
                                            aria-selected="false" id="water_consumption_navigation_tab">1.1.4 Water Consumption</a></li>
                </ul>
                <div class="tab-content">
                    <div id="staff-commuting" role="tabpanel" class="tab-pane active show">
                        <staff-commuting
                                table-id="1.1.1"
                                template-data-model="staff_commuting"
                                id="staff"
                                print-header
                                v-model="total_a"
                                class="w-100"
                                print-scope-one
                        >
                        </staff-commuting>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="planning_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="fleet" role="tabpanel" class="tab-pane">
                        <fleet-vehicle
                                table-id="1.1.2"
                                id="fleetTop"
                                print-header
                                v-model="total_b"
                                print-scope-one
                        >
                        </fleet-vehicle>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="planning_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="electric" role="tabpanel" class="tab-pane">
                        <electric-consumption
                                table-id="1.1.3"
                                id="electric"
                                print-header
                                v-model="total_c"
                                class="w-100"
                                print-scope-two
                        >
                        </electric-consumption>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="planning_navigation"
                                ></previous-next-button>
                            </div>
                        </div>
                    </div>
                    <div id="water" role="tabpanel" class="tab-pane">
                        <electric-consumption
                                table-id="1.1.4"
                                id="water"
                                print-header
                                first-measure-name="Water (m3)"
                                second-measure-name="Water (m3)"
                                first-template-model="old_water_consumption"
                                second-template-model="new_water_consumption"
                                v-model="total_d"
                                class="w-100"
                                print-scope-three
                        >
                        </electric-consumption>
                        <div class="row">
                            <div class="col-12">
                                <previous-next-button
                                        navigation-container="planning_navigation"
                                        :special-forward-effect-tabs="specialForwardEffectTabs"
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
        total_a: 0,
        total_b: 0,
        total_c: 0,
        total_d: 0,
        total_e: 0,
        total_f: 0,
        specialForwardEffectTabs: 'main-navigation-2,criteria-navigation-2-1,subcriteria-navigation-2-1-1',
        authUser: authUser,
      }
    },
    created () {

      this.updateTemplateData()


    },
    computed: {
      grandTotal() {
        stages_totals[currentYearActive][1].transportation = this.total_a
        stages_totals[currentYearActive][1].machineries = this.total_b
        stages_totals[currentYearActive][1].electricity = this.total_c
        stages_totals[currentYearActive][1].water = this.total_d
        needDataUpdate = true
        return this.total_a + this.total_b + this.total_c + this.total_d
          + this.total_e + this.total_f
      },
      total_scope_1() {
        return this.total_a + this.total_b
      },
      total_scope_2() {
        return this.total_c
      },
      total_scope_3() {
        return this.total_d + this.total_e + this.total_f
      },

    },
      methods:{
          convert_to_short(val){
              return val.toFixed(4);
          }
      }

  }
</script>
