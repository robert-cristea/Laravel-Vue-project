<template>
    <div>
        <h4>{{ criteriaTitle }}</h4>
        <h4>{{ subCriteriaTitle }}</h4>
        <h5>{{ superSubCriteriaTitle }}</h5>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>

        <div class="row w-100">
            <div class="col-12">
                <table class="table table-sm form-group w-100">
                    <tr>
                        <th colspan="11" :style="headerColor">{{ headerTitle }}</th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Type of vehicle</th>
                        <th align="center" colspan="4">* Distance from home to office per day</th>
                        <th rowspan="2">Emission factor</th>
                        <th rowspan="2">Unit</th>
                        <th rowspan="2">Sub total emission per type of vehicle</th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>< 9 km</th>
                        <th>10-19 km</th>
                        <th>20-29 km</th>
                        <th>< 30km</th>
                    </tr>
                    <tr v-for="(item, index) in rowData" :key="index">
                        <td v-on:click="removeItem(index)" v-model="item.id">
                            <i class="icon-fa icon-fa-trash"/>
                        </td>
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            <select value=""
                                    :id="index"
                                    :key="`${index}select`"
                                    v-model="rowData[index].option" class="form-control"
                                    v-on:change="onSelect($event)"
                            >
                                <option v-for="optionItem in optionItems" :value="optionItem.id" :key="optionItem.id">
                                    {{ optionItem.title }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].first_column"
                                   v-on:change="calculateRowCarbonEmission"
                                   class="form-control"
                            >
                        </td>
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].second_column"
                                   v-on:change="calculateRowCarbonEmission"
                                   class="form-control"
                            >
                        </td>
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].third_column"
                                   v-on:change="calculateRowCarbonEmission"
                                   class="form-control"
                            >
                        </td>
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].fourth_column"
                                   v-on:change="calculateRowCarbonEmission"
                                   class="form-control"
                            >
                        </td>
                        <td>{{ item.emission_factor }}</td>
                        <td>{{ item.unit }}</td>
                        <td>{{ item.carbon_emission }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td colspan="3">Total emission of all staff:</td>
                        <td><input type="text" class="form-control" :value="totalSum" disabled></td>
                        <td>t CO2e per day</td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td colspan="3">Total number of staff:</td>
                        <td><input type="text" class="form-control" :value="totalStaff" disabled></td>
                        <td>no of staff</td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td colspan="3">Emission factor</td>
                        <td><input type="text" :value="totalCarbonEmissionPerDay" disabled class="form-control"></td>
                        <td>{{ totalUnit }}</td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td colspan="3">{{ totalLabel }}</td>
                        <td><input type="text" :value="totalCarbonEmission" disabled class="form-control"></td>
                        <td>{{ totalUnit }}</td>
                    </tr>
                    <tr>
                        <td colspan=11>
                            <button v-on:click="addItem" class="btn btn-secondary">Add new row</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  import dataHandlingMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [dataHandlingMixins],
    props: {
      'templateDataModel': {
        type: String,
        default: 'emission_factor__vehicle'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'id': {
        type: String,
        default: ''
      },
      'headerTitle': {
        type: String,
        default: 'Scope 1 (Direct: Combustion On-Site)'
      },
      'headerColor': {
        type: String,
        default: 'background-color: #ffa500'
      },
      'totalLabel': {
        type: String,
        default: 'Emission per activity for Scope 1:'
      },
      'productivity': {
        default: 0
      },
      'type': {
        default: 1
      },
      'totalUnit': {
        default: 'tCO2e/m3'
      }
    },
    data: function() {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        totalSum: 0,
        totalStaff: 0,
        totalCarbonEmissionPerDay: 0,
        currentIdCounter: 0,
        optionItems: [],
        columns: [],
        rowData: []
      }
    },
    methods: {
      onSelect (event) {
        var index = event.target.id
        var value = this.rowData[index]['option']
        var model = this.$props.templateDataModel
        this.rowData[index].option = value
        this.rowData[index].emission_factor = template_data['data'][model][value].distance
        this.rowData[index].unit = template_data['data'][model][value].unit
        this.calculateRowCarbonEmission()
      },
      calculateRowCarbonEmission() {
        var totalStaff = 0
        var totalSum = 0
        for(var i=0; i<this.rowData.length; i++) {
          var row = this.rowData[i]
          row.carbon_emission = ((row.first_column * 9 * row.emission_factor)
            + (row.second_column * 19 * row.emission_factor)
            + (row.third_column * 29 * row.emission_factor)
            + (row.fourth_column * 30 * row.emission_factor)) * 2
          totalSum += row.carbon_emission
          totalStaff += (row.first_column + row.second_column + row.third_column + row.fourth_column)
        }
        this.totalSum = totalSum
        this.totalStaff = totalStaff
        this.totalCarbonEmissionPerDay = 0
        if(totalStaff != 0) {
            this.totalCarbonEmissionPerDay = totalSum / totalStaff
          }
      },
      addItem () {
        this.currentIdCounter++
        var newRow = {
          id: this.currentIdCounter,
          option: null,
          first_column: 0,
          second_column: 0,
          third_column: 0,
          fourth_column: 0,
          unit: '',
          emission_factor: 0,
          carbon_emission: 0,
          type: this.$props.type
        }
        this.rowData.push(newRow)
      },
      removeItem (index) {
        this.rowData.splice(index, 1);
        this.storeProjectStructure(this.rowData);
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      this.warmData();
      this.calculateRowCarbonEmission()
      this.updateTemplateData()
    },
    computed: {
      totalCarbonEmission() {
        var total = this.totalCarbonEmissionPerDay * 6 * 4 * 12
        this.$emit('input', total);
        this.storeProjectStructure(this.rowData);
        return total
      }
    }
  }
</script>
