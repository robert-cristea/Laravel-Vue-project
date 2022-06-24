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
                        <th></th>
                        <th>No.</th>
                        <th>{{ firstColumnName }}</th>
                        <th>{{ secondColumnName }}</th>
                        <th>{{ thirdColumnName }}</th>
                        <th>{{ fourthColumnName }}</th>
                        <th>{{ fifthColumnName }}</th>
                        <th>{{ sixthColumnName }}</th>
                        <th>{{ seventhColumnName }}</th>
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
                                   v-model.number="rowData[index].nos"
                                   class="form-control"
                            >
                        </td>
                        <td>
                            <input type="text"
                                   :id="index"
                                   :key="index"
                                   v-model.number="rowData[index].liters"
                                   class="form-control"
                            >
                        </td>
                        <td>{{ totalFuelUsage(item) }}</td>
                        <td>{{ item.emission_factor }}</td>
                        <td>{{ item.unit }}</td>
                        <td>{{ item.carbon_emission }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="3">Total</td>
                        <td><input type="text" class="form-control" :value="totalSum" disabled></td>
                        <td>t CO2e</td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
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
  import saveProject from '../mixins/saveProject'
  export default {
    mixins: [dataHandlingMixins, saveProject],
    props: {
      'templateDataModel': {
        type: String,
        default: 'machineries_equipment'
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
      'firstColumnName': {
        type: String,
        default: 'Machineries & Equipment'
      },
      'secondColumnName': {
        type: String,
        default: 'Nos'
      },
      'thirdColumnName': {
        type: String,
        default: 'Fuel Usage for one machine (liter)'
      },
      'fourthColumnName': {
        type: String,
        default: 'Total fuel usage'
      },
      'fifthColumnName': {
        type: String,
        default: 'Emission factor '
      },
      'sixthColumnName': {
        type: String,
        default: 'Unit'
      },
      'seventhColumnName': {
        type: String,
        default: 'Carbon emission per machine '
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
        this.rowData[index].unit = template_data['data'][this.$props.templateDataModel][value].unit
      },
      totalFuelUsage(item) {
        item.carbon_emission = item.nos * item.liters * item.emission_factor
        return item.nos * item.liters
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
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      if(this.$props.tableId === '2.9.1' && project_data['name'] == "New Project") {
        if(this.$props.type == 1) {
          console.log("Adding default items for 2-9-1")
          this.addItem("Bulldozer");
          this.addItem("Compactor");
          this.addItem("Crawler Tractors");
          this.addItem("Motor Grader");
          this.addItem("Paver");
          this.addItem("Water Browser");
          this.storeProjectStructure(this.rowData);
          this.saveProject()
        }
        else {
          this.addItem("Diesel Truck (km)");
          this.addItem("Lorry (km)");
          this.storeProjectStructure(this.rowData);
          this.saveProject()
        }
      }
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
