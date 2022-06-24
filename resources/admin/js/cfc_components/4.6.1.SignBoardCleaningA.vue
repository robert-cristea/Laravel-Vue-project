<!-- Select a text + FleetVehicle_a -->
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
                <table class=".table form-group w-100">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td></td>
                        <td style="width: 50px;">No.</td>
                        <td>Activity</td>
                        <td>{{ vehicleColumnName }}</td>
                        <td>Type</td>
                        <td>Liters / year</td>
                        <td>Emission Factor</td>
                        <td>Carbon Emission</td>
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
                                    v-model="rowData[index].activity" class="form-control">
                                <option v-for="activityItem in activityItems" :value="activityItem.id" :key="activityItem.id">
                                    {{ activityItem.title }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <select v-on:change="updateCarbonEmission"
                                    value=""
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
                            <select v-on:change="onSubSelect($event)"
                                    value=""
                                    :id="index"
                                    v-model="rowData[index].subOption"
                                    class="form-control">
                                <option
                                        v-for="(subOptionItem, subOptionItemKey) in subOptionItems"
                                        :value="subOptionItem.distance"
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
                        <td>{{ item.emission_factor }}</td>
                        <td>{{ item.carbon_emission }}</td>
                    </tr>
                    <tr>
                        <th colspan=5>Total</th>
                        <th><input type="text" :value="totalLiters" class="form-control" disabled></th>
                        <th></th>
                        <th>{{ totalCarbonEmission }}</th>
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
      'activityDataModel': {
        type: String,
        default: 'activities'
      },
      'vehicleColumnName': {
        type: String,
        default: 'Machineries / Transportation'
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
        default: 1
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
        activityItems: [],
        columns: [],
        rowData: []
      }
    },
    methods: {
      onSubSelect(event) {
        var index = event.target.id
        var value = event.target.value;
        var row = this.rowData[index]
        row.subOption = index
        row.emission_factor = value;
        this.$set(this.rowData, index, row)
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      addItem () {
        this.id++
        var newRow = {
          id: this.id,
          activity: null,
          option: null,
          subOption: null,
          distance: 0,
          emission_factor: 0,
          carbon_emission: 0,
          type: 1
        }
        this.rowData.push(newRow)
      },
      removeItem (index) {
        this.rowData.splice(index, 1);
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateLitersYearValue() {
        this.totalLiters = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var temp_distance = parseInt(this.rowData[i].distance);
          if (temp_distance !== 'undefined' && Number.isInteger(temp_distance)) {
            this.totalLiters += temp_distance
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
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
      this.activityItems = template_data['data'][this.$props.activityDataModel]
      this.warmData();
      this.updateLitersYearValue()
      this.updateTemplateData()
    }
  }
</script>
