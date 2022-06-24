<template>
    <div>
        <h4>{{ criteriaTitle }}</h4>
        <h4>{{ subCriteriaTitle }}</h4>
        <h5>{{ superSubCriteriaTitle }}</h5>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-sm form-group w-100">
                    <tr>
                        <th colspan="11" :style="headerColor">{{ headerTitle }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>{{ firstColumnName }}</th>
                        <th>{{ secondColumnName }}</th>
                        <th>{{ thirdForm }}</th>
                        <th>Carbon Emission</th>
                        <th></th>
                    </tr>
                    <tr v-for="(item, index) in rowData" :key="index">
                        <td v-on:click="removeItem(index)" v-model="item.id">
                            <i class="icon-fa icon-fa-trash"/>
                        </td>
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            <input type="text"
                                   v-model="rowData[index].title"
                                   class="form-control">
                        </td>
                        <td>
                            <input type="text"
                                   v-model.number="rowData[index].distance"
                                   v-on:change="updateDistanceValue"
                                   class="form-control"
                            >
                        </td>
                        <td>{{ item.emission_factor }}</td>
                        <td>{{ item.carbon_emission }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">Total</td>
                        <td><input type="text" class="form-control" :value="totalSum" disabled></td>
                        <td>t CO2e</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5">{{ totalLabel }}</td>
                        <td><input type="text" :value="totalCarbonEmission" disabled class="form-control"></td>
                        <td>{{ totalUnit }}</td>
                        <td></td>
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
      'headerTitle': {
        type: String,
        default: 'Scope 1 (Direct: Combustion On-Site)'
      },
      'headerColor': {
        type: String,
        default: 'background-color: #ffa500'
      },
      'firstColumnName': {
        type: String,
        default: 'Type of vehicle'
      },
      'secondColumnName': {
        type: String,
        default: 'Distance (km)'
      },
      'thirdForm': {
        type: String,
        default: 'Emission factor (t CO2e/kWh)'
      },
      'id': {
        type: String,
        default: ''
      },
      'totalUnit': {
        default: 'tCO2e/m3'
      },
      'productivity': {
        default: 0
      },
      'totalLabel': {
        type: String,
        default: 'Emission per activity for Scope 1:'
      },
      'type': {
        type: Number,
        default: 3
      }
    },
    data: function() {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
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
      },
      addItem () {
        this.currentIdCounter++
        var newRow = {
          id: this.currentIdCounter,
          title: '',
          option: null,
          distance: 0,
          emission_factor: 0.000694,
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
      this.updateTemplateData()
    },
    computed: {
      totalCarbonEmission() {
        var productivity = Number.parseInt(this.$props.productivity)
        var total = this.totalSum == 0 ? 0 : this.totalSum / productivity
        this.$emit('input', total);
        this.storeProjectStructure(this.rowData);
        return total
      },
      totalSum() {
        var total = 0
        for(var i=0; i<this.rowData.length; i++) {
          total += this.rowData[i].carbon_emission
        }
        return total
      }
    }
  }
</script>
