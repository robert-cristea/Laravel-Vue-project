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
                <table class=".table form-group w-100">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td></td>
                        <td style="width: 50px;">No.</td>
                        <td>Type of vehicle</td>
                        <td>Type</td>
                        <td>Liters / year</td>
                        <td>Emission Factor</td>
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
                            <select :value="item.option"
                                    :id="index"
                                    v-model="rowData[index].option"
                                    class="form-control">
                                <option
                                        v-for="optionItem in optionItems"
                                        :value="optionItem.id"
                                        :key="optionItem.id">
                                    {{ optionItem.title }}
                                </option>
                            </select>
                        </td>

                        <td>
                            <select v-on:change="onSubSelect(index, $event)"
                                    value=""
                                    :key="index"
                                    v-model="rowData[index].subOption"
                                    class="form-control">
                                <option
                                        v-for="(subOptionItem, subOptionItemKey) in subOptionItems"
                                        :value="subOptionItem.id"
                                        :key="subOptionItemKey">
                                    {{ subOptionItem.title }}
                                </option>
                            </select>
                        </td>

                        <td>
                            <input type="text"
                                   :id="index"
                                   v-model.number="rowData[index].distance"
                                   v-on:change="updateLitersYearValue"
                                   class="form-control"
                            >
                        </td>
                        <td>{{ item.emission_factor.toFixed(4) }}</td>
                        <td>{{ item.carbon_emission.toFixed(4) }}</td>
                    </tr>
                    <tr>
                        <td colspan=4>Total</td>
                        <td><input type="text" :value="totalLiters" class="form-control" disabled></td>
                        <td></td>
                        <td>{{ totalCarbonEmission.toFixed(4) }}</td>
                        <td align="right">t CO2e</td>
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
  import CfcMixins from '../mixins/carbonEmission.js'
  import dataHandlingMixins from '../mixins/dataHandling.js'
  export default {
    mixins: [CfcMixins, dataHandlingMixins],
    props: {
      'templateDataModel': {
        type: String,
        default: 'staff_commuting'
      },
      'templateDataModelFuel': {
        type: String,
        default: 'fuel'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'type': {
        type: Number,
        defaylt: 1
      }
    },
    data () {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        totalLiters: 0,
        totalCarbonEmission: 0,
        id: 0,
        optionItems: [],
        subOptionItems: [],
        rowData: []
      }
    },
    methods: {
      onSubSelect(id, event) {
        var index = event.target.value
        var value = template_data['data'][this.$props.templateDataModelFuel][index].distance
        var row = this.rowData[id]
        row.subOption = index
        row.emission_factor = value
        this.$set(this.rowData, id, row)
        this.updateLitersYearValue()
        this.storeProjectStructure(this.rowData)
      },
      addItem () {
        this.id++
        var newRow = {
          id: this.id,
          option: null,
          subOption: null,
          subOptionItems: [],
          distance: 0,
          emission_factor: 0,
          carbon_emission: 0,
          type: this.$props.type
        }
        this.rowData.push(newRow)
      },
      removeItem (index) {
        this.rowData.splice(index, 1);
        this.updateLitersYearValue()
      },
      updateLitersYearValue() {
        var totalLiters = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var temp_distance = parseInt(this.rowData[i].distance);
          if (temp_distance !== 'undefined' && Number.isInteger(temp_distance)) {
            totalLiters += temp_distance
          }
        }
        this.totalLiters = totalLiters
        this.updateCarbonEmission()
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
      this.subOptionItems = template_data['data']['fuel']
      this.warmData()
      this.updateLitersYearValue()
      this.updateTemplateData()
    }
  }
</script>
