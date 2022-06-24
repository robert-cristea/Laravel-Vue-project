<template>
    <div>
        <main-section-header
                :criteria-title="criteriaTitle"
                :subCriteriaTitle="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
                :print-scope-one="printScopeOne"
                :print-scope-two="printScopeTwo"
                :print-scope-three="printScopeThree"
        >
        </main-section-header>

        <div class="row">
            <div class="col-12">
                <table class=".table form-group w-100">
                    <tr style="background-color: YellowGreen; color: black;">
                        <td></td>
                        <td style="width: 50px;">No.</td>
                        <td>Size of Paper</td>
                        <td>gsm</td>
                        <td>Number of ream</td>
                        <td>Number packages</td>
                        <td>Pages</td>
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
                            <select v-on:change="onSelect($event)"
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
                                        v-for="(subOptionItem, subOptionItemKey) in rowData[index].subOptionItems"
                                        :value="subOptionItem"
                                        :key="subOptionItemKey">
                                    {{ subOptionItemKey }}
                                </option>
                            </select>
                        </td>

                        <td>
                            <input type="text"
                                   :id="index"
                                   v-model.number="rowData[index].a"
                                   v-on:change="updateTotalA"
                                   class="form-control"
                            >
                        </td>

                        <td>
                            <input type="text"
                                   :id="index"
                                   v-model.number="rowData[index].b"
                                   v-on:change="updateTotalB"
                                   class="form-control"
                            >
                        </td>

                        <td>
                            <input type="text"
                                   :id="index"
                                   v-model.number="rowData[index].c"
                                   v-on:change="updateTotalC"
                                   class="form-control"
                            >
                        </td>

                        <td>{{ item.carbon_emission }}</td>
                    </tr>
                    <tr>
                        <td colspan=4>Total</td>
                        <td><input type="text" :value="totalA" class="form-control" disabled></td>
                        <td><input type="text" :value="totalB" class="form-control" disabled></td>
                        <td><input type="text" :value="totalC" class="form-control" disabled></td>
                        <td>{{ totalCarbonEmission }}</td>
                        <td style="text-align: right">t CO2e</td>
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
        default: 'paper'
      },
      'tableId': {
        type: String,
        default: ''
      },
      'printHeader': {
        type: Boolean,
        default: false
      },
      'constFactor': {
        type: Number,
        default: 0.9286
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
    data () {
      return {
        stageTitle: '',
        criteriaTitle: '',
        subCriteriaTitle: '',
        superSubCriteriaTitle: '',
        instructions: '',
        totalA: 0,
        totalB: 0,
        totalC: 0,
        totalCarbonEmission: 0,
        id: 0,
        optionItems: [],
        columns: [],
        rowData: []
      }
    },
    methods: {
      onSelect (event) {
        var index = event.target.id
        var value = this.rowData[index]['option']
        var subOptions = Object.assign({}, template_data['data'][this.$props.templateDataModel][value])
        delete subOptions['id'];
        delete subOptions['title'];
        delete subOptions['distance'];
        this.rowData[index].subOptionItems = subOptions;
      },
      onSubSelect(event) {
        var index = event.target.id;
        var value = this.rowData[index]['subOption'];
        this.rowData[index].emission_factor = value;
      },
      addItem () {
        this.id++
        var newRow = {
          id: this.id,
          option: null,
          subOption: null,
          subOptionItems: [],
          a: 0,
          b: 0,
          c: 0,
          distance: 0,
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
      updateTotalA() {
        this.totalA = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var tempValue = parseInt(this.rowData[i].a);
          if (tempValue !== 'undefined' && Number.isInteger(tempValue)) {
            this.totalA += tempValue
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateTotalB() {
        this.totalB = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var tempValue = parseInt(this.rowData[i].b);
          if (tempValue !== 'undefined' && Number.isInteger(tempValue)) {
            this.totalB += tempValue
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateTotalC() {
        this.totalC = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var tempValue = parseInt(this.rowData[i].c);
          if (tempValue !== 'undefined' && Number.isInteger(tempValue)) {
            this.totalC += tempValue
          }
        }
        this.updateCarbonEmission()
        this.storeProjectStructure(this.rowData);
      },
      updateCarbonEmission () {
        this.totalCarbonEmission = 0
        for (var i = 0; i < this.rowData.length; i++) {
          var carbon_emission = this.getCarbonEmissionForRow(this.rowData[i])
          this.rowData[i].carbon_emission = carbon_emission
          this.totalCarbonEmission += carbon_emission
        }
        this.$emit('input', this.totalCarbonEmission);
      },
      getCarbonEmissionForRow(row) {
        return (row.a !== 0 && row.b !== 0 && row.c !== 0)
          ? (row.a * row.b * row.c * row.subOption * this.$props.constFactor) / 1000000
          : 0
      }
    },
    created () {
      this.optionItems = template_data['data'][this.$props.templateDataModel]
      this.warmData()
      this.updateTotalA()
      this.updateTotalB()
      this.updateTotalC()
      this.updateTemplateData()
    }
  }
</script>
