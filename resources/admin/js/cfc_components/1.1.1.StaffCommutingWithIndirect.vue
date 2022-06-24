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
                        <td>Emission Factor</td>
                        <td>Carbon Emission</td>
                        <td>Total Indirect</td>
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
                        <td>{{ item.indirect }}</td>
                    </tr>
                    <tr>
                        <th colspan=3>Total</th>
                        <th><input type="text" :value="totalDistance" class="form-control" disabled></th>
                        <th></th>
                        <th>{{ totalCarbonEmission }}</th>
                        <th>{{ totalIndirect }}</th>
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
  import StaffCommuting from './1.1.1.StaffCommuting.vue'
  export default {
    extends: StaffCommuting,
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
      'productivity': {
        type: Number,
        default: 1
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
      addItem () {
        this.currentIdCounter++
        var newRow = {
          id: this.currentIdCounter,
          option: null,
          distance: 0,
          emission_factor: 0,
          carbon_emission: 0,
          indirect: 0
        }
        this.rowData.push(newRow)
      },
      updateDistanceValue () {
        this.totalDistance = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var temp_distance = parseInt(this.rowData[i].distance);
          if (temp_distance !== 'undefined' && Number.isInteger(temp_distance)) {
            this.totalDistance += temp_distance
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateCarbonEmission () {
        this.totalCarbonEmission = 0
        var total = 0
        for (var i = 0; i < this.rowData.length; i++) {
          total += this.getRowCarbonEmission(i)
        }
        this.totalCarbonEmission = total
        this.$emit('input', this.totalIndirect);
      },
      getRowCarbonEmission(i) {
        var rowData = this.rowData[i]
        var carbon_emission = 0
        var emission_factor = rowData.emission_factor
        var distance = rowData.distance
        var productivity = this.$props.productivity // Keywords.E36
        if (emission_factor !== 0 && distance !== 0) {
          carbon_emission = distance * emission_factor
          rowData.carbon_emission = carbon_emission
          rowData.indirect = productivity !== 0 ? carbon_emission / productivity : 0
          this.$set(this.rowData, i, rowData)
        }
        return carbon_emission
      }
    },
    computed: {
      totalIndirect() {
        var total = 0
        for(var i=0; i<this.rowData.length; i++) {
          total += this.rowData[i].indirect
        }
        return total
      }
    }
  }
</script>
