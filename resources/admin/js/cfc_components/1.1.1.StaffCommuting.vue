<template>
    <div>
        <main-section-header
                :criteria-title="criteriaTitle"
                :sub-criteria-title="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
                :print-scope-one="printScopeOne"
                :print-scope-two="printScopeTwo"
                :print-scope-three="printScopeThree"
        >
        </main-section-header>

        <div class="row">
            <div class="col-12">
                <table class="table table-sm form-group w-100">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td></td>
                        <td>No.</td>
                        <td>{{ firstColumnName }}</td>
                        <td>{{ secondColumnName }}</td>
                        <td>Emission Factors</td>
                        <td>Carbon Emissions</td>
                        <td></td>
                    </tr>
                    <tr v-for="(item, index) in rowData" :key="index">
                        <td v-on:click="removeItem(index)" v-model="item.id">
                            <i class="icon-fa icon-fa-trash"/>
                        </td>
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            <select v-on:change="onSelect($event)"
                                    value=""
                                    :id="index"
                                    :key="`${index}select`"
                                    v-model="rowData[index].option" class="form-control">
                                <option v-for="optionItem in optionItems" :value="optionItem.id" :key="optionItem.id">
                                    {{ optionItem.title }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].distance"
                                   v-on:change="updateDistanceValue"
                                   class="form-control"
                            >
                        </td>
                        <td>{{ item.emission_factor.toFixed(4) }}</td>
                        <td>{{ item.carbon_emission.toFixed(4)  }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan=3>Total</th>
                        <th><input type="text" :value="totalDistance" class="form-control" disabled></th>
                        <th></th>
                        <th>{{ totalCarbonEmission.toFixed(4) }}</th>
                        <th style="text-align: right">t CO2e</th>
                    </tr>
                    <tr>
                        <td colspan=5>
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
        default: 'staff_commuting'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'firstColumnName': {
        type: String,
        default: 'Type of vehicle'
      },
      'secondColumnName': {
        type: String,
        default: 'Distance (km)'
      },

      'id': {
        type: String,
        default: ''
      },
      'type': {
        type: Number,
        default: 1
      },
      'printScopeOne': {
        type: Boolean,
        default: false
      },
      'printScopeTwo': {
        type: Boolean,
        default: false
      },
      'printScopeThree': {
        type: Boolean,
        default: false
      }
    },
    data: function() {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        totalDistance: 0,
        totalCarbonEmission: 0,
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
        this.rowData[index].emission_factor = template_data['data'][this.$props.templateDataModel][value].distance
        this.updateCarbonEmission()
      },
      addItem () {
        this.currentIdCounter++
        var newRow = {
          id: this.currentIdCounter,
          option: null,
          distance: 0,
          emission_factor: 0,
          carbon_emission: 0,
          type: this.$props.type
        }
        this.rowData.push(newRow)
      },
      removeItem (index) {
        this.rowData.splice(index, 1);
        this.updateDistanceValue()
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateDistanceValue () {
        this.totalDistance = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var temp_distance = parseInt(this.rowData[i].distance);
          if (temp_distance != null && Number.isInteger(temp_distance)) {
            this.totalDistance += temp_distance
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateCarbonEmission () {
        var total = 0
        for (var i = 0; i < this.rowData.length; i++) {
          total += this.getRowCarbonEmission(i)
        }
        this.totalCarbonEmission = total
        this.$emit('input', this.totalCarbonEmission);
      },
      getRowCarbonEmission(i) {
        var rowData = this.rowData[i]
        var carbon_emission = 0
        var emission_factor = rowData.emission_factor
        var distance = rowData.distance
        if (emission_factor !== 0 && distance !== 0) {
          carbon_emission = distance * emission_factor
          rowData.carbon_emission = carbon_emission
          this.$set(this.rowData, i, rowData)
        }
        return carbon_emission
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      this.warmData();
      this.updateDistanceValue()
      this.updateTemplateData()
    }
  }
</script>
