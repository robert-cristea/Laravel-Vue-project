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
                        <th>Emission Factor</th>
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
  import saveProject from '../mixins/saveProject'
  export default {
    mixins: [dataHandlingMixins, saveProject],
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
        default: 6
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
      findOptionValue(title, model) {
        var values = template_data['data'][model];
        for (var [key, value] of Object.entries(values)) {
          if(value.title == title) {
            return value;
          }
        }
      },
      addItem (title=null) {
        this.currentIdCounter++
        var option = null;
        var unit = '';
        var emission_factor = 0;
        if(typeof title == 'string') {
          var currentOption = this.findOptionValue(title, this.$props.templateDataModel);
          option = currentOption.id;
          unit = currentOption.unit;
          emission_factor = currentOption.distance;
        }
        var newRow = {
          id: this.currentIdCounter,
          option: option,
          nos: 0,
          liters: 0,
          unit: unit,
          emission_factor: emission_factor,
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
      if(this.$props.tableId === '2.9.1' && project_data['name'] == "New Project") {
        this.addItem("Sand");
        this.storeProjectStructure(this.rowData);
        this.saveProject()
      }
      this.warmData();
      this.updateTemplateData()
    },
    computed: {
      totalCarbonEmission() {
        var productivity = Number.parseInt(this.$props.productivity)
        var total = this.totalSum == 0 ? 0 : this.totalSum * productivity
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
