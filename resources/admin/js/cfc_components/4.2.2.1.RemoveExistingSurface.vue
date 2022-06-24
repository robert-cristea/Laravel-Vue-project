<template>
    <div>
        <main-section-header
                :criteria-title="criteriaTitle"
                :subCriteriaTitle="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
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
                        <td>{{ thirdColumnName }}</td>
                        <td>Distance (km)</td>
                        <td>Carbon Emission</td>
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
                            <select value=""
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
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].secondValue"
                                   v-on:change="updateSecondValue"
                                   class="form-control"
                            >
                        </td>
                        <td>{{ item.emission_factor }}</td>
                        <td>{{ item.carbon_emission }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="3">Total</th>
                        <th><input type="text" :value="totalDistance" class="form-control" disabled></th>
                        <th><input type="text" :value="totalSecondValue" class="form-control" disabled></th>
                        <th><input type="text" :value="totalKm" class="form-control" disabled></th>
                        <th>{{ subTotalCarbonEmission }}</th>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td>Work Productivity / day</td>
                        <td><input type="text" v-model.number="productivity" v-on:change="emitProductivity" class="form-control"></td>
                        <td>km</td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td>Total Carbon Emissions</td>
                        <td><input type="text" :value="totalCarbonEmission" disabled class="form-control"></td>
                        <td>{{ grandTotalUnit }}</td>
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
        default: 'machinery_work_patching'
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
        default: 'Machineries'
      },
      'secondColumnName': {
        type: String,
        default: 'Nos.'
      },
      'thirdColumnName': {
        type: String,
        default: 'Fuel Usage'
      },
      'id': {
        type: String,
        default: ''
      },
      'grandTotalUnit': {
        type: String,
        default: 't CO2-eq/km'
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
        totalSecondValue: 0,
        subTotalCarbonEmission: 0,
        productivity: 0,
        currentIdCounter: 0,
        optionItems: [],
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
          secondValue: 0,
          emission_factor: 0,
          carbon_emission: 0
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
          var tempDistance = parseInt(this.rowData[i].distance);
          if (tempDistance != null && Number.isInteger(tempDistance)) {
            this.totalDistance += tempDistance
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateSecondValue() {
        this.totalSecondValue = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var secondValue = parseInt(this.rowData[i].secondValue);
          if (secondValue != null && Number.isInteger(secondValue)) {
            this.totalSecondValue += secondValue
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateCarbonEmission () {
        this.subTotalCarbonEmission = 0
        var total = 0
        for (var i = 0; i < this.rowData.length; i++) {
          total += this.getRowCarbonEmission(i)
        }
        this.subTotalCarbonEmission = total
      },
      getRowCarbonEmission(i) {
        //first get emission_factor, that is distance in this case
        var rowData = this.rowData[i]
        var emissionFactor = 0
        var distance = rowData.distance
        var secondValue = rowData.secondValue
        var truckConstant = 0.35 // value in 5 MC 4.2.2, Keywords.D24
        var machineryEmissionFactor = 0.00268 // value in 5 MC 4.2.2, Keywords.C17
        //second get carbon_emission for this row
        if (distance !== 0 && secondValue != 0) {
          emissionFactor = (distance * secondValue) / truckConstant
          rowData.emission_factor = emissionFactor
          rowData.carbon_emission = emissionFactor * machineryEmissionFactor
          this.$set(this.rowData, i, rowData)
        }
        return rowData.carbon_emission
      },
      emitProductivity() {
        this.$emit('productivity', this.productivity);
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      this.warmData();
      this.updateTemplateData()
    },
    computed: {
      totalCarbonEmission() {
        var total = this.productivity * this.subTotalCarbonEmission
        this.$emit('input', total);
        return total
      },
      totalKm() {
        var total = 0
        for(var i=0; i<this.rowData.length; i++) {
          total += this.rowData[i].emission_factor
        }
        return total
      }
    }
  }
</script>
